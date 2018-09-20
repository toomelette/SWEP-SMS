@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Edit Permission</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! __html::back_button([
          'dashboard.permission_slip.index',
          'dashboard.permission_slip.show',
        ]) !!}
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
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.permission_slip.update', $permission_slip->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          
          @csrf 

          <input name="_method" value="PUT" type="hidden">
          
          {!! __form::datepicker(
            '3', 'date',  'Date *', old('date') ? old('date') : $permission_slip->date, $errors->has('date'), $errors->first('date')
          ) !!}

          {!! __form::select_dynamic(
            '3', 'employee_no', 'Employee *', old('employee_no') ? old('employee_no') : $permission_slip->employee_no, $global_employees_all, 'employee_no', 'fullname', $errors->has('employee_no'), $errors->first('employee_no'), 'select2', ''
          ) !!}

          {!! __form::timepicker(
            '3', 'time_out',  'Time Out *', old('time_out') ? old('time_out') : date('h:i A', strtotime($permission_slip->time_out)), $errors->has('time_out'), $errors->first('time_out')
          ) !!}

          {!! __form::timepicker(
            '3', 'time_in',  'Time In *', old('time_in') ? old('time_in') : date('h:i A', strtotime($permission_slip->time_in)), $errors->has('time_in'), $errors->first('time_in')
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::select_static(
            '3', 'with_ps', 'With PS *', old('with_ps') ? old('with_ps') : __dataType::boolean_to_string($permission_slip->time_in), ['Yes' => 'true', 'No' => 'false'], $errors->has('with_ps'), $errors->first('with_ps'), '', ''
          ) !!}



        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection