<?php namespace App\Http\Controllers;

use DB;
use Request;
use Auth;
use App\Config;
use App\User;
use App\Game;
use App\Bots;
use Carbon\Carbon;
use App\Http\Controllers\Controller;


class Admin extends Controller
{





    public function index()
    {
      //  $game = \DB::table('game')->where('case', '>', 0)->where('userid', '!=', 209)->whereNotBetween('userid', [99, 199])->whereNotBetween('userid', [419, 618])->
       // where('game.status', '!=', 0)->orderby('id', 'desc')->join('users', 'game.userid', '=', 'users.id')->join('case', 'game.case', '=', 'case.id')->select('game.*', 'case.name as case_name', 'users.username as winner_username', 'users.steamid64 as winner_steamid64', 'users.avatar as winner_avatar')->take(20)->get();
        return view('admin.index');
    }

    public function classconfig()
    {
        $config = Config::find(1);
        if (Request::get('MAX_ITEMSALL')) $config->MAX_ITEMSALL = Request::get('MAX_ITEMSALL');
        if (Request::get('MIN_USERS')) $config->MIN_USERS = Request::get('MIN_USERS');
        if (Request::get('MIN_PRICE')) $config->MIN_PRICE = Request::get('MIN_PRICE');
        if (Request::get('MAX_ITEMS')) $config->MAX_ITEMS = Request::get('MAX_ITEMS');
        if (Request::get('COMMISSION')) $config->COMMISSION = Request::get('COMMISSION');
        if (Request::get('COMMISSION_FOR_FIRST_PLAYER')) $config->COMMISSION_FOR_FIRST_PLAYER = Request::get('COMMISSION_FOR_FIRST_PLAYER');
        if (Request::get('APPID')) $config->APPID = Request::get('APPID');

        $config->save();
        return view('admin.classconfig', compact('config'));
    }


    public function bots()
    {
        $bots = Bots::get();
        return view('admin.bots.bots',compact('bots'));
    }
    public function bot($id)
    {
        $bots = Bots::find($id);
        if (Request::get('nick')) $bots->nick = Request::get('nick');
        if (Request::get('accountName')) $bots->accountName = Request::get('accountName');
        if (Request::get('password')) $bots->password = Request::get('password');
        if (Request::get('shared')) $bots->shared = Request::get('shared');
        if (Request::get('trade')) $bots->trade = Request::get('trade');
        if (Request::get('steamguard')) $bots->steamguard = Request::get('steamguard');
        if (Request::get('token')) $bots->token = Request::get('token');

        $bots->save();
        return view('admin.bots.bot',compact('bots'));
    }


    public function users()
    {
        $user = User::get();
        return view('admin.users.users',compact('user'));
    }


    public function user($id)
    {
        $user = User::find($id);
        return view('admin.users.user',compact('user'));
    }



}