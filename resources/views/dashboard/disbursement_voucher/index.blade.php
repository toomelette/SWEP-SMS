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
                <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#add_dv_modal"><i class="fa fa-plus"></i> Create</button>
            </div>
            <div class="panel">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="true" class="">
                            <i class="fa fa-filter"></i>  Advanced Filters <i class=" fa  fa-angle-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="box-body">
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <button class="btn btn-xs btn-default pull-right" id="clear_filter">Clear filters</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <form id="filter_form">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Department:</label>
                                    <select name="department_name"  class="form-control dt_filter filter_sex filters select22">
                                        <option value="">None</option>
                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_departments_all,'name','name') !!}
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Unit:</label>
                                    <select name="department_unit_name"  class="form-control dt_filter filter_sex filters select22">
                                        <option value="">None</option>
                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_department_units_all,'description','name') !!}
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label>Project Code:</label>
                                    <select name="project_code"  class="form-control dt_filter filter_sex filters select22">
                                        <option value="">None</option>
                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_project_codes_all,'project_code','project_code') !!}
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label>Fund Source:</label>
                                    <select name="fund_source_id"  class="form-control dt_filter filter_sex filters">
                                        <option value="">None</option>
                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_fund_source_all,'description','fund_source_id') !!}
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Station:</label>
                                    <select name="project_id"  class="form-control dt_filter filter_sex filters">
                                        <option value="">None</option>
                                        {!! \App\Swep\ViewHelpers\__html::options_obj($global_projects_all,'project_address','project_id') !!}
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label style="margin-bottom: 2px;">
                                                Filter Date
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
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

<div class="modal fade" id="add_dv_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width: 60%" role="document">
        <div class="modal-content">
            <form id="add_dv_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Disbursement Voucher</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {!! __form::select_dynamic(
                          '2 project_id', 'project_id', 'Station', '', $global_projects_all, 'project_id', 'project_address', $errors->has('project_id'), $errors->first('project_id'), '', ''
                        ) !!}

                        {!! __form::select_dynamic(
                          '2 fund_source_id', 'fund_source_id', 'Fund Source', '', $global_fund_source_all, 'fund_source_id', 'description', $errors->has('fund_source_id'), $errors->first('fund_source_id'), '', ''
                        ) !!}

                        {!! __form::select_static(
                          '2 mode_of_payment', 'mode_of_payment', 'Mode Of Payment', '', __static::dv_mode_of_payment(), $errors->has('mode_of_payment'), $errors->first('mode_of_payment'), '', ''
                        ) !!}

                        {!! __form::textbox(
                          '6 payee', 'payee', 'text', 'Payee *', 'Payee', '', $errors->has('payee'), $errors->first('payee'), 'data-transform="uppercase"'
                        ) !!}
                    </div>
                    <div class="row">

                        {!! __form::textbox(
                          '3 tin', 'tin', 'text', 'TIN/Employee No', 'TIN / Employee No', '', $errors->has('tin'), $errors->first('tin'), ''
                        ) !!}

                        {!! __form::textbox(
                          '3 bur_no', 'bur_no', 'text', 'BUR No', 'BUR No', '', $errors->has('bur_no'), $errors->first('bur_no'), ''
                        ) !!}

                        {!! __form::textbox(
                          '6 address', 'address', 'text', 'Address', 'Address', '', $errors->has('address'), $errors->first('address'), 'data-transform="uppercase"'
                        ) !!}
                    </div>

                    <div class="row">


                        {!! __form::select_dynamic(
                          '3 department_name', 'department_name', 'Department', '', $global_departments_all, 'name', 'name', $errors->has('department_name'), $errors->first('department_name'), 'select2', ''
                        ) !!}

                        {!! __form::select_dynamic(
                          '3 department_unit_name', 'department_unit_name', 'Unit', '', $global_department_units_all, 'name', 'description', $errors->has('department_unit_name'), $errors->first('department_unit_name'), 'select2', ''
                        ) !!}

                        {!! __form::select_dynamic(
                          '3 project_code', 'project_code', 'Project Code', '', $global_project_codes_all, 'project_code', 'project_code', $errors->has('project_code'), $errors->first('project_code'), 'select2', ''
                        ) !!}

                        {!! __form::textbox_numeric(
                          '3 amount', 'amount', 'text', 'Amount *', 'Amount', '', $errors->has('amount'), $errors->first('amount'), ''
                        ) !!}
                    </div>
                    <div class="row">
                        {!! __form::textarea(
                          '12 explanation', 'explanation', 'Explanation *', '', $errors->has('explanation'), $errors->first('explanation'), ''
                        ) !!}


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                Certified by
                            </p>
                            <div class="row">
                                {!! __form::textbox(
                                '6 certified_by', 'certified_by', 'text', 'Certified by:', 'Certified by', '', $errors->has('certified_by'), $errors->first('certified_by'), 'data-transform="uppercase" list="certified_list"'
                                ) !!}

                                {!! __form::textbox(
                                  '6 certified_by_position', 'certified_by_position', 'text', 'Position', 'Position', '', $errors->has('certified_by_position'), $errors->first('certified_by_position'), 'data-transform="uppercase" list="certified_list_position"'
                                ) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                Approved by
                            </p>
                            <div class="row">
                                {!! __form::textbox(
                                    '6 approved_by', 'approved_by', 'text', 'Approved for payment by:', 'Approved by', '', $errors->has('approved_by'), $errors->first('approved_by'), 'data-transform="uppercase" list="approved_list"'
                                ) !!}
                                {!! __form::textbox(
                                    '6 approved_by_position', 'approved_by_position', 'text', 'Position', 'Position', '', $errors->has('approved_by_position'), $errors->first('approved_by_position'), 'data-transform="uppercase" list="approved_list_position"'
                                ) !!}
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

        function filterDT(){
            let data = $("#filter_form").serialize();
            dvs_tbl.ajax.url("{{ route(\Illuminate\Support\Facades\Route::currentRouteName()) }}"+"?"+data).load();
            
            $(".dt_filter").each(function (index,el) {
                if ($(this).val() != ''){
                    $(this).parent("div").addClass('has-success');
                    $(this).siblings('label').addClass('text-green');
                } else {
                    $(this).parent("div").removeClass('has-success');
                    $(this).siblings('label').removeClass('text-green');
                }
            })
        }
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
          "responsive": false,
          "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
              $("#dvs_table_container").fadeIn();
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

        $(function () {
            CKEDITOR.replace('editor');
        });

        $(document).ready(function () {
            $("#date_range").attr('readonly','readonly');
        })
        {!! __js::ajax_select_to_select(
          'department_name', 'department_unit_name', '/api/department_unit/select_departmentUnit_byDeptName/', 'name', 'description'
        ) !!}

        {!! __js::ajax_select_to_select(
          'department_name', 'project_code', '/api/project_code/select_projectCode_byDeptName/', 'project_code', 'project_code'
        ) !!}

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

        // $("#clear_filter").click(function () {
        //     $("#filter_form").get(0).reset();
        //     $(".dt_filter").each(function (index,el) {
        //         $(this).change();
        //         return false;
        //     })
        // })
        $(".dt_filter").change(function () {
            filterDT();
        })
    </script>


@endsection

