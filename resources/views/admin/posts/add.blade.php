@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-6">
            <h3 class="text-center">{{ $title }}</h3>
            <hr>
            <form action="{{ action('App\Http\Controllers\Safaris\PostController@store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Enter Blog Post Title</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Category Name" required>
                </div>
                <div class="form-group">
                    <label for="seo_title">Enter SEO Title</label> <small class="seo-title-character-counter pull-right"><span class="char-counter">65</span> characters remaining</small>
                    <input type="text" id="seo_title" name="seo_title" class="form-control" maxlength="80" placeholder="Enter SEO Title">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label> <small class="meta-descr-character-counter pull-right"><span class="char-counter">160</span> characters remaining</small>
                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="2" maxlength="175"></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Post Description</label> <small class="description-character-counter pull-right"><span class="char-counter">0</span> characters total</small>
                    <textarea name="description" id="description" class="form-control textarea" cols="30" rows="10" required></textarea>
                </div>
                <div class="form-group">
                    @if($post_categories->count())
                        <div class="row">
                            @foreach($post_categories as $post_category)
                                <div class="col-md-4">
                                    <label>
                                        <input type="checkbox" name="categories[]" value="{{ $post_category->id }}" id="categories">
                                        <span class="ml-2">{{ $post_category->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo">Upload Post Photo</label> <small class="text-muted">(1600 by  600px)</small>
                            <input type="file" id="photo" name="photo" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-2"></i>Add Post</button>
                            <button type="reset" class="btn btn-default"><i class="fa fa-times mr-2"></i>Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <h3 class="text-right">List of Added Posts</h3>
            <hr>
            <table class="table">
                @if($posts->count())
                    <tr>
                        <th>Name</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td class="w-5 text-center">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" title="Edit {{ $post->title }} details"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h4 class="text-danger">Sorry, No Posts added yet..!</h4>
                @endif
            </table>
        </div>
    </div>
@endsection
