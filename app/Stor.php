<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Stor extends Model{

    protected $table = 'store';

    protected $fillable = ['name', 'inventoryId', 'buyer_id', 'classid', 'price', 'steam_price', 'rarity', 'quality', 'type'];


    public $timestamps = true;


    public static function getClassRarity($type){
        switch ($type) {
            case 'Армейское качество':      return 'milspec'; break;
            case 'Запрещенное':             return 'restricted'; break;
            case 'Засекреченное':           return 'classified'; break;
            case 'Тайное':                  return 'covert'; break;
            case 'Ширпотреб':               return 'common'; break;
            case 'Промышленное качество':   return 'common'; break;
        }
    }

}