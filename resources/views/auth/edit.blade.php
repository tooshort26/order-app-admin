@extends('layouts.master')
@section('title', 'Update your profile')
@section('content')
@if(Session::has('success'))
  <div class="alert alert-success">
    {{ Session::get('success') }}
  </div>
 @elseif($errors->any())
 <div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $key => $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div>
  @else
  <div class="alert alert-info">
      If you want to change your password just filled it
  </div>
  <hr>
@endif
<form class="form-horizontal form-material" method="POST" action="{{ route('account.setting.update') }}">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label class="col-md-12">Full Name</label>
    <div class="col-md-12">
      <input type="text" placeholder="Johnathan Doe" value="{{ Auth::user()->name }}" name="name" class="form-control form-control-line"> </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-md-12">Email</label>
      <div class="col-md-12">
        <input type="email" placeholder="johnathan@admin.com" value="{{ Auth::user()->email }}" class="form-control form-control-line" name="email" id="email"> </div>
      </div>
      <div class="form-group">
        <label class="col-md-12">Password</label>
        <div class="col-md-12">
          <input type="password" name="password" class="form-control form-control-line"> </div>
      </div>
       <div class="form-group">
        <label class="col-md-12">Re-type Password</label>
        <div class="col-md-12">
          <input type="password" name="password_confirmation" class="form-control form-control-line"> </div>
      </div>
        <div class="form-group">
          <label class="col-md-12">Phone No</label>
          <div class="col-md-12">
            <input type="text" placeholder="091936693499" name="mobile_no" value="{{ Auth::user()->mobile_no }}" class="form-control form-control-line"> </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <button class="btn btn-success pull-right">Update Profile</button>
            </div>
          </div>
        </form>
        @push('page-scripts')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @endpush
        @endsection