@extends('layouts.master')
@section('title', 'Orders')
@section('sub-title', 'List of all orders today')
@section('content')
@prepend('page-css')
<link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endprepend
<table id="orders" class="display table table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Customer name</th>
			<th>Orders</th>
			<th>Total Cost</th>
      <th>Actions</th>
		</tr>
	</thead>
<tbody></tbody>
</table>


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
const socket = io('http://192.168.1.10:3030');

// Init feathers app
const app = feathers();

// Register socket.io to talk to server
app.configure(feathers.socketio(socket));


$(document).ready(function () {
  let table = $('#orders').DataTable({
    ajax: {
        url : 'http://192.168.1.10:3030/foods',
           cache: true,
           dataSrc : '',
    },
      columns: [
        { data : 'name' },
        { data : 'description' },
        {
           render : function ( data, type, full, meta) {
               return `<div class='text-center'><b>PHP: ${full.price}.00</b></div>`;
           }
        },
        {
           sortable : false,
           render : function ( data, type, full, meta) {
            var data = JSON.stringify(full);
               return `
                <div class="text-center">
                  <div class="btn-group m-r-10">
                          <button aria-expanded="false" data-toggle="dropdown" class="btn btn-success dropdown-toggle waves-effect waves-light" type="button">Actions <span class="caret"></span></button>
                          <ul role="menu" class="dropdown-menu">
                              <li><a onclick="openEditModal(this)" style="cursor:pointer;" data-src='${data}'><i class="fa fa-eye"></i> View</a></li>
                              <li><a onclick="openEditModal(this)" style="cursor:pointer;" data-src='${data}'><i class="fa fa-print"></i> Print</a></li>
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

 
}

init();

});


</script>
@endpush
@endsection