@php
    
    $civil_status = ['MARRIED' => 'MARRIED', 'WIDOWED' => 'WIDOWED', 'SEPERATED' => 'SEPERATED', 'DIVORSED' => 'DIVORSED', 'SINGLE' => 'SINGLE', ];
    $dob =  DataTypeHelper::date_out($employee->dob);
    $govserv =  DataTypeHelper::date_out($employee->govserv);
    $firstday =  DataTypeHelper::date_out($employee->firstday);
    $apptdate =  DataTypeHelper::date_out($employee->apptdate);
    $adjdate =  DataTypeHelper::date_out($employee->adjdate);

@endphp


@extends('layouts.admin-master')


@section('content')
    
  <section class="content-header">
      <h1>Edit Employee</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! HtmlHelper::back_button(['dashboard.employee.index']) !!}
      </div>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.employee.update', $employee->slug) }}">

        @csrf
        <input name="_method" value="PUT" type="hidden">
        
        <div class="box-body">

          @if($errors->all())
            {!! HtmlHelper::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', 'Please check if there are errors on other fields.') !!}
          @endif
          
          {{-- Navigation --}}
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pi" data-toggle="tab">Personal Info</a></li>
              <li><a href="#eb" data-toggle="tab">Educational background</a></li>
              <li><a href="#t" data-toggle="tab">Trainings</a></li>
              <li><a href="#ed" data-toggle="tab">Employee Details</a></li>
              <li><a href="#id" data-toggle="tab">Personal ID's</a></li>
            </ul>

            <div class="tab-content">



              {{-- Personal Info --}}
              <div class="tab-pane active" id="pi">
                <div class="row">
                    
                  {!! FormHelper::textbox(
                     '4', 'lastname', 'text', 'Lastname *', 'Lastname', old('lastname') ? old('lastname') : $employee->lastname, $errors->has('lastname'), $errors->first('lastname'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                     '4', 'firstname', 'text', 'Firstname *', 'Firstname', old('firstname') ? old('firstname') : $employee->firstname, $errors->has('firstname'), $errors->first('firstname'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                     '4', 'middlename', 'text', 'Middlename *', 'Middlename', old('middlename') ? old('middlename') : $employee->middlename, $errors->has('middlename'), $errors->first('middlename'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                     '8', 'address', 'text', 'Address *', 'Address', old('address') ? old('address') : $employee->address, $errors->has('address'), $errors->first('address'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::datepicker('4', 'dob',  'Date of Birth *', old('dob') ? old('dob') : $dob, $errors->has('dob'), $errors->first('dob')) !!}

                  {!! FormHelper::textbox(
                     '8', 'pob', 'text', 'Place of Birth *', 'Place of Birth', old('pob') ? old('pob') : $employee->pob, $errors->has('pob'), $errors->first('pob'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::select_static(
                    '2', 'gender', 'Gender *', old('gender') ? old('gender') : $employee->gender, ['Male' => 'M', 'Female' => 'F'], $errors->has('gender'), $errors->first('gender'), '', ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '2', 'bloodtype', 'text', 'Blood Type', 'Blood Type', old('bloodtype') ? old('bloodtype') : $employee->bloodtype, $errors->has('bloodtype'), $errors->first('bloodtype'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::select_static(
                    '4', 'civilstat', 'Civil Status *', old('civilstat') ? old('civilstat') : $employee->civilstat, $civil_status, $errors->has('civilstat'), $errors->first('civilstat'), '', ''
                  ) !!}

                </div>
              </div>




              {{-- Educ Background --}}
              <div class="tab-pane" id="eb">
                <div class="row">
                    
                  {!! FormHelper::textbox(
                     '6', 'undergrad', 'text', 'College', 'College', old('undergrad') ? old('undergrad') : $employee->undergrad, $errors->has('undergrad'), $errors->first('undergrad'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'graduate1', 'text', 'Masteral', 'Masteral', old('graduate1') ? old('graduate1') : $employee->graduate1, $errors->has('graduate1'), $errors->first('graduate1'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'graduate2', 'text', 'Other Masteral (if necessary)', 'Other Masteral (if necessary)', old('graduate2') ? old('graduate2') : $employee->graduate2, $errors->has('graduate2'), $errors->first('graduate2'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'postgrad1', 'text', 'PHD', 'PHD', old('postgrad1') ? old('postgrad1') : $employee->postgrad1, $errors->has('postgrad1'), $errors->first('postgrad1'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'eligibility', 'text', 'Elegibility', 'Elegibility', old('eligibility') ? old('eligibility') : $employee->eligibility, $errors->has('eligibility'), $errors->first('eligibility'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'eligibilitylevel', 'text', 'Elegibility Level', 'Elegibility Level', old('eligibilitylevel') ? old('eligibilitylevel') : $employee->eligibilitylevel, $errors->has('eligibilitylevel'), $errors->first('eligibilitylevel'), ''
                  ) !!}

                </div>
              </div>




              {{-- Trainings --}}
              <div class="tab-pane" id="t">
                
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <button id="add_row" type="button" class="btn btn-sm bg-green pull-right"><i class="fa fa-plus"></i></button>
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

                      <tbody id="table_body">

                        @if(old('row'))

                          @foreach(old('row') as $key => $value)

                            <tr>

                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][topics]" class="form-control" placeholder="Topics" value="{{ $value['topics'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.topics') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][conductedby]" class="form-control" placeholder="Conducted by" value="{{ $value['conductedby'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.conductedby') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row[{{ $key }}][datefrom]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($value['datefrom']) }}">
                                  </div>
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.datefrom') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row[{{ $key }}][dateto]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($value['dateto']) }}">
                                  </div>
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.dateto') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][hours]" class="form-control" placeholder="Hours" value="{{ $value['hours'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.hours') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][venue]" class="form-control" placeholder="Venue" value="{{ $value['venue'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.venue') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][remarks]" class="form-control" placeholder="Remarks" value="{{ $value['remarks'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.remarks') }}</small>
                                </div>
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          @foreach ($employee->employeeTraining as $key => $data)

                            <tr>

                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][topics]" class="form-control" placeholder="Topics" value="{{ $data->topics }}">
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][conductedby]" class="form-control" placeholder="Conducted by" value="{{ $data->conductedby }}">
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row[{{ $key }}][datefrom]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($data->datefrom) }}">
                                  </div>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row[{{ $key }}][dateto]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($data->dateto) }}">
                                  </div>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][hours]" class="form-control" placeholder="Hours" value="{{ $data->hours }}">
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][venue]" class="form-control" placeholder="Venue" value="{{ $data->venue }}">
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[{{ $key }}][remarks]" class="form-control" placeholder="Remarks" value="{{ $data->remarks }}">
                                </div>
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @endif

                        </tbody>

                    </table>
                   
                  </div>

                </div>

              </div>




              {{-- Employee Details --}}
              <div class="tab-pane" id="ed">
                <div class="row">

                  {!! FormHelper::textbox(
                    '3', 'empno', 'text', 'Employee No. *', 'Employee No.', old('empno') ? old('empno') : $employee->empno, $errors->has('empno'), $errors->first('empno'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'active', 'Status', old('active') ? old('active') : $employee->active, ['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE'], $errors->has('active'), $errors->first('active'), '', ''
                  ) !!}

                  {!! FormHelper::select_dynamic(
                    '3', 'dept', 'Department *', old('dept') ? old('dept') : $employee->dept, $global_departments_all, 'department_id', 'name', $errors->has('dept'), $errors->first('dept'), '', ''
                  ) !!}

                  {!! FormHelper::select_dynamic(
                    '3', 'division', 'Division *', old('division') ? old('division') : $employee->division, $global_department_units_all, 'department_unit_id', 'name', $errors->has('division'), $errors->first('division'), '', ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'apptstat', 'Appointment Status *', old('apptstat') ? old('apptstat') : $employee->apptstat, ['Permanent' => 'PERM', 'Job Order / Contract of Service' => 'COS'], $errors->has('apptstat'), $errors->first('apptstat'), '', ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'itemno', 'text', 'Item No. *', 'Item No.', old('itemno') ? old('itemno') : $employee->itemno, $errors->has('itemno'), $errors->first('itemno'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'position', 'text', 'Position *', 'Position', old('position') ? old('position') : $employee->position, $errors->has('position'), $errors->first('position'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'salgrade', 'text', 'Salary Grade *', 'Salary Grade', old('salgrade') ? old('salgrade') : $employee->salgrade, $errors->has('salgrade'), $errors->first('salgrade'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox(
                    '3', 'stepinc', 'text', 'Step Increment', 'Step Increment', old('stepinc') ? old('stepinc') : $employee->stepinc, $errors->has('stepinc'), $errors->first('stepinc'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'monthlybasic', 'text', 'Monthly Basic *', 'Monthly Basic', old('monthlybasic') ? old('monthlybasic') : $employee->monthlybasic, $errors->has('monthlybasic'), $errors->first('monthlybasic'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'aca', 'text', 'ACA', 'ACA', old('aca') ? old('aca') : $employee->aca, $errors->has('aca'), $errors->first('aca'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'pera', 'text', 'PERA', 'PERA', old('pera') ? old('pera') : $employee->pera, $errors->has('pera'), $errors->first('pera'), ''
                  ) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::textbox_numeric(
                    '3', 'foodsubsi', 'text', 'Food Subsidy', 'Food Subsidy', old('foodsubsi') ? old('foodsubsi') : $employee->foodsubsi, $errors->has('foodsubsi'), $errors->first('foodsubsi'), ''
                  ) !!}
                  
                  {!! FormHelper::textbox_numeric(
                    '3', 'allow1', 'text', 'RA', 'RA', old('allow1') ? old('allow1') : $employee->allow1, $errors->has('allow1'), $errors->first('allow1'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'allow2', 'text', 'TA', 'TA', old('allow2') ? old('allow2') : $employee->allow2, $errors->has('allow2'), $errors->first('allow2'), ''
                  ) !!}

                  {!! FormHelper::datepicker('3', 'govserv',  'First Day to serve Government *', old('govserv') ? old('govserv') : $govserv, $errors->has('govserv'), $errors->first('govserv')) !!}

                  <div class="col-md-12"></div>

                  {!! FormHelper::datepicker('3', 'firstday',  'First Day in SRA *', old('firstday') ? old('firstday') : $firstday, $errors->has('firstday'), $errors->first('firstday')) !!}

                  {!! FormHelper::datepicker('3', 'apptdate',  'Appointment Date', old('apptdate') ? old('apptdate') : $apptdate, $errors->has('apptdate'), $errors->first('apptdate')) !!}

                  {!! FormHelper::datepicker('3', 'adjdate',  'Adjustment Date', old('adjdate') ? old('adjdate') : $adjdate, $errors->has('adjdate'), $errors->first('adjdate')) !!}

                </div>
              </div>




              {{-- Personal ID's --}}
              <div class="tab-pane" id="id">
                <div class="row">

                  {!! FormHelper::textbox(
                     '3', 'phic', 'text', 'PHIC', 'PHIC', old('phic') ? old('phic') : $employee->phic, $errors->has('phic'), $errors->first('phic'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'tin', 'text', 'TIN', 'TIN', old('tin') ? old('tin') : $employee->tin, $errors->has('tin'), $errors->first('tin'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'gsis', 'text', 'GSIS', 'GSIS', old('gsis') ? old('gsis') : $employee->gsis, $errors->has('gsis'), $errors->first('gsis'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'hdmf', 'text', 'HDMF', 'HDMF', old('hdmf') ? old('hdmf') : $employee->hdmf, $errors->has('hdmf'), $errors->first('hdmf'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'hdmfpremiums', 'text', 'HDMF Premiums', 'HDMF Premiums', old('hdmfpremiums') ? old('hdmfpremiums') : $employee->hdmfpremiums, $errors->has('hdmfpremiums'), $errors->first('hdmfpremiums'), ''
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


    {!! JSHelper::ajax_select_to_select('dept', 'division', '/api/select_response_department_units_from_department/', 'department_unit_id', 'name') !!}


    {{-- ADD ROW --}}
    $(document).ready(function() {

      $("#add_row").on("click", function() {
      var i = $("#table_body").children().length;
      var content ='<tr>' +
                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row[' + i + '][topics]" class="form-control" placeholder="Topics">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row[' + i + '][conductedby]" class="form-control" placeholder="Conducted by">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row[' + i + '][datefrom]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row[' + i + '][dateto]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row[' + i + '][hours]" class="form-control" placeholder="Hours">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row[' + i + '][venue]" class="form-control" placeholder="Venue">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row[' + i + '][remarks]" class="form-control" placeholder="Remarks">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#table_body").append($(content));

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



    {{-- DELETE ROW --}}
    $(document).on("click","#delete_row" ,function(e) {
        $(this).closest('tr').remove();
    });


  </script> 
    
@endsection