{{-- <div id="HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}" class="tab-pane fade @if($prefix=='First') show in active @endif "> --}}
   @foreach($HalfNHalfMenu->ItemCategory()->get()->first()->SingleMenuItemCategory()->get() as $SingleMenuItemCategoryIDX=>$SingleMenuItemCategory)

      @php
         $SingleMenu = $SingleMenuItemCategory->SingleMenu()->get()->first();
         $Menu = $SingleMenu->Menu()->get()->first();
         $MenuSize = $Menu->MenuSize()->where('item_size_id', $ItemSize )->get()->first();
         if(!$MenuSize) continue;
         $Menu = App\Models\Menu::where('id', $MenuSize->menu_id )->get()->first();

         if($MenuSize->price != 0) $MenuSize->price = $MenuSize->price / 2;
      @endphp

      {{-- @include('customer.restaurant.half.scripts.side') --}}
      <div>
         <div class="p-3 border-bottom menu-list">

            @if($MenuSize !== NULL && $MenuSize->MenuAddon()->get()->count() !== 0)
               <span class="float-right">
                  <button class="btn btn-outline-secondary btn-sm "
                     onclick="HalfMenuAddon('{{ $prefix }}','{{ $HalfNHalfMenu->id }}','{{ $ItemSize }}','{{ $Menu->id }}')">
                     Edit
                  </button>
               </span>

               {{-- @include('customer.restaurant.half.modals.side') --}}

            @elseif($MenuSize !== NULL && $MenuSize->MenuAddon()->get()->count() === 0)
               <span class="float-right">
                  <button id="HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }}" class="btn btn-outline-secondary btn-sm HalfMenu-{{ $HalfNHalfMenu->id }} HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }} HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}-{{ $Menu->id }}" data-name="Pick">
                     Pick
                  </button>
               </span>
            @endif

            <div class="media">
               <img src="{{ $Menu->image }}" alt="askbootstrap" class="mr-3 rounded-pill ">
               <div class="media-body">
                  <h6 class="mb-1">{{ ucwords($Menu->name) }}
                  </h6>
                  @if($MenuSize->price !== NULL)
                     @if($MenuSize->display_discount_price === NULL)
                        <p class="text-muted mb-0">
                           {{ $MenuSize->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                        </p>
                     @else
                        <p class="text-muted mb-0">
                           <span class="text-decoration-overline">
                              {{ $MenuSize->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                           </span> &ensp;
                           {{ $MenuSize->display_discount_price }} {{ App\Models\GeneralSetting::first()->currency }}
                        </p>
                     @endif
                  @endif
               </div>
            </div>
         </div>
      </div>
   @endforeach
   {{-- Menu Menu Modal --}}
<div id="halfMenuAddons" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
      <div class="modal-content" id="halfMenuAddon">


      </div>
  </div>
</div>
{{-- end Menu Single Menu --}}
{{-- </div> --}}
<script>
function HalfMenuAddon(prefix,HalfNHalfMenuId, ItemSizeId, vendorId) {
  console.log(vendorId);
  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
      },
      type: "POST",
      @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
          url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-halfMenuAddon",
      @else
          url: "{{ url('customer/get-halfMenuAddon') }}",
      @endif
      data: {
          HalfNHalfMenuId: HalfNHalfMenuId,
          ItemSizeId: ItemSizeId,
          vendorId: vendorId,
          prefix: prefix,
      },

      success: function(data) {
          console.log(data);
          $("#halfMenuAddons").modal('show');
          $("#halfMenuAddon").html(data);
          // $(".halfNHalfSide").html(data);

      },
      error: function(err) {

      }
  });
}
// });
</script>
