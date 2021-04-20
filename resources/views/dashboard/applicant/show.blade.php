@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Applicant Details</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.applicant.index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        
        <h3 class="box-title">Details</h3>

        <div class="box-tools">
          <a href="{{ route('dashboard.applicant.edit', $applicant->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
        </div>

      </div>
      
      <div class="box-body">


        {{-- DOC Info --}}

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Applicant Info</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <dl class="dl-horizontal">
                    <dt>Applicant ID:</dt>
                    <dd>{{ $applicant->applicant_id }}</dd>
                    <dt>Fullname:</dt>
                    <dd>{{ $applicant->fullname }}</dd>
                    <dt>Gender:</dt>
                    <dd>{{ $applicant->gender }}</dd>
                    <dt>Date of Birth:</dt>
                    <dd>{{ __dataType::date_parse($applicant->date_of_birth, 'm/d/Y') }}</dd>
                    <dt>Age:</dt>
                    <dd>{{ Carbon::parse($applicant->date_of_birth)->age }}</dd>
                    <dt>Civil Status:</dt>
                    <dd>{{ $applicant->civil_status }}</dd>
                    <dt>Address:</dt>
                    <dd>{{ $applicant->address }}</dd>
                    <dt>Contact No:</dt>
                    <dd>{{ $applicant->contact_no }}</dd>
                    <dt>Course:</dt>
                    <dd>{{ empty($applicant->course) ? '' : $applicant->course->name }}</dd>
                    <dt>School:</dt>
                    <dd>{{ $applicant->school }}</dd>
                    <dt>Unit Applied:</dt>
                    <dd>{{ empty($applicant->departmentUnit) ? '' : $applicant->departmentUnit->description }}</dd>
        
                    <dt>Remarks:</dt>
                    <dd>{{ $applicant->remarks }}</dd>
                  </dl>
                </div>
                <div class="col-lg-6">
                  <p>Position Applied for:</p>
                  <ul>
                    @if(!empty($applicant->positionApplied))
                      @foreach($applicant->positionApplied as $positionApplied)
                        <li>{{$positionApplied->position_applied}}</li>
                      @endforeach
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>






        {{-- Educational Background --}}
         <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Educational Background</h3>
            </div>
            <div class="box-body" style="overflow-x:auto;">

              <table class="table table-bordered">

                <tr>
                  <th>Course</th>
                  <th>School</th>
                  <th>Units</th>
                  <th>Graduate Year</th>
                </tr>
                @foreach($applicant->applicantEducationalBackground as $data) 
                  <tr>
                    <td>{{ $data->course }}</td>
                    <td>{{ $data->school }}</td>
                    <td>{{ $data->units }}</td>
                    <td>{{ $data->graduate_year }}</td>
                  </tr>
                @endforeach

              </table>

              @if($applicant->applicantEducationalBackground->isEmpty())
                <div style="padding :5px;">
                  <center><h4>No Records found!</h4></center>
                </div>
              @endif

            </div>

          </div>
        </div>



        {{-- Trainings --}}
         <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Trainings</h3>
            </div>
            <div class="box-body" style="overflow-x:auto;">

              <table class="table table-bordered">

                <tr>
                  <th>Title</th>
                  <th>Date From</th>
                  <th>Date To</th>
                  <th>Venue</th>
                  <th>Conducted By</th>
                  <th>Remarks</th>
                </tr>
                @foreach($applicant->applicantTraining as $data) 
                  <tr>
                    <td>{{ $data->title }}</td>
                    <td>{{ __dataType::date_parse($data->date_from, 'F d, Y') }}</td>
                    <td>{{ __dataType::date_parse($data->date_to, 'F d, Y') }}</td>
                    <td>{{ $data->venue }}</td>
                    <td>{{ $data->conducted_by }}</td>
                    <td>{{ $data->remarks }}</td>
                  </tr>
                @endforeach

              </table>

              @if($applicant->applicantEducationalBackground->isEmpty())
                <div style="padding :5px;">
                  <center><h4>No Records found!</h4></center>
                </div>
              @endif

            </div>

          </div>
        </div>



        {{-- Experiences --}}
         <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Work Experiences</h3>
            </div>
            <div class="box-body" style="overflow-x:auto;">

              <table class="table table-bordered">

                <tr>
                  <th>Company</th>
                  <th>Position</th>
                  <th>Date From</th>
                  <th>Date To</th>
                </tr>
                @foreach($applicant->applicantExperience as $data) 
                  <tr>
                    <td>{{ $data->company }}</td>
                    <td>{{ $data->position }}</td>
                    <td>{{ __dataType::date_parse($data->date_from, 'F d, Y') }}</td>
                    <td>{{ __dataType::date_parse($data->date_to, 'F d, Y') }}</td>
                  </tr>
                @endforeach

              </table>

              @if($applicant->applicantEducationalBackground->isEmpty())
                <div style="padding :5px;">
                  <center><h4>No Records found!</h4></center>
                </div>
              @endif

            </div>

          </div>
        </div>



        {{-- Eligibilities --}}
         <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Work Experiences</h3>
            </div>
            <div class="box-body" style="overflow-x:auto;">

              <table class="table table-bordered">

                <tr>
                  <th>Eligibility</th>
                  <th>Level</th>
                  <th>Rating</th>
                  <th>Exam Place</th>
                  <th>Exam Date</th>
                </tr>
                @foreach($applicant->applicantEligibility as $data) 
                  <tr>
                    <td>{{ $data->eligibility }}</td>
                    <td>{{ $data->level }}</td>
                    <td>{{ $data->rating }}</td>
                    <td>{{ $data->exam_place }}</td>
                    <td>{{ __dataType::date_parse($data->exam_date, 'F d, Y') }}</td>
                  </tr>
                @endforeach

              </table>

              @if($applicant->applicantEligibility->isEmpty())
                <div style="padding :5px;">
                  <center><h4>No Records found!</h4></center>
                </div>
              @endif

            </div>

          </div>
        </div>




        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">User Modifications</h3>
            </div>
            <div class="box-body">

              <dl class="dl-horizontal col-sm-6">
                <dt>Date Created:</dt>
                <dd>{{ __dataType::date_parse($applicant->created_at, 'M d, Y h:i A') }}</dd>
                <dt>IP Created:</dt>
                <dd>{{ $applicant->ip_created }}</dd>
                <dt>User Created:</dt>
                <dd>{{ $applicant->user_created }}</dd>
              </dl>

              <dl class="dl-horizontal col-sm-6">
                <dt>Date Updated:</dt>
                <dd>{{ __dataType::date_parse($applicant->updated_at, 'M d, Y h:i A') }}</dd>
                <dt>IP Updated:</dt>
                <dd>{{ $applicant->ip_updated }}</dd>
                <dt>User Updated:</dt>
                <dd>{{ $applicant->user_updated }}</dd>
              </dl>

            </div>
          </div>
        </div> 




    </div>
  </div>

</section>

@endsection

