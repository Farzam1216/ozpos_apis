
{{-- @extends(isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'customer.layouts.single.app' : 'customer.layouts.single.app', ['activePage' => 'restaurant'] ) --}}
@extends('customer.layouts.single.app')
{{-- @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
   @section('logo',$rest->vendor_logo)
   @section('subtitle','Menu')
   @section('vendor_lat',$rest->lat)
   @section('vendor_lang',$rest->lang)
@endif --}}

@section('title','profile')


@section('content')

<div class="osahan-profile" >
  <div class="d-none">
      <div class="bg-primary border-bottom p-3 d-flex align-items-center">
          <a class="toggle togglew toggle-2" href="#"><span></span></a>
          <h4 class="font-weight-bold m-0 text-white">Profile</h4>
      </div>
  </div>
  <!-- profile -->
  <div class="container position-relative">
      <div class="py-5 osahan-profile row" >
          <div class="col-md-4 mb-3" style="margin-top: 30px;">
              <div class="bg-white rounded shadow-sm sticky_sidebar overflow-hidden">
                  <a href="profile.html" class="">
                      <div class="d-flex align-items-center p-3">
                          <div class="left mr-3">
                              <img alt="#" src="img/user1.jpg" class="rounded-circle">
                          </div>
                          <div class="right">
                              <h6 class="mb-1 font-weight-bold">{{ $user->name }} <i class="feather-check-circle text-success"></i></h6>
                              <p class="text-muted m-0 small">{{ $user->email_id }}</p>
                          </div>
                      </div>
                  </a>

                  {{-- <div class="bg-white profile-details">
                      <a data-toggle="modal" data-target="#paycard" class="d-flex w-100 align-items-center border-bottom p-3">
                          <div class="left mr-3">
                              <h6 class="font-weight-bold mb-1 text-dark">Payment Cards</h6>
                              <p class="small text-muted m-0">Add a credit or debit card</p>
                          </div>
                          <div class="right ml-auto">
                              <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                          </div>
                      </a>
                      <a data-toggle="modal" data-target="#exampleModal" class="d-flex w-100 align-items-center border-bottom p-3">
                          <div class="left mr-3">
                              <h6 class="font-weight-bold mb-1 text-dark">Address</h6>
                              <p class="small text-muted m-0">Add or remove a delivery address</p>
                          </div>
                          <div class="right ml-auto">
                              <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                          </div>
                      </a>

                      <a href="faq.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                          <div class="left mr-3">
                              <h6 class="font-weight-bold m-0 text-dark"><i class="feather-truck bg-danger text-white p-2 rounded-circle mr-2"></i> Delivery Support</h6>
                          </div>
                          <div class="right ml-auto">
                              <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                          </div>
                      </a>
                      <a href="contact-us.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                          <div class="left mr-3">
                              <h6 class="font-weight-bold m-0 text-dark"><i class="feather-phone bg-primary text-white p-2 rounded-circle mr-2"></i> Contact</h6>
                          </div>
                          <div class="right ml-auto">
                              <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                          </div>
                      </a>
                      <a href="terms.html" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                          <div class="left mr-3">
                              <h6 class="font-weight-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle mr-2"></i> Term of use</h6>
                          </div>
                          <div class="right ml-auto">
                              <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                          </div>
                      </a>
                      <a href="privacy.html" class="d-flex w-100 align-items-center px-3 py-4">
                          <div class="left mr-3">
                              <h6 class="font-weight-bold m-0 text-dark"><i class="feather-lock bg-warning text-white p-2 rounded-circle mr-2"></i> Privacy policy</h6>
                          </div>
                          <div class="right ml-auto">
                              <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                          </div>
                      </a>
                  </div> --}}
              </div>
          </div>
          <div class="col-md-8 mb-3" style="margin-top: 30px;">
              <div class="rounded shadow-sm p-4 bg-white">
                  <h5 class="mb-4">My account</h5>
                  <div id="edit_profile">
                      <div>
                        @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                        <form  action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/single-profile-update/{{$user->id}}" method="POST">
                        {{-- <form action="{{route('customer.profile.update',$user->id)}}" method="POST"> --}}
                        @else
                        <form action="{{route('customer.profile.update',$user->id)}}" method="POST">
                        @endif
                            @csrf
                              <div class="form-group">
                                  <label for="exampleInputName1">Name</label>
                                  <input type="text" class="form-control" name="name" id="exampleInputName1d" value="{{ $user->name }}">
                              </div>
                              @php
                                $data =explode('+',$user->phone_code);
                              @endphp
                              <div class="form-group">
                                  <label for="exampleInputName1">Phone Code</label>
                                  <input type="string" class="form-control" name="phone_code" id="exampleInputName1" value="{{ $data[1]}}">
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputNumber1">Mobile Number</label>
                                  <input type="number" class="form-control" name="phone" id="exampleInputNumber1" value="{{$user->phone}}">
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{$user->email_id}}">
                              </div>
                              <div class="text-center">
                                  <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                              </div>
                          </form>
                      </div>
                      <div class="additional">
                          <div class="change_password my-3">
                            @if(isset($_SERVER['HTTP_X_FORWARDED_HOST']))
                            <form  action="{{( ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http')}}://{{$_SERVER['HTTP_X_FORWARDED_HOST']}}/single-change-password/{{$user->id}}" method="POST">
                            {{-- <form action="{{route('customer.profile.update',$user->id)}}" method="POST"> --}}
                            @else
                              <form action="{{route('customer.password.change',$user->id)}}" method="POST">
                            @endif
                              @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Curent Password</label>
                                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                    @if($errors->has('current_password'))
                                    <div class="error text-danger">{{ $errors->first('current_password') }}</div>
                                @endif
                                  </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">New Password</label>
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                       @if($errors->has('new_password'))
                                         <div class="error text-danger">{{ $errors->first('new_password') }}</div>
                                       @endif
                                  </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">New Confirm Password</label>
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                         @if($errors->has('new_confirm_password'))
                                           <div class="error text-danger">{{ $errors->first('new_confirm_password') }}</div>
                                         @endif
                                  </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning">Update Password</button>
                                </div>
                            </form>
                          </div>

                  </div>
              </div>
          </div>
      </div>
  </div>

</div>

@endsection
