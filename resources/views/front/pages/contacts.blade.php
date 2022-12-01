@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            @if(isset($booked_tour))
                <img src="{{ asset('images/tour_photos/'.$booked_tour->photo) }}" class="img-responsive" alt="{{ $booked_tour->name }}"/>
            @else
                <img src="{{ asset('images/page_images/contacts.jpg') }}" class="img-responsive" alt="Contact us for Tanzania Safari"/>
            @endif
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">@include('front.includes.msg')</div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <h1 class="bira text-center">{{ $title }}</h1>
                <hr>
                <p>Are you happy with your choices? send your ideas to us via the form below with a time that's best to call you or simply give us a call to book your tailor-made safari of a lifetime. You could even save your shortlist for later, or share them with friends and family.</p>
            </div>
            <div class="col-md-6" style="border-right: 1px dashed #e0dfe3">
                <form action="{{ action('App\Http\Controllers\PageController@booking') }}" method="POST">
                    @method('POST')
                   {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Your Full Name</label>
                        <input type="text" name="name" id="name" class="input-lg form-control" placeholder="your full name" required autofocus>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">Your Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="you@website.com" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="country">Country of Origin</label>
                            <input type="text" name="country" id="country" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="package">Safari Package of Choice</label>
                        @if(isset($booked_tour))
                            <input type="text" name="package" id="package" class="form-control input-lg" value="{{ $booked_tour->name }}" readonly required>
                            <input type="hidden" name="tour_id" value="{{ $booked_tour->id }}">
                        @else
                        <select name="tour_id" id="package" class="form-control input-lg" required>
                            <option value="" selected disabled>--- Choose Safari Package ---</option>
                            @if($tours->count())
                                @foreach($tours as $tour)
                                    <option value="{{ $tour->id }}">{{ $tour->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="enquiry">Your Enquiries</label>
                        <textarea name="enquiry" id="enquiry" cols="30" rows="10" class="form-control" placeholder="Please tell us more of what you want from us or the customization you would like to make to the chosen package above..." required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-send mr-2"></i>Submit</button>
                        <button type="reset" class="btn btn-lg btn-default"><i class="fa fa-times mr-1"></i>Clear</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                @if(isset($booked_tour))
                    <div class="panel panel-warning">
                        <div class="panel-heading"><h3 class="mt-0 assistant-light">Chosen Tour - fill your details to Book or Enquire!</h3></div>
                        <div class="panel-body text-justify">
                            {{ Str::limit($booked_tour->overview, 600) }}
                        </div>
                        <div class="p-2 mb-3">
                            <span class="assistant-light mr-3">Chosen Tour Categories</span>
                            @foreach($booked_tour->tour_category as $other_tour_category)
                                @if($other_tour_category->icon)
                                    <img src="images/tour_category_icons/{{ $other_tour_category->icon }}"
                                         alt="{{ $other_tour_category->name }}" title="{{ $other_tour_category->name }}"
                                         style="max-height: 25px; margin-right: 15px"
                                    >
                                @endif
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <h3 class="ubuntucondensed"><i class="fa fa-check text-warning mr-2"></i>{{ $booked_tour->name }}</h3>
                            <div class="text-justify assistant-light">{!! Str::limit($booked_tour->meta_description, 250) !!}</div>
                            @if($booked_tour->price)
                                <h3 class="assistant-light text-danger mt-3"><small>from only</small> USD {{ number_format($booked_tour->price) }}- pp</h3>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="assistant-light mt-0">Physical Address & Contacts</h3>
                        </div>
                        <div class="panel-body">
                            <address>
                                <h3>{{ config('app.name') }}</h3>
                                <p>P.O. Box 13340 Arusha Tanzania</p>
                                <p>
                                    <i class="fa fa-fw fa-phone text-success mr-2"></i><a href="tel:+255 764 863068">+255 764 863068</a> <br>
                                </p>
                                <p>
                                    <i class="fa fa-fw fa-envelope mr-2"></i><a href="mailto:info@takemetotanzania.com">info@takemetotanzania.com</a> <br>
                                    <i class="fa fa-fw fa-globe mr-2"></i><a href="https://takemetotanzania.com">https://takemetotanzania.com</a>
                                </p>
                            </address>
                            <ul class="list-inline mt-4">
                                <li class="mr-2"><a class="text-muted" href="https://www.tripadvisor.com/UserReviewEdit-g297913-d19432995-Take_Me_To_Tanzania_Adventure_Safaris-Arusha_Arusha_Region.html" target="_blank"><i class="fa fa-3x fa-tripadvisor"></i></a></li>
                                <li class="mr-2"><a class="text-muted" href="https://web.facebook.com/TakemetoTanzania/" target="_blank"><i class="fa fa-3x fa-facebook-square"></i></a></li>
                                <li class="mr-2"><a class="text-muted" href="https://Twitter.com/ToTanzania/" target="_blank"><i class="fa fa-3x fa-twitter"></i></a></li>
                                <li class="mr-2"><a class="text-muted" href="https://www.instagram.com/take_me_to_tanzania/" target="_blank"><i class="fa fa-3x fa-instagram"></i></a></li>
                                <li class="mr-2"><a class="text-muted" href="https://wa.me/+255764863068" target="_blank"><i class="fa fa-3x fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5962.921052008647!2d36.69121939933243!3d-3.372374387091142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371c88f2387383%3A0xbc1907f7ec497152!2sArusha!5e0!3m2!1sen!2stz!4v1569147975893!5m2!1sen!2stz" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
    {{--<div class="container-fluid p-0">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12 p-0">--}}
                {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5962.921052008647!2d36.69121939933243!3d-3.372374387091142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18371c88f2387383%3A0xbc1907f7ec497152!2sArusha!5e0!3m2!1sen!2stz!4v1569147975893!5m2!1sen!2stz" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
