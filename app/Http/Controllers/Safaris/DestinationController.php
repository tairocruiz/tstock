<?php

namespace App\Http\Controllers\Safaris;

use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
{
//    public function index()
//    {
//        $title = 'Tanzania Destinations - Best Places to Visit in Tanzania';
//        return view('front.destinations.index', compact('title'));
//    }

    public function show($slug)
    {
        $destination = Destination::where('slug',$slug)->firstOrFail();
        $title = $destination->seo_title? $destination->seo_title : $destination->name;
        return view('front.destinations.show', compact('destination','title'));
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

    public function index()
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
            'photo' => 'required|image',
        ]);

        $destination = new Destination;

        $destination->name = $request->name;
        $destination->slug = str_replace(' ', '_', strtolower($request->name));//strtolower($request->name)
        $destination->destination_category_id = $request->category;
        $destination->seo_title = $request->seo_title;
        $destination->meta_description = $request->meta_description;
        $destination->description = $request->description;

        // if (!empty($request->photo)) {
        //     $path = $request->file('photo')->store('/public/destination_images/');
        //     $path = explode('/',$path);
        //     $imageName = $path[2];
        //     $destination->photo = $imageName;
        // }
        $this->WekaPicha($request, 'destination_images', 'photo');
        $request->photo = $this->image;
        $destination->photo = $request->photo;

        $destination->save();

        return redirect('/admin/places/')->with('success', $destination->name.' have been successfully added as a new Destination');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $title = 'Edit '.$destination->name.' details';
        $destination_categories = DestinationCategory::all();
        $destinations = Destination::all();
        return view('admin.destinations.edit', compact('destination','title', 'destination_categories', 'destinations'));
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
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'seo_title' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'required|string',
            'category' => 'required|numeric',
            'photo' => 'image',
        ]);

        $destination = Destination::findOrFail($id);

        $destination->name = $request->name;
        $destination->destination_category_id = $request->category;
        $destination->seo_title = $request->seo_title;
        $destination->meta_description = $request->meta_description;
        $destination->description = $request->description;


        if(!empty($request->photo)){
            if (!empty($destination->photo)){
                if( file_exists ( public_path('images/destination_images/'.$destination->photo) ) ){
                    unlink ( public_path('images/destination_images/'.$destination->photo) );
                }
            }

            $this->WekaPicha($request, 'destination_images');
            $request->photo = $this->image;
            $destination->photo = $request->photo;
        }

        $destination->save();

        return redirect('/admin/places/')->with('success', $destination->name.' have been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        if (!is_null($destination->photo)) {
            unlink ( public_path('images/destination_images/'.$destination->photo) );
        }
        $destination->delete();

        return redirect('/admin/places/')->with('success', $destination->name.' have been successfully removed');
    }
}
