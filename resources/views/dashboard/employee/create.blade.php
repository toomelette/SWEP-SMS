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
              <li><a href="#ed" data-toggle="tab">Employee Details</a></li>
              <li><a href="#id" data-toggle="tab">Personal ID's</a></li>
            </ul>

            <div class="tab-content">


              {{-- Personal Info --}}
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
                     '2', 'bloodtype', 'text', 'Blood Type', 'Blood Type', old('bloodtype'), $errors->has('bloodtype'), $errors->first('bloodtype'), ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '4', 'civilstat', 'Civil Status *', old('civilstat'), $civil_status, $errors->has('civilstat'), $errors->first('civilstat'), '', ''
                  ) !!}

                </div>
              </div>



              {{-- Educ Background --}}
              <div class="tab-pane" id="eb">
                <div class="row">
                    
                  {!! FormHelper::textbox(
                     '6', 'undergrad', 'text', 'College', 'College', old('undergrad'), $errors->has('undergrad'), $errors->first('undergrad'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'graduate1', 'text', 'Masteral', 'Masteral', old('graduate1'), $errors->has('graduate1'), $errors->first('graduate1'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'graduate2', 'text', 'Other Masteral (if necessary)', 'Other Masteral (if necessary)', old('graduate2'), $errors->has('graduate2'), $errors->first('graduate2'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'postgrad1', 'text', 'PHD', 'PHD', old('postgrad1'), $errors->has('postgrad1'), $errors->first('postgrad1'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'eligibility', 'text', 'Elegibility', 'Elegibility', old('eligibility'), $errors->has('eligibility'), $errors->first('eligibility'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '6', 'eligibilitylevel', 'text', 'Elegibility Level', 'Elegibility Level', old('eligibilitylevel'), $errors->has('eligibilitylevel'), $errors->first('eligibilitylevel'), ''
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
                                  <input type="text" name="row[0][topics]" class="form-control" placeholder="Topics" value="{{ $value['topics'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.topics') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[0][conductedby]" class="form-control" placeholder="Conducted by" value="{{ $value['conductedby'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.conductedby') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row[0][datefrom]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($value['datefrom']) }}">
                                    <small class="text-danger">{{ $errors->first('row.'. $key .'.datefrom') }}</small>
                                  </div>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input name="row[0][dateto]" type="text" class="form-control datepicker" placeholder="mm/dd/yy" value="{{ DataTypeHelper::date_out($value['dateto']) }}">
                                    <small class="text-danger">{{ $errors->first('row.'. $key .'.dateto') }}</small>
                                  </div>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[0][hours]" class="form-control" placeholder="Hours" value="{{ $value['hours'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.hours') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[0][venue]" class="form-control" placeholder="Venue" value="{{ $value['venue'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.venue') }}</small>
                                </div>
                              </td>


                              <td>
                                <div class="form-group">
                                  <input type="text" name="row[0][remarks]" class="form-control" placeholder="Remarks" value="{{ $value['remarks'] }}">
                                  <small class="text-danger">{{ $errors->first('row.'. $key .'.remarks') }}</small>
                                </div>
                              </td>


                              <td>
                                  <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>

                            </tr>

                          @endforeach

                        @else

                          <tr>

                            <td>
                              <div class="form-group">
                                <input type="text" name="row[0][topics]" class="form-control" placeholder="Topics">
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[0][conductedby]" class="form-control" placeholder="Conducted by">
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input name="row[0][datefrom]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                                </div>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input name="row[0][dateto]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">
                                </div>
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[0][hours]" class="form-control" placeholder="Hours">
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[0][venue]" class="form-control" placeholder="Venue">
                              </div>
                            </td>


                            <td>
                              <div class="form-group">
                                <input type="text" name="row[0][remarks]" class="form-control" placeholder="Remarks">
                              </div>
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




              {{-- Employee Details --}}
              <div class="tab-pane" id="ed">
                <div class="row">

                  {!! FormHelper::select_dynamic(
                    '3', 'dept', 'Department *', old('dept'), $global_departments_all, 'name', 'name', $errors->has('dept'), $errors->first('dept'), '', ''
                  ) !!}

                  {!! FormHelper::select_dynamic(
                    '3', 'division', 'Division *', old('division'), $global_department_units_all, 'name', 'name', $errors->has('division'), $errors->first('division'), '', ''
                  ) !!}

                  {!! FormHelper::select_static(
                    '3', 'apptstat', 'Appointment Status *', old('apptstat'), ['Permanent' => 'PERM', 'Job Order / Contract of Service' => 'COS'], $errors->has('apptstat'), $errors->first('apptstat'), '', ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'itemno', 'text', 'Item No.', 'Item No.', old('itemno'), $errors->has('itemno'), $errors->first('itemno'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'position', 'text', 'Position *', 'Position', old('position'), $errors->has('position'), $errors->first('position'), 'data-transform="uppercase"'
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'salgrade', 'text', 'Salary Grade *', 'Salary Grade', old('salgrade'), $errors->has('salgrade'), $errors->first('salgrade'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                    '3', 'stepinc', 'text', 'Step Increment', 'Step Increment', old('stepinc'), $errors->has('stepinc'), $errors->first('stepinc'), ''
                  ) !!}

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
                    '3', 'foodsubsi', 'text', 'Food Subsidy', 'Food Subsidy', old('foodsubsi'), $errors->has('foodsubsi'), $errors->first('foodsubsi'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'allow1', 'text', 'RA', 'RA', old('allow1'), $errors->has('allow1'), $errors->first('allow1'), ''
                  ) !!}

                  {!! FormHelper::textbox_numeric(
                    '3', 'allow2', 'text', 'TA', 'TA', old('allow2'), $errors->has('allow2'), $errors->first('allow2'), ''
                  ) !!}

                  {!! FormHelper::datepicker('3', 'govserv',  'First Day to serve Government', old('govserv'), $errors->has('govserv'), $errors->first('govserv')) !!}

                  {!! FormHelper::datepicker('3', 'firstday',  'First Day in SRA', old('firstday'), $errors->has('firstday'), $errors->first('firstday')) !!}

                  {!! FormHelper::datepicker('3', 'apptdate',  'Appointment Date', old('apptdate'), $errors->has('apptdate'), $errors->first('apptdate')) !!}

                  {!! FormHelper::datepicker('3', 'adjdate',  'Adjustment Date', old('adjdate'), $errors->has('adjdate'), $errors->first('adjdate')) !!}

                </div>
              </div>




              {{-- Personal ID's --}}
              <div class="tab-pane" id="id">
                <div class="row">

                  {!! FormHelper::textbox(
                     '3', 'phic', 'text', 'PHIC', 'PHIC', old('phic'), $errors->has('phic'), $errors->first('phic'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'tin', 'text', 'TIN', 'TIN', old('tin'), $errors->has('tin'), $errors->first('tin'), ''
                  ) !!}

                  {!! FormHelper::textbox(
                     '3', 'gsis', 'text', 'GSIS', 'GSIS', old('gsis'), $errors->has('gsis'), $errors->first('gsis'), ''
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


    {!! JSHelper::ajax_select_to_select('dept', 'division', '/api/select_response_department_units_from_department/', 'name', 'name') !!}


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