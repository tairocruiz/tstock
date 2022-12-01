@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-6">
            <h3 class="text-center">{{ $title }}</h3>
            <hr>
            <form action="{{ action('App\Http\Controllers\Safaris\TourController@store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Enter Tour Package Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Tour package name" required>
                </div>
                <div class="form-group">
                    <label for="seo_title">Enter SEO Title</label> <small class="seo-title-character-counter pull-right"><span class="char-counter">65</span> characters remaining</small>
                    <input type="text" id="seo_title" name="seo_title" class="form-control" maxlength="80" placeholder="Enter SEO Title">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label> <small class="meta-descr-character-counter pull-right"><span class="char-counter">160</span> characters remaining</small>
                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="2" maxlength="175" placeholder="Meta Description for search engines"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="days">No of Days</label>
                        <input type="number" id="days" name="days" class="form-control" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="best_time">Best Time to visit with this Tour Package</label>
                        <input type="text" id="best_time" name="best_time" maxlength="30" class="form-control" placeholder="Ex. All Year Round, January --> March">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Day 2 Day Tour Description</label> <small class="description-character-counter pull-right"><span class="char-counter">0</span> characters total</small>
                    <textarea name="description" id="description" class="form-control textarea" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Tour Package Photo</label> <small class="text-muted pull-right">( 1400 by 500px )</small>
                    <input type="file" id="photo" name="photo" class="form-control" required>
                </div>
                @if($tour_categories->count())
                    <div class="row mt-4">
                        <div class="col-md-12"><label for="categories">Add Tour Categories</label></div>
                        @foreach($tour_categories as $category)
                            <div class="col-md-4">
                                <label>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"> {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-2"></i>Save Tour</button>
                    <button type="reset" class="btn btn-default"><i class="fa fa-times mr-2"></i>Cancel</button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <h3 class="text-right">List of Added Tours</h3>
            <hr>
            <table class="table">
                @if($tours->count())
                    <tr>
                        <th>Name</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($tours as $tour)
                        <tr>
                            <td>{{ $tour->name }}</td>
                            <td class="w-5 text-center"><a href="/admin/tours/{{ $tour->id }}/edit" title="Edit {{ $tour->name }} details"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                @else
                    <h4 class="text-danger">Sorry, No Tours added yet..!</h4>
                @endif
            </table>
        </div>
    </div>
@endsection
