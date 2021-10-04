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
            checkoutCart: function(products) { },
            clickOnAddToCart: function($addTocart) { },
            getDiscountPrice: function(products) { return null; }
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


    var ProductManager = (function(){
        var objToReturn = {};

        /*
        PRIVATE
        */
        localStorage.products = localStorage.products ? localStorage.products : "";
        var getIndexOfProduct = function(id){
            var productIndex = -1;
            var products = getAllProducts();
            $.each(products, function(index, value){
                if(value.id == id){
                    productIndex = index;
                    return;
                }
            });
            return productIndex;
        }
        var setAllProducts = function(products){
            localStorage.products = JSON.stringify(products);
        }
        var addProduct = function(id, name, summary, price, quantity, image) {
            var products = getAllProducts();
            products.push({
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
        var getAllProducts = function(){
            try {
                var products = JSON.parse(localStorage.products);
                return products;
            } catch (e) {
                return [];
            }
        }
        var updatePoduct = function(id, quantity) {
            var productIndex = getIndexOfProduct(id);
            if(productIndex < 0){
                return false;
            }
            var products = getAllProducts();
            products[productIndex].quantity = typeof quantity === "undefined" ? products[productIndex].quantity * 1 + 1 : quantity;
            setAllProducts(products);
            return true;
        }
        var setProduct = function(id, name, summary, price, quantity, image) {
            if(typeof id === "undefined"){
                console.error("id required")
                return false;
            }
            if(typeof name === "undefined"){
                console.error("name required")
                return false;
            }
            if(typeof image === "undefined"){
                console.error("image required")
                return false;
            }
            if(!$.isNumeric(price)){
                console.error("price is not a number")
                return false;
            }
            if(!$.isNumeric(quantity)) {
                console.error("quantity is not a number");
                return false;
            }
            summary = typeof summary === "undefined" ? "" : summary;

            if(!updatePoduct(id)){
                addProduct(id, name, summary, price, quantity, image);
            }
        }
        var clearProduct = function(){
            setAllProducts([]);
        }
        var removeProduct = function(id){
            var products = getAllProducts();
            products = $.grep(products, function(value, index) {
                return value.id != id;
            });
            setAllProducts(products);
        }
        var getTotalQuantityOfProduct = function(){
            var total = 0;
            var products = getAllProducts();
            $.each(products, function(index, value){
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


    var loadMyCartEvent = function(userOptions){

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
        var idTotal = 'my-cart-total';
        var idCheckoutCart = 'checkout-my-cart';
        var classProductInput = 'my-product-input';
        var classProductRemove = 'my-product-remove';
        var classProductInc = 'my-product-inc';
        var classProductDec = 'my-product-dec';
        var idEmptyCartMessage = 'my-cart-empty-message';
        var classAffixMyCartIcon = 'my-cart-icon-affix';
        var idDiscountPrice = 'my-cart-discount-price';

        $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
        $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());

        if(!$("#" + idCartModal).length) {
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

        var drawTable = function(){
            var $cartTable = $("#" + idCartTable);
            $cartTable.empty();

            var products = ProductManager.getAllProducts();
            var totalIndex = products.length;
            $.each(products, function(index){
                // if (index === 0) {
                //     $cartTable.append(
                //         '<div class="bg-white border-bottom py-2">'
                //     );
                // }

                var total = parseFloat(parseInt(this.quantity) * parseFloat(this.price)).toFixed(2);
                $cartTable.append(
                    '<div title="' + this.summary + '" data-id="' + this.id + '" data-price="' + this.price + '" class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom menu-list ' + classProduct + '">'+
                    '<div class="media align-items-center">'+
                    '<img alt="#" src="' + this.image + '" alt="askbootstrap" class="mr-3 rounded-pill ">' +
                    '<div class="media-body">'+
                    '<p class="m-0" title="Item Name">' + this.name + '</p>'+
                    '<p class="m-0" title="Unit Price">( $' + this.price + ' )</p>'+
                    '</div>'+
                    '</div>'+
                    '<div class="d-flex align-items-center">'+
                    '<p title="Total" class="text-gray mb-0 float-right ml-2 text-muted small ' + classProductTotal + '">$' + total + '</p>'+
                    '</div>'+
                    '<div class="d-flex align-items-center">'+
                    '<span class="count-number float-right '  + classProductInput + '" style="min-width: 88px;">' +
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
                '<div class="bg-white p-3 clearfix border-bottom">'+
                '<p class="mb-1">Item Total <span class="float-right text-dark" id="' + idTotal + '">$</span></p>'+
                '<p class="mb-1">Restaurant Charges <span class="float-right text-dark">$62.8</span></p>'+
                '<p class="mb-1">Delivery Fee<span class="text-info ml-1"><i class="feather-info"></i></span><span class="float-right text-dark">$10</span></p>'+
                '<p class="mb-1 text-success">Total Discount<span class="float-right text-success">$1884</span></p>'+
                '<hr>'+
                '<h6 class="font-weight-bold mb-0">TO PAY <span class="float-right" id="' + idGrandTotal + '">$</span></h6>'+
                '</div>'
                : '<div class="alert alert-danger" role="alert" id="' + idEmptyCartMessage + '">Your cart is empty</div>'




            );

            // var discountPrice = options.getDiscountPrice(products);
            // if(discountPrice !== null) {
            //     $cartTable.append(
            //         '<tr style="color: red">' +
            //         '<td></td>' +
            //         '<td><strong>Total (including discount)</strong></td>' +
            //         '<td></td>' +
            //         '<td></td>' +
            //         '<td><strong id="' + idDiscountPrice + '">$</strong></td>' +
            //         '<td></td>' +
            //         '</tr>'
            //     );
            // }

            showGrandTotal(products);
            // showDiscountPrice(products);
        }
        var showModal = function(){
            drawTable();
            $("#" + idCartModal).modal('show');
        }
        var updateCart = function(){
            $.each($("." + classProductQuantity), function(){
                var id = $(this).closest("tr").data("id");
                ProductManager.updatePoduct(id, $(this).val());
            });
        }
        var showGrandTotal = function(products){
            var total = 0.00;
            $.each(products, function(){
                total += parseFloat(parseInt(this.quantity) * parseFloat(this.price));
            });
            $("#" + idTotal).text("$" + total.toFixed(2));
        }
        var showDiscountPrice = function(products){
            $("#" + idDiscountPrice).text("$" + options.getDiscountPrice(products));
        }

        /*
        EVENT
        */
        if(options.affixCartIcon) {
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
            showGrandTotal(products);
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
            showGrandTotal(products);
            showDiscountPrice(products);
        });

        $(document).on("click", "." + classProductDec, function () {
            var quantity = $(this).parent("." + classProductInput).find("." + classProductQuantity).val();

            if(quantity == 1)
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
            showGrandTotal(products);
            showDiscountPrice(products);
        });

        $(document).on('click', "." + classProductRemove, function(){
            var $tr = $(this).closest("." + classProduct);
            var id = $tr.data("id");
            $tr.hide(500, function(){
                ProductManager.removeProduct(id);
                drawTable();
                $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
                $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());
            });
        });

        $("#" + idCheckoutCart).click(function(){
            var products = ProductManager.getAllProducts();
            if(!products.length) {
                $("#" + idEmptyCartMessage).fadeTo('fast', 0.5).fadeTo('fast', 1.0);
                return ;
            }
            updateCart();
            options.checkoutCart(ProductManager.getAllProducts());
            ProductManager.clearProduct();
            $cartBadgePC.text(ProductManager.getTotalQuantityOfProduct());
            $cartBadgePhone.text(ProductManager.getTotalQuantityOfProduct());
            $("#" + idCartModal).modal("hide");
        });

        $(document).on('keypress', "." + classProductQuantity, function(evt){
            if(evt.keyCode == 38 || evt.keyCode == 40){
                return ;
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
        $target.click(function(){
            options.clickOnAddToCart($target);

            var id = $target.data('id');
            var name = $target.data('name');
            var summary = $target.data('summary');
            var price = $target.data('price');
            var quantity = $target.data('quantity');
            var image = $target.data('image');

            ProductManager.setProduct(id, name, summary, price, quantity, image);
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
