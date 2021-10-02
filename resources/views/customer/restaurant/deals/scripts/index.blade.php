@section('postScript')
   <script type="text/javascript">
      $(".DealsMenuPick{{$DealsMenu->id}}").click(function () {
         let button = $("#CartAddDeals{{ $DealsMenu->id }}");
         let dataID = "3";
         let data = JSON.parse(JSON.stringify(button.data('summary')));
         let thisData = $(this).data();


         // if($(this).data('deal') in data.Deals)
         //    delete data.Deals[$(this).data('deal')];
         data.Deals[thisData.deals] = {};
         data.Deals[thisData.deals].ID = $(this).data('id');
         data.Deals[thisData.deals].DataID = $(this).data('id');
         data.Deals[thisData.deals].Name = $(this).data('name');
         data.Deals[thisData.deals].TotalAddonsPrice = 0;
         data.Deals[thisData.deals].Addons = [];

         $('.DealsMenuAddon-{{ $DealsMenu->id }}-' + $(this).data('deals') + '-' + $(this).data('menu') + ':checked').each(function (i, obj) {
            data.Deals[thisData.deals].Addons.push({
               "ID": $(this).data('id'),
               "Name": $(this).data('name'),
               "Price": $(this).data('price')
            });
            data.Deals[thisData.deals].TotalAddonsPrice += $(this).data('price');
         });

         button.data('summary', data);

         $.each(data.Deals, function (key, deal) {
            dataID += "_" + deal.ID;

            $.each(deal.Addons, function (key, addon) {
               dataID += "-" + addon.ID;
            });
         });
         
         {{--button.data('price', data.MenuFirst.TotalPrice + data.MenuSecond.TotalPrice);--}}
         button.data('id', dataID);

         $('#DealsItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).removeClass("btn-outline-secondary");
         $('#DealsItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).addClass("btn-primary");
         $('#DealsItemsBtn-{{ $DealsMenu->id }}-' + $(this).data('deals')).html("Picked");

         console.log(button.data());
         console.log();
      });
   </script>
@append