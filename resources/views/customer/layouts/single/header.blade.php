@section('postScript')
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
            top: 50%;
            left: 50%;
            margin: -40px 0 0 -11px;
            background: url('https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi_hdpi.png');
            background-size: 22px 40px;
            /* Since I used the HiDPI marker version this compensates for the 2x size */
            pointer-events: none;
            /*This disables clicks on the marker. Not fully supported by all major browsers, though */
        }

        #map {
            /* border: 1px solid; */
            height: 70%;
            /* top: 66px */
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

        .conform {
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
        }

        /* .delivery{
      margin-top: 50px;
    } */
        .pac-container {
            z-index: 3000;
        }

    </style>

@append
<header class="section-header">
    <section class="header-main shadow-sm bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-1">
                    <a href="{{route('restaurant.index1',1)}}" class="brand-wrap mb-0">
                        <img alt="#" class="img-fluid" src="{{ url('/customer/img/logo_web.png') }}">
                    </a>
                    <!-- brand-wrap.// -->
                </div>

                <div class="col-3 d-flex align-items-center m-none">
                    <div class="dropdown mr-3">
                        <a class="text-dark dropdown-toggle d-flex align-items-center py-3" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div><i class="feather-map-pin mr-2 bg-light rounded-pill p-2 icofont-size"></i></div>
                            <div>
                                <p class="text-muted mb-0 small">Select Location</p>
                                @php
                                    use Illuminate\Support\Str;
                                @endphp

                                {{ Str::limit($selectedAddress->type, 20) }}

                            </div>
                        </a>
                        <div class="dropdown-menu p-0 drop-loc" aria-labelledby="navbarDropdown">
                            <div class="osahan-country">
                                <div class="search_location bg-primary p-3 text-right">
                                    <div class="input-group rounded shadow-sm overflow-hidden">
                                        <div class="input-group-prepend">
                                            {{-- <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block"><i class="feather-search"></i></button> --}}
                                            <a class="btn btn-outline-secondary text-dark bg-white btn-block" href="#"
                                                data-toggle="modal" data-target="#addModalAddress"> ADD NEW ADDRESS </a>
                                        </div>

                                    </div>
                                </div>
                                <div class="p-3 border-bottom">
                                    <a href="home.html" class="text-decoration-none">
                                        <p class="font-weight-bold text-primary m-0"><i class="feather-navigation"></i>
                                            New York, USA</p>
                                    </a>
                                </div>
                                <div class="filter">
                                    <h6 class="px-3 py-3 bg-light pb-1 m-0 border-bottom">Choose your country</h6>

                                    @foreach ($userAddress as $userAdre)
                                        <div class="custom-control  border-bottom px-0 custom-radio">
                                            <input type="radio" id="customRadio{{ $userAdre->id }}"
                                                name="user_address" class="custom-control-input"
                                                value="{{ $userAdre->id }}"
                                                {{ $userAdre->selected == 1 ? 'checked' : '' }}
                                                onchange="changeAddress(this)">
                                            <label class="custom-control-label py-3 w-100 px-3"
                                                for="customRadio{{ $userAdre->id }}">{{ $userAdre->type }}</label>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- col.// -->

                <div class="col-8">
                    <div class="d-flex align-items-center justify-content-end pr-5">
                        <!-- search -->

                        <!-- offers -->

                        <!-- signin -->

                        @if (!Auth::check())


                            <a href="login.html" class="widget-header mr-4 text-dark m-none">
                                <div class="icon d-flex align-items-center">
                                    <i class="feather-user h6 mr-2 mb-0"></i> <span>Sign in</span>
                                </div>
                            </a>
                        @else
                            <!-- my account -->
                            <div class="dropdown mr-4 m-none">
                                <a href="#" class="dropdown-toggle text-dark py-3 d-block" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img alt="#" src="{{ asset('customer/img/user/1.jpg') }}"
                                        class="img-fluid rounded-circle header-user mr-2 header-user">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('customer.profile')}}">My account</a>
                                    <a class="dropdown-item" href="{{ url('customer/order-history') }}">Order
                                        History</a>
                                    <a class="dropdown-item" href="contact-us.html">Contant us</a>
                                    <a class="dropdown-item" href="terms.html">Term of use</a>
                                    <a class="dropdown-item" href="privacy.html">Privacy policy</a>

                                      @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                                      {{-- <form id="logout-form" action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/logout" method="POST" style="display: none;"> --}}
                                        <a href="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/logout" class="dropdown-item text-danger">
                                          <i class="fas fa-sign-out-alt"></i>
                                          {{ __('Logout') }}
                                      </a>
                                      @else
                                      <a href="{{ route('customer.logout') }}" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>
                                      @endif

                                </div>
                            </div>
                        @endif
                        <!-- signin -->
                        <a href="javascript:void(0)" class="widget-header mr-4 text-dark">
                            <div class="icon d-flex align-items-center">
                                <span class="my-cart-icon my-cart-icon-pc">
                                    <i class="feather-shopping-cart h6 mr-2 mb-0"></i>
                                    <span class="badge badge-notify my-cart-badge-pc"></span>
                                    <span>Cart</span>
                                </span>
                            </div>
                        </a>
                        <a class="toggle" href="#">
                            <span></span>
                        </a>
                    </div>
                    <!-- widgets-wrap.// -->
                </div>
                <!-- col.// -->
            </div>
            <!-- row.// -->
        </div>
        <!-- container.// -->
    </section>
    <!-- header-main .// -->
</header>

{{-- <div class="d-none">
    <div class="bg-primary p-3 d-flex align-items-center">
        <a class="toggle togglew toggle-2" href="#"><span></span></a>
        <h4 class="font-weight-bold m-0 text-white">Osahan Bar</h4>
    </div>
</div> --}}

{{-- Customer Address Model --}}
<div class="modal fade" id="addModalAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="pac-input"  class="form-control" type="text"
                    placeholder="Enter your location or drag marker" style="margin: 10px 4%;" />
                <div id="map" class="map"></div>
                @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                {{-- <form action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/address-store" method="POST"> --}}
                  <form class="mt-5 mb-4" action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/address-store" method="POST">
                  @else
                <form action="{{ route('customer.address.store') }}" method="POST">
                @endif

                    @csrf
                    <input type="hidden" id="lang" name="lang" readonly="readonly">
                    <input type="hidden" id="lat" name="lat" readonly="readonly">
                    <input type="hidden" id="selected" name="selected" readonly="readonly" value="1">
                    <input type="hidden" id="user_id" name="user_id" readonly="readonly"
                        value="{{ Auth::user()->id }}">
                    <br> <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-row">
                                <div class="col-md-12 form-group delivery">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-white" id="address" name="address"
                                            placeholder="Selected address" readonly="readonly">

                                        <div class="input-group-append"><button type="button"
                                                class="btn btn-outline-secondary"><i
                                                    class="feather-map-pin"></i></button></div>

                                    </div>
                                    @if($errors->has('address'))
                                    <div class="error text-danger">{{ $errors->first('address') }}</div>
                                 @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control form-white" id="type" name="type"
                                        placeholder="Type (Home,Apparment)" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <input name="term" type="checkbox" value="" class="icheck" checked>Accept <a
                                        href="#0">terms and conditions</a>.
                                </div>

                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
