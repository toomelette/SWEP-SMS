@extends('layouts.modal-content')

@section('modal-header')
    {!! \Illuminate\Support\Str::limit(strip_tags($dv->explanation),50,'...') !!} - Print Preview
@endsection

@section('modal-body')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Preview (Front and back page)</a></li>
{{--            <li><a href="#tab_2" data-toggle="tab">Back Page</a></li>--}}
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                    <div class="col-md-6">
                        <b>Please print using LETTER paper size (8.5" x 11") </b>
                    </div>
                    <div class="col-md-6">
                        <button type="button" id="print_f_btn" class="btn btn-primary pull-right btn-sm"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
                <br>
                <div class="bs-example">
                    <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
                        <iframe id="print_f_frame" class="embed-responsive-item" src="{{route('dashboard.disbursement_voucher.print',[$dv->slug, "fb"])}}"></iframe>
                    </div>
                </div>



            </div>
            <!-- /.tab-pane -->
{{--            <div class="tab-pane" id="tab_2">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <b>Preview:</b>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <button type="button" id="print_b_btn" class="btn btn-primary pull-right btn-sm"><i class="fa fa-print"></i> Print</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <div class="bs-example">--}}
{{--                    <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">--}}
{{--                        <iframe id="print_b_frame" class="embed-responsive-item" src="{{route('dashboard.disbursement_voucher.print',[$dv->slug, "back"])}}"></iframe>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection

@section('modal-footer')
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
@endsection

@section('scripts')
<script type="text/javascript">
    $("#print_f_btn").click(function () {
        $("#print_f_frame").get(0).contentWindow.print();
    })

    $("#print_b_btn").click(function () {
        $("#print_b_frame").get(0).contentWindow.print();
    })
</script>
@endsection

