@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Department Unit</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.department_unit.store') }}">

        <div class="box-body">
     
          @csrf    

          {!! FormHelper::select_dynamic(
          '4', 'department_id', 'Department:', old('department_id'), $global_departments_all, 'department_id', 'name', $errors->has('department_id'), $errors->first('department_id'), 'select2', ''
          ) !!}

          <input type="hidden" name="department_name" id="department_name" value="{{ old('department_name') }}">

          {!! FormHelper::textbox(
             '4', 'name', 'text', 'Name:', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
          ) !!}

          {!! FormHelper::textbox(
             '4', 'description', 'text', 'Description:', 'Description', old('description'), $errors->has('description'), $errors->first('description'), ''
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

  @if(Session::has('DEPARTMENT_UNIT_CREATE_SUCCESS'))
    {!! HtmlHelper::modal('department_unit_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DEPARTMENT_UNIT_CREATE_SUCCESS')) !!}
  @endif

@endsection 


@section('scripts')

  <script type="text/javascript">

    @if(Session::has('DEPARTMENT_UNIT_CREATE_SUCCESS'))
      $('#department_unit_create').modal('show');
    @endif

    {!! JSHelper::ajax_select_to_input('department_id', 'department_name', '/api/textbox_response_departmentName_from_departmentId/', 'name') !!}

  </script> 
    
@endsection