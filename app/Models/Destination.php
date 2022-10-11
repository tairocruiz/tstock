<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DestinationCategory;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'seo_title',
        'meta_description',
        'description',
        'destination_category_id',
        'photo',
    ];

    public function destination_category()
    {
        return $this->belongsTo(DestinationCategory::class);
    }
}
