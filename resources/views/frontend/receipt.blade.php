@extends('frontend.layouts.app',['activePage' => 'order'])

@section('title','Receipt')
@section('content')

<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ url('/images/restaurant_cover_blur_10.jpg')}}" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Place your order</h1>
            <div class="bs-wizard row">
                <div class="col-4 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum"><strong>1.</strong> Your details</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart.html" class="bs-wizard-dot"></a>
                </div>
                <div class="col-4 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum"><strong>2.</strong> Payment</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart_2.html" class="bs-wizard-dot"></a>
                </div>
                <div class="col-4 bs-wizard-step complete">
                    <div class="text-center bs-wizard-stepnum"><strong>3.</strong> Finish!</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="#0" class="bs-wizard-dot"></a>
                </div>
            </div><!-- End bs-wizard -->
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="{{ route('customer.home.index')}}">Home</a></li>
            <li><a href="{{ route('customer.restaurant.index')}}">Restaurants</a></li>
            <li><a href="{{ route('customer.restaurant.get', session()->get('cart_vendor_id'))}}">{{ App\Models\Vendor::where('id', session()->get('cart_vendor_id'))->first()->name }}</a></li>
            <li>Order</li>
            <li>Completed</li>
        </ul>
        <!-- <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a> -->
    </div>
</div><!-- Position -->

<!-- Content ================================================== -->
<div class="container margin_60_35">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box_style_2">
                <h2 class="inner">Order confirmed!</h2>
                <div id="confirm">
                    <i class="icon_check_alt2"></i>
                    <h3>Thank you!</h3>
                    <p>
                        Lorem ipsum dolor sit amet, nostrud nominati vis ex, essent conceptam eam ad. Cu etiam comprehensam nec. Cibo delicata mei an, eum porro legere no.
                    </p>
                </div>
                <h4>Summary</h4>
                <table class="table table-striped nomargin">
                    <tbody>

                    	@foreach($cartContent as $row)
		                    <tr>
		                        <td>
		                        	<strong>{{$row->qty}}x</strong> {{$row->name}}
		                        </td>
		                        <td>
		                            <strong class="float-right">{{$row->price}} AD</strong>
		                        </td>
		                    </tr>
		                @endforeach

                        <!-- <tr>
                            <td>
                                Delivery schedule <a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="Please consider 30 minutes of margin for the delivery!"><i class="icon_question_alt"></i></a>
                            </td>
                            <td>
                                <strong class="float-right">Today 07.30 pm</strong>
                            </td>
                        </tr> -->
                        <tr>
                            <td class="total_confirm">
                                TOTAL
                            </td>
                            <td class="total_confirm">
                                <span class="float-right">{{$cartSubTotal}} AD</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- End row -->
</div><!-- End container -->
<!-- End Content =============================================== -->

@endsection