@extends('website.backend.layouts.main')

@section('title','Post')

@section('content')

    <div class="main-content-part">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab">Show Post</a>
            </li>                    
        </ul>

          <a class="btn btn-primary waves-effect" href="{{route('post.index')}}">BACK</a>

          @if($post->is_approved == true)
            <button type="button" class="btn btn-success pull-right" disabled>
              <span>Approved</span>
            </button>
          @else
            <!-- <form  action="{{route('post.approve',$post->id)}}" method="POST">
              @csrf                                              
              @method('PUT') -->
                <button type="button" class="btn btn-success pull-right">
                  <span>Approved</span>
                </button>
            <!-- </form> --> 
          @endif 
      
            <div class="container-fluid">

              <div class="row clearfix">

                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="header">
                      <h2>{{ $post->title }}</h2>
                      <small>Posted By <strong><a href="">{{$post->user->name}}</a></strong> on {{$post->created_at->toFormattedDateString()}}</small>
                    </div>

                    <div class="body">
                      {!! $post->body !!}
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="header badge-default">
                      <h2>Categories</h2>
                    </div>

                    <div class="body">
                      @foreach($post->categories as $category)
                        <span class="badge badge-default">{{ $category->name }}</span>  
                      @endforeach
                    </div>
                  </div>

                  <div class="card">
                    <div class="header badge-default">
                      <h2>Tags</h2>
                    </div>

                    <div class="body">
                      @foreach($post->tags as $tag)
                        <span class="badge badge-default">{{ $tag->name }}</span>  
                      @endforeach
                    </div>
                  </div>

                  <div class="card">
                    <div class="header badge-default">
                      <h2>Feature Image</h2>
                    </div>

                    <div class="body">
                      <img class="img responsive thumbnail" src="{{ asset('/storage/post') }}/{{ $post->image  }}" alt="">
                    </div>
                  </div>
                </div>

              </div>
            </div>
        </div>
    </div>

@stop

@push('css')
<!-- <link rel=stylesheet href="https://s3-us-west-2.amazonaws.com/colors-css/2.2.0/colors.min.css"> -->
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
