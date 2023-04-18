@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>
            CY: {{$cy->name}}
            <span class="pull-right"><small>Current week ending:</small> {{\Illuminate\Support\Carbon::parse($closestSundayAhead)->format('F d, Y')}}</span>
        </h1>
    </section>
@endsection
@section('content2')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="form-title" style="background-color: #4477a3;">
                    <h4> Wholesale (PESO/LKG) </h4>
                </div>
                <div class="row">

                    <div class="col-lg-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-teal"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-boxs">RAW SUGAR </span><small>as of {{$prevSunday->format('M. d, Y')}}</small>
                                <span class="info-box-number">
                                    {{number_format($currentWeek['wholesaleRaw'],2)}}
                                </span>
                                <span class="description-percentage {{$currentWeek['wholesaleRaw'] - $previousWeek['wholesaleRaw'] > 0 ?'text-red' :'text-green'}}">
                                    <i class="fa fa-caret-up"></i>
                                    {{number_format(abs($currentWeek['wholesaleRaw'] - $previousWeek['wholesaleRaw']),2)}} <small> Php from previous week </small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-teal"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">REFINED SUGAR</span>
                                <span class="info-box-number">
                                    {{number_format($currentWeek['wholesaleRefined'],2)}}
                                </span>
                                <span class="description-percentage {{$currentWeek['wholesaleRefined'] - $previousWeek['wholesaleRefined'] > 0 ?'text-red' :'text-green'}}">
                                    <i class="fa fa-caret-up"></i>
                                    {{number_format(abs($currentWeek['wholesaleRefined'] - $previousWeek['wholesaleRefined']) ,2)}} <small>Php from previous week</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-title" style="background-color: #4477a3">
                    <h4 style="text-align: left"> Weekly Data <span class="pull-right"><small ><a href="{{route("dashboard.home.weekly_data")}}"  style="color: whitesmoke">See more</a></small></span> </h4>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-12">

                        <div class="info-box">
                            <span class="info-box-icon bg-production"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">RAW PRODUCTION</span>
                                <span class="info-box-number">{{number_format($currentWeek['rawProduction'],3)}} LKG</span>
                                <span class="description-percentage {{$currentWeek['rawProduction'] - $previousWeek['rawProduction'] > 0 ? 'text-green':'text-red'}}">
                                    <i class="fa fa-caret-{{$currentWeek['rawProduction'] - $previousWeek['rawProduction'] > 0 ? 'up': 'down'}}"></i>
                                    {{number_format(abs($currentWeek['rawProduction'] - $previousWeek['rawProduction']),2)}} LKG <small>from previous week</small>
                                </span>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-withdrawals"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">RAW WITHDRAWALS</span>
                                <span class="info-box-number">{{number_format($currentWeek['rawWithdrawals'],3)}} LKG</span>
                                <span class="description-percentage {{$currentWeek['rawWithdrawals']-$previousWeek['rawWithdrawals'] > 0 ? 'text-green':'text-red'}}">
                                    <i class="fa fa-caret-{{$currentWeek['rawWithdrawals']-$previousWeek['rawWithdrawals'] > 0 ? 'up': 'down'}}"></i>
                                    {{number_format(abs($currentWeek['rawWithdrawals']-$previousWeek['rawWithdrawals']),2)}} LKG <small>from previous week</small>
                                </span>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="box box-sm box-default box-solid">
            <div class="box-header with-border">
                <p class="no-margin"> Weekly Data <small id="filter-notifier" class="label bg-blue blink"></small></p>
                <div class="box-tools pull-right">
                </div>

            </div>
            <div class="box-body" style="">
                @if(Auth::user()->access == 'ADMIN')
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
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <canvas id="productionVsConsumptionChart" height="75"></canvas>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-title" style="background-color: #6aa8b1;">
                            <p> Wholesale (PESO/LKG) </p>
                        </div>
                        <canvas id="priceFluctuationChartW" width="400" height="55"></canvas>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" hidden>
                        <div class="form-title" style="background-color: #6a75b1;">
                            <p> Retail (PESO/KILO) </p>
                        </div>
                        <canvas id="priceFluctuationChartR" width="400" height="55"></canvas>
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
                            <canvas id="rawProductionLmVis" height="10" width="25"></canvas>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <p class="text-center"><b>Refined Production LM vs VIS</b></p>
                        <div>
                            <canvas id="refinedProductionLmVis" height="10" width="25"></canvas>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <p class="text-center"><b>Molasses Production LM vs VIS</b></p>
                        <div>
                            <canvas id="molProductionLmVis" height="10" width="25"></canvas>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <p class="text-center"><b>RAW Withdrawals LM vs VIS</b></p>
                        <div>
                            <canvas id="rawWithdrawalsLmVis" height="10" width="25"></canvas>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <p class="text-center"><b>Refined Withdrawals LM vs VIS</b></p>
                        <div>
                            <canvas id="refinedWithdrawalsLmVis" height="10" width="25"></canvas>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <p class="text-center"><b>Molasses Withdrawals LM vs VIS</b></p>
                        <div>
                            <canvas id="molWithdrawalsLmVis" height="10" width="25"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection


@section('modals')
    {!! \App\Swep\ViewHelpers\__html::blank_modal('weekly_data_modal','lg') !!}
@endsection


@section('scripts')
    <script type="text/javascript">
        //wholesale price
        const ctx = document.getElementById('priceFluctuationChartW').getContext('2d');
        const priceFluctuationChartW = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'RAW SUGAR',
                    data: [],
                    backgroundColor: [
                        'rgb(172, 132, 103)',
                    ],
                    borderColor: [
                        'rgb(172, 132, 103)',
                    ],
                    borderWidth: 3
                },
                    {
                        label: 'REFINED SUGAR',
                        data: [],
                        backgroundColor: [
                            'rgb(106, 177, 128)',
                        ],
                        borderColor: [
                            'rgb(106, 177, 128)',
                        ],
                        borderWidth:3
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

        //retail price
        const ctxR = document.getElementById('priceFluctuationChartR').getContext('2d');
        const priceFluctuationChartR = new Chart(ctxR, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'RAW SUGAR',
                    data: [],
                    backgroundColor: [
                        'rgb(172, 132, 103)',
                    ],
                    borderColor: [
                        'rgb(172, 132, 103)',
                    ],
                    borderWidth: 3
                },
                    {
                        label: 'REFINED SUGAR',
                        data: [],
                        backgroundColor: [
                            'rgb(106, 177, 128)',
                        ],
                        borderColor: [
                            'rgb(106, 177, 128)',
                        ],
                        borderWidth:3
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
                    backgroundColor: 'rgb(106, 177, 135)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [],
                },
                {
                    label: 'Consumption',
                    backgroundColor: 'rgb(206, 210, 204)',
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
        var rawProductionLmVis = new Chart(document.getElementById('rawProductionLmVis'),{
                type: 'doughnut',
                data: {
                    labels: ['LM','VIS'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [],
                        backgroundColor: [
                            'rgb(106, 124, 177)',
                            'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 20,
                        cutout: 75
                    }]
                },
            }
        );

        var refinedProductionLmVis = new Chart(document.getElementById('refinedProductionLmVis'),{
                type: 'doughnut',
                data: {
                    labels: ['LM','VIS'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [],
                        backgroundColor: [
                            'rgb(106, 124, 177)',
                            'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 20,
                        cutout: 75
                    }]
                },
            }
        );

        var molProductionLmVis = new Chart(document.getElementById('molProductionLmVis'),{
                type: 'doughnut',
                data: {
                    labels: ['LM','VIS'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [],
                        backgroundColor: [
                            'rgb(106, 124, 177)',
                            'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 20,
                        cutout: 75
                    }]
                }
            }
        );

        var rawWithdrawalsLmVis = new Chart(document.getElementById('rawWithdrawalsLmVis'),{
                type: 'doughnut',
                data: {
                    labels: ['LM','VIS'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [],
                        backgroundColor: [
                            'rgb(106, 124, 177)',
                            'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 20,
                        cutout: 75
                    }]
                }
            }
        );


        var refinedWithdrawalsLmVis = new Chart(document.getElementById('refinedWithdrawalsLmVis'),{
                type: 'doughnut',
                data: {
                    labels: ['LM','VIS'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [],
                        backgroundColor: [
                            'rgb(106, 124, 177)',
                            'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 20,
                        cutout: 75
                    }]
                }
            }
        );

        var molWithdrawalsLmVis = new Chart(document.getElementById('molWithdrawalsLmVis'),{
                type: 'doughnut',
                data: {
                    labels: ['LM','VIS'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [],
                        backgroundColor: [
                            'rgb(106, 124, 177)',
                            'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 20,
                        cutout: 75
                    }]
                }
            }
        );



        weeklyChart('{{route("dashboard.ajax.get","chartAdmin")}}');

        // function to update our chart
        function weeklyChart( url, data) {
            var data = data || {};
            $.getJSON(url, data).done(function(response) {
                productionVsConsumptionChart.data.labels = response.pVsC.labels;
                productionVsConsumptionChart.data.datasets[0].data = response.pVsC.data.productions; // or you can iterate for multiple datasets
                productionVsConsumptionChart.data.datasets[1].data = response.pVsC.data.withdrawals;
                productionVsConsumptionChart.update(); // finally update our chart

                priceFluctuationChartW.data.labels = response.prices.labels;
                priceFluctuationChartW.data.datasets[0].data = response.prices.data.wholesale_raw;
                priceFluctuationChartW.data.datasets[1].data = response.prices.data.wholesale_refined;
                priceFluctuationChartW.update();

                priceFluctuationChartR.data.labels = response.prices.labels;
                priceFluctuationChartR.data.datasets[0].data = response.prices.data.retail_raw;
                priceFluctuationChartR.data.datasets[1].data = response.prices.data.retail_refined;
                priceFluctuationChartR.update();


            });
        }
        productionByLocation('{{route("dashboard.ajax.get","productionByGeogLoc")}}');
        function productionByLocation(url, data){
            let d = data || {};
            $.getJSON(url,d).done(function (response) {
                rawProductionLmVis.data.datasets[0].data = response.RAW;
                refinedProductionLmVis.data.datasets[0].data = response.REFINED;
                molProductionLmVis.data.datasets[0].data = response.MOLASSES;
                rawProductionLmVis.update();
                refinedProductionLmVis.update();
                molProductionLmVis.update();
            })
        }

        $(".formFilter").change(function () {
            let data = $("#filterFrom").serialize();
            weeklyChart('{{route("dashboard.ajax.get","chartAdmin")}}?'+data);
        })
    </script>

@endsection