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
        <title>{{ $title }} | @yield('title')</title>

        <!-- Slick Slider -->
        <link rel="stylesheet" type="text/css" href="{{ url('/customer/vendor/slick/slick.min.css')}}?v={{ env('APP_V') }}" />
        <link rel="stylesheet" type="text/css" href="{{ url('/customer/vendor/slick/slick-theme.min.css')}}?v={{ env('APP_V') }}" />
        <!-- Feather Icon-->
        <link href="{{ url('/customer/vendor/icons/feather.css')}}?v={{ env('APP_V') }}" rel="stylesheet" type="text/css">
        <!-- Bootstrap core CSS -->
        <link href="{{ url('/customer/vendor/bootstrap/css/bootstrap.min.css')}}?v={{ env('APP_V') }}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ url('/customer/css/style.css')}}?v={{ env('APP_V') }}" rel="stylesheet">
        <!-- Sidebar CSS -->
        <link href="{{ url('/customer/vendor/sidebar/demo.css')}}?v={{ env('APP_V') }}" rel="stylesheet">
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <!-- Dynamic Color Scheme -->
        @php
            $color = App\Models\GeneralSetting::find(1)->site_color;
        @endphp
        @yield('style')
        <style>
            :root
            {
                --site_color: <?php echo $color; ?>;
                --hover_color: <?php echo $color.'c7'; ?>;
            }
        </style>
    </head>
    <body class="fixed-bottom-bar">

        @include('customer.layouts.single.header')

        @yield('content')

        @include('customer.layouts.single.footer')

        @include('customer.layouts.single.nav')

        @include('customer.modals.filters')

        <!-- Bootstrap core JavaScript -->

        <script type="text/javascript">
          const vendor_lat = "@yield('vendor_lat')";
          const vendor_lang = "@yield('vendor_lang')";

          var inProgress = false;
      </script>



        <script src="{{ url('/customer/js/map_select.js')}}"></script>
        <script type="text/javascript" src="{{ url('/customer/vendor/jquery/jquery.min.js')}}?v={{ env('APP_V') }}"></script>
        <script type="text/javascript" src="{{ url('/customer/vendor/bootstrap/js/bootstrap.bundle.min.js')}}?v={{ env('APP_V') }}"></script>
        <!-- slick Slider JS-->
        <script type="text/javascript" src="{{ url('/customer/vendor/slick/slick.min.js')}}?v={{ env('APP_V') }}"></script>
        <!-- Sidebar JS-->
        <script type="text/javascript" src="{{ url('/customer/vendor/sidebar/hc-offcanvas-nav.js')}}?v={{ env('APP_V') }}"></script>
        <!-- Custom scripts for all pages-->
        <script type="text/javascript" src="{{ url('/customer/js/osahan.js')}}?v={{ env('APP_V') }}"></script>

        <!-- Post scripts for all pages-->
        {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c&callback=initAutocomplete&libraries=places&v=weekly"
        async
      ></script> --}}
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c&libraries=geometry,places&ext=.js"></script>


      @yield('postScript')
      <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
      {!! Toastr::message() !!}
    </body>
</html>
