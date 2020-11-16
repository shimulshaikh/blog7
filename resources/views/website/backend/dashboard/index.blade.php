@extends('website.backend.layouts.main')

@section('title','Home')

@section('content')
                            <div class="main-content-part">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#home">Home
                                            <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- For Highchart -->
                                    <div id="chartContainer"></div>
                                </div>
                            </div>
@stop


@push('js')
<script src="https://code.highcharts.com/highcharts.js"></script>


<!-- Start HighChart -->
<script type="text/javascript">
     var post =  <?php echo json_encode($postData) ?>;
   
    Highcharts.chart('chartContainer', {
        title: {
            text: 'New Post Growth, {{ now()->year }}'
        },
        // subtitle: {
        //     text: 'Source: codechief.org'
        // },
         xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },
        yAxis: {
            title: {
                text: 'Number of New Post'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New Post',
            data: post
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
});
</script>
<!-- End HighChart -->

@endpush                           