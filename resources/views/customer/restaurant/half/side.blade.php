<div id="Half-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}" class="tab-pane fade @if($prefix=='First') show in active @endif ">
   @foreach($HalfNHalfMenu->ItemCategory()->get()->first()->SingleMenuItemCategory()->get() as $SingleMenuItemCategoryIDX=>$SingleMenuItemCategory)
      
      @php
         $SingleMenu = $SingleMenuItemCategory->SingleMenu()->get()->first();
         $Menu = $SingleMenu->Menu()->get()->first();
         $MenuSize = $Menu->MenuSize()->where('item_size_id', $ItemSize->id )->get()->first();
         $Menu = App\Models\Menu::where('id', $MenuSize->menu_id )->get()->first();
         
         if($MenuSize->price != 0) $MenuSize->price = $MenuSize->price / 2;
      @endphp
      
      @include('customer.restaurant.half.scripts.side')
      
      <div>
         <div class="p-3 border-bottom menu-list">
            
            <span class="float-right">
               <button class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#HalfAddon-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}">ADD</button>
            </span>
   
            @include('customer.restaurant.half.modals.side')
            
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