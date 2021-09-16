@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app', ['activePage' => 'restaurant'] )

@if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
    @section('logo',$rest->vendor_logo)
    @section('subtitle','Menu')
    @section('vendor_lat',$rest->lat)
    @section('vendor_lang',$rest->lang)
@endif

@section('title',$rest->name)

@section('content')

    <div class="offer-section py-4">
        <div class="container position-relative">
            <img alt="#" src="{{ $rest->image }}" class="restaurant-pic">
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
{{--                    <p class="label-rating text-white ml-2 small"> (245 Reviews)</p>--}}
                </div>
            </div>
{{--            <div class="pb-4">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-6 col-md-2">--}}
{{--                        <p class="text-white-50 font-weight-bold m-0 small">Delivery</p>--}}
{{--                        <p class="text-white m-0">Free</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 col-md-2">--}}
{{--                        <p class="text-white-50 font-weight-bold m-0 small">Open time</p>--}}
{{--                        <p class="text-white m-0">8:00 AM</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    <!-- Menu -->
    <div class="container position-relative">
        <div class="row">
            <div class="col-md-12 pt-3">
                <div class="shadow-sm rounded bg-white mb-3 overflow-hidden">
                    <div class="d-flex item-aligns-center">
                        <p class="font-weight-bold h6 p-3 border-bottom mb-0 w-100">Menu</p>
                        <!-- <a class="small text-primary font-weight-bold ml-auto" href="#">View all <i class="feather-chevrons-right"></i></a> -->
                    </div>
                    @foreach($singleVendor['menu'] as $idx=>$menu)
                        <div class="row m-0">
                            <h6 class="p-3 m-0 bg-light w-100">{{ ucwords($menu->name) }} <small class="text-black-50">{{ count($menu->submenu) }} ITEMS</small></h6>
                            <div class="col-md-12 px-0 border-top">
                                <div class="">

                                    @foreach($menu->submenu as $idx2=>$submenu)

                                        <div class="p-3 border-bottom menu-list">

                                            @if(count($submenu->custimization) == 0)
                                                <span class="float-right">
                                                    <button class="btn btn-outline-secondary btn-sm add-cart-btn" data-id="{{ $submenu->id }}" data-name="{{ ucwords($submenu->name) }}" data-summary="summary 2" data-price="{{ $submenu->price }}" data-quantity="1" data-image="{{ $submenu->image }}">ADD</button>
                                                </span>
                                            @else
                                                <span class="float-right">
                                                    <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#customization{{ $submenu->id }}">ADD</button>
                                                </span>


                                                @section('custom_modals')
                                                    <!-- extras modal -->
                                                    <div class="modal fade" id="customization{{ $submenu->id }}" tabindex="-1" role="dialog" aria-labelledby="customizationModal{{ $submenu->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Extras</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form>
                                                                        <!-- extras body -->
                                                                        <div class="recepie-body">
                                                                            <div class="custom-control custom-radio border-bottom py-2">
                                                                                <input type="radio" id="customRadio1f" name="location" class="custom-control-input" checked>
                                                                                <label class="custom-control-label" for="customRadio1f">Tuna <span class="text-muted">+$35.00</span></label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio border-bottom py-2">
                                                                                <input type="radio" id="customRadio2f" name="location" class="custom-control-input">
                                                                                <label class="custom-control-label" for="customRadio2f">Salmon <span class="text-muted">+$20.00</span></label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio border-bottom py-2">
                                                                                <input type="radio" id="customRadio3f" name="location" class="custom-control-input">
                                                                                <label class="custom-control-label" for="customRadio3f">Wasabi <span class="text-muted">+$25.00</span></label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio border-bottom py-2">
                                                                                <input type="radio" id="customRadio4f" name="location" class="custom-control-input">
                                                                                <label class="custom-control-label" for="customRadio4f">Unagi  <span class="text-muted">+$10.00</span></label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio border-bottom py-2">
                                                                                <input type="radio" id="customRadio5f" name="location" class="custom-control-input">
                                                                                <label class="custom-control-label" for="customRadio5f">Vegetables  <span class="text-muted">+$5.00</span></label>
                                                                            </div>
                                                                            <div class="custom-control custom-radio border-bottom py-2">
                                                                                <input type="radio" id="customRadio6f" name="location" class="custom-control-input">
                                                                                <label class="custom-control-label" for="customRadio6f">Noodles  <span class="text-muted">+$30.00</span></label>
                                                                            </div>
                                                                            <h6 class="font-weight-bold mt-4">QUANTITY</h6>
                                                                            <div class="d-flex align-items-center">
                                                                                <p class="m-0">1 Item</p>
                                                                                <div class="ml-auto">
                                                                                    <span class="count-number"><button type="button" class="btn-sm left dec btn btn-outline-secondary"> <i class="feather-minus"></i> </button><input class="count-number-input" type="text" readonly="" value="1"><button type="button" class="btn-sm right inc btn btn-outline-secondary"> <i class="feather-plus"></i> </button></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer p-0 border-0">
                                                                    <div class="col-6 m-0 p-0">
                                                                        <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                    <div class="col-6 m-0 p-0">
                                                                        <button type="button" class="btn btn-primary btn-lg btn-block">Apply</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endsection


                                            @endif

                                            <div class="media">
                                                <img alt="#" src="{{ $submenu->image }}" alt="askbootstrap" class="mr-3 rounded-pill ">
                                                <div class="media-body">
                                                    <h6 class="mb-1">{{ ucwords($submenu->name) }}
                                                        <span class="badge badge-success">Veg</span>
                                                        <span class="badge badge-danger">Non Veg</span>
                                                        @if(count($submenu->custimization) == 1)
                                                            <span class="badge badge-danger">Customizable</span>
                                                        @endif
                                                    </h6>
                                                    <p class="text-muted mb-0">{{ $submenu->price }} {{ App\Models\GeneralSetting::first()->currency }}</p>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection


@section('postScript')

    <script type="text/javascript">
        $( document ).ready(function() {

            var goToCartIcon = function($addTocartBtn){
                $cartIconPhone = $(".my-cart-icon-phone");
                $cartIconPc = $(".my-cart-icon-pc");
                $cartIconPc
                    .delay(10).fadeTo(50,0.5)
                    .delay(10).fadeTo(50,1)
                    .delay(10).fadeTo(50,0.5)
                    .delay(10).fadeTo(50,1);
                $cartIconPhone
                    .delay(10).fadeTo(50,0.5)
                    .delay(10).fadeTo(50,1)
                    .delay(10).fadeTo(50,0.5)
                    .delay(10).fadeTo(50,1);
                $addTocartBtn
                    .delay(10).fadeTo(50,0.5)
                    .delay(10).fadeTo(50,1)
                    .delay(10).fadeTo(50,0.5)
                    .delay(10).fadeTo(50,1);
                // var $cartIcon = null;
                //
                // if ($(window).width() <= 661) {
                //     $cartIcon = $(".my-cart-icon-phone");
                // }
                // else {
                //     $cartIcon = $(".my-cart-icon-pc");
                // }
                //
                // var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
                // $addTocartBtn.prepend($image);
                // var position = $cartIcon.position();
                // $image.animate({
                //     top: position.top,
                //     left: position.left
                // }, 500 , "linear", function() {
                //     $image.remove();
                // });
            }

            $('.add-cart-btn').myCart({
                currencySymbol: '{{ App\Models\GeneralSetting::first()->currency }}',
                classCartIcon: 'my-cart-icon',
                classCartBadge: 'my-cart-badge',
                classProductQuantity: 'my-product-quantity',
                classProductRemove: 'my-product-remove',
                classCheckoutCart: 'my-cart-checkout',
                affixCartIcon: false,
                showCheckoutModal: true,
                numberOfDecimals: 2,
                cartItems: [
                    {id: 1, name: 'product 1', summary: 'summary 1', price: 10, quantity: 1, image: 'images/img_1.png'},
                    {id: 2, name: 'product 2', summary: 'summary 2', price: 20, quantity: 2, image: 'images/img_2.png'},
                    {id: 3, name: 'product 3', summary: 'summary 3', price: 30, quantity: 1, image: 'images/img_3.png'}
                ],
                clickOnAddToCart: function($addTocart){
                    goToCartIcon($addTocart);
                },
                afterAddOnCart: function(products, totalPrice, totalQuantity) {
                    console.log("afterAddOnCart", products, totalPrice, totalQuantity);
                },
                clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
                    console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
                },
                checkoutCart: function(products, totalPrice, totalQuantity) {
                    var checkoutString = "Total Price: " + totalPrice + "\nTotal Quantity: " + totalQuantity;
                    checkoutString += "\n\n id \t name \t summary \t price \t quantity \t image path";
                    $.each(products, function(){
                        checkoutString += ("\n " + this.id + " \t " + this.name + " \t " + this.summary + " \t " + this.price + " \t " + this.quantity + " \t " + this.image);
                    });
                    alert(checkoutString)
                    console.log("checking out", products, totalPrice, totalQuantity);
                },
                getDiscountPrice: function(products, totalPrice, totalQuantity) {
                    console.log("calculating discount", products, totalPrice, totalQuantity);
                    return totalPrice * 0.5;
                }
            });
        });
    </script>

@endsection
