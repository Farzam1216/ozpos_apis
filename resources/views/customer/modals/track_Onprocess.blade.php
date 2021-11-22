<section class="bg-white osahan-main-body rounded shadow-sm overflow-hidden">
  <div class="container p-0">
      <div class="row">
          <div class="col-lg-12">
              <div class="osahan-status">
                  <!-- status complete -->
                  <div class="p-3 status-order border-bottom bg-white">
                      <p class="small m-0"><i class="feather-calendar text-primary"></i> 16 June, 11:30AM</p>
                  </div>
                  <div class="p-3 border-bottom">
                      <div class="d-flex">
                          <h6 class="font-weight-bold">Order Status</h6>
                          @if($order->order_status == 'PENDING')
                          <span class="ml-auto"><h6 class="font-weight-bold" style="color: #007bff">Order Pending</h6></span>
                          @else
                              @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))

                              <span class="ml-auto"><a href="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/track-order/{{$order->id}}" class="btn btn-primary">Track on map</a></span>
                              @else

                              <span class="ml-auto"><a href="{{ url('customer/track-order',$order->id)}}" class="btn btn-primary">Track on map</a></span>
                              @endif
                          @endif
                      </div>
                      <div class="tracking-wrap">
                        @if($order->order_status == 'PENDING')
                          <div class="my-1 step "><span class="icon text-danger"><i class="feather-x-circle"></i></span><span class="text small">Approved</span> </div>
                          <div class="my-1 step"> <span class="icon text-danger"><i class="feather-x-circle"></i></span><span class="text small">Driver assigned</span></div>
                          <div class="my-1 step"> <span class="icon text-danger"><i class="feather-x-circle"></i></span> <span class="text small">Picked by driver </span></div>
                          <div class="my-1 step"><span class="icon text-danger"><i class="feather-x-circle"></i></span><span class="text small">Delivered</span> </div>
                          @elseif($order->order_status == 'APPROVE')
                          <div class="my-1 step active"><span class="icon text-success"><i class="feather-check-circle"></i></span><span class="text small">Preparing order</span> </div>
                          <div class="my-1 step"> <span class="icon text-danger"><i class="feather-x-circle"></i></span><span class="text small">Driver assigned</span></div>
                          <div class="my-1 step"> <span class="icon text-danger"><i class="feather-x-circle"></i></span> <span class="text small">Picked by driver</span></div>
                          <div class="my-1 step"><span class="icon text-danger"><i class="feather-x-circle"></i></span><span class="text small">Delivered Order</span> </div>
                          @elseif($order->order_status == 'ACCEPT')
                          <div class="my-1 step active"><span class="icon text-success"><i class="feather-check-circle"></i></span><span class="text small">Preparing order</span> </div>
                          <div class="my-1 step active"> <span class="icon text-success"><i class="feather-check-circle"></i></span><span class="text small">Driver assigned</span></div>
                          <div class="my-1 step"> <span class="icon text-danger"><i class="feather-x-circle"></i></span> <span class="text small">Picked by driver</span></div>
                          <div class="my-1 step"><span class="icon text-danger"><i class="feather-x-circle"></i></span><span class="text small">Delivered Order</span> </div>
                          @elseif($order->order_status == 'PICKUP')
                          <div class="my-1 step active"><span class="icon text-success"><i class="feather-check-circle"></i></span><span class="text small">Preparing order</span> </div>
                          <div class="my-1 step active"> <span class="icon text-success"><i class="feather-check-circle"></i></span><span class="text small">Driver assigned</span></div>
                          <div class="my-1 step active"> <span class="icon text-success"><i class="feather-check-circle"></i></span> <span class="text small">Picked by driver</span></div>
                          <div class="my-1 step"><span class="icon text-danger"><i class="feather-x-circle"></i></span><span class="text small">Delivered Order</span> </div>
                          @elseif($order->order_status == 'DELIVERED' || $order->order_status == 'COMPLETE')
                          <div class="my-1 step active"> <span class="icon text-success"><i class="feather-check-circle"></i></span><span class="text small">Preparing order</span></div>
                          <div class="my-1 step active"> <span class="icon text-success"><i class="feather-check-circle"></i></span><span class="text small">Driver assigned</span></div>
                          <div class="my-1 step active"> <span class="icon text-success"><i class="feather-check-circle"></i></span> <span class="text small">Picked by driver</span></div>
                          <div class="my-1 step active"><span class="icon text-success"><i class="feather-check-circle"></i></span><span class="text small">Delivered Order</span> </div>
                          @elseif($order->order_status == 'CANCEL')
                          <div class="my-1 step active"> <span class="icon text-danger"><i class="feather-x-circle"></i></span> <span class="text small">Order canceled</span></div>

                          @elseif($order->order_status == 'REJECT')
                          <div class="my-1 step active"><span class="icon text-danger"><i class="feather-x-circle"></i></span><span class="text small">Order rejected</span> </div>
                          @endif
                      </div>
                  </div>
                  <!-- Destination -->
                  <div class="p-3 border-bottom bg-white">
                      <h6 class="font-weight-bold">Destination</h6>
                      <p class="m-0 small">{{$order->userAddress->address}}</p>
                  </div>
                  <div class="p-3 border-bottom">
                      <p class="font-weight-bold small mb-1">Courier</p>
                      <img alt="#" src="img/logo_web.png" class="img-fluid sc-osahan-logo mr-2"> <span class="small text-primary font-weight-bold">Swiggiweb Courier
              </span>
                  </div>
                  <!-- total price -->
                  <!-- Destination -->
                  <div class="p-3 border-bottom bg-white">
                      <div class="d-flex align-items-center mb-2">
                          <h6 class="font-weight-bold mb-1">Total Cost</h6>
                          <h6 class="font-weight-bold ml-auto mb-1">${{$order->amount}}</h6>
                      </div>
                      <p class="m-0 small text-muted">You can check your order detail here,<br>Thank you for order.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
