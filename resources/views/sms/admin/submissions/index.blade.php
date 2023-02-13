@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Weekly Submitted SMS</h1>
</section>
@endsection
@section('content2')

<section class="content">
    <div class="box box-solid">
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 200px" class="text-center">Mill Code</th>
                    @if(!empty($weeksArray))
                        @foreach($weeksArray as $key => $week)
                            <th class="text-center">{{\Illuminate\Support\Carbon::parse($key)->format('M.')}}</th>
                        @endforeach
                    @endif
                </tr>
                </thead>
                <tbody>
                @if(!empty($mills))
                    @foreach($mills as $mill_code => $mill)

                        <tr>
                            <td>{{$mill_code}}</td>
                            @foreach($mill['weeklyReports'] as $month => $weeks)
                                <td>
                                   @foreach($weeks as $week_ending => $week)
                                       @if(isset($week['obj']))
                                            <button class="btn  btn-sm btn-success show_report_btn" style="width: 100%; margin-bottom: 10px" data-toggle="modal" data-target="#show_report_modal" data="{{$week['obj']->slug}}">
                                                {{Carbon::parse($week_ending)->format('M d')}}
                                            </button>
                                       @else
                                            <button disabled class="btn btn-default btn-sm" style="width: 100%; margin-bottom: 10px">{{Carbon::parse($week_ending)->format('M d')}}</button>
                                        @endif
                                   @endforeach

                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endif
                </tbody>

            </table>

           @if(1 == 2)
                @if(!empty($mills))
                    @foreach($mills as $mill_code => $mill)
                        <div class="panel">
                            <div class="box box-sm box-default box-solid">
                                <div class="box-header with-border">
                                    <p class="no-margin"><b>{{$mill_code}}</b> <small id="filter-notifier" class="label bg-blue blink"></small></p>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool advanced_filters_toggler" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="box-body" style="">



                                    @if(count($mill['weeklyReports']) > 0)
                                        <div class="row">
                                            @foreach($mill['weeklyReports'] as $weeklyReport)
                                                @if(isset($weeklyReport['obj']))
                                                    <div class="col-md-1" style="margin-bottom: 10px">
                                                        <button data-toggle="modal" data-target="#show_report_modal" data="{{$weeklyReport['obj']->slug}}" class="btn-default btn col-md-12 show_report_btn">{{\Illuminate\Support\Carbon::parse($weeklyReport['obj']->week_ending)->format('M. d')}}</button>
                                                    </div>
                                                @else
                                                    <div class="col-md-1" style="margin-bottom: 10px">
                                                        <button class="btn btn-default btn-sm">AA</button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No report found.</p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif
           @endif
        </div>
    </div>
</section>


@endsection


@section('modals')
    {!! \App\Swep\ViewHelpers\__html::blank_modal('show_report_modal','80') !!}
@endsection

@section('scripts')
<script type="text/javascript">
    $("body").on("click",".show_report_btn",function () {
        let btn = $(this);
        load_modal3(btn);
        let uri = '{{route("dashboard.submissions.show","slug")}}';
        uri = uri.replace('slug',btn.attr('data'));
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                populate_modal2(btn,res);
            },
            error: function (res) {
                populate_modal2_error(res);
            }
        })
    })
</script>
@endsection