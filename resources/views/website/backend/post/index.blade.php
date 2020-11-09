@extends('website.backend.layouts.main')

@section('title','Post')

@section('content')

 <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Post</a>
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
                                   <a class="btn btn-success" href="javascript:void(0)" id="createNew"> Add Post</a>
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

@stop