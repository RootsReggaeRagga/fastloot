<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'avatar', 'steamid', 'steamid64'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['trade_link', 'remember_token', 'is_admin', 'is_moderator', 'accessToken'];

    public function games()
    {
        return $this->hasMany('App\Game');
    }

    public function bets()
    {
        return $this->hasMany('App\Bet');
    }

    public function betsByGame($gameid)
    {
        return \DB::table('bets')->where('user_id', $this->id)->where('game_id', $gameid)->orderBy('created_at', 'desc')->get();
    }

    public function lastBet()
    {
        return $this->hasOne('App\Bet')->latest();
    }

    public function itemsCountByGame($game)
    {
        return $this->bets()->where('game_id', $game->id)->sum('itemsCount');
    }


}
