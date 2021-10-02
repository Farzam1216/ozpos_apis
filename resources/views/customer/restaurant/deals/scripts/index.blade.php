@section('postScript')
   <script type="text/javascript">
      $(".DealsMenuPick-{{$DealsMenu->id}}").click(function () {
         let thisData = $(this).data();
         let masterData = $("#DealsMenuSubmit-{{ $DealsMenu->id }}").data();
         masterData.summary = JSON.parse(JSON.stringify(masterData.summary));
         let generateId = "{{ $unique_id }}-{{ $DealsMenu->id }}";
         
         
         


         // if($(this).data('deal') in data.Deals)
         //    delete data.Deals[$(this).data('deal')];
         masterData.summary.menu[thisData.deals] = {};
         masterData.summary.menu[thisData.deals].id = $(this).data('id');
         masterData.summary.menu[thisData.deals].data_id = $(this).data('id');
         masterData.summary.menu[thisData.deals].name = $(this).data('name');
         masterData.summary.menu[thisData.deals].total_addons_price = 0;
         masterData.summary.menu[thisData.deals].addons = [];

         $('.DealsMenuAddon-{{ $DealsMenu->id }}-' + $(this).data('deals') + '-' + $(this).data('menu') + ':checked').each(function (i, obj) {
            masterData.summary.menu[thisData.deals].addons.push({
               "id": $(this).data('id'),
               "name": $(this).data('name'),
               "price": $(this).data('price').toString()
            });
            masterData.summary.menu[thisData.deals].total_addons_price += parseFloat( $(this).data('price') );
         });


         $.each(masterData.summary.menu, function (key, menu) {
            generateId += "_" + $(this).id;

            $.each($(this).addons, function (key, addon) {
               generateId += "-" + $(this).id;
            });
         });
         
         $('#DealsMenuItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).removeClass("btn-outline-secondary");
         $('#DealsMenuItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).addClass("btn-primary");
         $('#DealsMenuItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).html("Picked");

         $("#DealsMenuSubmit-{{ $DealsMenu->id }}").prop('disabled',
             ( masterData.summary.menu.filter(Boolean).length === parseInt(masterData.required) ) ? false : true
         );
         
         $("#DealsMenuSubmit-{{ $DealsMenu->id }}").data(masterData);
         console.log($("#DealsMenuSubmit-{{ $DealsMenu->id }}").data());
      });
   </script>
@append