<div>
    @foreach ($MenuCategory->HalfNHalfMenu()->get() as $HalfNHalfMenuIDX => $HalfNHalfMenu)
        <div class="p-3 border-bottom menu-list">
            <span class="float-right">
                <button class="btn btn-outline-secondary btn-sm"
                    onclick="HalfNHalfMenu('{{ $HalfNHalfMenu->id }}','{{ $rest->id }}')">Edit</button>
            </span>

            {{-- @include('customer.restaurant.half.modals.index') --}}

            <div class="media">
                <img src="{{ $HalfNHalfMenu->image }}" alt="" class="mr-3 rounded-pill ">
                <div class="media-body">
                    <h6 class="mb-1">{{ ucwords($HalfNHalfMenu->name) }}
                        <span class="badge badge-danger">Customizable Half n Half</span>
                    </h6>
                </div>
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



    <script>
        function HalfNHalfMenu(halfMenu_id, vendorId) {
            console.log(vendorId);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
                },
                type: "POST",
                @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-halfNHalfMenu",
                @else
                    url: "{{ url('customer/get-halfNHalfMenu') }}",
                @endif
                data: {
                    HalfNHalfMenu_id: halfMenu_id,
                    vendorId: vendorId
                },

                success: function(data) {
                    console.log(data);

                    $("#halfNHalfMenus").modal('show');

                    $("#halfNHalfMenu").html(data);
                    alert('Select Item category');
                },
                error: function(err) {

                }
            });
        }
        // });
    </script>

