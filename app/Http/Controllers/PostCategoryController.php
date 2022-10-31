<?php

namespace App\Http\Controllers;

use App\Models\DestinationCategory;
use App\Models\PostCategory;
use App\Models\Tour;
use App\Models\Page;
use App\Models\TourCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostCategoryController extends Controller
{

    // //public $pages = Page::all();
    // public $compact = ['pages', 'posts', 'tours', 'destinations', 'destination_categories'];

    // public function setModelToReturnAll($model)
    // {
    //     $model = "App\\Models\\$model";
    //     return $model::all();
    // }

    // public function getModel()
    // {
    //     for ($lp = 0; $lp < sizeof($this->compact); $lp++) {
    //         if(strpos('_', $lp)) {
    //             $pr = explode('_', $lp);
    //             $name = $pr[1];
    //             $this->compact[$lp] = $this->setModelToReturnAll(ucfirst(Str::singular($this->compact[$name])));
    //         }else if(strpos('_', $lp) != true){
    //             $pr = explode('_');
    //             $name = $pr[0];
    //             $this->compact[$lp] = $this->setModelToReturnAll(ucfirst(Str::singular($this->compact[$name])));
    //         }
    //     }
    // }

    public function index()
    {
        $title = 'Tanzania Tourism Blog - News, Events and Articles';
        $post_categories = PostCategory::all();
        $tours = Tour::all();
        $pages = Page::all();
        $tour_categories = TourCategory::all();
        $destination_categories = DestinationCategory::all();
        //$this->getModel();
        return view('front.post-categories.index',compact('title', 'tour_categories', 'destination_categories', 'tours', 'post_categories', 'pages'));
    }

    public function show($slug)
    {
        $category = PostCategory::where('slug',$slug)->firstOrFail();
        $title = $category->seo_title ? $category->seo_title : $category->name;
        $tour_categories = TourCategory::all();
        $pages = Page::all();
        $destination_categories = DestinationCategory::all();
        return view('front.post-categories.show',compact('category','title', 'destination_categories','tour_categories', 'pages'));
    }

    // -----------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $title = 'Listing all Post Categories';
        return view('admin.post-categories.all',compact('title'));
    }

    public function add()
    {
        $title = 'Add new Post Category';
        return view('admin.post-categories.add',compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string',
            'description' => 'required|string',
            'photo' => 'required|image|max:500',
        ]);

        $category = new PostCategory;

        $category->name = $request->name;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/post_category_images');
            $path = explode('/',$path);
            $filename = $path[2];
            $category->photo = $filename;
        }

        $category->save();

        return redirect('/admin/post-categories')->with('success', 'New Post Category have been created');
    }

    public function edit($id)
    {
        $category = PostCategory::findOrFail($id);
        $title = 'Edit '.$category->name.' details';

        return view('admin.post-categories.edit',compact('category','title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:500',
        ]);

        $category = PostCategory::findOrFail($id);

        $category->name = $request->name;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;

        if ($request->hasFile('photo')) {
            if (!is_null($category->photo)) {
                Storage::delete('/public/post_category_images/'.$category->photo);
            }
            $path = $request->file('photo')->store('/public/post_category_images');
            $path = explode('/',$path);
            $filename = $path[2];
            $category->photo = $filename;
        }

        $category->save();

        return redirect('/admin/post-categories')->with('success', 'This Post Category have been successfully updated');
    }

    public function remove($id)
    {
        $category = PostCategory::findOrFail($id);

        if ($category->posts->count()) {
            return back()->with('error', 'Sorry, this Category have some posts attached. Please move them to other categories to proceed');
        } else {
            if (!is_null($category->photo)) {
                Storage::delete('/public/post_category_images/'.$category->photo);
            }
            $category->delete();
            return redirect('/admin/post-categories')->with('success', 'Category have have been successfully removed/deleted');
        }
    }
}
