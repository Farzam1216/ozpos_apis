/*

*/

(function ($) {

   "use strict";

   var OptionManager = (function () {
      var objToReturn = {};

      var defaultOptions = {
         classCartIconPC: 'my-cart-icon-pc',
         classCartIconPhone: 'my-cart-icon-phone',
         classCartBadgePC: 'my-cart-badge-pc',
         classCartBadgePhone: 'my-cart-badge-phone',
         affixCartIcon: true,
         checkoutCart: function (products) {
         },
         clickOnAddToCart: function ($addTocart) {
         },
         getDiscountPrice: function (products) {
            return null;
         }
      };


      var getOptions = function (customOptions) {
         var options = $.extend({}, defaultOptions);
         if (typeof customOptions === 'object') {
            $.extend(options, customOptions);
         }
         return options;
      }

      objToReturn.getOptions = getOptions;
      return objToReturn;
   }());


   var ProductManager = (function () {
      var objToReturn = {};

      /*
      PRIVATE
      */
      localStorage.products = localStorage.products ? localStorage.products : "";
      var getIndexOfProduct = function (id) {
         var productIndex = -1;
         var products = getAllProducts();
         $.each(products, function (index, value) {
            if (value.id == id) {
               productIndex = index;
               return;
            }
         });
         return productIndex;
      }
      var setAllProducts = function (products) {
         // console.log(setAllProducts);
         localStorage.products = JSON.stringify(products);

      }
      var addProduct = function (vendor, id, name, summary, price, quantity, image) {
         console.log('Adding Products start.');
         console.log('Implement concept here if products exist get first and check vendor id and process whatever.');
         //  console.log('new product vendor id');
         //  console.log(vendor);
         //  console.log('old products');
         //  console.log(products.length);

         var products = getAllProducts();
         if (products.length > 0 && products[0].vendor != vendor) {
            products = [];
            clearProduct();
         }

         products.push({
            vendor: vendor,
            id: id,
            name: name,
            summary: summary,
            price: price,
            quantity: quantity,
            image: image
         });

         setAllProducts(products);
      }

      /*
      PUBLIC
      */
      var getAllProducts = function () {
         try {
            var products = JSON.parse(localStorage.products);
            return products;
         } catch (e) {
            return [];
         }
      }
      var updatePoduct = function (id, quantity) {
         var productIndex = getIndexOfProduct(id);
         if (productIndex < 0) {
            return false;
         }
         var products = getAllProducts();
         products[productIndex].quantity = typeof quantity === "undefined" ? products[productIndex].quantity * 1 + 1 : quantity;
         setAllProducts(products);
         return true;
      }
      var setProduct = function (vendor, id, name, summary, price, quantity, image) {
         if (typeof vendor === "undefined") {
            console.error("vendor id required")
            return false;
         }
         if (typeof id === "undefined") {
            console.error("id required")
            return false;
         }
         if (typeof name === "undefined") {
            console.error("name required")
            return false;
         }
         if (typeof image === "undefined") {
            console.error("image required")
            return false;
         }
         if (!$.isNumeric(price)) {
            console.error("price is not a number")
            return false;
         }
         if (!$.isNumeric(quantity)) {
            console.error("quantity is not a number");
            return false;
         }
         summary = typeof summary === "undefined" ? "" : summary;

         if (!updatePoduct(id)) {
            addProduct(vendor, id, name, summary, price, quantity, image);
         }
      }
      var clearProduct = function () {
         setAllProducts([]);
      }
      var removeProduct = function (id) {
         var products = getAllProducts();
         products = $.grep(products, function (value, index) {
            return value.id != id;
         });
         setAllProducts(products);
      }
      var getTotalQuantityOfProduct = function () {
         var total = 0;
         var products = getAllProducts();
         $.each(products, function (index, value) {
            total += value.quantity * 1;
         });
         return total;
      }

      objToReturn.getAllProducts = getAllProducts;
      objToReturn.updatePoduct = updatePoduct;
      objToReturn.setProduct = setProduct;
      objToReturn.clearProduct = clearProduct;
      objToReturn.removeProduct = removeProduct;
      objToReturn.getTotalQuantityOfProduct = getTotalQuantityOfProduct;
      return objToReturn;
   }());


   var loadMyCartEvent = function (userOptions) {

      var options = OptionManager.getOptions(userOptions);
      var $cartIconPC = $("." + options.classCartIconPC);
      var $cartIconPhone = $("." + options.classCartIconPhone);
      var $cartBadgePC = $("." + options.classCartBadgePC);
      var $cartBadgePhone = $("." + options.classCartBadgePhone);

      var idCartModal = 'my-cart-modal';
      var idCartTable = 'my-cart-table';
      var classProduct = 'my-product';
      var classProductQuantity = 'my-product-quantity';
      var classProductTotal = 'my-product-total';
      var idGrandTotal = 'my-cart-grand-total';
      var idUrl = 'my-cart-url';
      var idTotal = 'my-cart-total';
      var idTax = 'my-cart-tax';
      var id = 'my-cart-total-input';
      var idDelivery = 'my-cart-delivery';
      var idCoupons = 'my-cart-coupon';
      var idCouponInput = 'my-cart-coupon-input';
      var idCheckoutCart = 'checkout-my-cart';
      var idCheckoutModel = 'checkout-model-cart';
      var classProductInput = 'my-product-input';
      var classProductRemove = 'my-product-remove';
      var classProductInc = 'my-product-inc';
      var classProductDec = 'my-product-dec';
      var idEmptyCartMessage = 'my-cart-empty-message';
      var classAffixMyCartIcon = 'my-cart-icon-affix';
      var idDiscountPrice = 'my-cart-discount-price';
      var taxType = null;
      var tax = null;
      var couponID = null;
      var couponType = null;
      var couponCode = '';
      var freeDelivery = '';
      var freeDeliveryDistance = '';
      var freeDeliveryAmount = '';
      var minOrderValue = '';
      var userDistance = '';


      $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
      $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());

      if (!$("#" + idCartModal).length) {
         $('body').append(
             '<div class="modal fade" id="' + idCartModal + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">' +
             '<div class="modal-dialog" role="document">' +
             '<div class="modal-content">' +
             '<div class="modal-header">' +
             '<h4 class="modal-title" id="myModalLabel"><i class="feather-shopping-cart"></i> Cart</h4>' +
             '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
             '</div>' +
             '<div class="modal-body">' +
             '<div id="' + idCartTable + '"></div>' +
             '</div>' +
             '<div class="modal-footer">' +
             '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
             '<button type="button" class="btn btn-primary" id="' + idCheckoutCart + '">Checkout</button>' +
             '</div>' +
             '</div>' +
             '</div>' +
             '</div>'
         );
      }


      var drawTable = function () {
         var $cartTable = $("#" + idCartTable);
         $cartTable.empty();

         var products = ProductManager.getAllProducts();
         var totalIndex = products.length;
         $.each(products, function (index) {
            // if (index === 0) {
            //     $cartTable.append(
            //         '<div class="bg-white border-bottom py-2">'
            //     );
            // }

            var total = parseFloat(parseInt(this.quantity) * parseFloat(this.price)).toFixed(2);
            $cartTable.append(
                '<div title="' + this.summary + '" data-id="' + this.id + '" data-price="' + this.price + '" class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom menu-list ' + classProduct + '">' +
                '<div class="media align-items-center">' +
                '<img alt="#" src="' + this.image + '" alt="askbootstrap" class="mr-3 rounded-pill ">' +
                '<div class="media-body">' +
                '<p class="m-0" title="Item Name">' + this.name + '</p>' +
                '<p class="m-0" title="Unit Price">( $' + this.price + ' )</p>' +
                '</div>' +
                '</div>' +
                '<div class="d-flex align-items-center">' +
                '<p title="Total" class="text-gray mb-0 float-right ml-2 text-muted small ' + classProductTotal + '">$' + total + '</p>' +
                '</div>' +
                '<div class="d-flex align-items-center">' +
                '<span class="count-number float-right ' + classProductInput + '" style="min-width: 88px;">' +
                '<button title="Remove from Cart" type="button" class="btn-sm left dec btn btn-danger ' + classProductRemove + '"> <i class="feather-trash"></i> </button>' +
                '<button title="Decrease an Item" type="button" class="btn-sm left dec btn btn-outline-secondary ' + classProductDec + '"> <i class="feather-minus"></i> </button>' +
                '<input title="Quantity" class="count-number-input ' + classProductQuantity + '" type="text" readonly="" value="' + this.quantity + '">' +
                '<button title="Increase an Item" type="button" class="btn-sm right inc btn btn-outline-secondary ' + classProductInc + '"> <i class="feather-plus"></i> </button>' +
                '</span>' +
                '</div>'
            );

            // if (index === totalIndex - 1) {
            //     $cartTable.append(
            //         '</div>'
            //     );
            // }
         });

         $cartTable.append(products.length ?
             '<div class="bg-white p-3 clearfix border-bottom">' +
             '<p class="mb-1"><div class="row"><div class="col-md-6"><input type="text" id="' + idCouponInput + '" name="promo_coupon" placeholder="Apply Coupon Code here" class="form-control"></div><div class="col-md-6"> <span class="float-right text-dark" id=""><button  class="btn btn-primary btn-sm" id="applyCoupon" >Apply Coupon</button></span></div></div></p>' +
             '<p class="mb-1">Item Total <span class="float-right text-dark" id="' + idTotal + '" data-value="0">$</span></p>' +
             '<p class="mb-1">Apply Coupon <span class="float-right text-dark" id="' + idCoupons + '"  data-value="0">$</span></p>' +
             '<p class="mb-1">Tax <span class="float-right text-dark" id="' + idTax + '" data-value="0">$0</span></p>' +
             '<p class="mb-1">Delivery <span class="float-right text-dark" id="' + idDelivery + '" data-value="0">free</span></p>' +
             '<hr>' +
             '<h6 class="font-weight-bold mb-0">TO PAY <span class="float-right" id="' + idGrandTotal + '" data-value="0">$0</span></h6>' +
             '</div>'
             : '<div class="alert alert-danger" role="alert" id="' + idEmptyCartMessage + '">Your cart is empty</div>'
         );


         showGrandTotal();
         let base_url = window.location.origin;
         console.log(products);
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
        //  let url_HTTPs = "/customer/restaurant/tax";
        //  console.log(base_url);
        var originalUrl = (is_HTTP_X_FORWARDED_HOST == true) ? url_HTTP + "/tax" : url_HTTP_TAX;
        //  if (base_url === "http://ozpos.com") {
        //     var originalUrl = base_url + "/customer/restaurant/tax";
        //     // console.log(originalUrl);
        //  } else {
        //     var originalUrl = base_url + '/tax';
        //     // console.log(originalUrl);
        //  }

         $.ajax({
            url: originalUrl,
            method: "GET",
            success: function (data) {
               taxType = data.taxtype;
               tax = data.tax;
               freeDelivery = data.orderSettting.free_delivery;
               freeDeliveryDistance = data.orderSettting.free_delivery_distance;
               freeDeliveryAmount = data.orderSettting.free_delivery_amount;
               minOrderValue = data.orderSettting.min_order_value;
               userDistance = data.orderSettting.distance;

               showGrandTotal();
            }
         });

         $(document).on('click', '#applyCoupon', function () {
            let base_url = window.location.origin;
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
            // console.log(originalUrl);
            // let url_HTTPs = "/customer/restaurant/coupon";
            //  console.log(base_url);
            var originalUrl = (is_HTTP_X_FORWARDED_HOST == true) ? url_HTTP + "/singleCoupon" : url_HTTP_COUPON;

            var coupon = $("#" + idCouponInput).val();
            $.ajax({
               url: originalUrl,
               method: "GET",
               data: {coupon: coupon},
               success: function (data) {
                  couponType = data.discountType;
                  couponCode = data.discount;
                  couponID = data.coupon_id;

                  showGrandTotal();
               }
            });
         });
      }
      var showModal = function () {
         drawTable();
         $("#" + idCartModal).modal('show');
      }
      var updateCart = function () {
         $.each($("." + classProductQuantity), function () {
            var id = $(this).closest("tr").data("id");
            ProductManager.updatePoduct(id, $(this).val());
         });
      }

      var showGrandTotal = function () {
         let
             products = ProductManager.getAllProducts(),
             localTotal = 0.00,
             localCoupon = 0.00,
             localTax = 0.00,
             localDelivery = 0.00,
             localGrandTotal = 0.00;


         ///////////////////// Sub Total  ////////////////////
         $.each(products, function () {
            localTotal += parseFloat(parseInt(this.quantity) * parseFloat(this.price));
         });
         localGrandTotal += localTotal;


         ///////////////////// Coupon  ////////////////////
         if (couponType == 'percentage') {
            localCoupon = localTotal * parseFloat(couponCode) / 100;
            localGrandTotal -= localCoupon;
         } else if (couponType == 'amount') {
            localCoupon = parseFloat(couponCode);
            localGrandTotal -= localCoupon;
         }


         ////////////// Tax /////////////////
         if (taxType == 1) {
            localTax = localTotal * parseFloat(tax) / 100;
            localTotal -= localTax;
         } else if (taxType == 2) {
            localTax = localTotal * parseFloat(tax) / 100;
            localGrandTotal += localTax;
         }


         ///////////////////// Delivery  ////////////////////
         if (freeDelivery == 1) {
            localDelivery = 'free';
         } else {
            if (freeDeliveryDistance != 0 && freeDeliveryAmount != 0) {
               if (localGrandTotal >= freeDeliveryAmount && userDistance <= freeDeliveryDistance) {
                  localDelivery = 'free';
               } else {
                  localDelivery = localGrandTotal * 0.1;
                  localGrandTotal += localDelivery;
               }
            } else if (freeDeliveryDistance == 0) {
               if (localGrandTotal >= freeDeliveryAmount) {
                  localDelivery = 'free';
               } else {
                  localDelivery = localGrandTotal * 0.1;
                  localGrandTotal += localDelivery;
               }
            } else if (freeDeliveryAmount == 0) {
               if (userDistance <= freeDeliveryDistance) {
                  localDelivery = 'free';
               } else {
                  localDelivery = localGrandTotal * 0.1;
                  localGrandTotal += localDelivery;
               }
            }
         }

         ///////////////////// Update Values  ////////////////////
         $("#" + idTotal).text("$" + parseFloat(localTotal).toFixed(2));
         $("#" + idTotal).data('value', parseFloat(localTotal).toFixed(2));

         $("#" + idTax).text("$" + parseFloat(localTax).toFixed(2));
         $("#" + idTax).data('value', parseFloat(localTax).toFixed(2));

         $("#" + idCoupons).text("$" + parseFloat(localCoupon).toFixed(2));
         $("#" + idCoupons).data('value', parseFloat(localCoupon).toFixed(2));

         if (localDelivery == 'free') {
            $("#" + idDelivery).text(localDelivery);
            $("#" + idDelivery).data('value', 0);
         } else {
            $("#" + idDelivery).text("$" + parseFloat(localDelivery).toFixed(2));
            $("#" + idDelivery).data('value', parseFloat(localDelivery).toFixed(2));
         }

         $("#" + idGrandTotal).text("$" + parseFloat(localGrandTotal).toFixed(2));
         $("#" + idGrandTotal).data('value', parseFloat(localGrandTotal).toFixed(2));


         $("#" + idCheckoutCart).click(function () {
            var products = ProductManager.getAllProducts();
            // products.forEach()
            var jsonProducts = encodeURIComponent((JSON.stringify(products)));
            // console.log(products);
            // console.log(jsonProducts);
            // return;
            let base_url = window.location.origin;
            ///////////// store into session ///
            var iTotal = $("#" + idTotal).data();
            var iTax = $("#" + idTax).data();
            var iCoupons = $("#" + idCoupons).data();
            var iDelivery = $("#" + idDelivery).data();
            var iGrandTotal = $("#" + idGrandTotal).data();


            var total = iTotal.value;
            var iTax = iTax.value;
            var iGrandTotal = iGrandTotal.value;
            var iCoupons = iCoupons.value;
            var iDelivery = iDelivery.value;
            var couponID = couponID;
            var product = jsonProducts;
            var vendorId = products[0].vendor;

            var checkoutUrl = (is_HTTP_X_FORWARDED_HOST == true) ? url_HTTP + "/checkout" : url_HTTP;
            var checkoutForm = '<form action="'+checkoutUrl+'" method="post">';
            checkoutForm += '<input type="text" name="vendorId" value="'+vendorId+'">';
            checkoutForm += '<input type="text" name="total" value="'+total+'">';
            checkoutForm += '<input type="text" name="iGrandTotal" value="'+iGrandTotal+'">';
            checkoutForm += '<input type="text" name="iTax" value="'+iTax+'">';
            checkoutForm += '<input type="text" name="iCoupons" value="'+iCoupons+'">';
            checkoutForm += '<input type="text" name="iDelivery" value="'+iDelivery+'">';
            checkoutForm += '<input type="text" name="couponID" value="'+couponID+'">';

            checkoutForm += '<input type="text" name="product" value='+jsonProducts+'>';

            // $(checkoutForm).appendTo('body');
            // return;
            $(checkoutForm).appendTo('body').submit();

            //  if (base_url === "http://ozpos.com") {
            //     window.location.href = base_url + "/customer/restaurant/checkout?total=" + iTotal.value + "&idTax=" + iTax.value + "&iCoupons=" + iCoupons.value + "&iDelivery=" + iDelivery.value + "&iGrandTotal=" + iGrandTotal.value + "&coupon_id=" + couponID + "&vendorID=" + vendorId + "&product=" + jsonProducts;
            //     // window.location.href = url;
            //  } else {
            //     window.location.href = base_url + "/checkout?total=" + iTotal.value + "&idTax=" + iTax.value + "&iCoupons=" + iCoupons.value + "&iDelivery=" + iDelivery.value + "&iGrandTotal=" + iGrandTotal.value + "&coupon_id=" + couponID + "&vendorID=" + vendorId + "&product=" + jsonProducts;
            //     // console.log(url);
            //     // window.location.href = url;
            //  }

            //alert('asdasd');
            //if (!products.length) {
            //$("#" + idEmptyCartMessage).fadeTo('fast', 0.5).fadeTo('fast', 1.0);
            //return;
            //}
            //updateCart();
            // options.checkoutCart(ProductManager.getAllProducts());
            //ProductManager.clearProduct();
            //$cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
            //$cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());

         });

      }

      var showDiscountPrice = function (products) {
         $("#" + idDiscountPrice).text("$" + options.getDiscountPrice(products));
      }


      /*
      EVENT
      */
      if (options.affixCartIcon) {
         var cartIconBottom = $cartIcon.offset().top * 1 + $cartIcon.css("height").match(/\d+/) * 1;
         var cartIconPosition = $cartIcon.css('position');
         $(window).scroll(function () {
            if ($(window).scrollTop() >= cartIconBottom) {
               $cartIcon.css('position', 'fixed').css('z-index', '999').addClass(classAffixMyCartIcon);
            } else {
               $cartIcon.css('position', cartIconPosition).css('background-color', 'inherit').removeClass(classAffixMyCartIcon);
            }
         });
      }

      $cartIconPC.click(showModal);
      $cartIconPhone.click(showModal);

      $(document).on("input", "." + classProductQuantity, function () {
         var price = $(this).closest("tr").data("price");
         var id = $(this).closest("tr").data("id");
         var quantity = $(this).val();

         $(this).parent("td").next("." + classProductTotal).text("$" + price * quantity);
         ProductManager.updatePoduct(id, quantity);

         $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
         $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());
         var products = ProductManager.getAllProducts();
         showGrandTotal();
         showDiscountPrice(products);
      });

      $(document).on("click", "." + classProductInc, function () {
         var price = $(this).closest("." + classProduct).data("price");
         var id = $(this).closest("." + classProduct).data("id");
         var quantity = $(this).parent("." + classProductInput).find("." + classProductQuantity).val();
         quantity = parseInt(quantity) + 1;

         $(this).parent("." + classProductInput).find("." + classProductQuantity).val(quantity);
         $(this).closest("." + classProduct).find("." + classProductTotal).text("$" + price * quantity);
         ProductManager.updatePoduct(id, quantity);

         $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
         $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());
         var products = ProductManager.getAllProducts();
         showGrandTotal();
         showDiscountPrice(products);
      });

      $(document).on("click", "." + classProductDec, function () {
         var quantity = $(this).parent("." + classProductInput).find("." + classProductQuantity).val();

         if (quantity == 1)
            return;

         var price = $(this).closest("." + classProduct).data("price");
         var id = $(this).closest("." + classProduct).data("id");
         quantity = parseInt(quantity) - 1;

         $(this).parent("." + classProductInput).find("." + classProductQuantity).val(quantity);
         $(this).closest("." + classProduct).find("." + classProductTotal).text("$" + price * quantity);
         ProductManager.updatePoduct(id, quantity);

         $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
         $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());
         var products = ProductManager.getAllProducts();
         showGrandTotal();
         showDiscountPrice(products);
      });

      $(document).on('click', "." + classProductRemove, function () {
         var $tr = $(this).closest("." + classProduct);
         var id = $tr.data("id");
         $tr.hide(500, function () {
            ProductManager.removeProduct(id);
            drawTable();
            $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
            $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());
         });
      });


      $(document).on('keypress', "." + classProductQuantity, function (evt) {
         if (evt.keyCode == 38 || evt.keyCode == 40) {
            return;
         }
         evt.preventDefault();
      });
   }


   var MyCart = function (target, userOptions) {
      /*
      PRIVATE
      */
      var $target = $(target);
      var options = OptionManager.getOptions(userOptions);
      var $cartIconPC = $("." + options.classCartIconPC);
      var $cartIconPhone = $("." + options.classCartIconPhone);
      var $cartBadgePC = $("." + options.classCartBadgePC);
      var $cartBadgePhone = $("." + options.classCartBadgePhone);

      /*
      EVENT
      */
      $target.on('click', function () {
        alert(11);
         options.clickOnAddToCart($target);

         var vendor = $target.data('vendor');
         var id = $target.data('id');
         var name = $target.data('name');
         var summary = $target.data('summary');
         var price = $target.data('price');
         var quantity = $target.data('quantity');
         var image = $target.data('image');


         ProductManager.setProduct(vendor, id, name, summary, price, quantity, image);
         $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
         $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());
      });

   }

   $.fn.myCart = function (userOptions) {

      loadMyCartEvent(userOptions);
      return $.each(this, function () {
         new MyCart(this, userOptions);
      });
   }


})(jQuery);


