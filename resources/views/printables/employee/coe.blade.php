<html>
<head>
    <style>
        body{
            font-family: Cambria !important;
        }

        .edit_form{
            margin-bottom: 0px;
        }

    </style>
    <link type="text/css" rel="stylesheet" href="{{asset('css/print.css')}}?rand={{\Illuminate\Support\Str::random()}}">
    <script type="text/javascript" src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <title>
        CERTIFICATE OF EMPLOYMENT
    </title>
</head>
<body style="padding-top: 175px; ">

    <p class="text-right">{{\Illuminate\Support\Carbon::now()->format('F d, Y')}}</p>

    <p class="text-strong text-center">CERTIFICATE OF EMPLOYMENT</p>
    <br><br><br>
    <p style="text-indent: 40px; text-align: justify; line-height: 30px">This is to certify that
        <u>
            <b>
            {{$employee->firstname}}
            @if(strlen( $employee->middlename < 2))
                {{$employee->middlename}}.
            @else
                {{\Illuminate\Support\Str::limit($employee->middlename,1,'.')}}
            @endif
            {{$employee->lastname}}
            </b>
        </u>

        is an employee of SUGAR REGULATORY ADMINISTRATION since
        <u>
            <b>
                {{\Illuminate\Support\Carbon::parse($employee->firstday_sra)->format('F d, Y')}}
            </b>
        </u>
        and up to the present.

        {{($employee->sex = 'FEMALE') ? 'She' : 'He'}}

        holds a Permanent Appointment of
        <u>
            <b>
                {{strtoupper($employee->position)}}.
            </b>
        </u>
    </p>

    <p style="text-indent: 40px">
        This certification is issued for whatever legal purpose it may serve.
    </p>
    <br><br>
    <div style="overflow: auto">
        <div style="width: 40%; float: right">
            <p class="text-center">
                <b>{{\Illuminate\Support\Facades\Request::get('signatory_name')}}</b>
                <br>
                {{\Illuminate\Support\Facades\Request::get('signatory_position')}}
            </p>
        </div>
    </div>


    <br><br><br><br>

    <p class="no-margin text-right" style="font-size: 10px; font-style: italic">FM-AFD-HRS-036, Rev. 00</p>
    <p class="no-margin text-right" style="font-size: 10px; font-style: italic">Effectivity Date: March 12, 2015</p>
</body>
</html>