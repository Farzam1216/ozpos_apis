<div class="modal-header">
   <h5 class="modal-title">{{ ucwords($DealsMenu->name) }}</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <div class="container">
      @php
         $defaultData = [
             'Menu' => [],
         ];
      @endphp

      @foreach ($DealsMenu->DealsItems()->get() as $DealsItemsIDX => $DealsItems)
         <div>
            <div class="p-3 border-bottom menu-list">

               <span class="float-right">
                  <button id="DealsMenuItemsBtn-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" class="btn btn-outline-secondary btn-sm" onclick="DealsMenuItems('{{ $DealsMenu->id }}','{{ $DealsItems->id }}','{{ $rest->id }}','{{ $unique_id }}')">
                     Browse
                  </button>
               </span>

               {{-- @include('customer.restaurant.deals.modals.items') --}}

               <div class="media">
                  <div class="media-body">
                     <h6 class="mb-1">{{ ucwords($DealsItems->name) }}
                     </h6>
                  </div>
               </div>
            </div>
         </div>
      @endforeach
   </div>
</div>
<div class="modal-footer p-0 border-0">
   <div class="col-6 m-0 p-0">
      <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close
      </button>
   </div>
   <div class="col-6 m-0 p-0">
      <button id="DealsMenuSubmit-{{ $DealsMenu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-vendor="{{ $rest->id }}" data-id="3-{{ $DealsMenu->id }}" data-name="{{ ucwords($DealsMenu->name) }}" data-summary='{
                           "category":"DEALS",
                           "menu_category":{ "id": {{ $DealsMenu->id }} },
                           "menu": [],
                           "size": null,
                           "total_price":0
                           }' data-price="{{ $DealsMenu->price }}" data-quantity="1" data-image="{{ $DealsMenu->image }}" data-required="{{ $DealsMenu->DealsItems()->count() }}" data-dismiss="modal">
         Add To Cart
      </button>
   </div>
</div>{{-- Menu Menu Modal --}}
<div id="dealMenuItems" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dealsMenuItemsModal" aria-hidden="true" style="z-index: 1060">
   <div class="modal-dialog">
      <div class="modal-content" id="dealMenuItem">

      </div>
   </div>
</div>{{-- end Menu Single Menu --}}
<script>
   function DealsMenuItems(dealMenu_id, dealsItems_id, vendorId, unique_id) {

      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
         },
         type: "POST",
         @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         url: "{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-dealsMenuItems",
         @else
         url: "{{ url('customer/get-dealsMenuItems') }}",
         @endif
         data: {
            dealsMenuId: dealMenu_id,
            dealsItemsId: dealsItems_id,
            vendorId: vendorId,
            unique_id: unique_id

         },
         beforeSend: function () {
            $("#loading-image").show();
         },
         success: function (data) {
            console.log(data);
            $("#dealMenuItems").modal('show');
            $("#dealMenuItem").html(data);
            $("#loading-image").hide()
         },
         error: function (err) {

         }
      });
   }

   // });
</script>

<script>
   // let goToCartIcon = function ($addTocartBtn) {
   //        $cartIconPhone = $(".my-cart-icon-phone");
   //        $cartIconPc = $(".my-cart-icon-pc");
   //        $cartIconPc
   //            .delay(10).fadeTo(50, 0.5)
   //            .delay(10).fadeTo(50, 1)
   //            .delay(10).fadeTo(50, 0.5)
   //            .delay(10).fadeTo(50, 1);
   //        $cartIconPhone
   //            .delay(10).fadeTo(50, 0.5)
   //            .delay(10).fadeTo(50, 1)
   //            .delay(10).fadeTo(50, 0.5)
   //            .delay(10).fadeTo(50, 1);
   //        $addTocartBtn
   //            .delay(10).fadeTo(50, 0.5)
   //            .delay(10).fadeTo(50, 1)
   //            .delay(10).fadeTo(50, 0.5)
   //            .delay(10).fadeTo(50, 1);
   //     }
   // console.log('asd');
   $("#DealsMenuSubmit-{{ $DealsMenu->id }}").myCart({


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
         // goToCartIcon($addTocart);
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
            checkoutString += ("\n " + this.id + " \t " + this.name + " \t " + this.summary + " \t " + this.price + " \t " + this.quantity + " \t " + this.image + " \t " + this.vendor);

         });
         alert(checkoutString)
         console.log("checking out", products, totalPrice, totalQuantity);
      },
      getDiscountPrice: function (products, totalPrice, totalQuantity) {
         console.log("calculating discount", products, totalPrice, totalQuantity);
         return totalPrice * 0.5;
      }
   });
</script>
