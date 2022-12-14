<?php

namespace App\Http\Controllers;

use App\Mail\SafariBooked;
use Illuminate\Support\Facades\Mail;
use App\Models\Page;
use App\Models\TourCategory;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\Post;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function home()
    {
        $title = 'Tanzania Safari Tours - Take Me To Tanzania Adventure Safaris';
        $tour_categories = TourCategory::all();
        $tours = Tour::all();
        $pages = Page::all();
        $posts = Post::all();
        $destinations = Destination::all();
        $destination_categories = DestinationCategory::all();
        //str_limit($value, 100);
        return view('front.pages.home', compact('title', 'posts', 'tour_categories', 'tours', 'destinations', 'pages', 'destination_categories'));
    }

    public function show($slug)
    {
        $page = Page::where('slug',$slug)->firstOrFail();
        $pages = Page::all();
        $tour_categories = TourCategory::all();
        $destination_categories = DestinationCategory::all();
        $title = $page->seo_title? $page->seo_title : $page->name;

        return view('front.pages.show', compact('page','title', 'pages', 'tour_categories', 'destination_categories'));
    }

    public function contacts(Request $request)
    {
        $id = $request->id;
        $tours = Tour::all();
        $pages = Page::all();
        $tour_categories = TourCategory::all();
        $destination_categories = DestinationCategory::all();

        if (!is_null($id)) {
            $booked_tour = Tour::findOrFail($id);
            $title = 'Book your Safari - '.$booked_tour->name;
            return view('front.pages.contacts', compact('title', 'destination_categories', 'booked_tour', 'tour_categories', 'tours', 'pages'));
        } else {
            $title = 'Contact us for your Tanzania Safari';
            return view('front.pages.contacts', compact('title', 'destination_categories', 'tours', 'pages', 'tour_categories'));
        }
    }

    public function booking(Request $request)
    {

        $tour_id = $request->tour_id;
        $tour = Tour::findOrFail($tour_id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'enquiry' => $request->enquiry,
        ];

        $recipient = 'info@takemetotanzania.com';
        Mail::to($recipient)->send(new SafariBooked($tour, $data));

        return redirect('/safari/contacts')->with('success','Success! your message have been successfully sent to us. We will get back to you in 3 Hrs time!');

    }

    //------------------------------------------------------------------------------------------------------------------

    public function all()
    {
        $title = 'Listing all Pages';
        return view('admin.pages.all', compact('title'));
    }

    public function add()
    {
        $title = 'Add a new Page';
        return view('admin.pages.add', compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'required',
            'photo' => 'required|image|min:100|max:500',
        ]);

        $page = new Page;

        $page->name = $request->name;
        $page->seo_title = $request->seo_title;
        $page->meta_description = $request->meta_description;
        $page->description = $request->description;
        $page->resource = $request->resource == null ? 0 : 1;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/page_images');
            $path = explode('/',$path);
            $fileName = $path[2];
            $page->photo = $fileName;
        }

        $page->save();

        return redirect('/admin/pages')->with('success', $page->name.' have been successfully added as a new Page');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $title = 'Edit '.$page->name.' details';

        return view('admin.pages.edit',compact('page','title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|required|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'required',
            'photo' => 'image|min:100|max:500',
        ]);

        $page = Page::findOrFail($id);

        $page->name = $request->name;
        $page->seo_title = $request->seo_title;
        $page->meta_description = $request->meta_description;
        $page->description = $request->description;
        $page->resource = $request->resource == null ? 0 : 1;

        if ($request->hasFile('photo')) {
            if (!is_null($page->photo)) {
                Storage::delete('/public/page_images/'.$page->photo);
            }
            $path = $request->file('photo')->store('/public/page_images');
            $path = explode('/',$path);
            $fileName = $path[2];
            $page->photo = $fileName;
        }

        $page->save();

        return redirect('/admin/pages')->with('success', $page->name.' have been successfully updated');
    }

    public function remove($id)
    {
        $page = Page::findOrFail($id);
        if (!is_null($page->photo)) {
            Storage::delete('/public/page_images/'.$page->photo);
        }

        $page->delete();

        return redirect('/admin/pages')->with('success', $page->name.' have been successfully deleted');
    }
}
