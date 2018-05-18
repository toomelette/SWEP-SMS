@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Account</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.account.store') }}">

        <div class="box-body">
     
          @csrf    

          {!! FormHelper::select_dynamic(
              '3', 'department_id', 'Department *', old('department_id'), $global_departments_all, 'department_id', 'name', $errors->has('department_id'), $errors->first('department_id'), 'select2', ''
          ) !!}

          <input type="hidden" name="department_name" id="department_name" value="{{ old('department_name') }}">

          {!! FormHelper::textbox(
             '3', 'account_code', 'text', 'Account Code *', 'Account Code', old('account_code'), $errors->has('account_code'), $errors->first('account_code'), ''
          ) !!}

          {!! FormHelper::textbox(
             '6', 'description', 'text', 'Description *', 'Description', old('description'), $errors->has('description'), $errors->first('description'), ''
          ) !!}

          {!! FormHelper::textbox_numeric(
            '3', 'mooe', 'text', 'MOOE', 'MOOE', old('mooe'), $errors->has('mooe'), $errors->first('mooe'), ''
          ) !!}

          {!! FormHelper::textbox_numeric(
            '3', 'co', 'text', 'CO', 'CO', old('co'), $errors->has('co'), $errors->first('co'), ''
          ) !!}

          {!! FormHelper::datepicker('3', 'date_started',  'Date Started', old('date_started'), '', '') !!}

          {!! FormHelper::datepicker('3', 'projected_date_end',  'Projected Date End', old('projected_date_end'), '', '') !!}

          {!! FormHelper::textbox(
             '6', 'project_in_charge', 'text', 'Project Incharge', 'Project Incharge', old('project_in_charge'), $errors->has('project_in_charge'), $errors->first('project_in_charge'), 'data-transform="uppercase"'
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

  </section>

@endsection


@section('modals')

  @if(Session::has('ACCOUNT_CREATE_SUCCESS'))
    {!! HtmlHelper::modal('account_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('ACCOUNT_CREATE_SUCCESS')) !!}
  @endif

@endsection 


@section('scripts')

  <script type="text/javascript">

    @if(Session::has('ACCOUNT_CREATE_SUCCESS'))
      $('#account_create').modal('show');
    @endif

    {!! JSHelper::ajax_select_to_input('department_id', 'department_name', '/api/textbox_response_departmentName_from_departmentId/', 'name') !!}

    {!! JSHelper::datepicker_caller('date_started', 'mm/dd/yy', 'bottom') !!}

    {!! JSHelper::datepicker_caller('projected_date_end', 'mm/dd/yy', 'bottom') !!}

  </script> 
    
@endsection