@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app',
['activePage' => 'restaurant'] )


@if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
    @section('logo',)
    @section('subtitle','Live Tracking')
    @section('vendor_lat',)
    @section('vendor_lang',)
    @section('title',)
@else
    @section('title','Live Tracking')

@endif

<style>
  .map
  {
      position:absolute;
      overflow: show;
      height: 400px
  }
</style>
@section('content')
<div class="offer-section py-4">
  <div class="container position-relative">
     <div class="pt-3 text-white">
        <h2 class="font-weight-bold"></h2>
        <p class="text-white m-0"></p>
        <div class="rating-wrap d-flex align-items-center mt-2">
           <ul class="rating-stars list-unstyled">
              <li>

              </li>
           </ul>
        </div>
     </div>

  </div>
</div>
    <!-- SubHeader =============================================== -->

    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ url('/images/restaurant_cover_blur_10.jpg')}}" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <div id="sub_content">
                <h1>Live Tracking  <span><a  href="{{ url()->previous() }}" class="btn btn-danger btn-sm">
                  <i class="fa fa-arrow-circle-o-left"></i>
                  <span>Back</span>
              </a></span></h1>

              </a>
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    {{-- <li><a href="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}">{{ $order->name }}</a></li> --}}
                    <li>Live Tracking</li>
                @else
                    {{-- <li><a href="{{ route('customer.home.index')}}">Home</a></li> --}}
                    <li>Live Tracking</li>
                @endif
            </ul>
            <!-- <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a> -->
        </div>
    </div><!-- Position -->
    <div class="" id="collapseMap">
        <div id="track-map" class="map"></div>
    </div><!-- End Map -->


@endsection





@section('postScript')

<script type="text/javascript">
  const vendorLat = '{{$trackData["vendorLat"]}}';
  const vendorLang = '{{$trackData["vendorLang"]}}';
  const userLat = '{{$trackData["userLat"]}}';
  const userLang = '{{$trackData["userLang"]}}';
  const driverID = '{{$order->delivery_person_id}}';

</script>
<script type="module"  src="{{ asset('/customer/js/map_track.js')}}"></script>
    <script>
        $(document).ready(function(){
            var alerted = false;

            function trackSingleStatus()
            {
                $(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('.content')
                        }
                    });

                    $.ajax({
                        type:'GET',
                            @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                            url:"{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/get-order/{{$order->id}}",
                            @else
                            url:"{{ url('customer/get-order', $order->id) }}",
                            @endif
                           data:{},
                        success:function(order){
                            order = JSON.parse(order);
                            if(order.order_status != 'ACCEPT' && order.order_status != 'PICKUP')
                            {
                                // toastr.success("Order#"+order.id+" Order has been "+order.order_status+", redirecting...");
                                setTimeout(function() {
                                    @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                                      window.location.replace("{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/orders");
                                    @else
                                    window.location.replace("{{ url('customer/order-history') }}");
                                    @endif
                                }, 1000);
                            }

                            if(order.order_status == 'PICKUP' && !alerted)
                            {
                                //toastr.success('Order#'+order.id+' status updated.', 'Status Update');
                                alerted = true;
                            }
                        }
                    });
                });
            }
            setInterval( trackSingleStatus, 3000 );
        });
    </script>
@append
