<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'resource',
        'seo_title',
        'description',
        'slug',
        'photo',
        'meta_description',
    ];

}
