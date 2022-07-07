
@extends('layouts.app',['activePage' => 'Notification'])

@section('title','notification')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('QR CODE')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('vendor/vendor_home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('QR CODE')}}</div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__("QR CODE")}}</h2>
        <p class="section-lead">{{__('Qr Code')}}</p>
        <div class="container mt-4">

          <div class="card">
              <div class="card-header">
                  <h2>QR Code</h2>
              </div>
              <div class="card-body">
                  {!! QrCode::size(300)->generate('http://ozposvue.geekss.com.au/qr-code') !!}
              </div>
          </div>
      </div>
        {{--  @foreach ($notifications as $notification)
        <div class="card">
            <div class="card-header">
                <h4>{{ $notification->title }}</h4>
                <div class="card-header-action">
                    <a data-collapse="#mycard-collapse{{$notification->id}}" class="btn btn-icon btn-primary" href="javascript:void(0);"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="mycard-collapse{{$notification->id}}" style="">
                <div class="card-body">
                    {{ $notification->message }}
                </div>
                <div class="card-footer">
                    {{ $notification->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        @endforeach  --}}
    </div>
</section>

@endsection

