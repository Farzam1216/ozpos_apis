<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="Askbootstrap">
   <meta name="author" content="Askbootstrap">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   @php
      $title = App\Models\GeneralSetting::find(1)->business_name;
      $favicon = App\Models\GeneralSetting::find(1)->favicon;
   @endphp
   <link rel="icon" type="image/png" href="{{ url('images/upload/'.$favicon) }}">
   <title>@yield('title') | @yield('subtitle')</title>

   <!-- Slick Slider -->
   <link rel="stylesheet" type="text/css" href="{{ url('/customer/vendor/slick/slick.min.css')}}?v={{ env('APP_V') }}"/>
   <link rel="stylesheet" type="text/css" href="{{ url('/customer/vendor/slick/slick-theme.min.css')}}?v={{ env('APP_V') }}"/>
   <!-- Feather Icon-->
   <link href="{{ url('/customer/vendor/icons/feather.css')}}?v={{ env('APP_V') }}" rel="stylesheet" type="text/css">
   <!-- Bootstrap core CSS -->
   <link href="{{ url('/customer/vendor/bootstrap/css/bootstrap.min.css')}}?v={{ env('APP_V') }}" rel="stylesheet">
   <!-- Custom styles for this template -->
   <link href="{{ url('/customer/css/style.css')}}?v={{ env('APP_V') }}" rel="stylesheet">
   <!-- Sidebar CSS -->
   <link href="{{ url('/customer/vendor/sidebar/demo.css')}}?v={{ env('APP_V') }}" rel="stylesheet">

   <!-- Dynamic Color Scheme -->
   @php
      $color = App\Models\GeneralSetting::find(1)->site_color;
   @endphp
   <style>
       :root {
           --site_color: <?php echo $color; ?>;
           --hover_color: <?php echo $color.'c7'; ?>;
       }
   </style>
</head>
<style>
    #overlay {
        position: fixed;
        z-index: 99999;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.9);
        transition: 1s 0.4s;
    }
</style>
<div id="overlay">
   <img src="{{ url('/images/loading.gif') }}" alt="Loading" style="width:100%;height:100%;" />
</div>
<body class="fixed-bottom-bar">

@include('customer.layouts.single.header')

@yield('content')

@include('customer.layouts.single.footer_phone')

@include('customer.layouts.single.footer')

@include('customer.layouts.single.nav')

@include('customer.modals.filters')

@yield('custom_modals')

{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c&libraries=drawing&v=3"></script> --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c&libraries=geometry,places&ext=.js"></script>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ url('/customer/vendor/jquery/jquery.min.js')}}?v={{ env('APP_V') }}"></script>
<script type="text/javascript" src="{{ url('/customer/vendor/bootstrap/js/bootstrap.bundle.min.js')}}?v={{ env('APP_V') }}"></script>
<script type="text/javascript" src="{{ url('/customer/vendor/jquery/jquery.mycart.js')}}?v={{ env('APP_V') }}"></script>
<!-- slick Slider JS-->
<script type="text/javascript" src="{{ url('/customer/vendor/slick/slick.min.js')}}?v={{ env('APP_V') }}"></script>
<!-- Sidebar JS-->
<script type="text/javascript" src="{{ url('/customer/vendor/sidebar/hc-offcanvas-nav.js')}}?v={{ env('APP_V') }}"></script>
<!-- Custom scripts for all pages-->
<script type="text/javascript" src="{{ url('/customer/js/osahan.js')}}?v={{ env('APP_V') }}"></script>


<script type="text/javascript">
   $(window).on('load', function(){
      $('#overlay').fadeOut();
   });
</script>

<!-- Post scripts for all pages-->
@yield('postScript')
</body>
</html>
