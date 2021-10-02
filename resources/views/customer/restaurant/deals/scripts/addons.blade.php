@section('postScript')
   <script type="text/javascript">
      $(".DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}").change(function () {
         let groupMenuAddonId = $(this).data('group_menu_addon_id');
         let checkedCheckBox = $('.DealsMenuCheckbox-{{ $DealsMenu->id }}-{{ $DealsItems->id }}-{{ $Menu->id }}-'+groupMenuAddonId+':checked');
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