@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="images/page_images/{{ $page->photo }}" class="img-responsive" alt="{{ $page->name }}">
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira"><i class="fa fa-map-marker text-danger mr-3"></i>{{ $title }}</h1>
                <hr>
            </div>
            <div class="col-md-8">
                <span class="text-justify">{!! $page->description !!}</span>
            </div>
            <div class="col-md-4">
                @if($page->resource === 1 && $pages->where('resource',1)->count() > 1)
                    <div class="list-group">
                        <h3 class="list-group-item text-uppercase ubuntucondensed list-group-item-success">Company Pages</h3>
                        @foreach($pages->where('slug','!=',$page->slug)->where('resource',1) as $page)
                            <a href="/{{ $page->slug }}" class="list-group-item"><i class="fa fa-angle-right mr-2"></i>{{ $page->name }}</a>
                        @endforeach
                    </div>
                @elseif($page->resource === 0 && $pages->where('resource',0)->count() > 1)
                    <div class="list-group">
                        <h3 class="list-group-item text-uppercase ubuntucondensed list-group-item-success">Company Pages</h3>
                        @foreach($pages->where('slug','!=',$page->slug)->where('resource',0) as $page)
                            <a href="/{{ $page->slug }}" class="list-group-item"><i class="fa fa-angle-right mr-2"></i>{{ $page->name }}</a>
                        @endforeach
                    </div>
                @endif


                {{--@if($pages->count() > 1)--}}
                    {{--<div class="list-group">--}}
                        {{--<h3 class="list-group-item text-uppercase ubuntucondensed list-group-item-success">Company Pages</h3>--}}
                        {{--@foreach($pages->where('slug','!=',$page->slug) as $page)--}}
                            {{--<a href="/{{ $page->slug }}" class="list-group-item"><i class="fa fa-angle-right mr-2"></i>{{ $page->name }}</a>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--@endif--}}
            </div>
        </div>
        @include('front.includes.footer')
    </div>
@endsection