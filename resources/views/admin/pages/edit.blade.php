@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-6">
            <h3 class="text-center">{{ $title }}</h3>
            <hr>
            <form action="{{ action('PageController@update',$page->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-9">
                        <label for="name">Edit Page Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $page->name }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="resource">Resource?</label>
                        <label>
                            <input type="checkbox" name="resource" id="resource" @if($page->resource) checked @endif> Mark if Yes
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="seo_title">Edit SEO Title</label> <small class="seo-title-character-counter pull-right"><span class="char-counter">65</span> characters remaining</small>
                    <input type="text" id="seo_title" name="seo_title" class="form-control" maxlength="80" value="{{ $page->seo_title }}">
                </div>
                <div class="form-group">
                    <label for="meta_description">Edit Meta Description</label> <small class="meta-descr-character-counter pull-right"><span class="char-counter">160</span> characters remaining</small>
                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="2" maxlength="175">{{ $page->meta_description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Edit Page Description</label> <small class="description-character-counter pull-right"><span class="char-counter">0</span> characters total</small>
                    <textarea name="description" id="description" class="form-control textarea" cols="30" rows="10">{{ $page->description }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo">Change Page Photo</label> <small class="text-muted">(2200 by  800px)</small>
                            <input type="file" id="photo" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check mr-2"></i>Save Changes</button>
                            <button type="reset" class="btn btn-default"><i class="fa fa-times mr-2"></i>Cancel</button>
                            <a href="#" id="remove-page-button" class="btn btn-danger pull-right" title="Remove this page">
                                <i class="fa fa-trash-o mr-2"></i>Remove
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ action('PageController@remove',$page->id) }}" id="remove-page-form" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
            </form>
        </div>
        <div class="col-md-3">
            <h3 class="text-right">List of Added Destinations</h3>
            <hr>
            <table class="table">
                @if($pages->count())
                    <tr>
                        <th>Name</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->name }}</td>
                            <td class="w-5 text-center">
                                <a href="/admin/pages/{{ $page->id }}/edit" title="Edit {{ $page->name }} details"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h4 class="text-danger">Sorry, No Pages added yet..!</h4>
                @endif
            </table>
        </div>
    </div>
@endsection