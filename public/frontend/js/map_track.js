const iconBase =
    "http://maps.google.com/mapfiles/kml/shapes/";
const icons = {
    user: {
        icon: iconBase + "man.png",
    },
    library: {
        icon: iconBase + "library_maps.png",
    },
    info: {
        icon: iconBase + "info-i_maps.png",
    },
};

var map = new google.maps.Map(document.getElementById('track-map'), {
    center: {
        lat: parseFloat(vendorLat),
        lng: parseFloat(vendorLang),
    },
    zoom: 2,
    mapTypeId: 'roadmap',
    fullscreenControl: false,
    mapTypeControl: false,
    streetViewControl: false,
    gestureHandling: 'greedy'
});

var vendorMarker = new google.maps.Marker({
    position: {
        lat: parseFloat(vendorLat),
        lng: parseFloat(vendorLang),
    },
    map: map,
    draggable: false
});

var userMarker = new google.maps.Marker({
    position: {
        lat: parseFloat(userLat),
        lng: parseFloat(userLang),
    },
    icon: icons['user'].icon,
    map: map,
    draggable: false
});


var start = new google.maps.LatLng(parseFloat(userLat), parseFloat(userLang));
var end = new google.maps.LatLng(parseFloat(vendorLat), parseFloat(vendorLang));

var directionsDisplay = new google.maps.DirectionsRenderer();
directionsDisplay.setMap(map);

var directionsService = new google.maps.DirectionsService();

var bounds = new google.maps.LatLngBounds();
bounds.extend(start);
bounds.extend(end);
map.fitBounds(bounds);
var request = {
    origin: start,
    destination: end,
    travelMode: google.maps.TravelMode.DRIVING
};
directionsService.route(request, function (response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        directionsDisplay.setMap(map);
        console.log(response);
    } else {
        alert("Directions Request from " + userMarker.toUrlValue(6) + " to " + vendorMarker.toUrlValue(6) + " failed: " + status);
    }
});

function mapLocation() {
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var chicago = new google.maps.LatLng(33.628289, 73.070952);
        var mapOptions = {
            zoom: 7,
            center: chicago
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsDisplay.setMap(map);
        google.maps.event.addDomListener(document.getElementById('routebtn'), 'click', calcRoute);
    }

    function calcRoute() {
        var start = new google.maps.LatLng(33.699226, 73.068145);
        //var end = new google.maps.LatLng(38.334818, -181.884886);
        var end = new google.maps.LatLng(33.628289, 73.070952);
        /*
var startMarker = new google.maps.Marker({
            position: start,
            map: map,
            draggable: true
        });
        var endMarker = new google.maps.Marker({
            position: end,
            map: map,
            draggable: true
        });
*/
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(start);
        bounds.extend(end);
        map.fitBounds(bounds);
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                directionsDisplay.setMap(map);
            } else {
                alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
}
