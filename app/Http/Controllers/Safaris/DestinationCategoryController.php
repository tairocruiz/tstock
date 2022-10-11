<?php

namespace App\Http\Controllers\Safaris;

use App\Http\Controllers\Controller;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use App\Http\Requests\DestinationCategoryStoreRequest;

class DestinationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List all Destination Categories';
        $destination_categories = DestinationCategory::all();
        return view('admin.destination-categories.all', compact('title', 'destination_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add a new Destination Category';
        $destination_categories = DestinationCategory::all();
        return view('admin.destination-categories.add', compact('title', 'destination_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationCategoryStoreRequest $request, DestinationCategory $destinationCategory)
    {
        $this->WekaPicha($request, 'destination_category_images');
        $request->photo = $this->image;
        //$destinationCategory->create($request->all());
       // $category = new DestinationCategory;

        $destinationCategory->name = $request->name;
        $destinationCategory->seo_title = $request->seo_title;
        $destinationCategory->meta_description = $request->meta_description;
        $destinationCategory->description = $request->description;
        $destinationCategory->photo = $request->photo;
        $destinationCategory->save();
        return redirect()->route('admin.destination_categories.index')->with('message', 'Destination Category created successfully');
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
    public function edit(DestinationCategory $destinationCategory)
    {
        $title = 'Edit '.$destinationCategory->name.' details';
        $destination_categories = DestinationCategory::all();
        return view('admin.destination-categories.edit', compact('destinationCategory', 'title', 'destination_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DestinationCategoryStoreRequest $request, DestinationCategory $destinationCategory)
    {
        $destinationCategory->update($request->all());
        return redirect()->route('admin.destination_categories.index')->with('message', 'Destination category updated Successfully');
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
