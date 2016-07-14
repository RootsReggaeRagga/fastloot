<?php namespace App\Http\Controllers;

use App\DoubleBets;
use App\Double;
use App\Http\Controllers\Controller;
use App\User;
use Request;

class DoubleGames extends Controller
{

    const New_Messages = 'New_Messages';
    const NEW_BET = 'new.bet';
    public $red = [1, 2, 3, 4, 5, 6, 7];
    public $black = [8, 9, 10, 11, 12, 13, 14];

    public $game;

    public function __construct()
    {
        parent::__construct();
        $this->game = $this->getLastGame();
    }

    public  function getLastGame()
    {
        $game = Double::orderBy('id', 'desc')->first();
        if (is_null($game)) $game = $this->newGame();
        return $game;
    }

    public function newgame()
    {


        if (!$this->game or $this->game->status == 2) {
            $randompos = [
                0 => [62, 83],
                1 => [38, 58],
                2 => [-6, 10],
                3 => [303, 323],
                4 => [255, 275],
                5 => [207, 227],
                6 => [159, 19],
                7 => [110, 130],
                8 => [15, 35],
                9 => [327, 347],
                10 => [-81, -60],
                11 => [231, 251],
                12 => [183, 203],
                13 => [135, 156],
                14 => [87, 107]
            ];
            $rand_number = "0." . mt_rand(100000000, 989999999) . mt_rand(100000000, 989999999) . mt_rand(100000000, 989999999);
            $number = round($rand_number * 15);
            $win_variant = "zero";
            if (in_array($number, $this->red)) {
                $win_variant = "red";
            } else if (in_array($number, $this->black)) {
                $win_variant = "black";
            }

            $game = Double::create(['color' => $win_variant, 'hash' => hash('sha224', $number), 'rand_number' => $rand_number,
                'number' => $number, 'position' => $randompos[$number][0] + mt_rand(1, 20)
            ]);
            $game->hash = md5($game->rand_number);
            $game->rand_number = 0;
            $game->number = 0;
            $game->position = 0;
            return $game;
        }

    }

    public function index()
    {
        $game = $this->game;
        if (is_null($game)) $game = $this->newGame();
        $bets = DoubleBets::orderBy('sum', 'desc')->where('game_id', $this->game->id)->get();
        $games = Double::orderBy('id', 'desc')->where('status', 2)->take(14)->get();
        $lastgame = Double::orderBy('id', 'desc')->where('status', 2)->first();
        $red = DoubleBets::where('game_id', $this->game->id)->where('color', 'red')->sum('sum');
        $black = DoubleBets::where('game_id', $this->game->id)->where('color', 'black')->sum('sum');
        $zero = DoubleBets::where('game_id', $this->game->id)->where('color', 'zero')->sum('sum');
        $fast = Fast::get();
        foreach ($games as $i) {
            $win_variant = "zero";
            if (in_array($i->number, $this->red)) {
                $win_variant = "red";
            } else if (in_array($i->number, $this->black)) {
                $win_variant = "black";
            }
            $i->color = $win_variant;
        }
        foreach ($bets as $bet) {
            $bet->user = User::find($bet->userid);
        }

        return view('pages.index', compact('bets', 'game', 'games', 'red', 'zero', 'black',  'lastgame'));

    }

    public function getBalance()
    {
        return $this->user->money;
    }

    public function getWinners()
    {
        $winners = DoubleBets::where("color", $this->game->color)->where('game_id', $this->game->id)->get();
        foreach ($winners as $i) {
            $user = User::find($i->userid);
            $amount = $user->money + ($i->sum * 2);
            if ($this->game->color == "zero") {
                $amount = $user->money + ($i->sum * 8);
            }
            $this->_responseSuccessToSite('Вы выиграли ' . ($amount - $user->money) . ' фаст поинт', $user->steamid64, self::New_Messages);
            $user->money = $amount;
            $user->save();


        }
        return $this->game;

    }

    private function _responseSuccessToSite($message, $user, $channel)
    {
        return $this->redis->publish($channel, json_encode([
            'user' => $user,
            'msg' => $message
        ]));
    }

    public function setGameStatus()
    {
        $this->game->status = Request::get('status');
        $this->game->save();
        return $this->game;
    }

    public function getCurrentGame()
    {
        return $this->game;
    }

    public function newBetinapi()
    {
        $data = $this->redis->lrange('bets.list', 0, -1);
        foreach ($data as $newBetJson) {
            $bets = json_decode($newBetJson);
            $bet = DoubleBets::create(['game_id' => $bets->gameid, 'userid' => $bets->userid, 'sum' => $bets->sum, 'color' => $bets->color]);
            $bet->user = User::find($bet->userid);
            $red = DoubleBets::where('game_id', $bet->gameid)->where('color', 'red')->sum('sum');
            $black = DoubleBets::where('game_id', $bet->gameid)->where('color', 'black')->sum('sum');
            $zero = DoubleBets::where('game_id', $bet->gameid)->where('color', 'zero')->sum('sum');
            $this->redis->publish(self::NEW_BET, json_encode(['status' => 'success', 'id' => $bet->id, 'all' => $zero + $red + $black, 'red' => $red, 'zero' => $zero, 'black' => $black, 'game_id' => $bet->game_id, 'html' => view('includes.bet', compact('bet'))->render()]));
            $this->redis->lrem('bets.list', 0, $newBetJson);
        }
        return response()->json(['success' => true]);

    }

    function newbet()
    {


        $bets = DoubleBets::where('game_id', $this->game->id)->where('userid', $this->user->id);
        $sum = intval(Request::get('sum'));
        $color = Request::get('operation');

        if ($color != 'red' and $color != 'black' and $color != 'zero') return ["status" => "error_steam", "msg" => "Нет такого цвета!"];
        if (empty($this->user->trade_link)) return ["status" => "error_steam", "msg" => "Укажите ссылку на обмен!"];

        if ($this->user->money < $sum) return ["status" => "error_game", "msg" => "Пополните баланс ! "];

        if ($sum < 1) return ["status" => "error_game", "msg" => "Минимальная ставка 1 коин"];

        if ($sum > 1500000) return ["status" => "error_game", "msg" => "Максимальная ставка на цвет 1500000 коинов!"];

        if ($bets->where('color', $color)->sum('sum') >= 1500000) return ["status" => "error_game", "msg" => "Максимальная ставка на цвет 1500000 коинов!"];

        if ($this->game->status != 0) {
            $data = $this->redis->lrange('bets.list', 0, -1);
            $i = 0;
            $summa = [0];
            foreach ($data as $newBetJson) {
                $bets = json_decode($newBetJson);
                if ($bets->userid == $this->user->id) {
                    $summa[$i] = $bets->sum;

                }
                $i++;
            }
            if (array_sum($summa) >= 1500000) return ["status" => "error_game", "msg" => "Максимальная ставка на цвет 1500000 коинов!"];
            $bets->userid = $this->user->id;
            $bets->sum = $sum;
            $bets->color = $color;
            $bets->gameid = $this->game->id + 1;
            $this->redis->rpush('bets.list', json_encode($bets));
            $this->user->money -= Request::get('sum');
            $this->user->save();
            return ["status" => "error_game", "msg" => "Игра закончена ! Ваша ставка пойдёт на следующую игру."];
        }


        $bet = DoubleBets::create(['game_id' => $this->game->id, 'userid' => $this->user->id, 'sum' => $sum, 'color' => $color]);

        $bet->user = User::find($this->user->id);
        $red = DoubleBets::where('game_id', $this->game->id)->where('color', 'red')->sum('sum');
        $black = DoubleBets::where('game_id', $this->game->id)->where('color', 'black')->sum('sum');
        $zero = DoubleBets::where('game_id', $this->game->id)->where('color', 'zero')->sum('sum');
        $this->user->money -= Request::get('sum');
        $this->user->save();
        $this->redis->publish(self::NEW_BET, json_encode(['status' => 'success', 'id' => $bet->id, 'all' => $zero + $red + $black, 'red' => $red, 'zero' => $zero, 'black' => $black, 'game_id' => $this->game->id, 'html' => view('includes.bet', compact('bet'))->render()]));

    }


}
