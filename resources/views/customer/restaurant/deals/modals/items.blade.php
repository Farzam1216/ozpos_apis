@section('custom_modals')
   <div class="modal fade" id="DealsMenuItems-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" tabindex="-1" role="dialog" aria-labelledby="DealsMenuItemsModal-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" aria-hidden="true" style="z-index: 1060">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">{{ ucwords($DealsItems->name) }}</h5>
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
                              
                              
                              @include('customer.restaurant.deals.modals.addons')
                           
                           
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
                  <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">
                     Close
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
@append