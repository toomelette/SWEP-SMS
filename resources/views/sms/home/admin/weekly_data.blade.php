@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Production & Withdrawals <span class="pull-right"><small>Report No.</small>: {{$request_week->report_no}} | <small>Week Ending:</small> {{\Illuminate\Support\Carbon::parse($request_week->week_ending)->format('M. d, Y')}}</span></h1>

</section>
@endsection
@section('content2')

<section class="content">
    <div class="box box-solid">
        <div class="box-header">
            <div class="btn-group pull-right">
                <a href="{{route('dashboard.home.weekly_data')}}?week_ending={{\Illuminate\Support\Carbon::parse($request_week->week_ending)->subDays(7)->format('Y-m-d')}}" class="navigate-btn btn btn-default"><i class="fa fa-arrow-left"></i></a>
                <a href="{{route('dashboard.home.weekly_data')}}?week_ending={{\App\Swep\Helpers\__calendar::currentWeek()->week_ending}}" class="navigate-btn btn btn-default">Current</a>
                <a href="{{route('dashboard.home.weekly_data')}}?week_ending={{\Illuminate\Support\Carbon::parse($request_week->week_ending)->addDays(7)->format('Y-m-d')}}" class="navigate-btn btn btn-default"><i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <p class="text-center"><b>RAW Production by Mill</b></p>
                    <div>
                        <canvas id="rawProductionByMill" height="10" width="25"></canvas>
                    </div>
                </div>
                <div class="col-md-3">
                    <p class="text-center"><b>RAW Withdrawals by Mill</b></p>
                    <div>
                        <canvas id="rawWithdrawalsByMill" height="10" width="25"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Mill Code</th>
                            <th class="text-center">Production (LKG)</th>
                            <th class="text-center">Withdrawals (LKG)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($mills))
                            @foreach($mills as $mill_code => $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$mill_code}}</td>
                                    <td class="text-right">{{number_format($data['production'] ?? 0,3)}}</td>
                                    <td class="text-right">{{number_format($data['withdrawals'] ?? 0 , 3)}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr class="success">
                            <th></th>
                            <th>TOTAL</th>
                            <th class="text-right">{{number_format(array_sum(array_column($mills,'production')),3)}}</th>
                            <th class="text-right">{{number_format(array_sum(array_column($mills,'withdrawals')),3)}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection


@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
    var rawProductionByMill = new Chart(document.getElementById('rawProductionByMill'),{
            type: 'doughnut',
            data: {
                labels: [
                    @if(!empty($mills))
                        @foreach($mills as $mill_code => $data)
                            '{{$mill_code}}',
                        @endforeach
                    @endif
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [
                        @if(!empty($mills))
                            @foreach($mills as $mill_code => $data)
                                {{$data['production']}},
                            @endforeach
                        @endif
                    ],
                    backgroundColor: [
                        @if(!empty($mills))
                            @foreach($mills as $mill_code => $data)
                                '{{$data["color"]}}',
                            @endforeach
                        @endif
                    ],
                    hoverOffset: 20,
                    cutout: 75
                }]
            },
        }
    );

    var rawWithdrawalsByMill = new Chart(document.getElementById('rawWithdrawalsByMill'),{
            type: 'pie',
            data: {
                labels: [
                    @if(!empty($mills))
                            @foreach($mills as $mill_code => $data)
                        '{{$mill_code}}',
                    @endforeach
                    @endif
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [
                        @if(!empty($mills))
                        @foreach($mills as $mill_code => $data)
                        {{$data['withdrawals']}},
                        @endforeach
                        @endif
                    ],
                    backgroundColor: [
                        @if(!empty($mills))
                                @foreach($mills as $mill_code => $data)
                            '{{$data["color"]}}',
                        @endforeach
                        @endif
                    ],
                    hoverOffset: 20,
                    cutout: 75
                }]
            },
        }
    );
</script>
@endsection