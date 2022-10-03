@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>
            CY: {{$cy->name}} | {{\Illuminate\Support\Facades\Auth::user()->mill_code}}
            <span class="pull-right"><small>Current week ending:</small> {{\Illuminate\Support\Carbon::parse($closestSundayAhead)->format('F d, Y')}}</span>
        </h1>
    </section>
@endsection
@section('content2')
    <section class="content">
        <div class="box box-sm box-default box-solid">
            <div class="box-header with-border">
                <p class="no-margin"> Current Week Data <small id="filter-notifier" class="label bg-blue blink"></small></p>
                <div class="box-tools pull-right">
                </div>

            </div>
            <div class="box-body" style="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-title" style="background-color: #4477a3;">
                            <h4> Wholesale (PESO/LKG) </h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-3">

                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>{{number_format($totalRawSugarIssuances,3)}}</h3>
                                        <p>Raw Sugar Issuances</p>
                                    </div>
                                    <div class="icon">
                                        {{--                                <i class="ion ion-bag"></i>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-3">

                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{number_format($totalRawSugarDeliveries,3)}}</h3>
                                        <p>Raw Sugar Deliveries</p>
                                    </div>
                                    <div class="icon">
                                        {{--                                <i class="ion ion-stats-bars"></i>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-title" style="background-color: #4477a3;">
                            <h4> Weekly Data </h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-3">

                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>{{number_format($totalRawSugarIssuances,3)}}</h3>
                                        <p>Producution</p>
                                    </div>
                                    <div class="icon">
                                        {{--                                <i class="ion ion-bag"></i>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-3">

                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3>{{number_format($totalRawSugarDeliveries,3)}}</h3>
                                        <p>Withdrawals</p>
                                    </div>
                                    <div class="icon">
                                        {{--                                <i class="ion ion-stats-bars"></i>--}}
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-sm box-default box-solid">
            <div class="box-header with-border">
                <p class="no-margin"> Current Week Data <small id="filter-notifier" class="label bg-blue blink"></small></p>
                <div class="box-tools pull-right">
                </div>

            </div>
            <div class="box-body" style="">
                <form id="filterFrom">
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('crop_year',[
                            'label' => 'Crop Year:',
                            'cols' => 2,
                            'options' => \App\Swep\Helpers\Arrays::cropYears(),
                            'class' => 'formFilter',
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('mill_code',[
                            'label' => 'Mill:',
                            'cols' => 2,
                            'options' => \App\Swep\Helpers\Arrays::millCodes(),
                            'class' => 'formFilter',
                        ]) !!}
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <canvas id="productionVsConsumptionChart" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-sm box-default box-solid">
            <div class="box-header with-border">
                <p class="no-margin"> PRODUCTION BY LOCATION <small id="filter-notifier" class="label bg-blue blink"></small></p>
                <div class="box-tools pull-right">
                </div>

            </div>
            <div class="box-body" style="">
                <div class="row">
                    <div class="col-md-2">
                        <p class="text-center"><b>RAW Production LM vs VIS</b></p>
                        <div>
                            <canvas id="productionPieChart" height="10" width="25"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-sm box-default box-solid">
            <div class="box-header with-border">
                <p class="no-margin"> PRICE MONITORING (DUMMY DATA) <small id="filter-notifier" class="label bg-blue blink"></small></p>
                <div class="box-tools pull-right">
                </div>

            </div>
            <div class="box-body" style="">
                <canvas id="myChart" width="400" height="80"></canvas>
            </div>
        </div>
    </section>


@endsection


@section('modals')

@endsection

@php
    $productionPieArr = [];
    $productionPieLabelArr = [];
    $production = \App\Models\SMS\WeeklyReportDetails::query()
        ->select('input_field','week_ending','current_value','form_type','geog_location','crop_year',DB::raw('sum(current_value) as sumCurrent'))
        ->leftJoin('weekly_reports' ,'weekly_reports.slug','=','weekly_report_slug')
        ->leftJoin('sugar_mills','weekly_reports.mill_code','=','sugar_mills.slug')
        ->where('input_field','=','manufactured')
        ->where('form_type','=','form1')
        ->groupBy('geog_location')
        ->orderBy('geog_location','asc')
        ->get();
    if(!empty($production)){
        foreach ($production as $p){
            array_push($productionPieArr,$p->sumCurrent);
            array_push($productionPieLabelArr,$p->geog_location);
        }
    }

    $latestWholesaleRawData = \App\Models\SMS\WeeklyReportDetails::query()
            ->leftJoin('weekly_reports','weekly_reports.slug','=','weekly_report_slug')
            ->where('input_field','wholesale_raw')
            ->where('form_type','form1')
            ->orderBy('week_ending','desc')
            ->first();

@endphp

@section('scripts')
    <script type="text/javascript">
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB'],
                datasets: [{
                    label: 'RAW SUGAR',
                    data: [2500, 2580, 3012, 3056, 2795, 3010],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                },
                    {
                        label: 'REFINED SUGAR',
                        data: [3011, 3095, 3150, 3200, 3000, 3010],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });

        //PRODUCTION VS WITHDRAWALS
        var data = {
            labels: [],
            datasets: [
                {
                    label: 'Production',
                    backgroundColor: 'rgb(255, 128, 0)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [],
                },
                {
                    label: 'Consumption',
                    backgroundColor: 'rgb(204, 0, 0)',
                    borderColor: 'rgb(255, 99, 132)',
                    data:[],
                },
            ]
        };
        var config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };
        var productionVsConsumptionChart = new Chart(
            document.getElementById('productionVsConsumptionChart'),
            config
        );


        //PRODUCTIONS PIE GRAPH
        var productionPieChartData = {
            labels: {!! json_encode($productionPieLabelArr) !!},
            datasets: [{
                label: 'My First Dataset',
                data: {!! json_encode($productionPieArr) !!},
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
                hoverOffset: 20
            }]
        };
        var productionPieChartConfig = {
            type: 'pie',
            data: productionPieChartData,
        };

        var productionPieChart = new Chart(
            document.getElementById('productionPieChart'),
            productionPieChartConfig
        );

        ajax_chart(productionVsConsumptionChart, '{{route("dashboard.ajax.get","chartAdmin")}}');

        // function to update our chart
        function ajax_chart(chart, url, data) {
            var data = data || {};
            $.getJSON(url, data).done(function(response) {

                chart.data.labels = response.labels;
                chart.data.datasets[0].data = response.data.productions; // or you can iterate for multiple datasets
                chart.data.datasets[1].data = response.data.withdrawals;
                chart.update(); // finally update our chart
            });
        }

        $(".formFilter").change(function () {
            let data = $("#filterFrom").serialize();
            ajax_chart(productionVsConsumptionChart, '{{route("dashboard.ajax.get","chartAdmin")}}?'+data);
        })
    </script>

@endsection