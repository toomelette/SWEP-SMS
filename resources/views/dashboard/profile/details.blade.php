<?php

  $gtChildren = count(optional(Auth::user()->employee)->employeeChildren) > 11;
  $gtEligibility = count(optional(Auth::user()->employee)->employeeEligibility) > 10;
  $gtExperience = count(optional(Auth::user()->employee)->employeeExperience) > 25;
  $gtVoluntaryWork = count(optional(Auth::user()->employee)->employeeVoluntaryWork) > 7;
  $gtTraining = count(optional(Auth::user()->employee)->employeeTraining) > 20;
  $gtSpecialSkill = count(optional(Auth::user()->employee)->employeeSpecialSkill) > 7;
  $gtRecognition = count(optional(Auth::user()->employee)->employeeRecognition) > 7;
  $gtOrganization = count(optional(Auth::user()->employee)->employeeOrganization) > 7;

?>



@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Profile</h1>
</section>

<section class="content">

  <div class="row">

    <div class="col-md-3">

      <div class="box box-default">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{asset('images/avatar.jpeg')}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{ Auth::check() ? Auth::user()->fullname : '' }}</h3>

          <p class="text-muted text-center">{{ Auth::check() ? Auth::user()->position : '' }}</p>

        </div>
      </div>

    </div>


    <div class="col-md-9">

      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Details</h3>
        </div>

        <div class="box-body">

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#ui" data-toggle="tab">User Info</a></li>
               <li><a href="#pi" data-toggle="tab">Personal Info</a></li>
            </ul>

            <div class="tab-content">



              {{-- User Info --}}
              <div class="tab-pane active" id="ui">
                <h4>User Info</h4>
                <hr>

                <strong><i class="fa fa-user margin-r-5"></i> Firstname</strong>
                <p class="text-muted">{{ Auth::user()->firstname }}</p>

                <strong><i class="fa fa-user margin-r-5"></i> Middlename</strong>
                <p class="text-muted">{{ Auth::user()->middlename }}</p>

                <strong><i class="fa fa-user margin-r-5"></i> Lastname</strong>
                <p class="text-muted">{{ Auth::user()->lastname }}</p>

                <strong><i class="fa fa-male margin-r-5"></i> Position</strong>
                <p class="text-muted">{{ Auth::user()->position }}</p>

                <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                <p class="text-muted">{{ Auth::user()->email }}</p>

                <hr>

                {{-- Account Settings --}}

                <h4>Account Settings</h4>
                <hr>

                {!! __html::alert('warning', '<i class="icon fa fa-info"></i> Note!', 'You will be logout from the system after you save changes.') !!}   


                {{-- USERNAME SETTINGS --}}

                <div class="panel box box-default">
                  <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#username_bar">
                    <h4 class="box-title">
                      <span>
                        Username
                      </span>
                    </h4>
                  </div>
                  <div id="username_bar" class="panel-collapse collapse {{ $errors->has('username') ? 'in' : '' }}">
                    <div class="box-body">

                      <form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('dashboard.profile.update_account_username', Auth::user()->slug) }}">

                        @csrf

                        <input name="_method" value="PATCH" type="hidden">

                        {!! __form::textbox_inline(
                            'username', 'text', 'Username', 'Username', old('username') ? old('username') : Auth::user()->username, $errors->has('username') || Session::has('PROFILE_USERNAME_EXIST'), $errors->first('username'), ''
                        ) !!}

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Save Changes</button>
                          </div>
                        </div>

                      </form>

                    </div>
                  </div>
                </div>


                {{-- PASSWORD SETTINGS --}}

                <div class="panel box box-default">
                  <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#password_bar">
                    <h4 class="box-title">
                      <span>
                        Password
                      </span>
                    </h4>
                  </div>
                  <div id="password_bar" class="panel-collapse collapse {{ Session::has('PROFILE_OLD_PASSWORD_FAIL') || $errors->has('password') ? 'in' : '' }}">
                    <div class="box-body">

                      @if(Session::has('PROFILE_OLD_PASSWORD_FAIL'))
                        {!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Alert!', Session::get('PROFILE_OLD_PASSWORD_FAIL')) !!}
                      @endif

                      <form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('dashboard.profile.update_account_password', Auth::user()->slug) }}">

                        @csrf

                        <input name="_method" value="PATCH" type="hidden">

                        {!! __form::password_inline(
                            'old_password', 'Old Password', 'Old Password', $errors->has('old_password') || Session::has('PROFILE_OLD_PASSWORD_FAIL'), $errors->first('old_password'), ''
                        ) !!}

                        {!! __form::password_inline(
                            'password', 'New Password', 'New Password', $errors->has('password'), $errors->first('password'), ''
                        ) !!}

                        {!! __form::password_inline(
                            'password_confirmation', 'Confirm New Password', 'Confirm New Password', '', '', ''
                        ) !!}

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Save Changes</button>
                          </div>
                        </div>
                      
                      </form>

                    </div>
                  </div>
                </div>


                {{-- COLOR SETTINGS --}}

                <div class="panel box box-default">
                  <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#color_scheme_bar">
                    <h4 class="box-title">
                      <span>
                        Color Scheme
                      </span>
                    </h4>
                  </div>
                  <div id="color_scheme_bar" class="panel-collapse collapse {{ $errors->has('color') ? 'in' : '' }}">
                    <div class="box-body">

                      <form id="profile_update_account_color" method="POST" autocomplete="off" action="{{ route('dashboard.profile.update_account_color', Auth::user()->slug) }}">

                        @csrf

                        <input name="_method" value="PATCH" type="hidden">

                        {!! __form::select_static(
                          '4', 'color', 'Color Scheme', old('color') ? old('color') : Auth::user()->color, __static::user_colors(), $errors->has('color'), $errors->first('color'), '', ''
                        ) !!}

                        <div class="form-group">
                          <div style="margin-top:24px;" class="col-sm-8">
                            <button type="submit" class="btn btn-default">Save Changes</button>
                          </div>
                        </div>

                      </form>

                    </div>
                  </div>
                </div>


                {{-- Activity --}}
                <hr>
                <h4>Activity</h4>
                <hr>

                <strong><i class="fa fa-clock-o "></i> Last Login Time</strong>
                <p class="text-muted">{{ __dataType::date_parse(Auth::user()->last_login_time, 'M d, Y h:i A') }}</p>
            
                <strong><i class="fa  fa-desktop margin-r-5"></i> Last Login Machine</strong>
                <p class="text-muted">{{ Auth::user()->last_login_machine }}</p>
               

                <strong><i class="fa  fa-asterisk margin-r-5"></i> Last Login Local IP</strong>
                <p class="text-muted">{{ Auth::user()->last_login_ip }}</p>
              </div>






              <div class="tab-pane" id="pi">
                <div class="row">

                  @if(empty(Auth::user()->employee))
                    <div class="col-md-12" style="padding:20px; text-align:center;">  
                      <span style="font-size:20px; color:red;" >You are not Syncronize to any employee!</span>
                    </div>

                  @else
                    


                    {{-- Print PDS --}}
                    <div class="col-md-12">
                      <div class="panel box box-default">
                        <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#pds_bar">
                          <h4 class="box-title">
                            <span>
                              Print your Personal Data Sheet
                            </span>
                          </h4>
                        </div>
                        <div id="pds_bar" class="panel-collapse collapse">
                          <div class="box-body">

                            {!! __html::alert('warning', '<i class="icon fa fa-info"></i> Note!', 'Before you print your PDS, please be reminded to set the <b>LAYOUT</b> to <b>PORTRAIT</b>, <b>PAPER SIZE</b> to <b>LEGAL</b>, and <b>SCALE</b> to <b>100%</b>.') !!} 

                            <a href="{{ route('dashboard.profile.print_pds', [ optional(Auth::user()->employee)->slug, 'p1' ]) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Page 1</a>&nbsp;
                            <a href="{{ route('dashboard.profile.print_pds', [ optional(Auth::user()->employee)->slug, 'p2' ]) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Page 2</a>&nbsp;
                            <a href="{{ route('dashboard.profile.print_pds', [ optional(Auth::user()->employee)->slug, 'p3' ]) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Page 3</a>&nbsp;
                            <a href="{{ route('dashboard.profile.print_pds', [ optional(Auth::user()->employee)->slug, 'p4' ]) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Page 4</a>&nbsp;

                            @if($gtChildren || $gtEligibility || $gtExperience || $gtVoluntaryWork || $gtTraining || $gtSpecialSkill || $gtRecognition || $gtOrganization)
                              <a href="{{ route('dashboard.profile.print_pds', [ optional(Auth::user()->employee)->slug, 'p5' ]) }}" target="_blank" class="btn btn-sm btn-default">
                                <i class="fa fa-print"></i> Print PDS Extra Page
                              </a>&nbsp;
                            @endif

                          </div>
                        </div>
                      </div>
                    </div>





                    {{-- Personal Info --}}
                    <div class="col-md-12">
                      <div class="panel box box-default">
                        <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#pi_bar">
                          <h4 class="box-title">
                            <span>
                              Personal Info
                            </span>
                          </h4>
                        </div>
                        <div id="pi_bar" class="panel-collapse collapse">
                          <div class="box-body">

                            <dl class="dl-horizontal">
                              <dt>Fullname:</dt>
                              <dd>{{ Auth::user()->employee->fullname }}</dd>
                              <dt>Date of Birth:</dt>
                              <dd>{{ __dataType::date_parse(Auth::user()->employee->date_of_birth, 'M d, Y') }}</dd>
                              <dt>Place of Birth:</dt>
                              <dd>{{ Auth::user()->employee->place_of_birth }}</dd>
                              <dt>Sex:</dt>
                              <dd>{{ Auth::user()->employee->sex }}</dd>
                              <dt>Civil Status:</dt>
                              <dd>{{ Auth::user()->employee->civil_status }}</dd>
                              <dt>Height:</dt>
                              <dd>{{ Auth::user()->employee->height }}</dd>
                              <dt>Weight:</dt>
                              <dd>{{ Auth::user()->employee->weight }}</dd>
                              <dt>Blood Type:</dt>
                              <dd>{{ Auth::user()->employee->blood_type }}</dd>
                              <dt>Tel No:</dt>
                              <dd>{{ Auth::user()->employee->tel_no }}</dd>
                              <dt>Cell No:</dt>
                              <dd>{{ Auth::user()->employee->cell_no }}</dd>
                              <dt>Email Address:</dt>
                              <dd>{{ Auth::user()->employee->email }}</dd>
                              <dt>Citizenship:</dt>
                              <dd>{{ Auth::user()->employee->citizenship }}</dd>
                              <dt>Residential Address:</dt>
                              <dd>{{ optional(Auth::user()->employee->employeeAddress)->fullResAddress }}</dd>
                              <dt>Permanent Address:</dt>
                              <dd>{{  optional(Auth::user()->employee->employeeAddress)->fullPermAddress }}</dd>
                            </dl>

                          </div>
                        </div>
                      </div>
                    </div>




                    {{-- Appointment Details --}}
                    <div class="col-md-12">
                      <div class="panel box box-default">
                        <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#ad_bar">
                          <h4 class="box-title">
                            <span>
                              Appointment Details
                            </span>
                          </h4>
                        </div>
                        <div id="ad_bar" class="panel-collapse collapse">
                          <div class="box-body">

                            <dl class="dl-horizontal">
                              <dt>Employee No:</dt>
                              <dd>{{ Auth::user()->employee->employee_no }}</dd>
                              <dt>Status:</dt>
                              <dd>{{ Auth::user()->employee->is_active }}</dd>
                              <dt>Position:</dt>
                              <dd>{{ Auth::user()->employee->position }}</dd>
                              <dt>Salary Grade:</dt>
                              <dd>{{ Auth::user()->employee->salary_grade }}</dd>
                              <dt>Appointment Status:</dt>
                              <dd>{{ Auth::user()->employee->appointment_status }}</dd>
                              <dt>Monthly Basic:</dt>
                              <dd>{{ number_format(Auth::user()->employee->monthly_basic, 2) }}</dd>
                              <dt>ACA:</dt>
                              <dd>{{ number_format(Auth::user()->employee->aca, 2) }}</dd>
                              <dt>PERA:</dt>
                              <dd>{{ number_format(Auth::user()->employee->pera, 2) }}</dd>
                              <dt>Food Subsidy:</dt>
                              <dd>{{ number_format(Auth::user()->employee->food_subsidy, 2) }}</dd>
                              <dt>RA:</dt>
                              <dd>{{ number_format(Auth::user()->employee->ra, 2) }}</dd>
                              <dt>TA:</dt>
                              <dd>{{ number_format(Auth::user()->employee->ta, 2) }}</dd>
                              <dt>Government Service:</dt>
                              <dd>{{ __dataType::date_parse(Auth::user()->employee->firstday_gov, 'M d, Y') }}</dd>
                              <dt>First Day:</dt>
                              <dd>{{ __dataType::date_parse(Auth::user()->employee->firstday_sra, 'M d, Y') }}</dd>
                              <dt>Appointment Date:</dt>
                              <dd>{{ __dataType::date_parse(Auth::user()->employee->appointment_date, 'M d, Y') }}</dd>
                              <dt>Adjustment Date:</dt>
                              <dd>{{ __dataType::date_parse(Auth::user()->employee->adjustment_date, 'M d, Y') }}</dd>
                            </dl>

                          </div>
                        </div>
                      </div>
                    </div>




                    {{-- Personal ID's --}}
                    <div class="col-md-12">
                      <div class="panel box box-default">
                        <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#pid_bar">
                          <h4 class="box-title">
                            <span>
                              Personal ID's
                            </span>
                          </h4>
                        </div>
                        <div id="pid_bar" class="panel-collapse collapse">
                          <div class="box-body">

                            <dl class="dl-horizontal">
                              <dt>GSIS:</dt>
                              <dd>{{ Auth::user()->employee->gsis }}</dd>
                              <dt>SSS:</dt>
                              <dd>{{ Auth::user()->employee->sss }}</dd>
                              <dt>PHILHEALTH:</dt>
                              <dd>{{ Auth::user()->employee->philhealth }}</dd>
                              <dt>TIN:</dt>
                              <dd>{{ Auth::user()->employee->tin }}</dd>
                              <dt>HDMF:</dt>
                              <dd>{{ Auth::user()->employee->hdmf }}</dd>
                              <dt>GSIS:</dt>
                              <dd>{{ Auth::user()->employee->gsis }}</dd>
                              <dt>HDMF Premium:</dt>
                              <dd>{{ number_format(Auth::user()->employee->hdmfpremiums, 2) }}</dd>
                            </dl>

                          </div>
                        </div>
                      </div>
                    </div>




                    {{-- Family Info --}}
                    <div class="col-md-12">
                      <div class="panel box box-default">
                        <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#fi_bar">
                          <h4 class="box-title">
                            <span>
                              Family Info
                            </span>
                          </h4>
                        </div>
                        <div id="fi_bar" class="panel-collapse collapse">
                          <div class="box-body">

                            <dl class="dl-horizontal">
                              <dt>Fathers Name</dt>
                              <dd>{{ optional(Auth::user()->employee->employeeFamilyDetail)->father_firstname . " " . substr(optional(Auth::user()->employee->employeeFamilyDetail)->father_middlename , 0, 1) . ". " . optional(Auth::user()->employee->employeeFamilyDetail)->father_lastname }}</dd>
                              <dt>Mothers Name:</dt>
                              <dd>{{ optional(Auth::user()->employee->employeeFamilyDetail)->mother_firstname . " " . substr(optional(Auth::user()->employee->employeeFamilyDetail)->mother_middlename , 0, 1) . ". " . optional(Auth::user()->employee->employeeFamilyDetail)->mother_lastname }}</dd>
                              <dt>Spouse Name:</dt>
                              <dd>{{ optional(Auth::user()->employee->employeeFamilyDetail)->spouse_firstname . " " . substr(optional(Auth::user()->employee->employeeFamilyDetail)->spouse_middlename , 0, 1) . ". " . optional(Auth::user()->employee->employeeFamilyDetail)->spouse_lastname }}</dd>
                            </dl>
                            <span style="font-size:17px;">Children:</span>
                            <div class="box-body" style="overflow-x:auto;">

                              <table class="table table-bordered">

                                <tr>
                                  <th>Name</th>
                                  <th>Date of Birth</th>
                                </tr>
                                @foreach(Auth::user()->employee->employeeChildren as $data)
                                  <tr>
                                    <td>{{ $data->fullname }}</td>
                                    <td>{{ __dataType::date_parse($data->date_of_birth, 'M d, Y') }}</td>
                                  </tr>
                                @endforeach

                              </table>

                              @if(Auth::user()->employee->employeeChildren->isEmpty())
                                <div style="padding :5px;">
                                  <center><h4>No Records found!</h4></center>
                                </div>
                              @endif

                            </div>

                          </div>
                        </div>
                      </div>
                    </div>




                    {{-- Educ Background --}}
                    <div class="col-md-12">
                      <div class="panel box box-default">
                        <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#eb_bar">
                          <h4 class="box-title">
                            <span>
                              Educational Background
                            </span>
                          </h4>
                        </div>
                        <div id="eb_bar" class="panel-collapse collapse">
                          <div class="box-body">

                            <table class="table table-bordered">
                              <tr>
                                <th>Level</th>
                                <th>Name of School</th>
                                <th>Course</th>
                                <th>Graduate Year</th>
                              </tr>
                              @foreach(Auth::user()->employee->employeeEducationalBackground as $data) 
                                <tr>
                                  <td>{{ $data->level }}</td>
                                  <td>{{ $data->school_name }}</td>
                                  <td>{{ $data->course }}</td>
                                  <td>{{ $data->graduate_year }}</td>
                                </tr>
                              @endforeach
                            </table>

                            @if(Auth::user()->employee->employeeEducationalBackground->isEmpty())
                              <div style="padding :5px;">
                                <center><h4>No Records found!</h4></center>
                              </div>
                            @endif

                          </div>
                        </div>
                      </div>
                    </div>





                    {{-- Trainings --}}
                    <div class="col-md-12">
                      <div class="panel box box-default">
                        <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#trng_bar">
                          <h4 class="box-title">
                            <span>
                              Trainings
                            </span>
                          </h4>
                        </div>
                        <div id="trng_bar" class="panel-collapse collapse">
                          <div class="box-body">

                            <table class="table table-bordered">
                              <tr>
                                <th>Topics</th>
                                <th>Conducted by</th>
                                <th>Date</th>
                                <th>Venue</th>
                              </tr>
                              @foreach(Auth::user()->employee->employeeTraining as $data) 
                                <tr>
                                  <td>{{ $data->title }}</td>
                                  <td>{{ $data->conducted_by }}</td>
                                  <td>
                                    @if(__dataType::date_parse($data->date_from, 'M') == __dataType::date_parse($data->date_to, 'M'))
                                      
                                      {{ __dataType::date_parse($data->date_from, 'M d') .' - '. __dataType::date_parse($data->date_to, 'd, Y') }}  

                                    @else

                                      {{ __dataType::date_parse($data->date_from, 'M d, Y') .' - '. __dataType::date_parse($data->date_to, 'M d, Y') }}

                                    @endif
                                  </td>
                                  <td>{{ $data->venue }}</td>
                                </tr>
                              @endforeach
                            </table>

                            @if(Auth::user()->employee->employeeTraining->isEmpty())
                              <div style="padding :5px;">
                                <center><h4>No Records found!</h4></center>
                              </div>
                            @endif

                          </div>
                        </div>
                      </div>
                    </div>





                    {{-- Eligibilities --}}
                    <div class="col-md-12">
                      <div class="panel box box-default">
                        <div class="box-header with-border" data-toggle="collapse" data-parent="#accordion" href="#elig_bar">
                          <h4 class="box-title">
                            <span>
                              Eligibilities
                            </span>
                          </h4>
                        </div>
                        <div id="elig_bar" class="panel-collapse collapse">
                          <div class="box-body">

                            <table class="table table-bordered">
                              <tr>
                                <th>Eligibility</th>
                                <th>Level</th>
                                <th>Rating</th>
                              </tr>
                              @foreach(Auth::user()->employee->employeeEligibility as $data)
                                <tr>
                                  <td>{{ $data->eligibility }}</td>
                                  <td>{{ $data->level }}</td>
                                  <td>{{ $data->rating }}</td>
                                </tr>
                              @endforeach
                            </table>

                            @if(Auth::user()->employee->employeeEligibility->isEmpty())
                              <div style="padding :5px;">
                                <center><h4>No Records found!</h4></center>
                              </div>
                            @endif

                          </div>
                        </div>
                      </div>
                    </div>



                  @endif



                </div>
              </div>





            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</section>

@endsection






@section('scripts')

  <script type="text/javascript">
    
    {!! __js::show_password('old_password', 'show_old_password') !!}
    {!! __js::show_password('password', 'show_password') !!}
    {!! __js::show_password('password_confirmation', 'show_password_confirmation') !!}

    {{-- PROFILE ACCOUNT COLOR SUCCESS --}}
    @if(Session::has('PROFILE_UPDATE_COLOR_SUCCESS'))
      {!! __js::toast(Session::get('PROFILE_UPDATE_COLOR_SUCCESS')) !!}
    @endif

  </script>
  
@endsection