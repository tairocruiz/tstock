@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="images/destination_images/{{ $destination->photo }}" class="img-responsive" alt="{{ $destination->name }}">
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira"><i class="fa fa-map-marker text-danger mr-3"></i>{{ $title }}</h1>
                <hr>
            </div>
            <div class="col-md-8">
                <span class="text-justify">{!! $destination->description !!}</span>
            </div>
            <div class="col-md-4">
                @if($destination->destination_category->destinations->count() > 1)
                    <div class="list-group">
                        <h4 class="list-group-item text-uppercase ubuntucondensed primary-bg-color">{{ $destination->destination_category->name }} Destinations</h4>
                        @foreach($destination->destination_category->destinations->where('slug','!=',$destination->slug) as $place)
                            <a href="/destinations/{{ $place->slug }}" class="list-group-item"><i class="fa fa-angle-right mr-2"></i>{{ $place->name }}</a>
                        @endforeach
                    </div>
                    <div class="list-group">
                        <h4 class="ubuntucondensed text-uppercase list-group-item primary-bg-color"><i class="fa fa-chevron-circle-right mr-2"></i>Other Tanzania Places To Go</h4>
                        @foreach($destination_categories as $category)
                            <a href="/places-to-go/{{ $category->slug }}" class="list-group-item"><i class="fa fa-fw fa-angle-right mr-2"></i>{{ $category->name }}</a>
                        @endforeach
                    </div>
                @elseif($destination_categories->count() > 1)
                    <div class="list-group">
                        <h4 class="ubuntucondensed text-uppercase list-group-item primary-bg-color"><i class="fa fa-chevron-circle-right mr-2"></i>Other Tanzania Places To Go</h4>
                        @foreach($destination_categories as $category)
                            <a href="/places-to-go/{{ $category->slug }}" class="list-group-item"><i class="fa fa-fw fa-angle-right mr-2"></i>{{ $category->name }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection