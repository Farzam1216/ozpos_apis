@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app',
['activePage' => 'restaurant'] )

@if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))

@endif

@section('title', 'Himalaya Falooda & Sweets | My Order')

@section('content')

    <section class="py-5 osahan-main-body">

        <!-- checkout -->
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3" style="top: 60px;">
                    <ul class="nav nav-tabsa custom-tabsa border-0 flex-column bg-white rounded overflow-hidden shadow-sm p-2 c-t-order"
                        id="myTab" role="tablist">
                        <li class="nav-item border-top" role="presentation">
                            <a class="nav-link border-0 text-dark py-3 active" id="progress-tab" data-toggle="tab" href="#progress"
                                role="tab" aria-controls="progress" aria-selected="true">
                                <i class="feather-clock mr-2 text-warning mb-0"></i> On Progress</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link border-0 text-dark py-3 " id="completed-tab" data-toggle="tab"
                                href="#completed" role="tab" aria-controls="completed" aria-selected="false">
                                <i class="feather-check mr-2 text-success mb-0"></i> Completed</a>
                        </li>

                        <li class="nav-item border-top" role="presentation">
                            <a class="nav-link border-0 text-dark py-3" id="canceled-tab" data-toggle="tab" href="#canceled"
                                role="tab" aria-controls="canceled" aria-selected="false">
                                <i class="feather-x-circle mr-2 text-danger mb-0"></i> Canceled</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content col-md-9" id="myTabContent" style="top: 60px;">
                    <div class="tab-pane fade show " id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <div class="order-body">

                            @forelse ($completeOrders as $complete)
                                <div class="pb-3">
                                    <div class="p-3 rounded shadow-sm bg-white">
                                        <div class="d-flex border-bottom pb-3">
                                            <div class="text-muted mr-3">

                                                <img alt="#" src="{{ asset($complete->vendor->image) }} "
                                                    class="img-fluid order_img rounded">
                                            </div>
                                            <div>
                                                <p class="mb-0 font-weight-bold"><a href="restaurant.html"
                                                        class="text-dark">{{ $complete->vendor->name }}</a></p>
                                                <p class="mb-0">{{ $complete->vendor->address }}</p>
                                                <p>ORDER {{ $complete->order_id }}</p>
                                                {{-- <p class="mb-0 small"><a href="status_complete.html">View Details</a></p> --}}
                                            </div>
                                            <div class="ml-auto">
                                                <p class="bg-success text-white py-1 px-2 rounded small mb-1">Delivered</p>
                                                <p class="small font-weight-bold text-center"><i class="feather-clock"></i>
                                                    06/04/2020</p>
                                            </div>
                                        </div>
                                        <div class="d-flex pt-3">
                                            <div class="small">
                                                <p class="text- font-weight-bold mb-0">Kesar Sweet x 1</p>
                                                <p class="text- font-weight-bold mb-0">Gulab Jamun x 4</p>
                                            </div>
                                            <div class="text-muted m-0 ml-auto mr-3 small">Total Payment<br>
                                                <span class="text-dark font-weight-bold">$ {{ $complete->amount }}</span>
                                            </div>
                                            {{-- <div class="text-right">
                                        <a href="checkout.html" class="btn btn-primary px-3">Reorder</a>
                                        <a href="contact-us.html" class="btn btn-outline-primary px-3">Help</a>
                                    </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div>
                                    <p class="mb-0 font-weight-bold text-center">No completed order are availables yet ...
                                    </p>
                                </div>

                            @endforelse


                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="progress" role="tabpanel" aria-labelledby="progress-tab"
                        style="top: 60px;">
                        <div class="order-body" id="track-order">

                            @forelse ($pendingOrders as $pending)

                                <div class="pb-3">
                                    <div class="p-3 rounded shadow-sm bg-white">
                                        <div class="d-flex border-bottom pb-3">
                                            <div class="text-muted mr-3">
                                                <img alt="#" src="{{ asset($pending->vendor->image) }} "
                                                    class="img-fluid order_img rounded">
                                            </div>
                                            <div>
                                                <p class="mb-0 font-weight-bold"><a href="restaurant.html"
                                                        class="text-dark">{{ $pending->vendor->name }}</a></p>
                                                <p class="mb-0">{{ $pending->vendor->address }}</p>
                                                <p>ORDER {{ $pending->order_id }}</p>
                                                {{-- <p class="mb-0 sma?ll"><a href="status_onprocess.html">View Details</a></p> --}}
                                            </div>
                                            <div class="ml-auto">
                                                <p class="bg-warning text-white py-1 px-2 rounded small mb-1">On Process</p>
                                                <p class="small font-weight-bold text-center"><i class="feather-clock"></i>
                                                    06/04/2020</p>
                                            </div>
                                        </div>
                                        <div class="d-flex pt-3">
                                            <div class="small">
                                                <p class="text- font-weight-bold mb-0">Kesar Sweet x 1</p>
                                                <p class="text- font-weight-bold mb-0">Gulab Jamun x 4</p>
                                            </div>
                                            <div class="text-muted m-0 ml-auto mr-3 small">Total Payment<br>
                                                <span class="text-dark font-weight-bold">${{ $pending->amount }}</span>
                                            </div>

                                            <div class="text-right">
                                                <button class="btn btn-primary px-3"
                                                    onclick="orderTrack('{{ $pending->id }}')">Order Status</button>
                                                {{-- <a href="contact-us.html" class="btn btn-outline-primary px-3">Help</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty

                                <div>
                                    <p class="mb-0 font-weight-bold text-center">No pendding order are availables yet ...
                                    </p>
                                </div>

                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab"
                        style="top: 60px;">
                        <div class="order-body">
                            @forelse ($cancelOrders as $cancel)
                                <div class="pb-3">
                                    <div class="p-3 rounded shadow-sm bg-white">
                                        <div class="d-flex border-bottom pb-3">
                                            <div class="text-muted mr-3">
                                                <img alt="#" src="{{ asset($cancel->vendor->image) }} "
                                                    class="img-fluid order_img rounded">
                                            </div>
                                            <div>
                                                <p class="mb-0 font-weight-bold"><a href="restaurant.html"
                                                        class="text-dark">{{ $cancel->vendor->name }}</a></p>
                                                <p class="mb-0">{{ $cancel->vendor->address }}</p>
                                                <p>ORDER {{ $cancel->order_id }}</p>
                                                {{-- <p class="mb-0 small"><a href="status_canceled.html">View Details</a></p> --}}
                                            </div>
                                            <div class="ml-auto">
                                                <p class="bg-danger text-white py-1 px-2 rounded small mb-1">Payment failed
                                                </p>
                                                <p class="small font-weight-bold text-center"><i class="feather-clock"></i>
                                                    06/04/2020</p>
                                            </div>
                                        </div>
                                        <div class="d-flex pt-3">
                                            <div class="small">
                                                <p class="text- font-weight-bold mb-0">Kesar Sweet x 1</p>
                                                <p class="text- font-weight-bold mb-0">Gulab Jamun x 4</p>
                                            </div>
                                            <div class="text-muted m-0 ml-auto mr-3 small">Total Payment<br>
                                                <span class="text-dark font-weight-bold">${{ $cancel->amount }}</span>
                                            </div>
                                            {{-- <div class="text-right">
                                            <a href="contact-us.html" class="btn btn-outline-primary px-3">Help</a>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div>
                                    <p class="mb-0 font-weight-bold text-center">No any Cancel order are availables yet ...
                                    </p>
                                </div>

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('postScript')
    <script>
        function orderTrack(order_id) {
            // alert(order_id);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "get",
                @if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                    url:"{{ isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' }}://{{ $_SERVER['HTTP_X_FORWARDED_HOST'] }}/get-orderModel/"+order_id,
                @else
                    // url:"{{ url('customer/restaurant/book-order', request()->route('id')) }}",
                    url: "{{ url('customer/get-orderModel') }}/" + order_id,
                @endif
                success: function(result) {
                    $("#track-order").html(result)
                },
                error: function(err) {

                }
            });

        }
    </script>
@append
