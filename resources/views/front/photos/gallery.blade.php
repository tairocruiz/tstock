@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="images/page_images/gallery.jpg" class="img-responsive" alt="Ngorongoro Crater, Tanzania">
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira text-center"><i class="fa fa-image text-danger mr-3"></i>{{ $title }}</h1>
                <hr>
            </div>
            <div class="col-md-12">
                <p>
                    Photography to us is a way of feeling, of touch, of loving. What we have caught on film is captured forever.. It remembers little moments and lifetime experince, long after you have forgotten everything.
                </p>
                <p>EVERY PHOTO YOU SEE IN THIS GALLERY HAS BEEN TAKEN BY US OR BY OUR BELOVED GUESTS!</p>
                <div class="gallery-pics-container mt-3">
                    @if($photos->count())
                        @foreach($photos as $photo)
                            <div class="photo-object-container" title="{{ $photo->name }}">
                                <img src="images/gallery_photos/{{ $photo->photo }}" alt="{{ $photo->name }}">
                                <h4 class="text-center ubuntucondensed">{{ $photo->name }}</h4>
                                <div class="small para text-justify">{!! $photo->description !!}</div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-danger">Sorry, No photos uploaded. Please come back later..!</h3>
                    @endif
                </div>
            </div>
        </div>
        @include('front.includes.footer')
    </div>
@endsection