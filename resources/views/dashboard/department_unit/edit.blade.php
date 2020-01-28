@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Edit Department Unit</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! __html::back_button(['dashboard.department_unit.index']) !!}
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
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.department_unit.update', $department_unit->slug) }}">

        <div class="box-body">
     
          @csrf    

          <input name="_method" value="PUT" type="hidden">
          
          {!! __form::select_dynamic(
            '4', 'department_id', 'Department *', old('department_id') ? old('department_id') : $department_unit->department_id, $global_departments_all, 'department_id', 'name', $errors->has('department_id'), $errors->first('department_id'), 'select2', ''
          ) !!}

          <input type="hidden" name="department_name" id="department_name" value="{{ old('department_name') ? old('department_name') : $department_unit->department_name }}">

          {!! __form::textbox(
             '4', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $department_unit->name, $errors->has('name'), $errors->first('name'), ''
          ) !!}

          {!! __form::textbox(
             '4', 'description', 'text', 'Description *', 'Description', old('description') ? old('description') : $department_unit->description , $errors->has('description'), $errors->first('description'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection




@section('scripts')

  <script type="text/javascript">

    {!! __js::ajax_select_to_input(
      'department_id', 'department_name', '/api/department/textbox_department_ByDepartmentId/', 'name'
    ) !!}

  </script> 
    
@endsection