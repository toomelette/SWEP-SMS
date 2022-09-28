@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Weekly Report Submission</h1>
    </section>
@endsection
@section('content2')
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Report:</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <dl>
                            <dt>Mill Code:</dt>
                            <dd><span style="font-size: 18px">{{$wr->mill_code}}</span></dd>
                            <hr>

                            <dt>Crop Year:</dt>
                            <dd><span style="font-size: 18px">{{$wr->cropYear->name}}</span></dd>
                            <hr>

                            <dt>Week Ending:</dt>
                            <dd><span style="font-size: 18px">{{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('F d, Y')}}</span></dd>
                            <hr>

                            <dt>Report No.:</dt>
                            <dd><span style="font-size: 18px">{{$wr->report_no}}</span></dd>
                            <hr>

                            <dt>Distribution No.:</dt>
                            <dd><span style="font-size: 18px">{{$wr->dist_no}}</span></dd>
                        </dl>
                    </div>
                    <div class="col-md-9">
                        <form id="form1">@csrf
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">SMS Form 1</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">SMS Form 2</a></li>
                                    <li><a href="#tab_5" data-toggle="tab">SMS Form 5</a></li>
                                    <li><a href="#tab_5a" data-toggle="tab">SMS Form 5A</a></li>
                                    <li><a href="#tab_6a" data-toggle="tab">SMS Form 6A</a></li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            Dropdown <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                                        </ul>
                                    </li>
                                    <li class="pull-right">
                                        <button class="btn btn-primary btn-sm pull-right" type="submit"><i class=" fa fa-check"></i> Save as Draft</button>
                                    </li>
                                </ul>

                                    <input name="weekly_report_slug" value="{{$wr->slug}}" hidden>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            @include('sms.weekly_report.sms_forms.form1_new')
                                        </div>

                                        <div class="tab-pane " id="tab_2">
                                            @include('sms.weekly_report.sms_forms.form_2')
                                        </div>

                                        <div class="tab-pane " id="tab_5">
                                            <h3 class="no-margin">Sugar Release Order and Delivery Report - RAW</h3>
                                            @include('sms.weekly_report.sms_forms.form_5')
                                        </div>

                                        <div class="tab-pane " id="tab_5a">
                                            <h3 class="no-margin">Sugar Release Order and Delivery Report - REFINED</h3>
                                            @include('sms.weekly_report.sms_forms.form_5a')
                                        </div>

                                        <div class="tab-pane " id="tab_6a">
                                            <h3 class="no-margin">Quedan Registry <button type="button" id="printForm6A" data="{{$wr->slug}}" class="pull-right btn btn-success btn-sm pull-right print_form6a_btn"><i class=" fa fa-print"></i> Print</button> </h3>
                                            @include('sms.weekly_report.sms_forms.form_6a')
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary pull-right" type="submit"><i class=" fa fa-check"></i> Save as Draft</button>
                                        </div>
                                    </div>
                                    <br>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>

        <iframe src="" id="print_frame" style="display: none"></iframe>

    </section>


@endsection


@section('modals')
<div class="modal fade" id="add_issuances_modal" tabindex="-1" role="dialog" aria-labelledby="add_issuances_modal_label">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form5_add_issuance_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Issuances of SRO</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form5.issuance_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
  </div>
</div>

<div class="modal fade" id="add_delivery_modal" tabindex="-1" role="dialog" aria-labelledby="add_delivery_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form5_add_delivery_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Deliveries</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form5.delivery_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_servedSro_modal" tabindex="-1" role="dialog" aria-labelledby="add_servedSro_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form5_add_servedSro_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Deliveries</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form5.servedSro_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="add_form5a_issuances_modal" tabindex="-1" role="dialog" aria-labelledby="add_form5a_issuances_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form5a_add_issuance_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Issuances of SRO</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form5a.issuance_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_form5a_deliveries_modal" tabindex="-1" role="dialog" aria-labelledby="add_form5a_issuances_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form5a_add_delivery_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Delivery</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form5a.delivery_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_form5a_servedSros_modal" tabindex="-1" role="dialog" aria-labelledby="add_form5a_servedSros_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form5a_add_servedSro_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Delivery</h4>
                </div>
                <div class="modal-body">
                @include('sms.weekly_report.sms_forms.form5a.servedSro_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--FORM 6A-->
<div class="modal fade" id="add_rawSugarReceipts_modal" tabindex="-1" role="dialog" aria-labelledby="add_rawSugarReceipts_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form6a_add_rawSugarReceipts_form">
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Raw Sugar Receipts</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form6a.raw_sugar_receipts_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="add_quedanRegistry_modal" tabindex="-1" role="dialog" aria-labelledby="add_quedanRegistry_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form6a_add_quedanRegistry_form">
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Quedan Registry</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form6a.quedan_registry_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END OF FORM 6A-->


    {!! \App\Swep\ViewHelpers\__html::blank_modal('form5_editModal','') !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        modal_loader = $("#modal_loader").parent('div').html();
    </script>

    @include('sms.weekly_report.scripts.form5_issuance_script')
    @include('sms.weekly_report.scripts.form5_delivery_script')
    @include('sms.weekly_report.scripts.form5_servedSro_script')

    @include('sms.weekly_report.scripts.form5a_issuance_script')
    @include('sms.weekly_report.scripts.form5a_delivery_script')
    @include('sms.weekly_report.scripts.form5a_servedSro_script')


    @include('sms.weekly_report.scripts.form6a.raw_sugar_receipts_script')
    @include('sms.weekly_report.scripts.form6a.quedan_registry_script')


    <script type="text/javascript">

        $(".add_btn").click(function () {
            let btn = $(this);
            let data = btn.attr('data');
            let uri = '{{route("dashboard.ajax.get","for")}}';
            uri = uri.replace('for',data);
            $.ajax({
                url : uri,
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    console.log(res);
                    $("#"+data+" tbody").append(res);
                },
                error: function (res) {
                    notify(res.responseJSON.message,'danger');
                }
            });
        })
        $("body").on("click",'.remove_row_btn',function () {
            let btn = $(this);
            let data = btn.attr('data');
            $("#tr_"+data).remove();
        })

        $("#form1").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let uri = '{{route("dashboard.sms_form1.store")}}';
            $.ajax({
                url : uri,
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    notify('Report was saved as draft successfully.','success');
                    // succeed(form,true,false);
                    // $(".table_dynamic").each(function () {
                    //     $(this).find('tbody').html('');
                    // })
                    // $("#form1 .add_btn").each(function () {
                    //     $(this).trigger('click');
                    // })
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })




        $("body").on('click','.form5_edit_btn',function () {
            let btn = $(this);
            let uri = btn.attr('uri');
            load_modal3(btn);
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

        $("#print_frame").on("load",function () {
            $(this).get(0).contentWindow.print();
            $(".print_form6a_btn").each(function () {
                btn = $(this);
                unwait_this_button(btn);
            })
        })

        $("body").on("click",".print_form6a_btn",function () {
            btn = $(this);
            wait_this_button(btn);
            let uri = '{{route("dashboard.form_6a.print_form6a_form","slug")}}';
            uri = uri.replace('slug',btn.attr('data'));
            $("#print_frame").attr('src',uri);
        })




    </script>

@endsection