@extends('layouts.master')
@section('title', 'Order #: ' . $orderNo)
@section('sub-title', 'Details of Order #: ' . $orderNo)
@section('content')
@prepend('page-css')
@endprepend
<hr>
<div class="customer-details">
  <div class="row">
    <div class="col-lg-6 text-left">
      <b>Name : </b>
      <br>
      <span id='customer-name'></span>
    </div>
    <div class="col-lg-6 text-right">
      <b>Address :</b>
      <br>
      <span id='customer-address'></span>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-lg-6 text-left">
      <b>Phone Number : </b>
      <br>
      <span id='customer-phone-number'></span>
    </div>
    <div class="col-lg-6 text-right">
      <b>Order Date :</b>
      <br>
      <span id='customer-order-date'></span>
    </div>
  </div>
</div>

<br>

<div class="order-summary">
  <div class="panel panel-info">
      <div class="panel-heading"> Order Summary
          <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
      </div>
      <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body p-0">
              <table class='table'>
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Totals</th>
                    </tr>
                  </thead>
                  <tbody id='orders'>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-11"></div>
  <div class="col-lg-1">
    <form action='/admin/order/print' method='POST'>
      <input type='hidden' name='customer_name' id='customerName'>
      <input type='hidden' name='customer_address' id='customerAddress'>
      <input type='hidden' name='customer_phone_number' id='customerPhoneNumber'>
      <input type='hidden' name='customer_order_date' id='customerOrderDate'>
      <input type='hidden' name='customer_orders' id='customerOrders'>
      <input type='hidden' name='order_no' id='customerOrderNo'>
      <input type='submit' class='btn btn-primary btn-block' value='PRINT'>  
    </form>
  </div>
</div>


@push('page-scripts')
<script>
// Socket.io setup
const socket = io('https://mai-place-api.herokuapp.com/');

// Init feathers app
const app = feathers();

// Register socket.io to talk to server
app.configure(feathers.socketio(socket));

const capitalize = (string) => {
  let spacePosition = string.indexOf(' ');
  return `
    ${string.charAt(0).toUpperCase()}${string.substr(1, spacePosition - 1)}
    ${string.charAt(spacePosition + 1).toUpperCase()}${string.substr(spacePosition + 2 , string.length)}
  `; 
};

$(document).ready(function () {
  let customerId = {{$customerId}};
  let orderNo = {{$orderNo}};
  let subTotal = 0;
  let total = 0;
  let ordersElement = document.querySelector('#orders');

  const displayDataDynamically = (data) => {
    let customerName        = capitalize(`${data.customer.firstname} ${data.customer.lastname}`);
    let customerAddress     = capitalize(data.customer.address);
    let customerPhoneNumber = data.customer.phone_number;
    let customerOrderDate =  data.created_at;
    

    $('#customerName').val(`${data.customer.firstname} ${data.customer.lastname}`);
    $('#customerAddress').val(`${data.customer.address}`);
    $('#customerPhoneNumber').val(customerPhoneNumber);
    $('#customerOrderDate').val(customerOrderDate);
    $('#customerOrders').val(JSON.stringify(data.foods));
    $('#customerOrderNo').val(data.order_no);
    

    document.querySelector('#customer-name').innerHTML = customerName;
    document.querySelector('#customer-address').innerHTML = customerAddress;
    document.querySelector('#customer-phone-number').innerHTML = customerPhoneNumber;
    document.querySelector('#customer-order-date').innerHTML = customerOrderDate;

    data.foods.forEach((order) => {
      subTotal += order.order_food[0].price * order.quantity;
      $('#orders').append(`
          <tr>
            <td>${order.order_food[0].name}</td>
            <td>P${order.order_food[0].price}</td>
            <td>${order.quantity}</td>
            <td>P${order.order_food[0].price * order.quantity}</td>
          </tr>
      `);
    });
    $('#orders').append(`
        <tr>
          <td></td>
          <td></td>
          <td><b>Subtotal</b></td>
          <td>P${subTotal}</td>
        </tr>

        <tr>
          <td></td>
          <td></td>
          <td><b>Total</b></td>
          <td>P${subTotal}</td>
        </tr>

    `);
  };

  $.ajax({
    url : `https://mai-place-api.herokuapp.com/customer/receipt/${customerId}/${orderNo}`,
    type : 'GET',
    success : function (response) {
      displayDataDynamically(response);
    }
  });
});
</script>
@endpush
@endsection