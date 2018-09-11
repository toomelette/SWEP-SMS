@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Permission Slip Reports</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.permission_slip.report_generate') }}" target="_blank">

        <div class="box-body">

          {!! FormHelper::select_dynamic(
            '3', 'd', 'Department', old('d'), $global_departments_all, 'department_id', 'name', $errors->has('d'), $errors->first('d'), 'select2', ''
          ) !!}


          {!! FormHelper::datepicker(
            '3', 'df',  'Date From *', old('df'), $errors->has('df'), $errors->first('df')
          ) !!}

          {!! FormHelper::datepicker(
            '3', 'dt',  'Date To *', old('dt'), $errors->has('dt'), $errors->first('dt')
          ) !!}


        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection