@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                <a href="/admin/places/add" class="btn btn-success pull-right">Add New Destination</a>
            </h3>
            <hr>
            @if($destinations->count())
                <table class="table">
                    <tr>
                        <th>Destination Name</th>
                        <th>SEO Title</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($destinations as $destination)
                        <tr>
                            <td>
                                {{ $destination->name }} <br>
                                <small class="text-muted">in {{ $destination->category->name }}</small>
                            </td>
                            <td>{{ $destination->seo_title }}</td>
                            <td class="w-5 text-center"><a href="/admin/places/{{ $destination->id }}/edit"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection