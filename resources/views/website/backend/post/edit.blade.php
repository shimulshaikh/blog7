@extends('website.backend.layouts.main')

@section('title','Post')

@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Edit Post</a>
            </li>                    
        </ul>

        <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="x_content">
                      <div class="row justity-content-center">
                        <div class="col-md-12">
                            <div class="card">
                              <div class="card-body">
                                  <form action="{{route('post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    @method('PUT')
                                    
                                    <div class="form-group row {{$errors->has('tags') ? 'focused error': ''}}">
                                      <label for="tags" class="col-md-2 col-form-label text-md-right">Post Tag</label>

                                        <div class="col-md-6">
                                          <select class="form-control select2 show-tick" data-live-search="true" name="tags[]" id="tags" multiple>
                                          
                                          @foreach(\App\Tag::all() as $tag) 
                                           <option

                                            @foreach($post->tags as $postTag)
                                                {{ $postTag->id == $tag->id ? 'selected' : ''}}
                                            @endforeach

                                            value="{{ $tag->id }}">{{ $tag->name }}</option>
                                          @endforeach
                                        </select>       
                                        </div>
                                    </div> 

                                    <div class="form-group row {{$errors->has('categories') ? 'focused error': ''}}">
                                      <label for="categories" class="col-md-2 col-form-label text-md-right">Post Category</label>

                                        <div class="col-md-6">
                                          <select class="form-control select2 show-tick" data-live-search="true" name="categories[]" id="categories" multiple>
                                          @foreach(\App\Category::all() as $category) 
                                           <option
                                              @foreach($post->categories as $postCategory)
                                                {{ $postCategory->id == $category->id ? 'selected' : ''}}
                                              @endforeach
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                          @endforeach
                                        </select>       
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                      <label for="brand_name" class="col-md-2 col-form-label text-md-right">Post Title</label>

                                        <div class="col-md-6">
                                          <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$post->title}}" required autocomplete="title" autofocus>
                                          @error('title')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                          @enderror
                                                      
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                      <label for="image" class="col-md-2 col-form-label text-md-right">Post Image</label>

                                        <div class="col-md-6 col-md-6">
                                          <input type="file" class="form-control @error('image') is-danger @enderror" name="image" 
                                            accept = 'image/jpeg , image/jpg, image/gif, image/png, image/svg, image/webp' onchange="previewFile(this)">  

                                          @error('image')
                                            <p class="help is-danger">{{ $errors->first('image') }}</p>
                                          @enderror

                                          <img id="previewImg" style="max-width: 130px;margin-top: 20px;">
                                                      
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                      <label for="image" class="col-md-2 col-form-label text-md-right">Post Body</label>

                                        <div class="col-md-6 col-md-6">
                                             <textarea id="mytextarea" name="body">{{$post->body}}</textarea>
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

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="https://cdn.tiny.cloud/1/l3nkeyo8h0c8xk2felh2i8xpp36zlhdxrs64hi10lghonl5k/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  $(document).ready(function() {
      $('.select2').select2();
  });  
</script>

<script>
  tinymce.init({
      selector: '#mytextarea'
  });  
</script>
@endpush
