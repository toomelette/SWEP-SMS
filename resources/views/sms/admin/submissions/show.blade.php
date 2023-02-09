@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content')

@section('modal-header')

@endsection

@section('modal-body')
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
    </script>
@endsection

