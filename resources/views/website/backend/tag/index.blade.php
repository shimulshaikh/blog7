@extends('website.backend.layouts.main')

@section('title','Tag')

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
                                   <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Add Tag</a>
                            </div>
                            <div class="card-body">

                                   
                              <table id="data_table" class="table table-striped table-borderd">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Name</th>
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
        <h5 class="modal-title" id="modelHeading">Tag Created</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="Form" name="Form" class="form-horizontal">
                   <input type="hidden" name="tag_id" id="tag_id">
          <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Tag Name</label>
              <div class="col-sm-12">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
              </div>
          </div>
      
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
          
          var table = $('#data_table').DataTable({
                    order: [[1, 'dsc']],
                    processing: true,
                    serverSide: true,
                    ajax: {
                      url:"{{ route('tag.index') }}",
                      type: 'GET'
                    },

                    columns: [
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action' },
                  ]

                });

                //start CRUD  
        $('#createNew').click(function () {
        $('#saveBtn').val("create-tag");
        $('#tag_id').val('');
        $('#Form').trigger("reset");
        $('#modelHeading').html("Create New Tag");
        $('#Modal').modal('show');
        });


        $('body').on('click', '.editTag', function () {
      var tag_id = $(this).data('id');
      $.get("{{ route('tag.index') }}" +'/' + tag_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Tag");
          $('#saveBtn').val("edit-user");
          $('#Modal').modal('show');
          $('#tag_id').val(data.id);
          $('#name').val(data.name);
      })
   });

        $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('save Change');
    
        $.ajax({
          data: $('#Form').serialize(),
          url: "{{ route('tag.store') }}",
          type: "POST",
          dataType: 'json',
          
          success: function (data) {
     
              $('#Form').trigger("reset");
              $('#Modal').modal('hide');
              $('#my_div').html(data);
              table.draw();

              iziToast.success({
                title: 'Tag Saved successfully',
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


       $('body').on('click', '.deleteTag', function () {
     
        var tag_id = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
            type: "DELETE",
            url: "{{ route('tag.store') }}"+'/'+tag_id,
            success: function (data) {
                table.draw();

                iziToast.success({
                title: 'Tag Deleted Successfully',
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