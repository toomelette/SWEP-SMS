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
                    <div class="col-lg-3 col-xs-6">

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
                    <div class="col-lg-3 col-xs-6">

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

                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>XX</h3>
                                <p>Other Data</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">

                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>XX</h3>
                                <p>Other Data</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
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
    </script>

@endsection