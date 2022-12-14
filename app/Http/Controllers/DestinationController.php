<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Page;
use App\Models\TourCategory;
use Illuminate\Http\Request;
use App\Models\DestinationCategory;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
//    public function index()
//    {
//        $title = 'Tanzania Destinations - Best Places to Visit in Tanzania';
//        return view('front.destinations.index', compact('title'));
//    }

    public function show($slug)
    {
        $destination = Destination::firstWhere('slug',$slug);
        $pages = Page::all();
        $tour_categories = TourCategory::all();
        $title = $destination->seo_title? $destination->seo_title : $destination->name;
        $destination_categories = DestinationCategory::all();
        return view('front.destinations.show', compact('destination', 'tour_categories','title', 'pages', 'destination_categories'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function add()
    {
        $title = 'Add New Destination';
        return view('admin.destinations.add',compact('title'));
    }

    public function all()
    {
        $title = 'Listing all Destinations';
        $destinations = Destination::all();
        return view('admin.destinations.all',compact('title', 'destinations'));
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
