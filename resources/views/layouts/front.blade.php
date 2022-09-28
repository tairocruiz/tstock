<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(isset($title))
            {{ $title }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/public-style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
<div id="app">
    @include('front.includes.nav')

    <div class="container-fluid main-wide">
        @yield('content')

        {{--scroll top top button--}}
        <a href="#" id="scroll-to-top">
            <span class="fa-stack fa-2x">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-angle-up fa-stack-1x fa-inverse"></i>
            </span>
        </a>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/smoothscroll.min.js') }}"></script>
<script src="{{ asset('js/public-scripts.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>$('.textarea').ckeditor();</script>
</body>
</html>