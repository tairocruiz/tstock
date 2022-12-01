<?php

namespace App\Http\Controllers\Safaris;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\TourCategory;

class PostController extends Controller
{

    public function show($categorySlug, $postSlug)
    {
        $post = Post::where('slug',$postSlug)->firstOrFail();
        $category = PostCategory::where('slug',$categorySlug)->firstOrFail();
        $title = $post->seo_title ? $post->seo_title : $post->title;
        return view('front.posts.show',compact('post','category','title'));
    }

    // -----------------------------------------------------------------------------------------------------------------

    public function index()
    {
        $title = 'Listing all Posts';
        $posts = Post::all();
        return view('admin.posts.all',compact('title', 'posts'));
    }

    public function create()
    {
        $title = 'Add a new Blog Post';
        $post_categories = PostCategory::all();
        $posts = Post::all();
        return view('admin.posts.add',compact('title', 'post_categories', 'posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'required|string',
            'photo' => 'required|image',
            'categories' => 'required|array',
        ]);

        $post = new Post;

        $post->title = $request->name;
        $post->slug = str_replace(' ', '-', strtolower($request->name));
        $post->seo_title = $request->seo_title;
        $post->meta_description = $request->meta_description;
        $post->description = $request->description;

        $this->WekaPicha($request, 'post_images', 'photo');
        $request->photo = $this->image;
        $post->photo = $request->photo;

        if (!is_null($request->categories)) { $categories = $request->categories; }

        $post->save();

        $post->categories()->attach($categories);

        return redirect('/admin/posts')->with('success', 'New blog post have been successfully added');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $title = 'Edit '.$post->title.' details';
        $post_categories = TourCategory::all();
        $posts = Post::all();
        return view('admin.posts.edit',compact('post','title', 'post_categories', 'posts'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'required|string',
            'photo' => 'image|max:500',
            'existing_categories' => 'array',
            'added_categories' => 'array',
        ]);

        $post = Post::findOrFail($id);

        $post->title = $request->name;
        $post->seo_title = $request->seo_title;
        $post->meta_description = $request->meta_description;
        $post->description = $request->description;

        if(!empty($request->photo)){
            if (!empty($post->photo)){
                if( file_exists ( public_path('images/post_images/'.$post->photo) ) ){
                    unlink ( public_path('images/post_images/'.$post->photo) );
                }
            }

            $this->WekaPicha($request, 'post_images', 'photo');
            $request->photo = $this->image;
            $post->photo = $request->photo;
        }

        if (!is_null($request->existing_categories) && !is_null($request->added_categories)) {
            $categories = array_unique(array_merge($request->existing_categories, $request->added_categories));
        } elseif (!is_null($request->existing_categories) && is_null($request->added_categories)) {
            $categories = $request->existing_categories;
        } elseif (is_null($request->existing_categories) && !is_null($request->added_categories)) {
            $categories = $request->added_categories;
        } else {
            $categories = null;
        }

        // check to make sure categories is not null
        if (is_null($categories)) {
            return back()->with('error', 'You must choose some Post Categories to proceed...');
        }

        $post->categories()->sync($categories);

        $post->save();


        return redirect('/admin/posts')->with('success', 'New blog post have been successfully updated');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (!is_null($post->photo)) {
            unlink ( public_path('images/post_images/'.$post->photo) );
        }
        $post->delete();

        return redirect('/admin/posts')->with('success', 'Post have been successfully deleted');
    }
}
