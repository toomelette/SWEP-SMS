@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Leave</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.leave_card.store') }}">

        <div class="box-body">
     
          @csrf    

          <input type="hidden" name="doc_type" value="LEAVE">

          {!! __form::select_dynamic(
            '3', 'employee_no', 'Employee *', old('employee_no'), $global_employees_all, 'employee_no', 'fullname', $errors->has('employee_no'), $errors->first('employee_no'), 'select2', ''
          ) !!}

          {!! __form::select_static(
            '3', 'leave_type', 'Leave Type *', old('leave_type'), __static::leave_types(), $errors->has('leave_type'), $errors->first('leave_type'), '', ''
          ) !!}

          {!! __form::select_static(
            '3', 'month', 'Month *', old('month'), __static::months(), $errors->has('month'), $errors->first('month'), '', ''
          ) !!}

          {!! __form::textbox(
             '3', 'year', 'text', 'Year *', 'Year', old('year') ? old('year') : Carbon::now()->format('Y'), $errors->has('year'), $errors->first('year'), ''
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::datepicker(
            '3', 'date_from',  'Date From *', old('date_from') , $errors->has('date_from'), $errors->first('date_from')
          ) !!}

          {!! __form::datepicker(
            '3', 'date_to',  'Date To *', old('date_to') , $errors->has('date_to'), $errors->first('date_to')
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

  @if(Session::has('LC_CREATE_SUCCESS'))

    {!! __html::modal(
      'lc_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('LC_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('LC_CREATE_SUCCESS'))
      $('#lc_create').modal('show');
    @endif

  </script> 
    
@endsection