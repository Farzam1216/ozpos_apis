@extends('frontend.layouts.app',['activePage' => 'home'])

@section('title','Home')
@section('content')
<!--

{!!$topRest!!}

@php
    var_dump($topRest);
@endphp
-->
<!-- SubHeader =============================================== -->
<section class="header-video">
<div id="hero_video">
    <div id="sub_content">
        <h1>Order Takeaway or Delivery Food</h1>
        <p>
            Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
        </p>
        <form method="post" action="list_page.html">
            <div id="custom-search-input">
                <div class="input-group">
                    <input type="text" class=" search-query" placeholder="Your Address or postal code">
                    <span class="input-group-btn">
                    <input type="submit" class="btn_search" value="">
                    </span>
                </div>
            </div>
        </form>
    </div><!-- End sub_content -->
</div>
<img src="frontend/img/video_fix.png" alt="" class="header-video--media" data-video-src="" data-teaser-source="frontend/video/intro" data-provider="" data-video-width="1920" data-video-height="960">
<div id="count" class="d-none d-md-block">
    <ul>
        <li><span class="number">2650</span> Restaurant</li>
        <li><span class="number">5350</span> People Served</li>
        <li><span class="number">12350</span> Registered Users</li>
    </ul>
</div>
</section><!-- End Header video -->
<!-- End SubHeader ============================================ -->

<!-- Content ================================================== -->
<div class="container margin_60">
    <div class="main_title">
        <h2 class="nomargin_top">How it works</h2>
        <p>
            Cum doctus civibus efficiantur in imperdiet deterruisset.
        </p>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="box_home" id="one">
                <span>1</span>
                <h3>Search by address</h3>
                <p>
                    Find all restaurants available in your zone.
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="box_home" id="two">
                <span>2</span>
                <h3>Choose a restaurant</h3>
                <p>
                    We have more than 1000s of menus online.
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="box_home" id="three">
                <span>3</span>
                <h3>Pay by card or cash</h3>
                <p>
                    It's quick, easy and totally secure.
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="box_home" id="four">
                <span>4</span>
                <h3>Delivery - Takeaway</h3>
                <p>
                    You are lazy? Are you backing home?
                </p>
            </div>
        </div>
    </div><!-- End row -->
    <div id="delivery_time" class="d-none d-sm-block">
        <strong><span>2</span><span>5</span></strong>
        <h4>The minutes that usually takes to deliver!</h4>
    </div>
</div><!-- End container -->
<div class="white_bg">
    <div class="container margin_60">
        <div class="main_title">
            <h2 class="nomargin_top">Choose from Most Popular</h2>
            <p>
                Cum doctus civibus efficiantur in imperdiet deterruisset.
            </p>
        </div>
        <div class="row">
            <div class="col-lg-6">

                @foreach($topRest as $idx=>$rest)
                    @if($idx % 2 == 0)
                        <a href="{{ route('customer.restaurant.get', $rest->id)}}" class="strip_list">
                            <div class="ribbon_1">Popular</div>
                            <div class="desc">
                                <div class="thumb_strip">
                                    <img src="{{$rest->image}}" alt="" style="height: 100%;">
                                </div>
                                <div class="rating">

                                    @for ($i = 0; $i < $rest->rate; $i++)
                                        <i class="icon_star voted"></i>
                                    @endfor

                                    @for ($i = 5; $i > $rest->rate; $i--)
                                        <i class="icon_star"></i>
                                    @endfor

                                </div>
                                <h3>{{$rest->name}}</h3>
                                <div class="type">
                                    {{$rest->map_address}}
                                </div>
                                <div class="location">
                                    {{$rest->address}}. <!-- <span class="opening">Opens at 17:00</span> -->
                                    <span class="opening">{{$rest->distance}}km far away</span>
                                </div>
                                <!-- <ul>
                                    <li>Take away<i class="icon_check_alt2 ok"></i></li>
                                    <li>Delivery<i class="icon_check_alt2 ok"></i></li>
                                </ul> -->
                            </div><!-- End desc-->
                        </a><!-- End strip_list-->
                    @endif
                @endforeach

            </div>
            <div class="col-lg-6">

                @foreach($topRest as $idx=>$rest)
                    @if($idx % 2 != 0)
                        <a href="{{ route('customer.restaurant.get', $rest->id)}}" class="strip_list">
                            <div class="ribbon_1">Popular</div>
                            <div class="desc">
                                <div class="thumb_strip">
                                    <img src="{{$rest->image}}" alt="" style="height: 100%;">
                                </div>
                                <div class="rating">

                                    @for ($i = 0; $i < $rest->rate; $i++)
                                        <i class="icon_star voted"></i>
                                    @endfor

                                    @for ($i = 5; $i > $rest->rate; $i--)
                                        <i class="icon_star"></i>
                                    @endfor

                                </div>
                                <h3>{{$rest->name}}</h3>
                                <div class="type">
                                    {{$rest->map_address}}
                                </div>
                                <div class="location">
                                    {{$rest->address}}. <!-- <span class="opening">Opens at 17:00</span> -->
                                    <span class="opening">{{$rest->distance}}km far away</span>
                                </div>
                                <!-- <ul>
                                    <li>Take away<i class="icon_check_alt2 ok"></i></li>
                                    <li>Delivery<i class="icon_check_alt2 ok"></i></li>
                                </ul> -->
                            </div><!-- End desc-->
                        </a><!-- End strip_list-->
                    @endif
                @endforeach

            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</div><!-- End white_bg -->
<div class="high_light">
    <div class="container">
        <h3>Choose from over 2,000 Restaurants</h3>
        <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
        <a href="list_page.html">View all Restaurants</a>
    </div><!-- End container -->
</div><!-- End hight_light -->
<section class="parallax-window" data-parallax="scroll" data-image-src="frontend/img/bg_office.jpg" data-natural-width="1200" data-natural-height="600">
    <div class="parallax-content">
        <div class="sub_content">
            <i class="icon_mug"></i>
            <h3>We also deliver to your office</h3>
            <p>
                Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.
            </p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End Content =============================================== -->

<div class="container margin_60">
    <div class="main_title margin_mobile">
        <h2 class="nomargin_top">Work with Us</h2>
        <p>
            Cum doctus civibus efficiantur in imperdiet deterruisset.
        </p>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <a class="box_work" href="submit_restaurant.html">
                <img src="frontend/img/submit_restaurant.jpg" width="848" height="480" alt="" class="img-fluid">
                <h3>Submit your Restaurant<span>Start to earn customers</span></h3>
                <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
                <div class="btn_1">Read more</div>
            </a>
        </div>
        <div class="col-md-5">
            <a class="box_work" href="submit_driver.html">
                <img src="frontend/img/delivery.jpg" width="848" height="480" alt="" class="img-fluid">
                <h3>We are looking for a Driver<span>Start to earn money</span></h3>
                <p>Lorem ipsum dolor sit amet, ut virtute fabellas vix, no pri falli eloquentiam adversarium. Ea legere labore eam. Et eum sumo ocurreret, eos ei saepe oratio omittantur, legere eligendi partiendo pro te.</p>
                <div class="btn_1">Read more</div>
            </a>
        </div>
    </div><!-- End row -->
</div><!-- End container -->

@endsection

@section('script')
    <script src="{{ url('/frontend/js/video_header.js')}}"></script>
    <script>
    $(document).ready(function() {
        'use strict';
          HeaderVideo.init({
          container: $('.header-video'),
          header: $('.header-video--media'),
          videoTrigger: $("#video-trigger"),
          autoPlayVideo: true
        });
    });
    </script>
@endsection