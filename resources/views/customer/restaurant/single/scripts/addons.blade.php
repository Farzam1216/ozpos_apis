@section('postScript')
   <script type="text/javascript">
      $(".SingleMenuCheckbox-{{ $SingleMenu->id }}").change(function () {
         let groupMenuAddonId = $(this).data('group_menu_addon_id');
         let checkedCheckBox = $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-'+groupMenuAddonId+':checked');
         let checked = checkedCheckBox.length;
         let masterData = $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data();
         masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
         let generateId = "{{ $unique_id }}-{{ $SingleMenu->id }}";
         let generateTotalPrice = parseFloat("{{$Menu->price}}");
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

         masterData.summary.menu[0].addons.length = 0;

         $('.SingleMenuCheckbox-{{ $SingleMenu->id }}:checked').each(function (i, obj) {
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