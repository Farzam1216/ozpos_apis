
  <script>
    $( function() {
      $( "#tabs" ).tabs();
    } );
    </script>
<div class="modal-header">
    <h5 class="modal-title">{{ ucwords($HalfNHalfMenu->name) }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        @php
            $ItemSizeObj = App\Models\ItemSize::where('vendor_id', $HalfNHalfMenu->vendor_id)->get();
        @endphp
        <h6 class="font-weight-bold mt-4">Pick Size</h6>
        <ul class="nav nav-pills">
            <li id="tabs">
                @foreach ($ItemSizeObj as $ItemSizeIDX => $ItemSize)
                    <a id="HalfMenuSizeBtn-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}"
                        class="btn btn-outline-primary btn-sm mb-3 mr-3" data-toggle="pill"
                        onclick="HalfMenuSize('{{ $HalfNHalfMenu->id }}','{{ $ItemSize->id }}','{{ $rest->id }}')">
                        {{ $ItemSize->name }}
                    </a>
                @endforeach
            </li>
        </ul>
        <div class="tab-content" id="HalfMenuSize">

        </div>
    </div>
</div>
<div class="modal-footer p-0 border-0">
    <div class="col-6 m-0 p-0">
        <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">Close
        </button>
    </div>
    <div class="col-6 m-0 p-0">
        <button id="HalfMenuSubmit-{{ $HalfNHalfMenu->id }}" type="button" disabled
            class="btn btn-primary btn-lg btn-block add-cart-btn" data-vendor="{{ $rest->id }}"
            data-id="2-{{ $HalfNHalfMenu->id }}" data-name="{{ ucwords($HalfNHalfMenu->name) }}" data-summary='{
                                                       "category":"HALF_N_HALF",
                                                       "menu": [],
                                                       "size": null,
                                                       "total_price": 0
                                                       }' data-price="0" data-quantity="1"
            data-image="{{ $HalfNHalfMenu->image }}" data-dismiss="modal">
            Add To Cart
        </button>
    </div>
</div>


<script>
  function HalfMenuSize(HalfNHalfMenuId,ItemSizeId,vendorId) {

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
          },
          type: "POST",
          @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
              url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-halfMenuSize",
          @else
              url: "{{ url('customer/get-halfMenuSize') }}",
          @endif
          data: {
              HalfNHalfMenuId: HalfNHalfMenuId,
              ItemSizeId: ItemSizeId,
              vendorId: vendorId,

          },

          success: function(data) {
              console.log(data);

              $("#HalfMenuSize").html(data);


          },
          error: function(err) {

          }
      });
  }
  </script>

