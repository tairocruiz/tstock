<?php

namespace App\Http\Controllers\Safaris;

use App\Models\Photo;
use App\Models\Page;
use App\Models\TourCategory;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    public function index()
    {
        $title = 'View our differentiated Tanzania Safari Tour Photos';
        $photos = Photo::all();
        $pages = Page::all();
        $tour_categories = TourCategory::all();
        $destination_categories = DestinationCategory::all();
        return view('admin.photos.all', compact('title', 'photos', 'pages', 'tour_categories', 'destination_categories'));
    }

    public function create()
    {
        $title = 'Add a new photo';
        $photos = Photo::all();
        return view('admin.photos.add', compact('title', 'photos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:170',
            'photo' => 'required|image',
        ]);

        $photo = new Photo();

        $photo->name = $request->name;
        $photo->description = $request->description;

        $this->WekaPicha($request, 'gallery_photos', 'photo');
        $request->photo = $this->image;
        $photo->photo = $request->photo;

        $photo->save();

        return redirect('/admin/photos')->with('success', 'New Photo named '.$photo->name.' have been successfully added');
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $title = 'Edit '.$photo->name.' details';
        $photos = Photo::all();
        return view('admin.photos.edit',compact('photo','title', 'photos'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:170',
            'photo' => 'image|max:500',
        ]);

        $photo = Photo::findOrFail($id);

        $photo->name = $request->name;
        $photo->description = $request->description;
        if(!empty($request->photo)){
            if (!empty($photo->photo)){
                if( file_exists ( public_path('images/gallery_photos/'.$photo->photo) ) ){
                    unlink ( public_path('images/gallery_photos/'.$photo->photo) );
                }
            }

            $this->WekaPicha($request, 'gallery_photos', 'photo');
            $request->photo = $this->image;
            $photo->photo = $request->photo;
        }

        $photo->save();

        return redirect('/admin/photos')->with('success', 'New Photo named '.$photo->name.' have been successfully updated');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        if (!is_null($photo->photo)) {
            unlink ( public_path('images/gallery_photos/'.$photo->photo) );
        }
        $photo->delete();

        return redirect('/admin/photos')->with('success', 'Photo named '.$photo->name.' have been successfully deleted');
    }
}
