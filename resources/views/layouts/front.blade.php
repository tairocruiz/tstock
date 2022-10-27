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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
    <link href="{{ asset('css/') }}" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
<div id="app">
    @include('front.includes.nav')

    <div class="container-fluid main-wide">
        @yield('content')

        <span id=".chat-widget">
            <script>
                (function(w,d,u){
                    var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                    var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
                })(window,document,'https://cdn.bitrix24.com/b18943283/crm/site_button/loader_2_alswf3.js');
            </script>
        </span>

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
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/smoothscroll.min.js') }}"></script>
<script src="{{ asset('js/public-scripts.js') }}" defer></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script src="public/js/app.js"></script>
<script>$('.textarea').ckeditor();</script>
</body>
</html>
