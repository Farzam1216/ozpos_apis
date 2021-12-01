@extends('layouts.app',['activePage' => 'vendor_timeslot'])

@section('title', 'Vendor Delivery Timeslots')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{ $vendor->name }}&nbsp;{{ __('Delivery Time Slots') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('vendor/home') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Vendor delivery timeslot') }}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{ __('Delivery Time Slot Management') }}</h2>
            <p class="section-lead">{{ __('Add and Edit Time Slots for the Delivery') }}</p>
            <div class="card p-5">
                <div class="row">


                    <div class="table-responsive">

                        <input type="hidden" name="vendor_id" id="vendor_id" value="{{ $vendor->id }}">
                        <table class="table deliveryTimeTable">
                            <tbody>

                                <tr>
                                    <td style="vertical-align: text-top">
                                        <span>Vendor Status</span>
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" name="vendor_status" id="vendor_status"
                                                    onclick="vendor_status({{ $vendor->id }})"
                                                    {{ $vendor->vendor_status == 1 ? 'checked' : '' }}>
                                                <div class="slider"></div>
                                            </label>
                                        </div>
                                    </td>
                                    <td style="vertical-align: text-top">
                                        <span>Delivery Status</span>
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" name="delivery_status" id="delivery_status"
                                                    onclick="delivery_status({{ $vendor->id }})"
                                                    {{ $vendor->delivery_status == 1 ? 'checked' : '' }}>
                                                <div class="slider"></div>
                                            </label>
                                        </div>
                                    </td>
                                    <td style="vertical-align: text-top">
                                        <span>Pickup Status</span>
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" name="pickup_status" id="pickup_status"
                                                    onclick="pickup_status({{ $vendor->id }})"
                                                    {{ $vendor->pickup_status == 1 ? 'checked' : '' }}>
                                                <div class="slider"></div>
                                            </label>
                                        </div>
                                    </td>

                                    <td>

                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
