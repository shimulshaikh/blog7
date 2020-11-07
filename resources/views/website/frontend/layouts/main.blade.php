
<!DOCTYPE html>
<html lang="en">

  <head>
      @include('website.frontend.layouts.head')
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('website.frontend.layouts.header')

        @yield('content')

    
    <footer>
      @include('website.frontend.layouts.footer')
    </footer>

    @include('website.frontend.layouts.foot')

  </body>
</html>