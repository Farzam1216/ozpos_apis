
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
                    data-price="{{ $Menu->price }}" data-quantity="1" data-image="{{ $Menu->image }}">Add</button>

            </span>
        @endif

        <div class="media">
            <a href="#1 " onclick="itemModal('{{ $Menu->id }}','{{ $SingleMenu->id }}')">
                <img src="{{ $Menu->image }}" alt="" class="mr-3 rounded-pill ">
                <div class="media-body">
                    <h6 class="mb-1" style="font-weight: 600;">{{ ucwords($Menu->name) }}
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
            </a>
        </div>

        {{-- ///Ajax --}}
    </div>
@endforeach

{{-- Menu Single Modal --}}
<div id="myModal" class="modal fade" tabindex="-1" style="background: white;">
    <div class="modal-dialog">

        <div class="modal-content" id="singleMenu">


        </div>

    </div>
</div>
{{-- end Menu Single Menu --}}

{{-- MenuAddon Modal --}}
<div id="MenuAddon" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <button type="button" class="close " data-dismiss="modal" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
        <div class="modal-content" id="menuAddon">


        </div>
    </div>
</div>



<div class="modal fade" id="ItemMenus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="ItemMenu">

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

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

        function itemModal(MenuId, SingleMenuId) {


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
                },
                type: "POST",
                @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-itemModal",
                @else
                    url: "{{ url('customer/get-itemModal') }}",
                @endif
                data: {
                    SingleMenuId: SingleMenuId,
                    MenuId: MenuId
                },
                beforeSend: function() {
                    $("#loading-image").show();
                },
                success: function(data) {
                    console.log(data);
                    $("#ItemMenus").modal('show');
                    $("#ItemMenu").html(data);
                    $("#loading-image").hide()
                },
                error: function(err) {

                }
            });
        }
        // });
    </script>
@endsection
<style>
  div#ItemMenus {
    width: 620px;
    left: 390px;
    top: 100px;

}
div#ItemMenu {
    height: auto !important;
    min-height: -webkit-fill-available;
    max-height: -webkit-fill-available;
}
*, :after, :before {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-shadow: 1px 1px 1px rgb(0 0 0 / 4%);
}
.modal button.close {
    position: absolute;
    top: 1.5rem;
    right: 1.875rem;
    border: none;
    border-radius: 50px;
    background-color: transparent;
}
h1#dish-name {
    font-weight: 400;
    font-family: Poppins,sans-serif;
    line-height: 1.5;
}
button.close.btn {
    padding: 6px;
    background: red;
    border-radius: 8px;
    border: 1px solid darkred;
    color: white;
}
</style>
