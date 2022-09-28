<?php

namespace App\Http\Controllers;

use App\Models\TourCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourCategoryController extends Controller
{

    public function index()
    {
        $title = 'Tanzania Safaris and Tours';
        return view('front.tour-categories.index', compact('title'));
    }

    public function show($slug)
    {
        $category = TourCategory::where('slug',$slug)->firstOrFail();
        $title = $category->seo_title ? $category->seo_title : $category->name;
        return view('front.tour-categories.show', compact('category','title','seo_title'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $title = 'Listing all Tour Categories';
        return view('admin.tour-categories.all',compact('title'));
    }

    public function add()
    {
        $title = 'Add a new Tour Category';
        return view('admin.tour-categories.add',compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'nullable|string',
            'photo' => 'required|image|min:200|max:600',
        ]);

        $category = new TourCategory;

        $category->name = $request->name;
        $category->special = $request->special !== null ? 1 : 0;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/tour_category_images');
            $path = explode('/',$path);
            $fileName = $path[2];
            $category->photo = $fileName;
        }

        $category->save();

        return redirect('/admin/tour-categories/')->with('success',$category->name.' have been successfully added');
    }

    public function edit($id)
    {
        $category = TourCategory::findOrFail($id);
        $title = 'Edit '.$category->name.' details';
        return view('admin.tour-categories.edit',compact('category','title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|min:200|max:600',
        ]);

        $category = TourCategory::findOrFail($id);

        $category->name = $request->name;
        $category->special = $request->special !== null ? 1 : 0;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;

        if ($request->hasFile('photo')) {
            if (!is_null($category->photo)) {
                Storage::delete('/public/tour_category_photos/'.$category->photo);
            }
            $path = $request->file('photo')->store('/public/tour_category_images');
            $path = explode('/',$path);
            $fileName = $path[2];
            $category->photo = $fileName;
        }

        $category->save();

        return redirect('/admin/tour-categories')->with('success',$category->name.' have been successfully updated');
    }

    public function remove($id)
    {
        $category = TourCategory::findOrFail($id);

        if ($category->tours->count()) {
            return back()->with('error', $category->name.' category have '.$category->tours->count().' tour package(s) attached, please move those package(s) to other tour category / categories to proceed ');
        }

        $category->delete();

        return redirect('/admin/tour-categories')->with('success', $category->name.' have been successfully removed');
    }
}

