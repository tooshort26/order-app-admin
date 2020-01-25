@extends('layouts.master')
@section('title', 'Orders')
@section('sub-title', 'List of Ready for Delivery/Pick-up orders')
@section('content')
@prepend('page-css')
<link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endprepend
<table id="orders" class="display table table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Customer Name</th>
      <th>Order #</th>
			<th>Order Type</th>
      <th>Address</th>
      <th>Phone Number</th>
			<th>Order At</th>
      <th>Actions</th>
		</tr>
	</thead>
<tbody></tbody>
</table>

<div id='print-section'></div>

@push('page-scripts')
<script src="/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<script>
// Socket.io setup
const socket = io(window.api_url);

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

const printReceipt = (data) => {
  let orders = data.orders;
  $('#print-section').append(`
     <form action="/admin/order/print" method='POST' id='printForm'>
       <input type='hidden' name='customer_name' value='${data.customer.firstname} ${data.customer.lastname}'>
       <input type='hidden' name='customer_address' value='${data.customer.address}'>
       <input type='hidden' name='customer_phone_number' value='${data.customer.phone_number}'>
       <input type='hidden' name='customer_order_date' value='${data.created_at}'>
       <input type='hidden' name='customer_orders' value='${JSON.stringify(data.foods)}'>
       <input type='hidden' name='order_no' id='customerOrderNo' value='${data.order_no}'>
     </form>
  `);

  $('#printForm').trigger('submit');
};


function moveToPaidOrders(customer_id, order_no) {
  app.service('orders').update(order_no, { customer_id : customer_id, status : 'paid' });
}


$(document).ready(function () {
  let table = $('#orders').DataTable({
    ajax: {
           url : window.api_url + 'deliver/pickup/order',
           cache: true,
           dataSrc : '',
    },
      columns: [
        { render : function (data, type, full, meta) {
            var data = full;
            let customerName = `${data.customer.firstname} ${data.customer.lastname}`; 
            return `<div class='text-center' style='cursor:pointer;' onclick='moveToPaidOrders(${data.customer.id},${data.order_no})'>${capitalize(customerName)}</div>`;
          } 
        },
        { render : function (data, type, full, meta) {
            var data = full;
            return `<div class='text-center'><b>${data.order_no}</b></div>`;
          } 
        },
        { render : function (data, type, full, meta) {
            var data = full;
            let length = data.order_type.length - 1;
            return `<div class='text-center'><b>${data.order_type.charAt(0).toUpperCase()}${data.order_type.substr(1, length)}</b></div>`;
          } 
        },
        { render : function (data, type, full, meta) {
            var data = full;
            return `<div class='text-center'>${capitalize(data.customer.address)}</div>`;
          } 
        },
        { render : function (data, type, full, meta) {
            var data = full;
            return `<div class='text-center'>${data.customer.phone_number}</div>`;
          } 
        },
       { render : function (data, type, full, meta) {
            var data = full;
            return `<div class='text-center'>${data.created_at}</div>`;
          } 
        },
         {
           sortable : false,
           render : function ( data, type, full, meta) {
            var data = JSON.parse(JSON.stringify(full));
            let customerId = data.customer_id;
            let orderNo = data.order_no;
                   return `
                    <div class="text-center">
                      <div class="btn-group m-r-10">
                              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-success dropdown-toggle waves-effect waves-light" type="button">Actions <span class="caret"></span></button>
                              <ul role="menu" class="dropdown-menu">
                                  <li><a href='/admin/order/${customerId}/${orderNo}' ><i class="fa fa-eye"></i> View Order</a></li>
                                  <li><a style="cursor:pointer;" onclick='printReceipt(${JSON.stringify(data)})'><i class="fa fa-print"></i> Print Receipt</a></li>
                              </ul>
                       </div>
                    </div>
                    `;
            
             }
        }
       
      ],
      dom: 'Bfrtip',
      buttons: [
          {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 4]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 4]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 4 ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 4 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 4 ]
                }
            }
      ]
  });






function init() {
  app.service('orders').on('updated', (order) => {
    if(order.status == 'deliver/pickup') {
      table.ajax.reload();
    } else if(order.status == 'paid') {
      table.ajax.reload();
      swal("Success!", `Succesfully move the order to paid orders. `, "success");
    }
  });

}

init();

});


</script>
@endpush
@endsection