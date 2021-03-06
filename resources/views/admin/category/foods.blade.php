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
			<span class="btn-label"><i class="fa fa-plus"></i></span>Add food for this category
		</button>
	</p>
</div>
<table id="foods" class="display table table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Price</th>
      <th>Image</th>
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
                  <div class="input-group-addon"><i class="mdi mdi-cash"></i></div>
                  <input type="number" class="form-control" id="addFoodPrice" placeholder="Enter the food price">
              </div>
          </div>
          <div class="form-group">
                <label>Food Image</label>
                <input name="file" type="file" id="addFoodImages" required /> 
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
        <input type="hidden" id="editFoodImageId">
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
                  <div class="input-group-addon"><i class="mdi mdi-cash"></i></div>
                  <input type="number" class="form-control" id="editFoodPrice" placeholder="Enter the food price">
              </div>
          </div>
          <div id="edit-food-images" class="row"></div>
          <br>
          <div class="form-group">
                <label>Food Image</label>
                <input name="file" type="file" id="updateFoodImages" required /> 
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
<!-- end - This is for export functionality only -->
<script>
// Socket.io setup
const socket = io(window.api_url);

// Init feathers app
const app = feathers();

// Register socket.io to talk to server
app.configure(feathers.socketio(socket));

function openEditModal(e) {
  let data = JSON.parse(e.getAttribute('data-src'));
  $('#editFoodId').val(data.id);
  $('#editFoodImageId').val(data.images[0].id);
  $('#editFoodCategoryHeading').text(`Edit ${data.name} food`);
  $('#editFoodName').val(data.name);
  $('#editFoodDescription').val(data.description);
  $('#editFoodPrice').val(data.price);
  $('#edit-food-images').html('');
  data.images.forEach((f) => $('#edit-food-images').append(`<div class="col-md-12"><img src="${f.image}" class="img-responsive center-block" alt="" /></div>`) );
  $('#editFoodModal').modal('toggle');
}

function openViewImageModal(e) {
  let food = JSON.parse(e.getAttribute('data-src'));

  $('#viewImageOfFoodTitle').text(`Food images of ${food.name}`);
  $('#food-images').html('');
  food.images.forEach((f) => $('#food-images').append(`<div class="col-md-12"><img src="${f.image}" class="img-responsive center-block" alt="" /></div>`) );
  $('#viewFoodImagesModal').modal('toggle');
}

$(document).ready(function() {
  $.ajax({
      url :  window.api_url + '{{$id}}',
      success : (category) => {
        $('.page-title').text(`${category.name} Foods`);
        document.title = `Mai Place | ${category.name} Foods`;
        $('#addNewFood').text(`Add food for ${category.name} category`);
      }
});

let table = $('#foods').DataTable({
	ajax: {
	      url : 'https://mai-place-api.herokuapp.com/foods?category_id={{$id}}',
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
         render : function ( data, type, full, meta) {
             return `<div class='text-center'><img width="50" src="${full.images[0].image}" alt="" /></div>`;
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
                            <li><a onclick="openViewImageModal(this)" style="cursor:pointer;" data-src='${data}'><i class="fa fa-eye"></i> Images <span class="badge">${Object.keys(full.images).length}</span> </a></li>
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
                    columns: [ 0, 1, 2]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            {
                extend: 'print',
                title: 'Foods',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            }
    ]
});

$('#addNewFood').click(function (e) {
    // Display the modal.
    $('#addFoodModal').modal('toggle');
});


$('#btnAddFood').click(function (e) {
    let formData = new FormData();
    let addFoodImages = document.querySelector('#addFoodImages');
    let data = {
      name : $('#addFoodName').val(),
      description : $('#addFoodDescription').val(),
      category_id : {{ $id }},
      price : $('#addFoodPrice').val(),
      images : ['https://res.cloudinary.com/dpcxcsdiw/image/upload/v1575443788/mai-place/food.jpg'],
    };
    
    if (typeof addFoodImages.files[0] != 'undefined') {
      Array.from(addFoodImages.files).forEach((file, index) => { 
        formData.append(`images[]`, file);
      });

      fetch('/admin/uploader', {method: "POST", body: formData})
        .then((resp) => resp.json()).
        then((response) => {
           data.images = response.image;
           app.service('foods').create(data);
        });   
    } else {
        app.service('foods').create(data);
    }
});

$('#btnUpdateFood').click(function (e) {
    let formData = new FormData();
    let updateFoodImages = document.querySelector('#updateFoodImages');
    let id = $('#editFoodId').val();
    let data = {
      name : $('#editFoodName').val(),
      description : $('#editFoodDescription').val(),
      price : $('#editFoodPrice').val(),
    };

    if (typeof updateFoodImages.files[0] != 'undefined') {
        Array.from(updateFoodImages.files).forEach((file, index) => { 
          formData.append(`images[]`, file);
        });

        fetch('/admin/uploader', {method: "POST", body: formData})
          .then((resp) => resp.json())
          .then((response) => {
             data.food_images_id = $('#editFoodImageId').val();
             data.images = response.image;
             $('#edit-food-images').html('')
             $('#edit-food-images').append(`<div class="col-md-12"><img src="${response.image}" class="img-responsive center-block" alt="" /></div>`);
             app.service('foods').update(id, data);
        }); 
    } else {
      app.service('foods').update(id, data);
    }
   
});

function init() {
  app.service('foods').on('created', _ => {
    swal("Success!", `Succesfully add new food`, "success");
    table.ajax.reload();
  });

  app.service('foods').on('updated', (data) => {
    swal("Success!", `Succesfully update a food`, "success");
    table.ajax.reload();
  });
}
init();

});




</script>
@endpush
@endsection