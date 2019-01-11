<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Seminars and Trainings</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">

    .box-d-grey{
      -webkit-print-color-adjust: exact; 
      background-color: #a7aaab !important;
    }

    .box-l-grey{
      -webkit-print-color-adjust: exact; 
      background-color: #e8e8e8 !important;
    }

    .title-l{
      -webkit-print-color-adjust: exact; 
      color: #ffffff !important;
      font-style:italic; 
      font-size: 13px;
      font-weight: bold;
    }

    @media print {
        .footer {
          page-break-after: always;
        }
    }

  </style>

</head>
<body onload="window.print();" onafterprint="window.close()">

  <div class="wrapper" style="overflow:hidden !important;">

    {{-- HEADER --}}

    <div class="row">
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; font-weight: bold;">EMPLOYEE NO: {{ $employee->employee_no }}</span><br>
        <div style="width:7em;"></div>
        <p style="font-size: 11px; font-weight: bold;">&nbsp;</p>
      </div>
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; float:right;">Page 1</span>
      </div>
    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10" style="text-align: center;">
        <span style="font-weight:bold; font-size:28px;">SEMINARS / TRAININGS</span><br>
        <br>
      </div>
      <div class="col-md-1"></div>
    </div>


    <div class="row">
      <div class="col-sm-1">
        <span style="font-size:13px;">NAME:</span>
      </div>
      <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
        <span style="font-weight: bold; font-size:15px;">{{ $employee->lastname }}</span>
      </div>
      <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
        <span style="font-weight: bold; font-size:15px;">{{ $employee->firstname }}</span>
      </div>
      <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
        <span style="font-weight: bold; font-size:15px;">{{ $employee->middlename }}</span>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-1">
        &nbsp;
      </div>
      <div class="col-sm-3 no-padding" style="margin-right: 10px; text-align: center;">
        <span style="font-size:10px;">Surname</span>
      </div>
      <div class="col-sm-4 no-padding" style="margin-right: 10px; text-align: center;">
        <span style="font-size:10px;">Given Name</span>
      </div>
      <div class="col-sm-3 no-padding" style="margin-right: 10px; text-align: center;">
        <span style="font-size:10px;">Middle name</span>
      </div>
    </div>

    <br>

    <div class="row" style="margin:0px;">
      <div class="col-sm-12 no-padding" style="border:solid 1px;">

        <div class="col-sm-4 no-padding">
          <span style="font-size:12px; font-weight:bold; margin-left: 170px;">TITLE</span>
        </div>

        <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
          <span style="font-size:12px; font-weight:bold; margin-left: 20px;">Date From</span>
        </div>

        <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
          <span style="font-size:12px; font-weight:bold; margin-left: 25px;">Date To</span>
        </div>

        <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
          <span style="font-size:12px; font-weight:bold; margin-left: 30px;">Hours</span>
        </div>

        <div class="col-sm-2 no-padding" style="border-left:solid 1px;">
          <span style="font-size:12px; font-weight:bold; margin-left: 60px;">Conducted By</span>
        </div>

        <div class="col-sm-3 no-padding" style="border-left:solid 1px;">
          <span style="font-size:11px; font-weight:bold; margin-left: 140px;">Venue</span>
        </div>

      </div>
    </div>


    @foreach ($employee_trainings as $key => $data)
      @if($key <= 19)
        <div class="row">
          <div class="col-sm-12 no-padding" style="line-height:13.5px;">

            <div class="col-sm-4">
              <span style="font-size:10px;">{{ $data->title }}</span>
            </div>

            <div class="col-sm-1">
              <span style="font-size:10px;">{{ __dataType::date_parse($data->date_from, 'm/d/Y') }}</span>
            </div>

            <div class="col-sm-1">
              <span style="font-size:10px;">{{ __dataType::date_parse($data->date_to, 'm/d/Y') }}</span>
            </div>

            <div class="col-sm-1 no-padding" style="text-align: center;">
              <span style="font-size:10px;">{{ $data->hours }}</span>
            </div>

            <div class="col-sm-2 no-padding">
              <span style="font-size:10px;">{{ $data->conducted_by }}</span>
            </div>

            <div class="col-sm-3 no-padding">
              <span style="font-size:10px;">{{ $data->venue }}</span>
            </div>

          </div>
        </div>
      @endif
    @endforeach
    <div style="border-bottom:solid 1px;"></div>
  </div>












  {{-- if records are greater than 25 --}}

  @if(count($employee_trainings) > 20)

    <div class="row">
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; font-weight: bold;">EMPLOYEE NO: {{ $employee->employee_no }}</span><br>
        <div style="width:7em;"></div>
        <p style="font-size: 11px; font-weight: bold;">&nbsp;</p>
      </div>
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; float:right;">Page 2</span>
      </div>
    </div>

    <div class="wrapper" style="overflow:hidden !important;">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="text-align: center;">
          <span style="font-weight:bold; font-size:28px;">SEMINARS / TRAININGS</span><br>
          <br>
        </div>
        <div class="col-md-1"></div>
      </div>


      <div class="row">
        <div class="col-sm-1">
          <span style="font-size:13px;">NAME:</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->lastname }}</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->firstname }}</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->middlename }}</span>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-1">
          &nbsp;
        </div>
        <div class="col-sm-3 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Surname</span>
        </div>
        <div class="col-sm-4 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Given Name</span>
        </div>
        <div class="col-sm-3 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Middle name</span>
        </div>
      </div>

      <br>

      <div class="row" style="margin:0px;">
        <div class="col-sm-12 no-padding" style="border:solid 1px;">

          <div class="col-sm-4 no-padding">
            <span style="font-size:12px; font-weight:bold; margin-left: 170px;">TITLE</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 20px;">Date From</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 25px;">Date To</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 30px;">Hours</span>
          </div>

          <div class="col-sm-2 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 60px;">Conducted By</span>
          </div>

          <div class="col-sm-3 no-padding" style="border-left:solid 1px;">
            <span style="font-size:11px; font-weight:bold; margin-left: 140px;">Venue</span>
          </div>

        </div>
      </div>


      @foreach ($employee_trainings as $key => $data)
        @if($key > 19 && $key <= 39)
          <div class="row">
            <div class="col-sm-12 no-padding" style="line-height:13.5px;">

              <div class="col-sm-4">
                <span style="font-size:10px;">{{ $data->title }}</span>
              </div>

              <div class="col-sm-1">
                <span style="font-size:10px;">{{ __dataType::date_parse($data->date_from, 'm/d/Y') }}</span>
              </div>

              <div class="col-sm-1">
                <span style="font-size:10px;">{{ __dataType::date_parse($data->date_to, 'm/d/Y') }}</span>
              </div>

              <div class="col-sm-1 no-padding" style="text-align: center;">
                <span style="font-size:10px;">{{ $data->hours }}</span>
              </div>

              <div class="col-sm-2 no-padding" style="">
                <span style="font-size:10px;">{{ $data->conducted_by }}</span>
              </div>

              <div class="col-sm-3 no-padding" style="">
                <span style="font-size:10px;">{{ $data->venue }}</span>
              </div>

            </div>
          </div>
        @endif
      @endforeach
      <div style="border-bottom:solid 1px;"></div>
    </div>
  @endif







   {{-- if records are greater than 50 --}}

  @if(count($employee_trainings) > 40)

    <div class="row">
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; font-weight: bold;">EMPLOYEE NO: {{ $employee->employee_no }}</span><br>
        <div style="width:7em;"></div>
        <p style="font-size: 11px; font-weight: bold;">&nbsp;</p>
      </div>
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; float:right;">Page 3</span>
      </div>
    </div>

    <div class="wrapper" style="overflow:hidden !important;">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="text-align: center;">
          <span style="font-weight:bold; font-size:28px;">SEMINARS / TRAININGS</span><br>
          <br>
        </div>
        <div class="col-md-1"></div>
      </div>


      <div class="row">
        <div class="col-sm-1">
          <span style="font-size:13px;">NAME:</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->lastname }}</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->firstname }}</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->middlename }}</span>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-1">
          &nbsp;
        </div>
        <div class="col-sm-3 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Surname</span>
        </div>
        <div class="col-sm-4 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Given Name</span>
        </div>
        <div class="col-sm-3 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Middle name</span>
        </div>
      </div>

      <br>

      <div class="row" style="margin:0px;">
        <div class="col-sm-12 no-padding" style="border:solid 1px;">

          <div class="col-sm-4 no-padding">
            <span style="font-size:12px; font-weight:bold; margin-left: 170px;">TITLE</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 20px;">Date From</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 25px;">Date To</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 30px;">Hours</span>
          </div>

          <div class="col-sm-2 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 60px;">Conducted By</span>
          </div>

          <div class="col-sm-3 no-padding" style="border-left:solid 1px;">
            <span style="font-size:11px; font-weight:bold; margin-left: 140px;">Venue</span>
          </div>

        </div>
      </div>


      @foreach ($employee_trainings as $key => $data)
        @if($key > 39 && $key <= 59)
          <div class="row">
            <div class="col-sm-12 no-padding" style="line-height:13.5px;">

              <div class="col-sm-4">
                <span style="font-size:10px;">{{ $data->title }}</span>
              </div>

              <div class="col-sm-1">
                <span style="font-size:10px;">{{ __dataType::date_parse($data->date_from, 'm/d/Y') }}</span>
              </div>

              <div class="col-sm-1">
                <span style="font-size:10px;">{{ __dataType::date_parse($data->date_to, 'm/d/Y') }}</span>
              </div>

              <div class="col-sm-1 no-padding" style="text-align: center;">
                <span style="font-size:10px;">{{ $data->hours }}</span>
              </div>

              <div class="col-sm-2 no-padding" style="">
                <span style="font-size:10px;">{{ $data->conducted_by }}</span>
              </div>

              <div class="col-sm-3 no-padding" style="">
                <span style="font-size:10px;">{{ $data->venue }}</span>
              </div>

            </div>
          </div>
        @endif
      @endforeach
      <div style="border-bottom:solid 1px;"></div>
    </div>
  @endif








  {{-- if records are greater than 75 --}}

  @if(count($employee_trainings) > 60)

    <div class="row">
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; font-weight: bold;">EMPLOYEE NO: {{ $employee->employee_no }}</span><br>
        <div style="width:7em;"></div>
        <p style="font-size: 11px; font-weight: bold;">&nbsp;</p>
      </div>
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; float:right;">Page 4</span>
      </div>
    </div>

    <div class="wrapper" style="overflow:hidden !important;">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="text-align: center;">
          <span style="font-weight:bold; font-size:28px;">SEMINARS / TRAININGS</span><br>
          <br>
        </div>
        <div class="col-md-1"></div>
      </div>


      <div class="row">
        <div class="col-sm-1">
          <span style="font-size:13px;">NAME:</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->lastname }}</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->firstname }}</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:15px;">{{ $employee->middlename }}</span>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-1">
          &nbsp;
        </div>
        <div class="col-sm-3 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Surname</span>
        </div>
        <div class="col-sm-4 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Given Name</span>
        </div>
        <div class="col-sm-3 no-padding" style="margin-right: 10px; text-align: center;">
          <span style="font-size:10px;">Middle name</span>
        </div>
      </div>

      <br>

      <div class="row" style="margin:0px;">
        <div class="col-sm-12 no-padding" style="border:solid 1px;">

          <div class="col-sm-4 no-padding">
            <span style="font-size:12px; font-weight:bold; margin-left: 170px;">TITLE</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 20px;">Date From</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 25px;">Date To</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 30px;">Hours</span>
          </div>

          <div class="col-sm-2 no-padding" style="border-left:solid 1px;">
            <span style="font-size:12px; font-weight:bold; margin-left: 60px;">Conducted By</span>
          </div>

          <div class="col-sm-3 no-padding" style="border-left:solid 1px;">
            <span style="font-size:11px; font-weight:bold; margin-left: 140px;">Venue</span>
          </div>

        </div>
      </div>


      @foreach ($employee_trainings as $key => $data)
        @if($key > 59 && $key <= 79)
          <div class="row">
            <div class="col-sm-12 no-padding" style="line-height:13.5px;">

              <div class="col-sm-4">
                <span style="font-size:10px;">{{ $data->title }}</span>
              </div>

              <div class="col-sm-1">
                <span style="font-size:10px;">{{ __dataType::date_parse($data->date_from, 'm/d/Y') }}</span>
              </div>

              <div class="col-sm-1">
                <span style="font-size:10px;">{{ __dataType::date_parse($data->date_to, 'm/d/Y') }}</span>
              </div>

              <div class="col-sm-1 no-padding" style="text-align: center;">
                <span style="font-size:10px;">{{ $data->hours }}</span>
              </div>

              <div class="col-sm-2 no-padding" style="">
                <span style="font-size:10px;">{{ $data->conducted_by }}</span>
              </div>

              <div class="col-sm-3 no-padding" style="">
                <span style="font-size:10px;">{{ $data->venue }}</span>
              </div>

            </div>
          </div>
        @endif
      @endforeach
      <div style="border-bottom:solid 1px;"></div>
    </div>
  @endif





</body>
</html>

