
<div>

    @foreach ($MenuCategory->SingleMenu()->get() as $SingleMenuIDX => $SingleMenu)
        @php
            /** @var mixed $SingleMenu */
            $Menu = $SingleMenu
                ->Menu()
                ->get()
                ->first();
        @endphp
        <div class="p-3 border-bottom menu-list">

            {{-- Modal end --}}
            {{-- button --}}
            @if ($Menu->MenuSize()->get()->count() !== 0)
                <span class="float-right">
                    <button class="btn btn-outline-secondary btn-sm"
                        onclick="MenuSize('{{ $SingleMenu->id }}','{{ $rest->id }}')">Edit</button>
                </span>
            @elseif($Menu->MenuAddon()->get()->count() !== 0)
                <span class="float-right">
                    <button class="btn btn-outline-secondary btn-sm"
                     onclick="MenuAddon('{{ $SingleMenu->id }}','{{ $rest->id }}')">Edit</button>
                </span>
            @else
                <span class="float-right">
                    <button class="btn btn-primary btn-sm add-cart-btn" data-vendor="{{ $rest->id }}"
                        data-id="{{ $Menu->id }}" data-name="{{ ucwords($Menu->name) }}"
                        data-summary="{ 'category':'SINGLE', 'menu': [ { 'id':{{ $Menu->id }}, 'name':'{{ ucwords($Menu->name) }}', 'price':'{{ $Menu->price }}', 'addons':[] } ], 'size': null, 'total_price': '{{ $Menu->price }}' }"
                        data-price="{{ $Menu->price }}" data-quantity="1"
                        data-image="{{ $Menu->image }}">Add</button>
                </span>
            @endif

            <div class="media">
                <img src="{{ $Menu->image }}" alt="" class="mr-3 rounded-pill ">
                <div class="media-body">
                    <h6 class="mb-1">{{ ucwords($Menu->name) }}
                        @if ($Menu->price === null)
                            <span class="badge badge-danger">Customizable</span>
                        @endif
                    </h6>
                    @if ($Menu->price !== null)
                        @if ($Menu->display_discount_price === null)
                            <p class="text-muted mb-0">
                                {{ $Menu->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                            </p>
                        @else
                            <p class="text-muted mb-0">
                                <span class="text-decoration-overline">
                                    {{ $Menu->display_price }} {{ App\Models\GeneralSetting::first()->currency }}
                                </span> &ensp;
                                {{ $Menu->display_discount_price }}
                                {{ App\Models\GeneralSetting::first()->currency }}
                            </p>
                        @endif
                    @endif
                </div>
            </div>

            {{-- ///Ajax --}}
        </div>
    @endforeach
</div>

{{-- Menu Single Modal --}}
<div id="myModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" id="singleMenu">


        </div>
    </div>
</div>
{{-- end Menu Single Menu --}}

{{-- MenuAddon Modal --}}
<div id="MenuAddon" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" id="menuAddon">


        </div>
    </div>
</div>
{{-- end Single Menu --}}


{{-- reloader --}}
{{-- <div id="myDiv">
  <img class="loader" id="loading-image" src="ajax-loader.gif" style="display:none;"/>
</div> --}}

<div class="loader" id="loading-image" style="display:none;"></div>

@section('postScript')
    <script>

        function MenuAddon(id, vendorId) {

            console.log(vendorId);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
                },
                type: "POST",
                @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-menuAddonModel",
                @else
                    url: "{{ url('customer/get-menuAddonModel') }}",
                @endif
                data: {
                    singleMenu_id: id,
                    vendorId: vendorId
                },
                beforeSend: function() {
                    $("#loading-image").show();
                },
                success: function(data) {
                    console.log(data);
                    $("#myModal").modal('show');
                    $("#singleMenu").html(data);
                    $("#loading-image").hide()
                },
                error: function(err) {

                }
            });
        }
        // });
    </script>
    <script>

        function MenuSize(id, vendorId) {

            console.log(vendorId);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
                },
                type: "POST",
                @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-menuSizeModel",
                @else
                    url: "{{ url('customer/get-menuSizeModel') }}",
                @endif
                data: {
                    singleMenu_id: id,
                    vendorId: vendorId
                },
                beforeSend: function() {
                    $("#loading-image").show();
                },
                success: function(data) {
                    console.log(data);
                    $("#myModal").modal('show');
                    $("#singleMenu").html(data);
                    $("#loading-image").hide()
                },
                error: function(err) {

                }
            });
        }
        // });
    </script>
@endsection
