import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.0.1/firebase-app.js';
import { getDatabase, ref, child, get, onChildChanged } from 'https://www.gstatic.com/firebasejs/9.0.1/firebase-database.js';

const firebaseConfig = {
    apiKey: "AIzaSyCr8iiALRjdxKxk8CGdM10C8L4Q8yS7Ed4",
    authDomain: "mealup-af29b.firebaseapp.com",
    databaseURL: "https://mealup-af29b-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "mealup-af29b",
    storageBucket: "mealup-af29b.appspot.com",
    messagingSenderId: "502253922422",
    appId: "1:502253922422:web:80f34da78b18bce5701757",
    measurementId: "G-77FRR1X6L3"
};
const app = initializeApp(firebaseConfig);

var processTrack = false;
var driverLat = 0;
var driverLang = 0;

var database = getDatabase(app);
const driverDataRef = ref(database);
const driverDataRefLang = ref(database, driverID+'/driverLang');
const driverDataRefLat = ref(database, driverID+'/driverLat');

var driverMarker, start, end, directionsDisplay, directionsService, bounds;

const icons = {
    user: {
        icon: "http://maps.google.com/mapfiles/kml/shapes/" + "man.png",
    },
    vendor: {
        icon: "http://maps.google.com/mapfiles/kml/paddle/" + "V.png",
    },
    driver: {
        icon: "http://maps.google.com/mapfiles/kml/shapes/" + "motorcycling.png",
    },
};

var map = new google.maps.Map(document.getElementById('track-map'), {
    center: {
        lat: parseFloat(vendorLat),
        lng: parseFloat(vendorLang),
    },
    zoom: 2,
    mapTypeId: 'roadmap',
    // fullscreenControl: false,
    mapTypeControl: false,
    streetViewControl: false,
    gestureHandling: 'greedy'
});

var vendorMarker = new google.maps.Marker({
    position: {
        lat: parseFloat(vendorLat),
        lng: parseFloat(vendorLang),
    },
    icon: {url:icons['vendor'].icon, scaledSize: new google.maps.Size(30, 30)},
    map: map,
    draggable: false
});

var userMarker = new google.maps.Marker({
    position: {
        lat: parseFloat(userLat),
        lng: parseFloat(userLang),
    },
    icon: {url:icons['user'].icon, scaledSize: new google.maps.Size(30, 30)},
    map: map,
    draggable: false
});

get(child(driverDataRef, `${driverID}`)).then((snapshot) => {
    if (snapshot.exists()) {
        driverLat = snapshot.val().driverLat;
        driverLang = snapshot.val().driverLang;

        driverMarker = new google.maps.Marker({
            position: {
                lat: parseFloat(driverLat),
                lng: parseFloat(driverLang),
            },
            icon: {url:icons['driver'].icon, scaledSize: new google.maps.Size(30, 30)},
            map: map,
            draggable: false
        });

        start = new google.maps.LatLng(parseFloat(userLat), parseFloat(userLang));
        end = new google.maps.LatLng(parseFloat(driverLat), parseFloat(driverLang));

        directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay.setMap(map);
        directionsDisplay.setOptions( { suppressMarkers: true } );
        directionsDisplay.setOptions( { preserveViewport: true } );

        directionsService = new google.maps.DirectionsService();

        bounds = new google.maps.LatLngBounds();
        bounds.extend(start);
        bounds.extend(end);
        map.fitBounds(bounds);

        calcRoute();
    } else {
        console.log("No data available");
    }
}).catch((error) => {
    console.error(error);
});

onChildChanged(driverDataRef, (data) => {
    if(!processTrack) {
        processTrack = true;
        get(child(driverDataRef, `${driverID}`)).then((snapshot) => {
            if (snapshot.exists()) {
                driverLat = snapshot.val().driverLat;
                driverLang = snapshot.val().driverLang;

                start = new google.maps.LatLng(parseFloat(userLat), parseFloat(userLang));
                end = new google.maps.LatLng(parseFloat(driverLat), parseFloat(driverLang));
                driverMarker.setPosition(end);
                calcRoute();

                bounds = new google.maps.LatLngBounds();
                bounds.extend(start);
                bounds.extend(end);
                map.fitBounds(bounds);
            } else {
                console.log("No data available");
            }

            processTrack = false;
        }).catch((error) => {
            console.error(error);
        });
    }
});

function calcRoute() {
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            directionsDisplay.setMap(map);
            // console.log(response);
        } else {
            console.log("Directions Request from " + userMarker.toUrlValue(6) + " to " + vendorMarker.toUrlValue(6) + " failed: " + status);
        }
    });

    // console.log('Calculated');
}
