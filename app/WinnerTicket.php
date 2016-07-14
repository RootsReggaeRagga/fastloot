<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WinnerTicket extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }
    
}
