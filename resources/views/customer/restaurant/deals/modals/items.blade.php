{{-- @section('custom_modals')
   <div class="modal fade" id="DealsMenuItems-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" tabindex="-1" role="dialog" aria-labelledby="DealsMenuItemsModal-{{ $DealsMenu->id }}-{{ $DealsItems->id }}" aria-hidden="true" style="z-index: 1060">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content"> --}}
<div class="modal-header">
   <h5 class="modal-title">{{ ucwords($DealsItems->name) }}</h5>
   <button type="button" class="close" onclick="$('#dealMenuItems').modal('hide');" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <div class="container">

      @foreach ($DealsItems->ItemCategory()->get()->first()->SingleMenuItemCategory()->get()
  as $SingleMenuItemCategoryIDX => $SingleMenuItemCategory)
         @php
            $SingleMenu = $SingleMenuItemCategory
                ->SingleMenu()
                ->get()
                ->first();
            $Menu = $SingleMenu
                ->Menu()
                ->get()
                ->first();
            $MenuSize = $Menu
                ->MenuSize()
                ->where('item_size_id', $DealsItems->id)
                ->get()
                ->first();
            $defaultData['Menu'][] = [
                'ID' => $Menu->id,
                'DataID' => $Menu->id,
                'Name' => ucwords($Menu->name),
                'Size' =>
                    $MenuSize === null
                        ? null
                        : ucwords(
                            $MenuSize
                                ->ItemSize()
                                ->get()
                                ->first()->name,
                        ),
                'Addons' => [],
            ];
         @endphp

         {{-- @include('customer.restaurant.deals.scripts.addons') --}}
         <script type="text/javascript">
            $(document).on('change', ".DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}", function () {
               console.log('triggered a checkbox script');
               let groupMenuAddonId = $(this).data('group_menu_addon_id');
               let checkedCheckBox = $('.DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-' + groupMenuAddonId + ':checked');
               let checked = checkedCheckBox.length;
               let maxAllowed = $(this).data('max');

               if (maxAllowed == 1) {
                  checkedCheckBox.each(function (i, obj) {
                     $(this).prop('checked', false);
                  });
                  $(this).prop('checked', true);
               } else if (checked > maxAllowed) {
                  $(this).prop('checked', false);
                  return;
               }
            });
         </script>

         <div>
            <div class="p-3 border-bottom menu-list">
               @if ($MenuSize !== null &&
$MenuSize->MenuAddon()->get()->count() !== 0)
                  <span class="float-right">
                     <button class="btn btn-outline-secondary btn-sm" onclick="DealsMenuAddon('{{ $MenuSize->id }}','{{ $DealsMenu->id }}','{{ $DealsItems->id }}','{{ $Menu->id }}','{{ $rest->id }}')">
                        Edit
                     </button>
                  </span>


                  {{-- @include('customer.restaurant.deals.modals.addons') --}}

               @elseif($MenuSize !== NULL && $MenuSize->MenuAddon()->get()->count() === 0)
                  <span class="float-right">
                     <button onclick="$('#dealMenuItems').modal('hide');" class="btn btn-primary btn-sm DealsMenuPick-{{ $DealsMenu->id }}" data-deals="{{ $DealsItems->id }}" data-menu="{{ $Menu->id }}" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}">
                        Pick
                     </button>
                  </span>
               @elseif($Menu->MenuAddon()->get()->count() != 0)
               @else
                  <span class="float-right">
                     <button onclick="$('#dealMenuItems').modal('hide');" class="btn btn-primary btn-sm DealsMenuPick-{{ $DealsMenu->id }}" data-deals="{{ $DealsItems->id }}" data-menu="{{ $Menu->id }}" data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}">
                        Pick
                     </button>
                  </span>
               @endif
               <div class="media">
                  <img src="{{ $Menu->image }}" alt="askbootstrap" class="mr-3 rounded-pill ">
                  <div class="media-body">
                     <h6 class="mb-1">{{ ucwords($Menu->name) }}
                        @if ($Menu->price == null)
                           <span class="badge badge-danger">Customizable</span>
                        @endif
                     </h6>
                     @if ($Menu->price != null)

                        <p class="text-muted mb-0">{{ $Menu->price }}
                           {{ App\Models\GeneralSetting::first()->currency }}</p>

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
      <button type="button" class="btn border-top btn-lg btn-block" onclick="$('#dealMenuItems').modal('hide');">
         Close
      </button>
   </div>
</div>{{-- </div>
      </div>
   </div>
@append --}}

{{-- Menu Menu Modal --}}
<div id="dealsMenuAddons" class="modal fade" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content" id="dealsMenuAddon">

      </div>
   </div>
</div>{{-- end Menu Single Menu --}}
<script>
   function DealsMenuAddon(menuSize_id, dealMenu_id, dealsItems_id, menu_id, vendorId) {
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
         },
         type: "POST",
         @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         url: "{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-dealsMenuAddon",
         @else
         url: "{{ url('customer/get-dealsMenuAddon') }}",
         @endif
         data: {
            menuSize_id: menuSize_id,
            dealMenu_id: dealMenu_id,
            dealsItems_id: dealsItems_id,
            menu_id: menu_id,
            vendorId: vendorId

         },
         beforeSend: function () {
            $("#loading-image").show();
         },
         success: function (data) {
            console.log(data);
            $("#dealsMenuAddons").modal('show');
            $("#dealsMenuAddon").html(data);
            $("#loading-image").hide()
         },
         error: function (err) {

         }
      });
   }

   // });
</script>
<script type="text/javascript">
   $(document).on('click', ".DealsMenuPick-{{ $DealsMenu->id }}", function () {
      let thisData = $(this).data();
      let masterData = $("#DealsMenuSubmit-{{ $DealsMenu->id }}").data();
      masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
      let generateId = "{{ $unique_id }}-{{ $DealsMenu->id }}";
      masterData.summary.menu[thisData.deals] = {};
      masterData.summary.menu[thisData.deals].id = $(this).data('id');
      masterData.summary.menu[thisData.deals].data_id = $(this).data('id');
      masterData.summary.menu[thisData.deals].name = $(this).data('name');
      masterData.summary.menu[thisData.deals].total_addons_price = 0;
      masterData.summary.menu[thisData.deals].addons = [];

      $('.DealsMenuAddon-{{ $DealsMenu->id }}-' + $(this).data('deals') + '-' + $(this).data('menu') +
          ':checked').each(function (i, obj) {
         masterData.summary.menu[thisData.deals].addons.push({
            "id": $(this).data('id'),
            "name": $(this).data('name'),
            "price": $(this).data('price').toString()
         });
         masterData.summary.menu[thisData.deals].total_addons_price += parseFloat($(this).data(
             'price'));
      });


      $.each(masterData.summary.menu, function (key, menu) {
         generateId += "_" + $(this).id;

         $.each($(this).addons, function (key, addon) {
            generateId += "-" + $(this).id;
         });
      });

      $('#DealsMenuItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).removeClass(
          "btn-outline-secondary");
      $('#DealsMenuItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).addClass("btn-primary");
      $('#DealsMenuItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).html("Picked");

      $("#DealsMenuSubmit-{{ $DealsMenu->id }}").prop('disabled',
          (masterData.summary.menu.filter(Boolean).length === parseInt(masterData.required)) ? false :
              true
      );

      $("#DealsMenuSubmit-{{ $DealsMenu->id }}").data(masterData);
      console.log($("#DealsMenuSubmit-{{ $DealsMenu->id }}").data());
   });
</script>
