@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                <a href="/admin/tours/add" class="btn btn-success pull-right">Add New Tour</a>
            </h3>
            <hr>
            @if($tours->count())
                <table class="table">
                    <tr>
                        <th>Tour Name</th>
                        <th class="w-10 text-center">Categories</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($tours as $tour)
                        <tr>
                            <td>{{ $tour->name }}</td>
                            <td class="w-10 text-center">{{ $tour->categories->count() }}</td>
                            <td class="w-5 text-center"><a href="/admin/tours/{{ $tour->id }}/edit"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-danger">Sorry, We have no Tours added yet..!</h3>
            @endif
        </div>
    </div>
@endsection