@extends('layouts.admin-master')

@section('content')
    <style>
        .select2-container{
            width: 100% !important;
        }
    </style>
    <section class="content-header">
        <h1>Project Procurement and Management Plan  <span class="pull-right">{{request('fiscal_year')}} | {{request('resp_center')}}</span></h1>
    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Project Procurement and Management Plan</h3>
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm" data-target="#add_item_modal" data-toggle="modal"><i class="fa fa-plus"></i> Add item ({{request('fiscal_year')}} | {{request('resp_center')}})</button>
                </div>
            </div>
            <div class="box-body">
                <div id="ppmp_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="ppmp_table" style="width: 100% !important">
                        <thead>
                        <tr class="">
                            <th class="th-20">PPMP Code</th>
                            <th >PAP Code</th>
                            <th >General Desciption</th>
                            <th >Procurement</th>
                            <th >Total budget</th>
                            <th >Details</th>
                            <th class="action">Action</th>
                            <th>GRP</th>
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
        </div>
    </section>




@endsection


@section('modals')
    {!! \App\Swep\ViewHelpers\__html::blank_modal('edit_item_modal','') !!}
    <div class="modal fade" id="add_item_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form id="add_item_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add item - {{request('fiscal_year')}} | {{request('resp_center')}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Year:</b>
                                <h3 style="margin-top: 0" class="text-green">{{request('fiscal_year')}}</h3>
                            </div>
                            <div class="col-md-6">
                                <b>Responsibility Center:</b>
                                <h3 style="margin-top: 0" class="text-green">{{request('resp_center')}}</h3>
                            </div>
                        </div>
                        <hr style="border: 1px dashed #1b7e5a; margin-top: 3px;margin-bottom: 5px">
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::select('pap_code',[
                                'cols' => 12,
                                'label' => 'PAP/PAP Code:',
                                'options' => \App\Swep\Helpers\Helper::getPapCodesArray('2022','AFD',true),
                                'id' => 'pap_code',
                            ]) !!}
                        </div>
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('ppmp_code',[
                               'cols' => 4,
                               'label' => 'PPMP Code:',
                           ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::select('mode_of_proc',[
                                'cols' => 4,
                                'label' => 'Mode of Procurement',
                                'options' => \App\Swep\Helpers\Helper::modesOfProcurement(),
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::select('budget_type',[
                                'cols' => 4,
                                'label' => 'Source of Fund',
                                'options' => \App\Swep\Helpers\Helper::budgetTypes(),
                            ]) !!}
                        </div>
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('gen_desc',[
                                'cols' => 12,
                                'label' => 'General Description',
                            ]) !!}
                        </div>
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('unit_cost',[
                                'cols' => 4,
                                'label' => 'Unit Cost:',
                                'class' => 'autonumber unit_cost',
                                'autocomplete' => 'off',
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
                                'cols' => 4,
                                'label' => 'Quantity:',
                                'type' => 'number',
                                'class' => 'qty',
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::select('uom',[
                                'cols' => 4,
                                'label' => 'Unit:',
                                'options' => \App\Swep\Helpers\Helper::unitsOfMeasurementPPMP(),
                            ]) !!}
                        </div>
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('total_est_budget',[
                                'id' => 'total_est_budget',
                                'cols' => 4,
                                'label' => 'Total estimated budget:',
                                'class' => 'total_est_budget',
                                'readonly' => 'readonly',
                            ]) !!}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Schedule/Milestone of Activities: (Must be a number)</label>
                                <table class="milestone" style="width: 100%;">
                                    <tr class="text-center">
                                        @foreach(\App\Swep\Helpers\Helper::milestones() as $month)
                                            <td>{{$month}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach(\App\Swep\Helpers\Helper::milestones() as $month)
                                            <td>
                                                <input type="text" class="no-style-input qty_{{strtolower($month)}}"  value="" name="qty_{{strtolower($month)}}" autocomplete="off">
                                            </td>
                                        @endforeach
                                    </tr>
                                </table>
                                <br>
                            </div>

                        </div>
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('remark',[
                                'cols' => 12,
                                'label' => 'Remark (brief description of the Program/Project):',
                            ]) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        var active = '';
        ppmp_tbl = $("#ppmp_table").DataTable({
            "ajax" : '{{route("dashboard.ppmp.index")}}?{{\Illuminate\Support\Facades\Request::getQueryString()}}',
            'rowGroup' : {
                'dataSrc' : 'grp',
            },
            "order" : [[0,'asc']],
            "columns": [
                { "data": "ppmp_code" },
                { "data": "pap_code" },
                { "data": "gen_desc" },
                { "data": "mode_of_proc" },
                { "data": "total_budget" },
                { "data": "details" },
                { "data": "action" },
                {"data":"grp"}
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : [0],
                    "class" : 'w-8p'
                },
                {
                    "targets" : 1,
                    "class" : 'w-8p'
                },
                {
                    "targets" : 4,
                    "class" : 'w-8p text-right'
                },
                {
                    "targets" : 3,
                    "class" : 'w-13p'
                },
                {
                    "targets" : 5,
                    "orderable" : false,
                    "class" : 'w-10p'
                },
                {
                    "targets" : 6,
                    "orderable" : false,
                    "class" : 'action3'
                },
                {
                    "targets" : 7,
                    "visible" : false,
                },
            ],
            "responsive": false,
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "initComplete": function( settings, json ) {
                style_datatable("#"+settings.sTableId);
                $('#tbl_loader').fadeOut(function(){
                    $("#"+settings.sTableId+"_container").fadeIn();
                });
                //Need to press enter to search
                $('#'+settings.sTableId+'_filter input').unbind();
                $('#'+settings.sTableId+'_filter input').bind('keyup', function (e) {
                    if (e.keyCode == 13) {
                        ppmp_tbl.search(this.value).draw();
                    }
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
                    $("#"+settings.sTableId+" #"+active).addClass('success');
                }
            }
        });

        $("#pap_code").select2({
            dropdownParent : $("#add_item_modal"),
        });
        var unit_cost = 0;
        var qty = 0;
        $('body').on('change','.unit_cost',function () {
            if($(this).val() != ''){
                unit_cost = $(this).val().replaceAll(',','');
            }
            let t = $(this);
            let body_parent = t.parent('div').parent('div').parent('div');
            body_parent.find('input.total_est_budget').val(formatToCurrency(unit_cost*qty));
            body_parent.find('input.total_est_budgetapp').change();
        })
        $('body').on('change','.qty',function () {
            if($(this).val() != '') {
                qty = $(this).val();
            }
            let t = $(this);
            let body_parent = t.parent('div').parent('div').parent('div');
            body_parent.find('input.total_est_budget').val(formatToCurrency(unit_cost*qty));
            body_parent.find('input.total_est_budget').change();
        })

        $("#add_item_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.ppmp.store")}}',
                data : form.serialize()+'&{!! Request::getQueryString() !!}',
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,false);
                    notify('Item successfully added.','success');
                    $("#pap_code").val('').trigger('change');
                    unit_cost = 0;
                    qty = 0;
                    wipe_autonum();
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })

        $("body").on("click",".edit_item_btn", function(){
            btn = $(this);
            load_modal2(btn);
            uri = "{{route('dashboard.ppmp.edit','slug')}}";
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


