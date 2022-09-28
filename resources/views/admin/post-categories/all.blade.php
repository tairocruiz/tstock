@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                <a href="/admin/post-categories/add" class="btn btn-success pull-right">Add New Post Category</a>
            </h3>
            <hr>
            @if($post_categories->count())
                <table class="table">
                    <tr>
                        <th>Post Category Name</th>
                        <th>SEO Title</th>
                        <th class="w-5 text-center">Posts</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($post_categories as $post_category)
                        <tr>
                            <td>{{ $post_category->name }}</td>
                            <td>{{ $post_category->seo_title }}</td>
                            <td class="text-center">@if($post_category->posts->count()) {{ $post_category->posts->count() }} @endif</td>
                            <td class="w-5 text-center"><a href="/admin/post-categories/{{ $post_category->id }}/edit"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-danger">Sorry, We have no Post Categories added yet..!</h3>
            @endif
        </div>
    </div>
@endsection