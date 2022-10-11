<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;

class DestinationCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'seo_title',
        'meta_description',
        'description',
        'slug',
        'photo',
        'created_at',
        'updated_at'
    ];

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
