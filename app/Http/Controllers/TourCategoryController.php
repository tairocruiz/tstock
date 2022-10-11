<?php

namespace App\Http\Controllers;

use App\Models\TourCategory;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Page;
use App\Models\DestinationCategory;
use App\Http\Requests\TourCategoryStoreRequest;
use Illuminate\Support\Facades\Storage;

class TourCategoryController extends Controller
{

    public function index()
    {
        $title = 'Tanzania Safaris and Tours';
        $tour_categories = TourCategory::all();
        $tours = Tour::all();
        $pages = Page::all();
        $destination_categories = DestinationCategory::all();
        return view('front.tour-categories.index', compact('title', 'tour_categories', 'tours', 'destination_categories', 'pages'));
    }

    public function show($slug)
    {
        $tour_category = TourCategory::firstWhere('slug', $slug);
        $title = $tour_category->seo_title ? $tour_category->seo_title : $tour_category->name;
        $tour_categories = TourCategory::all();
        $pages = Page::all();
        $destination_categories = DestinationCategory::all();
        return view('front.tour-categories.show', compact('tour_category', 'title', 'tour_categories', 'pages', 'destination_categories'));
        //return 'aman at TourCategory::show';
    }

    //------------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $title = 'Listing all Tour Categories';
        $tour_categories = TourCategory::all();
        return view('admin.tour-categories.all',compact('title', 'tour_categories'));
    }

    public function create()
    {
        $title = 'Add a new Tour Category';
        $tour_categories = TourCategory::all();
        return view('admin.tour-categories.add',compact('title', 'tour_categories'));
    }

    public function store(TourCategoryStoreRequest $request)
    {
        /*$category = new TourCategory;

        $category->name = $request->name;
        $category->special = $request->special !== null ? 1 : 0;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;*/

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/tour_category_images');
            $path = explode('/',$path);
            $fileName = $path[2];

            //$category->photo = $fileName;
            TourCategory::create([
                'name' => $request->name,
                'special' => $request->special,
                'seo_title' => $request->seo_title,
                'meta_description' => $request->meta_description,
                'description' => $request->description,
                'photo' => $request->photo,
                'slug' => $request->slug,
            ]);

            return redirect()->route('admin.tour-categories')->with('message', 'Tour added Successful');
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

            return redirect()->route('tour-categories.index')->with('message', 'Tour added Successful');
        }
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

