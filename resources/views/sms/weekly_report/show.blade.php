@php
    $rand = Str::random();
@endphp
@extends('layouts.modal-content')

@section('modal-header')
    Report No. {{$wr->report_no}} : {{Carbon::parse($wr->week_ending)->format('F d, Y')}} | <small>CY:</small> {{$wr->crop_year}}
@endsection

@section('modal-body')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1_{{$rand}}" data-toggle="tab">Report Preview</a></li>
            <li><a href="#tab_2_{{$rand}}" data-toggle="tab">Cancellation History</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_{{$rand}}">
                <button class="btn btn-default btn-sm pull-right" id="print_btn_{{$rand}}" style="display: none" data-toggle="modal"><i class="fa fa-print"></i> Print</button>
                <div class="row">
                    <div class="col-md-12">
                        <div id="loaderContainer_{{$rand}}">
                            <h1 class="text-center" style="font-size: 72px; padding: 150px">
                                <i class="fa fa-spin fa-spinner"></i>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="bs-example" id="printFrameContainer_{{$rand}}" hidden>
                            <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
                                <iframe id="printFrame_{{$rand}}" class="embed-responsive-item" src="{{route("dashboard.weekly_report.print",$wr->slug)}}">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab_2_{{$rand}}">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>Requester</th>
                        <th>Date and Time of request</th>
                        <th>Reason for cancellation</th>
                        <th>Report Snapshot</th>
                        <th>Action taken</th>
                    </tr>
                    </thead>

                <tbody>
                @if(count($wr->requestsForCancellation) > 0)
                    @foreach($wr->requestsForCancellation as $request)
                        <tr>
                            <td>{{$request->user->lastname ?? ''}}, {{$request->user->firstname ?? ''}}</td>
                            <td>{{\Illuminate\Support\Carbon::parse($request->cancelled_at)->format('M. d, Y | h:i A')}}</td>
                            <td>{{$request->reason}}</td>
                            <td><a href="{{route('dashboard.cancellation.preview',$request->slug)}}" target="_blank"> {{$request->filename}} </a></td>
                            <td>{{$request->action}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No data found.</td>
                    </tr>
                @endif
                </tbody>
                </table>
            </div>


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
            $("#print_btn_{{$rand}}").fadeIn();
        })
    })
    $("#print_btn_{{$rand}}").click(function () {
        $("#printFrame_{{$rand}}").get(0).contentWindow.print();
    })
</script>
@endsection

