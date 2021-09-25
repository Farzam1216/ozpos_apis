<div>
   @foreach($MenuCategory->SingleMenu()->get() as $SingleMenuIDX=>$SingleMenu)
      @foreach($SingleMenu->Menu()->get() as $MenuIDX=>$Menu)
         
         <div class="p-3 border-bottom menu-list">
            @if($Menu->MenuSize()->get()->count() != 0)
               <span class="float-right">
                  <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#customization{{ $Menu->id }}">Edit</button>
               </span>
            
            @section('custom_modals')
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
                                        $("#MenuSize{{ $MenuSize->id }}").click(function () {
                                            var totalPrice = 0;
                                            var data = JSON.parse(JSON.stringify(
                                                $("#Menu{{ $Menu->id }}").data('summary')
                                            ));
                                            var dataID = "{{ $Menu->id }}-{{ $MenuSize->id }}";
                                            console.log(data);

                                            data.Size.ID = "{{ $MenuSize->id }}";
                                            data.Size.Name = "{{ $MenuSize->ItemSize()->get()->first()->name }}";
                                            data.Size.Price = "{{ $MenuSize->price }}";
                                            totalPrice += {{ $MenuSize->price }};
                                            data.Addons = []

                                            $('.MenuSize{{ $MenuSize->id }}:checked').each(function (i, obj) {
                                                data.Addons.push({
                                                    "ID": $(this).data('id'),
                                                    "Name": $(this).data('name'),
                                                    "Price": $(this).data('price')
                                                });
                                                dataID += "-" + $(this).data('id');
                                                totalPrice += $(this).data('price');
                                            });

                                            data.TotalPrice = totalPrice;
                                            $("#Menu{{ $Menu->id }}").data('summary', data);
                                            $("#Menu{{ $Menu->id }}").data('id', dataID);

                                            console.log($("#Menu{{ $Menu->id }}").data('summary'));
                                            console.log($("#Menu{{ $Menu->id }}").data('id'));
                                        });

                                        $(".MenuSize{{ $MenuSize->id }}").change(function () {
                                            if ($('.MenuSize{{ $MenuSize->id }}:checked').length > $(this).data('max')) {
                                                $(this).prop('checked', false);
                                                return;
                                            }

                                            var totalPrice = 0;
                                            var data = JSON.parse(JSON.stringify(
                                                $("#Menu{{ $Menu->id }}").data('summary')
                                            ));
                                            var dataID = data.Menu.ID + "-" + data.Size.ID;

                                            totalPrice += {{$MenuSize->price}};
                                            data.Addons = []

                                            $('.MenuSize{{ $MenuSize->id }}:checked').each(function (i, obj) {
                                                data.Addons.push({
                                                    "ID": $(this).data('id'),
                                                    "Name": $(this).data('name'),
                                                    "Price": $(this).data('price')
                                                });
                                                dataID += "-" + $(this).data('id');
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
                                                   <span class="text-muted"> ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}) </span>
                                                </h6>
                                                
                                                @foreach($MenuSize->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                                   <div class="custom-control custom-radio border-bottom py-2">
                                                      <input type="checkbox" id="customCheckbox{{ $MenuAddon->id }}" name="customCheckbox{{ $GroupMenuAddon->id }}" class="custom-control-input Menu{{ $Menu->id }} MenuSize{{ $MenuSize->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                                      <label class="custom-control-label" for="customCheckbox{{$MenuAddon->id}}">
                                                         {{ $MenuAddon->Addon()->get()->first()->name }}
                                                         <span class="text-muted"> +{{ $MenuAddon->price }} {{ App\Models\GeneralSetting::first()->currency }}
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
                        </div>
                        <div class="modal-footer p-0 border-0">
                           <div class="col-6 m-0 p-0">
                              <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close
                              </button>
                           </div>
                           <div class="col-6 m-0 p-0">
                              <button id="Menu{{ $Menu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-id="{{ $Menu->id }}-{{ $defaultSize['ID'] }}" data-name="{{ ucwords($Menu->name) }}" data-summary='{
                                                                                                                        "Menu":{ "ID":"{{ $Menu->id }}-{{ $defaultSize['ID'] }}", "Name":"{{ ucwords($Menu->name) }}" },
                                                                                                                        "TotalPrice":{{ $defaultSize['Price'] }},
                                                                                                                        "Size":{ "ID":{{ $defaultSize['ID'] }}, "Name": "{{ $defaultSize['Name'] }}", "Price":{{ $defaultSize['Price'] }}},
                                                                                                                        "Addons":[ ]
                                                                                                                      }' data-price="{{ $defaultSize['Price'] }}" data-quantity="1" data-image="{{ $Menu->image }}">
                                 Add To Cart
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            @append
            @elseif($Menu->MenuAddon()->get()->count() != 0)
               <span class="float-right">
                  <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#addons{{ $Menu->id }}">Edit</button>
               </span>
            
            @section('custom_modals')
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
                                     $(".Menu{{ $Menu->id }}").change(function () {
                                         if ($('.MenuAddonCategory' + $(this).data('cat') + ':checked').length > $(this).data('max')) {
                                             $(this).prop('checked', false);
                                             return;
                                         }

                                         var totalPrice = 0;
                                         var data = JSON.parse(JSON.stringify(
                                             $("#Menu{{ $Menu->id }}").data('summary')
                                         ));
                                         var dataID = data.Menu.ID;

                                         totalPrice += {{ $Menu->price }};
                                         data.Addons = []

                                         $('.Menu{{ $Menu->id }}:checked').each(function (i, obj) {
                                             data.Addons.push({
                                                 "ID": $(this).data('id'),
                                                 "Name": $(this).data('name'),
                                                 "Price": $(this).data('price')
                                             });
                                             dataID += "-" + $(this).data('id');
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
                              <div class="tab-content">
                                 <form>
                                    <!-- extras body -->
                                    <div class="recepie-body">
                                       @foreach($Menu->GroupMenuAddon()->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
                                          <h6 class="font-weight-bold mt-4">
                                             {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                             <span class="text-muted"> ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}) </span>
                                          </h6>
                                          
                                          @foreach($Menu->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                             <div class="custom-control custom-radio border-bottom py-2">
                                                <input type="checkbox" id="customCheckbox{{ $MenuAddon->id }}" name="customCheckbox{{ $GroupMenuAddon->id }}" class="custom-control-input Menu{{ $Menu->id }} MenuAddonCategory{{ $GroupMenuAddon->id }}" data-cat="{{ $GroupMenuAddon->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                                <label class="custom-control-label" for="customCheckbox{{$MenuAddon->id}}">
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
                        </div>
                        <div class="modal-footer p-0 border-0">
                           <div class="col-6 m-0 p-0">
                              <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close
                              </button>
                           </div>
                           <div class="col-6 m-0 p-0">
                              <button id="Menu{{ $Menu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}" data-summary='{
                                                                                                            "Menu":{ "ID":"{{ $Menu->id }}", "Name":"{{ ucwords($Menu->name) }}" },
                                                                                                            "TotalPrice":{{ $Menu->price }},
                                                                                                            "Size":null,
                                                                                                            "Addons":[ ]
                                                                                                           }' data-price="{{ $Menu->price }}" data-quantity="1" data-image="{{ $Menu->image }}">
                                 Add To Cart
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            @append
            @else
               <span class="float-right">
                  <button class="btn btn-primary btn-sm add-cart-btn" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}" data-summary="summary 2" data-price="{{ $Menu->price }}" data-quantity="1" data-image="{{ $Menu->image }}">Add</button>
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
</div>