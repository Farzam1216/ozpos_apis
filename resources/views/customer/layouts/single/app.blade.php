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
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c&libraries=geometry,places&ext=.js"></script> --}}

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
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
      {!! Toastr::message() !!}
<!-- Post scripts for all pages-->
@yield('postScript')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c&libraries=geometry,places&ext=.js"></script>
<script>

// const defaultLatLong = {
//   lat: parseFloat(vendor_lat),
//   lng: parseFloat(vendor_lang),
// };

const defaultLatLong = { lat: 40.749933, lng: -73.98633 };


var map = new google.maps.Map(document.getElementById('map'), {
  center: defaultLatLong,
  zoom: 13,
  mapTypeId: 'roadmap',
  fullscreenControl: false,
  mapTypeControl: false,
  streetViewControl: false,
  gestureHandling: 'greedy'
});


var input = document.getElementById('pac-input');
var inputAddress = document.getElementById('address');
var inputLang = document.getElementById('lang');
var inputLat = document.getElementById('lat');


const geocoder = new google.maps.Geocoder();
var autocomplete = new google.maps.places.Autocomplete(input);


autocomplete.bindTo('bounds', map);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


geocoder
  .geocode({ location: defaultLatLong })
  .then((response) => {
    if (response.results[0]) {
      for (var i = 0; i < response.results[0].address_components.length; i++) {
      //   }
        if (response.results[0].address_components[i].types[0] == "country") {
          vendor_country = response.results[0].address_components[i].long_name;
          autocomplete.setComponentRestrictions({
            country: [response.results[0].address_components[i].short_name],
          });
          break;
        }
      }
    } else {
      window.alert("No results found");
    }
  })
.catch((e) => window.alert("Geocoder failed due to: " + e));


autocomplete.addListener('place_changed', function() {
	var place = autocomplete.getPlace();
	if (!place.geometry) {
	 return;
	}
	if (place.geometry.viewport) {
	 map.fitBounds(place.geometry.viewport);
	} else {
	 map.setCenter(place.geometry.location);
	}

	currentLatitude = place.geometry.location.lat();
	currentLongitude = place.geometry.location.lng();
	inputAddress.value = place.formatted_address;
	inputLang.value = currentLongitude;
	inputLat.value = currentLatitude;

});


google.maps.event.addListener(map, "dragend", function (argMarker) {
    setTimeout(() => {
      var latLng = map.getCenter();
      currentLatitude = latLng.lat();
      currentLongitude = latLng.lng();
      var latlng = {
        lat: currentLatitude,
        lng: currentLongitude
      };
      var geocoder = new google.maps.Geocoder;
      geocoder.geocode({
        'location': latlng
      }, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {

            var restricted = true;
            for (var i = 0; i < results[0].address_components.length; i++) {
              if (results[0].address_components[i].types[0] == "country" && results[0].address_components[i].long_name.toLowerCase() == vendor_country.toLowerCase()) {
                restricted = false;

              }
              if (results[0].address_components[i].types.length == 2) {
                if (results[0].address_components[i].types[0] != "political" && results[0].address_components[i].long_name.toLowerCase() == vendor_country.toLowerCase()) {
                  restricted = false;
                }
              }
            }
            if (!restricted) {
              input.value = results[0].formatted_address;
              inputAddress.value = results[0].formatted_address;
              inputLang.value = currentLongitude;
              inputLat.value = currentLatitude;
            }
            else {
              map.setCenter(defaultLatLong);
              map.setZoom(13);
              input.value = '';
              inputAddress.value = '';
              window.alert('Pick a location within country '+vendor_country);
            }
          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
    });
});

 function changeAddress(event)
 {
     console.log($(event).val());
   var address_id = $(event).val();

    let base_url = window.location.origin;


    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
      url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/change-address",
      @else
      url:"{{route('customer.change.address')}}",
      @endif
      method: "GET",
      data:{address_id:address_id},
      success: function(data) {

        window.location.reload();
      }
    });


    }

</script>
</body>
</html>
