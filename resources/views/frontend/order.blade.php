@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'frontend.layouts.app_restaurant' : 'frontend.layouts.app', ['activePage' => 'order'] )

@section('title','Order')
@section('content')
<!--

{!!$userAddresses!!}

@php
    var_dump($userAddresses);
@endphp
-->
	<!-- SubHeader =============================================== -->
	<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ url('/images/restaurant_cover_blur_10.jpg')}}" data-natural-width="1400" data-natural-height="350">
	    <div id="subheader">
	        <div id="sub_content">
	            <h1>Place your order</h1>
	            <div class="bs-wizard row">
	                <div class="col-4 bs-wizard-step active">
	                    <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Your details</div>
	                    <div class="progress">
	                        <div class="progress-bar"></div>
	                    </div>
	                    <a href="#0" class="bs-wizard-dot"></a>
	                </div>
	                <div class="col-4 bs-wizard-step disabled">
	                    <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Payment</div>
	                    <div class="progress">
	                        <div class="progress-bar"></div>
	                    </div>
	                    <a href="cart_2.html" class="bs-wizard-dot"></a>
	                </div>
	                <div class="col-4 bs-wizard-step disabled">
	                    <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Finish!</div>
	                    <div class="progress">
	                        <div class="progress-bar"></div>
	                    </div>
	                    <a href="cart_3.html" class="bs-wizard-dot"></a>
	                </div>
	            </div><!-- End bs-wizard -->
	        </div><!-- End sub_content -->
	    </div><!-- End subheader -->
	</section><!-- End section -->
	<!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
	                <li><a href="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}">{{ App\Models\Vendor::where('id', session()->get('cart_vendor_id'))->first()->name }}</a></li>
	                <li>Order</li>
                    <li>Details</li>
                @else
	                <li><a href="{{ route('customer.home.index')}}">Home</a></li>
	                <li><a href="{{ route('customer.restaurant.index')}}">Restaurants</a></li>
	                <li><a href="{{ route('customer.restaurant.get', session()->get('cart_vendor_id'))}}">{{ App\Models\Vendor::where('id', session()->get('cart_vendor_id'))->first()->name }}</a></li>
	                <li>Order</li>
                    <li>Details</li>
                @endif
            </ul>
            <!-- <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a> -->
        </div>
    </div><!-- Position -->

    <div class="collapse" id="collapseMap">
		<input type="text" id="pac-input" class="col-11 form-control" placeholder="Enter your location or drag marker" style="margin: 10px 4%;" />
		<div id="map" class="map"></div>
		<div class="container margin_60">
		    <div class="main_title margin_mobile">
		        <h2 class="nomargin_top">Please submit the form below</h2>
		        <p>
		            to add selected database to your account.
		        </p>
		    </div>
		    <div class="row justify-content-center">
		        <div class="col-md-8">

		            @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
		            	<form method="post" action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/setting/user_address/add">
		            @else
		                <form method="post" action="{{ route('customer.restaurant.setting.user_address.add', request()->route('id')) }}">
		            @endif

                		@csrf <!-- {{ csrf_field() }} -->
		            	<input type="hidden" id="lang" name="lang" readonly="readonly">
		            	<input type="hidden" id="lat" name="lat" readonly="readonly">
		                <div class="row">
		                    <div class=" col-sm-12">
		                        <div class="form-group">
		                            <label>Selected Address</label>
		                            <input type="text" class="form-control" id="address" name="address" placeholder="Selected address" readonly="readonly">
		                        </div>
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="col-md-12 col-sm-12">
		                        <div class="form-group">
		                            <label>Label</label>
		                            <input type="text" id="type" name="type" class="form-control " placeholder="Add Label For Selected Location">
		                        </div>
		                    </div>
		                </div>
		                <div id="pass-info" class="clearfix"></div>
		                <div class="row">
		                    <div class="col-md-6">
		                        <label><input name="mobile" type="checkbox" value="" class="icheck" checked>Accept <a href="#0">terms and conditions</a>.</label>
		                    </div>
		                </div><!-- End row  -->
		                <hr style="border-color:#ddd;">
		                <div class="text-center"><button class="btn_full_outline">Add Address</button></div>
		            </form>
		        </div><!-- End col  -->
		    </div><!-- End row  -->
		</div><!-- End container  -->
		<!-- End Content =============================================== -->
	</div><!-- End Map -->

	<!-- Content ================================================== -->
	<div class="container margin_60_35">
	    <div class="row">
	        <div class="col-lg-3">
				<p>
					<a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
				</p>
	            <div class="box_style_2 info d-none d-sm-block">
	                <h4 class="nomargin_top">Delivery time <i class="icon_clock_alt float-right"></i></h4>
	                <p>
	                    Lorem ipsum dolor sit amet, in pri partem essent. Qui debitis meliore ex, tollit debitis conclusionemque te eos.
	                </p>
	                <hr>
	                <h4>Secure payment <i class="icon_creditcard float-right"></i></h4>
	                <p>
	                    Lorem ipsum dolor sit amet, in pri partem essent. Qui debitis meliore ex, tollit debitis conclusionemque te eos.
	                </p>
	            </div><!-- End box_style_1 -->
	            <!-- <div class="box_style_2 d-none d-sm-block" id="help">
	                <i class="icon_lifesaver"></i>
	                <h4>Need <span>Help?</span></h4>
	                <a href="tel://004542344599" class="phone">+45 423 445 99</a>
	                <small>Monday to Friday 9.00am - 7.30pm</small>
	            </div> -->
	        </div><!-- End col -->
	        <div class="col-lg-6">
	            <div class="box_style_2" id="order_process">
	                <h2 class="inner">Your order details</h2>

		                @foreach($userAddresses as $idx=>$userAddress)
		                	<div class="payment_select">
		                        <label>
				                    
				                    @if(session()->has('user_address') && session()->get('user_address') == $userAddress->id)
		                        		<input type="radio" value="{{$userAddress->id}}" checked name="user_address" class="update_user_address">
				                    @else
		                        		<input type="radio" value="{{$userAddress->id}}" name="user_address" class="update_user_address">
				                    @endif

	                        		{{$userAddress->type}}
	                        	</label>
		                        <i class="icon_pin"></i>
		                    </div>
		                    <div class="form-group @if($loop->last) nomargin @endif">
		                        <label>Address</label>
		                        <input type="text" id="card_number" name="card_number" class="form-control" value="{{$userAddress->address}}" readonly="readonly">
		                    </div>
		                @endforeach

	            </div><!-- End box_style_1 -->
	        </div><!-- End col -->
	        <div class="col-lg-3" id="sidebar">
                <div class="theiaStickySidebar">
                    
                    @include('frontend.layouts.cart')

                </div><!-- End theiaStickySidebar -->
            </div><!-- End col -->
	    </div><!-- End row -->
	</div><!-- End container -->
	<!-- End Content =============================================== -->

@endsection

@section('script')
	<!-- <script type="text/javascript">
		const vendor_country = '{{ App\Models\GeneralSetting::first()->country }}';
		
		// const vendor_country = temp_vendor_country;
	</script> -->
	<!-- <script src="{{ url('/frontend/js/map_single.js')}}"></script> -->
	<!-- <script src="{{ url('/frontend/js/map_select.js')}}"></script> -->
	<!-- <script src="{{ url('/frontend/js/infobox.js')}}"></script>
	<script src="{{ url('/frontend/js/ion.rangeSlider.js')}}"></script>
	<script>
	    $(function () {
			 'use strict';
	        $("#range").ionRangeSlider({
	            hide_min_max: true,
	            keyboard: true,
	            min: 0,
	            max: 15,
	            from: 0,
	            to:5,
	            type: 'double',
	            step: 1,
	            prefix: "Km ",
	            grid: true
	        });
	    });
	</script> -->
	
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $(document).on('click', '.update_user_address', function(e){

                e.preventDefault();

                var user_address_radio = $(this);
                var user_address = $(this).val();


                $.ajax({
                    type:'POST',
                    @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                        url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/setting/user_address",
                    @else
                        url:"{{ route('customer.restaurant.setting.user_address', request()->route('id')) }}",
                    @endif
                    data:{user_address:user_address},
                    success:function(data){
                        user_address_radio.prop("checked", true);
                    }
                });

            });
            
            $(document).on('click', '.add_usera_address', function(e){

                e.preventDefault();

                var address = $('input[name="address"]').val();
                var lang = $('input[name="lang"]').val();
                var lat = $('input[name="lat"]').val();
                var type = $('input[name="type"]').val();


                $.ajax({
                    type:'POST',
                    @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                        url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/setting/user_address/add",
                    @else
                        url:"{{ route('customer.restaurant.setting.user_address.add', request()->route('id')) }}",
                    @endif
                    data:{address:address,lang:lang,lat:lat,type:type},
                    success:function(data){
                        user_address_radio.prop("checked", true);
                    }
                });

            });
        });
    </script>
@endsection