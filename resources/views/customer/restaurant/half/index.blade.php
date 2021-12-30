<div>
   @foreach ($MenuCategory->HalfNHalfMenu()->get() as $HalfNHalfMenuIDX => $HalfNHalfMenu)
      <div class="p-3 border-bottom menu-list">
         <span class="float-right">
            <button class="btn btn-outline-secondary btn-sm" onclick="HalfNHalfMenu('{{ $HalfNHalfMenu->id }}','{{ $rest->id }}',{{$unique_id}})">Edit</button>
         </span>
         
         {{-- @include('customer.restaurant.half.modals.index') --}}
         
         <div class="media">
            <a href="javascript:void(0)" onclick="HalfNHalfMenuModal('{{ $HalfNHalfMenu->id }}','{{ $rest->id }}')">
               <img src="{{ $HalfNHalfMenu->image }}" alt="" class="mr-3 rounded-pill "> </a>
            <a href="javascript:void(0)" onclick="HalfNHalfMenuModal('{{ $HalfNHalfMenu->id }}','{{ $rest->id }}')">
               <div class="media-body">
                  <h6 class="mb-1">{{ ucwords($HalfNHalfMenu->name) }}
                     <span class="badge badge-danger">Customizable Half n Half</span>
                  </h6>
               </div>
            
            </a>
         </div>
      </div>
   @endforeach
</div>

<div id="halfNHalfMenus" class="modal fade" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content" id="halfNHalfMenu">
      
      </div>
   </div>
</div>

<div id="halfNHalfMenuModals" class="modal fade" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content" id="halfNHalfMenuModal">
      
      </div>
   </div>
</div>

<script>
   function HalfNHalfMenu(halfMenu_id, vendorId, unique_id) {
      console.log(vendorId);
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
         },
         type: "POST",
         @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         url: "{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-halfNHalfMenu",
         @else
         url: "{{ url('customer/get-halfNHalfMenu') }}",
         @endif
         data: {
            HalfNHalfMenu_id: halfMenu_id,
            vendorId: vendorId,
            unique_id: unique_id
         },

         success: function (data) {
            console.log(data);

            $("#halfNHalfMenuModals").modal('hide');
            $("#halfNHalfMenus").modal('show');
            $("#halfNHalfMenu").html(data);
            // alert('Select Item category');
         },
         error: function (err) {

         }
      });
   }

   function HalfNHalfMenuModal(halfMenu_id, vendorId) {
      console.log(vendorId);
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
         },
         type: "POST",
         @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
         url: "{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-halfNHalfMenuModal",
         @else
         url: "{{ url('customer/get-halfNHalfMenuModal') }}",
         @endif
         data: {
            HalfNHalfMenu_id: halfMenu_id,
            vendorId: vendorId
         },

         success: function (data) {
            console.log(data);

            $("#halfNHalfMenuModals").modal('show');
            $("#halfNHalfMenuModal").html(data);
            //  alert('Select Item category');
         },
         error: function (err) {

         }
      });
   }

   // });
</script>

