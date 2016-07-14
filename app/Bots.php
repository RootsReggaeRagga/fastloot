<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bots extends Model{

    protected $table = 'bots';

    protected $fillable = ['accountName', 'password', 'nick','shared','trade','steamguard','token','trade_link'];

    public $timestamps = true;

}