<?php

namespace App\Http\Controllers\Safaris;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    public function index()
    {
        $title = 'View our differentiated Tanzania Safari Tour Photos';
        return view('front.photos.gallery',compact('title'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $title = 'Listing all photos';
        return view('admin.photos.all',compact('title'));
    }

    public function add()
    {
        $title = 'Add a new photo';
        return view('admin.photos.add',compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:170',
            'photo' => 'required|image|max:500',
        ]);

        $photo = new Photo();

        $photo->name = $request->name;
        $photo->description = $request->description;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/gallery_photos');
            $path = explode('/',$path);
            $filename = $path[2];
            $photo->photo = $filename;
        }

        $photo->save();

        return redirect('/admin/photos')->with('success', 'New Photo named '.$photo->name.' have been successfully added');
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $title = 'Edit '.$photo->name.' details';
        return view('admin.photos.edit',compact('photo','title'));
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
        if ($request->hasFile('photo')) {
            if (!is_null($photo->photo)) {
                Storage::delete('/public/gallery_photos/'.$photo->photo);
            }
            $path = $request->file('photo')->store('/public/gallery_photos');
            $path = explode('/',$path);
            $filename = $path[2];
            $photo->photo = $filename;
        }

        $photo->save();

        return redirect('/admin/photos')->with('success', 'New Photo named '.$photo->name.' have been successfully updated');
    }

    public function remove($id)
    {
        $photo = Photo::findOrFail($id);
        if (!is_null($photo->photo)) {
            Storage::delete('/public/gallery_photos/'.$photo->photo);
        }
        $photo->delete();

        return redirect('/admin/photos')->with('success', 'Photo named '.$photo->name.' have been successfully deleted');
    }
}
