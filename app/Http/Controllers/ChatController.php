<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Request;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{

    const CHAT_CHANNEL = 'chat.message_';
    const NEW_MSG_CHANNEL = 'new.msg';

    public function add_message()
    {
        if (\Cache::has('addmsg.user.' . $this->user->id)) return response()->json(['errors' => 'Вы слишком часто отправляете сообщения!']);
        \Cache::put('addmsg.user.' . $this->user->id, '', 0.02);
        if (is_null(Request::get('room'))) return response()->json(['errors' => 'Ошибка!']);
        if ($this->user->banchat == 1) {
            return response()->json(['errors' => 'Вы забанены в чате ! Срок : Навсегда']);
        }

        $val = \Validator::make(Request::all(), [
            'messages' => 'required|string|max:255'
        ],[
            'required' => 'Сообщение не может быть пустым!',
            'string' => 'Сообщение должно быть строкой!',
            'max' => 'Максимальный размер сообщения 255 символов.',
        ]);
        $error = $val->errors();

        if($val->fails()){
            return response()->json(['errors' => $error->first('messages')]);
        }

        $support = $this->user->support;
        $admin = $this->user->is_admin;
        $avatar = $this->user->avatar;
        $username = htmlspecialchars($this->user->username);
        if ($admin) {
            $avatar = '/template/img/10709.gif';
            $username = 'ADMIN';
        }
        $userid = $this->user->id;
        if ($support) {
            $avatar = '/template/img/10709.gif';
            $support = 1;
            $admin = 0;
        } else {
            $support = 0;
            $admin = $this->user->is_admin;
        }





        $messages = Request::get('messages');

        //if(Game::where('userid'  ,  '=', $this->user->id)->where('case',  '!=', 0)->first() == null)return response()->json(['errors'=>'Вы должны купить один билет']);
        function object_to_array($data)
        {
            if (is_array($data) || is_object($data)) {
                $result = array();
                foreach ($data as $key => $value) {
                    $result[$key] = object_to_array($value);
                }
                return $result;
            }
            return $data;
        }

        $words = file_get_contents(dirname(__FILE__) . '/words.json');
        $words = object_to_array(json_decode($words));

        foreach ($words as $key => $value) {
            $messages = str_ireplace($key, $value, $messages);
        }
        if ($this->user->is_admin) {
            if (substr_count($messages, '/clear')) {
                Redis::del(self::CHAT_CHANNEL.Request::get('room'));
                return response()->json(['success' => 'Вы отчистили чат']);
            }
        } else {

            if (preg_match("/href|url|http|www|.ru|.com|.net|.info|.org/i", $messages)) {
                return response()->json(['errors' => 'Ссылки запрещены !']);
            }
        }
        $msg  = ['userid' => $userid, 'avatar' => $avatar, 'time' => Carbon::now()->format('H:i'),  'messages' => $messages, 'username' => $username,
            'support' => $support,
            'admin' => $admin];

        Redis::rpush(self::CHAT_CHANNEL.Request::get('room'), view('includes.chat', compact('msg'))->render());
        Redis::publish(self::NEW_MSG_CHANNEL, json_encode(['msg' => view('includes.chat', compact('msg'))->render(),'room' => Request::get('room')]));
    }


}
