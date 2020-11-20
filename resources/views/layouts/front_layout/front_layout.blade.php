<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cloud Store online Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Front style -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link id="callCss" rel="stylesheet" href="{{ url('css/front_css/front.min.css') }}" media="screen"/>
    <link href="{{ url('css/front_css/base.css') }}" rel="stylesheet" media="screen"/>
    <!-- Front style responsive -->
    <link href="{{ url('css/front_css/front-responsive.min.css')}}" rel="stylesheet"/>
    <link href="{{ url('css/front_css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="{{ url('js/front_js/google-code-prettify/prettify.css') }}" rel="stylesheet"/>
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="{{ asset('images/front_image/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/front_image/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/front_image/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/front_image/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/front_image/ico/apple-touch-icon-57-precomposed.png')}}">
    <style type="text/css" id="enject"></style>
</head>
<body>
@include('layouts.front_layout.front_header')
<!-- Header End====================================================================== -->
@yield('carousel')
<div id="mainBody">
    <div class="container">
        <div class="row">
            <!-- Sidebar ================================================== -->
            @include('layouts.front_layout.front_sidebar')
            <!-- Sidebar end=============================================== -->
            @yield('content')
        </div>
    </div>
</div>
<!-- Footer ================================================================== -->
@include('layouts.front_layout.front_footer')
<!-- Placed at the end of the document so the pages load faster ============================================= -->
<script src="{{url('js/front_js/jquery.js')}}" type="text/javascript"></script>
<script src="{{url('js/front_js/front.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/front_js/google-code-prettify/prettify.js')}}"></script>

<script src="{{url('js/front_js/front.js')}}"></script>
<script src="{{url('js/front_js/jquery.lightbox-0.5.js')}}"></script>

</body>
</html>
