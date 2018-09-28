@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Overtime</h1>
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

            <input type="hidden" name="doc_type" value="OT">

            {!! __form::select_dynamic(
              '3', 'employee_no', 'Employee *', old('employee_no'), $global_employees_all, 'employee_no', 'fullname', $errors->has('employee_no'), $errors->first('employee_no'), 'select2', ''
            ) !!}

            {!! __form::datepicker(
              '3', 'date',  'Date *', old('date') , $errors->has('date'), $errors->first('date')
            ) !!}

            {!! __form::textbox(
               '3', 'hrs', 'text', 'Hours *', 'Hours', old('hrs'), $errors->has('hrs'), $errors->first('hrs'), ''
            ) !!}

            {!! __form::textbox(
               '3', 'mins', 'text', 'Minutes *', 'Minutes', old('mins'), $errors->has('mins'), $errors->first('mins'), ''
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