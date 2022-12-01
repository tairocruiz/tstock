<?php

namespace App\Http\Controllers\Safaris;

use App\Http\Resources\TourCategoryResource;
use App\Models\TourCategory;
use App\Models\Destinationcategory;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TourCategoryController extends Controller
{

    public function index()
    {
        $title = 'Tanzania Safaris and Tours';
        $tour_categories = TourCategory::all();
        $pages = Page::all();
        $destination_categories = DestinationCategory::all();
        return view('admin.tour-categories.all', compact('title', 'tour_categories', 'pages', 'destination_categories'));
    }

    public function show($slug)
    {
        $category = TourCategory::where('slug',$slug)->firstOrFail();
        $title = $category->seo_title ? $category->seo_title : $category->name;
        return view('front.tour-categories.show', compact('category','title'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $title = 'Listing all Tour Categories';
        return view('admin.tour-categories.all',compact('title'));
    }

    public function all4api()
    {
        $tour_categories = TourCategory::all();
        return TourCategoryResource::collection($tour_categories);
    }

    public function create()
    {
        $title = 'Add a new Tour Category';
        $tour_categories = TourCategory::all();
        return view('admin.tour-categories.add',compact('title', 'tour_categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'nullable|string',
            'photo' => 'required|image',
            'icon' => 'nullable|image|max:300',
        ]);

        $category = new TourCategory;

        $category->name = $request->name;
        $category->slug = str_replace(' ', '-', strtolower($request->name));
        $category->special = $request->special !== null ? 1 : 0;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;

        $this->WekaPicha($request, 'tour_category_images', 'photo');
        $request->photo = $this->image;
        $category->photo = $request->photo;

        $this->WekaPicha($request, 'tour_category_icons', 'icon');
        $request->icon = $this->icon;
        $category->icon = $request->icon;

        $category->save();

        return redirect('/admin/tour-categories/')->with('success',$category->name.' have been successfully added');
    }

    public function edit($id)
    {
        $category = TourCategory::findOrFail($id);
        $title = 'Edit '.$category->name.' details';
        $tour_categories = TourCategory::all();
        return view('admin.tour-categories.edit',compact('category','title', 'tour_categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|min:200|max:600',
            'icon' => 'nullable|image',
        ]);

        $category = TourCategory::findOrFail($id);

        $category->name = $request->name;
        $category->special = $request->special !== null ? 1 : 0;
        $category->seo_title = $request->seo_title;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;

        if(!empty($request->photo)){
            if (!empty($category->photo)){
                if( file_exists ( public_path('images/tour_category_images/'.$category->photo) ) ){
                    unlink ( public_path('images/tour_category_images/'.$category->photo) );
                }
            }

            $this->WekaPicha($request, 'tour_category_images', 'photo');
            $request->photo = $this->image;
            $category->photo = $request->photo;
        }

        if(!empty($request->icon)){
            if (!empty($category->icon)){
                if( file_exists ( public_path('images/tour_category_icons/'.$category->icon) ) ){
                    unlink ( public_path('images/tour_category_icons/'.$category->icon) );
                }
            }

            $this->WekaPicha($request, 'tour_category_icons', 'icon');
            $request->icon = $this->icon;
            $category->icon = $request->icon;
        }

        $category->save();

        return redirect('/admin/tour-categories')->with('success',$category->name.' have been successfully updated');
    }

    public function destroy($id)
    {
        $category = TourCategory::findOrFail($id);
        if (!is_null($category->photo)) {
            unlink ( public_path('images/tour_category_images/'.$category->photo) );
        }
        if (!is_null($category->icon)) {
            unlink ( public_path('images/tour_category_icons/'.$category->icon) );
        }

        if ($category->tours->count()) {
            return back()->with('error', $category->name.' category have '.$category->tours->count().' tour package(s) attached, please move those package(s) to other tour category / categories to proceed ');
        }

        $category->delete();

        return redirect('/admin/tour-categories')->with('success', $category->name.' have been successfully removed');
    }
}
