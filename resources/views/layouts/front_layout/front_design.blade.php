<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700|Open+Sans:300,400,600,700"
          rel="stylesheet">
    <link href="{{ asset ('css/frontend_css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset ('css/frontend_css/bootstrap-responsive.css') }}" rel="stylesheet"/>
    <link href="{{ asset ('css/frontend_css/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/frontend_css/jcarousel.css') }}" rel="stylesheet"/>
    <link href="{{ asset ('css/frontend_css/flexslider.css') }}" rel="stylesheet"/>
    <link href="{{ asset ('css/frontend_css/cslider.css') }}" rel="stylesheet"/>
    <link href="{{ asset ('css/frontend_css/style.css') }}" rel="stylesheet"/>
    <link href="{{ asset ('css/frontend_css/font-awesome.css') }}" rel="stylesheet"/>
    <!-- Theme skin -->
    <link id="t-colors" href="{{ asset ('skins/default.css') }}" rel="stylesheet"/>
    <!-- boxed bg -->
    <link id="bodybg" href="{{ asset ('images/frontend_images/bodybg/bg1.png') }}" rel="stylesheet" type="text/css"/>

    <link rel="shortcut icon" href="{{ asset ('ico/favicon.png') }}"/>


</head>
<body>
<div id="app">
    <div id="wrapper">
        <!-- start header -->
    @include('layouts.front_layout.front_header')
    <!-- end header -->
    @yield('content')
    <!-- start footer -->
    @include('layouts.front_layout.front_footer')
    <!-- end footer -->
    </div>
</div>
</body>
<a href="#" class="scrollup"><i class="icon-chevron-up icon-square icon-32 active"></i></a>

<script defer src="{{ asset('js/app.js') }}"></script>
<!-- javascript
  ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset ('js/frontend_js/jquery.js') }}"></script>
<script src="{{ asset ('js/frontend_js/bootstrap.js') }}"></script>
<script src="{{ asset ('js/frontend_js/jcarousel/jquery.jcarousel.min.js') }}"></script>
<script src="{{ asset ('js/frontend_js/jquery.fancybox.pack.js') }}"></script>
<script src="{{ asset ('js/frontend_js/jquery.fancybox-media.js') }}"></script>
<script src="{{ asset ('js/frontend_js/google-code-prettify/prettify.js') }}"></script>
<script src="{{ asset ('js/frontend_js/portfolio/jquery.quicksand.js') }}"></script>
<script src="{{ asset ('js/frontend_js/portfolio/setting.js') }}"></script>
<script src="{{ asset ('js/frontend_js/jquery.flexslider.js') }}"></script>
<script src="{{ asset ('js/frontend_js/jquery.nivo.slider.js') }}"></script>
<script src="{{ asset ('js/frontend_js/modernizr.custom.js') }}"></script>
<script src="{{ asset ('js/frontend_js/jquery.ba-cond.min.js') }}"></script>
<script src="{{ asset ('js/frontend_js/jquery.slitslider.js') }}"></script>
<script src="{{ asset ('js/frontend_js/modernizr.custom.js') }}"></script>
<script src="{{ asset ('js/frontend_js/jquery.cslider.js') }}"></script>
<script src="{{ asset ('js/frontend_js/animate.js') }}"></script>
<!-- Template Custom JavaScript File -->
<script src="{{ asset ('js/frontend_js/custom.js') }}"></script>
{{--Vue--}}


</html>
