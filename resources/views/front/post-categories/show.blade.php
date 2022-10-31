@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="{{ asset('images/post_category_images/'.$category->photo) }}" class="img-responsive" alt="{{ $category->name }}"/>
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira"><i class="fa fa-folder-open-o text-danger mr-3"></i>
                    {{ $category->name }}
                    @if($category->posts->count())
                        <span class="pull-right category-tours-count hidden-xs assistant-light">{{ $category->posts->count().Str::plural(' post',$category->posts->count()) }}</span>
                    @endif
                </h1>
                <hr>
            </div>
            <div class="col-md-8">
                <span class="text-justify">{!! $category->description !!}</span>
                @if($category->posts->count())
                    <div class="row mt-4">
                        @foreach($category->posts as $post)
                            <div class="col-md-6">
                                <div class="panel panel-default panel-raised panel-noroundcorners">
                                    <div class="panel-body p-0">
                                        <a href="/{{ $category->slug }}/{{ $post->slug }}" title="{{ $post->title }}">
                                            <img src="{{ asset('images/post_images/'.$post->photo) }}" class="img-responsive" alt="{{ $post->title }}"/>
                                        </a>
                                    </div>
                                    <div class="panel-footer">
                                        <a href="/{{ $category->slug }}/{{ $post->slug }}" class="ubuntucondensed"><i class="fa fa-angle-right mr-2"></i>{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                @if($tour_categories->count() > 1)
                    <div class="list-group">
                        <h3 class="list-group-item primary-bg-color text-uppercase ubuntucondensed"><i class="fa fa-chevron-circle-right mr-2"></i>Tanzania Safari Tours</h3>
                        @foreach($tour_categories as $category)
                            <a href="/safaris/{{ $category->slug }}" class="list-group-item">
                                @if($category->special)
                                    <i class="fa fa-fw fa-star text-danger mr-2" title="Specials"></i>
                                @else
                                    <i class="fa fa-fw fa-angle-right mr-2"></i>
                                @endif
                                {{ $category->name }}
                                @if($category->tours->count())
                                    <span class="pull-right badge ubuntucondensed" title="{{ $category->tours->count() }} {{ Str::plural('tour',$category->tours->count()) }}">{{ $category->tours->count() }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        @include('front.includes.footer')
    </div>
@endsection
