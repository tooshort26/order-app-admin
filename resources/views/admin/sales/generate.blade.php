@extends('layouts.master')
@section('title', 'Reports')
@section('sub-title', 'Generate Report')
@prepend('page-css')
<link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endprepend
@section('content')
    <form action="{{ route('generate.submit') }}" method="POST">
        @csrf
        <div class="row">
        <div class="col-lg-6">
            <label for="from_date">From date</label>
            <input type="month" name="from_date" required id="from_date" class='form-control'>
        </div>
        <div class="col-lg-6">
            <label for="to_date">To date</label>
            <input type="month" name="to_date" required id="to_date" class='form-control'>
        </div>
        <div class="pull-right">
            <br>
            <input type="submit" class='btn btn-primary mt-5' value='Generate reports' id='btnGenerateReport'>
        </div>
    </div>

    </form>
@push('page-scripts')
@endpush
@endsection