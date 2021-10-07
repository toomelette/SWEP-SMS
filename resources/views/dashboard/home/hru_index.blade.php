@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Dashboard</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{number_format($all_employees)}}</h3>
                        <p>No. of Employees on record</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
{{--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{number_format($all_applicants)}}</h3>
                        <p>No. of Applicants on record</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text-o"></i>
                    </div>
{{--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{number_format($all_leave_applications)}}</h3>

                        <p>Leave Applications</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-ioxhost"></i>
                    </div>
{{--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{number_format($all_ps)}}</h3>

                        <p>Permission Slips</p>
                    </div>
                    <div class="icon">
                        <i class="fa  fa-hand-o-right"></i>
                    </div>
{{--                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="panel">
                    <div class="panel-body">
                        <center><label>Employees by Sex</label></center>
                        <hr class="no-margin">
                        <canvas id="employee_by_gender" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel">
                    <div class="panel-body">
                        <center><label>Applicants by Course</label></center>
                        <hr class="no-margin">
                        <div class="col-md-4">

                            <canvas id="applicants_by_gender" width="400" height="390"></canvas>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered table-condensed" id="per_course_table">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Applicants</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($per_course->count() > 0)
                                        @foreach($per_course as $key=>$data)
                                        <tr dataset-Index="{{$key}}" class="course_tr">
                                            <td>{{str_replace('BACHELOR OF SCIENCE IN','BS',$data->name)}}</td>
                                            <td class="text-center">{{$data->count}}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <center><label>Applicants by Date</label></center>
                        <hr class="no-margin">
                        <canvas id="applicants_by_date" width="400" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection





@section('scripts')
<script type="text/javascript">
    $("document").ready(function () {
        var ctx = $("#employee_by_gender");

        var employee_gender_chart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [
                    {
                        data: [{{$male_employees}},{{$female_employees}}],
                        backgroundColor:[
                            'rgb(18, 91, 176)',
                            'rgb(212, 83, 199)',
                        ],
                    }
                ],
                labels:[
                    'Male ('+{{$male_employees}}+')',
                    'Female ('+{{$female_employees}}+')',
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Employees: {{$all_employees}} ',
                    }
                }
            },
        });

        var applicant_by_course = new Chart($("#applicants_by_gender"), {
            type: 'pie',
            data: {
                datasets: [
                    {
                        data: [
                            @foreach($per_course as $count)
                            {{$count->count}},
                            @endforeach
                        ],
                        backgroundColor:[
                            @foreach($per_course as $count)
                                'rgb({{mt_rand(1,255)}},{{mt_rand(1,255)}},{{mt_rand(1,255)}})',
                            @endforeach
                        ],
                    }
                ],
                labels:[
                    @foreach($per_course as $count)
                        '{{$count->name}}',
                    @endforeach

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Pie Chart'
                    }
                }
            },
        });

        per_course_table = $("#per_course_table").DataTable({
            "bLengthChange": false,
        });
        var applicant_by_date = new Chart($("#applicants_by_date"), {
            type: 'line',
            data: {
                datasets: [
                    {
                        data: [
                            @foreach($per_date_received as $data)
                                {{$data->count}},
                            @endforeach
                        ],
                        borderColor : 'rgb(75, 192, 192)',
                        fill: false,

                    }
                ],
                labels:[
                    @foreach($per_date_received as $data)
                        '{{date('M. d, Y',strtotime($data->received_at))}}',
                    @endforeach
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        type: 'logarithmic',
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 20
                        }
                    }]
                },
                responsive: true,
                plugins: {
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'xy',
                        }
                    },
                    legend: {
                        display: false,
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Pie Chart'
                    }
                }
            },
        });

    })


</script>

@endsection