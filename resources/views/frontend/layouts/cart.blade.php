
<div id="cart_autoload">
    <div id="cart_box">
        <h3>Your order <i class="icon_cart_alt float-right"></i></h3>
        <table class="table table_summary">
            <tbody>
                
                @foreach(Cart::content() as $row)
                    <tr>
                        <td>
                            <a class="item_remove_from_cart" data-item-id="{{$row->id}}" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>{{$row->qty}}x</strong> {{$row->name}}
                            @if($row->options->has('custimization'))
                                <br>
                                <a href="javascript: void(0)" style="margin-left:15px;">
                                    Customizable
                                </a>
                            @endif
                        </td>
                        <td>
                            <strong class="float-right">{{$row->price}} {{ App\Models\GeneralSetting::first()->currency }}</strong>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        @if($page == 1)
            <hr>
            <div class="row" id="options_2">
                <div class="col-xl-6 col-md-12 col-sm-12 col-6">
                    <!-- <label><input type="radio" name="delivery_type" value="1" checked class="icheck update_delivery_type"/> Delivery</label> -->
                    <label>
                        
                        @if(session()->has('delivery_type') && session()->get('delivery_type') == 'HOME')
                            <input type="radio" name="delivery_type" value="HOME" checked class="update_delivery_type"/>
                        @else
                            <input type="radio" name="delivery_type" value="HOME" class="update_delivery_type"/>
                        @endif

                        Delivery
                    </label>
                </div>
                <div class="col-xl-6 col-md-12 col-sm-12 col-6">
                    <label>
                        
                        @if(session()->has('delivery_type') && session()->get('delivery_type') == 'SHOP')
                            <input type="radio" name="delivery_type" value="SHOP" checked class="update_delivery_type"/>
                        @else
                            <input type="radio" name="delivery_type" value="SHOP" class="update_delivery_type"/>
                        @endif

                        Take Away
                    </label>
                </div>
            </div><!-- Edn options 2 -->
        @endif
        <hr>
        <table class="table table_summary">
            <tbody>
                <!-- <tr>
                    <td>
                        Subtotal <span class="float-right">{{Cart::subtotal()}} {{ App\Models\GeneralSetting::first()->currency }}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Tax applied <span class="float-right">{{Cart::tax()}} {{ App\Models\GeneralSetting::first()->currency }}</span>
                    </td>
                </tr> -->
                <tr>
                    <td class="total">
                        TOTAL <span class="float-right">{{Cart::subtotal()}} {{ App\Models\GeneralSetting::first()->currency }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>

        @if(Auth::user() && Auth::user()->load('roles')->roles->contains('title', 'user'))
            @if($page == 3)
                <a class="btn_full" id="submit_final_order">Order now</a>
            @else
                @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    <a class="btn_full" href="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order/{{ $page }}">Order now</a>
                @else
                    @if($page == 1)
                        <a class="btn_full" href="{{ route('customer.restaurant.order.first.index', request()->route('id')) }}">Order now</a>
                    @elseif($page == 2)
                        <a class="btn_full" href="{{ route('customer.restaurant.order.second.index', request()->route('id')) }}">Order now</a>
                    @endif
                @endif
            @endif
        @else
            <a class="btn_full" href="#0" data-toggle="modal" data-target="#login_2">Login</a>
        @endif
    </div><!-- End cart_box -->
</div><!-- End cart_box -->



@section('cart_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".item_add_to_cart").click(function(e){

                e.preventDefault();
                
                $('#preloader').show();
                $('#preloader #status').show();

                var extra_status = $(this).attr("data-extra-status");
                var item_id = $(this).attr("data-item-id");
                var vendor_id = $(this).attr("data-vendor-id");

                if (extra_status == 0) {
                    $.ajax({
                        type:'POST',
                        @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                            url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/cart/add",
                        @else
                            url:"{{ route('customer.restaurant.cart.add', request()->route('id')) }}",
                        @endif
                        data:{vendor_id:vendor_id,extra_status:extra_status,item_id:item_id},
                        success:function(data){
                            $('.c-btn-cart').show();
                            $('#cart_modal_autoload').load(document.URL +  ' #cart_modal_autoload_box');
                            $('#cart_btn_autoload').load(document.URL +  ' #cart_btn_count');
                            $('#cart_autoload').load(document.URL +  ' #cart_box', function() {
                                $('#preloader').hide();
                                $('#preloader #status').hide();
                            });
                        }
                    });                    
                }
                else {
                    var extra_items = $(this).attr("data-extra-items");
                    var extra_data = "";

                    for (var i = 0; i < extra_items; i++) {
                        if (i == 0)
                            extra_data = $("input[name='custimization_"+item_id+"_"+i+"']:checked").val();
                        else
                            extra_data += ","+$("input[name='custimization_"+item_id+"_"+i+"']:checked").val();
                    }
                    extra_data = "["+extra_data+"]";
                    $.ajax({
                        type:'POST',
                        @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                            url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/cart/add",
                        @else
                            url:"{{ route('customer.restaurant.cart.add', request()->route('id')) }}",
                        @endif
                        data:{vendor_id:vendor_id,extra_status:extra_status,item_id:item_id,extra_data:extra_data},
                        success:function(data){
                            $('.c-btn-cart').show();
                            $('#cart_modal_autoload').load(document.URL +  ' #cart_modal_autoload_box');
                            $('#cart_btn_autoload').load(document.URL +  ' #cart_btn_count');
                            $('#cart_autoload').load(document.URL +  ' #cart_box', function() {
                                $('#preloader').hide();
                                $('#preloader #status').hide();
                            });
                        }
                    });    
                }

            });

            $(document).on('click', '.item_remove_from_cart', function(e){

                e.preventDefault();
                
                $('#preloader').show();
                $('#preloader #status').show();

                var item_id = $(this).attr("data-item-id");

                $.ajax({
                    type:'POST',
                    @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                        url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/cart/remove",
                    @else
                        url:"{{ route('customer.restaurant.cart.remove', request()->route('id')) }}",
                    @endif
                    data:{item_id:item_id},
                    success:function(data){
                        if($('#cart_btn_counter').text() == 1)
                            $('.c-btn-cart').hide();
                        $('#cart_modal_autoload').load(document.URL +  ' #cart_modal_autoload_box');
                        $('#cart_btn_autoload').load(document.URL +  ' #cart_btn_count');
                        $('#cart_autoload').load(document.URL +  ' #cart_box', function() {
                            $('#preloader').hide();
                            $('#preloader #status').hide();
                        });
                    }
                });

            });
            
            $(document).on('click', '.update_delivery_type', function(e){

                e.preventDefault();
                
                $('#preloader').show();
                $('#preloader #status').show();

                var delivery_type_radio = $(this);
                var delivery_type = $(this).val();


                $.ajax({
                    type:'POST',
                    @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                        url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/setting/delivery_type",
                    @else
                        url:"{{ route('customer.restaurant.setting.delivery_type', request()->route('id')) }}",
                    @endif
                    data:{delivery_type:delivery_type},
                    success:function(data){
                        delivery_type_radio.prop("checked", true);
                            
                        $('#preloader').hide();
                        $('#preloader #status').hide();
                        // console.log(data.success);
                    }
                });

            });
            
            $(document).on('click', '#submit_final_order', function(e){

                e.preventDefault();

                switch($("input[name='payment_method']:checked").val()) {
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
        });

        function stripeResponseHandler(status, response)
        {
            if (response.error) {
                toastr.error(response.error.message);
            }
            else
            {
                var token = response['id'];
                $('#customerPaymentForm').append("<input type='hidden' name='stripe_token' value='" + token + "'/>");

                var customerPaymentFormData = new FormData($('#customerPaymentForm')[0]);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                        url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order/book",
                    @else
                        url:"{{ route('customer.restaurant.order.book', request()->route('id')) }}",
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
                                    window.location.replace("{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order/book");
                                @else
                                    window.location.replace("{{ route('customer.restaurant.order.third.index', request()->route('id')) }}");
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
                        // console.log(err);
                        toastr.error(err.responseJSON.message);
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
                    url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order/book",
                @else
                    url:"{{ route('customer.restaurant.order.book', request()->route('id')) }}",
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
                                window.location.replace("{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/order/3");
                            @else
                                window.location.replace("{{ route('customer.restaurant.order.third.index', request()->route('id')) }}");
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
                    // console.log(err);
                    toastr.error(err.responseJSON.message);
                }
            });
        }
    </script>
@endsection