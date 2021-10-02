@section('postScript')
   <script type="text/javascript">
      $("#HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}").click(function () {
         let masterData = $("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").data();
         masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
         let generateId = "{{ $unique_id }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}";
         let prefixIndex = ("{{$prefix}}" === 'First') ? 0 : 1;

         if (masterData.summary.size === null || masterData.summary.size.id != {{ $ItemSize->id }}) {
            // masterData.summary.menu = [ ];
            masterData.summary.menu.length = 0;
            masterData.summary.size = { };
            masterData.summary.size.id = {{ $ItemSize->id }};
            masterData.summary.size.name = "{{ $ItemSize->name }}";

            $('.HalfMenu-{{ $HalfNHalfMenu->id }}').each(function (i, obj) {
               $(this)
                   .removeClass("btn-outline-secondary")
                   .removeClass("btn-primary")
                   .addClass("btn-outline-secondary")
                   .html($(this).data('name'))
            });
         }

         masterData.summary.menu[prefixIndex] = {};
         masterData.summary.menu[prefixIndex].id = {{ $Menu->id }};
         masterData.summary.menu[prefixIndex].data_id = "{{ $Menu->id }}";
         masterData.summary.menu[prefixIndex].name = "{{ ucwords($Menu->name) }}";
         masterData.summary.menu[prefixIndex].price = "{{ $MenuSize->price }}";
         masterData.summary.menu[prefixIndex].total_price = "{{ $MenuSize->price }}";
         masterData.summary.menu[prefixIndex].addons = [];


         // $('.HalfMenuSize-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}:checked').each(function (i, obj) {
         //    data["Menu{{$prefix}}"].Addons.push({
         //       "ID": $(this).data('id'),
         //       "Name": $(this).data('name'),
         //       "Price": $(this).data('price').toString()
         //    });
         //    data["Menu{{$prefix}}"].TotalPrice += $(this).data('price');
         //    data["Menu{{$prefix}}"].DataID += "-" + $(this).data('id');
         // });
         
         $('.HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}:checked').each(function (i, obj) {
            masterData.summary.menu[prefixIndex].addons.push({
               "id": $(this).data('id'),
               "name": $(this).data('name'),
               "price": $(this).data('price').toString()
            });
            masterData.summary.menu[prefixIndex].data_id += "-" + $(this).data('id');
            masterData.summary.menu[prefixIndex].total_price = ( parseFloat( masterData.summary.menu[prefixIndex].total_price ) + parseFloat( $(this).data('price') ) ).toString();
         });
   
         if (prefixIndex === 0 && masterData.summary.menu[1] == null) {
            masterData.price = masterData.summary.menu[prefixIndex].total_price;
            masterData.id = generateId + "_" + masterData.summary.menu[prefixIndex].data_id + "_";
         }
         else if (prefixIndex === 1 && masterData.summary.menu[0] == null) {
            masterData.price = masterData.summary.menu[prefixIndex].total_price;
            masterData.id = generateId + "__" + masterData.summary.menu[prefixIndex].data_id;
         }
         else {
            masterData.price = ( parseFloat( masterData.summary.menu[0].total_price ) + parseFloat( masterData.summary.menu[1].total_price ) ).toString();
            masterData.id = generateId + "_" + masterData.summary.menu[0].data_id + "_" + masterData.summary.menu[1].data_id;
         }

         $("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").prop('disabled', 
            ( masterData.summary.menu.filter(Boolean).length === 2 ) ? false : true
         );

         $('.HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}').each(function (i, obj) {
            $(this)
               .removeClass("btn-outline-secondary")
               .removeClass("btn-primary")
               .addClass("btn-outline-secondary")
               .html($(this).data('name'))
         });
         $('.HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}')
            .removeClass("btn-outline-secondary")
            .addClass("btn-primary")
            .html("Picked");
            
         $("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").data(masterData);
         console.log($("#HalfMenuSubmit-{{ $HalfNHalfMenu->id }}").data());
      });

      
      $(".HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}").change(function () {
         let groupMenuAddonId = $(this).data('group_menu_addon_id');
         let checkedCheckBox = $('.HalfMenuCheckbox-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}-'+groupMenuAddonId+':checked');
         let checked = checkedCheckBox.length;
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
      });
   </script>
@append