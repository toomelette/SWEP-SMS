@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Permission</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.permission_slip.store') }}" enctype="multipart/form-data">

        <div class="box-body">
     
          @csrf 

          {!! FormHelper::datepicker(
            '3', 'date',  'Date *', old('date') ? old('date') : Carbon::now()->format('m/d/Y'), $errors->has('date'), $errors->first('date')
          ) !!}

          {!! FormHelper::select_dynamic(
            '3', 'employee_no', 'Employee *', old('s'), $global_employees_all, 'employee_no', 'fullname', $errors->has('employee_no'), $errors->first('employee_no'), 'select2', ''
          ) !!}


          <div class="col-md-3 bootstrap-timepicker">
            <div class="form-group">
              <label>Time Out:</label>
              <div class="input-group">
                <input type="text" class="form-control timepicker" name="time_out">
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div>
            </div>
            {{ $errors->first('time_out') }}
          </div>


          <div class="col-md-3 bootstrap-timepicker">
            <div class="form-group">
              <label>Time In:</label>
              <div class="input-group">
                <input type="text" class="form-control timepicker" name="time_in">
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div>
            </div>
            {{ $errors->first('time_in') }}
          </div>

          <div class="col-md-12"></div>

          {!! FormHelper::select_static(
            '3', 'with_ps', 'With PS *', old('sex'), ['Yes' => 'true', 'No' => 'false'], $errors->has('with_ps'), $errors->first('with_ps'), '', ''
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

  @if(Session::has('PS_CREATE_SUCCESS'))

    {!! HtmlHelper::modal(
      'ps_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('PS_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('PS_CREATE_SUCCESS'))
      $('#ps_create').modal('show');
    @endif

    $('.timepicker').timepicker({
      showInputs: false,
      minuteStep: 5,
      showMeridian: true,
    })

  </script> 
    
@endsection