@section('postScript')
   <script type="text/javascript">
      $("#SingleMenuSizeBtn-{{ $SingleMenu->id }}-{{ $MenuSize->id }}").click(function () {
         let masterData = $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data();
         masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
         let generateId = "{{ $unique_id }}-{{ $SingleMenu->id }}-{{ $MenuSize->id }}";
         let generateTotalPrice = parseFloat("{{$MenuSize->price}}");

         masterData.summary.size.id = {{ $MenuSize->id }};
         masterData.summary.size.name = "{{ $MenuSize->ItemSize()->get()->first()->name }}";
         masterData.summary.size.price = "{{ $MenuSize->price }}";
         masterData.summary.menu[0].addons.length = []

         $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}:checked').each(function (i, obj) {
            masterData.summary.menu[0].addons.push({
               "id": $(this).data('id'),
               "name": $(this).data('name'),
               "price": $(this).data('price').toString()
            });
            generateId += "-" + $(this).data('id');
            generateTotalPrice += parseFloat($(this).data('price'));
         });

         masterData.id = generateId;
         masterData.price = generateTotalPrice.toString();
         masterData.summary.total_price = generateTotalPrice.toString();
         $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data(masterData);
         console.log($("#SingleMenuSubmit-{{ $SingleMenu->id }}").data());
      });

      $(".SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}").change(function () {
         let groupMenuAddonId = $(this).data('group_menu_addon_id');
         let checkedCheckBox = $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-'+groupMenuAddonId+':checked');
         let checked = checkedCheckBox.length;
         let masterData = $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data();
         masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
         let generateId = "{{ $unique_id }}-{{ $SingleMenu->id }}-{{ $MenuSize->id }}";
         let generateTotalPrice = parseFloat("{{$MenuSize->price}}");
         let maxAllowed = $(this).data('max');

         if (maxAllowed == 1) {
            checkedCheckBox.each(function (i, obj) {
               $(this).prop('checked', false);
            });
            $(this).prop('checked', true);
         }
         else if (checked > maxAllowed) {
            $(this).prop('checked', false);
            return;
         }

         masterData.summary.menu[0].addons = [];

         $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}:checked').each(function (i, obj) {
            masterData.summary.menu[0].addons.push({
               "id": $(this).data('id'),
               "name": $(this).data('name'),
               "price": $(this).data('price').toString()
            });
            generateId += "-" + $(this).data('id');
            generateTotalPrice += parseFloat($(this).data('price'));
         });

         masterData.id = generateId;
         masterData.price = generateTotalPrice.toString();
         masterData.summary.total_price = generateTotalPrice.toString();
         $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data(masterData);
         
         console.log($("#SingleMenuSubmit-{{ $SingleMenu->id }}").data());
      });
   </script>
@append