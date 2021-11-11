@section('custom_modals')
   <div class="modal fade" id="DealsMenu-{{ $DealsMenu->id }}" tabindex="-1" role="dialog" aria-labelledby="DealsMenuModal-{{ $DealsMenu->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">{{ ucwords($DealsMenu->name) }}</h5>
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
                  
                  @include('customer.restaurant.deals.scripts.index')
                  
                  @foreach($DealsMenu->DealsItems()->get() as $DealsItemsIDX=>$DealsItems)
                     <div>
                        <div class="p-3 border-bottom menu-list">
                           
                           <span class="float-right">
                              <button id="DealsMenuItemsBtn-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#DealsMenuItems-{{ $DealsMenu->id }}-{{ $DealsItems->id }}">
                                 Browse
                              </button>
                           </span>
                           
                           @include('customer.restaurant.deals.modals.items')
                           
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
                  <button id="DealsMenuSubmit-{{ $DealsMenu->id }}" type="button" disabled class="btn btn-primary btn-lg btn-block add-cart-btn" data-vendor="{{ $rest->id }}" data-id="3-{{ $DealsMenu->id }}" data-name="{{ ucwords($DealsMenu->name) }}" data-summary='{
                           "category":"DEALS",
                           "menu_category":{ "id": {{ $DealsMenu->id }} },
                           "menu": [],
                           "size": null,
                           "total_price":0
                           }' data-price="{{ $DealsMenu->price }}" data-quantity="1" data-image="{{ $DealsMenu->image }}" data-required="{{ $DealsMenu->DealsItems()->count() }}" data-dismiss="modal">
                     Add To Cart
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
@append