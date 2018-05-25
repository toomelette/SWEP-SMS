@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Employee Details</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! HtmlHelper::back_button(['dashboard.employee.index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Details</h3>
        <div class="box-tools">
          <a href="{{ route('dashboard.employee.edit', $employee->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
        </div>
      </div>

      
      <div class="box-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#p_info" data-toggle="tab">Personal Info</a></li>
            <li><a href="#eb" data-toggle="tab">Educational Background</a></li>
            <li><a href="#train" data-toggle="tab">Trainings</a></li>
            <li><a href="#emp_details" data-toggle="tab">Employee Details</a></li>
            <li><a href="#p_id" data-toggle="tab">Personal ID's</a></li>
          </ul>
          <div class="tab-content">


            {{-- PERSONAL INFO --}}
            <div class="tab-pane active" id="p_info">
              
              <div class="row">
                 
                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Fullname:<strong> {{ $employee->empname }}</strong></span>
                </div> 

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Address:<strong> {{ $employee->address }}</strong></span>
                </div> 

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Date of Birth:<strong> {{ Carbon::parse($employee->dob)->format('M d, Y') }}</strong></span>
                </div> 

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Place of Birth:<strong> {{ $employee->pob }}</strong></span>
                </div> 

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Gender:<strong> {{ $employee->gender }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Civil Status:<strong> {{ $employee->civilstat }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Blood Type:<strong> {{ $employee->bloodtype }}</strong></span>
                </div>

              </div>
                

            </div>


            {{-- EDUCATIONAL BACKGROUND --}}
            <div class="tab-pane" id="eb">
                
              <div class="row">

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">UnderGrad: <strong> {{ $employee->undergrad }}</strong></span>
                </div> 

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">College: <strong> {{ $employee->graduate1 }}</strong></span>
                </div> 

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Masteral: <strong> {{ $employee->graduate2 }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">PHD: <strong> {{ $employee->postgrad1 }}</strong></span>
                </div>

              </div>

            </div>  


            {{-- TRAININGS --}}
            <div class="tab-pane" id="train">
                
              <table class="table table-bordered">

                <tr>
                  <th>Topics</th>
                  <th>Conducted by</th>
                  <th>Date</th>
                  <th>Venue</th>
                  <th>Hours</th>
                  <th>Remarks</th>
                </tr>
                @foreach($employee->employeeTraining()->populate() as $data) 
                  <tr>
                    <td>{{ $data->topics }}</td>
                    <td>{{ $data->conductedby }}</td>
                    <td>
                      @if(Carbon::parse($data->datefrom)->format('M') == Carbon::parse($data->dateto)->format('M'))
                        
                        {{ Carbon::parse($data->datefrom)->format('M d') .' - '. Carbon::parse($data->dateto)->format('d, Y') }}  

                      @else

                        {{ Carbon::parse($data->datefrom)->format('M d, Y') .' - '. Carbon::parse($data->dateto)->format('M d, Y') }}

                      @endif
                    </td>
                    <td>{{ $data->venue }}</td>
                    <td>{{ $data->hours }}</td>
                    <td>{{ $data->remarks }}</td>
                  </tr>
                @endforeach

              </table>

              @if(count($employee->employeeTraining()->populate()) == 0)
                <div style="padding :5px;">
                  <center><h4>No Trainings found!</h4></center>
                </div>
              @endif

            </div>


            {{-- TRAININGS --}}
            <div class="tab-pane" id="emp_details">
              
              <div class="row">

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Position: <strong> {{ $employee->position }}</strong></span>
                </div> 

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Salary Grade: <strong> {{ $employee->salgrade }}</strong></span>
                </div> 

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Step Increment: <strong> {{ $employee->stepinc }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Appointment Status: <strong> {{ $employee->apptstat }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Item No: <strong> {{ $employee->itemno }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Monthly Basic: <strong> {{ number_format($employee->monthlybasic, 2) }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">ACA: <strong> {{ number_format($employee->aca, 2) }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">PERA:<strong> {{ number_format($employee->pera, 2) }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Food Subsidy: <strong> {{ number_format($employee->foodsubsi, 2) }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">RA: <strong> {{ number_format($employee->allow1, 2) }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">TA: <strong> {{ number_format($employee->allow2, 2) }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Government Service: <strong> {!! $employee->govserv == '' ? '' : Carbon::parse($employee->govserv)->format('M d, Y') !!} </strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">First Day:<strong> {{ Carbon::parse($employee->firstday)->format('M d, Y') }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Appointment Date: <strong> {{ Carbon::parse($employee->apptdate)->format('M d, Y') }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">Adjustment Date: <strong> {{ Carbon::parse($employee->adjdate)->format('M d, Y') }}</strong></span>
                </div>

              </div>

            </div>


            {{-- TRAININGS --}}
            <div class="tab-pane" id="p_id">
              
              <div class="row">

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">PHIC: <strong> {{ $employee->phic }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">TIN: <strong> {{ $employee->tin }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">HDMF: <strong> {{ $employee->hdmf }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">GSIS: <strong> {{ $employee->gsis }}</strong></span>
                </div>

                <div class="col-md-12" style="padding-bottom:10px;">
                  <span style="font-size: 15px; ">HDMF Premium: <strong>{{ number_format($employee->hdmfpremiums, 2) }}</strong></span>
                </div>

              </div>

            </div>


          </div>
        </div>
      </div>


    </div>

</section>

@endsection

