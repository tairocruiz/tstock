<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'special',
        'seo_title',
        'meta_description',
        'description',
        'photo',
        'slug',
    ];

    /**
     * @var \Illuminate\Database\Eloquent\Models
     *
     * @return App\Models\Tour
     */
    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
