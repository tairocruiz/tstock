@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="/storage/tour_images/safari-index.jpg" class="img-responsive" alt="Tanzania Safaris & Tours">
        </div>
    </div>
    <div class="container main">
        @if($tour_categories->count())
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="bira">{{ $title }}</h1>
                    <hr>
                </div>
                @foreach($tour_categories as $category)
                    <div class="col-md-6">
                        <div class="panel panel-noroundcorners panel-raised panel-default">
                            <a href="/safaris/{{ $category->slug }}" title="{{ $category->name }}">
                                <div class="panel-body">
                                    <img src="/storage/tour_category_images/{{ $category->photo }}" class="img-responsive" alt="{{ $category->name }}">
                                </div>
                            </a>
                            <div class="panel-footer">
                                <h3 class="bira">
                                    <i class="fa fa-folder-open-o text-danger mr-2"></i>{{ $category->name }}
                                    @if($category->tours->count())<span class="text-muted pull-right assistant-light badged">{{ $category->tours->count() }}</span>@endif
                                </h3>
                                <hr>
                                <div class="text-justify">{{ $category->meta_description }}</div>
                                <hr>
                                <a href="/safaris/{{ $category->slug }}" class="btn btn-tmt-default"><i class="fa fa-angle-right mr-2"></i>MORE</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('front.includes.footer')
        @endif
    </div>
@endsection