@extends('frontend.layouts.app',['activePage' => 'tracking'])

@section('title','Live Tracking')
@section('content')
    <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ url('/images/restaurant_cover_blur_10.jpg')}}" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <div id="sub_content">
                <h1>Live Tracking</h1>
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{ route('customer.home.index')}}">Home</a></li>
                <li>Live Tracking</li>
            </ul>
            <!-- <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a> -->
        </div>
    </div><!-- Position -->

    <!-- <div class="collapse" id="collapseMap">
        <div id="map" class="map"></div>
    </div> --><!-- End Map -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35 customOrders">
        <div class="row">
            <div class="col-12">
                <div id="track-map" class="map"></div>
            </div>
        </div>
    </div><!-- End container -->
    <!-- End Content =============================================== -->

@endsection


@section('preScript')
    <script type="text/javascript">
        const vendorLat = '{{$trackData["vendorLat"]}}';
        const vendorLang = '{{$trackData["vendorLang"]}}';
    </script>
@endsection
