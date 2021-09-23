<div>
   @foreach($MenuCategory->HalfNHalfMenu()->get() as $HalfNHalfMenuIDX=>$HalfNHalfMenu)
      <div class="p-3 border-bottom menu-list">
         <span class="float-right">
            <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#half{{ $HalfNHalfMenu->id }}">ADD</button>
         </span>
         @section('custom_modals')
            <div class="modal fade" id="half{{ $HalfNHalfMenu->id }}" tabindex="-1" role="dialog" aria-labelledby="halfModal{{ $HalfNHalfMenu->id }}" aria-hidden="true">
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
                                    <a id="" class="btn btn-outline-primary btn-sm mb-3 mr-3 @if($ItemSizeIDX == 0) active @endif " data-toggle="pill" href="#HalfSize{{ $ItemSize->id }}">
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
                                          <a id="" class="btn btn-outline-primary btn-sm mb-3 mr-3 active" data-toggle="pill" href="#FirstHalf{{ $HalfNHalfMenu->id }}"> First Half </a>
                                          <a id="" class="btn btn-outline-primary btn-sm mb-3 mr-3" data-toggle="pill" href="#SecondHalf{{ $HalfNHalfMenu->id }}"> Second Half </a>
                                       </li>
                                    </ul>
                                    <div class="tab-content">
                                       <div id="FirstHalf{{ $HalfNHalfMenu->id }}" class="tab-pane fade show in active">
                                          @foreach($HalfNHalfMenu->ItemCategory()->get()->first()->SingleMenuItemCategory()->get() as $SingleMenuItemCategoryIDX=>$SingleMenuItemCategory)
                                             
                                             @php
                                                $SingleMenu = $SingleMenuItemCategory->SingleMenu()->get()->first();
                                                $Menu = $SingleMenu->Menu()->get()->first();
                                                $MenuSize = $Menu->MenuSize()->where('item_size_id', $ItemSize->id )->get()->first();
                                                $Menu = App\Models\Menu::where('id', $MenuSize->menu_id )->get()->first();
                                             @endphp
                                             <div>
                                                <div class="p-3 border-bottom menu-list">
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
                                       <div id="SecondHalf{{ $HalfNHalfMenu->id }}" class="tab-pane fade"></div>
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
                           <button id="CartAddHalf{{ $HalfNHalfMenu->id }}" type="button" class="btn btn-primary btn-lg btn-block add-cart-btn" data-id="{{ $HalfNHalfMenu->id }}" data-name="{{ ucwords($HalfNHalfMenu->name) }}" data-summary='{
{{--                                                                                                    "Menu":{ "ID":"{{ $Menu->id }}-{{ $defaultSize['ID'] }}", "Name":"{{ ucwords($Menu->name) }}" },--}}{{--                                                                                                    "TotalPrice":{{ $defaultSize['Price'] }},--}}{{--                                                                                                    "Size":{ "ID":{{ $defaultSize['ID'] }}, "Name": "{{ $defaultSize['Name'] }}", "Price":{{ $defaultSize['Price'] }}},--}}{{--                                                                                                    "Addons":[ ]--}}}' data-price="0" data-quantity="1" data-image="{{ $HalfNHalfMenu->image }}">
                              Apply
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