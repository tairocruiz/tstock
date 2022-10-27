<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class d2d extends Model
{
    public function tour()
    {
        return $this->belongsTo('App\Models\Tour');
    }
}
