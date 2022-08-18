@extends('layouts.admin-master')

@section('content')
    <style>
        .select2-container{
            width: 100% !important;
        }
    </style>
    <section class="content-header">
        <h1>Disbursement Vouchers</h1>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">List of Disbursement Vouchers</h3>
                <button data-step="1" data-intro="Create Disbursement Voucher by using this button." class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_dv_modal"><i class="fa fa-plus"></i> Create</button>
            </div>
            <div class="panel">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="true" class="">
                            <i class="fa fa-filter"></i>  Advanced Filters <i class=" fa  fa-angle-down"></i>
                        </a>
                    </h4>
                    <small id="filter-notifier" class="label bg-blue blink"></small>
                </div>
                <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="box-body">
                        <form id="filter_form">
                            <div class="row">
{{--                                <div class="col-md-2 dt_filter-parent-div">--}}
{{--                                    <label>Department:</label>--}}
{{--                                    <select name="department_name"  class="form-control dt_filter filter_sex filters select22">--}}
{{--                                        <option value="">None</option>--}}
{{--                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_departments_all,'name','name') !!}--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-2 dt_filter-parent-div">--}}
{{--                                    <label>Unit:</label>--}}
{{--                                    <select name="department_unit_name"  class="form-control dt_filter filter_sex filters select22">--}}
{{--                                        <option value="">None</option>--}}
{{--                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_department_units_all,'description','name') !!}--}}
{{--                                    </select>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-2 dt_filter-parent-div">--}}
{{--                                    <label>Project Code:</label>--}}
{{--                                    <select name="project_code"  class="form-control dt_filter filter_sex filters select22">--}}
{{--                                        <option value="">None</option>--}}
{{--                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_project_codes_all,'project_code','project_code') !!}--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                                <div class="col-md-1 dt_filter-parent-div">
                                    <label>Fund Source:</label>
                                    <select name="fund_source_id"  class="form-control dt_filter filter_sex filters">
                                        <option value="">None</option>
                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_fund_source_all,'description','fund_source_id') !!}
                                    </select>
                                </div>
                                <div class="col-md-2 dt_filter-parent-div">
                                    <label>Station:</label>
                                    <select name="project_id"  class="form-control dt_filter filter_sex filters">
                                        <option value="">None</option>
                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_projects_all,'project_address','project_id') !!}
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label style="margin-bottom: 2px;">
                                                Filter Date
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-addon dt_filter-parent-div">
                                                    <input type="checkbox" name="filter_date" class="dt_filter" id="filter_date_checkbox">
                                                </div>
                                                <input name="date_range" type="text" class="form-control pull-right dt_filter" id="date_range" autocomplete="off" disabled>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div id="dvs_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="dvs_table" style="width: 100%">
                        <thead>
                        <tr class="">
                            <th >Payee</th>
                            <th>DV No.</th>
                            <th >Explanation</th>
                            <th >Date</th>
                            <th >Amount</th>
                            <th class="action">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="tbl_loader">
                    <center>
                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                    </center>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    {{--                DATALIST--}}
    @php
        $certified_bys = App\Models\DisbursementVoucher::select('certified_by')->groupBy('certified_by')->get();
    @endphp
    <datalist id="certified_list">
        @if($certified_bys->count() > 0)
            @foreach($certified_bys as $certified_by)
                <option>{{$certified_by->certified_by}}</option>
            @endforeach
        @endif
    </datalist>

    @php
        $certified_by_positions = App\Models\DisbursementVoucher::select('certified_by_position')->groupBy('certified_by_position')->get();
    @endphp
    <datalist id="certified_list_position">
        @if($certified_by_positions->count() > 0)
            @foreach($certified_by_positions as $certified_by_position)
                <option>{{$certified_by_position->certified_by_position}}</option>
            @endforeach
        @endif
    </datalist>
    @php
        $approved_bys = App\Models\DisbursementVoucher::select('approved_by')->where('approved_by','!=','-')->groupBy('approved_by')->get();
    @endphp
    <datalist id="approved_list">
        @if($approved_bys->count() > 0)
            @foreach($approved_bys as $approved_by)
                <option>{{$approved_by->approved_by}}</option>
            @endforeach
        @endif
    </datalist>
    @php
        $approved_by_positions = App\Models\DisbursementVoucher::select('approved_by_position')->where('approved_by_position','!=','-')->groupBy('approved_by_position')->get();
    @endphp
    <datalist id="approved_list_position">
        @if($approved_by_positions->count() > 0)
            @foreach($approved_by_positions as $approved_by_position)
                <option>{{strtoupper($approved_by_position->approved_by_position)}}</option>
            @endforeach
        @endif
    </datalist>

@endsection


@section('modals')
{!! \App\Swep\ViewHelpers\__html::blank_modal('show_dv_modal','lg') !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('print_dv_modal','50') !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('edit_dv_modal','60','',true) !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('save_as_modal','60','',true) !!}

<div class="modal fade" id="add_dv_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 70%" role="document">
        <div class="modal-content">
            <form id="add_dv_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Disbursement Voucher</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('project_id',[
                            'label' => 'Station:',
                            'cols' => 2,
                            'options' => \App\Swep\Helpers\Helper::stations(),
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('fund_source',[
                            'label' => 'Fund source:',
                            'cols' => 2,
                            'options' => \App\Swep\Helpers\Helper::budgetTypes(),
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('mode_of_payment',[
                           'label' => 'Fund source:',
                           'cols' => 3,
                           'options' => __static::dv_mode_of_payment(),
                       ]) !!}


                        {!! \App\Swep\ViewHelpers\__form2::textbox('mode_of_payment_specify',[
                            'label' => 'If OTHERS, Specify:',
                            'cols' => 5,
                        ]) !!}

                    </div>
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('payee',[
                            'label' => 'Payee *:',
                            'cols' => 4,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('tin',[
                            'label' => 'TIN:',
                            'cols' => 2,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('bur_no',[
                            'label' => 'BUR No:',
                            'cols' => 2,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('address',[
                            'label' => 'Address:',
                            'cols' => 4,
                        ]) !!}

                    </div>
                    <div class="row">
                        {!! __form::textarea(
                          '12 explanation', 'explanation', 'Particular: *', '', $errors->has('explanation'), $errors->first('explanation'), '',' Please put your computations below'
                        ) !!}
                    </div>

                    @php($rcs = \App\Models\RC::query()->get())

                    <div class="row">
                        <div class="col-md-6">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;padding-bottom:8px">
                                Charging
                                <button type="button" class="pull-right btn btn-xs btn-success add_charging_btn"><i class="fa fa-plus"></i> Add</button>
                            </p>
                            <div class="wrapping" id="wrapping">
                                @include('ajax.disbursement_voucher.add_item',['rand' => \Illuminate\Support\Str::random(5)])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                        Certified by (Supervisor)
                                    </p>
                                    <div class="row">
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('certified_supervisor',[
                                            'label' => 'Certified by: (Supervisor):',
                                            'cols' => 6,
                                        ]) !!}
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('certified_supervisor_position',[
                                            'label' => 'Position:',
                                            'cols' => 6,
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                        Certified by
                                    </p>
                                    <div class="row">
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('certified_by',[
                                            'label' => 'Certified by:*',
                                            'cols' => 6,
                                            'extra_attr' => 'data-transform="uppercase" list="certified_list"',
                                        ]) !!}

                                        {!! \App\Swep\ViewHelpers\__form2::textbox('certified_by_position',[
                                            'label' => 'Position*:',
                                            'cols' => 6,
                                            'extra_attr' => 'data-transform="uppercase" list="certified_list_position"',
                                        ]) !!}

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                        Approved by
                                    </p>
                                    <div class="row">
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('approved_by',[
                                            'label' => 'Approved for payment by:*',
                                            'cols' => 6,
                                            'extra_attr' => 'data-transform="uppercase" list="approved_list"',
                                        ]) !!}

                                        {!! \App\Swep\ViewHelpers\__form2::textbox('approved_by_position',[
                                            'label' => 'Position:*',
                                            'cols' => 6,
                                            'extra_attr' => 'data-transform="uppercase" list="approved_list_position"',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Create</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="add_item_modal" tabindex="-1" role="dialog" aria-labelledby="add_item_modal_label">
    <div class="modal-dialog modal-lg" role="document">
        <form id="add_item_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add item</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {!! __form::textarea(
                              '12 particular', 'particular', 'Particular *', '', $errors->has('particular'), $errors->first('particular'), '',' Please put your computations below'
                            ) !!}
                    </div>
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('resp_center',[
                                'label' => 'Resp. Center',
                                'options' => \App\Swep\Helpers\Helper::populateOptionsFromObjectAsArray($rcs,'name','name'),
                                'cols' => 3
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('pap',[
                                'label' => 'PAP Code',
                                'cols' => 3,
                         ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('resp_center',[
                            'label' => 'Amount',
                            'class' => 'autonumber amount',
                            'cols' => 3,
                        ]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function dt_draw() {
            users_table.draw(false);
        }

        {{--function filter_dt() {--}}
        {{--    is_online = $(".filter_status").val();--}}
        {{--    is_active = $(".filter_account").val();--}}
        {{--    users_table.ajax.url("{{ route('dashboard.user.index') }}" + "?is_online=" + is_online + "&is_active=" + is_active).load();--}}

        {{--    $(".filters").each(function (index, el) {--}}
        {{--        if ($(this).val() != '') {--}}
        {{--            $(this).parent("div").addClass('has-success');--}}
        {{--            $(this).siblings('label').addClass('text-green');--}}
        {{--        } else {--}}
        {{--            $(this).parent("div").removeClass('has-success');--}}
        {{--            $(this).siblings('label').removeClass('text-green');--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
    <script type="text/javascript">

        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        var active = '';
        dvs_tbl = $("#dvs_table").DataTable({
          'dom' : 'lBfrtip',
          "processing": true,
          "serverSide": true,
          "ajax" : '{{route(\Illuminate\Support\Facades\Route::currentRouteName())}}',
          "columns": [
            { "data": "payee" },
            { "data": "dv_no" },
            { "data": "explanation" },
            { "data": "date" },
            { "data": "amount" },
            { "data": "action" }
          ],
          "buttons": [
            {!! __js::dt_buttons() !!}
          ],
          "columnDefs":[
            {
              "targets" : 4,
              "class" : 'text-right'
            },

            {
              "targets" : 2,
              "class" : 'w-40p'
            },
            {
              "targets" : 5,
              "orderable" : false,
              "class" : 'action4'
            },
          ],
            "order":[[3,'desc'],[0,'asc']],
          "responsive": false,
          "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
              $("#dvs_table_container").fadeIn(function () {
                  @if(request()->has('initiator') && request('initiator') == 'create')
                    introJs().start();
                  @endif
              });
            });
          },
          "language":
                  {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                  },
          "drawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="modal"]').tooltip();
            if(active != ''){
              $("#dvs_table #"+active).addClass('success');
            }
          }
        })

        style_datatable("#dvs_table");

        //Need to press enter to search
        $('#dvs_table_filter input').unbind();
        $('#dvs_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            dvs_tbl.search(this.value).draw();
          }
        });

        $("body").on("click",".add_charging_btn",function () {
            let btn = $(this);
            wait_this_button(btn);
            $.ajax({
                url : '{{route("dashboard.ajax.get","dv_add_item")}}',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    unwait_this_button(btn);
                    btn.parent('p').parent('div').find('.wrapping').append(res.view);
                    new AutoNumeric("input.amount_"+res.rand, autonum_settings);
                },
                error: function (res) {
                    unwait_this_button(btn)
                }
            })
        })

        $("body").on("click",".remove_item_btn",function () {
            let btn = $(this);
            let parent_div = btn.parents('.wrapping');
            if(parent_div.find('.row').length < 2){
                notify('Must have at least one row.','warning');
            }else{
                btn.parent('div').parent('div').remove();
            }
        })
        $(document).ready(function () {
            $("#date_range").attr('readonly','readonly');
            $(function () {
                CKEDITOR.replace('editor',{
                    height: 250,
                });
            });

            $(function () {
                CKEDITOR.replace('editor_1',{
                    height: 100,
                });
            })




        })
        {!! __js::ajax_select_to_select(
          'department_name', 'department_unit_name', '/api/department_unit/select_departmentUnit_byDeptName/', 'name', 'description'
        ) !!}

        {!! __js::ajax_select_to_select(
          'department_name', 'project_code', '/api/project_code/select_projectCode_byDeptName/', 'project_code', 'project_code'
        ) !!}
        {!! \App\Swep\ViewHelpers\__js::autonum() !!}
        $(".select2").select2({
            dropdownParent: $('#add_dv_modal')
        });



        $("body").on("click",'.show_dv_btn',function () {
            btn = $(this);
            slug= btn.attr('data');
            load_modal2(btn);
            var uri = '{{route("dashboard.disbursement_voucher.show","slug")}}';
            uri = uri.replace('slug',slug);
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
                    notify('Ajax error.','danger');
                    console.log(res);
                }
            })
        })

        $("body").on("click",".print_dv_btn",function () {
            btn = $(this);
            load_modal2(btn);
            var uri = '{{route("dashboard.disbursement_voucher.print_preview","slug")}}';
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
                    notify('Ajax error.','danger');
                    console.log(res);
                }
            })
        })

        $("#add_dv_form").submit(function (e) {
            e.preventDefault();
            var form = $(this);
            loading_btn(form);
            for (instance in CKEDITOR.instances) {CKEDITOR.instances[instance].updateElement()}
            $.ajax({
                url : '{{route("dashboard.disbursement_voucher.store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   succeed(form, true,false);
                   active = res.slug;
                   dvs_tbl.draw(false);
                   notify('Voucher successfully created','success');
                },
                error: function (res) {
                    errored(form,res);
                    console.log(res);
                }
            })
        })
        $("body").on("click",".edit_dv_btn",function () {
            var btn = $(this);
            load_modal2(btn);
            uri = "{{route('dashboard.disbursement_voucher.edit','slug')}}";
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
                    notify('Ajax error.','danger');
                    console.log(res);
                }
            })
        })

        $("body").on('click','.no_dv_set',function () {

            let btn = $(this);
            $("#dvs_table #"+btn.attr('data')).addClass('warning');
            let dv = $(this).attr('data');
            let uri = "{{route('dashboard.disbursement_voucher.set_no_post','slug')}}";
            uri = uri.replace('slug',dv);
            Swal.fire({
                title: 'Set DV number:',
                html: '',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off',
                },
                inputValue: btn.attr('placeholder'),
                showCancelButton: true,
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                preConfirm: (text) => {
                    return $.ajax({
                        url : uri,
                        data : {'dv_no':text},
                        type: 'PATCH',
                        headers: {
                            {!! __html::token_header() !!}
                        },
                        success: function (res) {
                            active = res.slug;
                            dvs_tbl.draw(false);
                            notify('DV No was set successfully.','success');
                        },
                        error: function (res) {
                            if(res.status == 422){
                                var message = res.responseJSON.errors.dv_no;
                            }else{
                                var message = res.responseJSON.message;
                            }
                            Swal.showValidationMessage(
                                'Request failed: ' + message
                            );
                        }
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                        .catch(error => {

                        })

                },
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    $("#dvs_table #"+btn.attr('data')).removeClass('warning');
                }
            })
        })

        $(".select22").select2();

        $('#date_range').daterangepicker();

        $("#filter_date_checkbox").change(function () {
            let t = $(this);
            if(t.prop('checked') == true){
                $("#date_range").removeAttr('readonly');
            }else{
                $("#date_range").attr('readonly','readonly');
            }
        })

        $(".dt_filter").change(function () {
            filterDT(dvs_tbl);
        })
        $("body").on("click",".save_as_btn", function () {
            btn = $(this);
            load_modal2(btn);
            let uri = '{{route("dashboard.disbursement_voucher.save_as","slug")}}';
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
                    notify('Ajax error.','danger');
                    console.log(res);
                }
            })
        })


    </script>


@endsection

