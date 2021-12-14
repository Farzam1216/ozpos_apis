
  <script>
    $( function() {
      $( "#tabs" ).tabs();
    } );
    </script>
<div class="modal-header">
    <h5 class="modal-title">{{ ucwords($HalfNHalfMenu->name) }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        @php
            $ItemSizeObj = App\Models\ItemSize::where('vendor_id', $HalfNHalfMenu->vendor_id)->get();
        @endphp
        <h6 class="font-weight-bold mt-4">Pick Size</h6>
        <ul class="nav nav-pills">
            <li id="tabs">
                @foreach ($ItemSizeObj as $ItemSizeIDX => $ItemSize)
                    <a id="HalfMenuSizeBtn-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}"
                        class="btn btn-outline-primary btn-sm mb-3 mr-3" data-toggle="pill"
                        onclick="HalfMenuSize('{{ $HalfNHalfMenu->id }}','{{ $ItemSize->id }}','{{ $rest->id }}','{{$unique_id}}')">
                        {{ $ItemSize->name }}
                    </a>
                @endforeach
            </li>
        </ul>
        <div class="tab-content" id="HalfMenuSize">

        </div>
    </div>
</div>
<div class="modal-footer p-0 border-0">
    <div class="col-6 m-0 p-0">
        <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close
        </button>
    </div>
    <div class="col-6 m-0 p-0">
        <button id="HalfMenuSubmit-{{ $HalfNHalfMenu->id }}" type="button" disabled
            class="btn btn-primary btn-lg btn-block add-cart-btn" data-vendor="{{ $rest->id }}"
            data-id="2-{{ $HalfNHalfMenu->id }}" data-name="{{ ucwords($HalfNHalfMenu->name) }}" data-summary='{
                                                       "category":"HALF_N_HALF",
                                                       "menu": [],
                                                       "size": null,
                                                       "total_price": 0
                                                       }' data-price="0" data-quantity="1"
            data-image="{{ $HalfNHalfMenu->image }}" data-dismiss="modal">
            Add To Cart
        </button>
    </div>
</div>


<script>
  function HalfMenuSize(HalfNHalfMenuId,ItemSizeId,vendorId,unique_id) {

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
          },
          type: "POST",
          @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
              url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-halfMenuSize",
          @else
              url: "{{ url('customer/get-halfMenuSize') }}",
          @endif
          data: {
              HalfNHalfMenuId: HalfNHalfMenuId,
              ItemSizeId: ItemSizeId,
              vendorId: vendorId,
              unique_id: unique_id

          },

          success: function(data) {
              console.log(data);

              $("#HalfMenuSize").html(data);


          },
          error: function(err) {

          }
      });
  }
  </script>

<script>
  // let goToCartIcon = function($addTocartBtn) {
  //     $cartIconPhone = $(".my-cart-icon-phone");
  //     $cartIconPc = $(".my-cart-icon-pc");
  //     $cartIconPc
  //         .delay(10).fadeTo(50, 0.5)
  //         .delay(10).fadeTo(50, 1)
  //         .delay(10).fadeTo(50, 0.5)
  //         .delay(10).fadeTo(50, 1);
  //     $cartIconPhone
  //         .delay(10).fadeTo(50, 0.5)
  //         .delay(10).fadeTo(50, 1)
  //         .delay(10).fadeTo(50, 0.5)
  //         .delay(10).fadeTo(50, 1);
  //     $addTocartBtn
  //         .delay(10).fadeTo(50, 0.5)
  //         .delay(10).fadeTo(50, 1)
  //         .delay(10).fadeTo(50, 0.5)
  //         .delay(10).fadeTo(50, 1);
  // }

  $("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").myCart({

      currencySymbol: '{{ App\Models\GeneralSetting::first()->currency }}',
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      classProductQuantity: 'my-product-quantity',
      classProductRemove: 'my-product-remove',
      classCheckoutCart: 'my-cart-checkout',
      affixCartIcon: false,
      showCheckoutModal: true,
      numberOfDecimals: 2,
      cartItems: [{
              id: 1,
              name: 'product 1',
              summary: 'summary 1',
              price: 10,
              quantity: 1,
              image: 'images/img_1.png'
          },
          {
              id: 2,
              name: 'product 2',
              summary: 'summary 2',
              price: 20,
              quantity: 2,
              image: 'images/img_2.png'
          },
          {
              id: 3,
              name: 'product 3',
              summary: 'summary 3',
              price: 30,
              quantity: 1,
              image: 'images/img_3.png'
          }
      ],
      clickOnAddToCart: function($addTocart) {
          // goToCartIcon($addTocart);
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
          $.each(products, function() {
              checkoutString += ("\n " + this.id + " \t " + this.name + " \t " + this.summary +
                  " \t " + this.price + " \t " + this.quantity + " \t " + this.image +
                  " \t " + this.vendor);

          });
          alert(checkoutString)
          console.log("checking out", products, totalPrice, totalQuantity);
      },
      getDiscountPrice: function(products, totalPrice, totalQuantity) {
          console.log("calculating discount", products, totalPrice, totalQuantity);
          return totalPrice * 0.5;
      }
  });
</script>
