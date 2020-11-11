@extends('website.backend.layouts.main')

@section('title','Subscriber')

@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">subscriber</a>
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
                            </div>
                            <div class="card-body">

                                   
                              <table id="data_table" class="table table-striped table-borderd">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Create Time</th>
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
                      url:"{{ route('subscribe.index') }}",
                      type: 'GET'
                    },

                    columns: [
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' },
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