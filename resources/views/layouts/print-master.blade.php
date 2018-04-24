<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Disbursement Voucher</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">
    
    .arrow {
      position: absolute;
      overflow: hidden;
      display: inline-block;
      font-size: 3px;
      width: 3em;
      height: 3em;
      border-top: 2px solid black;
      border-right: 2px solid black ;
      transform: rotate(54deg) skew(20deg);
    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

  @yield('content')

</body>

</html>
