@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create Leave Application</h1>
</section>

<section class="content">

  <div class="box">
      
    <div class="box-header with-border">
      <h3 class="box-title">Form</h3>
      <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
    </div>
    
    <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.leave_application.store') }}">

      <div class="box-body">
   
        @csrf    

        {!! FormHelper::textbox(
          '4', 'lastname', 'text', 'Lastname *', 'Lastname', old('lastname'), $errors->has('lastname'), $errors->first('lastname'), 'data-transform="uppercase"'
        ) !!}

        {!! FormHelper::textbox(
          '4', 'firstname', 'text', 'Firstname *', 'Firstname', old('firstname'), $errors->has('firstname'), $errors->first('firstname'), 'data-transform="uppercase"'
        ) !!}

        {!! FormHelper::textbox(
          '4', 'middlename', 'text', 'Middlename *', 'Middlename', old('middlename'), $errors->has('middlename'), $errors->first('middlename'), 'data-transform="uppercase"'
        ) !!}

        {!! FormHelper::datepicker('4', 'date_of_filling',  'Date of Filling *', old('date_of_filling'), '', '') !!}

        {!! FormHelper::textbox(
          '4', 'position', 'text', 'Position *', 'Position', old('position'), $errors->has('position'), $errors->first('position'), 'data-transform="uppercase"'
        ) !!}

        {!! FormHelper::textbox_numeric(
          '4', 'salary', 'text', 'Salary *', 'Salary', old('salary'), $errors->has('salary'), $errors->first('salary'), ''
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

  {{-- DV CREATE SUCCESS --}}
  @if(Session::has('DV_CREATE_SUCCESS'))

    {!! HtmlHelper::modal_print(
      'dv_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DV_CREATE_SUCCESS'), route('dashboard.disbursement_voucher.show', Session::get('DV_CREATE_SUCCESS_SLUG'))
    ) !!}

  @endif

@endsection 


@section('scripts')

  <script type="text/javascript">
  

    @if(Session::has('DV_CREATE_SUCCESS'))
      $('#dv_create').modal('show');
    @endif


    {!! JSHelper::datepicker_caller('date_of_filling', 'mm/dd/yy', 'bottom') !!}


  </script>
    
@endsection