
<!DOCTYPE HTML>
<html lang="en">
      @include('website.frontend.layouts.head')

  @stack('css')

  <body >

    @include('website.frontend.layouts.header')

      @yield('content')

    @include('website.frontend.layouts.footer')


    <!-- SCIPTS -->

    @include('website.frontend.layouts.foot') 

  @stack('js')

  </body>

</html>