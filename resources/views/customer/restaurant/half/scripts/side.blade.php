@section('postScript')
   <script type="text/javascript">
      $("#HalfMenu-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}").click(function () {
         var button = $("#CartAddHalf{{ $HalfNHalfMenu->id }}");
         var data = JSON.parse(JSON.stringify(button.data('summary')));

         if (data.Size.ID != {{ $ItemSize->id }}) {
            data.MenuFirst = null;
            data.MenuSecond = null;
            data.Size.ID = {{ $ItemSize->id }};
            data.Size.Name = "{{ $ItemSize->name }}";
            button.data('summary', data);

            var dataID = "2-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}";
            button.data('id', dataID);
         }

         data["Menu{{$prefix}}"] = {};
         data["Menu{{$prefix}}"].ID = "{{ $Menu->id }}";
         data["Menu{{$prefix}}"].DataID = "{{ $Menu->id }}";
         data["Menu{{$prefix}}"].Name = "{{ ucwords($Menu->name) }}";
         data["Menu{{$prefix}}"].Price = {{ $MenuSize->price }};
         data["Menu{{$prefix}}"].TotalPrice = {{ $MenuSize->price }};
         data["Menu{{$prefix}}"].Addons = [];

         $('.HalfMenuSize-{{ $prefix }}-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}-{{ $Menu->id }}:checked').each(function (i, obj) {
            data["Menu{{$prefix}}"].Addons.push({
               "ID": $(this).data('id'),
               "Name": $(this).data('name'),
               "Price": $(this).data('price')
            });
            data["Menu{{$prefix}}"].TotalPrice += $(this).data('price');
            data["Menu{{$prefix}}"].DataID += "-" + $(this).data('id');
         });

         button.data('summary', data);
         
         @if($prefix == 'First')
         if (data.MenuSecond == null) {
            button.data('price', data.MenuFirst.TotalPrice);
            button.data('id', "2-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}_" + data["Menu{{$prefix}}"].DataID + "_");
         }
         @elseif($prefix == 'Second')
         if (data.MenuFirst == null) {
            button.data('price', data.MenuFirst.TotalPrice);
            button.data('id', "2-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}__" + data["Menu{{$prefix}}"].DataID);
         }
         @endif

         if (data.MenuFirst != null && data.MenuSecond != null) {
            button.data('price', data.MenuFirst.TotalPrice + data.MenuSecond.TotalPrice);
            button.data('id', "2-{{ $HalfNHalfMenu->id }}-{{ $ItemSize->id }}_" + data.MenuFirst.DataID + "_" + data.MenuSecond.DataID);
         }

         console.log(button.data());
         console.log();
      });
   </script>
@append