@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-6">
            <h3 class="text-center">{{ $title }}</h3>
            <hr>
            <form action="{{ action('App\Http\Controllers\Safaris\DestinationController@update',$destination->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="name">Edit Destination Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $destination->name }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category">Destination Category</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="{{ $destination->destination_category->id }}" selected>{{ $destination->destination_category->name }}</option>
                            @foreach($destination_categories->where('id','!=',$destination->destination_category->id) as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="seo_title">Edit Enter SEO Title</label> <small class="seo-title-character-counter pull-right"><span class="char-counter">65</span> characters remaining</small>
                    <input type="text" id="seo_title" name="seo_title" class="form-control" maxlength="65" value="{{ $destination->seo_title }}">
                </div>
                <div class="form-group">
                    <label for="meta_description">Edit Meta Description</label> <small class="meta-descr-character-counter pull-right"><span class="char-counter">160</span> characters remaining</small>
                    <input type="text" id="meta_description" name="meta_description" class="form-control" maxlength="160" value="{{ $destination->meta_description }}">
                </div>
                <div class="form-group">
                    <label for="description">Edit Destination Description</label> <small class="description-character-counter pull-right"><span class="char-counter">0</span> characters total</small>
                    <textarea name="description" id="description" class="form-control textarea" cols="30" rows="10">{{ $destination->description }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="photo">Change Destination Photo</label>
                            <input type="file" id="photo" name="photo" class="form-control">
                        </div>
                    </div>
                    @method('PUT')
                    <div class="col-md-8">
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-2"></i>Save Changes</button>
                            <button type="reset" class="btn btn-default"><i class="fa fa-times mr-2"></i>Cancel</button>
                            <a id="remove-destination-button" class="btn btn-danger pull-right" title="Remove {{ $destination->name }}"><i class="fa fa-trash-o mr-2"></i>Remove</a>
                        </div>
                    </div>
                </div>
            </form>
            <form id="remove-destination-form" action="{{ action('App\Http\Controllers\Safaris\DestinationController@destroy',$destination->id) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
        <div class="col-md-3">
            <h3 class="text-right">List of Added Destinations</h3>
            <hr>
            <table class="table">
                @if($destinations->count())
                    <tr>
                        <th>Name</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($destinations as $destination)
                        <tr>
                            <td>{{ $destination->name }}</td>
                            <td class="w-5 text-center">
                                <a href="/admin/places/{{ $destination->id }}/edit" title="Edit {{ $destination->name }} details"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h4 class="text-danger">Sorry, No Destinations added yet..!</h4>
                @endif
            </table>
        </div>
    </div>
@endsection
