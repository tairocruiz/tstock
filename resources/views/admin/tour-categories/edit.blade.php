@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-6">
            <h3 class="text-center">{{ $title }}</h3>
            <hr>
            <form action="{{ action('TourCategoryController@update',$category->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-9">
                        <label for="name">Edit Category Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="special">Mark if Special</label>
                        <label>
                            <input type="checkbox" @if($category->special) checked @endif name="special"> is it Special?
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="seo_title">Enter SEO Title</label> <small class="seo-title-character-counter pull-right"><span class="char-counter">65</span> characters remaining</small>
                    <input type="text" id="seo_title" name="seo_title" class="form-control" maxlength="80" value="{{ $category->seo_title }}">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label> <small class="meta-descr-character-counter pull-right"><span class="char-counter">160</span> characters remaining</small>
                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="2" maxlength="175">{{ $category->meta_description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Category Description</label> <small class="description-character-counter pull-right"><span class="char-counter">0</span> characters total</small>
                    <textarea name="description" id="description" class="form-control textarea" cols="30" rows="10">{{ $category->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Change Category Photo</label> <small>(2200 by 800px)</small>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="form-group pt-3">
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-2"></i>Save Changes</button>
                    <button type="reset" class="btn btn-default"><i class="fa fa-times mr-2"></i>Cancel</button>
                    <button id="remove-tour-category-button" type="reset" class="btn btn-danger pull-right" title="Remove {{ $category->name }}"><i class="fa fa-trash-o mr-2"></i>Remove</button>
                </div>
            </form>
            <form id="remove-tour-category-form" action="{{ action('TourCategoryController@remove',$category->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
            </form>
        </div>
        <div class="col-md-3">
            <h3 class="text-right">List of Added Categories</h3>
            <hr>
            <table class="table">
                @if($tour_categories->count())
                    <tr>
                        <th>Name</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($tour_categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td class="w-5 text-center">
                                <a href="/admin/tour-categories/{{ $category->id }}/edit" title="Edit {{ $category->name }} details"><i class="fa fa-edit"></i></a>
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