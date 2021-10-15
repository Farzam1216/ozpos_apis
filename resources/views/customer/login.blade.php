
@extends('customer.home')

@section('content')


<div class="login-page vh-100">
  <video loop autoplay muted id="vid">
      <source src="img/bg.mp4" type="video/mp4">
      <source src="img/bg.mp4" type="video/ogg">
      Your browser does not support the video tag.
   </video>
  <div class="d-flex align-items-center justify-content-center vh-100">
      <div class="px-5 col-md-6 ml-auto">
          <div class="px-5 col-10 mx-auto">
              <h2 class="text-dark my-0">Welcome Back</h2>
              <p class="text-50">Sign in to continue</p>
              <form class="mt-5 mb-4" action="{{route('login.verify')}}" method="POST">
                @csrf
                  <div class="form-group">
                      <label for="exampleInputEmail1" class="text-dark">Email</label>
                      <input type="email" placeholder="Enter Email" name="email_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1" class="text-dark">Password</label>
                      <input type="password" placeholder="Enter Password" name="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <button class="btn btn-primary btn-lg btn-block">SIGN IN</button>
                  <div class="py-2">
                      <button class="btn btn-lg btn-facebook btn-block"><i class="feather-facebook"></i> Connect with Facebook</button>
                  </div>
              </form>
              <a href="forgot_password.html" class="text-decoration-none">
                  <p class="text-center">Forgot your password?</p>
              </a>
              <div class="d-flex align-items-center justify-content-center">
                  <a href="{{route('customer.signup')}}">
                      <p class="text-center m-0">Don't have an account? Sign up</p>
                  </a>
              </div>
          </div>
      </div>
  </div>
</div>


@endsection
