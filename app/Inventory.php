<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model{

    protected $table = 'inventory';

    protected $fillable = ['userid', 'classid', 'status','inventoryId','bot','name','market_hash_name','type'];

    public $timestamps = true;

}