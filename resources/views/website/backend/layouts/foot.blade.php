<!-- JAVASCRIPT LIBRARIES -->
        <!-- JQUERY 2.2.3 FILE -->
        <script src="{{asset('backend/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>

        <!-- JQUERY UI 1.11.4 FILE -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

        <!-- RESOLVE CONFLICT IN JQUERY UI TOOLTIP WITH BOOTSTRAP TOOLTIP -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>

        <!-- BOOTSTRAP 3.3.6 FILE -->
        <script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- MORRIS.JS CHARTS FILE -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="{{asset('backend/plugins/morris/morris.min.js')}}"></script>

        <!-- SPARKLINE FILE -->
        <script src="{{asset('backend/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- JVECTORMAP FILE -->
        <script src="{{asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

        <!-- JQUERY KNOB CHART FILE -->
        <script src="{{asset('backend/plugins/knob/jquery.knob.js')}}"></script>

        <!-- DATERANGEPICKER FILE -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="{{asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>

        <!-- DATEPICKER FILE -->
        <script src="{{asset('backend/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

        <!-- BOOTSTRAP WYSIHTML5 FILE -->
        <script src="{{asset('backend/')}}{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

        <!-- SLIMSCROLL FILE -->
        <script src="{{asset('backend/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>

        <!-- FASTCLICK FILE -->
        <script src="{{asset('backend/plugins/fastclick/fastclick.js')}}"></script>

        <!-- App file -->
        <script src="{{asset('backend/dist/js/app.min.js')}}"></script>

        <!-- DASHBOARD FILE -->
        <script src="{{asset('backend/dist/js/pages/dashboard.js')}}"></script>

        <!-- MAIN JS FILE -->
        <script src="{{asset('backend/dist/js/demo.js')}}"></script>