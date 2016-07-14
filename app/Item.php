<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'market_hash_name', 'classid', 'price', 'color','backgroundcolor','rarity'];
}
