@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                <a href="/admin/posts/add" class="btn btn-success pull-right">Add New Post</a>
            </h3>
            <hr>
            @if($posts->count())
                <table class="table">
                    <tr>
                        <th>Post Name</th>
                        <th>SEO Title</th>
                        <th class="text-center">Categories</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->seo_title }}</td>
                            <td class="text-center">@if($post->categories->count()) {{ $post->categories->count() }} @endif</td>
                            <td class="w-5 text-center"><a href="/admin/posts/{{ $post->id }}/edit"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-danger">Sorry, We have no Posts added yet..!</h3>
            @endif
        </div>
    </div>
@endsection