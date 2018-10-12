@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Applicant</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.applicant.store') }}">

        <div class="box-body">
     
          @csrf    

          {!! __form::textbox(
            '3', 'lastname', 'text', 'Lastname *', 'Lastname', old('lastname'), $errors->has('lastname'), $errors->first('lastname'), ''
          ) !!}   

          {!! __form::textbox(
            '3', 'firstname', 'text', 'Firstname *', 'Firstname', old('firstname'), $errors->has('firstname'), $errors->first('firstname'), ''
          ) !!}  

          {!! __form::textbox(
            '3', 'middlename', 'text', 'Middlename *', 'Middlename', old('middlename'), $errors->has('middlename'), $errors->first('middlename'), ''
          ) !!}

          {!! __form::select_static(
            '3', 'gender', 'Gender *', old('gender'), ['Male' => 'MALE', 'Female' => 'FEMALE'], $errors->has('gender'), $errors->first('gender'), '', ''
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::datepicker(
            '3', 'date_of_birth',  'Date of Birth *', old('date_of_birth'), $errors->has('date_of_birth'), $errors->first('date_of_birth')
          ) !!}
                        
          {!! __form::select_static(
            '3', 'civil_status', 'Civil Status *', old('civil_status'), __static::civil_status(), $errors->has('civil_status'), $errors->first('civil_status'), '', ''
          ) !!}

          {!! __form::textbox(
            '6', 'address', 'text', 'Address *', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::select_dynamic(
            '3', 'course_id', 'Course *', old('course_id'), $global_courses_all, 'course_id', 'description', $errors->has('course_id'), $errors->first('course_id'), 'select2', ''
          ) !!}

          {!! __form::select_dynamic(
            '3', 'applicant_pa_id', 'Position Applied for', old('applicant_pa_id'), $global_applicant_pa_all, 'applicant_pa_id', 'position', $errors->has('applicant_pa_id'), $errors->first('applicant_pa_id'), 'select2', ''
          ) !!}

          {!! __form::textbox(
            '3', 'contact_no', 'text', 'Contact No.', 'Contact No.', old('contact_no'), $errors->has('contact_no'), $errors->first('contact_no'), ''
          ) !!}

          {!! __form::textbox(
            '3', 'remarks', 'text', 'Remarks', 'Remarks', old('remarks'), $errors->has('remarks'), $errors->first('remarks'), ''
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

  @if(Session::has('APPLICANT_CREATE_SUCCESS'))

    {!! __html::modal(
      'applicant_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('APPLICANT_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 




@section('scripts')

  <script type="text/javascript">

    @if(Session::has('APPLICANT_CREATE_SUCCESS'))
      $('#applicant_create').modal('show');
    @endif

  </script> 
    
@endsection