
@extends('customer.home')

@section('content')

@section('style')
<style>
  .map {
    position: relative;

}

.map:after {
    width: 22px;
    height: 40px;
    display: block;
    content: ' ';
    position: absolute;
    top: 50%; left: 50%;
    margin: -40px 0 0 -11px;
    background: url('https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi_hdpi.png');
    background-size: 22px 40px; /* Since I used the HiDPI marker version this compensates for the 2x size */
     pointer-events: none; /*This disables clicks on the marker. Not fully supported by all major browsers, though */
 }
        #map {
          /* border: 1px solid; */
    height: 50%;
  top: 66px
}

/* Optional: Makes the sample page fill the window. */
/* html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
} */

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  font-family: Roboto;
  padding: 0;

}

.conform
{
  margin-top: 40px;
    padding-top: 33px;
    padding-bottom: 12px;
  margin-right: 12px;
}
#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
  border-radius: 8px;
  border: 1px solid;
    margin-top: 10px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}

#target {
  width: 345px;
} */
    </style>

@endsection


<div class="login-page vh-100">
  <video loop autoplay muted id="vid">
      <source src="img/bg.mp4" type="video/mp4">
      <source src="img/bg.mp4" type="video/ogg">
      Your browser does not support the video tag.
   </video>
  <div class="row d-flex">
      <div class="col-md-6 ml-auto">

        <div class="login-page vh-100">
          <input id="pac-input" class="form-control" type="text" placeholder="Enter your location or drag marker" style="margin: 10px 4%;"/>
          <div id="map" class="map"></div>
          <div class="container conform">
            <div class="row justify-content-center">
                <div class="col-md-12">
                        <form method="post" action="{{route('delivery.location')}}"  id="myDeliveryLocation">
                        @csrf
                        <input type="hidden" id="lang" name="lang" readonly="readonly">
                        <input type="hidden" id="lat" name="lat" readonly="readonly">
                        <input type="hidden" id="selected" name="selected" readonly="readonly" value="1">
                        <input type="hidden" id="user_id" name="user_id" readonly="readonly" value="{{ Auth::user()->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-white" id="address" name="address" placeholder="Selected address" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-white" id="type" name="type" placeholder="Type (Home,Apparment)">
                                </div>
                            </div>
                        </div>

                        <div id="pass-info" class="clearfix"></div>
                        <div class="row">
                            <div class="col-12">
                                <label><input name="term" type="checkbox" value="" class="icheck" checked>Accept <a href="#0">terms and conditions</a>.</label>
                            </div>
                        </div><!-- End row  -->
                        <hr style="border-color:#ddd;">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div><!-- End col  -->
            </div><!-- End row  -->
        </div>
      </div>

      </div>
  </div>

</div>


@endsection


@section('postScript')

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


</script>


@endsection
