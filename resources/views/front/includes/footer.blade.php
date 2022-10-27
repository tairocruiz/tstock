
    <div class="row footer">
        <div class="col-lg-3">
            <h3 class="bira"><i class="fa fa-fw fa-info-circle mr-2"></i>About us - TMT</h3>
            <div class="text-justify">
                {!! Str::limit($pages->where('slug','about-us-tmt')->first()->description, 250) !!}
                <a href="/{{ $pages->where('slug','about-us-tmt')->first()->slug }}" class="pull-right"><i class="fa fa-arrow-right mr-2"></i>More</a>
            </div>
        </div>
        <div class="col-sm-4 col-lg-3">
            <h3 class="bira"><i class="fa fa-fw fa-paw mr-2"></i>Tanzania Safaris</h3>
            @if($tour_categories->count())
                <ul class="list-unstyled">
                    @foreach($tour_categories->sortByDesc(function ($tour_category){return $tour_category->tours->count();})->take(6) as $tour_category)
                        <li>
                            <a href="/safaris/{{ $tour_category->slug }}" title="{{ $tour_category->name }}">
                                <i class="fa fa-angle-right mr-2"></i>{{ $tour_category->name }}
                            </a>
                        </li>
                    @endforeach
                        <li><a href="/safari-tours/tailor-made"><i class="fa fa-angle-right mr-2"></i>Tailor Made Safari</a></li>
                </ul>
            @endif
        </div>
        <div class="col-sm-4 col-lg-3">
            <h3 class="bira"><i class="fa fa-fw fa-map-pin mr-2"></i>Places to Go</h3>
            @if($destination_categories->count())
                <ul class="list-unstyled">
                    @foreach($destination_categories->sortByDesc(function ($destination_category){return $destination_category->destinations->count();})->take(6) as $destination_category)
                        <li>
                            <a href="/places-to-go/{{ $destination_category->slug }}" title="{{ $destination_category->name }}">
                                <i class="fa fa-angle-right mr-2"></i>{{ $destination_category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-sm-4 col-lg-3">
            <h3 class="bira"><i class="fa fa-fw fa-globe mr-2"></i>Contacts</h3>
            <address>
                <strong class="ubuntucondensed">{{ config('app.name') }}</strong><br>
                <p>
                    P. O. Box 13340 Arusha, <br>
                    United Republic of Tanzania <br>
                    <abbr title="Telephone" class="mr-2"><i class="fa fa-phone"></i></abbr><a href="tel:+255 764 863068">+255 764 863068</a> <br>
                    <abbr title="Email" class="mr-2"><i class="fa fa-envelope-o"></i></abbr><a href="mailto:info@takemetotanzania.com">info@takemetotanzania.com</a> <br>
                    <abbr title="Website" class="mr-2"><i class="fa fa-globe"></i></abbr><a href="https://takemetotanzania.com" target="_blank">https://takemetotanzania.com</a>
                </p>
            </address>
            <ul class="list-inline">
                <li><a href="https://www.tripadvisor.com/UserReviewEdit-g297913-d19432995-Take_Me_To_Tanzania_Adventure_Safaris-Arusha_Arusha_Region.html" title="Review us on TripAdvisor" target="_blank"><i class="fa fa-lg fa-tripadvisor"></i></a></li>
                <li><a href="https://facebook.com/TakemetoTanzania/" title="Follow us on Facebook" target="_blank"><i class="fa fa-lg fa-facebook-square"></i></a></li>
                <li><a href="https://Twitter.com/ToTanzania/" title="Follow us on Twitter" target="_blank"><i class="fa fa-lg fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/take_me_to_tanzania" title="Follow us on Instagram" target="_blank"><i class="fa fa-lg fa-instagram"></i></a></li>
                <li><a href="https://wa.me/+255764863068" title="WhatsApp us" target="_blank"><i class="fa fa-lg fa-whatsapp"></i></a></li>
            </ul>
        </div>

        {{--bootom bar--}}
        <div class="col-md-12 bottom-bar-footer">
            <span class="assistant-light">&copy; {{ Date('Y') }} {{ config('app.name') }}. All Rights Reserved</span>
            <span class="assistant-light pull-right">Developed & Powered by <span class="powered spaceage"><a href="https://akiditechnologies.com" target="_blank" title="AKIDI Technologies">aKIDI</a></span></span>
        </div>
    </div>