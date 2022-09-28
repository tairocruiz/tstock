<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{

    public function index()
    {
        $title = 'Tanzania Safaris & Tours';
        return view('front.tours.index', compact('title'));
    }

    public function show($slug)
    {
        $tour = Tour::where('slug',$slug)->firstOrFail();
//        $title = $tour->name; $seo_title = $tour->seo_title;
        $title = $tour->seo_title? $tour->seo_title : $tour->name;

        return view('front.tours.show', compact('tour','title'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $title = 'Listing all Tours';
        $tours = Tour::all();
        return view('admin.tours.all', compact('title', 'tours'));
    }

    public function add()
    {
        $title = 'Add a new Tour package';
        return view('admin.tours.add', compact('title'));
        //route()
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'days' => 'required|numeric|max:99',
            'best_time' => 'nullable|string|max:100',
            'price' => 'nullable|numeric',
            'description' => 'required',
            'photo' => 'required|image|max:1000',
            'categories' => 'required|array',
        ]);

        $tour = new Tour;

        $tour->name = $request->name;
        $tour->seo_title = $request->seo_title;
        $tour->meta_description = $request->meta_description;
        $tour->days = $request->days;
        $tour->best_time = $request->best_time;
        $tour->price = $request->price;
        $tour->description = $request->description;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/tour_images');
            $path = explode('/',$path);
            $imageName = $path[2];
            $tour->photo = $imageName;
        }

        if (!is_null($request->categories)) {
            $categories = $request->categories;
        }

        $tour->save();

        $tour->categories()->attach($categories);

        return redirect('/admin/tours')->with('success', $tour->name.' have been successfully added as a new tour package');
    }

    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        $title = 'Edit '.$tour->name.' details';

        return view('admin.tours.edit', compact('tour','title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'days' => 'required|numeric|max:99',
            'best_time' => 'nullable|string|max:100',
            'price' => 'nullable|numeric',
            'description' => 'required',
            'photo' => 'image|max:1000',
            'tour_categories' => 'array',
            'added_categories' => 'array',
        ]);

        $tour = Tour::findOrFail($id);

        $tour->name = $request->name;
        $tour->seo_title = $request->seo_title;
        $tour->meta_description = $request->meta_description;
        $tour->days = $request->days;
        $tour->best_time = $request->best_time;
        $tour->price = $request->price;
        $tour->description = $request->description;

        if ($request->hasFile('photo')) {
            if (!is_null($tour->photo)) {
                Storage::delete('/public/tour_images/'.$tour->photo);
            }
            $path = $request->file('photo')->store('/public/tour_images');
            $path = explode('/',$path);
            $imageName = $path[2];
            $tour->photo = $imageName;
        }

        if (!is_null($request->tour_categories) && !is_null($request->added_categories)) {
            $categories = array_unique(array_merge($request->tour_categories, $request->added_categories));
        } elseif (!is_null($request->tour_categories) && is_null($request->added_categories)) {
            $categories = $request->tour_categories;
        } elseif (is_null($request->tour_categories) && !is_null($request->added_categories)) {
            $categories = $request->added_categories;
        } else $categories = null;

        if (!is_null($categories)) {
            $tour->categories()->sync($categories);
        } else {
            return back()->with('error', 'Please choose related tour category / categories to proceed');
        }

        $tour->save();

        return redirect('/admin/tours')->with('success', $tour->name.' have been successfully added as a new tour package');
    }

    public function remove($id)
    {
        $tour = Tour::findOrFail($id);

        if (!is_null($tour->photo)) {
            Storage::delete('/public/tour_images/'.$tour->photo);
        }

        $tour->categories()->detach();

        $tour->delete();

        return redirect('/admin/tours')->with('success', $tour->name.' have been successfully removed');
    }
}