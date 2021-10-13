@extends('layouts.app',['activePage' => 'delivery_zone'])

@section('title','Create A Delivery Zone')

@section('content')

<section class="section">

    <div class="section-header">
        <h1>{{__('Delivery zone')}}</h1>
        <div class="section-header-breadcrumb">
            @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item"><a href="{{ url('admin/delivery_zone') }}">{{__('Delivery zone')}}</a></div>
                <div class="breadcrumb-item">{{__('create a Delivery zone')}}</div>
            @endif

            @if(Auth::user()->load('roles')->roles->contains('title', 'vendor'))
                <div class="breadcrumb-item active"><a href="{{ url('vendor/vendor_home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item"><a href="{{ url('vendor/deliveryZone') }}">{{__('Delivery zone')}}</a></div>
                <div class="breadcrumb-item">{{__('create a Delivery zone')}}</div>
            @endif
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__('Delivery Zone Management')}}</h2>
        <p class="section-lead">{{__('create Delivery zone')}}</p>
        <div class="card p-3">
            <div class="card-body">
            <form action="{{ url('vendor/deliveryZoneNew') }}" method="post">
                    @csrf


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">{{__('messages.name')}}</label>
                                <input type="text" name="name" class="form-control" placeholder="New zone" value="{{old('name')}}" required>
                            </div>
                            <div class="form-group">
                                <label class="input-label"
                                       for="exampleFormControlInput1">Coordinates<span class="input-label-secondary" title="{{__('messages.draw_your_zone_on_the_map')}}">{{__('messages.draw_your_zone_on_the_map')}}</span></label>
                                    <textarea type="text" rows="8" name="coordinates"  id="coordinates" class="form-control" readonly>

                                    </textarea>
                            </div>
                        </div>
                        <div class="col-md-6 map-warper" style="height: 300px;">
                            <div id="map-canvas" style="height: 100%; margin:0px; padding: 0px;"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
        </div>
    </div>
</section>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c&libraries=drawing&v=3"></script>

<script>
    var map; // Global declaration of the map
    var drawingManager;
    var lastpolygon = null;
    var polygons = [];

    function resetMap(controlDiv) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "#fff";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginTop = "8px";
        controlUI.style.marginBottom = "22px";
        controlUI.style.textAlign = "center";
        controlUI.title = "Reset map";
        controlDiv.appendChild(controlUI);
        // Set CSS for the control interior.
        const controlText = document.createElement("div");
        controlText.style.color = "rgb(25,25,25)";
        controlText.style.fontFamily = "Roboto,Arial,sans-serif";
        controlText.style.fontSize = "10px";
        controlText.style.lineHeight = "16px";
        controlText.style.paddingLeft = "2px";
        controlText.style.paddingRight = "2px";
        controlText.innerHTML = "X";
        controlUI.appendChild(controlText);
        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener("click", () => {
            lastpolygon.setMap(null);
            $('#coordinates').val('');

        });
    }

    function initialize() {

        var myOptions = {
            zoom: 13,
            // center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
            editable: true
            }
        });
        drawingManager.setMap(map);


        //get current location block
        // infoWindow = new google.maps.InfoWindow();
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                map.setCenter(pos);
            });
        }

        google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
            if(lastpolygon)
            {
                lastpolygon.setMap(null);
            }
            $('#coordinates').val(event.overlay.getPath().getArray());
            lastpolygon = event.overlay;
            auto_grow();
        });

        const resetDiv = document.createElement("div");
        resetMap(resetDiv, lastpolygon);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);
    }

    google.maps.event.addDomListener(window, 'load', initialize);


    function set_all_zones()
    {
        $.get({
            url: '',
            dataType: 'json',
            success: function (data) {

                console.log(data);
                for(var i=0; i<data.length;i++)
                {
                    polygons.push(new google.maps.Polygon({
                        paths: data[i],
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.1,
                    }));
                    polygons[i].setMap(map);
                }

            },
        });
    }
    $(document).on('ready', function(){
        set_all_zones();
    });


    auto_grow();
function auto_grow() {
    let element = document.getElementById("coordinates");
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}
</script>
@endsection
