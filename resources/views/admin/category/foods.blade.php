@extends('layouts.master')
@section('title', 'Foods')
@section('sub-title', 'List of all foods')
@section('content')
@prepend('page-css')
<link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endprepend
<div class="pull-right margin-bottom-3">
	<p>
		<button class="btn btn-info waves-effect waves-light" type="button" id="addNewFood">
			<span class="btn-label"><i class="fa fa-plus"></i></span>Add Food
		</button>
	</p>
</div>
<table id="foods" class="display table table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Price</th>
      <th>Actions</th>
		</tr>
	</thead>
<tbody></tbody>
</table>
@component('layouts.modal')
  @slot('id') addFoodModal @endslot
    @slot('title')
        <h4 class="modal-title" id="addCategoryModalHeading">Add Food</h4> </div>
    @endslot
    @slot('body')
      <form onSubmit="return false;">
          <div class="form-group">
              <label for="addFoodName">Food Name</label>
              <div class="input-group">
                  <div class="input-group-addon"><i class="mdi mdi-food"></i></div>
                  <input type="text" class="form-control" id="addFoodName" placeholder="Enter the food name"> 
              </div>
          </div>
          <div class="form-group">
            <label for="addFoodDescription">Food Description</label>
              <div class="input-group">
                  <textarea class="form-control form-control-line" id="addFoodDescription" cols="90" rows="10" placeholder="Enter the food description"></textarea>
              </div>
          </div>
          <div class="form-group">
            <label for="addFoodPrice">Food Price</label>
              <div class="input-group">
                  <div class="input-group-addon"><i class="ti-text"></i></div>
                  <input type="number" class="form-control" id="addFoodPrice" placeholder="Enter the food price">
              </div>
          </div>
          <div class="form-group">
              Food image section
          </div>
    @endslot
    @slot('footer')
    <button type="button" class="btn btn-info waves-effect" id="btnAddFood">Add</button>
    @endslot
@endcomponent

@component('layouts.modal')
  @slot('id') editFoodModal @endslot
    @slot('title')
        <h4 class="modal-title" id="editFoodCategoryHeading">Edit Food</h4> </div>
    @endslot
    @slot('body')
      <form onSubmit="return false;">
        <input type="hidden" id="editFoodId">
          <div class="form-group">
              <label for="editFoodName">Food Name</label>
              <div class="input-group">
                  <div class="input-group-addon"><i class="mdi mdi-food"></i></div>
                  <input type="text" class="form-control" id="editFoodName" placeholder="Enter the food name"> 
              </div>
          </div>
          <div class="form-group">
            <label for="editFoodDescription">Food Description</label>
              <div class="input-group">
                  <textarea class="form-control form-control-line" id="editFoodDescription" cols="90" rows="10" placeholder="Enter the food description"></textarea>
              </div>
          </div>
          <div class="form-group">
            <label for="editFoodPrice">Food Price</label>
              <div class="input-group">
                  <div class="input-group-addon"><i class="mdi mdi-food"></i></div>
                  <input type="number" class="form-control" id="editFoodPrice" placeholder="Enter the food price">
              </div>
          </div>
          <div class="form-group">
              Food image section
          </div>
    @endslot
    @slot('footer')
    <button type="button" class="btn btn-success waves-effect" id="btnUpdateFood">Save</button>
    @endslot
@endcomponent

@component('layouts.modal')
  @slot('id') viewFoodImagesModal @endslot
    @slot('title')
        <h4 class="modal-title" id="viewImageOfFoodTitle">Food Images</h4> </div>
    @endslot
    @slot('body')
        <div id="food-images" class="text-center row"></div>
    @endslot
    @slot('footer')
    @endslot
@endcomponent


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
<script src="https://unpkg.com/@feathersjs/client@^4.3.0/dist/feathers.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<!-- end - This is for export functionality only -->
<script>
// Socket.io setup
const socket = io('http://192.168.1.4:3030');

// Init feathers app
const app = feathers();

// Register socket.io to talk to server
app.configure(feathers.socketio(socket));

function openEditModal(e) {
  let data = JSON.parse(e.getAttribute('data-src'));
  $('#editFoodId').val(data.id);
  $('#editFoodCategoryHeading').text(`Edit ${data.name} food`);
  $('#editFoodName').val(data.name);
  $('#editFoodDescription').val(data.description);
  $('#editFoodPrice').val(data.price);
  $('#editFoodModal').modal('toggle');
}

function openViewImageModal(e) {
  let food = JSON.parse(e.getAttribute('data-src'));
  $('#viewImageOfFoodTitle').text(`Food images of ${food.name}`);
  $('#food-images').html('');
  food.images.forEach((f) => $('#food-images').append(`<div class="col-md-3"><img src="${f.image}" class="img-responsive" alt="" /></div>`) );
  $('#viewFoodImagesModal').modal('toggle');
}

$(document).ready(function() {
  $.ajax({
      url : 'http://192.168.1.4:3030/categories/{{$id}}',
      success : (category) => {
        $('.page-title').text(`${category.name} Foods`);
        document.title = `Mai Place | ${category.name} Foods`;
      }
});
let table = $('#foods').DataTable({
	ajax: {
	    url : 'http://192.168.1.4:3030/foods?category_id={{$id}}',
        cache: true,
        dataSrc : '',
	},
    columns: [
      { data : 'name' },
      { data : 'description' },
      {
         render : function ( data, type, full, meta) {
             return `<div class='text-center'>${full.price}.00</div>`;
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
                            <li><a onclick="openEditModal(this)" style="cursor:pointer;" data-src='${data}'><i class="fa fa-edit"></i> Edit</a></li>
                            <li><a onclick="openViewImageModal(this)" style="cursor:pointer;" data-src='${data}'><i class="fa fa-eye"></i> Images</a></li>
                        </ul>
                 </div>
              </div>
              `;
           }
      }
    ],
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});

$('#addNewFood').click(function (e) {
    // Display the modal.
    $('#addFoodModal').modal('toggle');
});


$('#btnAddFood').click(function (e) {
    let data = {
      name : $('#addFoodName').val(),
      description : $('#addFoodDescription').val(),
      category_id : {{ $id }},
      price : $('#addFoodPrice').val(),
      image : 'https://res.cloudinary.com/dpcxcsdiw/image/upload/v1575443788/mai-place/food.jpg',
    };

    app.service('foods').create(data);
});

$("#btnUpdateFood").click(function (e) {
    let id = $('#editFoodId').val();
    let data = {
      name : $('#editFoodName').val(),
      description : $('#editFoodDescription').val(),
      price : $('#editFoodPrice').val()
    };
    app.service('foods').update(id, data);
});

function init() {
  app.service('foods').on('created', _ => {
    swal("Success!", `Succesfully add new food`, "success");
    table.ajax.reload();
  });

  app.service('foods').on('updated', _ => {
    swal("Success!", `Succesfully update a food`, "success");
    table.ajax.reload();
  });
}
init();

});




</script>
@endpush
@endsection