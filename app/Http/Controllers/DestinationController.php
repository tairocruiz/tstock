<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\TourCategory;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function show($slug)
    {
        $destination = Destination::firstWhere('slug', $slug);
        $title = $destination->seo_title? $destination->seo_title : $destination->name;
        $destination_categories = DestinationCategory::all();
        $pages = Page::all();
        $tour_categories = TourCategory::all();
    
        return view('front.destinations.show', compact('destination', 'title', 'destination_categories', 'pages', 'tour_categories'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function add()
    {
        $title = 'Add New Destination';
        return view('admin.destinations.add',compact('title'));
    }

    public function index()
    {
        $title = 'Listing all Destinations';
        return view('admin.destinations.all',compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'seo_title' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'required|string',
            'category' => 'required|numeric',
            'photo' => 'required|image|max:1000',
        ]);

        $destination = new Destination;

        $destination->name = $request->name;
        $destination->destination_category_id = $request->category;
        $destination->seo_title = $request->seo_title;
        $destination->meta_description = $request->meta_description;
        $destination->description = $request->description;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/destination_images');
            $path = explode('/',$path);
            $imageName = $path[2];
            $destination->photo = $imageName;
        }

        $destination->save();

        return redirect('/admin/places/')->with('success', $destination->name.' have been successfully added as a new Destination');
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $title = 'Edit '.$destination->name.' details';
        return view('admin.destinations.edit',compact('destination','title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'seo_title' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'required|string',
            'category' => 'required|numeric',
            'photo' => 'image|max:1000',
        ]);

        $destination = Destination::findOrFail($id);

        $destination->name = $request->name;
        $destination->destination_category_id = $request->category;
        $destination->seo_title = $request->seo_title;
        $destination->meta_description = $request->meta_description;
        $destination->description = $request->description;

        if ($request->hasFile('photo')) {
            if (!is_null($destination->photo)) {
                Storage::delete('/public/destination_images/'.$destination->photo);
            }
            $path = $request->file('photo')->store('/public/destination_images');
            $path = explode('/',$path);
            $imageName = $path[2];
            $destination->photo = $imageName;
        }

        $destination->save();

        return redirect('/admin/places/')->with('success', $destination->name.' have been successfully updated');
    }

    public function remove($id)
    {
        $destination = Destination::findOrFail($id);
        if (!is_null($destination->photo)) {
            Storage::delete('/public/destination_images/'.$destination->photo);
        }
        $destination->delete();

        return redirect('/admin/places/')->with('success', $destination->name.' have been successfully removed');
    }
}
