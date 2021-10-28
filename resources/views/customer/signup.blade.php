
@extends('customer.home')

@section('content')

<div class="osahan-signup login-page">
  <video loop autoplay muted id="vid">
      <source src="img/bg.mp4" type="video/mp4">
      <source src="img/bg.mp4" type="video/ogg">
      Your browser does not support the video tag.
   </video>
  <div class="d-flex align-items-center justify-content-center flex-column vh-100">
      <div class="px-5 col-md-6 ml-auto">
          <div class="px-5 col-10 mx-auto">
              <h2 class="text-dark my-0">Hello There.</h2>
              <p class="text-50">Sign up to continue</p>
              <form class="mt-5 mb-4" action="{{route('signup.verify')}}" method="POST">
                @csrf
                  <div class="form-group">
                      <label for="exampleInputName1" class="text-dark">Name</label>
                      <input type="text" placeholder="Enter Name" name="name" class="form-control" id="exampleInputName1" aria-describedby="nameHelp">
                      @if($errors->has('name'))
                      <div class="error text-danger">{{ $errors->first('name') }}</div>
                    @endif
                    </div>
                  <div class="form-group">
                      <label for="exampleInputNumber1" class="text-dark">Email</label>
                      <input type="email" placeholder="Enter Email" name="email_id" class="form-control" id="exampleInputNumber1" aria-describedby="numberHelp">
                  @if($errors->has('email_id'))
                      <div class="error text-danger">{{ $errors->first('email_id') }}</div>
                  @endif
                    </div>
                  <div class="form-group">
                      <label for="exampleInputNumber1" class="text-dark">Phone Code</label>
                      <input type="number" placeholder="Phone Code (92)" name="phone_code" class="form-control" id="exampleInputNumber1" aria-describedby="numberHelp">
                  @if($errors->has('phone_code'))
                      <div class="error text-danger">{{ $errors->first('phone_code') }}</div>
                  @endif
                    </div>
                  <div class="form-group">
                      <label for="exampleInputNumber1" class="text-dark">Mobile Number</label>
                      <input type="number" placeholder="Enter Mobile" name="phone" class="form-control" id="exampleInputNumber1" aria-describedby="numberHelp">
                  @if($errors->has('phone'))
                      <div class="error text-danger">{{ $errors->first('phone') }}</div>
                  @endif
                    </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1" class="text-dark">Password</label>
                      <input type="password" placeholder="Enter Password" name="password" class="form-control" id="exampleInputPassword1">
                  @if($errors->has('password'))
                      <div class="error text-danger">{{ $errors->first('password') }}</div>
                  @endif
                    </div>
                  <button class="btn btn-primary btn-lg btn-block">
                     SIGN UP
                  </button>
                  <div class="py-2">
                      <button class="btn btn-facebook btn-lg btn-block"><i class="feather-facebook"></i> Connect with Facebook</button>
                  </div>
              </form>
          </div>
          <div class="new-acc d-flex align-items-center justify-content-center">
              <a href="{{route('customer.login')}}">
                  <p class="text-center m-0">Already an account? Sign in</p>
              </a>
          </div>
      </div>
  </div>
</div>

@endsection
