<div>
   @foreach($MenuCategory->HalfNHalfMenu()->get() as $HalfNHalfMenuIDX=>$HalfNHalfMenu)
      <div class="p-3 border-bottom menu-list">
         <span class="float-right">
            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#Half{{ $HalfNHalfMenu->id }}">ADD</button>
         </span>
         @section('custom_modals')
            <div class="modal fade" id="Half{{ $HalfNHalfMenu->id }}" tabindex="-1" role="dialog" aria-labelledby="HalfModal{{ $HalfNHalfMenu->id }}" aria-hidden="true">
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
                           @php
                              $ItemSizeObj = App\Models\ItemSize::where('vendor_id', $HalfNHalfMenu->vendor_id)->get()
                           @endphp
                           <h6 class="font-weight-bold mt-4">Pick Size</h6>
                           <ul class="nav nav-pills">
                              <li>
                                 @foreach($ItemSizeObj as $ItemSizeIDX=>$ItemSize)
                                 
{{--                                 @section('postScript')--}}
{{--                                    <script type="text/javascript">--}}
{{--                                        $("#HalfSize{{ $ItemSize->id }}").click(function () {--}}
{{--                                            var button = $("#CartAddHalf{{ $HalfNHalfMenu->id }}");--}}
{{--                                            var data = JSON.parse(JSON.stringify(button.data('summary')));--}}

{{--                                            console.log(data);--}}
{{--                                            data.Size.ID = {{ $ItemSize->id }};--}}
{{--                                            data.Size.Name = "{{ $ItemSize->name }}";--}}

{{--                                            button.data('summary', data);--}}

{{--                                            console.log(button.data('summary'));--}}
{{--                                        });--}}
{{--                                    </script>--}}
{{--                                 @append--}}
                                 <a id="HalfSize{{ $ItemSize->id }}" class="btn btn-outline-primary btn-sm mb-3 mr-3 @if($ItemSizeIDX == 0) active @endif " data-toggle="pill" href="#HalfSize{{ $ItemSize->id }}">
                                    {{ $ItemSize->name }}
                                 </a>
                                 @endforeach
                              </li>
                           </ul>
                           <div class="tab-content">
                              @foreach($ItemSizeObj as $ItemSizeIDX=>$ItemSize)
                                 <div id="HalfSize{{ $ItemSize->id }}" class="tab-pane fade @if($ItemSizeIDX == 0) show in active @endif ">
                                    <h6 class="font-weight-bold mt-4">
                                       Pick Side</h6>
                                    <ul class="nav nav-pills">
                                       <li>
                                          <a id="" class="btn btn-outline-primary btn-sm mb-3 mr-3 active" data-toggle="pill" href="#HalfFirst{{ $HalfNHalfMenu->id }}"> First Half </a>
                                          <a id="" class="btn btn-outline-primary btn-sm mb-3 mr-3" data-toggle="pill" href="#HalfSecond{{ $HalfNHalfMenu->id }}"> Second Half </a>
                                       </li>
                                    </ul>
                                    <div class="tab-content">
                                       <div id="HalfFirst{{ $HalfNHalfMenu->id }}" class="tab-pane fade show in active">
                                          @foreach($HalfNHalfMenu->ItemCategory()->get()->first()->SingleMenuItemCategory()->get() as $SingleMenuItemCategoryIDX=>$SingleMenuItemCategory)
                                             
                                             @php
                                                $SingleMenu = $SingleMenuItemCategory->SingleMenu()->get()->first();
                                                $Menu = $SingleMenu->Menu()->get()->first();
                                                $MenuSize = $Menu->MenuSize()->where('item_size_id', $ItemSize->id )->get()->first();
                                                $Menu = App\Models\Menu::where('id', $MenuSize->menu_id )->get()->first();
                                             @endphp
                                             <div>
                                                <div class="p-3 border-bottom menu-list">
                                                   
                                                   <span class="float-right">
                                                      <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#HalfFirstAddon{{ $Menu->id }}">ADD</button>
                                                   </span>
                                                   
                                                   @section('custom_modals')
                                                      <div class="modal fade" id="HalfFirstAddon{{ $Menu->id }}" tabindex="-1" role="dialog" aria-labelledby="HalfFirstAddonModal{{ $Menu->id }}" aria-hidden="true" style="z-index: 1060">
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
                                                                            $("#HalfFirstMenu{{ $Menu->id }}").click(function () {
                                                                                var button = $("#CartAddHalf{{ $HalfNHalfMenu->id }}");
                                                                                var totalPrice = 0;
                                                                                var data = JSON.parse(JSON.stringify(button.data('summary')));

                                                                                data.Size.ID = {{ $ItemSize->id }};
                                                                                data.Size.Name = "{{ $ItemSize->name }}";

                                                                                button.data('summary', data);

                                                                                
                                                                                var totalPrice = 0;
                                                                                var dataID = "{{ $Menu->id }}-{{ $MenuSize->id }}";
                                                                                console.log(data);

                                                                                data.MenuFirst.ID = "{{ $Menu->id }}";
                                                                                data.MenuFirst.Name = "{{ ucwords($Menu->name) }}";
                                                                                data.MenuFirst.Price = "{{ $MenuSize->price }}";
                                                                                totalPrice += {{ $MenuSize->price }};
                                                                                data.MenuFirst.Addons = []

                                                                                $('.HalfFirstMenuSize{{ $MenuSize->id }}:checked').each(function (i, obj) {
                                                                                    data.MenuFirst.Addons.push({
                                                                                        "ID": $(this).data('id'),
                                                                                        "Name": $(this).data('name'),
                                                                                        "Price": $(this).data('price')
                                                                                    });
                                                                                    // dataID += "-" + $(this).data('id');
                                                                                    totalPrice += $(this).data('price');
                                                                                });

                                                                                data.TotalPrice = totalPrice;
                                                                                $("#Menu{{ $Menu->id }}").data('summary', data);
                                                                                $("#Menu{{ $Menu->id }}").data('id', dataID);

                                                                                console.log($("#Menu{{ $Menu->id }}").data('summary'));
                                                                                console.log($("#Menu{{ $Menu->id }}").data('id'));
                                                                            });
                                                                        </script>
                                                                     @append
                                                                     <form>
                                                                        <div class="recepie-body">
                                                                           @foreach($MenuSize->GroupMenuAddon()->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
                                                                              <h6 class="font-weight-bold mt-4">
                                                                                 {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                                                                 <span class="text-muted"> ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}) </span>
                                                                              </h6>
                                                                              
                                                                              @foreach($MenuSize->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                                                                 <div class="custom-control custom-radio border-bottom py-2">
                                                                                    <input type="checkbox" id="HalfFirstCheckbox{{ $MenuAddon->id }}" name="HalfFirstCheckbox{{ $GroupMenuAddon->id }}" class="custom-control-input HalfFirstMenu{{ $Menu->id }} HalfFirstMenuSize{{ $MenuSize->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                                                                    <label class="custom-control-label" for="HalfFirstCheckbox{{$MenuAddon->id}}">
                                                                                       {{ $MenuAddon->Addon()->get()->first()->name }}
                                                                                       <span class="text-muted"> +{{ $MenuAddon->price }} {{ App\Models\GeneralSetting::first()->currency }}
                                                                                       </span> </label>
                                                                                 </div>
                                                                              @endforeach
                                                                           @endforeach
                                                                        </div>
                                                                     </form>
                                                                  </div>
                                                               </div>
                                                               <div class="modal-footer p-0 border-0">
                                                                  <div class="col-12 m-0 p-0">
                                                                     <button id="HalfFirstMenu{{ $Menu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-dismiss="modal">
                                                                        Apply
                                                                     </button>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   @append
                                                   
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
                                             </div>
                                          @endforeach
                                       </div>
                                       <div id="HalfSecond{{ $HalfNHalfMenu->id }}" class="tab-pane fade"></div>
                                    </div>
                                 </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer p-0 border-0">
                        <div class="col-6 m-0 p-0">
                           <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close
                           </button>
                        </div>
                        <div class="col-6 m-0 p-0">
                           <button id="CartAddHalf{{ $HalfNHalfMenu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-id="2-{{ $HalfNHalfMenu->id }}" data-name="{{ ucwords($HalfNHalfMenu->name) }}" data-summary='{
                                                   "MenuCategory":"HalfNHalf",
                                                   "MenuFirst": {
                                                            "ID": "{{ $HalfNHalfMenu->id }}-{{ $defaultSize['ID'] }}",
                                                            "Name": "{{ ucwords($Menu->name) }}",
                                                            "Price": {{ $defaultSize['Price'] }},
                                                            "Addons":[ {"ID":0, "Name":"", "Price":0} ]
                                                            },
                                                   "MenuSecond": {
                                                            "ID": "{{ $HalfNHalfMenu->id }}-{{ $defaultSize['ID'] }}",
                                                            "Name": "{{ ucwords($Menu->name) }}",
                                                            "Price": {{ $defaultSize['Price'] }},
                                                            "Addons":[ {"ID":0, "Name":"", "Price":0} ]
                                                            },
                                                   "Size": {
                                                            "ID": 0,
                                                            "Name": "{{ ucwords($Menu->name) }}"
                                                            },
                                                   "TotalPrice": {{ $defaultSize['Price'] }}}' data-price="0" data-quantity="1" data-image="{{ $HalfNHalfMenu->image }}">
                              Add To Cart
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @append
         <div class="media">
            <img src="{{ $HalfNHalfMenu->image }}" alt="askbootstrap" class="mr-3 rounded-pill ">
            <div class="media-body">
               <h6 class="mb-1">{{ ucwords($HalfNHalfMenu->name) }}
                  <span class="badge badge-danger">Customizable</span>
               </h6>
            </div>
         </div>
      </div>
   @endforeach
</div>