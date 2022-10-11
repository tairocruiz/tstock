<?php

namespace App\Http\Controllers\Safaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourCategory;
use App\Models\Page;
use App\Models\DestinationCategory;
use App\Models\Tour;
use App\Http\Requests\TourStoreRequest;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tanzania Safaris & Tours';
        $tour_categories = TourCategory::all();
        $tours = Tour::all();
        $pages = Page::all();
        $destination_categories = DestinationCategory::all();
        return view('admin.tours.all', compact('title', 'tour_categories', 'tours', 'pages', 'destination_categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add a new Tour package';
        $tour_categories = TourCategory::all();
        $tours = Tour::all();
        return view('admin.tours.add', compact('title', 'tour_categories', 'tours'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourStoreRequest $request)
    {
        $this->WekaPicha($request, 'tours_images');
        Tour::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'meta_description' => $request->meta_description,
            'photo' => $request->photo,
            'price' => $request->price,
            'days' => $request->days,
            'best_time' => $request->best_time,
            'tour_category_id' => $request->categories,
        ]);

        return redirect()->route('admin.tours.index')->with('message', 'Tour added Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        $title = 'Edit '.$tour->name.' details';
        $tour_categories = TourCategory::all();
        $tours = Tour::all();
        return view('admin.tours.edit', compact('tour','title', 'tour_categories', 'tours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourStoreRequest $request, Tour $tour)
    {

       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //testing the mighty resource additonal method
    public function aman(){
        $title = 'Tanzania Safaris & Tours';
        $tour_categories = TourCategory::all();
        $tours = Tour::all();
        $pages = Page::all();
        $destination_categories = DestinationCategory::all();
        return view('admin.tours.all', compact('title', 'tour_categories', 'tours', 'pages', 'destination_categories'));
    }

}
