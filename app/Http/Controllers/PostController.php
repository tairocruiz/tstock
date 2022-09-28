<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Storage;

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

    public function all()
    {
        $title = 'Listing all Posts';
        return view('admin.posts.all',compact('title'));
    }

    public function add()
    {
        $title = 'Add a new Blog Post';
        return view('admin.posts.add',compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'seo_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:160',
            'description' => 'required|string',
            'photo' => 'required|image|max:500',
            'categories' => 'required|array',
        ]);

        $post = new Post;

        $post->title = $request->name;
        $post->seo_title = $request->seo_title;
        $post->meta_description = $request->meta_description;
        $post->description = $request->description;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/post_images');
            $path = explode('/',$path);
            $filename = $path[2];
            $post->photo = $filename;
        }

        if (!is_null($request->categories)) { $categories = $request->categories; }

        $post->save();

        $post->categories()->attach($categories);

        return redirect('/admin/posts')->with('success', 'New blog post have been successfully added');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $title = 'Edit '.$post->title.' details';
        return view('admin.posts.edit',compact('post','title'));
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

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('/public/post_images');
            $path = explode('/',$path);
            $filename = $path[2];
            $post->photo = $filename;
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

    public function remove($id)
    {
        $post = Post::findOrFail($id);
        if (!is_null($post->photo)) {
            Storage::delete('/public/post_images/'.$post->photo);
        }
        $post->delete();

        return redirect('/admin/posts')->with('success', 'Post have been successfully deleted');
    }
}
