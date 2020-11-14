@extends('website.frontend.layouts.main')

@section('title','Home')

@section('content')

<div class="header-bg">

</div><!-- slider -->

  <section class="post-area section">
    <div class="container">

      <div class="row">

        <div class="col-lg-8 col-md-12 no-right-padding">

          <div class="main-post">

            <div class="blog-post-inner">

              <div class="middle-area">
                  <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                  <h6 class="date">on {{ $post->created_at->format('D, d M Y h:i A') }}</h6>
              </div>

              <div class="post-info">

                <!-- <div class="left-area">
                  <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                </div> -->

                

              </div><!-- post-info -->

              <h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

              <p class="para">{!! html_entity_decode($post->body) !!}</p>

              <div class="post-image"><img src="images/blog-1-1000x600.jpg" alt="Blog Image"></div>

              <p class="para">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
              ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
              nulla pariatur. Excepteur sint
              occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>

              <ul class="tags">
                <li>
                  <a href="#">
                    @foreach($post->tags as $tag)
                      {{ $tag->name }}
                    @endforeach
                  </a>
                </li>
              </ul>
            </div><!-- blog-post-inner -->

            <div class="post-icons-area">
              <ul class="post-icons">
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

              <ul class="icons">
                <li>SHARE : </li>
                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
              </ul>
            </div>


          </div><!-- main-post -->
        </div><!-- col-lg-8 col-md-12 -->

        <div class="col-lg-4 col-md-12 no-left-padding">

          <div class="single-post info-area">

            <div class="sidebar-area about-area">
              <h4 class="title"><b>ABOUT </b></h4>
              <p>You are {{ $post->user->name }}</p>
            </div>



            <div class="tag-area">

              <h4 class="title"><b>CATEGORY CLOUD</b></h4>
              <ul>
                <li>
                  <a href="#">
                    @foreach($post->categories as $category)
                        {{ $category->name }}
                    @endforeach
                  </a>  
                </li>
              </ul>

            </div><!-- subscribe-area -->

          </div><!-- info-area -->

        </div><!-- col-lg-4 col-md-12 -->

      </div><!-- row -->

    </div><!-- container -->
  </section><!-- post-area -->


  <section class="recomended-area section">
    <div class="container">
      <div class="row">
        @foreach($randomPosts as $randomPost)      
          <div class="col-lg-4 col-md-6">
            <div class="card h-100">
              <div class="single-post post-style-1">

                <div class="blog-image"><img src="{{ asset('/storage/post') }}/{{ $randomPost->image  }}" alt="{{ $randomPost->title  }}" alt="Blog Image"></div>

                <!-- <a class="avatar" href="#"><img src="images/icons8-team-355979.jpg" alt="Profile Image"></a> -->

                <div class="blog-info">

                  <h4 class="title"><a href="{{route('post.details',$randomPost->slug)}}"><b>{{ $randomPost->title }}</b></a></h4>

                  <ul class="post-footer">
                    <li>
                      @guest
                          <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','info',{
                                closeButton:true,
                                progressBar:true,
                          })">
                            <i class="material-icons">favorite</i>{{ $randomPost->favorite_user->count() }}
                          </a>
                      @else
                          <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $randomPost->id }}').submit();" class="{{ !Auth::user()->favorite_post->where('pivot.post_id',$randomPost->id)->count() == 0 ? 'favorite_post_color' : '' }}">
                            <i class="material-icons">favorite</i>{{ $randomPost->favorite_user->count() }}
                          </a>
                          <form id="favorite-form-{{ $randomPost->id }}" method="POST" action="{{route('post.favorite', $randomPost->id )}}" style="display: none;">
                            @csrf
                          </form>
                      @endguest
                    </li>
                    <li><a href="#"><i class="material-icons">comment</i>6</a></li>
                    <li><a href="#"><i class="material-icons">visibility</i>{{ $randomPost->view_count  }}</a></li>
                  </ul>

                </div><!-- blog-info -->
              </div><!-- single-post -->
            </div><!-- card -->
          </div><!-- col-md-6 col-sm-12 -->
        @endforeach  
      </div><!-- row -->

    </div><!-- container -->
  </section>

  <section class="comment-section">
    <div class="container">
      <h4><b>POST COMMENT</b></h4>
      <div class="row">

        <div class="col-lg-8 col-md-12">
          <div class="comment-form">
            <form method="post">
              <div class="row">

                <div class="col-sm-6">
                  <input type="text" aria-required="true" name="contact-form-name" class="form-control"
                    placeholder="Enter your name" aria-invalid="true" required >
                </div><!-- col-sm-6 -->
                <div class="col-sm-6">
                  <input type="email" aria-required="true" name="contact-form-email" class="form-control"
                    placeholder="Enter your email" aria-invalid="true" required>
                </div><!-- col-sm-6 -->

                <div class="col-sm-12">
                  <textarea name="contact-form-message" rows="2" class="text-area-messge form-control"
                    placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                </div><!-- col-sm-12 -->
                <div class="col-sm-12">
                  <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                </div><!-- col-sm-12 -->

              </div><!-- row -->
            </form>
          </div><!-- comment-form -->

          <h4><b>COMMENTS(12)</b></h4>

          <div class="commnets-area">

            <div class="comment">

              <div class="post-info">

                <div class="left-area">
                  <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                </div>

                <div class="middle-area">
                  <a class="name" href="#"><b>Katy Liu</b></a>
                  <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                </div>

                <div class="right-area">
                  <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                </div>

              </div><!-- post-info -->

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                Ut enim ad minim veniam</p>

            </div>

            <div class="comment">
              <h5 class="reply-for">Reply for <a href="#"><b>Katy Lui</b></a></h5>

              <div class="post-info">

                <div class="left-area">
                  <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                </div>

                <div class="middle-area">
                  <a class="name" href="#"><b>Katy Liu</b></a>
                  <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                </div>

                <div class="right-area">
                  <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                </div>

              </div><!-- post-info -->

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                Ut enim ad minim veniam</p>

            </div>

          </div><!-- commnets-area -->

          <div class="commnets-area ">

            <div class="comment">

              <div class="post-info">

                <div class="left-area">
                  <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                </div>

                <div class="middle-area">
                  <a class="name" href="#"><b>Katy Liu</b></a>
                  <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                </div>

                <div class="right-area">
                  <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                </div>

              </div><!-- post-info -->

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                Ut enim ad minim veniam</p>

            </div>

          </div><!-- commnets-area -->

          <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

        </div><!-- col-lg-8 col-md-12 -->

      </div><!-- row -->

    </div><!-- container -->
  </section>
  
@stop

@push('css')
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <link href="{{asset('frontend/single-post-1/css/styles.css')}}" rel="stylesheet">

  <link href="{{asset('frontend/single-post-1/css/responsive.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- For favorite Icon color chanding -->
  <style type="text/css">
    .header-bg{
      height: 400px;
      width: 100%;
      background-image: url({{ asset('/storage/post') }}/{{ $post->image }});
    }

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
