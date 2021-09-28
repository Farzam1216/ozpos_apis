
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
                  @include('customer.restaurant.single.scripts.addons')
                  <div class="tab-content">
                     <form>
                        <!-- extras body -->
                        <div class="recepie-body">
                           @foreach($Menu->GroupMenuAddon()->groupBy('addon_category_id')->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
                              <h6 class="font-weight-bold mt-4">
                                 {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                 <span class="text-muted"> ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}) </span>
                              </h6>
                              
                              @foreach($Menu->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                 <div class="custom-control custom-radio border-bottom py-2">
                                    <input type="checkbox" id="SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}" name="" class="custom-control-input SingleMenuCheckbox-{{ $SingleMenu->id }} SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $GroupMenuAddon->id }}" data-group_menu_addon_id="{{ $GroupMenuAddon->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                    <label class="custom-control-label" for="SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $GroupMenuAddon->id }}-{{ $MenuAddon->id }}">
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
                  <button id="SingleMenuSubmit-{{ $SingleMenu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}" data-summary='{
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