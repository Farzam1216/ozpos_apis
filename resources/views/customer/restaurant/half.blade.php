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
                                    <a id="HalfSizeBtn-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}" class="btn btn-outline-primary btn-sm mb-3 mr-3 @if($ItemSizeIDX == 0) active @endif " data-toggle="pill" href="#HalfSize-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}">
                                       {{ $ItemSize->name }}
                                    </a>
                                 @endforeach
                              </li>
                           </ul>
                           <div class="tab-content">
                              @foreach($ItemSizeObj as $ItemSizeIDX=>$ItemSize)
                                 <div id="HalfSize-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}" class="tab-pane fade @if($ItemSizeIDX == 0) show in active @endif ">
                                    <h6 class="font-weight-bold mt-4">
                                       Pick Side</h6>
                                    <ul class="nav nav-pills">
                                       <li>
                                          <a id="" class="btn btn-outline-primary btn-sm mb-3 mr-3 active" data-toggle="pill" href="#Half-First-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}"> First Half </a>
                                          <a id="" class="btn btn-outline-primary btn-sm mb-3 mr-3" data-toggle="pill" href="#Half-Second-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}"> Second Half </a>
                                       </li>
                                    </ul>
                                    <div class="tab-content">
                                       @include('customer.restaurant.half.side', ['prefix'=>'First'])
                                       @include('customer.restaurant.half.side', ['prefix'=>'Second'])
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
                                                   "MenuFirst": null,
                                                   "MenuSecond": null,
                                                   "Size": {
                                                            "ID": 0,
                                                            "Name": "{{ ucwords( $ItemSize->name ) }}"
                                                            },
                                                   "TotalPrice":0
                                                   }' data-price="0" data-quantity="1" data-image="{{ $HalfNHalfMenu->image }}">
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