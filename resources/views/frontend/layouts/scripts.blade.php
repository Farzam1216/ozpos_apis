@if(session()->has('delivery_type') == null || session()->get('delivery_type') == null)
    <script type="text/javascript">
        $(document).ready(function() {       
            $('#delivery_type_modal').modal('show');
        }); 
    </script>
@elseif(session()->has('delivery_location') == null || session()->get('delivery_location') == null)
    <script type="text/javascript">
        $(document).ready(function() {       
            $('#delivery_location_modal').modal('show');
        }); 
    </script>
@endif

<!-- 
<script type="text/javascript">  
    $(document).on('ifChecked ifUnchecked', '.update_delivery_type', function(e){
        if ($(this).attr('name') == 'delivery_type_home') {
            $("input[name=delivery_type_home]").iCheck('check');
            $("input[name=delivery_type_shop]").iCheck('uncheck');
        }
        if ($(this).attr('name') == 'delivery_type_shop') {
            $("input[name=delivery_type_home]").iCheck('uncheck');
            $("input[name=delivery_type_shop]").iCheck('check');
        }
    });
</script> -->