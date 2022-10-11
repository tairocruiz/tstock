<div class="nav container-fluid">
    <div class="mobile-logo"><a href="/"><img src="/storage/generic_images/logo-lion-white.png" alt="{{ config('app.name') }}"></a></div>
    <div class="mobile-menu-open ubuntucondensed"><a href="#"><i class="fa fa-bars"></i><span class="ml-2 word-menu">MENU</span></a></div>
    <nav class="tmt-navbar ubuntucondensed">
        <ul class="center text-uppercase">
            <li class="sub-menu">
                <a href="#"><i class="fa fa-angle-right mr-2 visible-xs"></i>About</a>
                @if(!is_null($pages->where('resource',0)->count()))
                    <ul class="dropdown">
                        @foreach($pages->where('resource',0) as $page)
                            <li>
                                <a href="/{{ $page->slug }}">
                                    <i class="fa fa-angle-right mr-2"></i>{{ $page->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            <li class="sub-menu">
                <a href="/tanzania/safaris"><i class="fa fa-angle-right mr-2 visible-xs"></i>Tours</a>
                @if(!is_null($tour_categories->count()))
                    <ul class="dropdown">
                        @foreach($tour_categories->where('special',0) as $category)
                            <li>
                                <a href="/safaris/{{ $category->slug }}">
                                    <i class="fa fa-angle-right mr-2"></i>{{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            <li class="sub-menu">
                <a href="/tanzania/places-to-go"><i class="fa fa-angle-right mr-2 visible-xs"></i>Destinations</a>
                @if($destination_categories->count())
                    <ul class="dropdown">
                        @foreach($destination_categories as $category)
                            @if($category->destinations->count())
                                <li>
                                    <a href="/places-to-go/{{ $category->slug }}">
                                        <i class="fa fa-angle-right mr-2"></i>{{ $category->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
            <li id="logo-container">
                <a href="/">
                    <img src="/storage/generic_images/logo-lion.png" class="logo img-responsive" alt="Take Me To Tanzania" title="Take Me To Tanzania Adventure Tours & Safaris">
                    <img src="/storage/generic_images/logo-white.png" class="hidden-xs hidden-sm logo-text img-responsive" alt="Take Me To Tanzania">
                </a>
            </li>
            <li class="sub-menu">
                <a href="#"><i class="fa fa-angle-right mr-2 visible-xs"></i>Specials</a>
                @if(!is_null($tour_categories->where('special',1)->count()))
                    <ul class="dropdown">
                        @foreach($tour_categories->where('special',1) as $category)
                            <li>
                                <a href="/safaris/{{ $category->slug }}">
                                    <i class="fa fa-angle-right mr-2"></i>{{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            <li class="sub-menu">
                <a href="#"><i class="fa fa-angle-right mr-2 visible-xs"></i>Resources</a>
                @if(!is_null($pages->where('resource',1)->count()))
                    <ul class="dropdown">
                            <li><a href="/tourism/blog"><i class="fa fa-angle-right mr-2"></i>Tourism Blog</a></li>
                        @foreach($pages->where('resource',1) as $page)
                            <li>
                                <a href="/{{ $page->slug }}">
                                    <i class="fa fa-angle-right mr-2"></i>{{ $page->name }}
                                </a>
                            </li>
                        @endforeach
                            <li><a href="/tour/gallery"><i class="fa fa-angle-right mr-2"></i>Photos & Videos</a></li>
                    </ul>
                @endif
            </li>
            <li><a href="/safari/contacts"><i class="fa fa-angle-right mr-2 visible-xs"></i>Contacts</a></li>
            <li class="mobile-menu-close">
                <a href="#"><i class="fa fa-2x fa-times mr-2"></i></a>
            </li>
            <li class="logo-text-grey">
                <a href="/">
                    <img src="/storage/generic_images/logo-text-grey.png" class="logo-text img-responsive" alt="Take Me To Tanzania">
                </a>
            </li>
        </ul>
    </nav>
</div>
