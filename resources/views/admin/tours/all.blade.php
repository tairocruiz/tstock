@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <tours></tours>
        </div>
       <div class="col-md-9">
           <h3 class="text-center">
               {{ $title }} <small class="text-muted">( {{ $tours->where('featured',true)->count() }} featured tours )</small>
                <a href="{{ route('admin.tours.create') }}" class="btn btn-success pull-right">Add New Tour</a>
            </h3>
            <hr>
           @if($tours->count())
                <table class="table">
                    <tr>
                        <th>Tour Name</th>
                        <th>Days / Nights</th>
                        <th class="w-10 text-center">Featured</th>
                        <th class="w-10 text-center">Categories</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($tours->sortBy(function ($tour) { return $tour->days; }) as $tour)
                        <tr>
                            <td>{{ $tour->name }}</td>
                            <td>{{ $tour->days }} Days @if($tour->days > 1) /{{ $tour->days - 1 }} Nights @endif</td>
                            <td class="w-10 text-center">
                                @if($tour->featured)
                                    <a href="/admin/tours/{{ $tour->id }}/{{ $tour->featured = 0 }}" title="De-Activate Featured Tour"><i class="fa fa-check text-success"></i></a>
                                @else
                                    <a href="/admin/tours/{{ $tour->id }}/{{ $tour->featured = 1 }}" title="Make This Tour Featured"><i class="fa fa-times text-danger"></i></a>
                                @endif
                            </td>
                            <td class="w-10 text-center">{{ $tour->tour_category->count() }}</td>
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
