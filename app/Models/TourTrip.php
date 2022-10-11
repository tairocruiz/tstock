<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourTrip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tour_id',
        'day',
        'trip_id'
    ];

    public function tour(){
        return $this->belongsTo(Tour::class);
    }
    

    public function trip(){
        return $this->belongsTo(Trip::class);
    }
}
