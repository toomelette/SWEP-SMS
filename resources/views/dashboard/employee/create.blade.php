@php
    
    $civil_status = ['MARRIED' => 'MARRIED', 'WIDOWED' => 'WIDOWED', 'SEPERATED' => 'SEPERATED', 'DIVORSED' => 'DIVORSED', 'SINGLE' => 'SINGLE', ];

@endphp


@extends('layouts.admin-master')


@section('content')
    
  <section class="content-header">
      <h1>Create Employee</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.employee.store') }}">

        @csrf

        <div class="box-body">
     
          {{-- Navigation --}}
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pi" data-toggle="tab">Personal Info</a></li>
              <li><a href="#eb" data-toggle="tab">Educational background</a></li>
              <li><a href="#t" data-toggle="tab">Trainings</a></li>
              <li><a href="#id" data-toggle="tab">Personal ID's</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="pi">

                <div class="row">
                    
                  {!! FormHelper::textbox(
                     '4', 'lastname', 'text', 'Lastname *', 'Lastname', old('lastname'), $errors->has('lastname'), $errors->first('lastname'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '4', 'firstname', 'text', 'Firstname *', 'Firstname', old('firstname'), $errors->has('firstname'), $errors->first('firstname'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '4', 'middlename', 'text', 'Middlename *', 'Middlename', old('middlename'), $errors->has('middlename'), $errors->first('middlename'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '8', 'address', 'text', 'Address *', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
                  ) !!}

                  {!! FormHelper::datepicker('4', 'dob',  'Date of Birth *', old('dob'), $errors->has('dob'), $errors->first('dob')) !!}

                  {!! FormHelper::textbox(
                     '8', 'pob', 'text', 'Place of Birth *', 'Place of Birth', old('pob'), $errors->has('pob'), $errors->first('pob'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '2', 'gender', 'Gender *', old('gender'), ['Male' => 'M', 'Female' => 'F'], $errors->has('gender'), $errors->first('gender'), '', ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '2', 'bloodtype', 'text', 'Blood Type *', 'Blood Type', old('bloodtype'), $errors->has('bloodtype'), $errors->first('bloodtype'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '4', 'civilstat', 'Civil Status *', old('civilstat'), $civil_status, $errors->has('civilstat'), $errors->first('civilstat'), '', ''
                  ) !!}

                </div>

              </div>


              <div class="tab-pane" id="eb">
                
                <div class="row">
                    
                  {!! FormHelper::textbox(
                     '4', 'lastname', 'text', 'Lastname *', 'Lastname', old('lastname'), $errors->has('lastname'), $errors->first('lastname'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '4', 'firstname', 'text', 'Firstname *', 'Firstname', old('firstname'), $errors->has('firstname'), $errors->first('firstname'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '4', 'middlename', 'text', 'Middlename *', 'Middlename', old('middlename'), $errors->has('middlename'), $errors->first('middlename'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '8', 'address', 'text', 'Address *', 'Address', old('address'), $errors->has('address'), $errors->first('address'), ''
                  ) !!}

                  {!! FormHelper::datepicker('4', 'dob',  'Date of Birth *', old('dob'), $errors->has('dob'), $errors->first('dob')) !!}

                  {!! FormHelper::textbox(
                     '8', 'pob', 'text', 'Place of Birth *', 'Place of Birth', old('pob'), $errors->has('pob'), $errors->first('pob'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '2', 'gender', 'Gender *', old('gender'), ['Male' => 'M', 'Female' => 'F'], $errors->has('gender'), $errors->first('gender'), '', ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '2', 'bloodtype', 'text', 'Blood Type *', 'Blood Type', old('bloodtype'), $errors->has('bloodtype'), $errors->first('bloodtype'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '4', 'civilstat', 'Civil Status *', old('civilstat'), $civil_status, $errors->has('civilstat'), $errors->first('civilstat'), '', ''
                  ) !!}

                </div>
                
              </div>


              <div class="tab-pane" id="t">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
              </div>


              <div class="tab-pane" id="id">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
              </div>

            </div>

          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

  </section>

@endsection


@section('modals')

  @if(Session::has('ACCOUNT_CREATE_SUCCESS'))
    {!! HtmlHelper::modal('account_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('ACCOUNT_CREATE_SUCCESS')) !!}
  @endif

@endsection 


@section('scripts')

  <script type="text/javascript">

    @if(Session::has('ACCOUNT_CREATE_SUCCESS'))
      $('#account_create').modal('show');
    @endif

    {!! JSHelper::ajax_select_to_input('department_id', 'department_name', '/api/textbox_response_departmentName_from_departmentId/', 'name') !!}

    {!! JSHelper::datepicker_caller('dob', 'mm/dd/yy', 'bottom') !!}

  </script> 
    
@endsection