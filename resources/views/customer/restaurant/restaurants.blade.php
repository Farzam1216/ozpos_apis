@extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app', ['activePage' => 'restaurant'] )

@if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
   @section('logo',$rest->vendor_logo)
   @section('subtitle','Menu')
   @section('vendor_lat',$rest->lat)
   @section('vendor_lang',$rest->lang)
@endif

@section('title','Restaurants')


@section('content')

<style>
  .nav-tabs {
      padding-top: 2.5rem;
      margin-top: 3.5rem;
  }
  </style>
<div class="osahan-popular">
  <!-- Most popular -->
  <div class="container">
      <div class="search py-5">

          <!-- nav tabs -->
          <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                  <a class="nav-link active border-0 bg-light text-dark rounded" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="feather-home mr-2"></i>Restaurants ({{$vendors->count()}})</a>
              </li>
              {{-- <li class="nav-item" role="presentation">
                  <a class="nav-link border-0 bg-light text-dark rounded ml-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="feather-disc mr-2"></i>Dishes (23)</a>
              </li> --}}
          </ul>
          <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <!-- Content Row -->
                  <div class="container mt-4 mb-4 p-0">
                      <!-- restaurants nearby -->
                      <div class="row">
                        @forelse ($vendors as $vendor)
                        <div class="col-md-3 pb-3">
                          <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                              <div class="list-card-image">
                                  {{-- <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                                  <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div> --}}
                                  {{-- <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div> --}}
                                  <a href="{{route('restaurant.index1',$vendor->id)}}">
                                      <img alt="#" src="{{asset($vendor->image)}}" class="img-fluid item-img w-100" style="height: 20rem">
                                  </a>
                              </div>
                              <div class="p-3 position-relative">
                                  <div class="list-card-body">
                                      <h6 class="mb-1"><a href="{{route('restaurant.index1',$vendor->id)}}" class="text-black">{{ $vendor->name}}
                                   </a>
                                      </h6>
                                      {{-- <p class="text-gray mb-1 small">• North • Hamburgers</p>
                                      <p class="text-gray mb-1 rating">
                                          <ul class="rating-stars list-unstyled">
                                              <li>
                                                  <i class="feather-star star_active"></i>
                                                  <i class="feather-star star_active"></i>
                                                  <i class="feather-star star_active"></i>
                                                  <i class="feather-star star_active"></i>
                                                  <i class="feather-star"></i>
                                              </li>
                                          </ul>
                                      </p> --}}
                                  </div>
                                  {{-- <div class="list-card-badge">
                                      <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                                  </div> --}}
                              </div>
                          </div>
                      </div>
                      @empty
                          <div class="d-flex">NO Vendor Exist In Your Area</div>
                        @endforelse
                      </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <!-- Content Row -->
                  <div class="row d-flex align-items-center justify-content-center py-5">
                      <div class="col-md-4 py-5">
                          <div class="text-center py-5">
                              <p class="h4 mb-4"><i class="feather-search bg-primary text-white rounded p-2"></i></p>
                              <p class="font-weight-bold text-dark h5">Nothing found</p>
                              <p>we could not find anything that would match your search request, please try again.</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!--  -->
      </div>
  </div>

</div>
@endsection
