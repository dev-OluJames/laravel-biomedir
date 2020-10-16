<!DOCTYPE html>
<html lang="en">
<head>
    <title>Biomedir</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/styles/bootstrap4/bootstrap.min.css')}}">
    <link href="{{asset('asset/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/plugins/OwlCarousel2-2.2.1/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/plugins/slick-1.8.0/slick.css')}}">
    <!--link rel="stylesheet" type="text/css" href="{{asset('asset/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}"-->
    <link rel="stylesheet" type="text/css" href="{{asset('asset/styles/main_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/styles/responsive.css')}}">





    </head>
    <body>
    @include('flash-message')
    @yield('content')
    {{View::make('footer')}}

    <script src="{{asset('asset/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('asset/styles/bootstrap4/popper.js')}}"></script>
    <script src="{{asset('asset/styles/bootstrap4/bootstrap.min.js')}}"></script>
    <script src="{{asset('asset/plugins/greensock/TweenMax.min.js')}}"></script>
    <script src="{{asset('asset/plugins/greensock/TimelineMax.min.js')}}"></script>
    <script src="{{asset('asset/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
    <script src="{{asset('asset/plugins/greensock/animation.gsap.min.js')}}"></script>
    <script src="{{asset('asset/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
    <script src="{{asset('asset/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
    <script src="{{asset('asset/plugins/slick-1.8.0/slick.js')}}"></script>
    <script src="{{asset('asset/plugins/easing/easing.js')}}"></script>
    <script src="{{asset('asset/plugins/parallax-js-master/parallax.min.js')}}"></script>
    <script src="{{asset('asset/js/custom.js')}}"></script>
    <script src="{{asset('asset/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('asset/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
    <script src="{{asset('asset/js/shop_custom.js')}}"></script>
    <script src="{{asset('asset/js/product_custom.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
    <script src="{{asset('asset/js/contact_custom.js')}}"></script>



</body>

</html>
