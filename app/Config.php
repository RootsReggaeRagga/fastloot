<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Config extends Model{

    protected $table = 'config';

    protected $fillable = ['dweb', 'dsecret','sitename','countitems'];

    public $timestamps = false;

}