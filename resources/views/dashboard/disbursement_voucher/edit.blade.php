@php($rand = \Illuminate\Support\Str::random(15))
@extends('layouts.modal-content',['form_id'=>'edit_dv_form_'.$rand,'slug'=>$dv->slug])

@section('modal-header')
    {!! \Illuminate\Support\Str::limit(strip_tags($dv->explanation),50,'...')!!} - {{$type}}
@endsection

@section('modal-body')
    <div class="row">
        {!! __form::select_dynamic(
          '2 project_id', 'project_id', 'Station', $dv->project_id, $global_projects_all, 'project_id', 'project_address', $errors->has('project_id'), $errors->first('project_id'), '', ''
        ) !!}

        {!! __form::select_dynamic(
          '2 fund_source_id', 'fund_source_id', 'Fund Source', $dv->fund_source_id, $global_fund_source_all, 'fund_source_id', 'description', $errors->has('fund_source_id'), $errors->first('fund_source_id'), '', ''
        ) !!}

        {!! __form::select_static(
          '2 mode_of_payment', 'mode_of_payment', 'Mode Of Payment', $dv->mode_of_payment, __static::dv_mode_of_payment(), $errors->has('mode_of_payment'), $errors->first('mode_of_payment'), '', ''
        ) !!}

        {!! __form::textbox(
          '6 payee', 'payee', 'text', 'Payee *', 'Payee', $dv->payee, $errors->has('payee'), $errors->first('payee'), 'data-transform="uppercase"'
        ) !!}
    </div>
    <div class="row">

        {!! __form::textbox(
          '3 tin', 'tin', 'text', 'TIN/Employee No', 'TIN / Employee No', $dv->tin, $errors->has('tin'), $errors->first('tin'), ''
        ) !!}

        {!! __form::textbox(
          '3 bur_no', 'bur_no', 'text', 'BUR No', 'BUR No', $dv->bur_no, $errors->has('bur_no'), $errors->first('bur_no'), ''
        ) !!}

        {!! __form::textbox(
          '6 address', 'address', 'text', 'Address', 'Address', $dv->address, $errors->has('address'), $errors->first('address'), 'data-transform="uppercase"'
        ) !!}
    </div>

    <div class="row">


        {!! __form::select_dynamic(
          '3 department_name', 'department_name', 'Department', $dv->department_name, $global_departments_all, 'name', 'name', $errors->has('department_name'), $errors->first('department_name'), 'select2_'.$rand, ''
        ) !!}

        {!! __form::select_dynamic(
          '3 department_unit_name', 'department_unit_name', 'Unit', $dv->department_unit_name, $global_department_units_all, 'name', 'description', $errors->has('department_unit_name'), $errors->first('department_unit_name'), 'select2_'.$rand, ''
        ) !!}

        {!! __form::select_dynamic(
          '3 project_code', 'project_code', 'Project Code', $dv->project_code, $global_project_codes_all, 'project_code', 'project_code', $errors->has('project_code'), $errors->first('project_code'), 'select2_'.$rand, ''
        ) !!}

        {!! __form::textbox_numeric(
          '3 amount', 'amount', 'text', 'Amount *', 'Amount', $dv->amount, $errors->has('amount'), $errors->first('amount'), '','autonum_'.$rand
        ) !!}
    </div>
    <div class="row">
        <div class="form-group col-md-12 explanation ">
            <label for="explanation">Explanation *</label>
            <textarea class="form-control explanation" id="editor_{{$rand}}" name="explanation" rows="5">{{$dv->explanation}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                Certified by
            </p>
            <div class="row">
                {!! __form::textbox(
                '6 certified_by', 'certified_by', 'text', 'Certified by:', 'Certified by', $dv->certified_by, $errors->has('certified_by'), $errors->first('certified_by'), 'data-transform="uppercase" list="certified_list"'
                ) !!}

                {!! __form::textbox(
                  '6 certified_by_position', 'certified_by_position', 'text', 'Position', 'Position', $dv->certified_by_position, $errors->has('certified_by_position'), $errors->first('certified_by_position'), 'data-transform="uppercase" list="certified_list_position"'
                ) !!}
            </div>
        </div>

        <div class="col-md-6">
            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                Approved by
            </p>
            <div class="row">
                {!! __form::textbox(
                    '6 approved_by', 'approved_by', 'text', 'Approved for payment by:', 'Approved by', $dv->approved_by, $errors->has('approved_by'), $errors->first('approved_by'), 'data-transform="uppercase" list="approved_list"'
                ) !!}
                {!! __form::textbox(
                    '6 approved_by_position', 'approved_by_position', 'text', 'Position', 'Position', $dv->approved_by_position, $errors->has('approved_by_position'), $errors->first('approved_by_position'), 'data-transform="uppercase" list="approved_list_position"'
                ) !!}
            </div>
        </div>
    </div>

@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
<script type="text/javascript">

    $(document).ready(function () {
        $(function () {
            CKEDITOR.replace('editor_{{$rand}}');
        });
    })


    {!! __js::ajax_select_to_select(
          'department_name', 'department_unit_name', '/api/department_unit/select_departmentUnit_byDeptName/', 'name', 'description'
        ) !!}

    {!! __js::ajax_select_to_select(
      'department_name', 'project_code', '/api/project_code/select_projectCode_byDeptName/', 'project_code', 'project_code'
    ) !!}

    $(".select2_{{$rand}}").select2({
        dropdownParent: $('#edit_dv_modal')
    });

    {!! \App\Swep\ViewHelpers\__js::autonum('autonum_'.$rand) !!}

    $("#edit_dv_form_{{$rand}}").submit(function (e) {
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();

        e.preventDefault()
        var form = $(this);
        @if($type == 'Edit')
            var uri = '{{route("dashboard.disbursement_voucher.update","slug")}}';
            uri = uri.replace("slug",form.attr('data'));
            @php($request_type = 'PUT')
        @elseif($type == 'Save as')
            var uri = '{{route("dashboard.disbursement_voucher.store")}}';
            @php($request_type = 'POST')
        @endif
        loading_btn(form);
        $.ajax({
            url : uri,
            data : form.serialize(),
            type: '{{$request_type}}',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
               succeed(form,true,true);
               notify('Data successfully saved.','success');
               active = res.slug;
               dvs_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
                console.log(res);
            }
        })
    })
</script>
@endsection

