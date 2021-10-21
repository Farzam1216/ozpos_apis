@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app',
['activePage' => 'restaurant'] )

@if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))

@endif

@section('title', 'My Orders')

@section('content')

<section class="py-5 osahan-main-body">

        <!-- checkout -->
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3" style="top: 60px;">
                    <ul class="nav nav-tabsa custom-tabsa border-0 flex-column bg-white rounded overflow-hidden shadow-sm p-2 c-t-order"
                        id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link border-0 text-dark py-3 active" id="completed-tab" data-toggle="tab"
                                href="#completed" role="tab" aria-controls="completed" aria-selected="true">
                                <i class="feather-check mr-2 text-success mb-0"></i> Completed</a>
                        </li>
                        <li class="nav-item border-top" role="presentation">
                            <a class="nav-link border-0 text-dark py-3" id="progress-tab" data-toggle="tab" href="#progress"
                                role="tab" aria-controls="progress" aria-selected="false">
                                <i class="feather-clock mr-2 text-warning mb-0"></i> On Progress</a>
                        </li>
                        <li class="nav-item border-top" role="presentation">
                            <a class="nav-link border-0 text-dark py-3" id="canceled-tab" data-toggle="tab" href="#canceled"
                                role="tab" aria-controls="canceled" aria-selected="false">
                                <i class="feather-x-circle mr-2 text-danger mb-0"></i> Canceled</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content col-md-9" id="myTabContent" style="top: 60px;">
                    <div class="tab-pane fade show active" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <div class="order-body">

                          @forelse ($completeOrders as $complete)
                          <div class="pb-3">
                            <div class="p-3 rounded shadow-sm bg-white">
                                <div class="d-flex border-bottom pb-3">
                                    <div class="text-muted mr-3">

                                        <img alt="#" src="{{ asset($complete->vendor->image)}} " class="img-fluid order_img rounded">
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

                          @endforelse

                            {{-- <div class="pb-3">
                                <div class="p-3 rounded shadow-sm bg-white">
                                    <div class="d-flex border-bottom pb-3">
                                        <div class="text-muted mr-3">
                                            <img alt="#" src="img/popular4.png" class="img-fluid order_img rounded">
                                        </div>
                                        <div>
                                            <p class="mb-0 font-weight-bold"><a href="restaurant.html"
                                                    class="text-dark">Conrad Chicago Restaurant</a></p>
                                            <p class="mb-0">Punjab, India</p>
                                            <p>ORDER #321DERS</p>
                                            <p class="mb-0 small"><a href="status_complete.html">View Details</a></p>
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
                                            <span class="text-dark font-weight-bold">$12.74</span>
                                        </div>
                                        <div class="text-right">
                                            <a href="checkout.html" class="btn btn-primary px-3">Reorder</a>
                                            <a href="contact-us.html" class="btn btn-outline-primary px-3">Help</a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab" style="top: 60px;">
                        <div class="order-body">

                          @forelse ($pendingOrders as $pending)

                            <div class="pb-3">
                                <div class="p-3 rounded shadow-sm bg-white">
                                    <div class="d-flex border-bottom pb-3">
                                        <div class="text-muted mr-3">
                                          <img alt="#" src="{{ asset($pending->vendor->image)}} " class="img-fluid order_img rounded">
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
                                        {{-- <div class="text-right">
                                            <a href="status_onprocess.html" class="btn btn-primary px-3">Track</a>
                                            <a href="contact-us.html" class="btn btn-outline-primary px-3">Help</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                          @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab" style="top: 60px;">
                        <div class="order-body">
                            @forelse ($cancelOrders as $cancel)
                            <div class="pb-3">
                                <div class="p-3 rounded shadow-sm bg-white">
                                    <div class="d-flex border-bottom pb-3">
                                        <div class="text-muted mr-3">
                                          <img alt="#" src="{{ asset($cancel->vendor->image)}} " class="img-fluid order_img rounded">
                                        </div>
                                        <div>
                                            <p class="mb-0 font-weight-bold"><a href="restaurant.html"
                                                    class="text-dark">{{ $cancel->vendor->name }}</a></p>
                                            <p class="mb-0">{{ $cancel->vendor->address }}</p>
                                            <p>ORDER {{ $cancel->order_id }}</p>
                                            {{-- <p class="mb-0 small"><a href="status_canceled.html">View Details</a></p> --}}
                                        </div>
                                        <div class="ml-auto">
                                            <p class="bg-danger text-white py-1 px-2 rounded small mb-1">Payment failed</p>
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

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
@endsection
