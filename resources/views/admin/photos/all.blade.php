@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                <a href="/admin/photos/add" class="btn btn-success pull-right">Add New Photo</a>
            </h3>
            <hr>
            @if($photos->count())
                <table class="table">
                    <tr>
                        <th>Photo Name</th>
                        <th>Description</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($photos as $photo)
                        <tr>
                            <td>{{ $photo->name }}</td>
                            <td>{!! Str::limit($photo->description, 70) !!}</td>
                            <td class="w-5 text-center"><a href="/admin/photos/{{ $photo->id }}/edit"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-danger">Sorry, We have no Photos added yet..!</h3>
            @endif
        </div>
    </div>
@endsection