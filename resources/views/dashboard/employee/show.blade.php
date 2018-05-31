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


        {{-- Personal Info --}}
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Info</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Fullname:</dt>
                <dd>{{ $employee->empname }}</dd>
                <dt>Address:</dt>
                <dd>{{ $employee->address }}</dd>
                <dt>Date of Birth:</dt>
                <dd>{{ Carbon::parse($employee->dob)->format('M d, Y') }}</dd>
                <dt>Place of Birth:</dt>
                <dd>{{ $employee->pob }}</dd>
                <dt>Gender:</dt>
                <dd>{{ $employee->gender }}</dd>
                <dt>Civil Status:</dt>
                <dd>{{ $employee->civilstat }}</dd>
                <dt>Blood Type:</dt>
                <dd>{{ $employee->bloodtype }}</dd>
              </dl>
            </div>
          </div>
        </div>



        {{-- Edc Background --}}
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Educational Background</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal" style="padding-bottom:22px;">
                <dt>UnderGrad:</dt>
                <dd>{{ $employee->undergrad }}</dd>
                <dt>College:</dt>
                <dd>{{ $employee->graduate1 }}</dd>
                <dt>Masteral:</dt>
                <dd>{{ $employee->graduate2 }}</dd>
                <dt>PHD:</dt>
                <dd>{{ $employee->postgrad1 }}</dd>
                <dt>Eligibility:</dt>
                <dd>{{ $employee->eligibility }}</dd>
                <dt>Eligibility Level:</dt>
                <dd>{{ $employee->eligibilitylevel }}</dd>
              </dl>
            </div>
          </div>
        </div>



        {{-- Emp Details --}}
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Details</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Employee No:</dt>
                <dd>{{ $employee->empno }}</dd>
                <dt>Status:</dt>
                <dd>{{ $employee->active }}</dd>
                <dt>Position:</dt>
                <dd>{{ $employee->position }}</dd>
                <dt>Salary Grade:</dt>
                <dd>{{ $employee->salgrade }}</dd>
                <dt>Step Increment:</dt>
                <dd>{{ $employee->stepinc }}</dd>
                <dt>Appointment Status:</dt>
                <dd>{{ $employee->apptstat }}</dd>
                <dt>Item No:</dt>
                <dd>{{ $employee->itemno }}</dd>
                <dt>Monthly Basic:</dt>
                <dd>{{ number_format($employee->monthlybasic, 2) }}</dd>
                <dt>ACA:</dt>
                <dd>{{ number_format($employee->aca, 2) }}</dd>
                <dt>PERA:</dt>
                <dd>{{ number_format($employee->pera, 2) }}</dd>
                <dt>Food Subsidy:</dt>
                <dd>{{ number_format($employee->foodsubsi, 2) }}</dd>
                <dt>RA:</dt>
                <dd>{{ number_format($employee->allow1, 2) }}</dd>
                <dt>TA:</dt>
                <dd>{{ number_format($employee->allow2, 2) }}</dd>
                <dt>Government Service:</dt>
                <dd>{!! $employee->govserv == '' ? '' : Carbon::parse($employee->govserv)->format('M d, Y') !!}</dd>
                <dt>First Day:</dt>
                <dd>{{ Carbon::parse($employee->firstday)->format('M d, Y') }}</dd>
                <dt>Appointment Date:</dt>
                <dd>{{ Carbon::parse($employee->apptdate)->format('M d, Y') }}</dd>
                <dt>Adjustment Date:</dt>
                <dd>{{ Carbon::parse($employee->adjdate)->format('M d, Y') }}</dd>
              </dl>
            </div>
          </div>
        </div>




        {{-- ID's --}}
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Personal ID's</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal" style="padding-bottom:240px;">
                <dt>PHIC:</dt>
                <dd>{{ $employee->phic }}</dd>
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




        {{-- Trainings --}}
         <div class="col-md-12">
          <div class="box">
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
                  </tr>
                @endforeach

              </table>

              @if(count($employee->employeeTraining()->populate()) == 0)
                <div style="padding :5px;">
                  <center><h4>No Trainings found!</h4></center>
                </div>
              @endif

            </div>

          </div>
        </div>




      </div>

    </div>

</section>

@endsection

