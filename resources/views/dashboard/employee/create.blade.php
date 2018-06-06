@php
    $civil_status = [
      'MARRIED' => 'MARRIED', 'WIDOWED' => 'WIDOWED', 'SEPERATED' => 'SEPERATED', 'DIVORSED' => 'DIVORSED', 'SINGLE' => 'SINGLE',
    ];

    $level = [
      'elem' => 'Elementary', 'sec' => 'Secondary', 'voc' => 'Vocational / Trade Course', 'col' => 'College', 'grad' => 'Graduate Studies',
    ];
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


          @if($errors->all())
            {!! HtmlHelper::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', 'Please check if there are errors on other fields.') !!}
          @endif


          {{-- Navigation --}}
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pi" data-toggle="tab">Personal Info</a></li>
              <li><a href="#a" data-toggle="tab">Address</a></li>
              <li><a href="#fi" data-toggle="tab">Family Information</a></li>
              <li><a href="#id" data-toggle="tab">Personal ID's</a></li>
              <li><a href="#ad" data-toggle="tab">Appointment Details</a></li>
              <li><a href="#eb" data-toggle="tab">Educational background</a></li>
              <li><a href="#t" data-toggle="tab">Trainings</a></li>
            </ul>

            <div class="tab-content">



              {{-- Personal Info --}}
              <div class="tab-pane active" id="pi">
                <div class="row">
                    
                  {!! FormHelper::textbox(
                     '3', 'lastname', 'text', 'Lastname *', 'Lastname', old('lastname'), $errors->has('lastname'), $errors->first('lastname'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'firstname', 'text', 'Firstname *', 'Firstname', old('firstname'), $errors->has('firstname'), $errors->first('firstname'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'middlename', 'text', 'Middlename *', 'Middlename', old('middlename'), $errors->has('middlename'), $errors->first('middlename'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'name_ext', 'text', 'Name Extension', 'Name Extension', old('name_ext'), $errors->has('name_ext'), $errors->first('name_ext'), 'data-transform="uppercase"'
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::datepicker(
                    '4', 'date_of_birth',  'Date of Birth *', old('date_of_birth'), $errors->has('date_of_birth'), $errors->first('date_of_birth')
                  ) !!}

                  {!! FormHelper::textbox(
                     '8', 'place_of_birth', 'text', 'Place of Birth *', 'Place of Birth', old('place_of_birth'), $errors->has('place_of_birth'), $errors->first('place_of_birth'), 'data-transform="uppercase"'
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::select_static(
                    '3', 'sex', 'Sex *', old('sex'), ['Male' => 'M', 'Female' => 'F'], $errors->has('sex'), $errors->first('sex'), '', ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'civilstat', 'Civil Status *', old('civilstat'), $civil_status, $errors->has('civilstat'), $errors->first('civilstat'), '', ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'height', 'text', 'Height *', 'Height', old('height'), $errors->has('height'), $errors->first('height'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'weight', 'text', 'Weight *', 'Weight', old('weight'), $errors->has('weight'), $errors->first('weight'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox(
                     '2', 'bloodtype', 'text', 'Blood Type *', 'Blood Type', old('bloodtype'), $errors->has('bloodtype'), $errors->first('bloodtype'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'tel_no', 'text', 'Telephone No.', 'Telephone No.', old('tel_no'), $errors->has('tel_no'), $errors->first('tel_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'cell_no', 'text', 'Cellphone No.', 'Cellphone No.', old('cell_no'), $errors->has('cell_no'), $errors->first('cell_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '4', 'email', 'text', 'Email Address', 'Email Address', old('email'), $errors->has('email'), $errors->first('email'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::select_static(
                    '3', 'citizenship', 'Citizenship *', old('citizenship'), ['Filipino' => 'FIL', 'Dual Citizenship' => 'DC'], $errors->has('citizenship'), $errors->first('citizenship'), '', ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'citizenship_type', 'Citizenship Type *', old('citizenship_type'), ['by birth' => 'BB', 'by naturalization' => 'BN'], $errors->has('citizenship_type'), $errors->first('citizenship_type'), '', ''
                  ) !!}
                  
                  {!! FormHelper::textbox(
                     '6', 'dual_citizenship_country', 'text', 'If (Dual Citizenship) Pls. Indicate Country', 'Specify', old('dual_citizenship_country'), $errors->has('dual_citizenship_country'), $errors->first('dual_citizenship_country'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox(
                     '2', 'agency_no', 'text', 'Agency Employee No.', 'Agency Employee No.', old('agency_no'), $errors->has('agency_no'), $errors->first('agency_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'gov_id', 'text', 'Any Issued Government ID', 'Any Issued Government ID', old('gov_id'), $errors->has('gov_id'), $errors->first('gov_id'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'license_passport_no', 'text', 'Drivers License / Passport No.', 'Drivers License / Passport No.', old('license_passport_no'), $errors->has('license_passport_no'), $errors->first('license_passport_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '4', 'id_date_issue', 'text', 'Date / Place of Issuance', 'Date / Place of Issuance', old('id_date_issue'), $errors->has('id_date_issue'), $errors->first('id_date_issue'), ''
                  ) !!}


                </div>
              </div>




              {{-- Address --}}
              <div class="tab-pane" id="a">
                <div class="row">


                  <div class="col-md-6">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Residential Address</h3>
                      </div>
                      <div class="box-body">

                        {!! FormHelper::textbox(
                           '6', 'res_address_block', 'text', 'Block', 'Block', old('res_address_block'), $errors->has('res_address_block'), $errors->first('res_address_block'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'res_address_street', 'text', 'Street', 'Street', old('res_address_street'), $errors->has('res_address_street'), $errors->first('res_address_street'), 'data-transform="uppercase"'
                        ) !!}

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '6', 'res_address_village', 'text', 'Village', 'Village', old('res_address_village'), $errors->has('res_address_village'), $errors->first('res_address_village'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'res_address_barangay', 'text', 'Barangay *', 'Barangay', old('res_address_barangay'), $errors->has('res_address_barangay'), $errors->first('res_address_barangay'), 'data-transform="uppercase"'
                        ) !!}

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '6', 'res_address_city', 'text', 'City *', 'City', old('res_address_city'), $errors->has('res_address_city'), $errors->first('res_address_city'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'res_address_province', 'text', 'Province *', 'Province', old('res_address_province'), $errors->has('res_address_province'), $errors->first('res_address_province'), 'data-transform="uppercase"'
                        ) !!}

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '6', 'res_address_zipcode', 'text', 'Zipcode *', 'Zipcode', old('res_address_zipcode'), $errors->has('res_address_zipcode'), $errors->first('res_address_zipcode'), 'data-transform="uppercase"'
                        ) !!}

                      </div>
                    </div>
                  </div>
                  


                  <div class="col-md-6">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Permanent Address</h3>
                        <div class="box-tools">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" id="fill_perm" value=""> the same as Residential Address
                              </label>
                            </div>
                        </div>

                      </div>
                      <div class="box-body">

                        {!! FormHelper::textbox(
                           '6', 'perm_address_block', 'text', 'Block', 'Block', old('perm_address_block'), $errors->has('perm_address_block'), $errors->first('perm_address_block'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'perm_address_street', 'text', 'Street', 'Street', old('perm_address_street'), $errors->has('perm_address_street'), $errors->first('perm_address_street'), 'data-transform="uppercase"'
                        ) !!}

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '6', 'perm_address_village', 'text', 'Village', 'Village', old('perm_address_village'), $errors->has('perm_address_village'), $errors->first('perm_address_village'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'perm_address_barangay', 'text', 'Barangay *', 'Barangay', old('perm_address_barangay'), $errors->has('perm_address_barangay'), $errors->first('perm_address_barangay'), 'data-transform="uppercase"'
                        ) !!}

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '6', 'perm_address_city', 'text', 'City *', 'City', old('perm_address_city'), $errors->has('perm_address_city'), $errors->first('perm_address_city'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'perm_address_province', 'text', 'Province *', 'Province', old('perm_address_province'), $errors->has('perm_address_province'), $errors->first('perm_address_province'), 'data-transform="uppercase"'
                        ) !!}

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '6', 'perm_address_zipcode', 'text', 'Zipcode *', 'Zipcode', old('perm_address_zipcode'), $errors->has('perm_address_zipcode'), $errors->first('perm_address_zipcode'), 'data-transform="uppercase"'
                        ) !!}

                      </div>
                    </div>
                  </div>


                </div>
              </div>




              {{-- Family Info --}}
              <div class="tab-pane" id="fi">
                <div class="row">

                  <div class="col-md-6">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Father's Info</h3>
                      </div>
                      <div class="box-body">

                        {!! FormHelper::textbox(
                           '6', 'father_lastname', 'text', 'Lastname *', 'Lastname', old('father_lastname'), $errors->has('father_lastname'), $errors->first('father_lastname'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'father_firstname', 'text', 'Firstname *', 'Firstname', old('father_firstname'), $errors->has('father_firstname'), $errors->first('father_firstname'), 'data-transform="uppercase"'
                        ) !!}

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '6', 'father_middlename', 'text', 'Middlename *', 'Middlename', old('father_middlename'), $errors->has('father_middlename'), $errors->first('father_middlename'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'father_name_ext', 'text', 'Name Extension *', 'Name Extension', old('father_name_ext'), $errors->has('father_name_ext'), $errors->first('father_name_ext'), 'data-transform="uppercase"'
                        ) !!}

                      </div>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Mother's Info</h3>
                      </div>
                      <div class="box-body">

                        {!! FormHelper::textbox(
                           '6', 'mother_lastname', 'text', 'Lastname *', 'Lastname', old('mother_lastname'), $errors->has('mother_lastname'), $errors->first('mother_lastname'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'mother_firstname', 'text', 'Firstname *', 'Firstname', old('mother_firstname'), $errors->has('mother_firstname'), $errors->first('mother_firstname'), 'data-transform="uppercase"'
                        ) !!} 

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '6', 'mother_middlename', 'text', 'Middlename *', 'Middlename', old('mother_middlename'), $errors->has('mother_middlename'), $errors->first('mother_middlename'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '6', 'mother_name_ext', 'text', 'Name Extension', 'Name Extension', old('mother_name_ext'), $errors->has('mother_name_ext'), $errors->first('mother_name_ext'), 'data-transform="uppercase"'
                        ) !!}

                      </div>
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Spouse's Info</h3>
                      </div>
                      <div class="box-body">

                        {!! FormHelper::textbox(
                           '3', 'spouse_lastname', 'text', 'Lastname *', 'Lastname', old('spouse_lastname'), $errors->has('spouse_lastname'), $errors->first('spouse_lastname'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '3', 'spouse_firstname', 'text', 'Firstname *', 'Firstname', old('spouse_firstname'), $errors->has('spouse_firstname'), $errors->first('spouse_firstname'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '3', 'spouse_middlename', 'text', 'Middlename *', 'Middlename', old('spouse_middlename'), $errors->has('spouse_middlename'), $errors->first('spouse_middlename'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '3', 'spouse_name_ext', 'text', 'Name Extension', 'Name Extension', old('spouse_name_ext'), $errors->has('spouse_name_ext'), $errors->first('spouse_name_ext'), 'data-transform="uppercase"'
                        ) !!}

                        <div class="col-md-12"></div>

                        {!! FormHelper::textbox(
                           '3', 'spouse_occupation', 'text', 'Occupation *', 'Occupation', old('spouse_occupation'), $errors->has('spouse_occupation'), $errors->first('spouse_occupation'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '3', 'spouse_employer', 'text', 'Employer / Business Name', 'Employer / Business Name', old('spouse_employer'), $errors->has('spouse_employer'), $errors->first('spouse_employer'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '3', 'spouse_business_address', 'text', 'Business Address', 'Business Address', old('spouse_business_address'), $errors->has('spouse_business_address'), $errors->first('spouse_business_address'), 'data-transform="uppercase"'
                        ) !!}

                        {!! FormHelper::textbox(
                           '3', 'spouse_tel_no', 'text', 'Telephone No. *', 'Telephone No.', old('spouse_tel_no'), $errors->has('spouse_tel_no'), $errors->first('spouse_tel_no'), 'data-transform="uppercase"'
                        ) !!}

                      </div>
                    </div>
                  </div>



                  <div class="col-md-12">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Children</h3>
                        <button id="children_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                      </div>
                      
                      <div class="box-body no-padding">

                        <table class="table table-bordered">

                          <tr>
                            <th>Fullname *</th>
                            <th>Date of Birth *</th>
                            <th style="width: 40px"></th>
                          </tr>

                          <tbody id="children_table_body">

                            @if(old('row_children'))

                              @foreach(old('row_children') as $key => $value)

                                <tr>

                                  <td>
                                    <div class="form-group">
                                      <input type="text" name="row_children[{{ $key }}][fullname]" class="form-control" placeholder="Fullname" value="{{ $value['fullname'] }}">
                                      <small class="text-danger">{{ $errors->first('row_children.'. $key .'.fullname') }}</small>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input name="row_children[{{ $key }}][date_of_birth]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($value['date_of_birth']) }}">
                                      </div>
                                      <small class="text-danger">{{ $errors->first('row_children.'. $key .'.date_of_birth') }}</small>
                                    </div>
                                  </td>

                                  <td>
                                      <button id="children_delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                                  </td>
 
                                </tr>

                              @endforeach

                            @else

                              <tr>

                                <td>
                                  <div class="form-group">
                                    <input type="text" name="row_children[0][fullname]" class="form-control" placeholder="Fullname">
                                  </div>
                                </td>

                                <td>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input name="row_children[0][date_of_birth]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                                    </div>
                                  </div>
                                </td>

                                <td>
                                    <button id="children_delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                                </td>

                              </tr>


                            @endif

                            </tbody>

                        </table>

                      </div>
                    </div>
                  </div>



                </div>
              </div>





              {{-- Personal ID's --}}
              <div class="tab-pane" id="id">
                <div class="row">

                  {!! FormHelper::textbox(
                     '3', 'gsis', 'text', 'GSIS', 'GSIS', old('gsis'), $errors->has('gsis'), $errors->first('gsis'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'philhealth', 'text', 'PHILHEALTH', 'PHILHEALTH', old('philhealth'), $errors->has('philhealth'), $errors->first('philhealth'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'tin', 'text', 'TIN', 'TIN', old('tin'), $errors->has('tin'), $errors->first('tin'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'sss', 'text', 'SSS', 'SSS', old('sss'), $errors->has('sss'), $errors->first('sss'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'hdmf', 'text', 'HDMF', 'HDMF', old('hdmf'), $errors->has('hdmf'), $errors->first('hdmf'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'hdmfpremiums', 'text', 'HDMF Premiums', 'HDMF Premiums', old('hdmfpremiums'), $errors->has('hdmfpremiums'), $errors->first('hdmfpremiums'), ''
                  ) !!}

                </div>
              </div>




              {{-- Appointment Details --}}
              <div class="tab-pane" id="ad">
                <div class="row">

                  {!! FormHelper::textbox(
                    '3', 'employee_no', 'text', 'Employee No. *', 'Employee No.', old('employee_no'), $errors->has('employee_no'), $errors->first('employee_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'position', 'text', 'Position *', 'Position', old('position'), $errors->has('position'), $errors->first('position'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'item_no', 'text', 'Item No.', 'Item No.', old('item_no'), $errors->has('item_no'), $errors->first('item_no'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'appointment_status', 'Appointment Status *', old('appointment_status'), ['Permanent' => 'PERM', 'Job Order / Contract of Service' => 'COS'], $errors->has('appointment_status'), $errors->first('appointment_status'), '', ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox(
                    '3', 'salary_grade', 'text', 'Salary Grade *', 'Salary Grade', old('salary_grade'), $errors->has('salary_grade'), $errors->first('salary_grade'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'step_inc', 'text', 'Step Increment', 'Step Increment', old('step_inc'), $errors->has('step_inc'), $errors->first('step_inc'), ''
                  ) !!}

                  {!! FormHelper::select_dynamic(
                    '3', 'department_id', 'Department *', old('department_id'), $global_departments_all, 'department_id', 'name', $errors->has('department_id'), $errors->first('department_id'), '', ''
                  ) !!}

                  {!! FormHelper::select_dynamic(
                    '3', 'department_unit_id', 'Unit *', old('department_unit_id'), $global_department_units_all, 'department_unit_id', 'description', $errors->has('department_unit_id'), $errors->first('department_unit_id'), '', ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox_numeric(
                    '3', 'monthlybasic', 'text', 'Monthly Basic *', 'Monthly Basic', old('monthlybasic'), $errors->has('monthlybasic'), $errors->first('monthlybasic'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'aca', 'text', 'ACA', 'ACA', old('aca'), $errors->has('aca'), $errors->first('aca'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'pera', 'text', 'PERA', 'PERA', old('pera'), $errors->has('pera'), $errors->first('pera'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'food_subsidy', 'text', 'Food Subsidy', 'Food Subsidy', old('food_subsidy'), $errors->has('food_subsidy'), $errors->first('food_subsidy'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox_numeric(
                    '3', 'ra', 'text', 'RA', 'RA', old('ra'), $errors->has('ra'), $errors->first('ra'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'ta', 'text', 'TA', 'TA', old('ta'), $errors->has('ta'), $errors->first('ta'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::datepicker(
                    '3', 'firstday_gov',  'First Day to serve Government *', old('firstday_gov'), $errors->has('firstday_gov'), $errors->first('firstday_gov')
                  ) !!}

                  {!! FormHelper::datepicker(
                    '3', 'firstday_sra',  'First Day in SRA *', old('firstday_sra'), $errors->has('firstday_sra'), $errors->first('firstday_sra')
                  ) !!}

                  {!! FormHelper::datepicker(
                    '3', 'appointment_date',  'Appointment Date', old('appointment_date'), $errors->has('appointment_date'), $errors->first('appointment_date')
                  ) !!}

                  {!! FormHelper::datepicker(
                    '3', 'adjustment_date',  'Adjustment Date', old('adjustment_date'), $errors->has('adjustment_date'), $errors->first('adjustment_date')
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::select_static(
                    '3', 'is_active', 'Status *', old('is_active'), ['ACTIVE' => 'true', 'INACTIVE' => 'false'], $errors->has('is_active'), $errors->first('is_active'), '', ''
                  ) !!}

                </div>
              </div>




              {{-- Educ Background --}}
              <div class="tab-pane" id="eb">
                <div class="row">
                    
                  <div class="box-header with-border">
                    <button id="eb_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">

                    <table class="table table-bordered">

                      <tr>
                        <th>Level *</th>
                        <th style="width:25em;">Name of School *</th>
                        <th>Course</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Units</th>
                        <th>Graduate Year</th>
                        <th>Scholarship</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="eb_table_body">

                        @if(old('row_eb'))

                          @foreach(old('row_eb') as $key => $value)

                            <tr>

                              <td>
                                <div class="form-group">
                                  <select name="row_eb[{{ $key }}][level]" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($level as $value => $name)
                                      <option value="{{ $value }}">{{ $name }}</option>
                                    @endforeach
                                  </select>
                                  <small class="text-danger">{{ $errors->first('row_eb.'. $key .'.level') }}</small>
                                </div>
                              </td>

                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row_eb[{{ $key }}][date_of_birth]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($value['date_of_birth']) }}">
                                  </div>
                                  <small class="text-danger">{{ $errors->first('row_eb.'. $key .'.date_of_birth') }}</small>
                                </div>
                              </td>

                              <td>
                                  <button id="eb_delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              <div class="form-group">
                                <select name="row_eb[0][level]" class="form-control">
                                  <option value="">Select</option>
                                  @foreach($level as $value => $name)
                                    <option value="{{ $value }}">{{ $name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row_eb[0][school_name]" class="form-control" placeholder="Name of School">
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row_eb[0][course]" class="form-control" placeholder="Course">
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input name="row_eb[0][date_from]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                                </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input name="row_eb[0][date_to]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                                </div>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row_eb[0][units]" class="form-control" placeholder="Course">
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row_eb[0][year]" class="form-control" placeholder="Course">
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row_eb[0][scholarship]" class="form-control" placeholder="Course">
                              </div>
                            </td>

                            <td>
                                <button id="eb_delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>

                          </tr>


                        @endif

                        </tbody>

                    </table>
                  </div>


                </div>
              </div>




              {{-- Trainings --}}
              <div class="tab-pane" id="t">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="training_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">
                    
                    <table class="table table-bordered">

                      <tr>
                        <th>Topics *</th>
                        <th>Conducted by *</th>
                        <th>Date From *</th>
                        <th>Date To *</th>
                        <th>Hours *</th>
                        <th>Venue *</th>
                        <th>Remarks</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="training_table_body">

                        @if(old('row_training'))

                          @foreach(old('row_training') as $key => $value)

                            <tr>

                              <td>
                                <div class="form-group">
                                  <input type="text" name="row_training[{{ $key }}][topics]" class="form-control" placeholder="Topics" value="{{ $value['topics'] }}">
                                  <small class="text-danger">{{ $errors->first('row_training.'. $key .'.topics') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row_training[{{ $key }}][conductedby]" class="form-control" placeholder="Conducted by" value="{{ $value['conductedby'] }}">
                                  <small class="text-danger">{{ $errors->first('row_training.'. $key .'.conductedby') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row_training[{{ $key }}][datefrom]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($value['datefrom']) }}">
                                  </div>
                                  <small class="text-danger">{{ $errors->first('row_training.'. $key .'.datefrom') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row_training[{{ $key }}][dateto]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($value['dateto']) }}">
                                  </div>
                                  <small class="text-danger">{{ $errors->first('row_training.'. $key .'.dateto') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row_training[{{ $key }}][hours]" class="form-control" placeholder="Hours" value="{{ $value['hours'] }}">
                                  <small class="text-danger">{{ $errors->first('row_training.'. $key .'.hours') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row_training[{{ $key }}][venue]" class="form-control" placeholder="Venue" value="{{ $value['venue'] }}">
                                  <small class="text-danger">{{ $errors->first('row_training.'. $key .'.venue') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row_training[{{ $key }}][remarks]" class="form-control" placeholder="Remarks" value="{{ $value['remarks'] }}">
                                  <small class="text-danger">{{ $errors->first('row_training.'. $key .'.remarks') }}</small>
                                </div>
                              </td>


                              <td>
                                  <button id="training_delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              <div class="form-group">
                                <input type="text" name="training_row[0][topics]" class="form-control" placeholder="Topics">
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="training_row[0][conductedby]" class="form-control" placeholder="Conducted by">
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input name="training_row[0][datefrom]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                                </div>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input name="training_row[0][dateto]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                                </div>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="training_row[0][hours]" class="form-control" placeholder="Hours">
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="training_row[0][venue]" class="form-control" placeholder="Venue">
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="training_row[0][remarks]" class="form-control" placeholder="Remarks">
                              </div>
                            </td>


                            <td>
                                <button id="training_delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>

                          </tr>


                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>




              {{-- Appointment Details --}}
              <div class="tab-pane" id="ad">
                <div class="row">

                  {!! FormHelper::textbox(
                    '3', 'employee_no', 'text', 'Employee No. *', 'Employee No.', old('employee_no'), $errors->has('employee_no'), $errors->first('employee_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'position', 'text', 'Position *', 'Position', old('position'), $errors->has('position'), $errors->first('position'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'item_no', 'text', 'Item No.', 'Item No.', old('item_no'), $errors->has('item_no'), $errors->first('item_no'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'appointment_status', 'Appointment Status *', old('appointment_status'), ['Permanent' => 'PERM', 'Job Order / Contract of Service' => 'COS'], $errors->has('appointment_status'), $errors->first('appointment_status'), '', ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox(
                    '3', 'salary_grade', 'text', 'Salary Grade *', 'Salary Grade', old('salary_grade'), $errors->has('salary_grade'), $errors->first('salary_grade'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'step_inc', 'text', 'Step Increment', 'Step Increment', old('step_inc'), $errors->has('step_inc'), $errors->first('step_inc'), ''
                  ) !!}

                  {!! FormHelper::select_dynamic(
                    '3', 'department_id', 'Department *', old('department_id'), $global_departments_all, 'department_id', 'name', $errors->has('department_id'), $errors->first('department_id'), '', ''
                  ) !!}

                  {!! FormHelper::select_dynamic(
                    '3', 'department_unit_id', 'Unit *', old('department_unit_id'), $global_department_units_all, 'department_unit_id', 'description', $errors->has('department_unit_id'), $errors->first('department_unit_id'), '', ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox_numeric(
                    '3', 'monthlybasic', 'text', 'Monthly Basic *', 'Monthly Basic', old('monthlybasic'), $errors->has('monthlybasic'), $errors->first('monthlybasic'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'aca', 'text', 'ACA', 'ACA', old('aca'), $errors->has('aca'), $errors->first('aca'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'pera', 'text', 'PERA', 'PERA', old('pera'), $errors->has('pera'), $errors->first('pera'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'food_subsidy', 'text', 'Food Subsidy', 'Food Subsidy', old('food_subsidy'), $errors->has('food_subsidy'), $errors->first('food_subsidy'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox_numeric(
                    '3', 'ra', 'text', 'RA', 'RA', old('ra'), $errors->has('ra'), $errors->first('ra'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'ta', 'text', 'TA', 'TA', old('ta'), $errors->has('ta'), $errors->first('ta'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::datepicker(
                    '3', 'firstday_gov',  'First Day to serve Government *', old('firstday_gov'), $errors->has('firstday_gov'), $errors->first('firstday_gov')
                  ) !!}

                  {!! FormHelper::datepicker(
                    '3', 'firstday_sra',  'First Day in SRA *', old('firstday_sra'), $errors->has('firstday_sra'), $errors->first('firstday_sra')
                  ) !!}

                  {!! FormHelper::datepicker(
                    '3', 'appointment_date',  'Appointment Date', old('appointment_date'), $errors->has('appointment_date'), $errors->first('appointment_date')
                  ) !!}

                  {!! FormHelper::datepicker(
                    '3', 'adjustment_date',  'Adjustment Date', old('adjustment_date'), $errors->has('adjustment_date'), $errors->first('adjustment_date')
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::select_static(
                    '3', 'is_active', 'Status *', old('is_active'), ['ACTIVE' => 'true', 'INACTIVE' => 'false'], $errors->has('is_active'), $errors->first('is_active'), '', ''
                  ) !!}

                </div>
              </div>




              {{-- Personal ID's --}}
              <div class="tab-pane" id="id">
                <div class="row">

                  {!! FormHelper::textbox(
                     '3', 'gsis', 'text', 'GSIS', 'GSIS', old('gsis'), $errors->has('gsis'), $errors->first('gsis'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'philhealth', 'text', 'PHILHEALTH', 'PHILHEALTH', old('philhealth'), $errors->has('philhealth'), $errors->first('philhealth'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'tin', 'text', 'TIN', 'TIN', old('tin'), $errors->has('tin'), $errors->first('tin'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'sss', 'text', 'SSS', 'SSS', old('sss'), $errors->has('sss'), $errors->first('sss'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'hdmf', 'text', 'HDMF', 'HDMF', old('hdmf'), $errors->has('hdmf'), $errors->first('hdmf'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'hdmfpremiums', 'text', 'HDMF Premiums', 'HDMF Premiums', old('hdmfpremiums'), $errors->has('hdmfpremiums'), $errors->first('hdmfpremiums'), ''
                  ) !!}

                </div>
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

  @if(Session::has('EMPLOYEE_CREATE_SUCCESS'))
    {!! HtmlHelper::modal('employee', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('EMPLOYEE_CREATE_SUCCESS')) !!}
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('EMPLOYEE_CREATE_SUCCESS'))
      $('#employee').modal('show');
    @endif


    {!! JSHelper::ajax_select_to_select(
      'department_id', 'department_unit_id', '/api/select_response_department_units_from_department/', 'department_unit_id', 'description'
    ) !!}




    {{-- Children ADD ROW --}}
    $(document).ready(function() {

      $("#children_add_row").on("click", function() {
      var i = $("#children_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="children_row[' + i + '][fullname]" class="form-control" placeholder="Topics">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="children_row[' + i + '][date_of_birth]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                          '<button id="children_delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#children_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });
      
      $(this).removeClass('datepicker');

      });

    });


    {{-- DELETE Children ROW --}}
    $(document).on("click","#children_delete_row" ,function(e) {
        $(this).closest('tr').remove();
    });





    {{-- Training ADD ROW --}}
    $(document).ready(function() {

      $("#training_add_row").on("click", function() {
      var i = $("#training_table_body").children().length;
      var content ='<tr>' +
                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="training_row[' + i + '][topics]" class="form-control" placeholder="Topics">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="training_row[' + i + '][conductedby]" class="form-control" placeholder="Conducted by">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="training_row[' + i + '][datefrom]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="training_row[' + i + '][dateto]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="training_row[' + i + '][hours]" class="form-control" placeholder="Hours">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="training_row[' + i + '][venue]" class="form-control" placeholder="Venue">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="training_row[' + i + '][remarks]" class="form-control" placeholder="Remarks">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                          '<button id="training_delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#training_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });
      
      $(this).removeClass('datepicker');

      });

    });


    {{-- DELETE Training ROW --}}
    $(document).on("click","#training_delete_row" ,function(e) {
        $(this).closest('tr').remove();
    });





    {{-- Residential Fill Permanent address --}}
    $(document).on("change","#fill_perm" ,function(e) {

      if(this.checked) {
        
        $('#perm_address_block').val($('#res_address_block').val());
        $('#perm_address_street').val($('#res_address_street').val());
        $('#perm_address_village').val($('#res_address_village').val());
        $('#perm_address_barangay').val($('#res_address_barangay').val());
        $('#perm_address_city').val($('#res_address_city').val());
        $('#perm_address_province').val($('#res_address_province').val());
        $('#perm_address_zipcode').val($('#res_address_zipcode').val());

      }else{
        
        $('#perm_address_block').val('');
        $('#perm_address_street').val('');
        $('#perm_address_village').val('');
        $('#perm_address_barangay').val('');
        $('#perm_address_city').val('');
        $('#perm_address_province').val('');
        $('#perm_address_zipcode').val('');

      }

    });



  </script> 
    
@endsection