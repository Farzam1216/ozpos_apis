defaultLatLong = {
  lat: 33.56511,
  lng: 73.01691
};

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

var autocomplete = new google.maps.places.Autocomplete(input);

autocomplete.bindTo('bounds', map);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

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

fetch("https://restcountries.eu/rest/v2/name/"+vendor_country).then(resp=>{
  return resp.json();
}).then(json=>{
  autocomplete.setComponentRestrictions({
    country: [json[0].alpha2Code],
  });
});

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
