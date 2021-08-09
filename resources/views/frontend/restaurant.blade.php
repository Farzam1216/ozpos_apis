@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'frontend.layouts.app_restaurant' : 'frontend.layouts.app', ['activePage' => 'restaurant'] )

@section('title',$rest->name)
@section('content')

    <!-- SubHeader =============================================== -->
    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('/images/restaurant_cover_blur_10.jpg')}}" data-natural-width="1400" data-natural-height="470">
        <div id="subheader">
            <div id="sub_content">
                <div id="thumb"><img src="{{$rest->image}}" alt="" style="height: calc(100% - 6px);"></div>
                <div class="rating">
                    
                    @for ($i = 0; $i < $rest->rate; $i++)
                        <i class="icon_star voted"></i>
                    @endfor

                    @for ($i = 5; $i > $rest->rate; $i--)
                        <i class="icon_star"></i>
                    @endfor

                    <!-- (<small><a href="detail_page_2.html">Read 98 reviews</a></small>) -->
                </div>
                <h1>{{$rest->name}}</h1>
                <div><em>{{$rest->map_address}}</em></div>
                <div><i class="icon_pin"></i> {{$rest->address}} <!-- <strong>Delivery charge:</strong> $10, free over $15.</div> -->
            </div><!-- End sub_content -->
        </div><!-- End subheader -->
    </section><!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div id="position">
        <div class="container">
            <ul>
                <li><a href="{{ route('customer.home.index')}}">Home</a></li>
                <li><a href="{{ route('customer.restaurant.index')}}">Restaurants</a></li>
                <li>{{$rest->name}}</li>
            </ul>
            <!-- <a href="#0" class="search-overlay-menu-btn"><i class="icon-search-6"></i> Search</a> -->
        </div>
    </div><!-- Position -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-3">
                <!-- <p><a href="list_page.html" class="btn_side">Back to search</a></p> -->
                <div class="box_style_1">
                    <ul id="cat_nav">

                        @foreach($singleVendor['menu'] as $idx=>$menu)
                            
                            <li>
                                <a href="#{{str_replace(' ', '_', $menu->name)}}" class="active">
                                    {{ucwords($menu->name)}}
                                    <span>({{count($menu->submenu)}})</span>
                                </a>
                            </li>

                        @endforeach
                    </ul>
                </div><!-- End box_style_1 -->
                <div class="box_style_2 d-none d-sm-block" id="help">
                    <i class="icon_lifesaver"></i>
                    <h4>Need <span>Help?</span></h4>
                    <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                    <small>Monday to Friday 9.00am - 7.30pm</small>
                </div>
            </div><!-- End col -->
            <div class="col-lg-6">
                <div class="box_style_2" id="main_menu">
                    <h2 class="inner">Menu</h2>

                    @foreach($singleVendor['menu'] as $idx=>$menu)
                            
                        <h3 class="nomargin_top" id="{{str_replace(' ', '_', $menu->name)}}">{{ucwords($menu->name)}}</h3>
                        <!-- <p>Category information in 2 lines.</p> -->
                        <table class="table table-striped cart-list">
                            <thead>
                                <tr>
                                    <th>
                                        Item
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Order
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($menu->submenu as $idx2=>$submenu)
                                    <tr>
                                        <td>
                                            <figure class="thumb_menu_list"><img src="{{$submenu->image}}" alt="thumb"></figure>
                                            <h5>{{$idx2 + 1}}. {{ucwords($submenu->name)}}</h5>
                                            <!-- <p>Category information in 2 lines.</p> -->
                                            
                                            @if(count($submenu->custimization) > 0)
                                                <p>Customizable</p>
                                            @endif

                                        </td>
                                        <td>
                                            <strong>{{$submenu->price}} {{ App\Models\GeneralSetting::first()->currency }}</strong>
                                        </td>
                                        @if(count($submenu->custimization) == 0)
                                            <td class="options">
                                                <a class="item_add_to_cart" data-extra-status="0" data-item-id="{{$submenu->id}}" data-vendor-id="{{$rest->id}}"><i class="icon_plus_alt2"></i></a>
                                            </td>
                                        @else
                                            <td class="options">
                                                <div class="dropdown dropdown-options">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                                                    <div class="dropdown-menu">
                                                        <h5>Customization</h5>

                                                        @foreach($submenu->custimization as $idx3=>$custimization)
                                                            <h5>{{ucwords($custimization->name)}}</h5>
                                                            @if(json_decode($custimization->custimazation_item) != NULL)
                                                                @foreach(json_decode($custimization->custimazation_item) as $idx4=>$custimazation_item)
                                                                    @if($custimazation_item->status == 1)
                                                                        <label>
                                                                            <input type="radio" name="custimization_{{$submenu->id}}_{{$idx3}}" value="{{json_encode(array('main_menu'=>$custimization->name,'data'=>array('name'=>$custimazation_item->name, 'price'=>$custimazation_item->price)))}}" @if($custimazation_item->isDefault == 1) checked @endif>
                                                                            {{ucwords($custimazation_item->name)}}
                                                                            <span>+ {{$custimazation_item->price}} {{ App\Models\GeneralSetting::first()->currency }}</span>
                                                                        </label>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                                        <a class="item_add_to_cart add_to_basket" data-extra-status="1" data-extra-items="{{count((array)json_decode($submenu->custimization))}}" data- data-item-id="{{$submenu->id}}" data-vendor-id="{{$rest->id}}">Add to cart</a>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                        <!-- <td class="options">
                                            <div class="dropdown dropdown-options">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="icon_plus_alt2"></i></a>
                                                <div class="dropdown-menu">
                                                    <h5>Select an option</h5>
                                                    <label>
                                                        <input type="radio" value="option1" name="options_1" checked>Medium <span>+ $3.30</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" value="option2" name="options_1">Large <span>+ $5.30</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" value="option3" name="options_1">Extra Large <span>+ $8.30</span>
                                                    </label>
                                                    <h5>Add ingredients</h5>
                                                    <label>
                                                        <input type="checkbox" value="">Extra Tomato <span>+ $4.30</span>
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" value="">Extra Peppers <span>+ $2.50</span>
                                                    </label>
                                                    <a href="#0" class="add_to_basket">Add to cart</a>
                                                </div>
                                            </div>
                                        </td> -->
                                        <!-- <td class="options">
                                            <a href="#0"><i class="icon_plus_alt2"></i></a>
                                        </td> -->
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <hr>

                    @endforeach

                </div><!-- End box_style_1 -->
            </div><!-- End col -->
            <div class="col-lg-3" id="sidebar">
                <div class="theiaStickySidebar">
                    
                    @include('frontend.layouts.cart', ['page' => route('customer.restaurant.order.first.index', request()->route('id'))])

                </div><!-- End theiaStickySidebar -->
            </div><!-- End col -->
        </div><!-- End row -->
    </div><!-- End container -->
    <!-- End Content =============================================== -->

@endsection