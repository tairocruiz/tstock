<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourCategory extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Database\Eloquent\Models
     *
     * @return \Illuminate\Database\Eloquent\Tour
     */
    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
