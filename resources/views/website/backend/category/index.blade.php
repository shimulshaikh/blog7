@extends('website.backend.layouts.main')

@section('title','Category')

@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Tag</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                          @include('partials.alerts')
                          <div id="my_div"></div>
                          <div class="card">
                            <div class="card-header" style="margin-bottom: 15px">
                              <!-- Button trigger modal -->
                                   <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Add Category</a>
                            </div>
                            <div class="card-body">

                                   
                              <table id="data_table" class="table table-striped table-borderd">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Create Time</th>
                                    <th>Update Time</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                              </table>    

                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="Modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modelHeading">Category Created</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="Form" method="POST" name="Form" class="form-horizontal" enctype="multipart/form-data">
                   <input type="hidden" name="category_id" id="category_id">
          <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-12">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
              </div>
          </div>

          <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Image</label>
              <div class="col-sm-12">
                <input type="file" class="form-control @error('image') is-danger @enderror" id="image" name="image" 
                  accept = 'image/jpeg , image/jpg, image/gif, image/png, image/svg, image/webp' onchange="previewFile(this)"> 

                    @error('image')
                      <p class="help is-danger">{{ $errors->first('image') }}</p>
                    @enderror
                    <img id="previewImg" style="max-width: 130px;margin-top: 20px;">
              </div>
          </div>

          <!-- <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100"> -->
      
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@stop



@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<!-- For ajax CRUD use shimul -->
<script src="https://cdn.jsdelivr.net/npm/popper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>




<script type="text/javascript">

        $(document).ready( function () {

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          
        var table =  $('#data_table').DataTable({
                    order: [[1, 'dsc']],
                    processing: true,
                    serverSide: true,
                    ajax: {
                      url:"{{ route('category.index') }}",
                      type: 'GET'
                    },

                    columns: [
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    { data: 'name', name: 'name' },
                    { data: 'image', name: 'image' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action' },
                  ]

                });

                //start CRUD  
        /*  When user click add user button */       
        $('#createNew').click(function () {
        $('#saveBtn').val("create-tag");
        $('#category_id').val('');
        $('#Form').trigger("reset");
        $('#modelHeading').html("Create New Category");
        $('#Modal').modal('show');
        });

        /* When click edit user */
        $('body').on('click', '.editCategory', function () {
      var category_id = $(this).data('id');
      $.get("{{ route('category.index') }}" +'/' + category_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Tag");
          $('#saveBtn').val("edit-user");
          $('#Modal').modal('show');
          $('#category_id').val(data.id);
          $('#name').val(data.name);
          $('#image').val(data.image);
      })
   });

        $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('save Change');
    
        $.ajax({
          data: $('#Form').serialize(),
          url: "{{ route('category.store') }}",
          type: "POST",
          dataType: 'json',
          
          success: function (data) {
     
              $('#Form').trigger("reset");
              $('#Modal').modal('hide');
              $('#my_div').html(data);
              table.draw();

              iziToast.success({
                title: 'Category Saved successfully',
                message: '{{ Session('success') }}',
                position: 'bottomRight'
              });

          },

          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });


       $('body').on('click', '.deleteCategory', function () {
     
        var category_id = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
            type: "DELETE",
            url: "{{ route('category.store') }}"+'/'+category_id,
            success: function (data) {
                table.draw();

                iziToast.success({
                title: 'Category Deleted Successfully',
                message: '{{ Session('success') }}',
                position: 'bottomRight'
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
          });
        }
        
    }); 


    });
</script>

@endpush