<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LIST OF APPLICANTS</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/print.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

    <style type="text/css">

        @media print {
            .footer {
                page-break-after: always;
            }
        }

        table, td {

            border: 1px solid black;

        }

        thead{

            -webkit-print-color-adjust: exact;
            background-color: #65D165 !important;

        }

        .data-row-head{

            text-align: center;
            padding:5px;
            font-size:11px;
            font-weight: bold;

        }

        .data-row-body{

            text-align: center;
            padding:5px;
            font-size:9px;

        }

    </style>

</head>

<body onload="window.print();" onafterprint="window.close()" >
    @if(count($positions) > 0)
        @foreach($positions  as $position_title => $position)
            <div style="break-after: page">
                <div class="row" >

                    <div class="col-sm-2"></div>


                    <div class="col-sm-8">

                        <div class="col-sm-2"></div>

                        <div class="col-sm-1 no-padding">
                            <img src="{{ asset('images/sra.png') }}" style="width:100%;">
                        </div>

                        <div class="col-sm-8" style="text-align: center; padding-right:125px;">
                            <span>Republic of the Philippines</span><br>
                            <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
                            <span>North Avenue, Diliman, Quezon City</span>
                        </div>

                    </div>


                    <div class="col-sm-2"></div>


                    <div class="col-sm-12" style="padding-bottom:10px;"></div>
                    <div class="col-sm-12" style="text-align: center; padding-bottom:10px;">
                  <span style="font-weight: bold;">List of Applicants for {{strtoupper($position_title)}}
                  </span>
                    </div>

                </div>

                <br>

                <table style="border:solid 1px;">

                    <thead>

                    <td class="data-row-head">No.</td>
                    <td class="data-row-head" style="width:50px;">Date Received</td>
                    <td class="data-row-head" style="width:150px;">Name</td>
                    <td class="data-row-head" style="width:150px;">Address</td>
                    <td class="data-row-head">Civil Status</td>
                    <td class="data-row-head">Gender</td>
                    <td class="data-row-head">Age</td>
                    <td class="data-row-head">Birthdate</td>
                    <td class="data-row-head" style="width:80px;">Contact No.</td>
                    <td class="data-row-head" style="width:150px;">Eligibility</td>
                    <td class="data-row-head" style="width:150px;">Course</td>
                    <td class="data-row-head" style="width:150px;">School</td>
                    <td class="data-row-head" style="width:150px;">Work Experience</td>
                    <td class="data-row-head">Remarks</td>

                    </thead>



                    <tbody>
                        @php($num = 1)
                        @foreach ($position as $key=> $applicant)

                            <tr>
                                <td class="data-row-body">{{$num}}</td>
                                <td class="data-row-body">{{ __dataType::date_parse($applicant->applicant->received_at, "M d,Y")}}</td>
                                <td class="data-row-body">{{ $applicant->applicant->fullname }}</td>
                                <td class="data-row-body">{{ $applicant->applicant->address }}</td>
                                <td class="data-row-body">{{ $applicant->applicant->civil_status }}</td>
                                <td class="data-row-body">{{ $applicant->applicant->gender }}</td>
                                <td class="data-row-body">{{ Carbon::parse($applicant->applicant->date_of_birth)->age }}</td>
                                <td class="data-row-body">{{ __dataType::date_parse($applicant->applicant->date_of_birth, "F d,y") }}</td>
                                <td class="data-row-body" style="word-break: break-all;">{{ $applicant->applicant->contact_no }}</td>
                                <td style="padding:5px; font-size:9px;">
                                    @foreach ($applicant->applicant->applicantEligibility as $data_elig)
                                        &#8226; <b>{{ $data_elig->eligibility }}</b> - {{ $data_elig->rating }} <br>
                                    @endforeach
                                </td>
                                <td class="data-row-body">{{ !empty($applicant->applicant->course) ? $applicant->applicant->course->name : 'N/A' }}</td>
                                <td class="data-row-body">{{ $applicant->applicant->school }}</td>
                                <td style="padding:5px; font-size:9px;">
                                    @foreach ($applicant->applicant->applicantExperience as $data_exp)
                                        &#8226; <b>{{ $data_exp->position }}</b> - {{ $data_exp->company }}.
                                        ({{ __dataType::date_parse($data_exp->date_from, "M d,Y")}} -
                                        {{ __dataType::date_parse($data_exp->date_to, "M d,Y")}})<br>
                                    @endforeach
                                </td>
                                <td class="data-row-body">{{ $applicant->applicant->remarks }}</td>
                            </tr>
                            @php($num++)
                        @endforeach

                    </tbody>



                </table>
            </div>
        @endforeach
    @endif
</body>
