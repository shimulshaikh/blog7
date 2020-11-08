<!DOCTYPE html>
<html lang="en">
<head>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Laravel Ajax Crud Example with Image Upload Tutorial - Tuts Make</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-product">Add New</a>
<br><br></br><br>
<table class="table table-bordered table-striped" id="laravel_datatable">
<thead>
<tr>
<th>ID</th>
<th>S. No</th>
<th>Image</th>
<th>Title</th>
<th>Product Code</th>
<th>Description</th>
<th>Created at</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>
<div class="modal fade" id="ajax-product-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="productCrudModal"></h4>
</div>
<div class="modal-body">
<form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="product_id" id="product_id">
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Title</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="title" name="title" placeholder="Enter Tilte" value="" maxlength="50" required="">
</div>
</div>
<div class="form-group">
<label for="name" class="col-sm-2 control-label">Product Code</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Tilte" value="" maxlength="50" required="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Description</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" required="">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Image</label>
<div class="col-sm-12">
<input id="image" type="file" name="image" accept="image/*" onchange="readURL(this);">
<input type="hidden" name="hidden_image" id="hidden_image">
</div>
</div>
<img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
</button>
</div>
</form>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div> 
</body>
</html>



<script>
var SITEURL = '{{URL::to('')}}';
$(document).ready( function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$('#laravel_datatable').DataTable({
processing: true,
serverSide: true,
ajax: {
url: SITEURL + "product-list",
type: 'GET',
},
columns: [
{data: 'id', name: 'id', 'visible': false},
{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
{data: 'image', name: 'image', orderable: false},
{ data: 'title', name: 'title' },
{ data: 'product_code', name: 'product_code' },
{ data: 'description', name: 'description' },
{ data: 'created_at', name: 'created_at' },
{data: 'action', name: 'action', orderable: false},
],
order: [[0, 'desc']]
});
/*  When user click add user button */
$('#create-new-product').click(function () {
$('#btn-save').val("create-product");
$('#product_id').val('');
$('#productForm').trigger("reset");
$('#productCrudModal').html("Add New Product");
$('#ajax-product-modal').modal('show');
$('#modal-preview').attr('src', 'https://via.placeholder.com/150');
});
/* When click edit user */
$('body').on('click', '.edit-product', function () {
var product_id = $(this).data('id');
$.get('product-list/' + product_id +'/edit', function (data) {
$('#title-error').hide();
$('#product_code-error').hide();
$('#description-error').hide();
$('#productCrudModal').html("Edit Product");
$('#btn-save').val("edit-product");
$('#ajax-product-modal').modal('show');
$('#product_id').val(data.id);
$('#title').val(data.title);
$('#product_code').val(data.product_code);
$('#description').val(data.description);
$('#modal-preview').attr('alt', 'No image available');
if(data.image){
$('#modal-preview').attr('src', SITEURL +'public/product/'+data.image);
$('#hidden_image').attr('src', SITEURL +'public/product/'+data.image);
}
})
});
$('body').on('click', '#delete-product', function () {
var product_id = $(this).data("id");
if(confirm("Are You sure want to delete !")){
$.ajax({
type: "get",
url: SITEURL + "product-list/delete/"+product_id,
success: function (data) {
var oTable = $('#laravel_datatable').dataTable(); 
oTable.fnDraw(false);
},
error: function (data) {
console.log('Error:', data);
}
});
}
});  
});
$('body').on('submit', '#productForm', function (e) {
e.preventDefault();
var actionType = $('#btn-save').val();
$('#btn-save').html('Sending..');
var formData = new FormData(this);
$.ajax({
type:'POST',
url: SITEURL + "product-list/store",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$('#productForm').trigger("reset");
$('#ajax-product-modal').modal('hide');
$('#btn-save').html('Save Changes');
var oTable = $('#laravel_datatable').dataTable();
oTable.fnDraw(false);
},
error: function(data){
console.log('Error:', data);
$('#btn-save').html('Save Changes');
}
});
});
function readURL(input, id) {
id = id || '#modal-preview';
if (input.files &amp;&amp; input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$(id).attr('src', e.target.result);
};
reader.readAsDataURL(input.files[0]);
$('#modal-preview').removeClass('hidden');
$('#start').hide();
}
}
</script>

