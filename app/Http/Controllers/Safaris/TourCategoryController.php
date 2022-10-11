<?php

namespace App\Http\Controllers\Safaris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourCategory;
use App\Http\Requests\TourCategoryStoreRequest;

class TourCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listing all Tour Categories';
        $tour_categories = TourCategory::all();
        return view('admin.tour-categories.all',compact('title', 'tour_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add a new Tour Category';
        $tour_categories = TourCategory::all();
        return view('admin.tour-categories.add',compact('title', 'tour_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourCategoryStoreRequest $request/*, TourCategory $category*/)
    {
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/tour_category_images');
            $path = explode('/',$path);
            $fileName = $path[2];
            //$category->create($request->all());
            //$category->photo = $fileName;
            TourCategory::create([
                'name' => $request->name,
                'special' => $request->special,
                'seo_title' => $request->seo_title,
                'meta_description' => $request->meta_description,
                'description' => $request->description,
                'photo' => $fileName,
                'slug' => $request->slug,
            ]);

            return redirect()->route('admin.tour_categories.index')->with('message', 'Category Created successfully');
        }else{

            TourCategory::create([
                'name' => $request->name,
                'special' => $request->special,
                'seo_title' => $request->seo_title,
                'meta_description' => $request->meta_description,
                'description' => $request->description,
                'photo' => $request->photo,
                'slug' => $request->slug,
            ]);

            return redirect()->route('admin.tour_categories.index')->with('message', 'Tour added Successful');
        }
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
    public function edit(TourCategory $tour_category)
    {
        $tour_categories = TourCategory::all();
        $title = 'Edit '.$tour_category->name.' details';
        return view('admin.tour-categories.edit', compact('tour_category', 'title', 'tour_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourCategoryStoreRequest $request, TourCategory $tour_category)
    {
        $tour_category->update($request->all());
        return redirect()->route('admin.tour_categories.index')->with('message', 'Tour category - '.$tour_category->name.' Updated Successful');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourCategory $tour_category)
    {
        $tour_category->delete();

        return redirect()
            ->route('admin.tour_categories.index')
            ->with('message', 'Category successfully deleted.');
    }
}
