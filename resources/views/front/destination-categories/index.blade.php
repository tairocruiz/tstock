@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="{{ asset('images/destination_images/destinations.jpg') }}" class="img-responsive" alt="Tanzania Destinations"/>
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira text-center">{{ $title }}</h1>
                <hr>
                <div class="mb-4 text-justify">
                    <p>With so many incredible experiences to discover in Tanzania and Africa at large, it's difficult to know where to start. We've compiled some of our favorite things to do whilst embarking on a Tanzania safari, from Kilimanjaro trekking to a beautiful sugary sand beach of Zanzibar, which will help you create exciting ideas for your trip of a lifetime. When you find something that inspires you be sure to add them to your Shortlist, or contact our passionate team to find out more.</p>
                    <p>Our team of Africa enthusiasts are ready to tailor-make your perfect safari holiday - so just let us know when you're ready to start, and we will be on hand to help you every step of the way.</p>
                </div>
            </div>
        </div>
        @if($destination_categories->count())
            <div class="row">
                @foreach($destination_categories as $category)
                    @if($category->destinations->count())
                        <div class="col-md-6">
                            <div class="panel panel-noroundcorners panel-raised panel-default">
                                <a href="/places-to-go/{{ $category->slug }}" title="{{ $category->name }}">
                                    <div class="panel-body">
                                        <img src="{{ asset('images/destination_category_images/'.$category->photo) }}" class="img-responsive" alt="{{ $category->name }}"/>
                                    </div>
                                </a>
                                <div class="panel-footer">
                                    <h3 class="bira">
                                        <i class="fa fa-map-marker text-danger mr-2"></i>{{ $category->name }}
                                        <span class="pull-right badge assistant-light">{{ $category->destinations->count() }}</span>
                                    </h3>
                                    <hr>
                                    <div class="text-justify">{!! Str::limit($category->description, 170) !!}</div>
                                    <hr>
                                    <a href="/places-to-go/{{ $category->slug }}" class="btn btn-tmt-default"><i class="fa fa-angle-right mr-2"></i>MORE</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
        @include('front.includes.footer')
    </div>
@endsection
