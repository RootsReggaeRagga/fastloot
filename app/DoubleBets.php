<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DoubleBets extends Model{

    protected $table = 'doublebets';

    protected $fillable = ['game_id', 'userid', 'sum','color'];

    public $timestamps = true;

}