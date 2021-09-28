@section('postScript')
   <script type="text/javascript">
      $(".SingleMenuCheckbox-{{ $SingleMenu->id }}").change(function () {
         let groupMenuAddonId = $(this).data('group_menu_addon_id');
         let checked = $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-'+groupMenuAddonId+':checked').length;
         let maxAllowed = $(this).data('max');

         if (checked > maxAllowed) {
            $(this).prop('checked', false);
            return;
         }

         let totalPrice = 0;
         let masterData = $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data();
         masterData.summary = JSON.parse( JSON.stringify( masterData.summary ) );
         let generateId = masterData.summary.Menu.ID;
         let generateTotalPrice = {{$Menu->price}};


         masterData.summary.Addons = []
         $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-'+groupMenuAddonId+':checked').each(function (i, obj) {
            masterData.summary.Addons.push({
               "ID": $(this).data('id'),
               "Name": $(this).data('name'),
               "Price": $(this).data('price')
            });
            generateId += "-" + $(this).data('id');
            generateTotalPrice += $(this).data('price');
         });

         masterData.summary.TotalPrice = totalPrice;
         $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data(masterData);
   
         {{--console.log($("#SingleMenuSubmit-{{ $SingleMenu->id }}").data());--}}
         
         
         {{--if ($('.MenuAddonCategory' + $(this).data('cat') + ':checked').length > $(this).data('max')) {--}}
         {{--   $(this).prop('checked', false);--}}
         {{--   return;--}}
         {{--}--}}
         
         {{--var totalPrice = 0;--}}
         {{--var data = JSON.parse(JSON.stringify(--}}
         {{--    $("#Menu{{ $Menu->id }}").data('summary')--}}
         {{--));--}}
         {{--var dataID = data.Menu.ID;--}}
         
         {{--totalPrice += {{ $Menu->price }};--}}
         {{--data.Addons = []--}}
         
         {{--$('.Menu{{ $Menu->id }}:checked').each(function (i, obj) {--}}
         {{--   data.Addons.push({--}}
         {{--      "ID": $(this).data('id'),--}}
         {{--      "Name": $(this).data('name'),--}}
         {{--      "Price": $(this).data('price')--}}
         {{--   });--}}
         {{--   dataID += "-" + $(this).data('id');--}}
         {{--   totalPrice += $(this).data('price');--}}
         {{--});--}}
         
         {{--data.TotalPrice = totalPrice;--}}
         {{--$("#Menu{{ $Menu->id }}").data('summary', data);--}}
         {{--$("#Menu{{ $Menu->id }}").data('id', dataID);--}}
         
         {{--console.log($("#Menu{{ $Menu->id }}").data('summary'));--}}
         {{--console.log($("#Menu{{ $Menu->id }}").data('id'));--}}
      });
   </script>
@append