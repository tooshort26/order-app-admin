@extends('layouts.master')
@section('title', 'Dashboard')
@section('sub-title', '')
@prepend('page-css')

<!-- chartist CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chartist/0.11.4/chartist.min.css" integrity="sha256-seGyqLj5T52Hx8W7/YTajtNXGXQf+IksfkcaKGoTkbY=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist-plugin-tooltips@0.0.17/dist/chartist-plugin-tooltip.css">
<!-- animation CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css" integrity="sha256-1hIhSlowg4vqaFZ/bikPMfEGwSgM0FtIs7mx1PADHCk=" crossorigin="anonymous" />
<!-- morris CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!--Gauge chart CSS -->
<link href="/plugins/bower_components/Minimal-Gauge-chart/css/cmGauge.css" rel="stylesheet" type="text/css" />
@endprepend
@section('dashboard-content')
<!-- ============================================================== -->
<!-- Sales different chart widgets -->
<!-- ============================================================== -->
<!-- .row -->
<div class="row">
    <div class="col-md-12 col-lg-4" id='incoming-orders' style='cursor:pointer;'>
        <div class="white-box">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="m-b-0 font-medium">Incoming Orders</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4" id='preparing-orders' style='cursor:pointer;'>
        <div class="white-box">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="m-b-0 font-medium">Preparing Orders</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4" id='cancelled-orders' style='cursor:pointer;'>
        <div class="white-box">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="m-b-0 font-medium">Cancelled Orders</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4" id='out-of-delivery-pickup-orders' style='cursor:pointer;'>
        <div class="white-box">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="m-b-0 font-medium">Out of Delivery/Pick up</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4" id='paid-orders' style='cursor:pointer;'>
        <div class="white-box">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="m-b-0 font-medium">Paid Orders</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-info block4" style="position: static; zoom: 1;">
                <div class="panel-heading"> Expenses
                    <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4" id='utility-expenses'>
                                <div class="well">
                                    <h3 class="m-b-0 font-medium">Utility Expenses</h3>
                                </div>        
                            </div>

                            <div class="col-lg-4" id='delivery-expenses'>
                                <div class="well">
                                    <h3 class="m-b-0 font-medium">Delivery Expenses</h3>
                                </div>        
                            </div>

                            <div class="col-lg-4" id='buying-food-expenses'>
                                <div class="well">
                                    <h3 class="m-b-0 font-medium">Buying of Food Expenses</h3>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-lg-4">
        <div class="white-box">
            
        </div>
    </div>
</div>
@push('page-scripts')
<script>
    $('#incoming-orders').click(function () {
        window.location.href = '/admin/order';
    });

    $('#preparing-orders').click(function () {
        window.location.href = '/admin/prepare/order';
    });

    $('#cancelled-orders').click(function () {
        window.location.href = '/admin/cancelled/order';
    });

    $('#out-of-delivery-pickup-orders').click(function () {
        window.location.href = '/admin/deliver/pickup/order';
    });

    $('#paid-orders').click(function () {
        window.location.href = '/admin/paid/order';
    });

    $('#utility-expenses').click(function () {
        console.log('Redirect to utlity expenses');
    });

    $('#delivery-expenses').click(function () {
        console.log('Redirect to delivery expenses');
    });

    $('#buying-food-expenses').click(function () {
        console.log('Redirect to buying of food expenses');
    });
</script>
@endpush
@endsection