<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Double extends Model{

    protected $table = 'double';

    protected $fillable = ['rand_number', 'number','color','position'];

    public $timestamps = true;

}