@extends('layouts.master')
@section('title', 'Categories')
@section('sub-title', 'List of all categories')
@section('content')
@prepend('page-css')
<link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.css">
@endprepend
<div class="pull-right margin-bottom-3">
	<p>
		<button class="btn btn-info waves-effect waves-light" type="button" id="addNewCategory">
			<span class="btn-label"><i class="fa fa-plus"></i></span>Add Category
		</button>
	</p>
</div>
<table id="categories" class="display table table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
	{{-- 		<th>Image</th> --}}
			<th>Actions</th>
		</tr>
	</thead>
<tbody></tbody>
</table>



@component('layouts.modal')
	@slot('id') addCategoryModal @endslot
    @slot('title')
       	<h4 class="modal-title" id="addCategoryModalHeading">Add Category</h4> </div>
    @endslot
    @slot('body')
	    <form onSubmit="return false;">
	    	<div id="loader" class="ldld" style="position:absolute; z-index: 999; top : 50%; right : 45%;">
	    		<img src="/loader.gif" width="50">
	    	</div>
	        <div class="form-group">
	            <label for="categoryName">Category Name</label>
	            <div class="input-group">
	                <div class="input-group-addon"><i class="mdi mdi-food"></i></div>
	                <input type="text" class="form-control" id="addCategoryName" placeholder="Enter the category name"> 
	            </div>
	        </div>
	        <div class="form-group">
	        	<label for="categoryName">Category Description</label>
	            <div class="input-group">
	                <textarea class="form-control form-control-line" id="addCategoryDescription" cols="90" rows="10" placeholder="Enter the category description"></textarea>
	            </div>
	        </div>
	        <div class="form-group">
				 <input name="file" type="file" id="categoryImage" /> 
	        </div>
    @endslot
    @slot('footer')
		<button type="button" class="btn btn-info waves-effect" id="btnAddCategory">Add</button>
    @endslot
@endcomponent

@component('layouts.modal')
	@slot('id') editCategoryModal @endslot
    @slot('title')
       <h4 class="modal-title" id="editCategoryModalHeading">Modal Heading</h4> </div>
    @endslot
    @slot('body')
	    <form onSubmit="return false;">
	    	<div id="edit-loader" class="ldld" style="position:absolute; z-index: 999; top : 50%; right : 45%;">
	    		<img src="/loader.gif" width="50">
	    	</div>
	        <div class="form-group">	
	            <input type="hidden" id="categoryID">
	            <label for="categoryName">Category Name</label>
	            <div class="input-group">
	                <div class="input-group-addon"><i class="mdi mdi-food"></i></div>
	                <input type="text" class="form-control" id="categoryName" placeholder="Enter the category name"> 
	            </div>
	        </div>
	        <div class="form-group">
	        	<label for="categoryName">Category Description</label>
	            <div class="input-group">
	                <textarea class="form-control form-control-line" id="categoryDescription" cols="90" rows="10" placeholder="Enter the category description"></textarea>
	            </div>
	        </div>
        	<div class="form-group">
        		<img id="editCategoryImage" class="img-responsive center-block" alt="category image">
        	</div>
	        <div class="form-group">
	        	<label for="updateCategoryImage">Edit image by clicking the choose file</label>
				 <input name="file" type="file" id="updateCategoryImage" /> 
	        </div>
    @endslot
    @slot('footer')
		<button type="button" class="btn btn-success waves-effect" id="btnSaveEditedCategory">Save</button>	
    @endslot
@endcomponent

@component('layouts.modal')
	@slot('id') hidingCategoryModal @endslot
    @slot('title')
       <h4 class="modal-title">Remove category from menu</h4> </div>
    @endslot
    @slot('body')
	    <div class="text-center">
		   Are you sure to hide this category to the menu?
	    </div>
	   <input type="hidden" id="hideMenuCategoryId">
    @endslot
    @slot('footer')
		<button type="button" class="btn btn-success waves-effect" id="btnHideCategoryFromMenu">Yes</button>	
    @endslot
@endcomponent

@push('page-scripts')
{{-- <script src="/plugins/bower_components/datatables/jquery.dataTables.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.js"></script>

<!-- end - This is for export functionality only -->
<script>
// Socket.io setup
const socket = io(window.api_url);

// Init feathers app
const app = feathers();

// Register socket.io to talk to server
app.configure(feathers.socketio(socket));

let loader = new ldLoader({ root: "#loader" }); 
let editLoader = new ldLoader({ root: "#edit-loader" }); 



function openEditModal(e) {
	let data = JSON.parse(e.getAttribute('data-src'));
	$('#categoryID').val(data.id);
	$('#editCategoryImage').attr('src', data.image);
	$('#editCategoryModalHeading').text(`Edit Category ${data.name}`);
	$('#categoryName').val(data.name);
	$('#categoryDescription').val(data.description);
	$('#editCategoryModal').modal('toggle');
}

function hideCategoryModal(e) {
	let data = JSON.parse(e.getAttribute('data-src'));
	$('#hideMenuCategoryId').val(data.id);
	$('#hidingCategoryModal').modal('toggle');
}


$(document).ready(function() {
let table = $('#categories').DataTable({
	ajax: {
	    url :  window.api_url +'categories',
         cache: true,
         dataSrc : '',
	},
    columns: [
      { data : 'name' },
      { data : 'description' },
      // {
      //    render : function ( data, type, full, meta) {
      //        return `<div class='text-center'><img width="50" src="${full.image}" alt="" /></div>`;
      //    }
      // },
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
                            <li><a onclick="hideCategoryModal(this)" style="cursor:pointer;" data-src='${data}'><i class="fa fa-edit"></i> Remove from menu</a></li>
                            <li><a href="/admin/category/${JSON.parse(data).id}/foods" data-src='${data}'><i class="fa fa-spoon"></i> Foods <span class="badge">${Object.keys(full.foods).length}</span></a></li>
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
                    columns: [ 0, 1]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1 ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1 ]
                }
            }
    ]
});

$('#addNewCategory').click(function () {
	$('#addCategoryModal').modal('toggle');
});

$('#btnHideCategoryFromMenu').click(function (e) {
	e.preventDefault();
	let id = $('#hideMenuCategoryId').val();
	app.service('categories').update(id, {status : 'in_active'});
});

$('#btnSaveEditedCategory').click(function (e) {
	e.preventDefault();
	editLoader.toggle();
	let thisBtn = $(this);
	let formData = new FormData();
	let updateCategoryImage = document.querySelector('#updateCategoryImage');
	let id  = $('#categoryID').val();

	let data = {
		name :  $('#categoryName').val(),
		description : $('#categoryDescription').val(),
		image : $('#editCategoryImage').attr('src'),
	};

	thisBtn.attr('disabled', true);

	// Check if their's an image
	if (typeof updateCategoryImage.files[0] != 'undefined') {
		Array.from(updateCategoryImage.files).forEach((file, index) => { 
          formData.append(`images[]`, file);
    	});
		fetch('/admin/uploader', {method: "POST", body: formData})
		 	.then((resp) => resp.json())
		 	.then((response) => {
		 		editLoader.toggle();
		 		data.image =  response.image[0];
				app.service('categories').update(id, data);
				$('#editCategoryImage').attr('src',  response.image[0]);
				thisBtn.attr('disabled', false);
		 	});	
	} else {
		editLoader.toggle();
		app.service('categories').update(id, data);
		thisBtn.attr('disabled', false);
	}



	
});

$('#btnAddCategory').click(function (e) {
	e.preventDefault();
	loader.toggle();
	let thisBtn = $(this);
	let categoryImage = document.querySelector('#categoryImage');
	let formData = new FormData();
	let data = {
		name :  $('#addCategoryName').val(),
		description : $('#addCategoryDescription').val(),
		image : 'https://res.cloudinary.com/dpcxcsdiw/image/upload/v1575443788/mai-place/food.jpg'
	};
	thisBtn.attr('disabled', true);
	// Check if their's an image
	if (typeof categoryImage.files[0] != 'undefined') {
    Array.from(categoryImage.files).forEach((file, index) => { 
          formData.append(`images[]`, file);
    });
		fetch('/admin/uploader', {method: "POST", body: formData})
		 	.then((resp) => resp.json()).
		 	then((response) => {
		 		loader.toggle();
		 		data.image = response.image[0];
				app.service('categories').create(data);
				thisBtn.attr('disabled', false);
		 	});	
	} else {
		loader.toggle();
		app.service('categories').create(data);
		thisBtn.attr('disabled', false);
	}
	
});

function init() {
	app.service('categories').on('updated', (data) => {
		if(data.hasOwnProperty('status')) {
			swal("Success!", `Succesfully remove ${data.name} from menu`, "success");
			$('#hidingCategoryModal').modal('toggle');
		} else {
		swal("Success!", `Succesfully update a category`, "success");
		}
		table.ajax.reload();
	});

	app.service('categories').on('created', (data) => {
		swal("Success!", `Succesfully add new category`, "success");
		table.ajax.reload();
	});

}

init();

});
</script>
@endpush
@endsection