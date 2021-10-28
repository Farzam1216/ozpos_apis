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
   <div class="container backcolor" >
    <div class="cat-slider" id="navbar-example2">

        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm active" href="#Traditional Pizza">
                <img alt="#" src="{{asset('customer/img/icons/Fries.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">Traditional Pizza</p>
            </a>
        </div>
        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="#Drinks">
                <img alt="#" src="{{asset('customer/img/icons/Pizza.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">Drinks</p>
            </a>
        </div>
        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="#Breakfast">
                <img alt="#" src="{{asset('customer/img/icons/Burger.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">Breakfast</p>
            </a>
        </div>
        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="#Cokes">
                <img alt="#" src="{{asset('customer/img/icons/Sandwich.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">Cokes</p>
            </a>
        </div>
        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="#Burger">
                <img alt="#" src="{{asset('customer/img/icons/Coffee.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">Burger</p>
            </a>
        </div>
        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="#steak">
                <img alt="#" src="{{asset('customer/img/icons/Steak.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">Steak</p>
            </a>
        </div>
        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="#colacan">
                <img alt="#" src="{{asset('customer/img/icons/ColaCan.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">ColaCan</p>
            </a>
        </div>
        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="#breakfast">
                <img alt="#" src="{{asset('customer/img/icons/Breakfast.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">Breakfast</p>
            </a>
        </div>
        <div class="cat-item px-1 py-3">
            <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="#salad">
                <img alt="#" src="{{asset('customer/img/icons/Salad.png')}}" class="img-fluid mb-2">
                <p class="m-0 small">Salad</p>
            </a>
        </div>


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
               <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
               @foreach($singleVendor['MenuCategory'] as $MenuCategoryIDX=>$MenuCategory)
                  <div class="row m-0">
                     <h6 class="p-3 m-0 bg-light w-100" id="{{ ucwords($MenuCategory->name) }}">{{ ucwords($MenuCategory->name) }}
                        <small class="text-black-50">
                           @if($MenuCategory->type == 'SINGLE')
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
                           @if($MenuCategory->type == 'SINGLE')
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

   <script type="text/javascript">
       $(document).ready(function () {

           var goToCartIcon = function ($addTocartBtn) {
               $cartIconPhone = $(".my-cart-icon-phone");
               $cartIconPc = $(".my-cart-icon-pc");
               $cartIconPc
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1)
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1);
               $cartIconPhone
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1)
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1);
               $addTocartBtn
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1)
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1);
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
               clickOnAddToCart: function ($addTocart) {
                   goToCartIcon($addTocart);
               },
               afterAddOnCart: function (products, totalPrice, totalQuantity) {
                   console.log("afterAddOnCart", products, totalPrice, totalQuantity);
               },
               clickOnCartIcon: function ($cartIcon, products, totalPrice, totalQuantity) {
                   console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
               },
               checkoutCart: function (products, totalPrice, totalQuantity) {
                   var checkoutString = "Total Price: " + totalPrice + "\nTotal Quantity: " + totalQuantity;
                   checkoutString += "\n\n id \t name \t summary \t price \t quantity \t image path";
                   $.each(products, function () {
                       checkoutString += ("\n " + this.id + " \t " + this.name + " \t " + this.summary + " \t " + this.price + " \t " + this.quantity + " \t " + this.image);
                   });
                   alert(checkoutString)
                   console.log("checking out", products, totalPrice, totalQuantity);
               },
               getDiscountPrice: function (products, totalPrice, totalQuantity) {
                   console.log("calculating discount", products, totalPrice, totalQuantity);
                   return totalPrice * 0.5;
               }
           });
       });
   </script>

@append
