@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="{{ asset('images/tour_category_images/'.$tour_category->photo)}}" class="img-responsive" alt="{{ $tour_category->name }}"/>
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira" style="display: flex; align-items: center">
                    @if($tour_category->icon)
                        <img src="{{ asset('images/tour_category_icons/'.$tour_category->icon) }}" class="mr-1" alt="{{ $tour_category->name }}"/>
                    @else
                        <i class="fa fa-folder-open-o text-danger mr-1"></i>
                    @endif
                    <span>
                        {{ $tour_category->name }}
                        @if($tour_category->tours->count()) <span class="badge assistant-light">{{ $tour_category->tours->count().Str::plural(' tour',$tour_category->tours->count()) }}</span> @endif
                    </span>
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
                                            <img src="{{ asset('images/tour_photos/'.$tour->photo) }}" class="img-responsive" alt="{{ $tour->name }}"/>
                                        </a>
                                        <h4 class="text-uppercase px-2 pt-2 ubuntucondensed"><a href="/tours/{{ $tour->slug }}" class="text-muted">{{ $tour->name }}</a></h4>
                                        <div class="p-2">
                                            <i class="fa fa-fw fa-folder-open-o mr-1"></i>
                                            @foreach($tour->tour_category as $other_tour_category)
                                                @if($other_tour_category->icon)
                                                    <img src="{{ asset('images/tour_category_icons/'.$other_tour_category->icon) }}"
                                                         alt="{{ $other_tour_category->name }}" title="{{ $other_tour_category->name }}"
                                                         style="max-height: 25px; margin-right: 15px"
                                                    />
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="panel-body text-muted text-justify">
                                            {{ Str::limit($tour->overview, 150) }}
                                        </div>
                                        <p class="p-2 ubuntucondensed" style="display: flex; justify-content: space-between; align-items: center">
                                            <a href="/tours/{{ $tour->slug }}" class="btn btn-warning">ENQUIRE NOW</a>
                                            @if($tour->price) <span class="pull-right">{{--<span style="display: inline-block; margin-right: 5px; transform: translateY(-3px)">Deal :</span>--}}<span class="text-danger" style="font-size: 24px; font-weight: bold">US${{ number_format($tour->price) }}</span></span> @endif
                                        </p>
                                    </div>
{{--                                    <div class="panel-footer">--}}
{{--                                        <a href="/tours/{{ $tour->slug }}" class="ubuntucondensed"><i class="fa fa-angle-right mr-2"></i>{{ $tour->name }}</a>--}}
{{--                                    </div>--}}
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
                        <a href="/safari-tours/tailor-made" class="list-group-item"><i class="fa fa-fw fa-star text-danger mr-2" title="Specials"></i>Tailor Made Safari Tanzania</a>
                    </div>
                @endif
                @if ($category->tours->count())
                    <div>
                        <div id="TA_selfserveprop522" class="TA_selfserveprop"><ul id="q6Vj5SrJ9U9" class="TA_links 5JiGX8"><li id="ztj0Byiq14" class="Q3wTTvE"><a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g297913-d19432995-Reviews-Take_Me_To_Tanzania_Adventure_Safaris-Arusha_Arusha_Region.html"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-11900-2.svg" alt="TripAdvisor"/></a></li></ul></div><script async src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=522&amp;locationId=19432995&amp;lang=en_US&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=false&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>
                    </div>
                @endif
            </div>
        </div>
        @include('front.includes.footer')
    </div>
@endsection
