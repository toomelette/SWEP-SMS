@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Save as New Voucher</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! HtmlHelper::back_button(['dashboard.disbursement_voucher.user_index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.disbursement_voucher.store') }}">

        <div class="box-body">
     
          @csrf    
          
          {!! FormHelper::select_dynamic(
            '4', 'project_id', 'Station *', old('project_id') ? old('project_id') : $disbursement_voucher->project_id, $global_projects_all, 'project_id', 'project_address', $errors->has('project_id'), $errors->first('project_id'), '', ''
          ) !!}

          {!! FormHelper::select_dynamic(
            '4', 'fund_source_id', 'Fund Source *', old('fund_source_id') ? old('fund_source_id') : $disbursement_voucher->fund_source_id, $global_fund_source_all, 'fund_source_id', 'description', $errors->has('fund_source_id'), $errors->first('fund_source_id'), '', ''
          ) !!}

          {!! FormHelper::select_static(
            '4', 'mode_of_payment', 'Mode Of Payment', old('mode_of_payment') ? old('mode_of_payment') : $disbursement_voucher->mode_of_payment, StaticHelper::dv_mode_of_payment(), $errors->has('mode_of_payment'), $errors->first('mode_of_payment'), '', ''
          ) !!}

          <div class="col-md-12"></div>

          {!! FormHelper::textbox(
            '6', 'payee', 'text', 'Payee *', 'Payee', old('payee') ? old('payee') : $disbursement_voucher->payee, $errors->has('payee'), $errors->first('payee'), 'data-transform="uppercase"'
          ) !!}

          {!! FormHelper::textbox(
            '3', 'tin', 'text', 'TIN/Employee No', 'TIN / Employee No', old('tin') ? old('tin') : $disbursement_voucher->tin, $errors->has('tin'), $errors->first('tin'), ''
          ) !!}

          {!! FormHelper::textbox(
            '3', 'bur_no', 'text', 'BUR No', 'BUR No', old('bur_no') ? old('bur_no') : $disbursement_voucher->bur_no, $errors->has('bur_no'), $errors->first('bur_no'), ''
          ) !!}

          <div class="col-md-12"></div>

          {!! FormHelper::textbox(
            '6', 'address', 'text', 'Address', 'Address', old('address') ? old('address') : $disbursement_voucher->address, $errors->has('address'), $errors->first('address'), 'data-transform="uppercase"'
          ) !!}

          {!! FormHelper::select_dynamic(
            '2', 'department_name', 'Department', old('department_name') ? old('department_name') : $disbursement_voucher->department_name, $global_departments_all, 'name', 'name', $errors->has('department_name'), $errors->first('department_name'), 'select2', ''
          ) !!}

          {!! FormHelper::select_dynamic(
            '2', 'department_unit_name', 'Unit', old('department_unit_name') ? old('department_unit_name') : $disbursement_voucher->department_unit_name, $global_department_units_all, 'name', 'name', $errors->has('department_unit_name'), $errors->first('department_unit_name'), 'select2', ''
          ) !!}

          {!! FormHelper::select_dynamic(
            '2', 'project_code', 'Project Code *', old('project_code') ? old('project_code') : $disbursement_voucher->project_code, $global_project_codes_all, 'project_code', 'project_code', $errors->has('project_code'), $errors->first('project_code'), 'select2', ''
          ) !!}

          <div class="col-md-12">
            <div class="alert alert-warning">
              Note: Please put your computations in the <strong>Explanation Field</strong>, and the Total/Net of your computation in the <strong>Amount Field.</strong>
            </div>
          </div>

          {!! FormHelper::textarea(
            '10', 'explanation', 'Explanation *', old('explanation') ? old('explanation') : $disbursement_voucher->explanation, $errors->has('explanation'), $errors->first('explanation'), ''
          ) !!}

          {!! FormHelper::textbox_numeric(
            '2', 'amount', 'text', 'Amount *', 'Amount', old('amount') ? old('amount') : $disbursement_voucher->amount, $errors->has('amount'), $errors->first('amount'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection





@section('modals')

  {{-- DV CREATE SUCCESS --}}
  @if(Session::has('DV_CREATE_SUCCESS'))

    {!! HtmlHelper::modal_print(
      'dv_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DV_CREATE_SUCCESS'), route('dashboard.disbursement_voucher.show', Session::get('DV_CREATE_SUCCESS_SLUG'))
    ) !!}

  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">
  
    @if(Session::has('DV_CREATE_SUCCESS'))
      $('#dv_create').modal('show');
    @endif

    {!! JSHelper::ajax_select_to_select(
      'department_name', 'department_unit_name', '/api/select_response_department_units_from_department/', 'name', 'name'
    ) !!}

    {!! JSHelper::ajax_select_to_select(
      'department_name', 'project_code', '/api/select_response_project_codes_from_department/', 'project_code', 'project_code'
    ) !!}

    $(function () {
      CKEDITOR.replace('editor');
    });

  </script>
    
@endsection