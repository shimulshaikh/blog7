@extends('website.frontend.layouts.main')

@section('title','Tag')

@section('content')

  <div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{ $tag->name }}</b></h1>
  </div><!-- slider -->

  <section class="blog-area section">
    <div class="container">

      <div class="row">
        @if($posts->count() > 0)
         @foreach($posts as $post) 
          <div class="col-lg-4 col-md-6">
              <div class="card h-100">
                <div class="single-post post-style-1">

                  <div class="blog-image"><img src="{{ asset('/storage/post') }}/{{ $post->image  }}" alt="{{ $post->title  }}"></div>

                  <div class="blog-info">

                    <h4 class="title"><a href="{{route('post.details',$post->slug)}}"><b>{{ $post->title  }}</b></a></h4>

                    <ul class="post-footer">

                      <li>
                        @guest
                            <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','info',{
                                  closeButton:true,
                                  progressBar:true,
                            })">
                              <i class="material-icons">favorite</i>{{ $post->favorite_user->count() }}
                            </a>
                        @else
                            <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();" class="{{ !Auth::user()->favorite_post->where('pivot.post_id',$post->id)->count() == 0 ? 'favorite_post_color' : '' }}">
                              <i class="material-icons">favorite</i>{{ $post->favorite_user->count() }}
                            </a>
                            <form id="favorite-form-{{ $post->id }}" method="POST" action="{{route('post.favorite', $post->id )}}" style="display: none;">
                              @csrf
                            </form>
                        @endguest
                      </li>
                      <li><a href="#"><i class="material-icons">comment</i>6</a></li>
                      <li><a href="#"><i class="material-icons">visibility</i>{{ $post->view_count  }}</a></li>
                    </ul>

                  </div><!-- blog-info -->
                </div><!-- single-post -->
              </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
         @endforeach 
        @else
          <div class="col-lg-12 col-md-12">
              <div class="card h-100">
                <div class="single-post post-style-1">
                  <div class="blog-info">
                    <h4 class="title">
                      <strong>Sorry, No Post Found :(</strong>
                    </h4>
                  </div><!-- blog-info -->
                </div><!-- single-post -->
              </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
        @endif 
      </div><!-- row -->

    </div><!-- container -->
  </section><!-- section -->


@stop

@push('css')
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{asset('frontend/category/css/styles.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/category/css/responsive.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- For favorite Icon color chanding -->
  <style type="text/css">
    .favorite_post_color{
      color: blue;
    }
  </style>
@endpush


@push('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{!! Toastr::message() !!}

<script type="text/javascript">
  @if ($errors->any())  
    @foreach($errors->all() as $error)
      toastr.error('{{ $error }}', 'Error',{
        closeButton:true,
        progressBar:true,
      });
    @endforeach
  @endif 
</script>

@endpush
