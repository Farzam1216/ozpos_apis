@section('postScript')
   <script type="text/javascript">
      $("#SingleMenuSizeBtn-{{ $SingleMenu->id }}-{{ $MenuSize->id }}").click(function () {
         let masterData = $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data();
         masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
         let generateId = "{{ $Menu->id }}-{{ $MenuSize->id }}";
         let generateTotalPrice = {{$MenuSize->price}};

         masterData.summary.Size.ID = "{{ $MenuSize->id }}";
         masterData.summary.Size.Name = "{{ $MenuSize->ItemSize()->get()->first()->name }}";
         masterData.summary.Size.Price = "{{ $MenuSize->price }}";
         masterData.summary.Addons = []

         $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}:checked').each(function (i, obj) {
            masterData.summary.Addons.push({
               "ID": $(this).data('id'),
               "Name": $(this).data('name'),
               "Price": $(this).data('price')
            });
            generateId += "-" + $(this).data('id');
            generateTotalPrice += $(this).data('price');
         });

         masterData.id = generateId;
         masterData.price = generateTotalPrice;
         masterData.summary.TotalPrice = generateTotalPrice;
         $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data(masterData);
         console.log($("#SingleMenuSubmit-{{ $SingleMenu->id }}").data());
      });

      $(".SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}").change(function () {
         let groupMenuAddonId = $(this).data('group_menu_addon_id');
         let checked = $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}-' + groupMenuAddonId + ':checked').length;
         let masterData = $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data();
         let generateId = "{{ $Menu->id }}-{{ $MenuSize->id }}";
         let generateTotalPrice = {{$MenuSize->price}};
         let maxAllowed = $(this).data('max');

         if (checked > maxAllowed) {
            $(this).prop('checked', false);
            return;
         }

         masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
         masterData.summary.Addons = [];

         $('.SingleMenuCheckbox-{{ $SingleMenu->id }}-{{ $MenuSize->id }}:checked').each(function (i, obj) {
            masterData.summary.Addons.push({
               "ID": $(this).data('id'),
               "Name": $(this).data('name'),
               "Price": $(this).data('price')
            });
            generateId += "-" + $(this).data('id');
            generateTotalPrice += $(this).data('price');
         });

         masterData.id = generateId;
         masterData.price = generateTotalPrice;
         masterData.summary.TotalPrice = generateTotalPrice;
         $("#SingleMenuSubmit-{{ $SingleMenu->id }}").data(masterData);
         
         {{--console.log($("#SingleMenuSubmit-{{ $SingleMenu->id }}").data());--}}
      });
   </script>
@append