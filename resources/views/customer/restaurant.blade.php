@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app',
['activePage' => 'restaurant'] )

@if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
    @section('logo', $rest->vendor_logo)
    @section('subtitle', 'Menu')
    @section('vendor_lat', $rest->lat)
    @section('vendor_lang', $rest->lang)
@endif

@section('title', $rest->name)

<style>
    .mySlides {
        display: none;
    }

    img {
        vertical-align: middle;
    }

    /* Slideshow container */
    .slideshow-container {

        position: relative;
        margin: auto;
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active {
        background-color: #717171;
    }

    /* Fading animation */
    .fadess {
        -webkit-animation-name: fadess;
        -webkit-animation-duration: 1.5s;
        animation-name: fadess;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fadess {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @keyframes fadess {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .text {
            font-size: 11px
        }
    }

    .slick-slide {
        height: auto ! important;
    }

    .carousel-inner img {
        width: 100%;

    }

    .carousel-control {
        position: absolute;

        display: flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: auto;
        color: #fff;
        text-align: center;
        bottom: 2px;
        left: 57px;


    }

    .pt-3.text-white {
        /* background: #e23744; */
        /* background: hsl(337 93% 43% / 0.7); */
        /* background:linear-gradient(hsl(337 93%  43% / 0),hsl(337 93%  43% / 1)) ; */
        background: hsl(0 0% 0% / 0.7);
        padding: 8px 8px 0;
        border-radius: 20px 20px 0px 2px;
        color: whitesmoke !important;

    }

    .carousel-control-logo {
        /* position: absolute; */
        top: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        color: #fff;
        text-align: center;

    }

    .restaurant-logo {
        position: absolute;
        bottom: -6px;
        height: 121px;
        left: 970px;

        margin: 9px 0;
        padding: 9px 0;
        background: hsl(0 0% 0% / 0.7);

        padding: 2px 6px 0px 10px;
        border-radius: 16px 16px 0px 2px;
        color: whitesmoke !important;

    }

    .rating-wrap.d-flex.align-items-center.mt-2 {
        align-content: center;

        align-items: center;
        justify-content: center;
    }
    a.carousel-control-contact {
    position: absolute;

    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    color: #fff;
    text-align: center;
}
p.font-weight-bold.contacts {
    background: hsl(0 0% 0% / 0.7);
    padding: 10px 10px 10px;
    border-radius: 8px 9px 0px 2px;
    color: whitesmoke !important;
}
</style>

@section('content')

    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            @foreach ($slider as $key => $slid)
                <li data-target="#demo" data-slide-to="{{ $key }}" class="active dot" style="display: none;">
                </li>
            @endforeach
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">

            @foreach ($slider as $slid)
                <div class="carousel-item active">
                    <div class="mySlides fadess">
                        <img src="{{ asset($slid->image) }}" alt="Slider" width="1100" height="500">
                    </div>
                </div>
            @endforeach
            {{-- <div class="carousel-item">
      <img src="chicago.jpg" alt="Chicago" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="ny.jpg" alt="New York" width="1100" height="500">
    </div> --}}

        </div>

        <!-- Left and right controls -->
        <a class="carousel-control" href="#demo" data-slide="prev">

            <div class="pt-3 text-white">
                <h2 class="font-weight-bold">{{ $rest->name }}</h2>
                <p class="text-white m-0">{{ $rest->address }}</p>

                <div class="rating-wrap d-flex align-items-center mt-2">
                    <ul class="rating-stars list-unstyled">
                        <li>
                            @for ($i = 0; $i < $rest->rate; $i++)
                                <i class="feather-star text-warning"></i>
                            @endfor

                            @for ($i = 5; $i > $rest->rate; $i--)
                                <i class="feather-star"></i>
                            @endfor
                        </li>
                    </ul>
                </div>
            </div>
        </a>
        {{-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span ><h2 class="font-weight-bold">{{ $rest->name }}</h2>
      <p class="text-white m-0">{{ $rest->address }}</p> </span>
  </a> --}}
  @php
    $startTime = $rest->start_time;
   $newStartTime = date('h:i A', strtotime($startTime));
    $closeTime = $rest->close_time;
   $newCloseTime = date('h:i A', strtotime($closeTime));
  @endphp
        <a class="carousel-control-contact">

              <p class="font-weight-bold contacts">  <i class="feather-phone-call"></i>   {{ $rest->contact ?? 'no number yet'}}<br>
              Open Timing  :   {{  $newStartTime ?? 'start time not set yet'}}<br>
              Close Timing  :  {{ $newCloseTime ?? 'close time not set yet'}} </p>
        </a>
        <a class="carousel-control-logo">
            <span style="background-color: white"><img alt="#" src="{{ $rest->image }}" class="restaurant-logo"></span>
        </a>
    </div>
    <div class="container backcolor">
        <div class="cat-slider" id="navbar-example2">

            @foreach ($itemCategory as $item)
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm active"
                        href="{{ route('restaurant.itemCategory', [$vendor_id, $item->id]) }}">
                        <img alt="#" src="{{ asset($item->image) }}" style="height:35px" class="img-fluid mb-2">
                        <p class="m-0 small">{{ $item->name }}</p>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
    <div class="container backcolor">
        <div class="cat-slider" id="navbar-example2">

            @foreach ($singleVendor['MenuCategory'] as $MenuCategoryIDX => $MenuCategory)
                <div class="cat-item px-1 py-3">
                    <a class="bg-white rounded d-block p-2 text-center shadow-sm active"
                        href="#{{ ucwords($MenuCategory->name) }}">
                        <p class="m-0 small">{{ ucwords($MenuCategory->name) }}</p>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Menu -->
    <div class="container position-relative">
        <div class="row">
            <div class="col-md-12 pt-3">

                <div class="shadow-sm rounded bg-white mb-3 overflow-hidden">
                    <div class="d-flex item-aligns-center">
                        <p class="font-weight-bold h6 p-3 border-bottom mb-0 w-100"><b>Menu</b></p>

                        <!-- <a class="small text-primary font-weight-bold ml-auto" href="#">View all <i class="feather-chevrons-right"></i></a> -->
                    </div>
                    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example"
                        tabindex="0">
                        @foreach ($singleVendor['MenuCategory'] as $MenuCategoryIDX => $MenuCategory)
                            <div class="row m-0">
                                <h6 class="p-3 m-0 bg-light w-100" id="{{ ucwords($MenuCategory->name) }}">
                                    {{ ucwords($MenuCategory->name) }}
                                    <small class="text-black-50">
                                        @if ($MenuCategory->type == 'SINGLE')
                                            {{ $MenuCategory->SingleMenu()->count() }} ITEM(S)
                                        @elseif($MenuCategory->type == 'HALF_N_HALF')
                                            {{ $MenuCategory->HalfNHalfMenu()->count() }} ITEM(S)
                                        @elseif($MenuCategory->type == 'DEALS')
                                            {{ $MenuCategory->DealsMenu()->count() }} ITEM(S)
                                        @endif
                                    </small>
                                </h6>
                                <div class="col-md-12 px-0 border-top">
                                    <div class="">
                                        @if ($MenuCategory->type == 'SINGLE')
                                            @include('customer.restaurant.single.index', ['unique_id'=>1])
                                        @elseif($MenuCategory->type == 'HALF_N_HALF')
                                            @include('customer.restaurant.half.index', ['unique_id'=>2])
                                        @elseif($MenuCategory->type == 'DEALS')
                                            @include('customer.restaurant.deals.index', ['unique_id'=>3])
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('postScript')
    <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>
@append
