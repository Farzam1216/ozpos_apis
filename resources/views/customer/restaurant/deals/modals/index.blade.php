<div class="modal-header">
    <h5 class="modal-title">{{ ucwords($DealsMenu->name) }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        @php
            $defaultData = [
                'Menu' => [],
            ];
        @endphp
        @foreach ($DealsMenu->DealsItems()->get() as $DealsItemsIDX => $DealsItems)
            <div>
                <div class="p-3 border-bottom menu-list">

                    <span class="float-right">
                        <button
                            class="btn btn-outline-secondary btn-sm"
                            onclick="DealsMenuItems('{{ $DealsMenu->id }}','{{ $DealsItems->id }}','{{ $rest->id }}')">
                            Browse
                        </button>
                    </span>

                    {{-- @include('customer.restaurant.deals.modals.items') --}}

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
        <button id="DealsMenuSubmit-{{ $DealsMenu->id }}" type="button" disabled
            class="btn btn-primary btn-lg btn-block add-cart-btn" data-vendor="{{ $rest->id }}"
            data-id="3-{{ $DealsMenu->id }}" data-name="{{ ucwords($DealsMenu->name) }}" data-summary='{
                           "category":"DEALS",
                           "menu_category":{ "id": {{ $DealsMenu->id }} },
                           "menu": [],
                           "size": null,
                           "total_price":0
                           }' data-price="{{ $DealsMenu->price }}" data-quantity="1"
            data-image="{{ $DealsMenu->image }}" data-required="{{ $DealsMenu->DealsItems()->count() }}"
            data-dismiss="modal">
            Add To Cart
        </button>
    </div>
</div>
{{-- Menu Menu Modal --}}
<div id="dealMenuItems" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" id="dealMenuItem">


        </div>
    </div>
</div>
{{-- end Menu Single Menu --}}
<script>
    function DealsMenuItems(dealMenu_id, dealsItems_id, vendorId) {


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
            },
            type: "POST",
            @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-dealsMenuItems",
            @else
                url: "{{ url('customer/get-dealsMenuItems') }}",
            @endif
            data: {
                dealsMenuId: dealMenu_id,
                dealsItemsId: dealsItems_id,
                vendorId: vendorId

            },
            beforeSend: function() {
                $("#loading-image").show();
            },
            success: function(data) {
                console.log(data);
                $("#dealMenuItems").modal('show');
                $("#dealMenuItem").html(data);
                $("#loading-image").hide()
            },
            error: function(err) {

            }
        });
    }
    // });
</script>
