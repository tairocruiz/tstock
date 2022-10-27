<?php

namespace App\Http\Controllers\Safaris;

use App\Models\d2d;
use App\Http\Resources\TourResource;
use App\Mail\EnquireSafari;
use App\Mail\TailorMadeSafari;
use App\Models\Tour;
use App\Models\Page;
use App\Models\TourCategory;
use App\Models\DestinationCategory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TourController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('tour_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $title = 'Tanzania Safaris & Tours';
        $tours = Tour::all();
        $pages = Page::all();
        $tour_categories = TourCategory::all();
        $destination_categories = DestinationCategory::all();
        return view('admin.tours.index', compact('title', 'tours', 'pages', 'tour_categories', 'destination_categories'));
    }

    public function show($slug)
    {
        $tour = Tour::where('slug',$slug)->firstOrFail();
        $title = $tour->seo_title? $tour->seo_title : $tour->name;

        return view('front.tours.show', compact('tour','title'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $tours = Tour::all();
        return TourResource::collection($tours);
    }

    public function create(){
        $tour_categories = TourCategory::all();
        $title = 'Tour create';
        $tours = Tour::all();
        return view('admin.tours.add', compact('title', 'tour_categories', 'tours'));

    }

    public function TourEnquiry(Request $request)
    {
//        return response($request->all());

        if (!is_null($request->tourSlug)) {
            $tour = Tour::where('slug', $request->tourSlug)->first();
        } else {
            $tour = null;
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'date' => $request->start_date,
            'message' => $request->message
        ];

        if (!is_null($tour)) {
            $recipient = 'info@takemetotanzania.com';
            Mail::to($recipient)->send(new EnquireSafari($tour, $data));
            return response(['message' => 'Congrats, your message have been successfully sent. Will please get back the soonest or less than 2Hrs!']);
        } else {
            return response(['message' => 'Sorry, there is an error. Please try again later or contact us directly']);
        }
    }

    public function TailorMadeBooking(Request $request)
    {
        if (!is_null($request->tourID)) {
            $tour = Tour::find($request->tourID);
        } else {
            $tour = null;
        }

        $data = [
            'tourist_count' => $request->count,
            'destinations' => $request->destinations,
            'other_destination' => $request->other_destination,
            'dates' => $request->dates,
            'hotels' => $request->hotels,
            'further_info' => $request->furtherInfo,
            'HowDidYouHearUs' => $request->howDidYouHearUs,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'email_confirm' => $request->email_confirm,
        ];

        $recipient = 'info@takemetotanzania.com';
        Mail::to($recipient)->send(new TailorMadeSafari($tour, $data));

        return response(['message' => 'Congrats, your message have been successfully sent. Will please get back the soonest or less than 2Hrs!']);
    }

    public function toggleFeatured(Request $request, $id)
    {
        $tour = Tour::find($id);

        if (!$tour) {
            return response(['message' => 'Sorry, this tour does not exist or have been move']);
        } else {
            $tour->featured = $request->featureStatus;

            if ($tour->save()) {
                return response(['message' => 'Congratulations, feature status have been successfully changed']);
            }
        }

        return true;
    }

    public function store(Request $request)
    {

        $tour = $request->isMethod('PUT') ? Tour::find($request->id) : new Tour();

        $tour->name = $request->name;
        $tour->seo_title = $request->seo_title;
        $tour->meta_description = $request->meta_description;
        $tour->overview = $request->overview;
        $tour->days = $request->days_count;
        $tour->best_time = $request->best_time;
        $tour->price = $request->price;
        $tour->useful_information = $request->useful_information;

        if($request->hasFile('map')) {
            if ($request->isMethod('PUT') && !is_null($tour->map)) {
                Storage::delete('/public/tour_maps/'.$tour->map);
            }
            $path = $request->map->store('/public/tour_maps');
            $path = explode('/',$path); $map_name = $path[2];
            $tour->map = $map_name;
        }

        if ($request->hasFile('photo')) {
            if ($request->isMethod('PUT') && !is_null($tour->photo)) {
                Storage::delete('/public/tour_photos/'.$tour->photo);
            }
            $path = $request->photo->store('/public/tour_photos');
            $path = explode('/',$path); $filename = $path[2];
            $tour->photo = $filename;
        }

        $tour->save();

        //  add | edit day 2 day content for each tour day description & accommodation
        if (is_array($request->days) && count($request->days)) {
            $days = $request->days;

            for ($i = 0; $i < count($days); $i++) {

                if (isset($days[$i]['day_id']) && !is_null($days[$i]['day_id'])) {

                    $tourDay = d2d::find($days[$i]['day_id']);

                    $tourDay->tour_id = $tour->id;
                    $tourDay->day_order = $days[$i]['day_order'];
                    $tourDay->day_title = $days[$i]['day_title'];
                    $tourDay->day_description = $days[$i]['day_description'];

                    if (!is_null($days[$i]['day_photo1']) && gettype($days[$i]['day_photo1']) !== 'string') {
                        if (!is_null($tourDay->day_photo1)) {
                            Storage::delete('/public/day2day_photos/'.$tourDay->day_photo1);
                        }
                        $path = ($days[$i]['day_photo1'])->store('/public/day2day_photos');
                        $path = explode('/',$path); $dayPhotoFileName1 = $path[2];
                        $tourDay->day_photo1 = $dayPhotoFileName1;
                    } elseif (!is_null($days[$i]['day_photo1']) && gettype($days[$i]['day_photo1']) === 'string') {
                        $tourDay->day_photo1 = $days[$i]['day_photo1'];
                    } else {
                        Storage::delete('/public/day2day_photos/'.$tourDay->day_photo1);
                        $tourDay->day_photo1 = null;
                    }

                    if (!is_null($days[$i]['day_photo2']) && gettype($days[$i]['day_photo2']) !== 'string') {
                        if (!is_null($tourDay->day_photo2)) {
                            Storage::delete('/public/day2day_photos/'.$tourDay->day_photo2);
                        }
                        $path = ($days[$i]['day_photo2'])->store('/public/day2day_photos');
                        $path = explode('/',$path); $dayPhotoFileName2 = $path[2];
                        $tourDay->day_photo2 = $dayPhotoFileName2;
                    } elseif (!is_null($days[$i]['day_photo2']) && gettype($days[$i]['day_photo2']) === 'string') {
                        $tourDay->day_photo2 = $days[$i]['day_photo2'];
                    }else {
                        Storage::delete('/public/day2day_photos/'.$tourDay->day_photo2);
                        $tourDay->day_photo2 = null;
                    }

                    $tourDay->save();

                } else {

                    $tourDay = new d2d;

                    $tourDay->tour_id = $tour->id;
                    $tourDay->day_order = $days[$i]['day_order'];
                    $tourDay->day_title = $days[$i]['day_title'];
                    $tourDay->day_description = $days[$i]['day_description'];

                    if (!is_null($days[$i]['day_photo1'])) {
                        $path = $days[$i]['day_photo1']->store('/public/day2day_photos');
                        $path = explode('/',$path); $dayPhotoFileName1 = $path[2];
                        $tourDay->day_photo1 = $dayPhotoFileName1;
                    }

                    if (!is_null($days[$i]['day_photo2'])) {
                        $path = $days[$i]['day_photo2']->store('/public/day2day_photos');
                        $path = explode('/',$path);
                        $dayPhotoFileName2 = $path[2];
                        $tourDay->day_photo2 = $dayPhotoFileName2;
                    }

                    $tourDay->save();
                }
            }
        }

        // attach / sync chosen tour categories into the saved tour
        if ($request->isMethod('PUT')) {
            // sync the categories
            if (isset($request->existing_categories) && is_array($request->existing_categories) || isset($request->added_categories) && is_array($request->added_categories)) {
                if (isset($request->existing_categories) && isset($request->added_categories)) {
                    $categories = array_unique(array_merge($request->existing_categories, $request->added_categories));
                } elseif (isset($request->existing_categories) && !isset($request->added_categories)) {
                    $categories = $request->existing_categories;
                } elseif (!isset($request->existing_categories) && isset($request->added_categories)) {
                    $categories = $request->added_categories;
                }
                // sync the categories
                $tour->categories()->sync($categories);
            }
        } else {
            if (isset($request->categories) && is_array($request->categories)) {
                // attach the categories
                $tour->categories()->attach($request->categories);
            }
        }

        return new TourResource($tour);
    }


    public function destroy($id)
    {
        // find the tour to delete
        $tour = Tour::findOrFail($id);

        // delete all it's tour days
        foreach ($tour->tour_days as $tour_day) {
            if (!is_null($tour_day->day_photo1)) {
                Storage::delete('/public/day2day_photos/'.$tour_day->day_photo1);
            }
            if (!is_null($tour_day->day_photo2)) {
                Storage::delete('/public/day2day_photos/'.$tour_day->day_photo2);
            }
            $tour_day->delete();
        }

        // delete it's photo if exist
        if (!is_null($tour->photo)) {
            Storage::delete('/public/tour_photos/'.$tour->photo);
        }

        // delete it's map if exist
        if (!is_null($tour->map)) {
            Storage::delete('/public/tour_maps/'.$tour->map);
        }

        // detach all attached tour categories
        $tour->categories()->detach();

        // eventually delete the tour itself
        $tour->delete();

        return new TourResource($tour);
    }
}
