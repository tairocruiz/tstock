<?php

namespace App\Http\Controllers\Safaris;

use App\Models\d2d;
use App\Http\Resources\d2dresource;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class D2dController extends Controller
{
    public function remove($id) {

        // find the day to delete
        $day = d2d::find($id);

        // delete attached photos if any
        if (!is_null($day)) {
            if (!is_null($day->day_photo1)) {
                Storage::delete('/public/day2day_photos/'.$day->day_photo1);
            }
            if (!is_null($day->day_photo2)) {
                Storage::delete('/public/day2day_photos/'.$day->day_photo2);
            }
        }

        // delete the day
        $day->delete();

        // adjust the number of days in the parent tour
        $tour = Tour::find($day->tour_id);
        $tour->days = $tour->days - 1;

        if ($tour->save()) {
            return new d2dresource($day);
        }

        return true;
    }
}
