@extends('layouts.app',['activePage' => 'bank_details'])

@section('title','Vendor Order Setting')

@section('content')

  @if (Session::has('msg'))
    <script>
      let msg = "<?php echo Session::get('msg'); ?>";
      $(window).on('load', function () {
        iziToast.success({
          message: msg,
          position: 'topRight'
        });
      });
    </script>
  @endif

  <section class="section">
    <div class="section-header">
      <h1>Order Details</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ url('vendor/vendor_home') }}">{{__('Dashboard')}}</a></div>
        <div class="breadcrumb-item">Order Details</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Order Setting</h2>
      <p class="section-lead">Order Setting</p>
      <div class="card">
        <form action="{{ url('vendor/update_order_setting') }}" method="post">
          @csrf
          <div class="card card-primary">
            <div class="card-header">
              <h6>{{__('Order settings')}}</h6>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-12">
                  <label for="">{{__('minimum order values')}}</label>
                  <input type="number" min=1 name="min_order_value" required value="{{ $orderData->min_order_value ?? ''}}" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-12">
                  <label for="">Free Delivery</label>
                  <input type="checkbox" id="" name="free_delivery" @if($orderData->free_delivery === 1) checked @endif class="form-control" style="display: block;width: 30px;">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="">Free Delivery After Distance(KM)</label>
                  <input type="number" min=0 name="free_delivery_distance" required value="{{ $orderData->free_delivery_distance }}" class="form-control">
                </div>
                <div class="col-md-6">
                  <label for="">Free Delivery After Order Amount</label>
                  <input type="number" min=0 name="free_delivery_amount" required value="{{ $orderData->free_delivery_amount }}" class="form-control">
                </div>
              </div>
            </div>
          </div>

          <div class="card card-primary mt-3">
            <div class="card-header">
              <h5>{{__('auto cancel order')}}</h5>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-12">
                  <label for="">{{__('order cancel thresold by vendor(In minutes)')}}</label>
                  <input type="number" min=1 value="{{ $orderData->vendor_order_max_time }}" required
                         name="vendor_order_max_time" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="">{{__('order cancel thresold by driver(In minutes)')}}</label>
                  <input type="number" min=1 required value="{{ $orderData->driver_order_max_time }}"
                         name="driver_order_max_time" class="form-control">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">{{__('save')}}</button>
              </div>
            </div>
          </div>

{{--          <div class="card card-primary mt-3">--}}
{{--            <div class="card-header">--}}
{{--              {{__('delivery charges')}}--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--              <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                  <label for="">{{__('charges based on ?')}}</label>--}}
{{--                  <select class="form-control" name="delivery_charge_type">--}}
{{--                    <option value="order_amount"--}}
{{--                      {{ $orderData->delivery_charge_type == 'order_amount' ? 'selected' : '' }}>--}}
{{--                      {{__('order amount')}}</option>--}}
{{--                    <option value="delivery_distance"--}}
{{--                      {{ $orderData->delivery_charge_type == 'delivery_distance' ? 'selected' : '' }}>--}}
{{--                      {{__('Delivery distance (KM)')}}</option>--}}
{{--                  </select>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <?php--}}
{{--              $charges = json_decode($orderData->charges)--}}
{{--              ?>--}}
{{--              <div>--}}
{{--                <table class="table delivery_table">--}}
{{--                  <tr--}}
{{--                    class="delivery_charge_table {{ $orderData->delivery_charge_type == 'order_amount' ? 'hide' : '' }}">--}}
{{--                    <td>{{__('Distance From')}}</td>--}}
{{--                    <td>{{__('Distance To')}}</td>--}}
{{--                    <td>{{__('Charges')}}({{$currency_symbol}})</td>--}}
{{--                    <td></td>--}}
{{--                  </tr>--}}
{{--                  <tr--}}
{{--                    class="order_charge_table {{ $orderData->delivery_charge_type == 'delivery_distance' ? 'hide' : '' }}">--}}
{{--                    <td>{{__('Order From')}}</td>--}}
{{--                    <td>{{__('Order To')}}</td>--}}
{{--                    <td>{{__('Charges')}}({{$currency_symbol}})</td>--}}
{{--                    <td></td>--}}
{{--                  </tr>--}}
{{--                  @foreach ($charges as $charge)--}}
{{--                    <tr>--}}
{{--                      <td><input type="number" min=1 required value="{{$charge->min_value}}" name="min_value[]"--}}
{{--                                 class="form-control"></td>--}}
{{--                      <td><input type="number" min=1 required value="{{$charge->max_value}}" name="max_value[]"--}}
{{--                                 class="form-control"></td>--}}
{{--                      <td><input type="number" min=0 required value="{{$charge->charges}}" name="charges[]"--}}
{{--                                 class="form-control"></td>--}}
{{--                      <td>--}}
{{--                        <button type="button" class="btn btn-danger removebtn"><i--}}
{{--                            class="fas fa-times"></i></button>--}}
{{--                      </td>--}}
{{--                    </tr>--}}
{{--                  @endforeach--}}
{{--                </table>--}}
{{--                <div class="text-center mt-3">--}}
{{--                  <button type="button" class="btn btn-primary"--}}
{{--                          onclick="add_field()">{{__('Add Field')}}</button>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <?php--}}
{{--              $order_charges = json_decode($orderData->order_charges)--}}
{{--              ?>--}}
{{--            </div>--}}
{{--            <div class="card-footer">--}}
{{--              <div class="text-center mt-3">--}}
{{--                <button type="submit" class="btn btn-primary">{{__('save')}}</button>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
        </form>
      </div>
    </div>
  </section>
@endsection
