@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="slider_container">
            <div class="header_top_overlay"></div>
            <div class="col-md-12 p-0 header_img_container slider">
                @include('front.includes.home_slider')
                {{--<img src="/storage/page_images/home3.jpg" class="img-responsive" alt="Tanzania Safaris & Tours">--}}
            </div>
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h1 class="bira text-center">{{ $title }}</h1>
                <hr>
                <div class="mb-4 text-center">
                    <p>
                        Tanzania and its outstanding wildlife is our passion. That's why we know your tailor-made safari will be incredible. Luxury lodges and camps or nights under the stars. Being out in the wild or relaxing in a sundowner bar. Guided by Local trackers or travelling by 4x4 safari Vehicle. Inspired by real experience and created from authentic insights. Talk to our experts and we'll create your bespoke adventure!
                    </p>
                    <h3 class="bira">
                        --- Travel with a purpose! ---
                    </h3>
                </div>
                @if($tours->count())
                    <div class="row">
                        @foreach($tours->take(2) as $tour)
                            <div class="col-md-6">
                                <div class="panel panel-default panel-raised panel-noroundcorners">
                                    <div class="panel-body">
                                        <a href="/tours/{{ $tour->slug }}" title="{{ $tour->name }}">
                                            <img src="/storage/tour_images/{{ $tour->photo }}" class="img-responsive" alt="{{ $tour->name }}">
                                        </a>
                                    </div>
                                    <div class="panel-footer">
                                        <h3 class="ubuntucondensed text-center">{{ $tour->name }}</h3>
                                        <hr>
                                        @if(!is_null($tour->meta_description))
                                            <p class="text-justify assistant-light">{{ $tour->meta_description }}</p>
                                            <hr>
                                        @endif
                                        <div class="row text-center assistant-light">
                                            <div class="hidden-xs col-sm-4" style="border-right: 1px dashed #e0dfe3"><i class="fa fa-lg text-muted fa-clock-o mr-2"></i>{{ $tour->days }} Days / {{ $tour->days - 1 }} Nights</div>
                                            <div class="col-xs-6 col-sm-4 p-0" style="border-right: 1px dashed #e0dfe3">
                                                <h3 class="p-0 m-0 text-danger">
                                                    @if(!is_null($tour->price))
                                                        <small>from </small>US${{ number_format($tour->price) }}
                                                    @else
                                                        <form action="" method="POST">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $tour->id }}">
                                                            <button class="btn btn-sm btn-danger text-uppercase no-round-corners">
                                                                <i class="fa fa-question-circle mr-2"></i>Enquire
                                                            </button>
                                                        </form>
                                                    @endif
                                                </h3>
                                            </div>
                                            <div class="col-xs-6 col-sm-4"><a href="/tours/{{ $tour->slug }}" class="btn btn-sm btn-tmt-default text-uppercase ubuntucondensed"><i class="fa fa-angle-right mr-2"></i>details</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @if($tour_categories->count())
                <div class="col-md-12 home-accordion assistant-light">
                    <hr class="hr-text bira" data-content="Tanzania Safari Tours">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default panel-noroundcorners">
                                <div class="panel-footer">
                                    <ul class="list-unstyled">
                                        @foreach($tour_categories->sortByDesc(function ($tour_category) {return $tour_category->tours->count();})->take(4) as $tour_category)
                                            @if($tour_category->tours->count() < 1)
                                                @continue
                                            @endif
                                            <li>
                                                <h4 class="ubuntucondensed">
                                                    <i class="fa fa-plus mr-2 primary-color"></i>{{ $tour_category->name }}
                                                    <small class="assistant-light"> - {{ $tour_category->tours->count() }} {{ $tour_category->tours->count() }}</small>
                                                </h4>
                                                <p>{!! $tour_category->meta_description !!}</p>
                                                <p><a href="/safaris/{{ $tour_category->slug }}" class="btn btn-xs btn-warning no-round-corners assistant-light text-uppercase"><i class="fa fa-angle-right mr-2"></i>More</a></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default random-category panel-noroundcorners">
                                @php $random_category = $tour_categories->random(); @endphp
                                <div class="panel-body p-0" style="overflow: hidden">
                                    <a href="/safaris/{{ $random_category->slug }}" title="{{ $random_category->name }}">
                                        <img src="/storage/tour_category_images/{{ $random_category->photo }}" class="img-responsive" alt="{{ $random_category->name }}">
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    <h3 class="mt-2 mb-3">
                                        <a href="/safaris/{{ $random_category->slug }}" class="text-muted">
                                            <i class="fa fa-chevron-circle-right mr-2"></i>{{ $random_category->name }}
                                        </a>
                                    </h3>
                                    <p>{{ $random_category->meta_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($destinations->count())
            <div class="col-md-12">
                {{--<h2 class="bira text-center">Top Tanzania Destinations</h2>--}}
                <hr class="hr-text bira" data-content="Top Tanzania Destinations">
                <div class="row">
                    @foreach($destinations->take(4) as $destination)
                        <div class="col-md-6">
                            <div class="panel panel-default panel-raised panel-noroundcorners">
                                <div class="panel-body">
                                    <a href="/destinations/{{ $destination->slug }}">
                                        <img src="/storage/destination_images/{{ $destination->photo }}" class="img-responsive" alt="{{ $destination->name }}">
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    <h3 class="bira">
                                        <i class="fa fa-map-marker text-danger mr-2"></i>{{ $destination->name }}
                                        <span class="pull-right">
                                        <a href="/destinations/{{ $destination->slug }}" class="btn btn-sm btn-default ubuntucondensed text-uppercase">
                                            <i class="fa fa-angle-right mr-2"></i>Details
                                        </a>
                                    </span>
                                        <hr>
                                    </h3>
                                    <p>{!! $destination->description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        </div>
        @include('front.includes.footer')
    </div>
@endsection
