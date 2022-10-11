<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    //'name', 'slug', 'meta_description', 'photo', 'price', 'days', 'tour_category_id'
    protected $fillable = [
        'name',
        'slug',
        'seo_title',
        'meta_description',
        'photo',
        'price',
        'days',
        'tour_category_id'
    ];

    public function tour_category()
    {
        return $this->belongsTo(TourCategory::class);
    }

    public function tour_trips()
    {
        return $this->hasMany(TourTrip::class);
    }
}
