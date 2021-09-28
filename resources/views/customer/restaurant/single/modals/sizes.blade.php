@section('custom_modals')
   <div class="modal fade" id="SingleMenu-{{ $SingleMenu->id }}" tabindex="-1" role="dialog" aria-labelledby="SingleMenuModal-{{ $SingleMenu->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">{{ ucwords($Menu->name) }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="container">
                  <h6 class="font-weight-bold mt-4">Pick Size</h6>
                  <ul class="nav nav-pills">
                     @foreach($Menu->MenuSize()->get() as $MenuSizeIDX=>$MenuSize)
                        @if( $MenuSizeIDX === 0 )
                           @php
                              /** @var mixed $MenuSize */
                              $defaultSize = array( "ID"=>$MenuSize->id, "Name"=>$MenuSize->ItemSize()->get()->first()->name, "Price"=>$MenuSize->price );
                           @endphp
                        @endif
                        <li>
                           <a id="SingleMenuSizeBtn-{{ $SingleMenu->id }}-{{ $MenuSize->id }}" class="btn btn-outline-primary btn-sm mb-3 mr-3 @if( $MenuSizeIDX === 0 ) active @endif" data-toggle="pill" href="#SingleMenuSize-{{ $SingleMenu->id }}-{{ $MenuSize->id }}">
                              {{ $MenuSize->ItemSize()->get()->first()->name }} {{ $MenuSize->price }} {{ App\Models\GeneralSetting::first()->currency }}
                           </a>
                        </li>
                        @include('customer.restaurant.single.scripts.sizes')
                     @endforeach
                  </ul>
                  <div class="tab-content">
                     @foreach($Menu->MenuSize()->get() as $MenuSizeIDX=>$MenuSize)
                        <div id="SingleMenuSize-{{ $SingleMenu->id }}-{{ $MenuSize->id }}" class="tab-pane fade @if( $MenuSizeIDX === 0 ) show in active @endif">
                           <form>
                              <!-- extras body -->
                              <div class="recepie-body">
                                 @foreach($MenuSize->GroupMenuAddon()->groupBy('addon_category_id')->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
                                    <h6 class="font-weight-bold mt-4">
                                       {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                       <span class="text-muted"> ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}) </span>
                                    </h6>
                                    
                                    @foreach($MenuSize->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                       <div class="custom-control custom-radio border-bottom py-2">
                                          <input type="checkbox" id="SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}" name="" class="custom-control-input SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }} SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-{{ $GroupMenuAddon->id }}" data-group_menu_addon_id="{{ $GroupMenuAddon->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                          <label class="custom-control-label" for="SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}">
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
                  <button id="SingleMenuSubmit-{{ $SingleMenu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-id="{{ $Menu->id }}-{{ $defaultSize['ID'] }}" data-name="{{ ucwords($Menu->name) }}" data-summary='{
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