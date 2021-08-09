@extends('frontend.layouts.app',['activePage' => 'order'])

@section('title','Payment')
@section('content')

    <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ url('/images/restaurant_cover_blur_10.jpg')}}" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <div id="sub_content">
                <h1>Place your order</h1>
                <div class="bs-wizard row">
                    <div class="col-4 bs-wizard-step complete">
                        <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Your details</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="cart.html" class="bs-wizard-dot"></a>
                    </div>
                    <div class="col-4 bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Payment</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a href="#0" class="bs-wizard-dot"></a>
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
                <li><a href="#0">Home</a></li>
                <li><a href="#0">Category</a></li>
                <li>Page active</li>
            </ul>
            <!-- <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a> -->
        </div>
    </div><!-- Position -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-3">
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
                </div><!-- End box_style_2 -->
                <div class="box_style_2 d-none d-sm-block" id="help">
                    <i class="icon_lifesaver"></i>
                    <h4>Need <span>Help?</span></h4>
                    <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                    <small>Monday to Friday 9.00am - 7.30pm</small>
                </div>
            </div><!-- End col -->
            <div class="col-lg-6">
                <div class="box_style_2">
                    
                    <form method="post" action="" id="customerPaymentForm" data-cc-on-file="false" data-stripe-publishable-key="{{App\Models\PaymentSetting::find(1)->stripe_publish_key}}">
                        @csrf
                    </form>

                    <h2 class="inner">Payment methods</h2>
                    <div class="payment_select">
                        <label><input type="radio" value="STRIPE" checked name="payment_method" class=".icheck" form="customerPaymentForm">Stripe</label>
                        <i class="icon_creditcard"></i>
                    </div>
                    <div class="form-group">
                        <label>Name on card</label>
                        <input type="text" value="{{ old('stripe_name_card_order') }}" class="form-control" id="stripe_name_card_order" name="stripe_name_card_order" placeholder="First and last name" form="customerPaymentForm">
                    </div>
                    <div class="form-group">
                        <label>Card number</label>
                        <input type="text" value="{{ old('stripe_card_number') }}" id="stripe_card_number" name="stripe_card_number" class="form-control" placeholder="Card number" form="customerPaymentForm">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Expiration date</label>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" value="{{ old('stripe_expire_month') }}" id="stripe_expire_month" name="stripe_expire_month" class="form-control" placeholder="mm" form="customerPaymentForm">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" value="{{ old('stripe_expire_year') }}" id="stripe_expire_year" name="stripe_expire_year" class="form-control" placeholder="yyyy" form="customerPaymentForm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Security code</label>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" value="{{ old('stripe_ccv') }}" id="stripe_ccv" name="stripe_ccv" class="form-control" placeholder="CCV" form="customerPaymentForm">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-6">
                                        <img src="{{ url('/frontend/img/icon_ccv.gif')}}" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End row -->
                    <!-- <div class="payment_select" id="paypal">
                        <label><input type="radio" value="" name="payment_method" class=".icheck">Pay with paypal</label>
                    </div> -->
                    <div class="payment_select nomargin">
                        <label><input type="radio" value="COD" name="payment_method" class=".icheck" form="customerPaymentForm">Cash on Delivery</label>
                        <i class="icon_wallet"></i>
                    </div>
                </div><!-- End box_style_1 -->
            </div><!-- End col -->
            <div class="col-lg-3" id="sidebar">
                <div class="theiaStickySidebar">
                    
                    @include('frontend.layouts.cart', ['page' => route('customer.restaurant.order.third.index', request()->route('id'))])

                </div><!-- End theiaStickySidebar -->
            </div><!-- End col -->
        </div><!-- End row -->
    </div><!-- End container -->
    <!-- End Content =============================================== -->

@endsection