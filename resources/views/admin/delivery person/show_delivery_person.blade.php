@extends('layouts.app',['activePage' => 'delivery_person'])

@section('title','Delivery Person')

@section('content')

<section class="section">
    @if (Session::has('msg'))
    <script>
        var msg = "<?php echo Session::get('msg'); ?>"
        $(window).on('load', function()
        {
            iziToast.success({
                message: msg,
                position: 'topRight'
            });
            console.log(msg);
        });
    </script>
    @endif

    <div class="section-header">
        <h1>{{__('Delivery person')}}</h1>
        <div class="section-header-breadcrumb">
            @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/delivery_person/'.$delivery_person->id) }}">{{ $delivery_person->first_name .' - '. $delivery_person->last_name }}</a></div>
                <div class="breadcrumb-item">{{__('Delivery person order history')}}</div>
            @endif
            @if(Auth::user()->load('roles')->roles->contains('title', 'vendor'))
                <div class="breadcrumb-item active"><a href="{{ url('vendor/vendor_home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('vendor/deliveryPerson') }}">{{ $delivery_person->first_name .' - '. $delivery_person->last_name }}</a></div>
                <div class="breadcrumb-item">{{__('Delivery person order history')}}</div>
            @endif
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__('This is Delivery Person')}}</h2>
        <p class="section-lead">{{__('Delivery person page.')}}</p>
        <div class="card">
            <div class="card-header">
                <div class="w-100">
                    @if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
                        @if ($delivery_person->vendor_id == null)
                            <a href="{{ url('admin/delivery_person_finance_details/'.$delivery_person->id) }}" class="btn btn-primary float-right">{{__('View finance details')}}</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Order Id')}}</th>
                                <th>{{__('Vendor name')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Time')}}</th>
                                @if ($delivery_person->vendor_id == null)
                                    <th>{{__('Delivery Charge')}}</th>
                                @endif
                                <th>{{__('Order status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $order->order_id }}</th>
                                    <th>{{ $order->vendor['name'] }}</th>
                                    <th>{{ $order->date }}</th>
                                    <th>{{ $order->time }}</th>
                                    @if ($delivery_person->vendor_id == null)
                                        <th>{{ $order->delivery_charge }}</th>
                                    @endif
                                    <th>{{ $order->order_status }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
