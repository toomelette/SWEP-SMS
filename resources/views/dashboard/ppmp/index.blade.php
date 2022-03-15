@extends('layouts.admin-master')

@section('content')
    <style>
        .select2-container{
            width: 100% !important;
        }
    </style>
    <section class="content-header">
        <h1>PPMP</h1>
    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">PPMP</h3>
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm" data-target="#add_item_modal" data-toggle="modal"><i class="fa fa-plus"></i> Add item</button>
                </div>
            </div>

                <div class="box-body">
                    <div class="col-lg-4">
                        <label>PAP CODE:</label>
                        <select name="papp_code" aria-controls="scholars_table" class="form-control input-sm">
                            <option value="001">001</option>
                            <option value="002">002</option>
                            <option value="003">003</option>
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label>MODE OF PROCUREMENT:</label>
                        <select name="papp_code" aria-controls="scholars_table" class="form-control input-sm">
                            <option value="smallValueProcurement">SMALL VALUE PROCUREMENT</option>
                            <option value="bidding">BIDDING</option>
                            <option value="repeatOrder">REPEAT ORDER</option>
                            <option value="shopping">SHOPPING</option>
                            <option value="directContracting">DIRECT CONTRACTING</option>
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label>SOURCE OF FUND:</label>
                        <select name="sourceOfFund" aria-controls="scholars_table" class="form-control input-sm">
                            <option value="cob">COB</option>
                        </select>
                    </div>

                    <div class="mt-10">
                        {!! __form::textbox(
                           '6', 'description', 'text', 'Description', 'Description', old('description'), $errors->has('description'), $errors->first('description'), 'data-transform="uppercase"'
                        ) !!}
                        <div class="col-lg-3">
                            <label>UNIT</label>
                            <select name="unit" aria-controls="scholars_table" class="form-control input-sm">
                                <option value="pc">PC</option>
                            </select>
                        </div>
                        {!! __form::textbox(
                           '3', 'qty', 'text', 'Quantity', 'Quantity', old('qty'), $errors->has('qty'), $errors->first('qty'), 'data-transform="uppercase"'
                        ) !!}
                        {!! __form::textbox(
                           '3', 'unitCost', 'text', 'Unit Cost', 'Unit Cost', old('unitCost'), $errors->has('unitCost'), $errors->first('unitCost'), 'data-transform="uppercase"'
                        ) !!}
                        {!! __form::textbox(
                           '3', 'totalEstimatedBudget', 'text', 'Total Estimated Budget', 'Total Estimated Budget', old('totalEstimatedBudget'), $errors->has('totalEstimatedBudget'), $errors->first('totalEstimatedBudget'), 'data-transform="uppercase"'
                        ) !!}
                        <div class="col-lg-3" style="margin-top: 28px">
                            <button id="add_row" type="button" class="btn btn-sm bg-green ">Add <i class="fa fw fa-plus"></i></button>
                        </div>

                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save <i class="fa fa-fw fa-save"></i></button>
                </div>

        </div>
    </section>




@endsection


@section('modals')
    <div class="modal fade" id="add_item_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form id="add_item_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add item</h4>
                    </div>
                    <div class="modal-body">
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
                                'class' => 'autonum unit_cost',
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
                        <style>
                            .milestone,.milestone th,.milestone td {
                                border: 1px solid grey;
                            }
                            .no-style-input{
                                width: 100%;
                                border: 1px solid black;
                                text-align: center;
                            }
                            .no-style-input:focus {
                                outline: none !important;
                                border:1px solid #0b93d5;
                                box-shadow: 0 0 10px #719ECE;
                            }
                            .no-style-input.has-error {
                                outline: none !important;
                                border:1px solid red;
                                box-shadow: 0 0 10px #dd514c;
                            }
                        </style>
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
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
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
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
    </script>
@endsection


