@extends('website.frontend.layouts.main')

@section('title','Home')

@section('content')


  <div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
      data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
      data-swiper-breakpoints="true" data-swiper-loop="false" >
      <div class="swiper-wrapper">

        @foreach($categorys as $category)
          <div class="swiper-slide">
          <a class="slider-category" href="#">
            <div class="blog-image"><img src="{{ asset('/storage/category/slider') }}/{{ $category->image  }}" alt="Blog Image"></div>

            <div class="category">
              <div class="display-table center-text">
                <div class="display-table-cell">
                  <h3><b>{{ $category->name }}</b></h3>
                </div>
              </div>
            </div>

          </a>
        </div><!-- swiper-slide -->
        @endforeach



      </div><!-- swiper-wrapper -->

    </div><!-- swiper-container -->

  </div><!-- slider -->

  <section class="blog-area section">
    <div class="container">

      <div class="row">
        @foreach($posts as $post)
          <div class="col-lg-4 col-md-6">
            <div class="card h-100">
              <div class="single-post post-style-1">

                <div class="blog-image"><img src="{{ asset('/storage/post') }}/{{ $post->image  }}" alt="{{ $post->title  }}"></div>


                <a class="avatar" href="#"><img src="{{('frontend/images/icons8-team-355979.jpg')}}" alt="Profile Image"></a>

                <div class="blog-info">

                  <h4 class="title"><a href="#"><b>{{ $post->title  }}</b></a></h4>

                  <ul class="post-footer">
                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                  </ul>

                </div><!-- blog-info -->
              </div><!-- single-post -->
            </div><!-- card -->
          </div><!-- col-lg-4 col-md-6 -->
        @endforeach

      </div><!-- row -->

    </div><!-- container -->
  </section><!-- section -->

@stop

@push('css')
  <link href="{{asset('frontend/front-page-category/css/styles.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/front-page-category/css/responsive.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
