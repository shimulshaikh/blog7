@extends('website.backend.layouts.main')

@section('title','Category')

@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Add Category</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                            <div class="card">
                              <div class="card-body">
                                  <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Category Name</label>

                                        <div class="col-md-6">
                                          <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required autocomplete="name" autofocus>
                                          @error('name')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                                      
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                      <label for="image" class="col-md-2 col-form-label text-md-right">Image</label>

                                        <div class="col-md-6 col-md-6">
                                          <input type="file" class="form-control @error('image') is-danger @enderror" name="image" 
                                            accept = 'image/jpeg , image/jpg, image/gif, image/png, image/svg, image/webp' onchange="previewFile(this)">  

                                          @error('image')
                                            <p class="help is-danger">{{ $errors->first('image') }}</p>
                                          @enderror

                                          <img id="previewImg" style="max-width: 130px;margin-top: 20px;">
                                                      
                                        </div>
                                    </div> 

                                    <button type="submit" class="btn btn-primary">Submit</button>

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
