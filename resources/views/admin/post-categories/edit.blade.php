@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-6">
            <h3 class="text-center">{{ $title }}</h3>
            <hr>
            <form action="{{ action('App\Http\Controllers\Safaris\PostCategoryController@update',$category->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Edit Category Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <div class="form-group">
                    <label for="seo_title">Edit SEO Title</label> <small class="seo-title-character-counter pull-right"><span class="char-counter">65</span> characters remaining</small>
                    <input type="text" id="seo_title" name="seo_title" class="form-control" maxlength="80" value="{{ $category->seo_title }}">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label> <small class="meta-descr-character-counter pull-right"><span class="char-counter">160</span> characters remaining</small>
                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="2" maxlength="175">{{ $category->meta_description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Post Category Description</label> <small class="description-character-counter pull-right"><span class="char-counter">0</span> characters total</small>
                    <textarea name="description" id="description" class="form-control textarea" cols="30" rows="10">{{ $category->description }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo">Change Category Photo</label> <small class="text-muted">(1600 by  600px)</small>
                            <input type="file" id="photo" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        @method('PUT')
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-2"></i>Save Changes</button>
                            <a href="/admin/post-categories" class="btn btn-default"><i class="fa fa-times mr-2"></i>Cancel</a>
                            <a id="remove-post-category-button" href="" class="btn btn-danger pull-right"><i class="fa fa-trash-o mr-2"></i>Remove</a>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ action('App\Http\Controllers\Safaris\PostCategoryController@destroy',$category->id) }}" id="remove-post-category-form" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
        <div class="col-md-3">
            <h3 class="text-right">List of Added Destinations</h3>
            <hr>
            <table class="table">
                @if($post_categories->count())
                    <tr>
                        <th>Name</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($post_categories as $post_category)
                        <tr>
                            <td>{{ $post_category->name }}</td>
                            <td class="w-5 text-center">
                                <a href="/admin/post-categories/{{ $post_category->id }}/edit" title="Edit {{ $post_category->name }} details"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h4 class="text-danger">Sorry, No Categories added yet..!</h4>
                @endif
            </table>
        </div>
    </div>
@endsection
