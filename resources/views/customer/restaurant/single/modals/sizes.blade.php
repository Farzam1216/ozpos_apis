<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">{{ ucwords($Menu->name) }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="container">
        <h6 class="font-weight-bold mt-4">Pick Size</h6>
        <ul class="nav nav-pills">
            @foreach ($Menu->MenuSize()->get() as $MenuSizeIDX => $MenuSize)
                @if ($MenuSizeIDX === 0)
                    @php
                        /** @var mixed $MenuSize */
                        $defaultSize = [
                            'ID' => $MenuSize->id,
                            'Name' => $MenuSize
                                ->ItemSize()
                                ->get()
                                ->first()->name,
                            'Price' => $MenuSize->price,
                        ];
                    @endphp
                @endif
                <li>
                    <a id="SingleMenuSizeBtn-{{ $SingleMenu->id }}-{{ $MenuSize->id }}"
                        class="btn btn-outline-primary btn-sm mb-3 mr-3 @if ($MenuSizeIDX === 0) active @endif" data-toggle="pill"
                        href="#SingleMenuSize-{{ $SingleMenu->id }}-{{ $MenuSize->id }}">
                        <b>
                            {{ $MenuSize->ItemSize()->get()->first()->name }}
                        </b>

                        <br>
                        @if ($MenuSize->display_discount_price === null)
                            {{ $MenuSize->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                        @else
                            <span class="text-decoration-overline">
                                {{ $MenuSize->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                            </span>
                            &ensp;
                            {{ $MenuSize->display_discount_price }}
                            {{ App\Models\GeneralSetting::first()->currency }}
                        @endif
                    </a>
                </li>
                {{-- @include('customer.restaurant.single.scripts.sizes') --}}

                <script type="text/javascript">
                    $("#SingleMenuSizeBtn-{{ $SingleMenu->id }}-{{ $MenuSize->id }}").click(function() {
                        let masterData = $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data();
                        masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
                        let generateId = "{{ $unique_id }}-{{ $SingleMenu->id }}-{{ $MenuSize->id }}";
                        let generateTotalPrice = parseFloat("{{ $MenuSize->price }}");

                        masterData.summary.size.id = {{ $MenuSize->id }};
                        masterData.summary.size.name = "{{ $MenuSize->ItemSize()->get()->first()->name }}";
                        masterData.summary.size.price = "{{ $MenuSize->price }}";
                        masterData.summary.menu[0].addons.length = []

                        $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}:checked').each(function(i, obj) {
                            masterData.summary.menu[0].addons.push({
                                "id": $(this).data('id'),
                                "name": $(this).data('name'),
                                "price": $(this).data('price').toString()
                            });
                            generateId += "-" + $(this).data('id');
                            generateTotalPrice += parseFloat($(this).data('price'));
                        });

                        masterData.id = generateId;
                        masterData.price = generateTotalPrice.toString();
                        masterData.summary.total_price = generateTotalPrice.toString();
                        $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data(masterData);
                        console.log($("#SingleMenuSubmit-{{ $SingleMenu->id }}").data());
                    });

                    $(".SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}").change(function() {
                        let groupMenuAddonId = $(this).data('group_menu_addon_id');
                        let checkedCheckBox = $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-' +
                            groupMenuAddonId + ':checked');
                        let checked = checkedCheckBox.length;
                        let masterData = $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data();
                        masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
                        let generateId = "{{ $unique_id }}-{{ $SingleMenu->id }}-{{ $MenuSize->id }}";
                        let generateTotalPrice = parseFloat("{{ $MenuSize->price }}");
                        let maxAllowed = $(this).data('max');

                        if (maxAllowed == 1) {
                            checkedCheckBox.each(function(i, obj) {
                                $(this).prop('checked', false);
                            });
                            $(this).prop('checked', true);
                        } else if (checked > maxAllowed) {
                            $(this).prop('checked', false);
                            return;
                        }

                        masterData.summary.menu[0].addons = [];

                        $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}:checked').each(function(i, obj) {
                            masterData.summary.menu[0].addons.push({
                                "id": $(this).data('id'),
                                "name": $(this).data('name'),
                                "price": $(this).data('price').toString()
                            });
                            generateId += "-" + $(this).data('id');
                            generateTotalPrice += parseFloat($(this).data('price'));
                        });

                        masterData.id = generateId;
                        masterData.price = generateTotalPrice.toString();
                        masterData.summary.total_price = generateTotalPrice.toString();
                        $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data(masterData);

                        console.log($("#SingleMenuSubmit-{{ $SingleMenu->id }}").data());
                    });
                </script>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach ($Menu->MenuSize()->get() as $MenuSizeIDX => $MenuSize)
                <div id="SingleMenuSize-{{ $SingleMenu->id }}-{{ $MenuSize->id }}"
                    class="tab-pane fade @if ($MenuSizeIDX === 0) show in active @endif" style="    background: white;">
                    <form>
                        <!-- extras body -->
                        {{-- ->groupBy('addon_category_id') --}}
                        <div class="recepie-body">
                            @foreach ($MenuSize->GroupMenuAddon()->groupBy('addon_category_id')->get()
    as $GroupMenuAddonIDX => $GroupMenuAddon)
                                <h6 class="font-weight-bold mt-4">
                                    {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                    <span class="text-muted">
                                        ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }})
                                    </span>
                                </h6>

                                @foreach ($MenuSize->MenuAddon()->where(
            'addon_category_id',
            $GroupMenuAddon->AddonCategory()->get()->first()->id,
        )->get()
    as $MenuAddonIDX => $MenuAddon)
                                    <div class="custom-control custom-radio border-bottom py-2">
                                        <input type="checkbox"
                                            id="SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}"
                                            name=""
                                            class="custom-control-input SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }} SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-{{ $GroupMenuAddon->id }}"
                                            data-group_menu_addon_id="{{ $GroupMenuAddon->id }}"
                                            data-id="{{ $MenuAddon->id }}"
                                            data-name="{{ $MenuAddon->Addon()->get()->first()->name }}"
                                            data-price="{{ $MenuAddon->price }}"
                                            data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}"
                                            data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                        <label class="custom-control-label"
                                            for="SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}">
                                            {{ $MenuAddon->Addon()->get()->first()->name }}
                                            <span class="text-muted"> +{{ $MenuAddon->price }}
                                                {{ App\Models\GeneralSetting::first()->currency }}
                                            </span> </label>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </form>
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
            <button id="SingleMenuSubmit-{{ $SingleMenu->id }}" type="button"
                class="btn btn-primary btn-lg btn-block add-cart-btn" data-vendor="{{ $rest->id }}"
                data-id="{{ $Menu->id }}-{{ $defaultSize['ID'] }}" data-name="{{ ucwords($Menu->name) }}"
                data-summary='{
                        "category":"SINGLE",
                        "menu": [ { "id":{{ $Menu->id }}, "name":"{{ ucwords($Menu->name) }}", "price":"{{ $defaultSize['Price'] }}", "addons":[] } ],
                        "size": { "id":{{ $defaultSize['ID'] }}, "name": "{{ $defaultSize['Name'] }}", "price":"{{ $defaultSize['Price'] }}"},
                        "total_price": {{ $defaultSize['Price'] }}}' data-price="{{ $defaultSize['Price'] }}"
                data-quantity="1" data-image="{{ $Menu->image }}" data-dismiss="modal">
                Add To Cart
            </button>
        </div>
    </div>
</div>

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

    $("#SingleMenuSubmit-{{ $SingleMenu->id }}").myCart({

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
