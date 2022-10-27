@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                <a href="/admin/destination-categories/add" class="btn btn-success pull-right">Add New Destination Category</a>
            </h3>
            <hr>
            @if($destination_categories->count())
                <table class="table">
                    <tr>
                        <th>Destination Category Name</th>
                        <th class="text-center">Destinations</th>
                        <th>SEO Title</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($destination_categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">@if($category->destinations->count()) {{ $category->destinations->count() }} @else --- @endif</td>
                            <td>{{ $category->seo_title }}</td>
                            <td class="w-5 text-center"><a href="/admin/destination-categories/{{ $category->id }}/edit"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection