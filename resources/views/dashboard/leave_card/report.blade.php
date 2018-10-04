@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Leave Card Reports</h1>
  </section>

  <section class="content">




    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">List of Absenses and Tardiness</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.leave_card.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="r_type" value="loat">

          {!! __form::select_static(
            '3', 'm', 'Month *', old('m'), __static::months(), $errors->has('m'), $errors->first('m'), '', ''
          ) !!}

          {!! __form::textbox(
             '3', 'y', 'text', 'Year *', 'Year', old('y'), $errors->has('y'), $errors->first('y'), ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>






    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Employee Leave Card Ledger</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.leave_card.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="r_type" value="ledger">

          {!! __form::select_dynamic(
            '3', 's', 'Employee *', old('s'), $global_employees_all, 'slug', 'fullname', $errors->has('s'), $errors->first('s'), 'select2', ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>





  </section>

@endsection