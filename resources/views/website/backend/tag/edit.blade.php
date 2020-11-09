@extends('website.backend.layouts.main')

@section('title','Tag')

@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Update Tag</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                            <div class="card">
                              <div class="card-body">
                                  <form action="{{route('tag.update',$tag->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $tag->id }}">

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Tag Name</label>

                                        <div class="col-md-6">
                                          <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$tag->name}}" required autocomplete="name" autofocus>
                                          @error('name')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                                      
                                        </div>
                                    </div>  
                                    <button type="submit" class="btn btn-primary">Update</button>

                                  </form>
                              </div>
                            </div>
                          
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

@stop
