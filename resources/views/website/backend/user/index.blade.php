@extends('website.backend.layouts.main')
@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">User Manage</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                          @include('partials.alerts')
                          <div class="card-header">
                            
                            <div class="card-body">
                                   
                                   <table class="table">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Roles</th>
                                          @can('edit-user') 
                                          <th width="20%">Action</th>
                                          @endcan
                                        </tr>
                                      </thead>

                                      @php
                                        $i = 0;
                                      @endphp

                                      <tbody>
                                        @foreach($users as $user)  
                                        <tr>
                                          <th scope="row">{{++$i}}</th>
                                          <td>{{ $user->name }}</td>
                                          <td>{{ $user->email }}</td>
                                          <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                          <td>
                                            @can('edit-user')
                                              <a href="{{route('user.edit',$user->id)}}"><button type="button" class="btn btn-info btn-sm pull-left" style="margin-right: 4px;"><i class="far fa-edit"></i>Edit</button></a>
                                            @endcan
                                            @can('delete-user')  
                                              <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                  <button class="btn btn-danger btn-sm" onclick="return confirm('Are You sure want to delete !')">Delete</button>
                                              </form>
                                            @endcan  
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                      
                                  </table>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

@endsection
