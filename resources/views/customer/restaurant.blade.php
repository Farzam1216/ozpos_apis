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
                    @foreach($singleVendor['MenuCategory'] as $MenuCategoryIDX=>$MenuCategory)
                        <div class="row m-0">
                            <h6 class="p-3 m-0 bg-light w-100">{{ ucwords($MenuCategory->name) }}

                                @if($MenuCategory->type == 'SINGLE')
                                    <small class="text-black-50">{{ $MenuCategory->SingleMenu()->count() }} ITEM(S)</small>
                                @elseif($MenuCategory->type == 'HALF_N_HALF')
                                    <small class="text-black-50">{{ $MenuCategory->HalfNHalfMenu()->count() }} ITEM(S)</small>
                                @elseif($MenuCategory->type == 'DEALS')
                                    <small class="text-black-50">{{ $MenuCategory->DealsMenu()->count() }} ITEM(S)</small>
                                @endif
                            </h6>
                            <div class="col-md-12 px-0 border-top">
                                <div class="">

                                    @if($MenuCategory->type == 'SINGLE')
                                        @foreach($MenuCategory->SingleMenu()->get() as $SingleMenuIDX=>$SingleMenu)
                                            @foreach($SingleMenu->Menu()->get() as $MenuIDX=>$Menu)

                                                <div class="p-3 border-bottom menu-list">


                                                    @if($Menu->MenuSize()->get()->count() != 0)
                                                        <span class="float-right">
                                                            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#customization{{ $Menu->id }}">ADD</button>
                                                        </span>

                                                        @section('custom_modals')
                                                        <!-- extras modal -->
                                                            <div class="modal fade" id="customization{{ $Menu->id }}" tabindex="-1" role="dialog" aria-labelledby="customizationModal{{ $Menu->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Extras</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="container">
                                                                                <h6 class="font-weight-bold mt-4">Pick Size</h6>
                                                                                <ul class="nav nav-pills">
                                                                                    @foreach($Menu->MenuSize()->get() as $MenuSizeIDX=>$MenuSize)
                                                                                        @if( $MenuSizeIDX == 0 )
                                                                                            @php
                                                                                                $defaultSize = array( "ID"=>$MenuSize->id, "Name"=>$MenuSize->ItemSize()->get()->first()->name, "Price"=>$MenuSize->price );
                                                                                            @endphp
                                                                                        @endif
                                                                                        <li>
                                                                                            <a id="MenuSize{{ $MenuSize->id }}" class="btn btn-outline-primary btn-sm mb-3 mr-3 @if( $MenuSizeIDX == 0 ) active @endif" data-toggle="pill" href="#size{{ $MenuSize->id }}">
                                                                                                {{ $MenuSize->ItemSize()->get()->first()->name }} {{ $MenuSize->price }} {{ App\Models\GeneralSetting::first()->currency }}
                                                                                            </a>
                                                                                        </li>
                                                                                    @section('postScript')
                                                                                        <script type="text/javascript">
                                                                                            $( "#MenuSize{{ $MenuSize->id }}" ).click(function() {
                                                                                                var totalPrice = 0;
                                                                                                var data = JSON.parse(JSON.stringify(
                                                                                                    $( "#Menu{{ $Menu->id }}" ).data('summary')
                                                                                                ));
                                                                                                var dataID = "{{ $Menu->id }}-{{ $MenuSize->id }}";
                                                                                                console.log(data);

                                                                                                data.Size.ID = "{{ $MenuSize->id }}";
                                                                                                data.Size.Name = "{{ $MenuSize->ItemSize()->get()->first()->name }}";
                                                                                                data.Size.Price = "{{ $MenuSize->price }}";
                                                                                                totalPrice += {{ $MenuSize->price }};
                                                                                                data.Addons = []

                                                                                                $('.MenuSize{{ $MenuSize->id }}:checked').each(function(i, obj) {
                                                                                                    data.Addons.push({ "ID":$(this).data('id'), "Name":$(this).data('name'), "Price":$(this).data('price') });
                                                                                                    dataID += "-"+$(this).data('id');
                                                                                                    totalPrice += $(this).data('price');
                                                                                                });

                                                                                                data.TotalPrice = totalPrice;
                                                                                                $( "#Menu{{ $Menu->id }}" ).data('summary', data);
                                                                                                $( "#Menu{{ $Menu->id }}" ).data('id', dataID);

                                                                                                console.log($( "#Menu{{ $Menu->id }}" ).data('summary'));
                                                                                                console.log($( "#Menu{{ $Menu->id }}" ).data('id'));
                                                                                            });

                                                                                            $( ".MenuSize{{ $MenuSize->id }}" ).change(function() {
                                                                                                if($('.MenuSize{{ $MenuSize->id }}:checked').length > $(this).data('max'))
                                                                                                {
                                                                                                    $(this).prop('checked', false);
                                                                                                    return;
                                                                                                }

                                                                                                var totalPrice = 0;
                                                                                                var data = JSON.parse(JSON.stringify(
                                                                                                    $( "#Menu{{ $Menu->id }}" ).data('summary')
                                                                                                ));
                                                                                                var dataID = data.Menu.ID+"-"+data.Size.ID;

                                                                                                totalPrice += {{$MenuSize->price}};
                                                                                                data.Addons = []

                                                                                                $('.MenuSize{{ $MenuSize->id }}:checked').each(function(i, obj) {
                                                                                                    data.Addons.push({ "ID":$(this).data('id'), "Name":$(this).data('name'), "Price":$(this).data('price') });
                                                                                                    dataID += "-"+$(this).data('id');
                                                                                                    totalPrice += $(this).data('price');
                                                                                                });

                                                                                                data.TotalPrice = totalPrice;
                                                                                                $( "#Menu{{ $Menu->id }}" ).data('summary', data);
                                                                                                $( "#Menu{{ $Menu->id }}" ).data('id', dataID);

                                                                                                console.log($( "#Menu{{ $Menu->id }}" ).data('summary'));
                                                                                                console.log($( "#Menu{{ $Menu->id }}" ).data('id'));
                                                                                            });
                                                                                        </script>
                                                                                    @append
                                                                                    @endforeach
                                                                                </ul>

                                                                                <div class="tab-content">

                                                                                    @foreach($Menu->MenuSize()->get() as $MenuSizeIDX=>$MenuSize)
                                                                                        <div id="size{{ $MenuSize->id }}" class="tab-pane fade @if( $MenuSizeIDX == 0 ) show in active @endif">
                                                                                            <form>
                                                                                                <!-- extras body -->
                                                                                                <div class="recepie-body">

                                                                                                    @foreach($MenuSize->GroupMenuAddon()->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
                                                                                                        <h6 class="font-weight-bold mt-4">
                                                                                                            {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                                                                                            <span class="text-muted">
                                                                                                                            ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }})
                                                                                                                        </span>
                                                                                                        </h6>

                                                                                                        @foreach($MenuSize->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                                                                                            <div class="custom-control custom-radio border-bottom py-2">
                                                                                                                <input type="checkbox"
                                                                                                                       id="customCheckbox{{ $MenuAddon->id }}"
                                                                                                                       name="customCheckbox{{ $GroupMenuAddon->id }}"
                                                                                                                       class="custom-control-input Menu{{ $Menu->id }} MenuSize{{ $MenuSize->id }}"
                                                                                                                       data-id="{{ $MenuAddon->id }}"
                                                                                                                       data-name="{{ $MenuAddon->Addon()->get()->first()->name }}"
                                                                                                                       data-price="{{ $MenuAddon->price }}"
                                                                                                                       data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}"
                                                                                                                       data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                                                                                                <label class="custom-control-label" for="customCheckbox{{$MenuAddon->id}}">
                                                                                                                    {{ $MenuAddon->Addon()->get()->first()->name }}
                                                                                                                    <span class="text-muted">
                                                                                                                                    +{{ $MenuAddon->price }} {{ App\Models\GeneralSetting::first()->currency }}
                                                                                                                                </span>
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        @endforeach
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer p-0 border-0">
                                                                            <div class="col-6 m-0 p-0">
                                                                                <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                            <div class="col-6 m-0 p-0">
                                                                                <button id="Menu{{ $Menu->id }}"
                                                                                        type="button"
                                                                                        class="btn btn-primary btn-lg btn-block add-cart-btn"
                                                                                        data-id="{{ $Menu->id }}-{{ $defaultSize['ID'] }}"
                                                                                        data-name="{{ ucwords($Menu->name) }}"
                                                                                        data-summary='{
                                                                                                                    "Menu":{ "ID":"{{ $Menu->id }}-{{ $defaultSize['ID'] }}", "Name":"{{ ucwords($Menu->name) }}" },
                                                                                                                    "TotalPrice":{{ $defaultSize['Price'] }},
                                                                                                                    "Size":{ "ID":{{ $defaultSize['ID'] }}, "Name": "{{ $defaultSize['Name'] }}", "Price":{{ $defaultSize['Price'] }}},
                                                                                                                    "Addons":[ ]
                                                                                                                  }'
                                                                                        data-price="{{ $defaultSize['Price'] }}"
                                                                                        data-quantity="1"
                                                                                        data-image="{{ $Menu->image }}">
                                                                                    Apply
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @append
                                                    @elseif($Menu->MenuAddon()->get()->count() != 0)
                                                        <span class="float-right">
                                                            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#addons{{ $Menu->id }}">ADD</button>
                                                        </span>

                                                        @section('custom_modals')
                                                        <!-- extras modal -->
                                                            <div class="modal fade" id="addons{{ $Menu->id }}" tabindex="-1" role="dialog" aria-labelledby="addonsModal{{ $Menu->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Extras</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="container">
                                                                                @section('postScript')
                                                                                    <script type="text/javascript">
                                                                                        $( ".Menu{{ $Menu->id }}" ).change(function() {
                                                                                            if($('.MenuAddonCategory'+$(this).data('cat')+':checked').length > $(this).data('max'))
                                                                                            {
                                                                                                $(this).prop('checked', false);
                                                                                                return;
                                                                                            }

                                                                                            var totalPrice = 0;
                                                                                            var data = JSON.parse(JSON.stringify(
                                                                                                $( "#Menu{{ $Menu->id }}" ).data('summary')
                                                                                            ));
                                                                                            var dataID = data.Menu.ID;

                                                                                            totalPrice += {{ $Menu->price }};
                                                                                            data.Addons = []

                                                                                            $('.Menu{{ $Menu->id }}:checked').each(function(i, obj) {
                                                                                                data.Addons.push({ "ID":$(this).data('id'), "Name":$(this).data('name'), "Price":$(this).data('price') });
                                                                                                dataID += "-"+$(this).data('id');
                                                                                                totalPrice += $(this).data('price');
                                                                                            });

                                                                                            data.TotalPrice = totalPrice;
                                                                                            $( "#Menu{{ $Menu->id }}" ).data('summary', data);
                                                                                            $( "#Menu{{ $Menu->id }}" ).data('id', dataID);

                                                                                            console.log($( "#Menu{{ $Menu->id }}" ).data('summary'));
                                                                                            console.log($( "#Menu{{ $Menu->id }}" ).data('id'));
                                                                                        });
                                                                                    </script>
                                                                                @append
                                                                                <div class="tab-content">
                                                                                    <form>
                                                                                        <!-- extras body -->
                                                                                        <div class="recepie-body">

                                                                                            @foreach($Menu->GroupMenuAddon()->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
                                                                                                <h6 class="font-weight-bold mt-4">
                                                                                                    {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                                                                                    <span class="text-muted">
                                                                                                        ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }})
                                                                                                    </span>
                                                                                                </h6>

                                                                                                @foreach($Menu->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                                                                                    <div class="custom-control custom-radio border-bottom py-2">
                                                                                                        <input type="checkbox"
                                                                                                               id="customCheckbox{{ $MenuAddon->id }}"
                                                                                                               name="customCheckbox{{ $GroupMenuAddon->id }}"
                                                                                                               class="custom-control-input Menu{{ $Menu->id }} MenuAddonCategory{{ $GroupMenuAddon->id }}"
                                                                                                               data-cat="{{ $GroupMenuAddon->id }}"
                                                                                                               data-id="{{ $MenuAddon->id }}"
                                                                                                               data-name="{{ $MenuAddon->Addon()->get()->first()->name }}"
                                                                                                               data-price="{{ $MenuAddon->price }}"
                                                                                                               data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}"
                                                                                                               data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                                                                                        <label class="custom-control-label" for="customCheckbox{{$MenuAddon->id}}">
                                                                                                            {{ $MenuAddon->Addon()->get()->first()->name }}
                                                                                                            <span class="text-muted">
                                                                                                                                    +{{ $MenuAddon->price }} {{ App\Models\GeneralSetting::first()->currency }}
                                                                                                                                </span>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer p-0 border-0">
                                                                            <div class="col-6 m-0 p-0">
                                                                                <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                            <div class="col-6 m-0 p-0">
                                                                                <button id="Menu{{ $Menu->id }}"
                                                                                        type="button"
                                                                                        class="btn btn-primary btn-lg btn-block add-cart-btn"
                                                                                        data-id="{{ $Menu->id }}"
                                                                                        data-name="{{ ucwords($Menu->name) }}"
                                                                                        data-summary='{
                                                                                                        "Menu":{ "ID":"{{ $Menu->id }}", "Name":"{{ ucwords($Menu->name) }}" },
                                                                                                        "TotalPrice":{{ $Menu->price }},
                                                                                                        "Size":null,
                                                                                                        "Addons":[ ]
                                                                                                       }'
                                                                                        data-price="{{ $Menu->price }}"
                                                                                        data-quantity="1"
                                                                                        data-image="{{ $Menu->image }}">
                                                                                    Apply
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @append
                                                    @else
                                                        <span class="float-right">
                                                            <button class="btn btn-outline-secondary btn-sm add-cart-btn" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}" data-summary="summary 2" data-price="{{ $Menu->price }}" data-quantity="1" data-image="{{ $Menu->image }}">ADD</button>
                                                        </span>
                                                    @endif

                                                    <div class="media">
                                                        <img src="{{ $Menu->image }}" alt="askbootstrap" class="mr-3 rounded-pill ">
                                                        <div class="media-body">
                                                            <h6 class="mb-1">{{ ucwords($Menu->name) }}
                                                                @if($Menu->price == NULL)
                                                                    <span class="badge badge-danger">Customizable</span>
                                                                @endif
                                                            </h6>

                                                            @if($Menu->price != NULL)

                                                                <p class="text-muted mb-0">{{ $Menu->price }} {{ App\Models\GeneralSetting::first()->currency }}</p>

                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        @endforeach
                                    @elseif($MenuCategory->type == 'HALF_N_HALF')
                                    @elseif($MenuCategory->type == 'DEALS')
                                    @endif





{{--                                    @foreach($menu->submenu as $idx2=>$submenu)--}}

{{--                                        <div class="p-3 border-bottom menu-list">--}}

{{--                                            @if(count($submenu->custimization) == 0)--}}
{{--                                                <span class="float-right">--}}
{{--                                                    <button class="btn btn-outline-secondary btn-sm add-cart-btn" data-id="{{ $submenu->id }}" data-name="{{ ucwords($submenu->name) }}" data-summary="summary 2" data-price="{{ $submenu->price }}" data-quantity="1" data-image="{{ $submenu->image }}">ADD</button>--}}
{{--                                                </span>--}}
{{--                                            @else--}}
{{--                                                <span class="float-right">--}}
{{--                                                    <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#customization{{ $submenu->id }}">ADD</button>--}}
{{--                                                </span>--}}


{{--                                                @section('custom_modals')--}}
{{--                                                    <!-- extras modal -->--}}
{{--                                                    <div class="modal fade" id="customization{{ $submenu->id }}" tabindex="-1" role="dialog" aria-labelledby="customizationModal{{ $submenu->id }}" aria-hidden="true">--}}
{{--                                                        <div class="modal-dialog modal-dialog-centered">--}}
{{--                                                            <div class="modal-content">--}}
{{--                                                                <div class="modal-header">--}}
{{--                                                                    <h5 class="modal-title">Extras</h5>--}}
{{--                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                                        <span aria-hidden="true">&times;</span>--}}
{{--                                                                    </button>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="modal-body">--}}
{{--                                                                    <form>--}}
{{--                                                                        <!-- extras body -->--}}
{{--                                                                        <div class="recepie-body">--}}
{{--                                                                            <div class="custom-control custom-radio border-bottom py-2">--}}
{{--                                                                                <input type="radio" id="customRadio1f" name="location" class="custom-control-input" checked>--}}
{{--                                                                                <label class="custom-control-label" for="customRadio1f">Tuna <span class="text-muted">+$35.00</span></label>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="custom-control custom-radio border-bottom py-2">--}}
{{--                                                                                <input type="radio" id="customRadio2f" name="location" class="custom-control-input">--}}
{{--                                                                                <label class="custom-control-label" for="customRadio2f">Salmon <span class="text-muted">+$20.00</span></label>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="custom-control custom-radio border-bottom py-2">--}}
{{--                                                                                <input type="radio" id="customRadio3f" name="location" class="custom-control-input">--}}
{{--                                                                                <label class="custom-control-label" for="customRadio3f">Wasabi <span class="text-muted">+$25.00</span></label>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="custom-control custom-radio border-bottom py-2">--}}
{{--                                                                                <input type="radio" id="customRadio4f" name="location" class="custom-control-input">--}}
{{--                                                                                <label class="custom-control-label" for="customRadio4f">Unagi  <span class="text-muted">+$10.00</span></label>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="custom-control custom-radio border-bottom py-2">--}}
{{--                                                                                <input type="radio" id="customRadio5f" name="location" class="custom-control-input">--}}
{{--                                                                                <label class="custom-control-label" for="customRadio5f">Vegetables  <span class="text-muted">+$5.00</span></label>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="custom-control custom-radio border-bottom py-2">--}}
{{--                                                                                <input type="radio" id="customRadio6f" name="location" class="custom-control-input">--}}
{{--                                                                                <label class="custom-control-label" for="customRadio6f">Noodles  <span class="text-muted">+$30.00</span></label>--}}
{{--                                                                            </div>--}}
{{--                                                                            <h6 class="font-weight-bold mt-4">QUANTITY</h6>--}}
{{--                                                                            <div class="d-flex align-items-center">--}}
{{--                                                                                <p class="m-0">1 Item</p>--}}
{{--                                                                                <div class="ml-auto">--}}
{{--                                                                                    <span class="count-number"><button type="button" class="btn-sm left dec btn btn-outline-secondary"> <i class="feather-minus"></i> </button><input class="count-number-input" type="text" readonly="" value="1"><button type="button" class="btn-sm right inc btn btn-outline-secondary"> <i class="feather-plus"></i> </button></span>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </form>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="modal-footer p-0 border-0">--}}
{{--                                                                    <div class="col-6 m-0 p-0">--}}
{{--                                                                        <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close</button>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="col-6 m-0 p-0">--}}
{{--                                                                        <button type="button" class="btn btn-primary btn-lg btn-block">Apply</button>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endsection--}}


{{--                                            @endif--}}

{{--                                            <div class="media">--}}
{{--                                                <img alt="#" src="{{ $submenu->image }}" alt="askbootstrap" class="mr-3 rounded-pill ">--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6 class="mb-1">{{ ucwords($submenu->name) }}--}}
{{--                                                        <span class="badge badge-success">Veg</span>--}}
{{--                                                        <span class="badge badge-danger">Non Veg</span>--}}
{{--                                                        @if(count($submenu->custimization) == 1)--}}
{{--                                                            <span class="badge badge-danger">Customizable</span>--}}
{{--                                                        @endif--}}
{{--                                                    </h6>--}}
{{--                                                    <p class="text-muted mb-0">{{ $submenu->price }} {{ App\Models\GeneralSetting::first()->currency }}</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    @endforeach--}}

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

@append
