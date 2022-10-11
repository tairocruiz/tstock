@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="/storage/tour_category_images/{{ $tour_category->photo }}" class="img-responsive" alt="{{ $tour_category->name }}">
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira"><i class="fa fa-folder-open-o text-danger mr-3"></i>
                    {{ $tour_category->name }}
                    @if($tour_category->tours->count())
                        <span class="pull-right category-tours-count hidden-xs assistant-light">{{ $tour_category->tours->count().Str::plural(' tour',$tour_category->tours->count()) }}</span>
                    @endif
                </h1>
                <hr>
            </div>
            <div class="col-md-8">
                <span class="text-justify">{!! $tour_category->description !!}</span>
                @if($tour_category->tours->count())
                    <div class="row mt-4">
                        @foreach($tour_category->tours as $tour)
                            <div class="col-md-6">
                                <div class="panel panel-default panel-raised panel-noroundcorners">
                                    <div class="panel-body p-0">
                                        <a href="/tours/{{ $tour->slug }}" title="{{ $tour->name }}">
                                            <img src="/storage/tour_images/{{ $tour->photo }}" class="img-responsive" alt="{{ $tour->name }}">
                                        </a>
                                    </div>
                                    <div class="panel-footer">
                                        <a href="/tours/{{ $tour->slug }}" class="ubuntucondensed"><i class="fa fa-angle-right mr-2"></i>{{ $tour->name }}</a>
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
