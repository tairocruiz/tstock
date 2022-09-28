
@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="/storage/tour_images/{{ $tour->photo }}" class="img-responsive" alt="{{ $tour->name }}">
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira"><i class="fa fa-paw text-danger mr-3"></i>{{ $tour->name }}</h1>
                <hr>
            </div>
            <div class="col-md-8">
                {{--<p class="mb-3"><em>{{ $tour->meta_description }}</em></p>--}}
                <span class="text-justify">{!! $tour->description !!}</span>
            </div>
            <div class="col-md-4">
                @if(!is_null($tour->price))
                    <div class="panel panel-default mb-4">
                        <div class="panel-body">
                            <h2 class="assistant-light mt-0 text-center">Tour Duration & Pricing</h2>
                            <hr>
                            <h3 class="ubuntucondensed text-center">{{ $tour->days }} Days Safari <small>from </small><span class="text-danger">US${{ number_format($tour->price) }}</span></h3>
                        </div>
                        <div class="panel-footer p-0">
                            <form action="{{ action('PageController@contacts') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $tour->id }}">
                                <button class="btn btn-lg btn-warning btn-block text-uppercase no-round-corners">
                                    <i class="fa fa-caret-square-o-right mr-2"></i>Make Booking for This Tour
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="panel panel-default mb-4">
                        <div class="panel-body">
                            <h2 class="assistant-light mt-0 text-center">Interested in this Tour?</h2>
                        </div>
                        <div class="panel-footer p-0">
                            <form action="{{ action('PageController@contacts') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $tour->id }}">
                                <button class="btn btn-lg btn-warning btn-block text-uppercase no-round-corners">
                                    <i class="fa fa-caret-square-o-right mr-2"></i>Enquire About This Tour
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
                @if($tour->categories->first()->tours->count() > 3)
                    <div class="list-group">
                        <h4 class="list-group-item text-uppercase ubuntucondensed"><i class="fa fa-fw fa-chevron-right mr-2"></i>Other {{ $tour->categories->first()->name }}</h4>
                        @foreach($tour->categories->first()->tours->where('id','!=',$tour->id) as $tour)
                            <a href="/tours/{{ $tour->slug }}" class="list-group-item">
                                <i class="fa fa-fw fa-angle-right mr-2"></i>{{ $tour->name }}
                            </a>
                        @endforeach
                    </div>
                @elseif($tour->categories->first()->tours->count() < 3)
                    <div class="list-group">
                        <h4 class="list-group-item text-uppercase ubuntucondensed"><i class="fa fa-fw fa-chevron-right mr-2"></i>Other Tanzania Safaris</h4>
                        @foreach($tours->where('id','!=',$tour->id) as $tour)
                            <a href="/tours/{{ $tour->slug }}" class="list-group-item">
                                <i class="fa fa-fw fa-angle-right mr-2"></i>{{ $tour->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
                @if(strlen($tour->description) > 3000 && $tours->count() < 10)
                    @foreach($destination_categories->take(5) as $destination_category)
                        <div class="panel panel-default">
                            <div class="panel-body p-0">
                                <img src="/storage/destination_category_images/{{ $destination_category->photo }}" class="img-responsive" alt="{{ $destination_category->name }}">
                            </div>
                            <div class="panel-footer assistant-light text-muted">{{ $destination_category->name }} Places</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection