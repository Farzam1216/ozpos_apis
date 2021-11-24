@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app',
['activePage' => 'restaurant'] )

@if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))

@endif

@section('title',"Himalaya Falooda & Sweets | Checkout")

@section('content')

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
                                        <div class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                            <input type="radio" id="customRadioInline{{ $getaddress->id }}" name="address_id" form="customerPaymentForm"
                                                class="custom-control-input" {{ $getaddress->selected == 1 ? 'checked' : '' }} value="{{ $getaddress->id }}" onchange="changeAddress(this)">
                                            <label class="custom-control-label w-100" for="customRadioInline{{ $getaddress->id }}">
                                                <div>
                                                    <div class="p-3 bg-white rounded shadow-sm w-100">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <h6 class="mb-0">{{ $getaddress->type }}</h6>
                                                            {{-- <p class="mb-0 badge badge-success ml-auto"><i
                                                                    class="icofont-check-circled"></i> Default</p> --}}
                                                        </div>
                                                        <p class="small text-muted m-0">{{ nl2br($getaddress->address, 20) }}</p>
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

                         {{-- Delivery Type  --}}
                        <div class="osahan-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                            <div class="osahan-cart-item-profile bg-white p-3">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 font-weight-bold">Delivery Type</h6>
                                    <div class="row">

                                        <div class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                            <input type="radio" id="customRadioInline1" name="delivery_type"  form="customerPaymentForm"
                                                class="custom-control-input"  value="DELIVERY">
                                            <label class="custom-control-label w-100" for="customRadioInline1">
                                                <div>
                                                    <div class="p-3 bg-white rounded shadow-sm w-100">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <h6 class="mb-0">DELIVERY</h6>
                                                            <p class="mb-0 badge badge-success ml-auto"><i
                                                                    class="icofont-check-circled"></i> <i class="fas fa-shipping-fast"></i></p>
                                                        </div>
                                                        {{-- <img src="{{ url('/customer/img/truck.svg') }}" width="50"
                                                        height="29"> --}}
                                                    </div>

                                                </div>
                                            </label>
                                        </div>

                                        <div class="custom-control col-lg-6 custom-radio mb-3 position-relative border-custom-radio">
                                            <input type="radio" id="customRadioInline2" name="delivery_type" form="customerPaymentForm"
                                                class="custom-control-input" value="TAKE AWAY" >
                                            <label class="custom-control-label w-100" for="customRadioInline2">
                                                <div>
                                                    <div class="p-3 bg-white rounded shadow-sm w-100">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <h6 class="mb-0">TAKE AWAY</h6>
                                                            <p class="mb-0 badge badge-success ml-auto"><i class="icofont-check-circled"></i> </p>
                                                        </div>


                                                    </div>

                                                </div>
                                            </label>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="accordion mb-3 rounded shadow-sm bg-white overflow-hidden" id="accordionExample">
                            <div class="osahan-card bg-white border-bottom overflow-hidden">
                                <div class="osahan-card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="d-flex p-3 align-items-center btn btn-link w-100" type="button"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <i class="feather-credit-card mr-3"></i> Stripe
                                            <i class="feather-chevron-down ml-auto"></i>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="osahan-card-body border-top p-3">
                                        {{-- <h6 class="m-0">Add new card</h6>
                                  <p class="small">WE ACCEPT <span class="osahan-card ml-2 font-weight-bold">( Master Card / Visa Card / Rupay )</span></p> --}}
                                        <form method="post"  id="customerPaymentForm" data-cc-on-file="false"
                                            data-stripe-publishable-key="{{ App\Models\PaymentSetting::find(1)->stripe_publish_key }}">
                                            @csrf
                                        </form>
                                        <h2 class="inner">Payment methods</h2>
                                        <div class="payment_select">
                                            <label><input type="radio" value="STRIPE" checked name="payment_type"
                                                    class=".icheck" form="customerPaymentForm">Stripe</label>
                                            <i class="icon_creditcard"></i>
                                        </div>
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
                                                                    id="stripe_ccv" name="stripe_ccv" class="form-control"
                                                                    placeholder="CCV" form="customerPaymentForm">
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
                            {{-- <div class="osahan-card bg-white border-bottom overflow-hidden">
                          <div class="osahan-card-header" id="headingTwo">
                              <h2 class="mb-0">
                                  <button class="d-flex p-3 align-items-center btn btn-link w-100" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                           <i class="feather-globe mr-3"></i> Net Banking
                           <i class="feather-chevron-down ml-auto"></i>
                           </button>
                              </h2>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="osahan-card-body border-top p-3">
                                  <form>
                                      <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                          <label class="btn btn-outline-secondary active">
                                 <input type="radio" name="options" id="option1" checked> HDFC
                                 </label>
                                          <label class="btn btn-outline-secondary">
                                 <input type="radio" name="options" id="option2"> ICICI
                                 </label>
                                          <label class="btn btn-outline-secondary">
                                 <input type="radio" name="options" id="option3"> AXIS
                                 </label>
                                      </div>
                                      <hr>
                                      <div class="form-row">
                                          <div class="col-md-12 form-group mb-0">
                                              <label class="form-label small font-weight-bold">Select Bank</label><br>
                                              <select class="custom-select form-control">
                                       <option>Bank</option>
                                       <option>KOTAK</option>
                                       <option>SBI</option>
                                       <option>UCO</option>
                                    </select>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div> --}}
                            <div class="osahan-card bg-white overflow-hidden">
                                <div class="osahan-card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="d-flex p-3 align-items-center btn btn-link w-100" type="button"
                                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            <i class="feather-dollar-sign mr-3"></i> Cash on Delivery
                                            <i class="feather-chevron-down ml-auto"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body border-top">
                                        <h6 class="mb-3 mt-0 mb-3 font-weight-bold">Cash</h6>

                                        <div class="payment_select nomargin">
                                            <label><input type="radio" value="COD" name="payment_type"
                                                    class=".icheck" form="customerPaymentForm">Cash on
                                                Delivery</label>
                                            <i class="icon_wallet"></i>
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
                            <img alt="osahan" src="{{asset('customer/img/starter1.jpg')}}" class="mr-3 rounded-circle img-fluid">
                            <div class="d-flex flex-column">

                                <h6 class="mb-1 font-weight-bold">{{$vendor->name}}</h6>
                                <p class="mb-0 small text-muted"><i class="feather-map-pin"></i> {{ $vendor->address}}</p>
                            </div>
                        </div>
                        <div class="bg-white border-bottom py-2">
                            <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                <div class="media align-items-center">
                                    <div class="mr-2 text-danger">&middot;</div>
                                    <div class="media-body">
                                        <p class="m-0">Chicken Tikka Sub</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="count-number float-right"><button type="button"
                                            class="btn-sm left dec btn btn-outline-secondary"> <i
                                                class="feather-minus"></i> </button><input class="count-number-input"
                                            type="text" readonly="" value="2"><button type="button"
                                            class="btn-sm right inc btn btn-outline-secondary"> <i
                                                class="feather-plus"></i> </button></span>
                                    <p class="text-gray mb-0 float-right ml-2 text-muted small">$628</p>
                                </div>
                            </div>
                            <div
                                class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                <div class="media align-items-center">
                                    <div class="mr-2 text-danger">&middot;</div>
                                    <div class="media-body">
                                        <p class="m-0">Methi Chicken Dry
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="count-number float-right"><button type="button"
                                            class="btn-sm left dec btn btn-outline-secondary"> <i
                                                class="feather-minus"></i> </button><input class="count-number-input"
                                            type="text" readonly="" value="2"><button type="button"
                                            class="btn-sm right inc btn btn-outline-secondary"> <i
                                                class="feather-plus"></i> </button></span>
                                    <p class="text-gray mb-0 float-right ml-2 text-muted small">$628</p>
                                </div>
                            </div>
                            <div
                                class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                <div class="media align-items-center">
                                    <div class="mr-2 text-danger">&middot;</div>
                                    <div class="media-body">
                                        <p class="m-0">Reshmi Kebab
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="count-number float-right"><button type="button"
                                            class="btn-sm left dec btn btn-outline-secondary"> <i
                                                class="feather-minus"></i> </button><input class="count-number-input"
                                            type="text" readonly="" value="2"><button type="button"
                                            class="btn-sm right inc btn btn-outline-secondary"> <i
                                                class="feather-plus"></i> </button></span>
                                    <p class="text-gray mb-0 float-right ml-2 text-muted small">$628</p>
                                </div>
                            </div>
                            <div
                                class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                <div class="media align-items-center">
                                    <div class="mr-2 text-success">&middot;</div>
                                    <div class="media-body">
                                        <p class="m-0">Lemon Cheese Dry
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="count-number float-right"><button type="button"
                                            class="btn-sm left dec btn btn-outline-secondary"> <i
                                                class="feather-minus"></i> </button><input class="count-number-input"
                                            type="text" readonly="" value="2"><button type="button"
                                            class="btn-sm right inc btn btn-outline-secondary"> <i
                                                class="feather-plus"></i> </button></span>
                                    <p class="text-gray mb-0 float-right ml-2 text-muted small">$628</p>
                                </div>
                            </div>
                            <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2">
                                <div class="media align-items-center">
                                    <div class="mr-2 text-success">&middot;</div>
                                    <div class="media-body">
                                        <p class="m-0">Rara Paneer</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="count-number float-right"><button type="button"
                                            class="btn-sm left dec btn btn-outline-secondary"> <i
                                                class="feather-minus"></i> </button><input class="count-number-input"
                                            type="text" readonly="" value="2"><button type="button"
                                            class="btn-sm right inc btn btn-outline-secondary"> <i
                                                class="feather-plus"></i> </button></span>
                                    <p class="text-gray mb-0 float-right ml-2 text-muted small">$628</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="bg-white p-3 py-3 border-bottom clearfix">
                            <div class="input-group-sm mb-2 input-group">
                                <input placeholder="Enter promo code" type="text" class="form-control">
                                <div class="input-group-append"><button type="button" class="btn btn-primary"><i
                                            class="feather-percent"></i> APPLY</button></div>
                            </div>
                            <div class="mb-0 input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i
                                            class="feather-message-square"></i></span></div>
                                <textarea placeholder="Any suggestions? We will pass it on..." aria-label="With textarea"
                                    class="form-control"></textarea>
                            </div>
                        </div> --}}
                        <div class="bg-white p-3 clearfix border-bottom">
                            <p class="mb-1">Item Total <span
                                    class="float-right text-dark">${{ Session::get('total') }}</span></p>
                                     <input type="hidden" name="sub_total" form="customerPaymentForm" value="{{ Session::get('total') }}">
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
                                    <input type="hidden" name="amount" form="customerPaymentForm" value="{{ Session::get('iGrandTotal') }}">
                                    <input type="hidden" name="tax" form="customerPaymentForm" value="{{ Session::get('idTax') }}">
                                    <input type="hidden" name="delivery_charge" form="customerPaymentForm" value="{{ Session::get('iDelivery') }}">
                                    <input type="hidden" name="vendor_id" form="customerPaymentForm" value="{{ Session::get('vendorID') }}">
                                    <input type="hidden" name="promocode_id" form="customerPaymentForm" value="{{ Session::get('coupon_id') }}">
                                    <input type="hidden" name="promocode_price" form="customerPaymentForm" value="{{ Session::get('iCoupons') }}">
                        </div>
                        <div class="p-3">
                            <button type="button" class="btn btn-success btn-block btn-lg" id="submit_final_order" form="customerPaymentForm">PAY
                                ${{ Session::get('iGrandTotal') }}<i class="feather-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('postScript')

<script src="{{ asset('customer/js/payment.js')}}"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

{!! Toastr::message() !!}

<script>

  $(document).on('click', '#submit_final_order', function(e){


switch($("input[name='payment_type']:checked").val()) {
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
function stripeResponseHandler(status, response)
        {

            if (response.error) {
               console.log(status);
               toastr.error(response.error.message);
              //  alert((response.error.message));
            }
            else
            {
                var token = response['id'];

                $('#customerPaymentForm').append("<input type='hidden' name='payment_token' value='" + token + "'/>");

                var customerPaymentFormData = new FormData($('#customerPaymentForm')[0]);

                console.log(customerPaymentFormData);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                        url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order/book",
                    @else
                    url:"{{ url('customer/restaurant/book-order', request()->route('id')) }}",
                    @endif
                    data: customerPaymentFormData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (result)
                    {
                        if (result.success == true)
                        {
                            // console.log(result);
                            toastr.success("Payment was successfull, redirecting...");

                            setTimeout(function() {
                                @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                                    window.location.replace("{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order-history");
                                @else
                                window.location.replace("{{ url('customer/order-history')}}");
                                @endif
                            }, 1000);
                        }
                        else
                        {
                            toastr.error("Payment not complete");

                        }
                    },
                    error: function (err)
                    {

                        toastr.warning(err.responseJSON.message);
                    }
                });
            }
        }

function codResponseHandler()
        {
            var customerPaymentFormData = new FormData($('#customerPaymentForm')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/book-order",
                @else
                url:"{{ url('customer/restaurant/book-order', request()->route('id')) }}",
                @endif
                data: customerPaymentFormData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result)
                {
                    if (result.success == true)
                    {
                        console.log(result);
                        toastr.success("Payment was successfull, redirecting...");

                        setTimeout(function() {

                            @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                                window.location.replace("{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order-history");
                            @else
                            window.location.replace("{{ url('customer/order-history')}}");
                            @endif
                        }, 1000);
                    }
                    else
                    {
                        console.log(result);
                        toastr.error("Payment not complete");
                    }
                },
                error: function (err)
                {
                    console.log(err);
                    toastr.error(err.responseJSON.errors);
                }

            });
        }
</script>

@append
