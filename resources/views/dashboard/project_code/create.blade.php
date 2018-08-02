@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Project Code</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.project_code.store') }}">

        <div class="box-body">
     
          @csrf    

          {!! FormHelper::select_dynamic(
              '3', 'department_id', 'Department *', old('department_id'), $global_departments_all, 'department_id', 'name', $errors->has('department_id'), $errors->first('department_id'), 'select2', ''
          ) !!}

          <input type="hidden" name="department_name" id="department_name" value="{{ old('department_name') }}">

          {!! FormHelper::textbox(
             '3', 'project_code', 'text', 'Project Code *', 'Project Code', old('project_code'), $errors->has('project_code'), $errors->first('project_code'), ''
          ) !!}

          {!! FormHelper::textbox(
             '6', 'description', 'text', 'Description *', 'Description', old('description'), $errors->has('description'), $errors->first('description'), ''
          ) !!}

          <div class="col-md-12"></div>

          {!! FormHelper::textbox_numeric(
            '3', 'mooe', 'text', 'MOOE', 'MOOE', old('mooe'), $errors->has('mooe'), $errors->first('mooe'), ''
          ) !!}

          {!! FormHelper::textbox_numeric(
            '3', 'co', 'text', 'CO', 'CO', old('co'), $errors->has('co'), $errors->first('co'), ''
          ) !!}

          {!! FormHelper::datepicker(
            '3', 'date_started',  'Date Started', old('date_started'), $errors->has('date_started'), $errors->first('date_started')
          ) !!}

          {!! FormHelper::datepicker(
            '3', 'projected_date_end',  'Projected Date End', old('projected_date_end'), $errors->has('projected_date_end'), $errors->first('projected_date_end')
          ) !!}

          <div class="col-md-12"></div>

          {!! FormHelper::textbox(
             '6', 'project_in_charge', 'text', 'Project Incharge', 'Project Incharge', old('project_in_charge'), $errors->has('project_in_charge'), $errors->first('project_in_charge'), 'data-transform="uppercase"'
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

  @if(Session::has('PROJECT_CODE_CREATE_SUCCESS'))

    {!! HtmlHelper::modal(
      'project_code_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('PROJECT_CODE_CREATE_SUCCESS')
    ) !!}

  @endif

@endsection 




@section('scripts')

  <script type="text/javascript">

    @if(Session::has('PROJECT_CODE_CREATE_SUCCESS'))
      $('#project_code_create').modal('show');
    @endif

    {!! JSHelper::ajax_select_to_input(
      'department_id', 'department_name', '/api/department/textbox_department_ByDepartmentId/', 'name'
    ) !!}

  </script> 
    
@endsection