
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SWEP | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
@include('layouts.css-plugins')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box" style="width: 90%; margin: 3% auto;">
    <div class="register-logo">
        <a href="../../index2.html"><b>SWEP</b> Registration</a>
    </div>

    <div class="register-box-body">
{{--        <p class="login-box-msg">Register a new membership</p>--}}
        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
            Personal Information
        </p>
        <div class="row">
            {!! __form::textbox(
               '4 firstname', 'firstname', 'text', 'First name *', 'First name', '', 'firstname', '', ''
             ) !!}

            {!! __form::textbox(
               '4 middlename', 'middlename', 'text', 'Middle name *', 'Middle name', '', 'middlename', '', ''
             ) !!}

            {!! __form::textbox(
               '4 lastname', 'lastname', 'text', 'Last name *', 'Last name', '', 'lastname', '', ''
             ) !!}
        </div>
        <div class="row">
            {!! __form::select_static(
                '4 name_ext', 'name_ext', 'Suffix', '', Helper::name_extensions(), '', '', '', ''
            ) !!}

            {!! __form::select_static(
                '4 sex', 'sex', 'Sex*', '', Helper::sexArray(), '', '', '', ''
            ) !!}

            {!! __form::textbox(
               '4 birthday', 'birthday', 'date', 'Birthday *', 'Birthday', '', 'birthday', '', ''
             ) !!}
        </div>
        <div class="row">
            {!! __form::select_static(
                '4 civil_status', 'civil_status', 'Civil Status', '', Helper::civil_status(), '', '', '', ''
            ) !!}

            {!! __form::textbox(
               '4 email', 'email', 'text', 'Email Address *', 'Email address', '', 'email', '', ''
             ) !!}

            {!! __form::textbox(
               '4 phone', 'phone', 'text', 'Contact no. *', 'Contact no', '', 'phone', '', ''
             ) !!}
        </div>
        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
            Employment Details
        </p>
        <div class="row">
            {!! __form::textbox(
               '4 employee_no', 'employee_no', 'text', 'Employee No *', 'Employee No.', '', 'employee_no', '', ''
             ) !!}

            {!! __form::select_static2(
                '4 department_unit', 'department_unit', 'Department Unit', '', \App\Swep\Helpers\Helper::departmentUnitArrayForSelect(), '', '', '', ''
            ) !!}

            {!! __form::textbox(
               '4 position', 'position', 'text', 'Position *', 'Position', '', 'position', '', ''
             ) !!}
        </div>
        <div class="row">
            {!! __form::textbox(
               '4 biometric_user_id', 'biometric_user_id', 'text', 'Biometric User Id:*', 'Biometric User Id', '', 'biometric_user_id', '', ''
             ) !!}
            {!! __form::textbox(
              '4 username', 'username', 'text', 'Username:*', 'Username:', '', 'username', '', ''
            ) !!}
        </div>
        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
            Address
        </p>
        <div class="row">
            {!! __form::a_select('4 region', 'Region:*', 'region', [], '' , '') !!}
            {!! __form::a_select('4 province', 'Province:*', 'province', [], '' , '') !!}
            {!! __form::a_select('4 city', 'Municipality/City:*', 'city', [], '' , '') !!}
        </div>
        <div class="row">
            {!! __form::a_select('4 brgy', 'Barangay:*', 'brgy', [], '' , '') !!}
            {!! __form::textbox(
               '8 address_detailed', 'address_detailed', 'text', 'Detailed Address *', 'Detailed Address', '', 'address_detailed', '', ''
             ) !!}
        </div>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
@include('layouts.js-plugins')
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
