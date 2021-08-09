$('#collapseMap').on('shown.bs.collapse', function(e){


});

defaultLatLong = {
  lat: 33.56511,
  lng: 73.01691
};

var map = new google.maps.Map(document.getElementById('map'), {
  center: defaultLatLong,
  zoom: 13,
  mapTypeId: 'roadmap',
  fullscreenControl: false,
});

var input = document.getElementById('pac-input');
var inputAddress = document.getElementById('address');
var inputLang = document.getElementById('lang');
var inputLat = document.getElementById('lat');

var autocomplete = new google.maps.places.Autocomplete(input);

autocomplete.bindTo('bounds', map);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

// var marker = new google.maps.Marker({
//   map: map,
//   position: defaultLatLong,
//   draggable: false,
//   clickable: true
// });

// marker.setAnimation(google.maps.Animation.BOUNCE);
// marker.setPosition( map.getCenter() );

// google.maps.event.addListener(map, 'dragend', function(argMarker) {
//   // marker.setPosition( map.getCenter() );

//   var latLng = map.getCenter();
//   currentLatitude = latLng.lat();
//   currentLongitude = latLng.lng();
//   var latlng = {
//     lat: currentLatitude,
//     lng: currentLongitude
//   };
//   var geocoder = new google.maps.Geocoder;
//   geocoder.geocode({
//     'location': latlng
//   }, function(results, status) {
//     if (status === 'OK') {
//       if (results[0]) {
//         input.value = results[0].formatted_address;
//     		inputAddress.value = results[0].formatted_address;
//     		inputLang.value = currentLongitude;
//     		inputLat.value = currentLatitude;
//       } else {
//         window.alert('No results found');
//       }
//     } else {
//       window.alert('Geocoder failed due to: ' + status);
//     }
//   });
// });

google.maps.event.addListener(map, "mouseover", function (e) {
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
                input.value = results[0].formatted_address;
                inputAddress.value = results[0].formatted_address;
                inputLang.value = currentLongitude;
                inputLat.value = currentLatitude;
              } else {
                window.alert('No results found');
              }
            } else {
              window.alert('Geocoder failed due to: ' + status);
            }
          });
        });
    });
});

// google.maps.event.addListener(marker, 'dragend', function(marker) {
//   var latLng = marker.latLng;
//   currentLatitude = latLng.lat();
//   currentLongitude = latLng.lng();
//   var latlng = {
//     lat: currentLatitude,
//     lng: currentLongitude
//   };
//   var geocoder = new google.maps.Geocoder;
//   geocoder.geocode({
//     'location': latlng
//   }, function(results, status) {
//     if (status === 'OK') {
//       if (results[0]) {
//         input.value = results[0].formatted_address;
//   		inputAddress.value = results[0].formatted_address;
// 		inputLang.value = currentLongitude;
// 		inputLat.value = currentLatitude;
//       } else {
//         window.alert('No results found');
//       }
//     } else {
//       window.alert('Geocoder failed due to: ' + status);
//     }
//   });
// });

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

	// marker.setPosition(place.geometry.location);

	currentLatitude = place.geometry.location.lat();
	currentLongitude = place.geometry.location.lng();
	inputAddress.value = place.formatted_address;
	inputLang.value = currentLongitude;
	inputLat.value = currentLatitude;

});
