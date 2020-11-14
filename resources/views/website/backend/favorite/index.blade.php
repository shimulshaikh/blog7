@extends('website.backend.layouts.main')

@section('title','Fav-Post')

@section('content')

 <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Favorite Post</a>
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
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <!-- <th><i class="material-icons">favorite</i></th> -->
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Create Time</th>
                                    <th>Update Time</th>
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
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>



<script type="text/javascript">

        $(document).ready( function () {
          
                $('#data_table').DataTable({
                    order: [[1, 'dsc']],
                    processing: true,
                    serverSide: true,
                    ajax: {
                      url:"{{ route('favorite.index') }}",
                      type: 'GET'
                    },

                    columns: [
                    {"data": "DT_RowIndex", orderable: false, searchable: false},
                    { data: 'title', name: 'title' },
                    { data: 'author', name: 'author' },
                    { data: 'favorite', name: 'favorite' },
                    { data: 'view_count', name: 'view_count' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                  ]

                });

    });
</script>

@endpush

