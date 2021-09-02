@php
    $appVersion = 1.1;
@endphp

    <!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="pizza, delivery food, fast food, sushi, take away, chinese, italian food">
        <meta name="description" content="">
        <meta name="author" content="Ansonika">

        @php
            $title = App\Models\GeneralSetting::find(1)->business_name;
            $favicon = App\Models\GeneralSetting::find(1)->favicon;
        @endphp

        <title>@yield('title') | @yield('subtitle')</title>

        <link rel="icon" href="{{ url('images/upload/'.$favicon) }}" type="image/png">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- <title>QuickFood - Quality delivery or take away food</title> -->

        <!-- Favicons-->
        <!--
        <link rel="shortcut icon" href="frontend/img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" type="image/x-icon" href="frontend/img/apple-touch-icon-57x57-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="frontend/img/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="frontend/img/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="frontend/img/apple-touch-icon-144x144-precomposed.png">
         -->

        <!-- GOOGLE WEB FONT -->
        <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

        <!-- BASE CSS -->
        <link href="{{ url('/frontend/css/animate.min.css')}}?v={{$appVersion}}" rel="stylesheet">
    	<link href="{{ url('/frontend/css/bootstrap.min.css')}}?v={{$appVersion}}" rel="stylesheet">
    	<link href="{{ url('/frontend/css/menu.css')}}?v={{$appVersion}}" rel="stylesheet">
    	<link href="{{ url('/frontend/css/style.css')}}?v={{$appVersion}}" rel="stylesheet">
    	<link href="{{ url('/frontend/css/responsive.css')}}?v={{$appVersion}}" rel="stylesheet">
    	<link href="{{ url('/frontend/css/elegant_font/elegant_font.min.css')}}?v={{$appVersion}}" rel="stylesheet">
    	<link href="{{ url('/frontend/css/fontello/css/fontello.min.css')}}?v={{$appVersion}}" rel="stylesheet">
    	<link href="{{ url('/frontend/css/magnific-popup.css')}}?v={{$appVersion}}" rel="stylesheet">
    	<link href="{{ url('/frontend/css/pop_up.css')}}?v={{$appVersion}}" rel="stylesheet">
        <link href="{{ url('/frontend/css/toastr/toastr.min.css')}}?v={{$appVersion}}" rel="stylesheet">
        <link href="{{ url('/frontend/css/map_select.css')}}?v={{$appVersion}}" rel="stylesheet">

    	<!-- Radio and check inputs -->
        <link href="{{ url('/frontend/css/skins/square/grey.css')}}?v={{$appVersion}}" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">

    	<!-- YOUR CUSTOM CSS -->
    	<link href="{{ url('/frontend/css/custom.css')}}?v={{$appVersion}}" rel="stylesheet">

        <!-- Modernizr -->
    	<script src="{{ url('/frontend/js/modernizr.js')}}?v={{$appVersion}}"></script>


        <!-- DYNAMIC COLOR SCHEME -->
        @php
            $color = App\Models\GeneralSetting::find(1)->site_color;
        @endphp
        <style>
            :root
            {
                --site_color: <?php echo $color; ?>;
                --hover_color: <?php echo $color.'c7'; ?>;
            }
        </style>
    </head>

    <body>

        <div id="preloader">
            <div class="sk-spinner sk-spinner-wave" id="status">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>
        </div><!-- End Preload -->


        @include('frontend.layouts.header_restaurant')

        @include('frontend.layouts.forms')

        @yield('content')

        @include('frontend.layouts.footer_restaurant')

        <div class="layer"></div><!-- Mobile menu overlay mask -->

        @include('frontend.layouts.extras')

        @include('frontend.layouts.modals')


        <!-- SPECIFIC PRE SCRIPTS CUSTOM -->
        @yield('preScript')

        <!-- PRE SCRIPTS -->
        <script type="text/javascript">
            const vendor_lat = "@yield('vendor_lat')";
            const vendor_lang = "@yield('vendor_lang')";

            var inProgress = false;
        </script>

        <!-- COMMON SCRIPTS -->
        <script src="{{ url('/frontend/js/jquery-3.5.1.min.js')}}?v={{$appVersion}}"></script>
        <script src="{{ url('/frontend/js/common_scripts_min.js')}}?v={{$appVersion}}"></script>
        <script src="{{ url('/frontend/js/functions.js')}}?v={{$appVersion}}"></script>
        <script src="{{ url('/frontend/assets/validate.js')}}?v={{$appVersion}}"></script>
        <script src="{{ url('/frontend/js/toastr/toastr.min.js')}}?v={{$appVersion}}"></script>

        <!-- PAYMENT SCRIPTS -->
        <script src="{{ url('/frontend/js/payment.js')}}?v={{$appVersion}}"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <?php /*
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script src="https://www.paypal.com/sdk/js?client-id={{ App\Models\PaymentSetting::first()->paypal_sendbox }}&currency={{ App\Models\GeneralSetting::first()->currency }}" data-namespace="paypal_sdk"></script>
        */ ?>

        <!-- GOOGLE MAP SCRIPTS -->
        <script src="https://maps.googleapis.com/maps/api/js?key={{ App\Models\GeneralSetting::first()->map_key }}&libraries=geometry,places&ext=.js"></script>
        <script src="{{ url('/frontend/js/map_select.js')}}?v={{$appVersion}}"></script>
        <script src="{{ url('/frontend/js/infobox.js')}}?v={{$appVersion}}"></script>
        <script src="{{ url('/frontend/js/ion.rangeSlider.js')}}?v={{$appVersion}}"></script>
        <script>
            $(function () {
                'use strict';
                $("#range").ionRangeSlider({
                    hide_min_max: true,
                    keyboard: true,
                    min: 0,
                    max: 15,
                    from: 0,
                    to:5,
                    type: 'double',
                    step: 1,
                    prefix: "Km ",
                    grid: true
                });
            });
        </script>

        <!-- SPECIFIC SCRIPTS -->
        <!-- Restaurants -->
        <script  src="{{ url('/frontend/js/cat_nav_mobile.js')}}?v={{$appVersion}}"></script>
        <script>$('#cat_nav').mobileMenu();</script>
        <script src="{{ url('/frontend/js/ResizeSensor.min.js')}}?v={{$appVersion}}"></script>
        <script src="{{ url('/frontend/js/theia-sticky-sidebar.min.js')}}?v={{$appVersion}}"></script>
        <script>
            jQuery('#sidebar').theiaStickySidebar({
              additionalMarginTop: 80
            });
        </script>

        <!-- SMOOTH SCROLL -->
        <script>
            $('#cat_nav a[href^="#"]').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
                    || location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                       if (target.length) {
                         $('html,body').animate({
                             scrollTop: target.offset().top - 60
                        }, 800);
                        return false;
                    }
                }
            });

            // toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');

            @if(Session::has('errors'))
                toastr.error("{{Session::get('errors')->first()}}");
            @endif
            @if(Session::has('success'))
                toastr.success("{{Session::get('success')}}");
            @endif
        </script>

        <!-- CART MODULE -->
        <script type="text/javascript">
            $(document).ready(function() {
                $(".c-btn-cart").click(function(e){
                    $(".customCart").show();
                    $('#cart_box').find($(".fa")).removeClass('fa-shopping-cart').addClass('fa-times-circle').css({color: 'var(--site_color)', cursor: 'pointer'});
                });
                $('#cart_box').find($(".fa")).click(function(e){
                    $(".customCart").hide();
                    $('#cart_box').find($(".fa")).removeClass('fa-times-circle').addClass('fa-shopping-cart').css({color: '#333', cursor: 'unset'});
                });
                $('.customCart').click(function(e){
                    if(e.target !== e.currentTarget) return;
                    $(".customCart").hide();
                    $('#cart_box').find($(".fa")).removeClass('fa-times-circle').addClass('fa-shopping-cart').css({color: '#333', cursor: 'unset'});
                });
            });
        </script>

        <!-- SPECIFIC SCRIPTS CUSTOM -->
        @yield('script')

        <!-- SPECIFIC SCRIPTS CUSTOM -->
        @yield('cart_script')

        <!-- CUSTOM SCRIPTS CUSTOM -->
        @include('frontend.layouts.scripts')

    </body>

</html>
