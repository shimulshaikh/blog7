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
                          <div id="my_div"></div>
                          <div class="card">
                            <div class="card-header" style="margin-bottom: 15px">
                                   <a href="{{ route('tag.create') }}" class="btn btn-success">Add Tag</a>
                            </div>
                            <div class="card-body">

                                   
                              <table id="data_table" class="table table-striped table-borderd">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Create Time</th>
                                    <th>Update Time</th>
                                    <th width="15%">Action</th>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




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
                    { data: 'actions', name: 'actions' },
                  ]

                });

      
    });
</script>


@if(Session::has('success'))
  <script type="text/javascript">
    toastr.success("{!! Session::get('success') !!}");
  </script>
@endif

@endpush