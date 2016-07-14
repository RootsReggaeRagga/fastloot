<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;
use App\Http\Controllers\SteamItem;
use App\Game;
use Illuminate\Support\Facades\Redis;
use App\User;
use Carbon\Carbon;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;


    private $lang;
    public $user;
    public $title;

    public function __construct()
    {
        $this->middleware('enter');
        $this->languages = config("app.languages");
        $this->lang = \Session::get('lang');
        $this->setTitle('Title not stated');
        $last = Game::where('status', '=', 3)->where('showwinner', 1)->orderBy('id', 'desc')->take(1)->first();
        if ($last) {
            $last->last_winner = User::find($last->winner_id);
            $last->last_winner->money = $last->price;
            $last->last_winner->percent = $last->percent;
            view()->share('last', $last);
        }
        $happy = Game::where('status', '=', 3)->where('showwinner', 1)->orderBy('id', 'percent')->take(1)->first();
        if ($happy) {
            $happy->last_winner = User::find($happy->winner_id);
            $happy->last_winner->money = $happy->price;
            $happy->last_winner->percent = $happy->percent;
            view()->share('happy', $happy);
        }
        if (Auth::check()) {
            $this->user = Auth::user();
            $this->user->username = str_replace('script', '', $this->user->username);

            view()->share('u', $this->user);
        }

    }


    public function setTitle($title)
    {

        $this->title = $title;
        view()->share('title', $this->title);
    }


}
