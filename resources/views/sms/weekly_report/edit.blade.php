@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Weekly Report Submission</h1>
    </section>
@endsection
@section('content2')
    <section class="content">
        <div class="box box-solid">
            <div class="box-header with-border" style="display: none !important;">
                <h3 class="box-title">Report:</h3>
                <button class="btn btn-success pull-right" data-target="#print_prev_modal" id="print_prev_btn" data-toggle="modal"><i class="fa fa-print"></i> Print</button>
            </div>
            <div class="box-body">

                <div id="waitBarContainer">
                    <div class="login-box" style="width: 40%;">
                        <div class="login-box-body">
                            <div  id="waitBar"  class="progress progress-sm active">
                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 3%">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                            <p id="waitText" class="text-center">
                                <i class="fa fa-circle-o-notch fa-spin"></i> <span> Performing calculations</span>
                            </p>
                        </div>

                    </div>


                </div>


                <div id="reportContainer" hidden>
                    <div class="row">
                        <div class="col-md-2">
                            <dl>
                                <dt>Mill Code:</dt>
                                <dd><span style="font-size: 18px">{{$wr->mill_code}}</span></dd>
                                <hr>

                                <dt>Crop Year:</dt>
                                <dd><span style="font-size: 18px">{{$wr->crop_year}}</span></dd>
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
                        <div class="col-md-10">

                            <fieldset {{$wr->status == 1 ? 'disabled' : null}}>
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab"> Form 1</a></li>
                                        <li><a href="#tab_2" data-toggle="tab"> Form 2</a></li>
                                        <li><a href="#tab_3" data-toggle="tab"> Form 3</a></li>
                                        <li><a href="#tab_3a" data-toggle="tab"> Form 3A</a></li>
                                        <li style="display: block"><a href="#tab_3b" data-toggle="tab" > Form 3B</a></li>
                                        <li><a href="#tab_4" data-toggle="tab"> Form 4</a></li>
                                        <li><a href="#tab_4a" data-toggle="tab"> Form 4A</a></li>
                                        <li><a href="#tab_5" data-toggle="tab"> Form 5</a></li>
                                        <li><a href="#tab_5a" data-toggle="tab"> Form 5A</a></li>
                                        <li><a href="#tab_6a" data-toggle="tab"> Form 6A</a></li>

                                        <li class="pull-right" style="padding-top: 15px">
                                            <small class="text-info">Changes are auto saved</small>
                                        </li>
                                    </ul>

                                    <input name="weekly_report_slug" value="{{$wr->slug}}" hidden>
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab_1">

                                            @include('sms.weekly_report.sms_forms.form_1')

                                        </div>

                                        <div class="tab-pane " id="tab_2">
                                            @include('sms.weekly_report.sms_forms.form_2')
                                        </div>

                                        <div class="tab-pane " id="tab_3">

                                            @include('sms.weekly_report.sms_forms.form_3')

                                        </div>

                                        <div class="tab-pane" id="tab_3a">
                                            @include('sms.weekly_report.sms_forms.form_3a')

                                        </div>

                                        <div class="tab-pane " id="tab_3b" >
                                            @include('sms.weekly_report.sms_forms.form_3b')

                                        </div>

                                        <div class="tab-pane " id="tab_4">
                                            @include('sms.weekly_report.sms_forms.form_4')
                                        </div>

                                        <div class="tab-pane " id="tab_4a">
                                            @include('sms.weekly_report.sms_forms.form_4a')
                                        </div>

                                        <div class="tab-pane " id="tab_5">
                                            @include('sms.weekly_report.sms_forms.form_5')
                                        </div>

                                        <div class="tab-pane " id="tab_5a">

                                            @include('sms.weekly_report.sms_forms.form_5a')
                                        </div>

                                        <div class="tab-pane " id="tab_6a">
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
                            </fieldset>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <iframe src="" id="print_frame" style="display: none"></iframe>

    </section>

    <datalist id="traders">

    </datalist>

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

<!--FORM 3B-->
<div class="modal fade" id="add_form3b_issuances_modal" tabindex="-1" role="dialog" aria-labelledby="add_form3b_issuances_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form3b_add_issuance_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Issuances of SRO</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form3b.issuance_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_form3b_deliveries_modal" tabindex="-1" role="dialog" aria-labelledby="add_form3b_issuances_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form3b_add_delivery_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Delivery</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form3b.delivery_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add_form3b_servedSros_modal" tabindex="-1" role="dialog" aria-labelledby="add_form3b_servedSros_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form3b_add_servedSro_form">
                @csrf
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Delivery</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form3b.servedSro_form')
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

<div class="modal fade" id="addMolassesWithdrawalModal" tabindex="-1" role="dialog" aria-labelledby="add_quedanRegistry_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form3_addMolassesWithdrawalForm">
                <input value="{{$wr->slug}}" name="weekly_report_slug" hidden>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Molasses Withdrawal</h4>
                </div>
                <div class="modal-body">
                    @include('sms.weekly_report.sms_forms.form3.withdrawals_form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="print_prev_modal" tabindex="-1" role="dialog" aria-labelledby="add_quedanRegistry_modal_label">
    <div class="modal-dialog" style="width: 75%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Print Preview</h4>
            </div>
            <div class="modal-body">
                <div class="loader-container" style="padding: 150px">
                    <p style="text-align: center; font-size: 72px"><i class="fa fa-spin fa-spinner"></i></p>
                </div>
                <div id="iframe-container" hidden>
                    <button class="btn btn-primary pull-right" id="print_btn"><i class="fa fa-print"></i> Print</button><br><br>
                    <iframe class="embed-responsive-item" style="width: 100%; height: 800px" id="allFormsFrame"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

    {!! \App\Swep\ViewHelpers\__html::blank_modal('form5_editModal','') !!}
    {!! \App\Swep\ViewHelpers\__html::blank_modal('form4_listOfWarehousesModal','') !!}
    {!! \App\Swep\ViewHelpers\__html::blank_modal('editWarehouseModal','sm') !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        modal_loader = $("#modal_loader").parent('div').html();
    </script>
    @include('sms.weekly_report.scripts.83form3b_servedSro_script')
    @include('sms.weekly_report.scripts.82form3b_delivery_script')
    @include('sms.weekly_report.scripts.8form3b_issuance_script')
    @include('sms.weekly_report.scripts.7form5a_servedSro_script')
    @include('sms.weekly_report.scripts.6form5a_issuance_script')
    @include('sms.weekly_report.scripts.5form5a_delivery_script')
    @include('sms.weekly_report.scripts.4form5_servedSro_script')
    @include('sms.weekly_report.scripts.3form5_issuance_script')
    @include('sms.weekly_report.scripts.2form5_delivery_script')
    @include('sms.weekly_report.scripts.1form3_withdrawals_script')

    @include('sms.weekly_report.scripts.form6a.raw_sugar_receipts_script')
    @include('sms.weekly_report.scripts.form6a.quedan_registry_script')


    <script type="text/javascript">
        $("#allFormsFrame").on("load",function () {
            $("#print_prev_modal .loader-container").fadeOut(function () {
                $("#print_prev_modal #iframe-container").show();
            })
        })
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
            let form = btn.parents('form');
            $("#tr_"+data).remove();
            form.submit();
        })

        $("#form11").submit(function (e) {
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

        $(".manufactured").change(function () {
            let val = $(this).val();
            $.ajax({
                url : '{{route("dashboard.ajax.get","issuances_by_sugar_order")}}',
                data : {
                    'weekly_report_slug' : '{{$wr->slug}}' ,
                    'manufactured_current' : $("#manufactured_current").val(),
                    'manufactured_prev' : $("#manufactured_prev").val(),
                },
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("#form1_issuances_table tbody").html('');
                    $("#form1_issuances_table tbody").append(res);
                },
                error: function (res) {
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

        $("#print_prev_btn").click(function () {
            $("#print_prev_modal #iframe-container").hide()
            $("#print_prev_modal .loader-container").show();
            ;
            $("#allFormsFrame").attr('src','');
            $("#allFormsFrame").attr('src','{{route("dashboard.weekly_report.print",$wr->slug)}}');
        })
        
        $("#print_btn").click(function () {
            $("#allFormsFrame").get(0).contentWindow.print();
        })

        function updateForm1(){
            alert();
            let dataArray = $("#form1").serializeArray();
            $("#form1PreviewTable").css('background-color','#f2fff2');
            $(dataArray).each(function (i,item) {
                console.log(item);
            })
            $.ajax({
                url : '{{route("dashboard.ajax.post","form1Preview")}}?weekly_report={{$wr->slug}}',
                data : $("#form1").serializeArray(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("#form1PreviewTable").html(res);
                    $("#form1PreviewTable").css('background-color','');
                },
                error: function (res) {
                    console.log(res);
                }
            })
        }
        
        $("body").on("change",".formChanger",function () {
            updateForm1();
        })

        $("body").on("click","#form1_raw_sugar_issuances .remove_row_btn",function () {
            updateForm1();
        })

        $("#landbankForm").submit(function (e) {
            e.preventDefault()
            $.ajax({
                url : '/landbank?',
                data : $(this).serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    console.log(res);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        });

        function updateForm2(form = null,type = 'updateOnly'){
            let uri = '{{route("dashboard.sms_form2.store")}}?wr={{$wr->slug}}';
            let formData = null;
            if(type === 'updateOnly'){
                uri = uri+'&type=updateOnly';
                formData = null;
            }else{
                formData = form.serialize();
            }

            $.ajax({
                url : uri,
                data : formData,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $.each(res,function (i,item) {
                        $("#form2PreviewTable tr[for='"+i+"']").children('td').eq(1).html($.number(item.current,2));
                        $("#form2PreviewTable tr[for='"+i+"']").children('td').eq(2).html($.number(item.prev,2));
                    })
                    $("#form2PreviewTable .fa").remove();
                    if(type !== 'updateOnly'){
                        toast('Changes were auto saved.');
                    }
                },
                error: function (res) {
                    $("tr.computation").each(function () {
                        $(this).children('td').eq(1).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                        $(this).children('td').eq(2).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                    })
                }
            })
        }

        updateForm2(null);
        updateForm1(null);
        updateForm3(null);
        updateForm3a(null);
        updateForm4(null);
        updateForm4a(null);

        $("#form2").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $("#form2PreviewTable tr.computation").each(function () {
                $(this).children('td').eq(1).html('<i class="fa fa-spin fa-refresh"></i>');
                $(this).children('td').eq(2).html('<i class="fa fa-spin fa-refresh"></i>');
            })
            updateForm2(form,'insert');
        })

        $("#form2 .form2-input").change(function () {
            $("#form2").submit();
        })

        $("#addIssuanceButton").click(function () {
            $.ajax({
                url : '{{route("dashboard.ajax.get","form1Issuance")}}',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $(".totalIssuanceTr").before(res);
                },
                error: function (res) {

                }
            })
        })


        function updateForm1(form = null,type = 'updateOnly'){
            let uri = '{{route("dashboard.sms_form1.store")}}?wr={{$wr->slug}}';
            let formData = null;
            if(type === 'updateOnly'){
                uri = uri+'&type=updateOnly';
                formData = null;
            }else{
                formData = form.serialize();
            }

            $.ajax({
                url : uri,
                data : formData,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $(".newAppend").each(function () {
                        $(this).remove();
                    })
                    $.each(res,function (i,item) {
                        $("#form1PreviewTable tr[for='"+i+"']").children('td').eq(1).html($.number(item.current,3));
                        $("#form1PreviewTable tr[for='"+i+"']").children('td').eq(2).html($.number(item.prev,3));
                    });
                    $.each(res.withdrawals, function (i,item) {
                        $("#form1PreviewTable tr[for='withdrawalsTotal']").before('' +
                            '<tr class="newAppend">' +
                            '<td><span class="indent"></span>' + i + '</td>'+
                            '<td class="text-right">' + $.number(item.current,3) + '</td>'+
                            '<td class="text-right">' + $.number(item.prev,3) + '</td>'+
                            '</tr>')
                    });
                    $.each(res.balances, function (i,item) {
                        $("#form1PreviewTable tr[for='balancesTotal']").before('' +
                            '<tr class="newAppend">' +
                            '<td><span class="indent"></span>' + i + '</td>'+
                            '<td class="text-right">' + $.number(item.current,3) + '</td>'+
                            '<td class="text-right">' + $.number(item.prev,3) + '</td>'+
                            '</tr>')
                    });
                    $.each(res.fieldsToFill, function (i,item) {
                        console.log(i);
                        $("#form1 input[name='"+i+"']").val(item);
                    });
                    if(type !== 'updateOnly'){
                        toast('Changes were auto saved.');
                    }
                },
                error: function (res) {
                    $("#form1PreviewTable tr.computation").each(function () {
                        $(this).children('td').eq(1).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                        $(this).children('td').eq(2).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                    })
                }
            })
        }



        $("#form1").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $("#form1PreviewTable tr.computation").each(function () {
                $(this).children('td').eq(1).html('<i class="fa fa-spin fa-refresh"></i>');
                $(this).children('td').eq(2).html('<i class="fa fa-spin fa-refresh"></i>');
            })

            updateForm1(form,'insert');
        })

        $("#form1").on('change','.form1-input',function () {
            $("#form1").submit();
        })

        $("body").on("click",".removeBtn",function () {
            $(this).parents('tr').remove();
            $(this).closest('form').submit();

        })


        function updateForm3(form = null,type = 'updateOnly'){
            let uri = '{{route("dashboard.sms_form3.store")}}?wr={{$wr->slug}}';
            let formData = null;
            if(type === 'updateOnly'){
                uri = uri+'&type=updateOnly';
                formData = null;
            }else{
                formData = form.serialize();
            }
            $.ajax({
                url : uri,
                data : formData,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("#form3PreviewTable .newAppend").each(function () {
                        $(this).remove();
                    });
                    $.each(res,function (i,item) {
                        $("#form3PreviewTable tr[for='"+i+"']").children('td').eq(1).html($.number(item.current,3));
                        $("#form3PreviewTable tr[for='"+i+"']").children('td').eq(2).html($.number(item.prev,3));
                    });

                    $.each(res.withdrawalsRaw, function (i,item) {
                        $("#form3PreviewTable tr[for='totalWithdrawalsRaw']").before('' +
                            '<tr class="newAppend">' +
                            '<td><span class="indent"></span>' + i + '</td>'+
                            '<td class="text-right">' + $.number(item.current,3) + '</td>'+
                            '<td class="text-right">' + $.number(item.prev,3) + '</td>'+
                            '</tr>')
                    });
                    $.each(res.withdrawalsRefined, function (i,item) {
                        $("#form3PreviewTable tr[for='totalWithdrawalsRefined']").before('' +
                            '<tr class="newAppend">' +
                            '<td><span class="indent"></span>' + i + '</td>'+
                            '<td class="text-right">' + $.number(item.current,3) + '</td>'+
                            '<td class="text-right">' + $.number(item.prev,3) + '</td>'+
                            '</tr>')
                    });
                    if(type !== 'updateOnly'){
                        toast('Changes were auto saved.');
                    }

                },
                error: function (res) {
                    $("#form3PreviewTable tr.computation").each(function () {
                        $(this).children('td').eq(1).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                        $(this).children('td').eq(2).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                    })
                }
            })
        }

        $("#form3 .form3-input").change(function () {
            $("#form3").submit();
        })

        $("#form3").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $("#form3PreviewTable tr.computation").each(function () {
                $(this).children('td').eq(1).html('<i class="fa fa-spin fa-refresh"></i>');
                $(this).children('td').eq(2).html('<i class="fa fa-spin fa-refresh"></i>');
            })
            updateForm3(form,'insert');
        })


        function lastInit() {
            setTimeout(function () {
                $("#waitBar .progress-bar").css('width','100%');
                $("#waitText span").html('Loading Forms');
                $("#waitBarContainer").fadeOut(function(){
                    $("#reportContainer").fadeIn();
                    $(".box-header").slideDown();
                })

            },800)
            updateTradersList()
        }


        $(".form4_listOfWarehousesBtn").click(function () {
            let btn = $(this);
            load_modal3(btn);
            $.ajax({
                url : '{{route("dashboard.warehouses.index")}}?for='+btn.attr('for'),
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

        $(".insertWarehouseBtn").click(function () {
            let btn = $(this);
            $.ajax({
                url : '{{route("dashboard.ajax.get","form4InsertWarehouse")}}?transactionType='+btn.attr('transactionType')+'&sugarType='+btn.attr('sugarType'),
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("."+btn.attr('before')).before(res);
                },
                error: function (res) {

                }
            })
        })

        function updateForm4(form = null,type = 'updateOnly') {
            let uri = '{{route("dashboard.sms_form4.store")}}?wr={{$wr->slug}}';
            let formData = null;
            if(type === 'updateOnly'){
                uri = uri+'&type=updateOnly';
                formData = null;
            }else{
                formData = form.serialize();
            }
            $.ajax({
                url : uri,
                data : formData,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    if(type !== 'updateOnly'){
                        toast('Changes were auto saved.');
                    }
                    $.each(res.totals,function (i,v) {
                        $("#form4 tr[for='"+i+"']").children('td').eq(1).html(v.current);
                        $("#form4 tr[for='"+i+"']").children('td').eq(2).html(v.prev);
                    })
                },
                error: function (res) {
                    $("#form4 tr.computation").each(function () {
                        $(this).children('td').eq(1).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                        $(this).children('td').eq(2).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                    })
                }
            })
        }
        $("#form4").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $('#form4 tr.computation').each(function () {
                $(this).children('td').eq(1).html('<i class="fa fa-spin fa-refresh"></i>');
                $(this).children('td').eq(2).html('<i class="fa fa-spin fa-refresh"></i>');
            })
            updateForm4(form,'insert');
        })







        function updateForm3a(form = null,type = 'updateOnly') {
            let uri = '{{route("dashboard.sms_form3a.store")}}?wr={{$wr->slug}}';
            let formData = null;
            if(type === 'updateOnly'){
                uri = uri+'&type=updateOnly';
                formData = null;
            }else{
                formData = form.serialize();
            }
            $.ajax({
                url : uri,
                data : formData,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    if(type !== 'updateOnly'){
                        toast('Changes were auto saved.');
                    }
                    $.each(res.totals,function (i,v) {
                        $("#form3a tr[for='"+i+"']").children('td').eq(1).html(v.current);
                        $("#form3a tr[for='"+i+"']").children('td').eq(2).html(v.prev);
                    })
                },
                error: function (res) {
                    $("#form3a tr.computation").each(function () {
                        $(this).children('td').eq(1).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                        $(this).children('td').eq(2).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                    })
                }
            })
        }


        $("#form3a").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $('#form3a tr.computation').each(function () {
                $(this).children('td').eq(1).html('<i class="fa fa-spin fa-refresh"></i>');
                $(this).children('td').eq(2).html('<i class="fa fa-spin fa-refresh"></i>');
            })
            updateForm3a(form,'insert');
        })



        function updateForm4a(form = null,type = 'updateOnly'){
            let uri = '{{route("dashboard.sms_form4a.store")}}?wr={{$wr->slug}}';
            let formData = null;
            if(type === 'updateOnly'){
                uri = uri+'&type=updateOnly';
                formData = null;
            }else{
                formData = form.serialize();
            }
            $.ajax({
                url : uri,
                data : formData,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    if(type !== 'updateOnly'){
                        toast('Changes were auto saved.');
                    }
                    $.each(res.totals,function (i,v) {
                        $("#form4a tr[for='"+i+"']").children('td').eq(1).html(v.current);
                        $("#form4a tr[for='"+i+"']").children('td').eq(2).html(v.prev);
                    })
                },
                error: function (res) {
                    $("#form4a tr.computation").each(function () {
                        $(this).children('td').eq(1).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                        $(this).children('td').eq(2).html('<span class="text-danger"><i class="fa fa-exclamation-triangle"></i></span>');
                    })
                }
            })
        }

        $("#form4a").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            $('#form4a tr.computation').each(function () {
                $(this).children('td').eq(1).html('<i class="fa fa-spin fa-refresh"></i>');
                $(this).children('td').eq(2).html('<i class="fa fa-spin fa-refresh"></i>');
            })
            updateForm4a(form,'insert');
        })

        $(".select2Warehouses").each(function () {
            $(this).select2({
                ajax: {
                    url: '{{route('dashboard.ajax.get','myWarehouses')}}?for='+$(this).attr('for'),
                    dataType: 'json'
                }
            })
        });

        $(".add_seriesNos_btn").click(function () {
            let btn = $(this);
            $.ajax({
                url : '{{route("dashboard.ajax.get","seriesNos")}}?for='+btn.attr('for'),
                data : '',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("#"+btn.attr('data')+" tbody").append(res);
                },
                error: function (res) {

                }
            })
        })

        $("body").on("change",".global-form-changer",function () {
            $(this).parents('form').submit();
        })


        function updateTradersList(){
            $.ajax({
                url : '{{route("dashboard.ajax.get","traderListing")}}',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("datalist#traders").html(res);

                },
                error: function (res) {

                }
            })
        }


    </script>

@endsection