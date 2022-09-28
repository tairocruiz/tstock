@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="/storage/page_images/gallery.jpg" class="img-responsive" alt="Ngorongoro Crater, Tanzania">
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira"><i class="fa fa-image text-danger mr-3"></i>{{ $title }}</h1>
                <hr>
            </div>
            <div class="col-md-12">
                <p>
                    Photography to us is a way of feeling, of touch, of loving. What we have caught on film is captured forever.. It remembers little moments and lifetime experince, long after you have forgotten everything.
                </p>
                <p>
                    EVERY PHOTO YOU SEE IN THIS GALLERY HAS BEEN TAKEN BY US OR BY OUR BELOVED GUESTS!
                </p>
                <div class="row pt-3">
                    @if($tours->count())
                        @foreach($tours as $tour)
                            <div class="col-sm-6 col-md-4 mb-3">
                                <img src="/storage/tour_images/{{ $tour->photo }}" class="img-responsive" alt="{{ $tour->name }}">
                            </div>
                        @endforeach
                    @endif
                    @if($destinations->count())
                        @foreach($destinations as $destination)
                            <div class="col-sm-6 col-md-4 mb-3">
                                <img src="/storage/destination_images/{{ $destination->photo }}" class="img-responsive" alt="{{ $destination->name }}">
                            </div>
                        @endforeach
                    @endif
                    @if($tour_categories->count())
                        @foreach($tour_categories as $tour_category)
                            <div class="col-sm-6 col-md-4 mb-3">
                                <img src="/storage/tour_category_images/{{ $tour_category->photo }}" class="img-responsive" alt="{{ $tour_category->name }}">
                            </div>
                        @endforeach
                    @endif
                    @if($destination_categories->count())
                        @foreach($destination_categories as $destination_category)
                            <div class="col-sm-6 col-md-4 mb-3">
                                <img src="/storage/destination_category_images/{{ $destination_category->photo }}" class="img-responsive" alt="{{ $destination_category->name }}">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        @include('front.includes.footer')
    </div>
@endsection