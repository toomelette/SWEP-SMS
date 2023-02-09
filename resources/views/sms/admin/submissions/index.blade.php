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
                                        <div class="col-md-1" style="margin-bottom: 10px">
                                            <button data-toggle="modal" data-target="#show_report_modal" data="{{$weeklyReport['obj']->slug}}" class="btn-default btn col-md-12 show_report_btn">{{\Illuminate\Support\Carbon::parse($weeklyReport['obj']->week_ending)->format('M. d')}}</button>
                                        </div>
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