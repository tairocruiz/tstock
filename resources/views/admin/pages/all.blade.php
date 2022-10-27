@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                <a href="/admin/pages/add" class="btn btn-success pull-right">Add New Page</a>
            </h3>
            <hr>
            @if($pages->count())
                <table class="table">
                    <tr>
                        <th>Page Name</th>
                        <th class="w-5 text-center">Resource</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->name }}</td>
                            <td class="text-center">@if($page->resource) <i class="fa fa-check text-success"></i> @endif</td>
                            <td class="w-5 text-center"><a href="/admin/pages/{{ $page->id }}/edit"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-danger">Sorry, We have no Pages added yet..!</h3>
            @endif
        </div>
    </div>
@endsection