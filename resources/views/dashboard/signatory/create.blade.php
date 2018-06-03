@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Signatory</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.signatory.store') }}">

        <div class="box-body">
     
          @csrf    

          {!! FormHelper::textbox(
             '4', 'employee_name', 'text', 'Employee Name *', 'Employee Name', old('employee_name'), $errors->has('employee_name'), $errors->first('employee_name'), 'data-transform="uppercase"'
          ) !!}

          {!! FormHelper::textbox(
            '4', 'employee_position', 'text', 'Position *', 'Position', old('employee_position'), $errors->has('employee_position'), $errors->first('employee_position'), 'data-transform="uppercase"'
          ) !!} 

          {!! FormHelper::select_static('4', 'type', 'Type *', old('type'), $global_static_signatory_types, $errors->has('type'), $errors->first('type'), '', '') !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

  </section>

@endsection





@section('modals')

  @if(Session::has('SIGNATORY_CREATE_SUCCESS'))
    {!! HtmlHelper::modal('signatory_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SIGNATORY_CREATE_SUCCESS')) !!}
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('SIGNATORY_CREATE_SUCCESS'))
      $('#signatory_create').modal('show');
    @endif

  </script> 
    
@endsection