@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="{{ asset('images/tour_photos/'.$tour->photo)}}" class="img-responsive" alt="{{ $tour->name }}">
        </div>
    </div>
    <div class="container main tour_show_page">
        <div class="row">
            <div class="overview-section col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="assistant-light mb-3">
                            Overview
{{--                            @foreach($tour->tour_category as $the_category)--}}
{{--                                @if($the_category->icon)--}}
{{--                                    <span>--}}
{{--                                        <img src="{{ asset('images/tour_category_icons/{{ $the_category->icon }}"--}}
{{--                                             alt="{{ $the_category->name }}"--}}
{{--                                             title="{{ $the_category->name }}"--}}
{{--                                             style="margin-left: 15px; max-height: 30px; filter: drop-shadow(0 1px #ffffff)"--}}
{{--                                        >--}}
{{--                                    </span>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
                        </h2>
                        @if($tour->tour_category)
                            <ul class="categories-list list-inline mb-3 assistant-light">
                                @foreach($tour->tour_category as $tour_category)
                                    <li class="category-list-item">
{{--                                        @if($tour_category->icon)--}}
{{--                                            <img src="{{ asset('images/tour_category_icons/{{ $tour_category->icon }}"--}}
{{--                                                 alt="{{ $tour_category->name }}" title="{{ $tour_category->name }}"--}}
{{--                                                 style="max-height: 20px; filter: grayscale(1); margin-right: 10px"--}}
{{--                                            >--}}
{{--                                        @endif--}}
                                        {{ $tour_category->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if($tour->tour_days)
                            <ul class="overview-days-list list-unstyled mb-3">
                                @foreach($tour->tour_days->sortBy('day_order') as $tour_day)
                                    <li class="mt-2 mb-2">
                                        <span class="overview-day-icon-container mr-2" title="{{ $tour_day->activity }}"><i class="first-day-icon fas fa-fw fa-{{ $tour_day->activity }} text-danger"></i></span>
                                        <strong>Day {{ $tour_day->day_order }} : </strong><span class="ubuntucondensed">{{ Str::limit($tour_day->day_title,100) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if(!is_null($tour->map))
                            <div class="mt-3">
                                <img src="{{ asset('images/tour_maps/'.$tour->map) }}" class="img-responsive" alt="Route Map for this {{ $tour->name }}">
                            </div>
                            <div class="mt-2 mb-3 text-center">
                                <h4 class="ubuntucondensed">THIS TOUR IS NOT EXACTLY WHAT YOU WANT?</h4>
                                <p><a href="/safari-tours/tailor-made/?id={{ $tour->id }}" class="btn btn-lg btn-tmt-default assistant-light">Let's Customize it now</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row detailed-tour-section">
            <div class="itinerary-section col-md-8">
                <div class="mb-3 text-justify">
                    <h3 class="text-uppercase text-muted ubuntucondensed mb-3">
                        Customizable Itinerary
                        @foreach($tour->tour_category as $the_category)
                            @if($the_category->icon)
                                <span class="pull-right">
                                    <img src="{{ asset('images/tour_category_icons/'.$the_category->icon ) }}"
                                         alt="{{ $the_category->name }}"
                                         title="{{ $the_category->name }}"
                                         style="margin-left: 30px; max-height: 30px; filter: drop-shadow(0 1px #ffffff)"
                                    >
                                </span>
                            @endif
                        @endforeach
                    </h3>
                    {{ $tour->overview }}
                </div>
                <div class="show-all-info mb-3 assistant-light">
                    <a href="#" class="pull-right">SHOW / HIDE ALL INFO<i class="show-all-info-icon fa fa-lg fa-plus-circle ml-2 primary-color"></i></a>
                </div>
                @if($tour->tour_days)
                    @foreach($tour->tour_days->sortBy('day_order') as $panel_tour_day)
                        <div class="day-section row">
                            <div class="day-count col-md-1 text-center ubuntucondensed p-0 text-muted">DAY {{ $loop->index + 1 }}</div>
                            <div class="day-content col-md-11 text-muted">
                                <a href="#" class="show-day-info" title="{{ $panel_tour_day->day_title }}">
                                    <h4 class="text-uppercase mt-2 ubuntucondensed primary-color">
                                        {{ Str::limit($panel_tour_day->day_title, 75) }}
                                        <i class="show-day-info-icon fa fa-plus-circle pull-right"></i>
                                    </h4>
                                </a>
                                <div class="text-justify">
                                    {!! $panel_tour_day->day_description !!}
                                    <div class="row mt-2">
                                        @if($panel_tour_day->day_photo1 && $panel_tour_day->day_photo2)
                                            <div class="col-md-6" title="{{ $panel_tour_day->name }}">
                                                <img src="{{ asset('images/day2day_photos/'.$panel_tour_day->day_photo1) }}" class="img-responsive" alt="{{ $panel_tour_day->day_title }} photo1">
                                            </div>
                                            <div class="col-md-6" title="{{ $panel_tour_day->name }}">
                                                <img src="{{ asset('images/day2day_photos/'.$panel_tour_day->day_photo2) }}" class="img-responsive" alt="{{ $panel_tour_day->day_title }} photo2">
                                            </div>
                                        @else
                                            @if($panel_tour_day->day_photo1)
                                                <div class="col-md-12" title="{{ $panel_tour_day->name }}">
                                                    <img src="{{ asset('images/day2day_photos/'.$panel_tour_day->day_photo1) }}" class="img-responsive" alt="{{ $panel_tour_day->day_title }} photo1">
                                                </div>
                                            @endif
                                            @if($panel_tour_day->day_photo2)
                                                <div class="col-md-12" title="{{ $panel_tour_day->name }}">
                                                    <img src="{{ asset('images/day2day_photos/'.$panel_tour_day->day_photo2) }}" class="img-responsive" alt="{{ $panel_tour_day->day_title }} photo2">
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 side-bar">
                @if($tour->price)
                    <div class="panel panel-warning text-center">
                        <div class="panel-body">
                            <p style="color: #888">This Tanzania Safari from only</p>
                            <h1 class="mt-0 assistant-light">US$ <b>{{ number_format($tour->price) }}</b> p/p</h1>
                        </div>
                    </div>
                @endif
                <inquiry-form></inquiry-form>
            </div>
        </div>
        @if($tour->useful_information)
            <div class="row useful-information">
                <div class="col-md-12 info-details">
                    <h2 class="text-uppercase mb-3 assistant-light">Useful Information</h2>
                    {!! $tour->useful_information !!}
                    <div class="text-center mt-3 mb-3">
                        <form action="{{ action('App\Http\Controllers\PageController@contacts') }}" method="post">
                            @csrf
                            <button class="btn btn-lg btn-tmt-default assistant-light"><span class="px-2">REQUEST THIS TOUR</span></button><br>
                            <small class="text-muted">Free service, No credit card required</small>
                            <input type="hidden" name="id" value="{{ $tour->id }}">
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if($tours->count() > 3)
            <div class="row other-tours mt-3">
                <div class="col-md-12 mb-1"><h2 class="assistant-light">RELATED TOURS</h2></div>
                @foreach($tours->take(3) as $other_tour)
                    @continue($other_tour->id === $tour->id)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body p-0">
                                <a href="/tours/{{ $other_tour->slug }}">
                                    <img src="{{ asset('images/tour_photos/'.$other_tour->photo) }}" class="img-responsive" alt="{{ $other_tour->name }}">
                                </a>
                            </div>
                            <div class="panel-body">
                                <a href="/tours/{{ $other_tour->slug }}">
                                    <h4 class="ubuntucondensed"><i class="fa fa-fw fa-angle-right mr-1"></i>{{ Str::limit($other_tour->name, 40) }}</h4>
                                </a>
                                <div class="assistant-light text-muted">
                                    <i class="fa fa-fw fa-clock-o mr-1"></i>
                                    {{ $other_tour->days }} {{ Str::plural('Day', $other_tour->days) }} @if($other_tour->days > 1) / {{ $other_tour->days - 1 }} Nights @endif Safari Tour
                                </div>
                                <div class="mt-1">
                                    <i class="fa fa-fw fa-folder-open-o mr-1"></i>
                                    @foreach($other_tour->tour_category as $other_tour_category)
                                        @if($other_tour_category->icon)
                                            <img src="{{ asset('images/tour_category_icons/'.$other_tour_category->icon) }}"
                                                 alt="{{ $other_tour_category->name }}" title="{{ $other_tour_category->name }}"
                                                 style="max-height: 25px; margin-right: 15px"
                                            >
                                        @endif
                                    @endforeach
                                </div>
                                <div class="mt-2 text-justify">{{ Str::limit($other_tour->overview, 150) }}</div>
                                <a href="/tours/{{ $other_tour->slug }}" class="btn btn-default mt-2 assistant-light"><i class="fa fa-angle-right mr-1"></i>Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @include('front.includes.tailor_made_section')
        @include('front.includes.bottom_icon_section')

        @include('front.includes.footer')
    </div>
@endsection
