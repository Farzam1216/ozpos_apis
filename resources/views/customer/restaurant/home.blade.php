
@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app', ['activePage' => 'restaurant'] )

@if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
   @section('logo',$rest->vendor_logo)
   @section('subtitle','Menu')
   @section('vendor_lat',$rest->lat)
   @section('vendor_lang',$rest->lang)
@endif

@section('title',$rest->name)


<style>
 .mySlides {display: none;}

img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {

  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fadess {
  -webkit-animation-name: fadess;
  -webkit-animation-duration: 1.5s;
  animation-name: fadess;
  animation-duration: 1.5s;
}

@-webkit-keyframes fadess {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fadess {
  from {opacity: .4}
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}

.slick-slide
{
  height: auto ! important;
}
</style>
@section('content')

<div class="offer-section py-4">
  <div class="container position-relative">
     <img alt="#" src="{{ $rest->image }}" class="restaurant-pic">
     <div class="pt-3 text-white">
        <h2 class="font-weight-bold">{{ $rest->name }}</h2>
        <p class="text-white m-0">{{ $rest->address }}</p>
        <div class="rating-wrap d-flex align-items-center mt-2">
           <ul class="rating-stars list-unstyled">
              <li>
                 @for ($i = 0; $i < $rest->rate; $i++)
                    <i class="feather-star text-warning"></i>
                 @endfor

                 @for ($i = 5; $i > $rest->rate; $i--)
                    <i class="feather-star"></i>
                 @endfor
              </li>
           </ul>
           {{--                    <p class="label-rating text-white ml-2 small"> (245 Reviews)</p>--}}
        </div>
     </div>
     {{--            <div class="pb-4">--}}
     {{--                <div class="row">--}}
     {{--                    <div class="col-6 col-md-2">--}}
     {{--                        <p class="text-white-50 font-weight-bold m-0 small">Delivery</p>--}}
     {{--                        <p class="text-white m-0">Free</p>--}}
     {{--                    </div>--}}
     {{--                    <div class="col-6 col-md-2">--}}
     {{--                        <p class="text-white-50 font-weight-bold m-0 small">Open time</p>--}}
     {{--                        <p class="text-white m-0">8:00 AM</p>--}}
     {{--                    </div>--}}
     {{--                </div>--}}
     {{--            </div>--}}
  </div>
</div>
    <div class="osahan-home-page">

    <div class="container">
    <div class="slideshow-container">
      @foreach ($slider as $slid)
      <div class="mySlides fadess">
        <div class="numbertext">1 / 3</div>
        <img src="{{asset($slid->image)}}" style=" width: 100%;height: 50%;">
        <div class="text" style="color: black"><h5><b>{{$slid->description}}</b></h5></div>
      </div>
      @endforeach
      </div>
      <br>

      <div style="text-align:center">
        @foreach ($slider as $slid)
        <span class="dot"></span>
        @endforeach
      </div>
      </div>


      <!-- Filters -->
      <div class="container">
          <div class="cat-slider">
            @forelse ($itemCategory as $item)
            <div class="cat-item px-1 py-3">
              <a class="bg-white rounded d-block p-2 text-center shadow-sm" href="trending.html">
                  <img alt="#" src="{{asset('customer/img/icons/Fries.png')}}" class="img-fluid mb-2">
                  <p class="m-0 small">{{ $item->name }}</p>
              </a>
          </div>
            @empty

            @endforelse


          </div>
      </div>

      <div class="container">
          <!-- Trending this week -->
          <div class="pt-4 pb-2 title d-flex align-items-center">
              <h5 class="m-0">Deals</h5>
              <a class="font-weight-bold ml-auto" href="trending.html">View all <i class="feather-chevrons-right"></i></a>
          </div>
          <!-- slider -->
          <div class="trending-slider">

            @foreach ($deals as $deal)
            @foreach ($deal->DealsMenu as $value)

            <div class="osahan-slider-item">
              <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                  <div class="list-card-image">
                      <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                      <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                      <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                      <a href="restaurant.html">
                          <img alt="#" src="{{asset($value->image)}}" class="img-fluid item-img w-100">
                      </a>
                  </div>
                  <div class="p-3 position-relative">
                      <div class="list-card-body">
                          <h6 class="mb-1"><a href="restaurant.html" class="text-black">{{ $value->name }}
                        </a>
                          </h6>
                          <p class="text-gray mb-3">Vegetarian • Indian • Pure veg</p>
                          <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–30 min</span> <span class="float-right text-black-50"> $350 FOR TWO</span></p>
                      </div>
                      <div class="list-card-badge">
                          <span class="badge badge-danger">{{$value->display_price }}</span> <small> {{$value->display_discount_price}}</small>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
            @endforeach

              {{-- <div class="osahan-slider-item">
                  <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                      <div class="list-card-image">
                          <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                          <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                          <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                          <a href="restaurant.html">
                              <img alt="#" src="{{asset('customer/img/trending2.png')}}" class="img-fluid item-img w-100">
                          </a>
                      </div>
                      <div class="p-3 position-relative">
                          <div class="list-card-body">
                              <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Cuisine</a></h6>
                              <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                              <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                          </div>
                          <div class="list-card-badge">
                              <span class="badge badge-success">OFFER</span> <small>65% off</small>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="osahan-slider-item">
                  <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                      <div class="list-card-image">
                          <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                          <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                          <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                          <a href="restaurant.html">
                              <img alt="#" src="{{asset('customer/img/trending3.png')}}" class="img-fluid item-img w-100">
                          </a>
                      </div>
                      <div class="p-3 position-relative">
                          <div class="list-card-body">
                              <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                            </a>
                              </h6>
                              <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                              <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                          </div>
                          <div class="list-card-badge">
                              <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="osahan-slider-item">
                  <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                      <div class="list-card-image">
                          <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                          <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                          <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                          <a href="restaurant.html">
                              <img alt="#" src="{{asset('customer/img/trending2.png')}}" class="img-fluid item-img w-100">
                          </a>
                      </div>
                      <div class="p-3 position-relative">
                          <div class="list-card-body">
                              <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Cuisine</a></h6>
                              <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                              <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                          </div>
                          <div class="list-card-badge">
                              <span class="badge badge-success">OFFER</span> <small>65% off</small>
                          </div>
                      </div>
                  </div>
              </div> --}}
          </div>
          <!-- Most popular -->
          <div class="py-3 title d-flex align-items-center">
              <h5 class="m-0">Most popular</h5>
              <a class="font-weight-bold ml-auto" href="most_popular.html">26 places <i class="feather-chevrons-right"></i></a>
          </div>
          <!-- Most popular -->
          <div class="most_popular">
              <div class="row">
                  <div class="col-md-3 pb-3">
                      <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/popular1.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                               </a>
                                  </h6>
                                  <p class="text-gray mb-1 small">• North • Hamburgers</p>
                                  <p class="text-gray mb-1 rating">
                                  </p>
                                  <ul class="rating-stars list-unstyled">
                                      <li>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star"></i>
                                      </li>
                                  </ul>
                                  <p></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 pb-3">
                      <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/popular2.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Indian Cuisine</a></h6>
                                  <p class="text-gray mb-1 small">• Indian • Pure veg</p>
                                  <p class="text-gray mb-1 rating">
                                  </p>
                                  <ul class="rating-stars list-unstyled">
                                      <li>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star"></i>
                                      </li>
                                  </ul>
                                  <p></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-success">OFFER</span> <small>65% off</small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 pb-3">
                      <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/popular3.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                               </a>
                                  </h6>
                                  <p class="text-gray mb-1 small">• Hamburgers • Pure veg</p>
                                  <p class="text-gray mb-1 rating">
                                  </p>
                                  <ul class="rating-stars list-unstyled">
                                      <li>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star"></i>
                                      </li>
                                  </ul>
                                  <p></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 pb-3">
                      <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/popular4.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">Bite Me Now Sandwiches</a></h6>
                                  <p class="text-gray mb-1 small">American • Pure veg</p>
                                  <p class="text-gray mb-1 rating">
                                  </p>
                                  <ul class="rating-stars list-unstyled">
                                      <li>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star"></i>
                                      </li>
                                  </ul>
                                  <p></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-success">OFFER</span> <small>65% off</small>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3 pb-3">
                      <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/popular5.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                               </a>
                                  </h6>
                                  <p class="text-gray mb-1 small">• North • Hamburgers</p>
                                  <p class="text-gray mb-1 rating">
                                  </p>
                                  <ul class="rating-stars list-unstyled">
                                      <li>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star"></i>
                                      </li>
                                  </ul>
                                  <p></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 pb-3">
                      <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/popular6.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Indian Cuisine</a></h6>
                                  <p class="text-gray mb-1 small">• Indian • Pure veg</p>
                                  <p class="text-gray mb-1 rating">
                                  </p>
                                  <ul class="rating-stars list-unstyled">
                                      <li>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star"></i>
                                      </li>
                                  </ul>
                                  <p></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-success">OFFER</span> <small>65% off</small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 pb-3">
                      <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/popular7.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                               </a>
                                  </h6>
                                  <p class="text-gray mb-1 small">• Hamburgers • Pure veg</p>
                                  <p class="text-gray mb-1 rating">
                                  </p>
                                  <ul class="rating-stars list-unstyled">
                                      <li>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star"></i>
                                      </li>
                                  </ul>
                                  <p></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 pb-3">
                      <div class="list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/popular8.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">Bite Me Now Sandwiches</a></h6>
                                  <p class="text-gray mb-1 small">American • Pure veg</p>
                                  <p class="text-gray mb-1 rating">
                                  </p>
                                  <ul class="rating-stars list-unstyled">
                                      <li>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star star_active"></i>
                                          <i class="feather-star"></i>
                                      </li>
                                  </ul>
                                  <p></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-success">OFFER</span> <small>65% off</small>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Most sales -->
          <div class="pt-2 pb-3 title d-flex align-items-center">
              <h5 class="m-0">Most sales</h5>
              <a class="font-weight-bold ml-auto" href="#">26 places <i class="feather-chevrons-right"></i></a>
          </div>
          <!-- Most sales -->
          <div class="most_sale">
              <div class="row mb-3">
                  <div class="col-md-4 mb-3">
                      <div class="d-flex align-items-center list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/sales1.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                               </a>
                                  </h6>
                                  <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                                  <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 mb-3">
                      <div class="d-flex align-items-center list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/sales2.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">Thai Famous Cuisine</a></h6>
                                  <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                  <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-success">OFFER</span> <small>65% off</small>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 mb-3">
                      <div class="d-flex align-items-center list-card bg-white  rounded overflow-hidden position-relative shadow-sm">
                          <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                              <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                              <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                              <a href="restaurant.html">
                                  <img alt="#" src="{{asset('customer/img/sales3.png')}}" class="img-fluid item-img w-100">
                              </a>
                          </div>
                          <div class="p-3 position-relative">
                              <div class="list-card-body">
                                  <h6 class="mb-1"><a href="restaurant.html" class="text-black">The osahan Restaurant
                               </a>
                                  </h6>
                                  <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                                  <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                              </div>
                              <div class="list-card-badge">
                                  <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>


@endsection
@section('postScript')
<script>
  var slideIndex = 0;
  showSlides();

  function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 2000); // Change image every 2 seconds
  }
  </script>
   <script type="text/javascript">
       $(document).ready(function () {

           var goToCartIcon = function ($addTocartBtn) {
               $cartIconPhone = $(".my-cart-icon-phone");
               $cartIconPc = $(".my-cart-icon-pc");
               $cartIconPc
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1)
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1);
               $cartIconPhone
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1)
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1);
               $addTocartBtn
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1)
                   .delay(10).fadeTo(50, 0.5)
                   .delay(10).fadeTo(50, 1);
           }

           $('.add-cart-btn').myCart({
               currencySymbol: '{{ App\Models\GeneralSetting::first()->currency }}',
               classCartIcon: 'my-cart-icon',
               classCartBadge: 'my-cart-badge',
               classProductQuantity: 'my-product-quantity',
               classProductRemove: 'my-product-remove',
               classCheckoutCart: 'my-cart-checkout',
               affixCartIcon: false,
               showCheckoutModal: true,
               numberOfDecimals: 2,
               cartItems: [
                   {id: 1, name: 'product 1', summary: 'summary 1', price: 10, quantity: 1, image: 'images/img_1.png'},
                   {id: 2, name: 'product 2', summary: 'summary 2', price: 20, quantity: 2, image: 'images/img_2.png'},
                   {id: 3, name: 'product 3', summary: 'summary 3', price: 30, quantity: 1, image: 'images/img_3.png'}
               ],
               clickOnAddToCart: function ($addTocart) {
                   goToCartIcon($addTocart);
               },
               afterAddOnCart: function (products, totalPrice, totalQuantity) {
                   console.log("afterAddOnCart", products, totalPrice, totalQuantity);
               },
               clickOnCartIcon: function ($cartIcon, products, totalPrice, totalQuantity) {
                   console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
               },
               checkoutCart: function (products, totalPrice, totalQuantity) {
                   var checkoutString = "Total Price: " + totalPrice + "\nTotal Quantity: " + totalQuantity;
                   checkoutString += "\n\n id \t name \t summary \t price \t quantity \t image path";
                   $.each(products, function () {
                       checkoutString += ("\n " + this.id + " \t " + this.name + " \t " + this.summary + " \t " + this.price + " \t " + this.quantity + " \t " + this.image);
                   });
                   alert(checkoutString)
                   console.log("checking out", products, totalPrice, totalQuantity);
               },
               getDiscountPrice: function (products, totalPrice, totalQuantity) {
                   console.log("calculating discount", products, totalPrice, totalQuantity);
                   return totalPrice * 0.5;
               }
           });
       });
   </script>

@append
