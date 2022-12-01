<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TourCategory;
use Cviebrock\EloquentSluggable\Sluggable;

class Tour extends Model
{
    //use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function tour_category()
    {
        return $this->belongsToMany(TourCategory::class);
    }

    // public function categories()
    // {
    //     return $this->belongsToMany('App\Models\TourCategory');
    // }

    public function tour_days()
    {
        return $this->hasMany('App\Models\d2d');
    }
}
