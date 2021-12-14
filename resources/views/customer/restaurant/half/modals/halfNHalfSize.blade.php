
@foreach ($ItemSizeObj as $ItemSizeIDX => $ItemSize)
    <div id="HalfMenuSize-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}"
        class="tab-pane fade @if ($ItemSizeIDX === 0) show in active @endif " style="background: white;">
        <h6 class="font-weight-bold mt-4">
            Pick Side</h6>
        <ul class="nav nav-pills">
            <li>
                <a class="btn btn-outline-primary btn-sm mb-3 mr-3" data-toggle="pill"
                    onclick="HalfMenuFirst('{{ $HalfNHalfMenu->id }}','{{ $ItemSize->id }}','{{ $rest->id }}','{{$unique_id}}')">
                    First Half </a>
                <a class="btn btn-outline-primary btn-sm mb-3 mr-3" data-toggle="pill"
                    onclick="HalfMenuSecond('{{ $HalfNHalfMenu->id }}','{{ $ItemSize->id }}','{{ $rest->id }}','{{$unique_id}}')">
                    Second Half </a>
            </li>
        </ul>
         <div class="tab-content halfNHalfSide" id="halfNHalfSide">

        </div>
    </div>
@endforeach





<script>
    function HalfMenuFirst(HalfNHalfMenuId, ItemSizeId, vendorId,unique_id) {
        console.log(vendorId);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
            },
            type: "POST",
            @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-halfMenuFirst",
            @else
                url: "{{ url('customer/get-halfMenuFirst') }}",
            @endif
            data: {
                HalfNHalfMenuId: HalfNHalfMenuId,
                ItemSizeId: ItemSizeId,
                vendorId: vendorId,
                unique_id: unique_id
            },

            success: function(data) {
                console.log(data);

                $("#halfNHalfSide").html(data);


            },
            error: function(err) {

            }
        });
    }

    function HalfMenuSecond(HalfNHalfMenuId, ItemSizeId, vendorId,unique_id) {
        console.log(vendorId);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
            },
            type: "POST",
            @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-halfMenuSecond",
            @else
                url: "{{ url('customer/get-halfMenuSecond') }}",
            @endif
            data: {
                HalfNHalfMenuId: HalfNHalfMenuId,
                ItemSizeId: ItemSizeId,
                vendorId: vendorId,
                unique_id: unique_id
            },

            success: function(data) {
                console.log(data);

                $("#halfNHalfSide").html(data);
                // $(".halfNHalfSide").html(data);

            },
            error: function(err) {

            }
        });
    }
    // });
</script>
