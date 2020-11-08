
<!DOCTYPE html>
<html>
    <head>
        @include('website.backend.layouts.head')
        @stack('css')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <!-- START WRAPPER SECTION -->
        <div class="wrapper">

            <!-- START MAIN-HEADER SECTION -->
            
            @include('website.backend.layouts.header')

            @include('website.backend.layouts.sidebar')

            <!-- START CONTENT WRAPPER SECTION -->
            <div class="content-wrapper">
                <!-- START MAIN CONTENT SECTION -->
                <section class="content wrapper-main-content">
                    <div class="row">
                        <div class="col-sm-12">
                            @yield('content')
                        </div>
                    </div>
                </section><!-- MAIN CONTENT SECTION END -->
            </div><!-- CONTENT WRAPPER SECTION END -->

            @include('website.backend.layouts.footbar')

        </div><!-- WRAPPER SECTION END -->

        @include('website.backend.layouts.foot')

        <!-- Start Image upload -->
        <script>
        function previewFile(input){
            var file=$("input[type=file]").get(0).files[0];
            if (file)
            {
                var reader = new FileReader();
                reader.onload = function()
                {
                    $('#previewImg').attr("src",reader.result);
                }                
                reader.readAsDataURL(file);
            }
        }
        </script>
     <!-- End Image upload -->
        
        @stack('js')

    </body>
</html>