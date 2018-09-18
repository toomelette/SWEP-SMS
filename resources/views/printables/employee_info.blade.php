<?php

  if(!empty($employee->employeeAddress)){
    $res_address = optional($employee->employeeAddress)->res_address_barangay .' '. optional($employee->employeeAddress)->res_address_city .', '. optional($employee->employeeAddress)->res_address_province;
    $perm_address = optional($employee->employeeAddress)->perm_address_barangay .' '. optional($employee->employeeAddress)->perm_address_city .', '. optional($employee->employeeAddress)->perm_address_province;
  }else{
    $res_address = "";
    $perm_address = "";
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Employee Information</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">


</head>
<body onload="window.print();" onafterprint="window.close()">


  <div class="content-wrapper">
    <section class="invoice">

      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
            <img src="{{ asset('images/sra.png') }}" style="width:40px;"> &nbsp; Sugar Regulatory Administration
            <small class="pull-right">{{ $employee->fullname }} <br>Employee No.: <b>{{ $employee->employee_no }}</b></small>
          </h3>
        </div>
      </div>


      {{-- Personal Info --}}
      @if(Request::get('p_info') == 'on')
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Personal Information</h3>
            </div>
            <div class="box-body" style="font-size:11px;">
              <dl class="dl-horizontal" style="padding-bottom:60px;">
                <dt>Fullname:</dt>
                <dd>{{ $employee->fullname }}</dd>
                <dt>Date of Birth:</dt>
                <dd>{{ Carbon::parse($employee->date_of_birth)->format('M d, Y') }}</dd>
                <dt>Place of Birth:</dt>
                <dd>{{ $employee->place_of_birth }}</dd>
                <dt>Sex:</dt>
                <dd>{{ $employee->sex }}</dd>
                <dt>Civil Status:</dt>
                <dd>{{ $employee->civil_status }}</dd>
                <dt>Height:</dt>
                <dd>{{ $employee->height }}</dd>
                <dt>Weight:</dt>
                <dd>{{ $employee->weight }}</dd>
                <dt>Blood Type:</dt>
                <dd>{{ $employee->blood_type }}</dd>
                <dt>Tel No:</dt>
                <dd>{{ $employee->tel_no }}</dd>
                <dt>Cell No:</dt>
                <dd>{{ $employee->cell_no }}</dd>
                <dt>Email Address:</dt>
                <dd>{{ $employee->email }}</dd>
                <dt>Citizenship:</dt>
                <dd>{{ $employee->citizenship }}</dd>
                <dt>Residential Address:</dt>
                <dd>{{ $res_address }}</dd>
                <dt>Permanent Address:</dt>
                <dd>{{ $perm_address }}</dd>
              </dl>
            </div>
          </div>
        </div>
      @endif



      {{-- Appointment Details --}}
      @if(Request::get('appt_dtl') == 'on')
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h4 class="box-title">Appointment Details</h4>
            </div>
            <div class="box-body" style="font-size:11px;">
              <dl class="dl-horizontal">
                <dt>Employee No:</dt>
                <dd>{{ $employee->employee_no }}</dd>
                <dt>Status:</dt>
                <dd>{{ $employee->is_active == 1 ? 'ACTIVE' : 'INACTIVE' }}</dd>
                <dt>Position:</dt>
                <dd>{{ $employee->position }}</dd>
                <dt>Salary Grade:</dt>
                <dd>{{ $employee->salary_grade }}</dd>
                <dt>Step Increment:</dt>
                <dd>{{ $employee->step_inc }}</dd>
                <dt>Appointment Status:</dt>
                <dd>{{ $employee->appointment_status == 'PERM' ? 'PERMANENT' : 'CONTRACT OF SERVICE' }}</dd>
                <dt>Item No:</dt>
                <dd>{{ $employee->item_no }}</dd>
                <dt>Monthly Basic:</dt>
                <dd>{{ number_format($employee->monthly_basic, 2) }}</dd>
                <dt>ACA:</dt>
                <dd>{{ number_format($employee->aca, 2) }}</dd>
                <dt>PERA:</dt>
                <dd>{{ number_format($employee->pera, 2) }}</dd>
                <dt>Food Subsidy:</dt>
                <dd>{{ number_format($employee->food_subsidy, 2) }}</dd>
                <dt>RA:</dt>
                <dd>{{ number_format($employee->ra, 2) }}</dd>
                <dt>TA:</dt>
                <dd>{{ number_format($employee->ta, 2) }}</dd>
                <dt>Government Service:</dt>
                <dd>{{ $employee->firstday_gov == '' ? '' : Carbon::parse($employee->firstday_gov)->format('M d, Y') }}</dd>
                <dt>First Day:</dt>
                <dd>{{ $employee->firstday_sra == '' ? '' : Carbon::parse($employee->firstday_sra)->format('M d, Y') }}</dd>
                <dt>Appointment Date:</dt>
                <dd>{{ $employee->appointment_date != null ? Carbon::parse($employee->appointment_date)->format('M d, Y') : ''}}</dd>
                <dt>Adjustment Date:</dt>
                <dd>{{ $employee->adjustment_date != null ? Carbon::parse($employee->adjustment_date)->format('M d, Y') : ''}}</dd>
              </dl>
            </div>
          </div>
        </div>
      @endif



      {{-- ID's --}}
      @if(Request::get('p_id') == 'on')
        <div class="col-xs-12">
          <div class="box" style="font-size:11px;">
            <div class="box-header with-border">
              <h3 class="box-title">Personal ID's</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>GSIS:</dt>
                <dd>{{ $employee->gsis }}</dd>
                <dt>SSS:</dt>
                <dd>{{ $employee->sss }}</dd>
                <dt>PHILHEALTH:</dt>
                <dd>{{ $employee->philhealth }}</dd>
                <dt>TIN:</dt>
                <dd>{{ $employee->tin }}</dd>
                <dt>HDMF:</dt>
                <dd>{{ $employee->hdmf }}</dd>
                <dt>GSIS:</dt>
                <dd>{{ $employee->gsis }}</dd>
                <dt>HDMF Premium:</dt>
                <dd>{{ number_format($employee->hdmfpremiums, 2) }}</dd>
              </dl>
            </div>
          </div>
        </div>
      @endif



      {{-- Family Info --}}
      @if(Request::get('f_info') == 'on')
        <div class="col-xs-12">
          <div class="box" style="font-size:11px;">
            <div class="box-header with-border">
              <h3 class="box-title">Family Info</h3>
            </div>
            <div class="box-body">

              <dl class="dl-horizontal">
                <dt>Fathers Name</dt>
                <dd>{{ optional($employee->employeeFamilyDetail)->father_firstname . " " . substr(optional($employee->employeeFamilyDetail)->father_middlename , 0, 1) . ". " . optional($employee->employeeFamilyDetail)->father_lastname }}</dd>
                <dt>Mothers Name:</dt>
                <dd>{{ optional($employee->employeeFamilyDetail)->mother_firstname . " " . substr(optional($employee->employeeFamilyDetail)->mother_middlename , 0, 1) . ". " . optional($employee->employeeFamilyDetail)->mother_lastname }}</dd>
                <dt>Spouse Name:</dt>
                <dd>{{ optional($employee->employeeFamilyDetail)->spouse_firstname . " " . substr(optional($employee->employeeFamilyDetail)->spouse_middlename , 0, 1) . ". " . optional($employee->employeeFamilyDetail)->spouse_lastname }}</dd>
              </dl>

              <span style="font-size:17px;">Children:</span>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Name</th>
                    <th>Date of Birth</th>
                  </tr>
                  @foreach($employee->employeeChildren as $data)
                    <tr>
                      <td>{{ $data->fullname }}</td>
                      <td>{{ $data->date_of_birth != null ? Carbon::parse($data->date_of_birth)->format('M d, Y') : ''}}</td>
                    </tr>
                  @endforeach
                </table>
                @if($employee->employeeChildren->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>

            </div>
          </div>
        </div>
        @endif



        {{-- Educational Background --}}
        @if(Request::get('edc_bg') == 'on')
         <div class="col-xs-12">
          <div class="box" style="font-size:11px;">
            <div class="box-header with-border">
              <h3 class="box-title">Educational Background</h3>
            </div>
            <div class="box-body" style="overflow-x:auto;">
              <table class="table table-bordered">
                <tr>
                  <th>Level</th>
                  <th>Name of School</th>
                  <th>Course</th>
                  <th>Graduate Year</th>
                </tr>
                @foreach($employee->employeeEducationalBackground as $data) 
                  <tr>
                    <td>{{ $data->level }}</td>
                    <td>{{ $data->school_name }}</td>
                    <td>{{ $data->course }}</td>
                    <td>{{ $data->graduate_year }}</td>
                  </tr>
                @endforeach
              </table>
              @if($employee->employeeEducationalBackground->isEmpty())
                <div style="padding :5px;">
                  <center><h4>No Records found!</h4></center>
                </div>
              @endif
            </div>
          </div>
        </div>
        @endif



        {{-- Trainings --}}
        @if(Request::get('trn_sem') == 'on')
          <div class="col-xs-12">
            <div class="box" style="font-size:11px;">
              <div class="box-header with-border">
                <h3 class="box-title">Trainings</h3>
              </div>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Topics</th>
                    <th>Conducted by</th>
                    <th>Date</th>
                    <th>Venue</th>
                  </tr>
                  @foreach($employee->employeeTraining as $data) 
                    <tr>
                      <td>{{ $data->title }}</td>
                      <td>{{ $data->conducted_by }}</td>
                      <td>
                        @if(Carbon::parse($data->date_from)->format('M') == Carbon::parse($data->date_to)->format('M'))
                          {{ Carbon::parse($data->date_from)->format('M d') .' - '. Carbon::parse($data->date_to)->format('d, Y') }}  
                        @else
                          {{ Carbon::parse($data->date_from)->format('M d, Y') .' - '. Carbon::parse($data->date_to)->format('M d, Y') }}
                        @endif
                      </td>
                      <td>{{ $data->venue }}</td>
                    </tr>
                  @endforeach
                </table>
                @if($employee->employeeTraining->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif



        {{-- Eligibilities --}}
        @if(Request::get('elig') == 'on')
          <div class="col-xs-12">
            <div class="box" style="font-size:11px;">
              <div class="box-header with-border">
                <h3 class="box-title">Eligibilities</h3>
              </div>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Eligibility</th>
                    <th>Level</th>
                    <th>Rating</th>
                  </tr>
                  @foreach($employee->employeeEligibility as $data)
                    <tr>
                      <td>{{ $data->eligibility }}</td>
                      <td>{{ $data->level }}</td>
                      <td>{{ $data->rating }}</td>
                    </tr>
                  @endforeach
                </table>
                @if($employee->employeeEligibility->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif



        {{-- Work Experience --}}
        @if(Request::get('wrk_exp') == 'on')
          <div class="col-xs-12">
            <div class="box" style="font-size:11px;">
              <div class="box-header with-border">
                <h3 class="box-title">Work Experience</h3>
              </div>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Appointment Status</th>
                  </tr>
                  @foreach($employee->employeeExperience as $data) 
                    <tr>
                      <td>{{ $data->company }}</td>
                      <td>{{ $data->position }}</td>
                      <td>{{ $data->appointment_status }}</td>
                    </tr>
                  @endforeach
                </table>
                @if($employee->employeeExperience->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif



        {{-- Voluntary Works --}}
        @if(Request::get('vol_wrk') == 'on')
          <div class="col-xs-12">
            <div class="box"  style="font-size:11px;">
              <div class="box-header with-border">
                <h3 class="box-title">Voluntary Works</h3>
              </div>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Name of Organization</th>
                    <th>Position</th>
                  </tr>
                  @foreach($employee->employeeVoluntaryWork as $data) 
                    <tr>
                      <td>{{ $data->name }}</td>   
                      <td>{{ $data->position }}</td>                 
                    </tr>
                  @endforeach
                </table>
                @if($employee->employeeVoluntaryWork->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif



        {{-- Recognition --}}
        @if(Request::get('recog') == 'on')
          <div class="col-xs-12">
            <div class="box" style="font-size:11px;">
              <div class="box-header with-border">
                <h3 class="box-title">Recognitions</h3>
              </div>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Title</th>
                  </tr>
                  @foreach($employee->employeeRecognition as $data) 
                    <tr>
                      <td>{{ $data->title }}</td>                  </tr>
                  @endforeach
                </table>
                @if($employee->employeeRecognition->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif



        {{-- Organization --}}
        @if(Request::get('org') == 'on')
          <div class="col-xs-12">
            <div class="box" style="font-size:11px;">
              <div class="box-header with-border">
                <h3 class="box-title">Organizations</h3>
              </div>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Name of Organization</th>
                  </tr>
                  @foreach($employee->employeeOrganization as $data) 
                    <tr>
                      <td>{{ $data->name }}</td>                  </tr>
                  @endforeach
                </table>
                @if($employee->employeeOrganization->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif



        {{-- Special SKills --}}
        @if(Request::get('ss') == 'on')
          <div class="col-xs-12">
            <div class="box" style="font-size:11px;">
              <div class="box-header with-border">
                <h3 class="box-title">Special Skills</h3>
              </div>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Special Skills or Hobies</th>
                  </tr>
                  @foreach($employee->employeeSpecialSkill as $data) 
                    <tr>
                      <td>{{ $data->description }}</td>                
                    </tr>
                  @endforeach
                </table>
                @if($employee->employeeSpecialSkill->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif



        {{-- References --}}
        @if(Request::get('ref') == 'on')
          <div class="col-xs-12">
            <div class="box" style="font-size:11px;">
              <div class="box-header with-border">
                <h3 class="box-title">References</h3>
              </div>
              <div class="box-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Tel No.</th>
                  </tr>
                  @foreach($employee->employeeReference as $data) 
                    <tr>
                      <td>{{ $data->fullname }}</td>
                      <td>{{ $data->address }}</td>
                      <td>{{ $data->tel_no }}</td>                 
                    </tr>
                  @endforeach
                </table>
                @if($employee->employeeReference->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endif



    </section>
    <div class="clearfix"></div>
  </div>


</body>
</html>

