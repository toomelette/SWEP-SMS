@php
    $civil_status = [
      'SINGLE' => 'SINGLE', 'MARRIED' => 'MARRIED', 'WIDOWED' => 'WIDOWED', 'SEPERATED' => 'SEPERATED', 'OTHERS' => 'OTHERS', 
    ];

    $level = [
      'ELEMENTARY' => 'ELEMENTARY', 'SECONDARY' => 'SECONDARY', 'VOCATIONAL/TRADE COURSE' => 'VOCATIONAL/TRADE COURSE', 'COLLEGE' => 'COLLEGE', 'GRADUATE STUDIES' => 'GRADUATE STUDIES',
    ];

    $is_gov_service = [
      'YES' => 'true', 'No' => 'false',
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
              <li><a href="#fi" data-toggle="tab">Family Information</a></li>
              <li><a href="#id" data-toggle="tab">Personal ID's</a></li>
              <li><a href="#ad" data-toggle="tab">Appointment Details</a></li>
              <li><a href="#eb" data-toggle="tab">Educational background</a></li>
              <li><a href="#e" data-toggle="tab">Eligibilities</a></li>
              <li><a href="#we" data-toggle="tab">Work Experiences</a></li>
              <li><a href="#vw" data-toggle="tab">Voluntary Works</a></li>
              <li><a href="#r" data-toggle="tab">Recognitions</a></li>
              <li><a href="#org" data-toggle="tab">Organizations</a></li>
              <li><a href="#ss" data-toggle="tab">Special Skills</a></li>
              <li><a href="#ref" data-toggle="tab">Reference</a></li>
              <li><a href="#oq" data-toggle="tab">Other Questions</a></li>
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
                    '3', 'date_of_birth',  'Date of Birth *', old('date_of_birth'), $errors->has('date_of_birth'), $errors->first('date_of_birth')
                  ) !!}

                  {!! FormHelper::textbox(
                    '6', 'place_of_birth', 'text', 'Place of Birth *', 'Place of Birth', old('place_of_birth'), $errors->has('place_of_birth'), $errors->first('place_of_birth'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'sex', 'Sex *', old('sex'), ['Male' => 'MALE', 'Female' => 'FEMALE'], $errors->has('sex'), $errors->first('sex'), '', ''
                  ) !!}

                  <div class="col-md-12"></div>
                  

                  {!! FormHelper::select_static(
                    '3', 'civil_status', 'Civil Status *', old('civil_status'), $civil_status, $errors->has('civil_status'), $errors->first('civil_status'), '', ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'height', 'text', 'Height', 'Height', old('height'), $errors->has('height'), $errors->first('height'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'weight', 'text', 'Weight', 'Weight', old('weight'), $errors->has('weight'), $errors->first('weight'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'blood_type', 'text', 'Blood Type *', 'Blood Type', old('blood_type'), $errors->has('blood_type'), $errors->first('blood_type'), 'data-transform="uppercase"'
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox(
                     '3', 'tel_no', 'text', 'Telephone No.', 'Telephone No.', old('tel_no'), $errors->has('tel_no'), $errors->first('tel_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'cell_no', 'text', 'Cellphone No. *', 'Cellphone No.', old('cell_no'), $errors->has('cell_no'), $errors->first('cell_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'email', 'text', 'Email Address', 'Email Address', old('email'), $errors->has('email'), $errors->first('email'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'citizenship', 'Citizenship *', old('citizenship'), ['Filipino' => 'Filipino', 'Dual Citizenship' => 'Dual Citizenship'], $errors->has('citizenship'), $errors->first('citizenship'), '', ''
                  ) !!}

                  <div class="col-md-12"></div>
                
                  {!! FormHelper::select_static(
                    '3', 'citizenship_type', 'Citizenship Type *', old('citizenship_type'), ['by birth' => 'BB', 'by naturalization' => 'BN'], $errors->has('citizenship_type'), $errors->first('citizenship_type'), '', ''
                  ) !!}
                  
                  {!! FormHelper::textbox(
                     '3', 'dual_citizenship_country', 'text', 'If (Dual Citizenship) Pls. Indicate Country', 'Specify', old('dual_citizenship_country'), $errors->has('dual_citizenship_country'), $errors->first('dual_citizenship_country'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'agency_no', 'text', 'Agency Employee No.', 'Agency Employee No.', old('agency_no'), $errors->has('agency_no'), $errors->first('agency_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'gov_id', 'text', 'Government Issued ID', '(i.e. Passport, GSIS, SSS, PRC, etc.)', old('gov_id'), $errors->has('gov_id'), $errors->first('gov_id'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox(
                     '3', 'license_passport_no', 'text', 'ID / License / Passport No.:', 'PLEASE INDICATE ID Number', old('license_passport_no'), $errors->has('license_passport_no'), $errors->first('license_passport_no'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'id_date_issue', 'text', 'Date / Place of Issuance', 'Date / Place of Issuance', old('id_date_issue'), $errors->has('id_date_issue'), $errors->first('id_date_issue'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  <div class="col-md-6" style="padding-top: 30px;">
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
                  

                  <div class="col-md-6" style="padding-top: 30px;">
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
                           '6', 'father_name_ext', 'text', 'Name Extension', 'Name Extension', old('father_name_ext'), $errors->has('father_name_ext'), $errors->first('father_name_ext'), 'data-transform="uppercase"'
                        ) !!}

                      </div>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Mother's Info (Maiden Name)</h3>
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
                           '3', 'spouse_tel_no', 'text', 'Telephone No.', 'Telephone No.', old('spouse_tel_no'), $errors->has('spouse_tel_no'), $errors->first('spouse_tel_no'), 'data-transform="uppercase"'
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
                                    {!! FormHelper::textbox_for_dt(
                                      'row_children['. $key .'][fullname]', 'Fullname', $value['fullname'], $errors->first('row_children.'. $key .'.fullname')
                                    ) !!}
                                  </td>

                                  <td> 
                                    {!! FormHelper::datepicker_for_dt(
                                      'row_children['. $key .'][date_of_birth]', $value['date_of_birth'], $errors->first('row_children.'. $key .'.date_of_birth')
                                    ) !!}
                                  </td>

                                  <td>
                                      <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                                  </td>
 
                                </tr>

                              @endforeach

                            @else

                              <tr>

                                <td>
                                  {!! FormHelper::textbox_for_dt('row_children[0][fullname]', 'Fullname', '', '') !!}
                                </td>

                                <td> 
                                  {!! FormHelper::datepicker_for_dt('row_children[0][date_of_birth]', '', '') !!}
                                </td>

                                <td>
                                    <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
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
                    '3', 'salary_grade', 'text', 'Salary Grade', 'Salary Grade', old('salary_grade'), $errors->has('salary_grade'), $errors->first('salary_grade'), ''
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
                    '3', 'monthly_basic', 'text', 'Monthly Basic *', 'Monthly Basic', old('monthly_basic'), $errors->has('monthly_basic'), $errors->first('monthly_basic'), ''
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

                  {!! FormHelper::datepicker(
                    '3', 'firstday_gov',  'First Day to serve Government *', old('firstday_gov'), $errors->has('firstday_gov'), $errors->first('firstday_gov')
                  ) !!}

                  {!! FormHelper::datepicker(
                    '3', 'firstday_sra',  'First Day in SRA *', old('firstday_sra'), $errors->has('firstday_sra'), $errors->first('firstday_sra')
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::datepicker(
                    '3', 'appointment_date',  'Appointment Date', old('appointment_date'), $errors->has('appointment_date'), $errors->first('appointment_date')
                  ) !!}

                  {!! FormHelper::datepicker(
                    '3', 'adjustment_date',  'Adjustment Date', old('adjustment_date'), $errors->has('adjustment_date'), $errors->first('adjustment_date')
                  ) !!}

                  {!! FormHelper::select_dynamic(
                    '3', 'project_id', 'Station *', old('project_id'), $global_projects_all, 'project_id', 'project_address', $errors->has('project_id'), $errors->first('project_id'), '', ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'is_active', 'Status *', old('is_active'), ['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'ACTIVE'], $errors->has('is_active'), $errors->first('is_active'), '', ''
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
                        <th style="width:20em;">Name of School *</th>
                        <th style="width:15em;">Course</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Units</th>
                        <th>Graduate Year *</th>
                        <th style="width:15em;">Scholarship</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="eb_table_body">

                        @if(old('row_eb'))

                          @foreach(old('row_eb') as $key => $value)

                            <tr>

                              <td>
                                {!! FormHelper::select_static_for_dt(
                                  'row_eb['. $key .'][level]', $level, $value['level'], $errors->first('row_eb.'. $key .'.level')
                                ) !!}
                              </td>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eb['. $key .'][school_name]', 'Name of School', $value['school_name'], $errors->first('row_eb.'. $key .'.school_name')
                                ) !!}
                              </td>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eb['. $key .'][course]', 'Course', $value['course'], $errors->first('row_eb.'. $key .'.course')
                                ) !!}
                              </td>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eb['. $key .'][date_from]', 'Date From', $value['date_from'], $errors->first('row_eb.'. $key .'.date_from')
                                ) !!}
                              </td>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eb['. $key .'][date_to]', 'Date To', $value['date_to'], $errors->first('row_eb.'. $key .'.date_to')
                                ) !!}
                              </td>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eb['. $key .'][units]', 'Units', $value['units'], $errors->first('row_eb.'. $key .'.units')
                                ) !!}
                              </td>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eb['. $key .'][graduate_year]', 'Year', $value['graduate_year'], $errors->first('row_eb.'. $key .'.graduate_year')
                                ) !!}
                              </td>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eb['. $key .'][scholarship]', 'Scholarship', $value['scholarship'], $errors->first('row_eb.'. $key .'.scholarship')
                                ) !!}
                              </td>

                              <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              {!! FormHelper::select_static_for_dt('row_eb[0][level]', $level, 'ELEMENTARY', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[0][school_name]', 'Name of School', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[0][course]', 'Course', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[0][date_from]', 'Date From', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[0][date_to]', 'Date To', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[0][units]', 'Units', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[0][graduate_year]', 'Year', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[0][scholarship]', 'Scholarship', '', '') !!}
                            </td>

                          </tr>


                          <tr>

                            <td>
                              {!! FormHelper::select_static_for_dt('row_eb[1][level]', $level, 'SECONDARY', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[1][school_name]', 'Name of School', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[1][course]', 'Course', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[1][date_from]', 'Date From', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[1][date_to]', 'Date To', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[1][units]', 'Units', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[1][graduate_year]', 'Year', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[1][scholarship]', 'Scholarship', '', '') !!}
                            </td>

                          </tr>


                          <tr>

                            <td>
                              {!! FormHelper::select_static_for_dt('row_eb[2][level]', $level, 'VOCATIONAL/TRADE COURSE', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[2][school_name]', 'Name of School', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[2][course]', 'Course', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[2][date_from]', 'Date From', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[2][date_to]', 'Date To', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[2][units]', 'Units', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[2][graduate_year]', 'Year', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[2][scholarship]', 'Scholarship', '', '') !!}
                            </td>

                          </tr>


                          <tr>

                            <td>
                              {!! FormHelper::select_static_for_dt('row_eb[3][level]', $level, 'COLLEGE', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[3][school_name]', 'Name of School', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[3][course]', 'Course', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[3][date_from]', 'Date From', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[3][date_to]', 'Date To', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[3][units]', 'Units', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[3][graduate_year]', 'Year', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[3][scholarship]', 'Scholarship', '', '') !!}
                            </td>

                          </tr>


                          <tr>

                            <td>
                              {!! FormHelper::select_static_for_dt('row_eb[4][level]', $level, 'GRADUATE STUDIES', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[4][school_name]', 'Name of School', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[4][course]', 'Course', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[4][date_from]', 'Date From', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[4][date_to]', 'Date To', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[4][units]', 'Units', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[4][graduate_year]', 'Year', '', '') !!}
                            </td>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eb[4][scholarship]', 'Scholarship', '', '') !!}
                            </td>

                          </tr>

                        @endif

                        </tbody>

                    </table>
                  </div>


                </div>
              </div>






              {{-- Eligibilities --}}
              <div class="tab-pane" id="e">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="eligibility_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">
                    
                    <table class="table table-bordered">

                      <tr>
                        <th>Eligibility *</th>
                        <th>Level *</th>
                        <th>Rating</th>
                        <th>Place of Examination *</th>
                        <th>Date of Examination *</th>
                        <th>License No.</th>
                        <th>License Validity</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="eligibility_table_body">

                        @if(old('row_eligibility'))

                          @foreach(old('row_eligibility') as $key => $value)

                            <tr>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eligibility['. $key .'][eligibility]', 'Eligibility', $value['eligibility'], $errors->first('row_eligibility.'. $key .'.eligibility')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eligibility['. $key .'][level]', 'Level', $value['level'], $errors->first('row_eligibility.'. $key .'.level')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eligibility['. $key .'][rating]', 'Rating', $value['rating'], $errors->first('row_eligibility.'. $key .'.rating')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eligibility['. $key .'][exam_place]', 'Place of Examination', $value['exam_place'], $errors->first('row_eligibility.'. $key .'.exam_place')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::datepicker_for_dt(
                                  'row_eligibility['. $key .'][exam_date]', $value['exam_date'], $errors->first('row_eligibility.'. $key .'.exam_date')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_eligibility['. $key .'][license_no]', 'License No.', $value['license_no'], $errors->first('row_eligibility.'. $key .'.license_no')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::datepicker_for_dt(
                                  'row_eligibility['. $key .'][license_validity]', $value['license_validity'], $errors->first('row_eligibility.'. $key .'.license_validity')
                                ) !!}
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_eligibility[0][eligibility]', 'Eligibility', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_eligibility[0][level]', 'Level', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_eligibility[0][rating]', 'Rating', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_eligibility[0][exam_place]', 'Place of Examination', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::datepicker_for_dt('row_eligibility[0][exam_date]', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_eligibility[0][license_no]', 'License No.', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::datepicker_for_dt('row_eligibility[0][license_validity]', '', '') !!}
                            </td>


                            <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>

                          </tr>


                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>




              {{-- Work Experiences --}}
              <div class="tab-pane" id="we">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="we_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">
                    
                    <table class="table table-bordered">

                      <tr>
                        <th>Date From *</th>
                        <th>Date to *</th>
                        <th style="width:20em;">Company *</th>
                        <th>Position *</th>
                        <th>Salary *</th>
                        <th>Salary Grade</th>
                        <th>Appointment Status *</th>
                        <th>Gov Service (Y/N) *</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="we_table_body">

                        @if(old('row_we'))

                          @foreach(old('row_we') as $key => $value)

                            <tr>

                              <td>
                                {!! FormHelper::datepicker_for_dt(
                                  'row_we['. $key .'][date_from]', $value['date_from'], $errors->first('row_we.'. $key .'.date_from')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::datepicker_for_dt(
                                  'row_we['. $key .'][date_to]', $value['date_to'], $errors->first('row_we.'. $key .'.date_to')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_we['. $key .'][company]', 'Company', $value['company'], $errors->first('row_we.'. $key .'.company')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_we['. $key .'][position]', 'Position', $value['position'], $errors->first('row_we.'. $key .'.position')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_numeric_for_dt(
                                  'row_we['. $key .'][salary]', 'Salary', $value['salary'], $errors->first('row_we.'. $key .'.salary')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_we['. $key .'][salary_grade]', 'Salary Grade', $value['salary_grade'], $errors->first('row_we.'. $key .'.salary_grade')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_we['. $key .'][appointment_status]', 'Appointment Status', $value['appointment_status'], $errors->first('row_we.'. $key .'.appointment_status')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::select_static_for_dt(
                                  'row_we['. $key .'][is_gov_service]', $is_gov_service, $value['is_gov_service'], $errors->first('row_we.'. $key .'.is_gov_service')
                                ) !!}
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              {!! FormHelper::datepicker_for_dt('row_we[0][date_from]', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::datepicker_for_dt('row_we[0][date_to]', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_we[0][company]', 'Company', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_we[0][position]', 'Position', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_numeric_for_dt('row_we[0][salary]', 'Salary', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_we[0][salary_grade]', 'Salary Grade', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_we[0][appointment_status]', 'Appointment Status', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::select_static_for_dt('row_we[0][is_gov_service]', $is_gov_service, '', '') !!}
                            </td>


                            <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>

                          </tr>


                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>




              {{-- Voluntary Works --}}
              <div class="tab-pane" id="vw">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="vw_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">
                    
                    <table class="table table-bordered">

                      <tr>
                        <th>Name of Organization *</th>
                        <th>Address</th>
                        <th>Date from *</th>
                        <th>Date to *</th>
                        <th>Hours</th>
                        <th>Position</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="vw_table_body">

                        @if(old('row_vw'))

                          @foreach(old('row_vw') as $key => $value)

                            <tr>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_vw['. $key .'][name]', 'Name of Organization', $value['name'], $errors->first('row_vw.'. $key .'.name')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_vw['. $key .'][address]', 'Address of Organization', $value['address'], $errors->first('row_vw.'. $key .'.address')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::datepicker_for_dt(
                                  'row_vw['. $key .'][date_from]', $value['date_from'], $errors->first('row_vw.'. $key .'.date_from')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::datepicker_for_dt(
                                  'row_vw['. $key .'][date_to]', $value['date_to'], $errors->first('row_vw.'. $key .'.date_to')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_vw['. $key .'][hours]', 'Hours', $value['hours'], $errors->first('row_vw.'. $key .'.hours')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_vw['. $key .'][position]', 'Position', $value['position'], $errors->first('row_vw.'. $key .'.position')
                                ) !!}
                              </td>


                              <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_vw[0][name]', 'Name of Organization', '','') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_vw[0][address]', 'Address of Organization', '','') !!}
                            </td>


                            <td>
                              {!! FormHelper::datepicker_for_dt('row_vw[0][date_from]', '','') !!}
                            </td>


                            <td>
                              {!! FormHelper::datepicker_for_dt('row_vw[0][date_to]', '','') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_vw[0][hours]', 'Hours', '','') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_vw[0][position]', 'Position', '','') !!}
                            </td>


                            <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>

                          </tr>


                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>






              {{-- Recognitions --}}
              <div class="tab-pane" id="r">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="recognition_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">
                    
                    <table class="table table-bordered">

                      <tr>
                        <th>Title *</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="recognition_table_body">

                        @if(old('row_recognition'))

                          @foreach(old('row_recognition') as $key => $value)

                            <tr>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_recognition['. $key .'][title]', 'Title', $value['title'], $errors->first('row_recognition.'. $key .'.title')
                                ) !!}
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>


                            </tr>

                          @endforeach

                        @else

                          <tr>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_recognition[0][title]', 'Title', '', '') !!}
                            </td>


                            <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>


                          </tr>


                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>





              {{-- Organizations --}}
              <div class="tab-pane" id="org">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="org_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">
                    
                    <table class="table table-bordered">

                      <tr>
                        <th>Name of Organization *</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="org_table_body">

                        @if(old('row_org'))

                          @foreach(old('row_org') as $key => $value)

                            <tr>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_org['. $key .'][name]', 'Name of Organization', $value['name'], $errors->first('row_org.'. $key .'.name')
                                ) !!}
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_org[0][name]', 'Name of Organization', '', '') !!}
                            </td>


                            <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>


                          </tr>


                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>





              {{-- Special Skills --}}
              <div class="tab-pane" id="ss">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="ss_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">
                    
                    <table class="table table-bordered">

                      <tr>
                        <th>Special Skills or Hobies *</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="ss_table_body">

                        @if(old('row_ss'))

                          @foreach(old('row_ss') as $key => $value)

                            <tr>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_ss['. $key .'][description]', 'Special Skills or Hobies', $value['description'], $errors->first('row_ss.'. $key .'.description')
                                ) !!}
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_ss[0][description]', 'Special Skills or Hobies', '', '') !!}
                            </td>


                            <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>

                          </tr>


                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>





              {{-- References --}}
              <div class="tab-pane" id="ref">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="reference_add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
                  </div>
                  
                  <div class="box-body no-padding">
                    
                    <table class="table table-bordered">

                      <tr>
                        <th>Fullname *</th>
                        <th>Address *</th>
                        <th>Tel No. *</th>
                        <th style="width: 40px"></th>
                      </tr>

                      <tbody id="reference_table_body">

                        @if(old('row_reference'))

                          @foreach(old('row_reference') as $key => $value)

                            <tr>

                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_reference['. $key .'][fullname]', 'Fullname', $value['fullname'], $errors->first('row_reference.'. $key .'.fullname')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_reference['. $key .'][address]', 'Address', $value['address'], $errors->first('row_reference.'. $key .'.address')
                                ) !!}
                              </td>


                              <td>
                                {!! FormHelper::textbox_for_dt(
                                  'row_reference['. $key .'][tel_no]', 'Telephone No.', $value['tel_no'], $errors->first('row_reference.'. $key .'.tel_no')
                                ) !!}
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              {!! FormHelper::textbox_for_dt('row_reference[0][fullname]', 'Fullname', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_reference[0][address]', 'Address', '', '') !!}
                            </td>


                            <td>
                              {!! FormHelper::textbox_for_dt('row_reference[0][tel_no]', 'Telephone No.', '', '') !!}
                            </td>


                            <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                            </td>

                          </tr>


                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>




              {{-- Questions --}}
              <div class="tab-pane" id="oq">
                <div class="row">
                  
                  <div class="col-md-12" style="padding-bottom: 10px;">
                    <h3>Please answer the following questions:</h3>
                  </div>
                  

                  <div class="col-md-12">
                      
                    <div class="col-md-12">
                      <p class="text-muted well well-sm no-shadow">
                        Are you related by consanguinity or affinity to the appointing or recommending authority, or to the
                        chief of bureau or office or to the person who has immediate supervision over you in the Office, 
                        Bureau or Department where you will be apppointed,
                      </p>
                    </div>

                    <div class="col-md-12">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. within the third degree?</p>
                      {!! FormHelper::select_static(
                      '3', 'q_34_a', '', old('q_34_a'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_34_a'), $errors->first('q_34_a'), '', ''
                      ) !!}

                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. within the fourth degree (for Local Government Unit - Career Employees)?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_34_b', '', old('q_34_b'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_34_b'), $errors->first('q_34_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details: </p>
                      {!! FormHelper::textbox(
                       '12', 'q_34_b_yes_details', 'text', '', '', old('q_34_b_yes_details'), $errors->has('q_34_b_yes_details'), $errors->first('q_34_b_yes_details'), ''
                    ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been found guilty of any administrative offense?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_35_a', '', old('q_35_a'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_35_a'), $errors->first('q_35_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details: </p>
                      {!! FormHelper::textbox(
                       '12', 'q_35_a_yes_details', 'text', '', '', old('q_35_a_yes_details'), $errors->has('q_35_a_yes_details'), $errors->first('q_35_a_yes_details'), ''
                    ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Have you been criminally charged before any court?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_35_b', '', old('q_35_b'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_35_b'), $errors->first('q_35_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-3">
                      <p style="margin-bottom:-10px;">If YES, give details (Date Filled):</p>
                      {!! FormHelper::textbox(
                       '12', 'q_35_b_yes_details_1', 'text', '', '', old('q_35_b_yes_details_1'), $errors->has('q_35_b_yes_details_1'), $errors->first('q_35_b_yes_details_1'), ''
                      ) !!}
                    </div>

                    <div class="col-md-3">
                      <p style="margin-bottom:-10px;">(Status of Case/s):</p>
                      {!! FormHelper::textbox(
                       '12', 'q_35_b_yes_details_2', 'text', '', '', old('q_35_b_yes_details_2'), $errors->has('q_35_b_yes_details_2'), $errors->first('q_35_b_yes_details_2'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_36', '', old('q_36'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_36'), $errors->first('q_36'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! FormHelper::textbox(
                       '12', 'q_36_yes_details', 'text', '', '', old('q_36_yes_details'), $errors->has('q_36_yes_details'), $errors->first('q_36_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_37', '', old('q_37'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_37'), $errors->first('q_37'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! FormHelper::textbox(
                       '12', 'q_37_yes_details', 'text', '', '', old('q_37_yes_details'), $errors->has('q_37_yes_details'), $errors->first('q_37_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_38_a', '', old('q_38_a'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_38_a'), $errors->first('q_38_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! FormHelper::textbox(
                       '12', 'q_38_a_yes_details', 'text', '', '', old('q_38_a_yes_details'), $errors->has('q_38_a_yes_details'), $errors->first('q_38_a_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_38_b', '', old('q_38_b'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_38_b'), $errors->first('q_38_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! FormHelper::textbox(
                       '12', 'q_38_b_yes_details', 'text', '', '', old('q_38_b_yes_details'), $errors->has('q_38_b_yes_details'), $errors->first('q_38_b_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you acquired the status of an immigrant or permanent resident of another country?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_39', '', old('q_39'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_39'), $errors->first('q_39'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (Country):</p>
                      {!! FormHelper::textbox(
                       '12', 'q_39_yes_details', 'text', '', '', old('q_39_yes_details'), $errors->has('q_39_yes_details'), $errors->first('q_39_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-12">
                      <p class="text-muted well well-sm no-shadow">
                        Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
                      </p>
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Are you a member of any indigenous group?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_40_a', '', old('q_40_a'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_a'), $errors->first('q_40_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! FormHelper::textbox(
                       '12', 'q_40_a_yes_details', 'text', '', '', old('q_40_a_yes_details'), $errors->has('q_40_a_yes_details'), $errors->first('q_40_a_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Are you a person with disability?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_40_b', '', old('q_40_b'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_b'), $errors->first('q_40_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (ID No.):</p>
                      {!! FormHelper::textbox(
                       '12', 'q_40_b_yes_details', 'text', '', '', old('q_40_b_yes_details'), $errors->has('q_40_b_yes_details'), $errors->first('q_40_b_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>
                    
                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">c. Are you a solo parent?</p>
                      {!! FormHelper::select_static(
                        '6', 'q_40_c', '', old('q_40_c'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_c'), $errors->first('q_40_c'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (ID No.):</p>
                      {!! FormHelper::textbox(
                       '12', 'q_40_c_yes_details', 'text', '', '', old('q_40_c_yes_details'), $errors->has('q_40_c_yes_details'), $errors->first('q_40_c_yes_details'), ''
                      ) !!}
                    </div>

                  </div>
                  

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
                          '<input type="text" name="row_children[' + i + '][fullname]" class="form-control" placeholder="Fullname">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_children[' + i + '][date_of_birth]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
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







    {{-- EB ADD ROW --}}
    $(document).ready(function() {

      $("#eb_add_row").on("click", function() {
      var i = $("#eb_table_body").children().length;
      var content ='<tr>' +
                    '<td>' +
                      '<div class="form-group">' +
                        '<select name="row_eb[' + i + '][level]" class="form-control">' +
                          '<option value="">Select</option>' +
                          '@foreach($level as $name => $value)' +
                            '<option value="{{ $value }}">{{ $name }}</option>' +
                          '@endforeach' +
                        '</select>' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][school_name]" class="form-control" placeholder="Name of School">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][course]" class="form-control" placeholder="Course">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][date_from]" class="form-control" placeholder="Date From">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][date_to]" class="form-control" placeholder="Date To">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][units]" class="form-control" placeholder="Units">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][graduate_year]" class="form-control" placeholder="Year">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][scholarship]" class="form-control" placeholder="Scholarship">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                    '</td>' +

                  '</tr>';

      $("#eb_table_body").append($(content));

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







    {{-- Training ADD ROW --}}
    $(document).ready(function() {

      $("#training_add_row").on("click", function() {
      var i = $("#training_table_body").children().length;
      var content ='<tr>' +
                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][title]" class="form-control" placeholder="Title">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][type]" class="form-control" placeholder="Type of L & D">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][conducted_by]" class="form-control" placeholder="Conducted by">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_training[' + i + '][date_from]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_training[' + i + '][date_to]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][hours]" class="form-control" placeholder="Hours">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][venue]" class="form-control" placeholder="Venue">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][remarks]" class="form-control" placeholder="Remarks">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
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







    {{-- Eligibility ADD ROW --}}
    $(document).ready(function() {

      $("#eligibility_add_row").on("click", function() {
      var i = $("#eligibility_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                         ' <input type="text" name="row_eligibility[' + i + '][eligibility]" class="form-control" placeholder="Eligibility">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_eligibility[' + i + '][level]" class="form-control" placeholder="Level">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_eligibility[' + i + '][rating]" class="form-control" placeholder="Rating">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_eligibility[' + i + '][exam_place]" class="form-control" placeholder="Place of Examination">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_eligibility[' + i + '][exam_date]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_eligibility[' + i + '][license_no]" class="form-control" placeholder="License No">' +
                        '</div>' +
                      '</td>' +


                       '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_eligibility[' + i + '][license_validity]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#eligibility_table_body").append($(content));

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

 





    {{-- Experience ADD ROW --}}
    $(document).ready(function() {

      $("#we_add_row").on("click", function() {
      var i = $("#we_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_we[' + i + '][date_from]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_we[' + i + '][date_to]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][company]" class="form-control" placeholder="Company">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][position]" class="form-control" placeholder="Position">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][salary]" class="form-control priceformat" placeholder="Salary">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][salary_grade]" class="form-control" placeholder="Salary Grade">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][appointment_status]" class="form-control" placeholder="Appointment Status">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<select name="row_we[' + i + '][is_gov_service]" class="form-control">' +
                            '<option value="">Select</option>' +
                              '<option value="true">YES</option>' +
                              '<option value="false">NO</option>' +
                          '</select>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#we_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });
      
      $(".priceformat").priceFormat({
        prefix: "",
        thousandsSeparator: ",",
        clearOnEmpty: true,
        allowNegative: true
      });

      $(this).removeClass('datepicker');

      });
    });







    {{-- Voluntary Works ADD ROW --}}
    $(document).ready(function() {

      $("#vw_add_row").on("click", function() {
      var i = $("#vw_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_vw[' + i + '][name]" class="form-control" placeholder="Name">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_vw[' + i + '][address]" class="form-control" placeholder="Address">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_vw[' + i + '][date_from]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_vw[' + i + '][date_to]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_vw[' + i + '][hours]" class="form-control" placeholder="Hours">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_vw[' + i + '][position]" class="form-control" placeholder="Position">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#vw_table_body").append($(content));

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







    {{-- Recognitions ADD ROW --}}
    $(document).ready(function() {

      $("#recognition_add_row").on("click", function() {
      var i = $("#recognition_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_recognition[' + i + '][title]" class="form-control" placeholder="Title">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#recognition_table_body").append($(content));

      });

    });







    {{-- Organizations ADD ROW --}}
    $(document).ready(function() {

      $("#org_add_row").on("click", function() {
      var i = $("#org_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_org[' + i + '][name]" class="form-control" placeholder="Name">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#org_table_body").append($(content));

      });

    });







    {{-- Special Skills ADD ROW --}}
    $(document).ready(function() {

      $("#ss_add_row").on("click", function() {
      var i = $("#ss_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_ss[' + i + '][description]" class="form-control" placeholder="Special Skills or Hobies">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#ss_table_body").append($(content));

      });

    });







    {{-- Reference ADD ROW --}}
    $(document).ready(function() {

      $("#reference_add_row").on("click", function() {
      var i = $("#reference_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_reference[' + i + '][fullname]" class="form-control" placeholder="Fullname">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_reference[' + i + '][address]" class="form-control" placeholder="Address">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_reference[' + i + '][tel_no]" class="form-control" placeholder="Telephone No.">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';
      if(i < 3){
        $("#reference_table_body").append($(content));
      }

      });

    });





    {{-- Fill Permanent address --}}
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