@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="slider_container">
            <div class="header_top_overlay"></div>
            <div class="col-md-12 p-0 header_img_container slider">
                @include('front.includes.home_slider')
                {{--<img src="images/page_images/home3.jpg" class="img-responsive" alt="Tanzania Safaris & Tours">--}}
            </div>
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-6 welcome-photo p-0">
                <div class="image-container">
                    @if($tours->count())
                        <img src="{{ asset('images/tour_photos/'.$tours->random()->photo) }}" alt="TakeMeToTanzania"/>
                    @endif
                </div>
                <div>
                    <hr class="hr-text" data-content="find us on">
                    <ul class="list-inline" style="display: flex; justify-content: space-around">
                        <li><a href="https://www.tripadvisor.com/Attraction_Review-g297913-d19432995-Reviews-Take_Me_To_Tanzania_Adventure_Safaris-Arusha_Arusha_Region.html" target="_blank"><i class="fa fa-3x fa-tripadvisor text-success"></i></a></li>
                        <li><a href="https://www.facebook.com/TakemetoTanzania/" target="_blank"><i class="fa fa-3x fa-facebook-square"></i></a></li>
                        <li><a href="https://www.instagram.com/take_me_to_tanzania/" target="_blank"><i class="fa fa-3x fa-instagram text-danger"></i></a></li>
                        <li><a href="https://twitter.com/takemetotz?s=11" target="_blank"><i class="fa fa-3x fa-twitter"></i></a></li>
                        <li><a href="https://youtube.com/channel/UCQS4P5d9M6a9pf4Ri1DoL7w" target="_blank"><i class="fa fa-3x fa-youtube-play text-danger"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 welcome-text">
                <h1 class="bira mt-0">Tanzania Safari Tours - Take Me To Tanzania Adventure Safaris</h1>
                <hr>
                <p class="text-justify">Tanzania and its outstanding wildlife is our passion. That's why we know your tailor-made safari will be incredible. Luxury lodges and camps or nights under the stars. Being out in the wild or relaxing in a sundowner bar. Guided by Local trackers or travelling by 4x4 safari Vehicle. Inspired by real experience and created from authentic insights. Talk to our experts and we'll create your bespoke adventure!</p>
                <br>
                <h3><em>--- Travel with a purpose..! ---</em></h3>
            </div>
        </div>
        <div class="row tour-categories-section">
            <div class="col-md-12 intro-text">
                <h2 class="text-center bira">Tanzania Safari Styles</h2>
                <hr style="background: none; border: none; height: 2px; border-bottom: 4px solid gray; width: 30%; margin: 0 auto; margin-bottom: 15px">
                {{-- <p class="text-center">Tanzania and its outstanding wildlife is our passion. That's why we know your tailor-made safari will be incredible. Luxury lodges and camps or nights under the stars. Being out in the wild or relaxing in a sundowner bar. Guided by Local trackers or travelling by 4x4 safari Vehicle. Inspired by real experience and created from authentic insights. Talk to our experts and we'll create your bespoke adventure!</p> --}}
            </div>
            @if($tour_categories->count())
                <div class="mt-5">
                    @foreach($tour_categories->take(3) as $tour_category1)
                        @if($loop->first)
                            <div class="col-sm-12 col-md-6 image-container">
                                <div class="text1-on-overlay ubuntucondensed">
                                    {{ Str::limit($tour_category1->name, 50) }}
                                   {{-- @if($tour_category1->tours->count())<span class="tours-count">{{ $tour_category1->tours->count() }}</span>@endif --}}
                                </div>
                                <div class="text2-on-overlay">
                                    <h2 class="ubuntucondensed">{{ $tour_category1->name }}</h2>
                                    <p>{!! Str::limit($tour_category1->description, 200) !!}</p>
                                    <p><a href="/safaris/{{ $tour_category1->slug }}" class="btn btn-tmt-default">Read More</a></p>
                                </div>
                                <div class="image-overlay"></div>
                                <img src="{{ asset('images/tour_category_images/'.$tour_category1->photo) }}" alt="{{ $tour_category1->name }}"/>
                            </div>
                        @else
                            <div class="col-sm-6 col-md-3 image-container">
                                <div class="text1-on-overlay ubuntucondensed">
                                    {{ Str::limit($tour_category1->name, 25) }}
{{--                                    @if($tour_category1->tours->count())<span class="tours-count">{{ $tour_category1->tours->count() }}</span>@endif--}}
                                </div>
                                <div class="text2-on-overlay">
                                    <h2 class="ubuntucondensed">{{ $tour_category1->name }}</h2>
                                    <p>{!! Str::limit($tour_category1->description, 70) !!}</p>
                                    <p><a href="/safaris/{{ $tour_category1->slug }}" class="btn btn-tmt-default">Read More</a></p>
                                </div>
                                <div class="image-overlay"></div>
                                <img src="{{ asset('images/tour_category_images/'.$tour_category1->photo) }}" alt="{{ $tour_category1->name }}"/>
                            </div>
                        @endif
                    @endforeach
                    @foreach($tour_categories->slice(3)->take(3) as $tour_category2)
                        @if($loop->last)
                            <div class="col-sm-12 col-md-6 image-container">
                                <div class="text1-on-overlay ubuntucondensed">
                                    {{ Str::limit($tour_category2->name, 50) }}
{{--                                    @if($tour_category2->tours->count())<span class="tours-count">{{ $tour_category2->tours->count() }}</span>@endif--}}
                                </div>
                                <div class="text2-on-overlay">
                                    <h2 class="ubuntucondensed">{{ $tour_category2->name }}</h2>
                                    <p>{!! Str::limit($tour_category2->description, 200) !!}</p>
                                    <p><a href="/safaris/{{ $tour_category2->slug }}" class="btn btn-tmt-default">Read More</a></p>
                                </div>
                                <div class="image-overlay"></div>
                                <img src="{{ asset('images/tour_category_images/'.$tour_category2->photo) }}" alt="{{ $tour_category2->name }}"/>
                            </div>
                        @else
                            <div class="col-sm-6 col-md-3 image-container">
                                <div class="text1-on-overlay ubuntucondensed">
                                    {{ Str::limit($tour_category2->name, 25) }}
{{--                                    @if($tour_category2->tours->count())<span class="tours-count">{{ $tour_category2->tours->count() }}</span>@endif--}}
                                </div>
                                <div class="text2-on-overlay">
                                    <h2 class="ubuntucondensed">{{ $tour_category2->name }}</h2>
                                    <p>{!! Str::limit($tour_category2->description, 70) !!}</p>
                                    <p><a href="/safaris/{{ $tour_category2->slug }}" class="btn btn-tmt-default" aria-details="{{ $tour_category2->slug}}">Read More</a></p>
                                </div>
                                <div class="image-overlay"></div>
                                <img src="{{ asset('images/tour_category_images/'.$tour_category2->photo) }}" alt="{{ $tour_category2->name }}"/>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="col-md-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="text-center mb-3">3 EASY STEPS TO BOOK YOUR DREAM SAFARI WITH US</h3>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="row">
                                <div class="col-xs-3 text-center p-0"><img src="{{ asset('images/icons/discover-tours.png') }}" class="img-responsive" alt="Dicover Tours"/> STEP 1</div>
                                <div class="col-xs-9"><strong>Discover</strong><p>Browse our website for tour ideas. Send us a request and let us know what you’re looking for.</p></div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="row">
                                <div class="col-xs-3 text-center p-0"><img src="{{ asset('images/icons/customize-tour.png') }}" class="img-responsive" alt="Customize Tour"/> STEP 2</div>
                                <div class="col-xs-9"><strong>Customize</strong><p>Based on your request we will send you our best tour proposal. You can then get an itinerary customized to fit your preferences.</p></div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="row">
                                <div class="col-xs-3 text-center p-0"><img src="{{ asset('images/icons/book-trip.png') }}" class="img-responsive" alt="Book tour"/> STEP 3</div>
                                <div class="col-xs-9"><strong>Book Your Trip</strong><p>Once you’re satisfied with our customized proposal, book your chosen trip with TakeMeToTanzania</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- featured tours section -->
        @if($tours->where('featured',true)->count())
            <div class="row featured-tours-section">
                <div class="text-center"><hr class="hr-text bira" data-content="Featured Tanzania Safaris"></div>
                @foreach($tours->where('featured',true)->sortBy(function ($featured_tour) { return $featured_tour->days; })->take($tours->where('featured',true)->count() < 6 ? 3 : 6) as $featured_tour)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body p-0 featured-tour-photo">
                                <a href="/tours/{{ $featured_tour->slug }}"><img src="{{ asset('images/tour_photos/'.$featured_tour->photo) }}" alt="{{ $featured_tour->name }}"/></a>
                            </div>
                            <div class="panel-body featured-tour-content">
                                <h4 class="ubuntucondensed text-uppercase mt-0 mb-2">
                                    <a href="/tours/{{ $featured_tour->slug }}" class="tour-name">
{{--                                        {{ Str::limit($featured_tour->name, 28) }}--}}
                                        {{ $featured_tour->name }}
                                    </a>
                                </h4>
                                <div class="mb-2">
{{--                                    <i class="fa fa-fw fa-folder-open-o mr-1"></i>--}}
                                    @foreach($featured_tour->categories as $other_tour_category)
                                        @if($other_tour_category->icon)
                                            <img src="{{ asset('images/tour_category_icons/'.$other_tour_category->icon) }}"
                                                 alt="{{ $other_tour_category->name }}" title="{{ $other_tour_category->name }}"
                                                 style="max-height: 25px; margin-right: 15px"
                                            />
                                        @endif
                                    @endforeach
                                </div>
                                <p class="text-muted small assistant-light"><i class="fa fa-clock-o mr-1"></i>{{ $featured_tour->days }} {{ Str::plural('day',$featured_tour->days) }} @if($featured_tour->days > 1) / {{ $featured_tour->days - 1 }} nights @endif Tanzania Safari</p>
                                <hr>
                                <div class="text-justify text-muted">{{ Str::limit($featured_tour->overview, 120) }}</div>
                                <p class="mt-3 ubuntucondensed" style="display: flex; justify-content: space-between; align-items: center">
                                    <a href="/tours/{{ $featured_tour->slug }}" class="btn btn-warning">ENQUIRE NOW</a>
                                    @if($featured_tour->price) <span class="pull-right">{{--<span style="display: inline-block; margin-right: 5px; transform: translateY(-3px)">Deal :</span>--}}<span class="text-danger" style="font-size: 24px; font-weight: bold">US${{ number_format($featured_tour->price) }}</span></span> @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12"><p class="text-center"><a href="/tanzania/safaris" class="btn btn-lg btn-all-tours">BROWSE ALL TANZANIA SAFARI TOUR IDEAS {{ Date('Y') }} & {{ Date('Y') + 1 }}</a></p></div>
            </div>
        @endif

        <!--Latest News Section-->
        @if($posts->count())
            <div class="row latest-news mt-3">
                <div class="col-md-12 text-center"><hr class="hr-text bira" data-content="Our Blog, Latest News"></div>
                @foreach($posts->sortByDesc('created_at')->take(3) as $post)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body post-photo p-0">
                                <div class="post-date text-uppercase">
                                    <div class="date">{{ $post->created_at->format('d') }}</div>
                                    <div class="month">{{ $post->created_at->format('M') }}</div>
                                </div>
                                <a href="/{{ $post->categories->first()->slug }}/{{ $post->slug }}"><img src="{{ asset('images/post_images/'.$post->photo) }}" alt="{{ $post->name }}"/></a>
                            </div>
                            <div class="panel-body post-content">
                                <h4 class="text-uppercase ubuntucondensed">{{ $post->title }}</h4>
                                <p class="small text-muted"><em><i class="fa fa-user-circle mr-1"></i>By TMT Travel Specialist</em></p>
                                <a href="/{{ $post->categories->first()->slug }}/{{ $post->slug }}" class="text-uppercase">Read More<i class="fa fa-long-arrow-right ml-1"></i></a>
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
