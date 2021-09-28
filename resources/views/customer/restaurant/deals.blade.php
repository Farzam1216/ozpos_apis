<div>
   @foreach($MenuCategory->DealsMenu()->get() as $DealsMenuIDX=>$DealsMenu)
      <div class="p-3 border-bottom menu-list">
         <span class="float-right">
            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#Deals{{ $DealsMenu->id }}">Edit</button>
         </span>
         @section('custom_modals')
            <div class="modal fade" id="Deals{{ $DealsMenu->id }}" tabindex="-1" role="dialog" aria-labelledby="DealsModal{{ $DealsMenu->id }}" aria-hidden="true">
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
                              $defaultData = array(
                                  "Menu" => []
                              );
                           @endphp
                           @section('postScript')
                              <script type="text/javascript">
                                 $(".DealsMenuPick{{$DealsMenu->id}}").click(function () {
                                    let button = $("#CartAddDeals{{ $DealsMenu->id }}");
                                    let dataID = "3";
                                    let data = JSON.parse(JSON.stringify(button.data('summary')));
                                    let thisData = $(this).data();

                                    
                                    // if($(this).data('deal') in data.Deals)
                                    //    delete data.Deals[$(this).data('deal')];
                                    data.Deals[thisData.deals] = {};
                                    data.Deals[thisData.deals].ID = $(this).data('id');
                                    data.Deals[thisData.deals].DataID = $(this).data('id');
                                    data.Deals[thisData.deals].Name = $(this).data('name');
                                    data.Deals[thisData.deals].TotalAddonsPrice = 0;
                                    data.Deals[thisData.deals].Addons = [];

                                    $('.DealsMenuAddon-{{ $DealsMenu->id }}-'+$(this).data('deals')+'-'+$(this).data('menu')+':checked').each(function (i, obj) {
                                       data.Deals[thisData.deals].Addons.push({
                                          "ID": $(this).data('id'),
                                          "Name": $(this).data('name'),
                                          "Price": $(this).data('price')
                                       });
                                       data.Deals[thisData.deals].TotalAddonsPrice += $(this).data('price');
                                    });

                                    button.data('summary', data);

                                    $.each(data.Deals, function (key, deal) {
                                       dataID += "_"+deal.ID;

                                       $.each(deal.Addons, function (key, addon) {
                                          dataID += "-"+addon.ID;
                                       });
                                    });
               
                                    {{--button.data('price', data.MenuFirst.TotalPrice + data.MenuSecond.TotalPrice);--}}
                                    button.data('id', dataID);

                                    $('#DealsItemsBtn-{{ $DealsMenu->id }}-'+$(this).data('deals')).removeClass("btn-outline-secondary");
                                    $('#DealsItemsBtn-{{ $DealsMenu->id }}-'+$(this).data('deals')).addClass("btn-primary");
                                    $('#DealsItemsBtn-{{ $DealsMenu->id }}-'+$(this).data('deals')).html("Picked");

                                    console.log(button.data());
                                    console.log();
                                 });
                              </script>
                           @append
                           @foreach($DealsMenu->DealsItems()->get() as $DealsItemsIDX=>$DealsItems)
      
                              
                              
                              
                              
                              
                              <div>
                                 <div class="p-3 border-bottom menu-list">
                                    
                                    <span class="float-right">
                                       <button id="DealsItemsBtn-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#DealsItems-{{ $DealsMenu->id }}-{{ $DealsItems->id }}">Browse</button>
                                    </span>
                                    
                                    @section('custom_modals')
                                       <div class="modal fade" id="DealsItems-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" tabindex="-1" role="dialog" aria-labelledby="DealsItemsModal-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" aria-hidden="true" style="z-index: 1060">
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
                                                      @foreach($DealsItems->ItemCategory()->get()->first()->SingleMenuItemCategory()->get() as $SingleMenuItemCategoryIDX=>$SingleMenuItemCategory)
                                                         @php
                                                            $SingleMenu = $SingleMenuItemCategory->SingleMenu()->get()->first();
                                                            $Menu = $SingleMenu->Menu()->get()->first();
                                                            $MenuSize = $Menu->MenuSize()->where('item_size_id', $DealsItems->id )->get()->first();
                                                            $defaultData["Menu"][] = array(
                                                                "ID" => $Menu->id,
                                                                "DataID" => $Menu->id,
                                                                "Name" => ucwords($Menu->name),
                                                                "Size" => ($MenuSize === NULL)?null:ucwords($MenuSize->ItemSize()->get()->first()->name),
                                                                "Addons" => []
                                                            );
                                                         @endphp
      
                                                         <div>
                                                            <div class="p-3 border-bottom menu-list">
                                                               @if($MenuSize !== NULL && $MenuSize->MenuAddon()->get()->count() !== 0)
                                                                  <span class="float-right">
                                                                     <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#DealsMenuAddon-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}">Edit</button>
                                                                  </span>
   
   
                                                                  @section('custom_modals')
                                                                     <div class="modal fade" id="DealsMenuAddon-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}" tabindex="-1" role="dialog" aria-labelledby="DealsMenuModal-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}" aria-hidden="true" style="z-index: 1061">
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
                                                                                    <form>
                                                                                       <div class="recepie-body">
                                                                                          @foreach($MenuSize->GroupMenuAddon()->get() as $GroupMenuAddonIDX=>$GroupMenuAddon)
                                                                                             <h6 class="font-weight-bold mt-4">
                                                                                                {{ $GroupMenuAddon->AddonCategory()->get()->first()->name }}
                                                                                                <span class="text-muted"> ({{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}-{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}) </span>
                                                                                             </h6>
                              
                                                                                             @foreach($MenuSize->MenuAddon()->where('addon_category_id', $GroupMenuAddon->AddonCategory()->get()->first()->id)->get() as $MenuAddonIDX=>$MenuAddon)
                                                                                                <div class="custom-control custom-radio border-bottom py-2">
                                                                                                   <input type="checkbox" id="DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-{{ $MenuAddon->id }}" name="" class="custom-control-input Menu{{ $Menu->id }} MenuSize{{ $MenuSize->id }} DealsMenuAddon-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}" data-id="{{ $MenuAddon->id }}" data-name="{{ $MenuAddon->Addon()->get()->first()->name }}" data-price="{{ $MenuAddon->price }}" data-min="{{ $GroupMenuAddon->AddonCategory()->get()->first()->min }}" data-max="{{ $GroupMenuAddon->AddonCategory()->get()->first()->max }}">
                                                                                                   <label class="custom-control-label" for="DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-{{ $MenuAddon->id }}">
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
                                                                              <div class="modal-footer p-0 border-0">
                                                                                 <div class="col-6 m-0 p-0">
                                                                                    <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close
                                                                                    </button>
                                                                                 </div>
                                                                                 <div class="col-6 m-0 p-0">
                                                                                    <button data-dismiss="modal" id="DealsMenuAddon-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}" type="button" class="btn btn-primary btn-lg btn-block DealsMenuPick{{$DealsMenu->id}}" data-deals="{{$DealsItems->id}}" data-menu="{{$Menu->id}}" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}">
                                                                                       Pick
                                                                                    </button>
                                                                                    @section('postScript')
                                                                                       <script type="text/javascript">
                                                                                          $("#DealsMenuAddon-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}").click(function (){
                                                                                             $('#DealsItems-{{ $DealsMenu->id }}-{{ $DealsItems->id }}').modal('hide');
                                                                                          });
                                                                                       </script>
                                                                                    @append
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  @append
                                                                  
                                                                  
                                                               @elseif($MenuSize !== NULL && $MenuSize->MenuAddon()->get()->count() === 0)
                                                                     <span class="float-right">
                                                                        <button data-dismiss="modal" class="btn btn-primary btn-sm DealsMenuPick{{$DealsMenu->id}}" data-deals="{{$DealsItems->id}}" data-menu="{{$Menu->id}}" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}">
                                                                           Pick
                                                                        </button>
                                                                     </span>
                                                               @elseif($Menu->MenuAddon()->get()->count() != 0)
                                                               @else
                                                                  <span class="float-right">
                                                                     <button data-dismiss="modal" class="btn btn-primary btn-sm DealsMenuPick{{$DealsMenu->id}}" data-deals="{{$DealsItems->id}}" data-menu="{{$Menu->id}}" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}">
                                                                        Pick
                                                                     </button>
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
                                                         </div>
                                                      @endforeach
                                                   </div>
                                                </div>
                                                <div class="modal-footer p-0 border-0">
                                                   <div class="col-12 m-0 p-0">
                                                      <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close
                                                      </button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    @append
                                    
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
                           <button id="CartAddDeals{{ $DealsMenu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-id="3-{{ $DealsMenu->id }}" data-name="{{ ucwords($DealsMenu->name) }}" data-summary='{
                                                   "MenuCategory":"Deals",
                                                   "Menu": [],
                                                   "Deals": {},
                                                   "Size": null,
                                                   "TotalPrice":0
                                                   }' data-price="0" data-quantity="1" data-image="{{ $DealsMenu->image }}">
                              Add To Cart
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @append
         <div class="media">
            <img src="{{ $DealsMenu->image }}" alt="" class="mr-3 rounded-pill ">
            <div class="media-body">
               <h6 class="mb-1">{{ ucwords($DealsMenu->name) }}
                  <span class="badge badge-danger">Customizable</span>
               </h6>
               @if($DealsMenu->price !== NULL)
                  <p class="text-muted mb-0">{{ $DealsMenu->price }} {{ App\Models\GeneralSetting::first()->currency }}</p>
               @endif
            </div>
         </div>
      </div>
   @endforeach
</div>