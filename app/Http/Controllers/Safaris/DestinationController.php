<?php

namespace App\Http\Controllers\Safaris;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use App\Http\Requests\DestinationStoreRequest;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listing all Destinations';
        $destinations = Destination::all();
        return view('admin.destinations.all',compact('title', 'destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add New Destination';
        $destination_categories = DestinationCategory::all();
        $destinations = Destination::all();
        return view('admin.destinations.add',compact('title', 'destination_categories', 'destinations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationStoreRequest $request, Destination $destination)
    {
        //$destination->create($request->all());
        $this->WekaPicha($request, 'destination_images');
        $request->photo = $this->image;

        $destination->name = $request->name;
        $destination->destination_category_id = $request->category_id;
        $destination->seo_title = $request->seo_title;
        $destination->meta_description = $request->meta_description;
        $destination->description = $request->description;
        $destination->photo = $request->photo;
        
        $destination->save();

        return redirect()->route('admin.places.index')->with('message', 'Destination created successfully');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
}
