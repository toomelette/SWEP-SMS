@php
    $rand = \Illuminate\Support\Str::random();
@endphp
@extends('layouts.modal-content')

@section('modal-header')
    {{$wr->mill_code}} | WE: {{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('M. d, Y')}} | Report No. {{$wr->report_no}}
@endsection

@section('modal-body')
    <div class="row">
        <div class="col-md-12">
            Submitted at: {{Carbon::parse($wr->submitted_at)->format('F d, Y | h:i A')}}
            <button class="btn btn-default pull-right btn-sm" id="print_btn_{{$rand}}" style="margin-bottom: 10px"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
    <div id="loaderContainer_{{$rand}}">
        <h1 class="text-center" style="font-size: 72px; padding: 150px">
            <i class="fa fa-spin fa-spinner"></i>
        </h1>
    </div>

    <div class="bs-example" id="printFrameContainer_{{$rand}}" hidden>
        <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
            <iframe id="printFrame_{{$rand}}" class="embed-responsive-item" src="{{route("dashboard.weekly_report.print",$wr->slug)}}">
            </iframe>
        </div>
    </div>
@endsection

@section('modal-footer')

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#printFrame_{{$rand}}").on('load',function () {
            $("#loaderContainer_{{$rand}}").fadeOut(function () {
                $("#printFrameContainer_{{$rand}}").show();
            })
        })

        $("#print_btn_{{$rand}}").click(function () {
            $("#printFrame_{{$rand}}").get(0).contentWindow.print();
        })
    </script>
@endsection

