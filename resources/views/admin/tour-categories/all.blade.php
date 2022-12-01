@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                <a href="{{ route('admin.tour-categories.create') }}" class="btn btn-success pull-right">Add New Category</a>
            </h3>
            <hr>
            @if($tour_categories->count())
                <table class="table">
                    <tr>
                        <th>Category Name</th>
                        <th class="text-center w-5"><i class="fa fa-star-o text-danger" title="Specials"></i></th>
                        <th>SEO Title</th>
                        <th>Icon</th>
                        <th class="text-center">Tours</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($tour_categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">@if($category->special) <i class="fa fa-star text-danger" title="Special"></i> @endif</td>
                            <td>{{ $category->seo_title }}</td>
                            <td>@if($category->icon) <img src="images/tour_category_icons/{{ $category->icon }}" alt="Icon" style="max-width: 30px"> @endif</td>
                            <td class="text-center">{{ $category->tours->count() ? $category->tours->count() : '' }}</td>
                            <td class="w-5 text-center"><a href="{{ route('admin.tour-categories.edit', $category->id) }}"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-danger">Sorry, We have no Tour Categories added yet..!</h3>
            @endif
        </div>
    </div>
@endsection
