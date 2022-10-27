<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TourTourCategory extends Pivot
{
    public $incrementing = true;

    public function tour(){
        return $this->belongsTo(Tour::class);
    }

    public function tour_category()
    {
        return $this->belongsTo(TourCategory::class);
    }
}
