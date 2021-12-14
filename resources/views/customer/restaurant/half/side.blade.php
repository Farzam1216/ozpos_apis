{{-- <div id="HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize }}" class="tab-pane fade @if($prefix=='First') show in active @endif "> --}}

  @foreach($HalfNHalfMenu->ItemCategory()->get()->first()->SingleMenuItemCategory()->get() as $SingleMenuItemCategoryIDX=>$SingleMenuItemCategory)

      @php
         $SingleMenu = $SingleMenuItemCategory->SingleMenu()->get()->first();
         $Menu = $SingleMenu->Menu()->get()->first();
         $MenuSize = $Menu->MenuSize()->where('item_size_id', $ItemSize->id )->get()->first();
         if(!$MenuSize) continue;
         $Menu = App\Models\Menu::where('id', $MenuSize->menu_id )->get()->first();

         if($MenuSize->price != 0) $MenuSize->price = $MenuSize->price / 2;
      @endphp

      {{-- @include('customer.restaurant.half.scripts.side') --}}

      <script type="text/javascript">
      // alert('asdasd');
        $("#HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}").click(function () {
           let masterData = $("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").data();
           masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
           let generateId = "{{ $unique_id }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}";
           let prefixIndex = ("{{$prefix}}" === 'First') ? 0 : 1;

           if (masterData.summary.size === null || masterData.summary.size.id != {{ $ItemSize->id }}) {
              // masterData.summary.menu = [ ];
              masterData.summary.menu.length = 0;
              masterData.summary.size = { };
              masterData.summary.size.id = {{ $ItemSize->id }};
              masterData.summary.size.name = "{{ $ItemSize->name }}";

              $('.HalfMenu-{{ $HalfNHalfMenu->id }}').each(function (i, obj) {
                 $(this)
                     .removeClass("btn-outline-secondary")
                     .removeClass("btn-primary")
                     .addClass("btn-outline-secondary")
                     .html($(this).data('name'))
              });
           }

           masterData.summary.menu[prefixIndex] = {};
           masterData.summary.menu[prefixIndex].id = {{ $Menu->id }};
           masterData.summary.menu[prefixIndex].data_id = "{{ $Menu->id }}";
           masterData.summary.menu[prefixIndex].name = "{{ ucwords($Menu->name) }}";
           masterData.summary.menu[prefixIndex].price = "{{ $MenuSize->price }}";
           masterData.summary.menu[prefixIndex].total_price = "{{ $MenuSize->price }}";
           masterData.summary.menu[prefixIndex].addons = [];


           // $('.HalfMenuSize-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}:checked').each(function (i, obj) {
           //    data["Menu{{$prefix}}"].Addons.push({
           //       "ID": $(this).data('id'),
           //       "Name": $(this).data('name'),
           //       "Price": $(this).data('price').toString()
           //    });
           //    data["Menu{{$prefix}}"].TotalPrice += $(this).data('price');
           //    data["Menu{{$prefix}}"].DataID += "-" + $(this).data('id');
           // });

           $('.HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}:checked').each(function (i, obj) {
              masterData.summary.menu[prefixIndex].addons.push({
                 "id": $(this).data('id'),
                 "name": $(this).data('name'),
                 "price": $(this).data('price').toString()
              });
              masterData.summary.menu[prefixIndex].data_id += "-" + $(this).data('id');
              masterData.summary.menu[prefixIndex].total_price = ( parseFloat( masterData.summary.menu[prefixIndex].total_price ) + parseFloat( $(this).data('price') ) ).toString();
           });

           if (prefixIndex === 0 && masterData.summary.menu[1] == null) {
              masterData.price = masterData.summary.menu[prefixIndex].total_price;
              masterData.id = generateId + "_" + masterData.summary.menu[prefixIndex].data_id + "_";
           }
           else if (prefixIndex === 1 && masterData.summary.menu[0] == null) {
              masterData.price = masterData.summary.menu[prefixIndex].total_price;
              masterData.id = generateId + "__" + masterData.summary.menu[prefixIndex].data_id;
           }
           else {
              masterData.price = ( parseFloat( masterData.summary.menu[0].total_price ) + parseFloat( masterData.summary.menu[1].total_price ) ).toString();
              masterData.id = generateId + "_" + masterData.summary.menu[0].data_id + "_" + masterData.summary.menu[1].data_id;
           }

           $("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").prop('disabled',
              ( masterData.summary.menu.filter(Boolean).length === 2 ) ? false : true
           );

           $('.HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}').each(function (i, obj) {
              $(this)
                 .removeClass("btn-outline-secondary")
                 .removeClass("btn-primary")
                 .addClass("btn-outline-secondary")
                 .html($(this).data('name'))
           });
           $('.HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}')
              .removeClass("btn-outline-secondary")
              .addClass("btn-primary")
              .html("Picked");

           $("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").data(masterData);

           console.log($("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").data());
        });


        $(".HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}").change(function () {
           let groupMenuAddonId = $(this).data('group_menu_addon_id');
           let checkedCheckBox = $('.HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}-'+groupMenuAddonId+':checked');
           let checked = checkedCheckBox.length;
           let maxAllowed = $(this).data('max');

           if (maxAllowed == 1) {
              checkedCheckBox.each(function (i, obj) {
                 $(this).prop('checked', false);
              });
              $(this).prop('checked', true);
           }
           else if (checked > maxAllowed) {
              $(this).prop('checked', false);
              return;
           }
        });
     </script>
      <div>
         <div class="p-3 border-bottom menu-list">

            @if($MenuSize !== NULL && $MenuSize->MenuAddon()->get()->count() !== 0)
               <span class="float-right">
                  <button class="btn btn-outline-secondary btn-sm "
                     onclick="HalfMenuAddon('{{ $prefix }}','{{ $HalfNHalfMenu->id }}','{{ $ItemSize->id }}','{{ $Menu->id }}')">
                     Edit
                  </button>
               </span>

               {{-- @include('customer.restaurant.half.modals.side') --}}

            @elseif($MenuSize !== NULL && $MenuSize->MenuAddon()->get()->count() === 0)
               <span class="float-right">
                  <button id="HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}" class="btn btn-outline-secondary btn-sm HalfMenu-{{ $HalfNHalfMenu->id }} HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }} HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}" data-name="Pick">
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
