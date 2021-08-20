@extends('frontend.layouts.app',['activePage' => 'restaurant'])

@section('title','Restaurants')
@section('content')

    <!-- SubHeader =============================================== -->
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ url('/images/restaurant_cover_blur_10.jpg')}}" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <div id="sub_content">
                <h1>Restaurants</h1>
                <!-- <div><i class="icon_pin"></i> 135 Newtownards Road, Belfast, BT4 1AB</div> -->
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{ route('customer.home.index')}}">Home</a></li>
                <li>Restaurants</li>
            </ul>
             <!-- <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a> -->
        </div>
    </div><!-- Position -->
    
    <!-- <div class="collapse" id="collapseMap">
        <div id="map" class="map"></div>
    </div> --><!-- End Map -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35">
        <div class="row">
        
            <div class="col-lg-3">
                <!-- <p>
                    <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
                </p> -->
                <div id="filters_col">
                    <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters <i class="icon-plus-1 float-right"></i></a>
                    <div class="collapse show" id="collapseFilters">
                        <div class="filter_type">
                            <!-- <h6>Distance</h6>
                            <input type="text" id="range" value="" name="range"> -->
                            <h6>Type</h6>
                            <ul>
                                <li><label><input type="checkbox" checked class="icheck">All <small>(49)</small></label></li>
                                <li><label><input type="checkbox" class="icheck">American <small>(12)</small></label><i class="color_1"></i></li>
                                <li><label><input type="checkbox" class="icheck">Chinese <small>(5)</small></label><i class="color_2"></i></li>
                                <li><label><input type="checkbox" class="icheck">Hamburger <small>(7)</small></label><i class="color_3"></i></li>
                                <li><label><input type="checkbox" class="icheck">Fish <small>(1)</small></label><i class="color_4"></i></li>
                                <li><label><input type="checkbox" class="icheck">Mexican <small>(49)</small></label><i class="color_5"></i></li>
                                <li><label><input type="checkbox" class="icheck">Pizza <small>(22)</small></label><i class="color_6"></i></li>
                                <li><label><input type="checkbox" class="icheck">Sushi <small>(43)</small></label><i class="color_7"></i></li>
                            </ul>
                        </div>
                        <div class="filter_type">
                            <h6>Rating</h6>
                            <ul>
                                <li><label><input type="checkbox" class="icheck"><span class="rating">
                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i>
                                </span></label></li>
                                <li><label><input type="checkbox" class="icheck"><span class="rating">
                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                                </span></label></li>
                                <li><label><input type="checkbox" class="icheck"><span class="rating">
                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </span></label></li>
                                <li><label><input type="checkbox" class="icheck"><span class="rating">
                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </span></label></li>
                                <li><label><input type="checkbox" class="icheck"><span class="rating">
                                <i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i>
                                </span></label></li>
                            </ul>
                        </div>
                        <!-- <div class="filter_type">
                            <h6>Options</h6>
                            <ul class="nomargin">
                                <li><label><input type="checkbox" class="icheck">Delivery</label></li>
                                <li><label><input type="checkbox" class="icheck">Take Away</label></li>
                                <li><label><input type="checkbox" class="icheck">Distance 10Km</label></li>
                                <li><label><input type="checkbox" class="icheck">Distance 5Km</label></li>
                            </ul>
                        </div> -->
                    </div><!--End collapse -->
                </div><!--End filters col-->
            </div><!--End col-md -->
            
            <div class="col-lg-9">
            
                <!-- <div id="tools">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-5">
                            <div class="styled-select">
                                <select name="sort_rating" id="sort_rating">
                                    <option value="" selected>Sort by ranking</option>
                                    <option value="lower">Lowest ranking</option>
                                    <option value="higher">Highest ranking</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-8 col-7">
                            <a href="grid_list.html" class="bt_filters"><i class="icon-th"></i></a>
                        </div>
                    </div>
                </div> --><!--End tools -->

                @foreach($enabledRest as $idx=>$rest)
                    <div class="strip_list wow fadeIn" data-wow-delay="{$idx+1}s">
                        @if($rest->isTop == 1)
                            <div class="ribbon_1">
                                Popular
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-9">
                                <div class="desc">
                                    <div class="thumb_strip">
                                        <a href="{{ route('customer.restaurant.get', $rest->id)}}">
                                            <img src="{{$rest->image}}" alt="" style="height: 100%;">
                                        </a>
                                    </div>
                                    <div class="rating">
                                        
                                        @for ($i = 0; $i < $rest->rate; $i++)
                                            <i class="icon_star voted"></i>
                                        @endfor

                                        @for ($i = 5; $i > $rest->rate; $i--)
                                            <i class="icon_star"></i>
                                        @endfor

                                        <!-- (<small><a href="#0">98 reviews</a></small>) -->
                                    </div>
                                    <h3>{{$rest->name}}</h3>
                                    <div class="type">
                                        {{$rest->map_address}}
                                    </div>
                                    <div class="location">
                                        {{$rest->address}}. <!-- <span class="opening">Opens at 17:00.</span> Minimum order: $15 -->
                                        <span class="opening">{{$rest->distance}}km far away</span>
                                    </div>
                                    <!-- <ul>
                                        <li>Take away<i class="icon_check_alt2 ok"></i></li>
                                        <li>Delivery<i class="icon_check_alt2 no"></i></li>
                                    </ul> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="go_to">
                                    <div>
                                        <a href="{{ route('customer.restaurant.get', $rest->id)}}" class="btn_1">View Menu</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End row-->
                    </div><!-- End strip_list-->
                @endforeach

                <!-- <a href="#0" class="load_more_bt wow fadeIn" data-wow-delay="0.2s">Load more...</a>   -->
            </div><!-- End col-md-9-->
            
        </div><!-- End row -->
    </div><!-- End container -->
    <!-- End Content =============================================== -->

@endsection