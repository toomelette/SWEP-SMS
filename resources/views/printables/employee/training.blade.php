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

  <div class="wrapper" style="margin-right:100px;">

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

    <div class="row" style="padding:10px; margin-bottom: 20px;">
      <div class="col-md-1"></div>
      <div class="col-md-12">
          <div class="col-sm-2"></div>
          <div class="col-sm-2" style="text-align: center;">
            <img src="{{ asset('images/sra.png') }}" style="width:110px;">
          </div>
          <div class="col-sm-5" style="text-align: center; padding-right:125px;">
            <span style="font-size:13px;">Republic of the Philippines</span><br>
            <span style="font-size:13px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
            <span style="font-size:13px;">North Avenue, Diliman, Quezon City</span><br>
            <span style="font-size:13px; font-weight:bold;">LIST OF SEMINARS AND TRAININGS ATTENDED</span><br>
            <span>
              @if (Request::get('df') || Request::get('dt'))
                As of {{ __dataType::date_parse(Request::get('df'), 'F d, Y') }} to {{ __dataType::date_parse(Request::get('dt'), 'F d, Y') }} 
              @endif
            </span>
          </div>
          <div class="col-sm-3"></div>
      </div>
      <div class="col-md-1"></div>
    </div>


    <div class="row">
      <div class="col-sm-1">
        <span style="font-size:12px;">NAME:</span>
      </div>
      <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
        <span style="font-weight: bold; font-size:13px;">{{ $employee->lastname }}</span>
      </div>
      <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
        <span style="font-weight: bold; font-size:13px;">{{ $employee->firstname }}</span>
      </div>
      <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
        <span style="font-weight: bold; font-size:13px;">{{ $employee->middlename }}</span>
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
      @if($key <= 14)
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












  {{-- if records are greater than 15 --}}

  @if(count($employee_trainings) > 15)

    <div class="wrapper" style="overflow:hidden !important; margin-right: 100px;">

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

    <div class="row" style="padding:10px; margin-bottom: 20px;">
      <div class="col-md-1"></div>
      <div class="col-md-12">
          <div class="col-sm-2"></div>
          <div class="col-sm-2" style="text-align: center;">
            <img src="{{ asset('images/sra.png') }}" style="width:110px;">
          </div>
          <div class="col-sm-5" style="text-align: center; padding-right:125px;">
            <span style="font-size:13px;">Republic of the Philippines</span><br>
            <span style="font-size:13px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
            <span style="font-size:13px;">North Avenue, Diliman, Quezon City</span><br>
            <span style="font-size:13px; font-weight:bold;">LIST OF SEMINARS AND TRAININGS ATTENDED</span><br>
            <span>
              @if (Request::get('df') || Request::get('dt'))
                As of {{ __dataType::date_parse(Request::get('df'), 'F d, Y') }} to {{ __dataType::date_parse(Request::get('dt'), 'F d, Y') }} 
              @endif
            </span>
          </div>
          <div class="col-sm-3"></div>
      </div>
      <div class="col-md-1"></div>
    </div>


      <div class="row">
        <div class="col-sm-1">
          <span style="font-size:12px;">NAME:</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->lastname }}</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->firstname }}</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->middlename }}</span>
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
        @if($key > 14 && $key <= 29)
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







   {{-- if records are greater than 30 --}}

  @if(count($employee_trainings) > 30)

    <div class="wrapper" style="overflow:hidden !important; margin-right: 100px;">

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

    <div class="row" style="padding:10px; margin-bottom: 20px;">
      <div class="col-md-1"></div>
      <div class="col-md-12">
          <div class="col-sm-2"></div>
          <div class="col-sm-2" style="text-align: center;">
            <img src="{{ asset('images/sra.png') }}" style="width:110px;">
          </div>
          <div class="col-sm-5" style="text-align: center; padding-right:125px;">
            <span style="font-size:13px;">Republic of the Philippines</span><br>
            <span style="font-size:13px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
            <span style="font-size:13px;">North Avenue, Diliman, Quezon City</span><br>
            <span style="font-size:13px; font-weight:bold;">LIST OF SEMINARS AND TRAININGS ATTENDED</span><br>
            <span>
              @if (Request::get('df') || Request::get('dt'))
                As of {{ __dataType::date_parse(Request::get('df'), 'F d, Y') }} to {{ __dataType::date_parse(Request::get('dt'), 'F d, Y') }} 
              @endif
            </span>
          </div>
          <div class="col-sm-3"></div>
      </div>
      <div class="col-md-1"></div>
    </div>


      <div class="row">
        <div class="col-sm-1">
          <span style="font-size:12px;">NAME:</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->lastname }}</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->firstname }}</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->middlename }}</span>
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
        @if($key > 29 && $key <= 44)
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








  {{-- if records are greater than 45 --}}

  @if(count($employee_trainings) > 45)

    <div class="wrapper" style="overflow:hidden !important; margin-right: 100px;">

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

    <div class="row" style="padding:10px; margin-bottom: 20px;">
      <div class="col-md-1"></div>
      <div class="col-md-12">
          <div class="col-sm-2"></div>
          <div class="col-sm-2" style="text-align: center;">
            <img src="{{ asset('images/sra.png') }}" style="width:110px;">
          </div>
          <div class="col-sm-5" style="text-align: center; padding-right:125px;">
            <span style="font-size:13px;">Republic of the Philippines</span><br>
            <span style="font-size:13px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
            <span style="font-size:13px;">North Avenue, Diliman, Quezon City</span><br>
            <span style="font-size:13px; font-weight:bold;">LIST OF SEMINARS AND TRAININGS ATTENDED</span><br>
            <span>
              @if (Request::get('df') || Request::get('dt'))
                As of {{ __dataType::date_parse(Request::get('df'), 'F d, Y') }} to {{ __dataType::date_parse(Request::get('dt'), 'F d, Y') }} 
              @endif
            </span>
          </div>
          <div class="col-sm-3"></div>
      </div>
      <div class="col-md-1"></div>
    </div>


      <div class="row">
        <div class="col-sm-1">
          <span style="font-size:12px;">NAME:</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->lastname }}</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->firstname }}</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->middlename }}</span>
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
        @if($key > 44 && $key <= 59)
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








  {{-- if records are greater than 60 --}}

  @if(count($employee_trainings) > 60)

    <div class="wrapper" style="overflow:hidden !important; margin-right: 100px;">

    <div class="row">
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; font-weight: bold;">EMPLOYEE NO: {{ $employee->employee_no }}</span><br>
        <div style="width:7em;"></div>
        <p style="font-size: 11px; font-weight: bold;">&nbsp;</p>
      </div>
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; float:right;">Page 5</span>
      </div>
    </div>

    <div class="row" style="padding:10px; margin-bottom: 20px;">
      <div class="col-md-1"></div>
      <div class="col-md-12">
          <div class="col-sm-2"></div>
          <div class="col-sm-2" style="text-align: center;">
            <img src="{{ asset('images/sra.png') }}" style="width:110px;">
          </div>
          <div class="col-sm-5" style="text-align: center; padding-right:125px;">
            <span style="font-size:13px;">Republic of the Philippines</span><br>
            <span style="font-size:13px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
            <span style="font-size:13px;">North Avenue, Diliman, Quezon City</span><br>
            <span style="font-size:13px; font-weight:bold;">LIST OF SEMINARS AND TRAININGS ATTENDED</span><br>
            <span>
              @if (Request::get('df') || Request::get('dt'))
                As of {{ __dataType::date_parse(Request::get('df'), 'F d, Y') }} to {{ __dataType::date_parse(Request::get('dt'), 'F d, Y') }} 
              @endif
            </span>
          </div>
          <div class="col-sm-3"></div>
      </div>
      <div class="col-md-1"></div>
    </div>


      <div class="row">
        <div class="col-sm-1">
          <span style="font-size:12px;">NAME:</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->lastname }}</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->firstname }}</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->middlename }}</span>
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
        @if($key > 59 && $key <= 74)
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

  @if(count($employee_trainings) > 75)

    <div class="wrapper" style="overflow:hidden !important; margin-right: 100px;">

    <div class="row">
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; font-weight: bold;">EMPLOYEE NO: {{ $employee->employee_no }}</span><br>
        <div style="width:7em;"></div>
        <p style="font-size: 11px; font-weight: bold;">&nbsp;</p>
      </div>
      <div class="col-sm-6" style="margin-bottom: -20px;">
        <span style="font-size: 11px; float:right;">Page 6</span>
      </div>
    </div>

    <div class="row" style="padding:10px; margin-bottom: 20px;">
      <div class="col-md-1"></div>
      <div class="col-md-12">
          <div class="col-sm-2"></div>
          <div class="col-sm-2" style="text-align: center;">
            <img src="{{ asset('images/sra.png') }}" style="width:110px;">
          </div>
          <div class="col-sm-5" style="text-align: center; padding-right:125px;">
            <span style="font-size:13px;">Republic of the Philippines</span><br>
            <span style="font-size:13px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
            <span style="font-size:13px;">North Avenue, Diliman, Quezon City</span><br>
            <span style="font-size:13px; font-weight:bold;">LIST OF SEMINARS AND TRAININGS ATTENDED</span><br>
            <span>
              @if (Request::get('df') || Request::get('dt'))
                As of {{ __dataType::date_parse(Request::get('df'), 'F d, Y') }} to {{ __dataType::date_parse(Request::get('dt'), 'F d, Y') }} 
              @endif
            </span>
          </div>
          <div class="col-sm-3"></div>
      </div>
      <div class="col-md-1"></div>
    </div>


      <div class="row">
        <div class="col-sm-1">
          <span style="font-size:12px;">NAME:</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->lastname }}</span>
        </div>
        <div class="col-sm-4 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->firstname }}</span>
        </div>
        <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 10px;">
          <span style="font-weight: bold; font-size:13px;">{{ $employee->middlename }}</span>
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
        @if($key > 74 && $key <= 89)
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

