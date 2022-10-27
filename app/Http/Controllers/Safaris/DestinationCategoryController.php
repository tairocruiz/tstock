<?php

namespace App\Http\Controllers\Safaris;

use App\Models\DestinationCategory;
use App\Http\Resources\DestinationCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class DestinationCategoryController extends Controller
{
    public function index()
    {
        $title = 'Tanzania Best Places To Go - Tanzania Destinations';
        return view('front.destination-categories.index', compact('title'));
    }

    public function all4api()
    {
        $destination_categories = DestinationCategory::with('destinations')->get();
        return DestinationCategoryResource::collection($destination_categories);
    }

    public function show($slug)
    {
        $category = DestinationCategory::where('slug',$slug)->firstOrFail();
        $title = $category->seo_title? $category->seo_title : $category->name;

        return view('front.destination-categories.show', compact('category','title'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $title = 'List all Destination Categories';
        return view('admin.destination-categories.all', compact('title'));
    }

    public function add()
    {
        $title = 'Add a new Destination Category';
        return view('admin.destination-categories.add', compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'nullable',
            'photo' => 'required|image|max:500|min:200',
        ]);

        $category = new DestinationCategory;

        $category->name = $request->name;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/destination_category_images');
            $path = explode('/',$path);
            $fileName = $path[2];
            $category->photo = $fileName;
        }

        $category->save();

        return redirect('/admin/destination-categories')->with('success', $category->name.' have been successfully added');
    }

    public function edit($id)
    {
        $category = DestinationCategory::findOrFail($id);
        $title = 'Edit '.$category->name.' details';

        return view('admin.destination-categories.edit', compact('category','title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'nullable',
            'photo' => 'nullable|image|max:500|min:200',
        ]);

        $category = DestinationCategory::findOrFail($id);

        $category->name = $request->name;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;

        if ($request->hasFile('photo')) {
            if (!is_null($category->photo)) {
                Storage::delete('/public/destination_category_images/'.$category->photo);
            }
            $path = $request->file('photo')->store('/public/destination_category_images');
            $path = explode('/',$path);
            $fileName = $path[2];
            $category->photo = $fileName;
        }

        $category->save();

        return redirect('/admin/destination-categories')->with('success', $category->name.' have been successfully updated');
    }

    public function remove($id)
    {
        $category = DestinationCategory::findOrFail($id);

        if (!is_null($category->photo)) {
            Storage::delete('/public/destination_category_images/'.$category->photo);
        }

        $category->delete();

        return redirect('/admin/destination-categories')->with('success', $category->name.' have been successfully deleted');
    }
}
