@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app',
['activePage' => 'restaurant'] )

@if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))

@endif

@section('title', 'Himalaya Falooda & Sweets | Checkout')
@section('content')
    <style>
        label.custom-control-label.now {
            width: 111% !important;
        }

        label.custom-control-label.delivery {
            width: 116% !important;
        }

        .col-lg-1.or {
            top: 20px;
            left: 2px;
            font-weight: bold;

        }

    </style>
    <div class="osahan-checkout">

        <!-- checkout -->
        <div class="container">
            <div class="py-5 row">
                <div class="col-md-8 mb-3" style="top: 60px;">
                    <div>
                        <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                            <div class="osahan-cart-item-profile bg-white p-3">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 font-weight-bold">Delivery Address</h6>
                                    <div class="row">
                                        @foreach ($userAddress as $getaddress)
                                            <div
                                                class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                                <input type="radio" id="customRadioInline{{ $getaddress->id }}"
                                                    name="address_id" form="customerPaymentForm"
                                                    class="custom-control-input"
                                                    {{ $getaddress->selected == 1 ? 'checked' : '' }}
                                                    value="{{ $getaddress->id }}" onchange="changeAddress(this)">
                                                <label class="custom-control-label w-100"
                                                    for="customRadioInline{{ $getaddress->id }}">
                                                    <div>
                                                        <div class="p-3 bg-white rounded shadow-sm w-100">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="mb-0">{{ $getaddress->type }}</h6>
                                                                {{-- <p class="mb-0 badge badge-success ml-auto"><i
                                                                    class="icofont-check-circled"></i> Default</p> --}}
                                                            </div>
                                                            <p class="small text-muted m-0">
                                                                {{ nl2br($getaddress->address, 20) }}</p>
                                                            {{-- <p class="small text-muted m-0">Redwood City, CA 94063</p> --}}
                                                        </div>
                                                        {{-- <a href="#" data-toggle="modal" data-target="#exampleModal"
                                                        class="btn btn-block btn-light border-top">Edit</a> --}}
                                                    </div>
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                    {{-- <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#exampleModal"> ADD
                                        NEW ADDRESS </a> --}}
                                </div>
                            </div>
                        </div>

                        {{-- Delivery Type --}}
                        @if ($timeSlot == 'true')
                            {{-- <p>asdasd</p> --}}
                            <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                                <div class="osahan-cart-item-profile bg-white p-3">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 font-weight-bold">Delivery Type</h6>
                                        <div class="row">

                                            <div
                                                class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                                <input type="radio" id="customRadioInline1" name="delivery_type"
                                                    form="customerPaymentForm" class="custom-control-input" checked
                                                    value="DELIVERY">
                                                <label class="custom-control-label w-100" for="customRadioInline1">
                                                    <div>
                                                        <div class="p-3 bg-white rounded shadow-sm w-100">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="mb-0">DELIVERY</h6>
                                                                <p class="mb-0 badge badge-success ml-auto"><i
                                                                        class="icofont-check-circled"></i> <i
                                                                        class="fas fa-shipping-fast"></i></p>
                                                            </div>
                                                            {{-- <img src="{{ url('/customer/img/truck.svg') }}" width="50"
                                                           height="29"> --}}
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div
                                                class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                                <input type="radio" id="customRadioInline2" name="delivery_type"
                                                    form="customerPaymentForm" class="custom-control-input"
                                                    value="TAKE AWAY">
                                                <label class="custom-control-label w-100" for="customRadioInline2">
                                                    <div>
                                                        <div class="p-3 bg-white rounded shadow-sm w-100">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="mb-0">TAKE AWAY</h6>
                                                                <p class="mb-0 badge badge-success ml-auto"><i
                                                                        class="icofont-check-circled"></i> </p>
                                                            </div>


                                                        </div>

                                                    </div>
                                                </label>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        @else

                            <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                                <div class="osahan-cart-item-profile bg-white p-3">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 font-weight-bold">Delivery Type</h6>
                                        <div class="row">

                                            <div
                                                class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                                <input type="radio" id="customRadioInline1" name="delivery_type"
                                                    form="customerPaymentForm" title="Delivery Out"
                                                    class="custom-control-input" disabled value="DELIVERY">
                                                <label class="custom-control-label w-100" for="customRadioInline1">
                                                    <div>
                                                        <div class="p-3 bg-danger rounded shadow-sm w-100">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="mb-0" style="color: white">DELIVERY OUT
                                                                </h6>
                                                                <p class="mb-0 badge badge-success ml-auto"><i
                                                                        class="icofont-check-circled"></i> <i
                                                                        class="fas fa-shipping-fast"></i></p>
                                                            </div>
                                                            {{-- <img src="{{ url('/customer/img/truck.svg') }}" width="50"
                                                         height="29"> --}}
                                                        </div>

                                                    </div>
                                                </label>
                                            </div>

                                            <div
                                                class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                                <input type="radio" id="customRadioInline2" name="delivery_type"
                                                    form="customerPaymentForm" class="custom-control-input"
                                                    value="TAKE AWAY" checked disabled>
                                                <label class="custom-control-label w-100" for="customRadioInline2">
                                                    <div>
                                                        <div class="p-3 bg-white rounded shadow-sm w-100">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="mb-0">TAKE AWAY</h6>
                                                                <p class="mb-0 badge badge-success ml-auto"><i
                                                                        class="icofont-check-circled"></i> </p>
                                                            </div>


                                                        </div>

                                                    </div>
                                                </label>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="accordion mb-3 rounded shadow-sm bg-white overflow-hidden" id="accordionExample">
                            <div class="osahan-card bg-white overflow-hidden">
                                <div class="osahan-card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="d-flex p-3 align-items-center btn btn-link w-100" type="button"
                                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
                                            aria-controls="collapseThree">
                                            <i class="feather-dollar-sign mr-3"></i> Cash on Delivery
                                            <i class="feather-chevron-down ml-auto"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body border-top">
                                        <h6 class="mb-3 mt-0 mb-3 font-weight-bold">Cash</h6>

                                        <div class="payment_select nomargin form-check">
                                            <label class="form-check-label">
                                                <input type="radio" value="COD" name="payment_type" id="cashOnDelivery"
                                                    class=".icheck form-check-input" form="customerPaymentForm" checked>
                                                <b>Cash on Delivery</b></label>
                                            <i class="icon_wallet"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="osahan-card bg-white border-bottom overflow-hidden">
                                <div class="osahan-card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="d-flex p-3 align-items-center btn btn-link w-100" type="button"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                                            aria-controls="collapseOne">
                                            <i class="feather-credit-card mr-3"></i> Stripe
                                            <i class="feather-chevron-down ml-auto"></i>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse " aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="osahan-card-body border-top p-3">
                                        {{-- <h6 class="m-0">Add new card</h6>
                                  <p class="small">WE ACCEPT <span class="osahan-card ml-2 font-weight-bold">( Master Card / Visa Card / Rupay )</span></p> --}}
                                        <form method="post" id="customerPaymentForm" data-cc-on-file="false"
                                            data-stripe-publishable-key="{{ App\Models\PaymentSetting::find(1)->stripe_publish_key }}">
                                            @csrf
                                        </form>
                                        <h6 class="mb-3 mt-0 mb-3 font-weight-bold">Payment methods</h6>
                                        <div class="payment_select form-check">
                                            <label class="form-check-label"><input type="radio" value="STRIPE"
                                                    name="payment_type" class=".icheck form-check-input"
                                                    form="customerPaymentForm" id="stripe-check">
                                                <b>Stripe</b></label>
                                            <i class="icon_creditcard"></i>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>Name on card</label>
                                            <input type="text" value="{{ old('stripe_name_card_order') }}"
                                                class="form-control" id="stripe_name_card_order"
                                                name="stripe_name_card_order" placeholder="First and last name"
                                                form="customerPaymentForm">
                                        </div>
                                        <div class="form-group">
                                            <label>Card number</label>
                                            <input type="text" value="{{ old('stripe_card_number') }}"
                                                id="stripe_card_number" name="stripe_card_number" class="form-control"
                                                placeholder="Card number" form="customerPaymentForm">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Expiration date</label>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" value="{{ old('stripe_expire_month') }}"
                                                                id="stripe_expire_month" name="stripe_expire_month"
                                                                class="form-control" placeholder="mm"
                                                                form="customerPaymentForm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" value="{{ old('stripe_expire_year') }}"
                                                                id="stripe_expire_year" name="stripe_expire_year"
                                                                class="form-control" placeholder="yyyy"
                                                                form="customerPaymentForm">
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
                                                                <input type="text" value="{{ old('stripe_ccv') }}"
                                                                    id="stripe_ccv" name="stripe_ccv"
                                                                    class="form-control" placeholder="CCV"
                                                                    form="customerPaymentForm">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-sm-6">
                                                            <img src="{{ url('/customer/img/icon_ccv.gif') }}" width="50"
                                                                height="29" alt="ccv"><small>Last 3 digits</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="top: 60px;">
                    <div class="osahan-cart-item rounded rounded shadow-sm overflow-hidden bg-white sticky_sidebar">
                        <div class="d-flex border-bottom osahan-cart-item-profile bg-white p-3">
                            <img alt="osahan" src="{{ asset('customer/img/starter1.jpg') }}"
                                class="mr-3 rounded-circle img-fluid">
                            <div class="d-flex flex-column">

                                <h6 class="mb-1 font-weight-bold">{{ $vendor->name }}</h6>
                                <p class="mb-0 small text-muted"><i class="feather-map-pin"></i> {{ $vendor->address }}
                                </p>
                            </div>
                        </div>
                        <div class="bg-white border-bottom py-2">
                            @if ($data != 0)


                                @foreach ($data as $item)

                                    <div
                                        class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                        <div class="media align-items-center">
                                            <div class="mr-2 text-danger">&middot;</div>
                                            <div class="media-body">
                                                <p class="m-0">{{ $item->name }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center" style="width: 95px;">
                                            <span class="count-number float-right"><input class="count-number-input"
                                                    type="text" readonly="" value="{{ $item->quantity }}"><a
                                                    href="javascript:void(0)" type="button"
                                                    class="btn-sm right inc btn btn-outline-secondary">
                                                    <div class="icon d-flex align-items-center">
                                                        <span class="my-cart-icon my-cart-icon-pc">
                                                            <i class="feather-plus"></i>
                                                            <span class="badge badge-notify"></span>
                                                            {{-- <span>Cart</span> --}}
                                                        </span>
                                                    </div>
                                                </a>
                                            </span>
                                            @php
                                                $total = $item->quantity * $item->price;
                                            @endphp

                                            <p class="text-gray mb-0 float-right ml-2 text-muted small">
                                                ${{ $total }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        {{-- <div class="bg-white p-3 py-3 border-bottom clearfix">

                            <div class="accordion mb-3 rounded shadow-sm bg-white overflow-hidden" id="accordionExample"> --}}
                        {{-- <div class="osahan-card bg-white overflow-hidden">

                                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body border-top">
                                            <div class="payment_select nomargin form-check">
                                                <label class="form-check-label" for="delivery_time1">
                                                    <input type="radio"  name="deliveryTime" id="delivery_time1"
                                                        class=".icheck form-check-input" form="customerPaymentForm"
                                                        checked>
                                                    <b>Delivery Now</b></label>
                                                <i class="icon_wallet"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="osahan-card bg-white border-bottom overflow-hidden">
                                    <div class="osahan-card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="d-flex p-3 align-items-center btn btn-link w-100" type="button"
                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                                                aria-controls="collapseOne">
                                                <input type="radio" name="deliveryTime" id="delivery_time2" hidden>
                                                <label for="delivery_time2">
                                                <i class="feather-credit-card mr-3"></i> Select Delivery Time
                                                <i class="feather-chevron-down ml-auto"></i></label>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse " aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="osahan-card-body border-top p-3">

                                            <div class="form-group">
                                                <label for="scheduling">Delivery Time</label>
                                                <input type="datetime-local" id="scheduling" name="scheduling"
                                                    class="form-control" form="customerPaymentForm">
                                            </div>
                                            <br>

                                        </div>
                                    </div>
                                </div> --}}

                        {{-- </div>
                        </div> --}}

                        {{-- <div class="input-group-sm mb-2 input-group"> --}}

                        {{-- <input placeholder="Enter promo code" type="text" class="form-control"> --}}
                        {{-- <div class="form-group">
                                  <label for="scheduling">Delivery Time</label>
                                  <input type="datetime-local" id="scheduling" name="scheduling" class="form-control" form="customerPaymentForm">
                                </div>
                            </div> --}}
                        {{-- <div class="mb-0 input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="feather-message-square"></i></span></div>
                                <textarea placeholder="Any suggestions? We will pass it on..." aria-label="With textarea"
                                    class="form-control"></textarea>
                            </div> --}}
                        {{-- </div> --}}
                        <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                            <div class="osahan-cart-item-profile bg-white p-3">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 font-weight-bold">Delivery Schedule</h6>
                                    <div class="row">

                                        <div
                                            class="custom-control col-lg-5 custom-radio mb-3 position-relative border-custom-radio">
                                            <input type="radio" id="customRadioInline3" name="deliveryTime"
                                                form="customerPaymentForm" class="custom-control-input" checked
                                                value="DELIVERY">
                                            <label class="custom-control-label now" for="customRadioInline3"
                                                onclick="deliveryNowTime()">
                                                <div>
                                                    <div class="p-3 bg-white rounded shadow-sm">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <p class="mb-0">DELIVERY NOW</p>

                                                        </div>

                                                    </div>
                                                </div>
                                            </label>

                                        </div>
                                        <div class="col-lg-1 or">
                                            OR
                                        </div>
                                        <div
                                            class="custom-control col-lg-5 custom-radio mb-3 position-relative border-custom-radio">

                                            <input type="radio" id="deliveryTime" name="deliveryTime"
                                                form="customerPaymentForm" class="custom-control-input"
                                                value="deliveryTime">
                                            <label class="custom-control-label delivery" for="deliveryTime"
                                                onclick="deliveryTime()">
                                                <div>
                                                    <div class="p-3 bg-white rounded shadow-sm">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <p class="mb-0">SCHEDULE TIME</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </label>

                                        </div>

                                        <div class="bg-white p-3 py-3 border-bottom clearfix" id="scheduleTime"
                                            style="display: none">
                                            <div class="input-group-sm mb-2 input-group">
                                                <div class="form-group">
                                                    <label for="scheduling">Delivery Time</label>
                                                    <input type="datetime-local" id="scheduling" name="delivery_time"
                                                        class="form-control" form="customerPaymentForm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="bg-white p-3 clearfix border-bottom">
                            <p class="mb-1">Item Total <span
                                    class="float-right text-dark">${{ Session::get('total') }}</span></p>
                            <input type="hidden" name="sub_total" form="customerPaymentForm"
                                value="{{ Session::get('total') }}">
                            <p class="mb-1 text-success">Apply Coupon<span
                                    class="float-right text-success">${{ Session::get('iCoupons') }}</span></p>
                            <p class="mb-1">Tax <span
                                    class="float-right text-dark">${{ Session::get('idTax') }}</span></p>
                            <p class="mb-1">Delivery Fee<span class="text-info ml-1"><i
                                        class="feather-info"></i></span><span
                                    class="float-right text-dark">${{ Session::get('iDelivery') }}</span></p>
                            <hr>
                            <h6 class="font-weight-bold mb-0">TO PAY <span
                                    class="float-right">${{ Session::get('iGrandTotal') }}</span></h6>
                            <input type="hidden" name="amount" form="customerPaymentForm"
                                value="{{ Session::get('iGrandTotal') }}">
                            <input type="hidden" name="tax" form="customerPaymentForm"
                                value="{{ Session::get('idTax') }}">
                            <input type="hidden" name="delivery_charge" form="customerPaymentForm"
                                value="{{ Session::get('iDelivery') }}">
                            <input type="hidden" name="vendor_id" form="customerPaymentForm"
                                value="{{ Session::get('vendorID') }}">
                            <input type="hidden" name="promocode_id" form="customerPaymentForm"
                                value="{{ Session::get('coupon_id') }}">
                            <input type="hidden" name="promocode_price" form="customerPaymentForm"
                                value="{{ Session::get('iCoupons') }}">
                        </div>
                        <div class="p-3">
                            <button type="button" class="btn btn-success btn-block btn-lg cashPay" id="submit_final_order"
                                form="customerPaymentForm">Cash on Delivery
                                ${{ Session::get('iGrandTotal') }}<i class="feather-arrow-right"></i></button>
                            <button type="button" class="btn btn-success btn-block btn-lg stripePay"
                                id="submit_final_order" form="customerPaymentForm" style="display: none">Stripe
                                ${{ Session::get('iGrandTotal') }}<i class="feather-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('postScript')

    <script src="{{ asset('customer/js/payment.js') }}"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    {!! Toastr::message() !!}

    <script language="javascript">
        $(document).ready(function() {
            elem = document.getElementById("scheduling")
            var iso = new Date().toISOString();
            var minDate = iso.substring(0, iso.length - 1);
            elem.value = minDate
            elem.min = minDate
        });

    </script>

    <script>
        function deliveryTime() {
            $("#scheduleTime").show();
        }

        function deliveryNowTime() {
            $("#scheduling").val('');
            $("#scheduleTime").hide();
        }
        $(document).ready(function() {

            $('.form-check-input').click(function() {
                if ($("#stripe-check").is(':checked')) {
                    console.log($("#stripe-check").is(':checked'));

                    $(".cashPay").hide();
                    $(".stripePay").show();
                } else if ($("#cashOnDelivery").is(":checked")) {

                    $(".cashPay").show();
                    $(".stripePay").hide();
                }
            });

        });
    </script>
    <script>
        $(document).on('click', '#submit_final_order', function(e) {


            switch ($("input[name='payment_type']:checked").val()) {
                case 'STRIPE':
                    Stripe.setPublishableKey($('#customerPaymentForm').data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('#stripe_card_number').val(),
                        cvc: $('#stripe_ccv').val(),
                        exp_month: $('#stripe_expire_month').val(),
                        exp_year: $('#stripe_expire_year').val()
                    }, stripeResponseHandler);
                    break;
                case 'COD':
                    codResponseHandler();
                    break;
            }

        });

        function stripeResponseHandler(status, response) {

            if (response.error) {
                console.log(status);
                toastr.error(response.error.message);
                //  alert((response.error.message));
            } else {
                var token = response['id'];

                $('#customerPaymentForm').append("<input type='hidden' name='payment_token' value='" + token + "'/>");

                var customerPaymentFormData = new FormData($('#customerPaymentForm')[0]);

                console.log(customerPaymentFormData);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                        url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/order/book",
                    @else
                        url:"{{ url('customer/restaurant/book-order', request()->route('id')) }}",
                    @endif
                    data: customerPaymentFormData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        if (result.success == true) {
                            // console.log(result);
                            toastr.success("Payment was successfull, redirecting...");

                            setTimeout(function() {
                                @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                                    window.location.replace("{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/order-history");
                                @else
                                    window.location.replace("{{ url('customer/order-history') }}");
                                @endif
                            }, 1000);
                        } else {
                            toastr.error("Payment not complete");

                        }
                    },
                    error: function(err) {

                        toastr.warning(err.responseJSON.message);
                    }
                });
            }
        }

        function codResponseHandler() {
            var customerPaymentFormData = new FormData($('#customerPaymentForm')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/book-order",
                @else
                    url:"{{ url('customer/restaurant/book-order', request()->route('id')) }}",
                @endif
                data: customerPaymentFormData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.success == true) {
                        console.log(result);
                        toastr.warning("Payment was Pendding, redirecting...");

                        setTimeout(function() {

                            @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                                window.location.replace("{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/order-history");
                            @else
                                window.location.replace("{{ url('customer/order-history') }}");
                            @endif
                        }, 1000);
                    } else {
                        console.log(result);
                        toastr.error("Payment not complete");
                    }
                },
                error: function(err) {
                    console.log(err);
                    toastr.error(err.responseJSON.errors);
                }

            });
        }
    </script>

@append
