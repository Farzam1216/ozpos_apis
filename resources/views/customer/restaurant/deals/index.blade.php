<div>
   @foreach($MenuCategory->DealsMenu()->get() as $DealsMenuIDX=>$DealsMenu)
      <div class="p-3 border-bottom menu-list">
         <span class="float-right">
            <button class="btn btn-outline-secondary btn-sm" onclick="DealsMenu('{{ $DealsMenu->id }}','{{ $rest->id }}','{{$unique_id}}')">Edit</button>
         </span>
         
         {{-- @include('customer.restaurant.deals.modals.index') --}}
         
         <div class="media">
            <a href="javascript:void(0)" onclick="DealMenuModal('{{ $DealsMenu->id }}','{{ $rest->id }}')">
               <img src="{{ $DealsMenu->image }}" alt="" class="mr-3 rounded-pill "> </a>
            <div class="media-body">
               <a href="javascript:void(0)" onclick="DealMenuModal('{{ $DealsMenu->id }}','{{ $rest->id }}')">
                  <h6 class="mb-1">{{ ucwords($DealsMenu->name) }}
                     <span class="badge badge-danger">Customizable Deals</span>
                  </h6>
                  @if($DealsMenu->price !== NULL)
                     @if($DealsMenu->display_discount_price === NULL)
                        <p class="text-muted mb-0">
                           {{ $DealsMenu->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                        </p>
                     @else
                        <p class="text-muted mb-0">
                           <span class="text-decoration-overline">
                              {{ $DealsMenu->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                           </span> &ensp;
                           {{ $DealsMenu->display_discount_price }} {{ App\Models\GeneralSetting::first()->currency }}
                        </p>
                     @endif
                  @endif
               </a>
            </div>
         </div>
      </div>
   @endforeach
</div>

{{-- Menu Menu Modal --}}
<div id="dealMenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dealMenuModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="dealMenus">
      
      </div>
   </div>
</div>{{-- end Menu Single Menu --}}{{-- Menu Menu Modal --}}
<div class="modal fade" id="dealMenuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog ">
      <div class="modal-content" id="dealMenusModal">
      
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>{{-- end Menu Single Menu --}}
<script>

   function DealsMenu(id, vendor_id, unique_id) {


      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
         },
         type: "POST",
         @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         url: "{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-dealsMenu",
         @else
         url: "{{ url('customer/get-dealsMenu') }}",
         @endif
         data: {
            dealsMenu_id: id, vendorId: vendor_id, unique_id: unique_id

         },
         beforeSend: function () {
            $("#loading-image").show();
         },
         success: function (data) {
            console.log(data);
            $("#dealMenuModal").modal('hide');
            $("#dealMenu").modal('show');
            $("#dealMenus").html(data);
            $("#loading-image").hide()
         },
         error: function (err) {

         }
      });
   }

   function DealMenuModal(id, vendor_id) {


      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
         },
         type: "POST",
         @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         url: "{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-dealMenuModal",
         @else
         url: "{{ url('customer/get-dealMenuModal') }}",
         @endif
         data: {
            dealsMenu_id: id, vendorId: vendor_id
         },
         beforeSend: function () {
            $("#loading-image").show();
         },
         success: function (data) {
            console.log(data);
            $("#dealMenu").modal('hide');
            $("#dealMenuModal").modal('show');
            $("#dealMenusModal").html(data);
            $("#loading-image").hide()
         },
         error: function (err) {

         }
      });
   }

   // });
</script>

