@extends('layouts.front')

@php
    if (isset($_GET['id'])) {
        $tour = \App\Models\Tour::find($_GET['id']);
    }
@endphp

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        @if($tours->count())
            <div class="col-md-12 p-0 header_img_container">
                <img src="{{asset('images/tour_photos/'.$tours->random()->photo)}}" class="img-responsive" alt="Tailor Made Safaris"/>
            </div>
        @endif
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-8"><tailor-made-safari></tailor-made-safari></div>
            <div class="col-md-4">
                @if(isset($tour))
                    <div class="panel panel-default mt-3">
                        <h3 class="panel-heading assistant-light mt-0 mb-0"><i class="fa fa-edit text-muted mr-1"></i>ITINERARY TO CUSTOMIZE</h3>
                        <div class="panel-body p-0">
                            <img src="{{ asset('images/tour_maps/'.$tour->map) }}" class="img-responsive" alt="{{ $tour->name }}"/>
                        </div>
                        <div class="panel-body text-justify">
                            <h3 class="ubuntucondensed mb-2">{{ $tour->name }}</h3>
                            {{ $tour->overview }}
                            <div class="mt-2" style="list-style-position: inside">
                                <div class="assistant-light">This Safari Tour Categories;</div>
                                <ul>
                                    @foreach($tour->tour_category as $other_tour_category)
                                        <li>{{ $other_tour_category->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @if($tour->price)
                                <hr>
                                <div class="text-uppercase assistant-light">From only</div>
                                <span class="text-danger assistant-light" style="font-size: 36px; font-weight: bold">
                                    US${{ number_format($tour->price) }}
                                </span>
                            @endif
                        </div>
                    </div>
                @else
                    common content
                @endif
            </div>
        </div>

        @include('front.includes.footer')
    </div>
@endsection
