<!-- Header ================================================== -->
<header>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-4">
            <a href="index.html" id="logo">
                <img src="{{ url('/frontend/img/logo.png')}}" width="190" height="23" alt="" class="d-none d-sm-block">
                <img src="{{ url('/frontend/img/logo_mobile.png')}}" width="59" height="23" alt="" class="d-block d-sm-none">
            </a>
        </div>
        <nav class="col-md-8 col-sm-8 col-8">
        <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
        <div class="main-menu">
            <div id="header_menu">
                <img src="{{ url('/frontend/img/logo.png')}}" width="190" height="23" alt="">
            </div>
            <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
            {{--  <ul>
                <li><a href="{{ route('customer.home.index')}}">Home</a></li>
                <li><a href="{{ route('customer.restaurant.index')}}">Restaurants</a></li>
                <li><a href="about.html">About us</a></li>
                <li><a href="faq.html">Faq</a></li>
                <li>
                    @if(Auth::user() && Auth::user()->load('roles')->roles->contains('title', 'user'))
                        <li class="submenu">
                            <a href="javascript:void(0);" class="show-submenu">My Account<i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="{{ route('customer.orders.index') }}">Orders</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <a href="#0" data-toggle="modal" data-target="#login_2">Login</a>
                    @endif
                </li>
                <!-- <li><a href="#0">Purchase this template</a></li> -->
            </ul>  --}}
        </div><!-- End main-menu -->
        </nav>
    </div><!-- End row -->
</div><!-- End container -->
</header>
<!-- End Header ===============================================
