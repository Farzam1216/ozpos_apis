@extends('frontend.layouts.app',['activePage' => 'orders'])

@section('title','Orders')
@section('content')
{{--{!!$orders!!}--}}
    <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ url('/images/restaurant_cover_blur_10.jpg')}}" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <div id="sub_content">
                <h1>Orders</h1>
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{ route('customer.home.index')}}">Home</a></li>
                <li>Orders</li>
            </ul>
            <!-- <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a> -->
        </div>
    </div><!-- Position -->

    <!-- <div class="collapse" id="collapseMap">
        <div id="map" class="map"></div>
    </div> --><!-- End Map -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35 customOrders">
        @foreach($orders as $order)
            <div class="row">
                <div class="col-4">
                    <img src="{{$order->vendor['vendor_logo']}}" />
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-12 col-sm-8">
                            <h5 class="heading">{{$order->vendor['name']}}</h5>
                        </div>
                        <div class="col-4 col-sm-4 right">
                            <h5 class="price">{{$order->amount}} {{ App\Models\GeneralSetting::first()->currency }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>{{$order->vendor['address']}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>{{$order->date}}, {{$order->time}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="autoload-{{$order->id}}" data-status="{{$order->order_status}}">
                <div class="row" id="orderStatus-{{$order->id}}">
                    <div class="col-12">
                        <div class="track">
                            @if($order->order_status == 'PENDING')
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order approved</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                            @elseif($order->order_status == 'APPROVE')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order approved</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                            @elseif($order->order_status == 'PICKUP')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order approved</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                            @elseif($order->order_status == 'DELIVERED')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order approved</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                            @elseif($order->order_status == 'COMPLETE')
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order approved</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                            @elseif($order->order_status == 'CANCEL')
                                <div class="step active"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Order canceled</span> </div>
                            @elseif($order->order_status == 'REJECT')
                                <div class="step active"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Order rejected</span> </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div><!-- End container -->
    <!-- End Content =============================================== -->

@endsection


@section('script')
    <script>
        $(document).ready(function(){
            function trackStatus()
            {
                $(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('.content')
                        }
                    });

                    $.ajax({
                        type:'GET',
                        url:"{{ route('customer.orders.get') }}",
                        data:{},
                        success:function(orders){
                            // console.log(orders);
                            $.each(JSON.parse(orders), function(index, order) {
                                // console.log(order.id);
                                var previousStatus = $('#autoload-'+order.id).data("status");
                                if(previousStatus != order.order_status)
                                {
                                    // console.log(previousStatus);
                                    // console.log(order.order_status);
                                    $('#autoload-'+order.id).load(document.URL +  ' #orderStatus-'+order.id, function(){
                                        $('#autoload-'+order.id).data("status", order.order_status);
                                        toastr.success('Order#'+order.id+' status updated.', 'Status Update');
                                    });
                                }
                            });
                        }
                    });
                });
            }

            setInterval( trackStatus, 1000 );
        });
    </script>
@endsection
