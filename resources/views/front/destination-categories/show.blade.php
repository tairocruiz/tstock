@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="images/destination_category_images/{{ $category->photo }}" class="img-responsive" alt="{{ $category->name }} Destinations">
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="bira"><i class="fa fa-map-marker text-danger mr-3"></i>{{ $category->name }}</h1>
                <hr>
            </div>
            <div class="col-md-12">
                <div class="text-justify mb-4">{!! $category->description !!}</div>

                @if($category->destinations->count())
                    <div class="row">
                        @foreach($category->destinations as $destination)
                            <div class="col-md-6">
                                <div class="panel panel-default panel-noroundcorners panel-raised">
                                    <div class="panel-body">
                                        <a href="/destinations/{{ $destination->slug }}" title="{{ $destination->name }}">
                                            <img src="images/destination_images/{{ $destination->photo }}" class="img-responsive" alt="{{ $destination->name }}">
                                        </a>
                                    </div>
                                    <div class="panel-footer">
                                        <h3 class="bira"><i class="fa fa-map-marker text-danger mr-2"></i>{{ $destination->name }}</h3>
                                        <hr>
                                        <div class="text-justify mb-4">
                                            {!! Str::limit($destination->description, 190) !!}
                                        </div>
                                        <a href="/destinations/{{ $destination->slug }}" class="btn btn-tmt-default text-uppercase">
                                            <i class="fa fa-angle-right mr-2"></i>Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        @include('front.includes.footer')
    </div>
@endsection