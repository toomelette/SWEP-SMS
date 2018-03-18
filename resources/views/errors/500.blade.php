<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Swep | 404</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="hold-transition">
  <div class="wrapper" style="background-color: #ecf0f5; padding-top:50px ">
    <div class="container">
      <section class="content">
        <div class="error-page">
          <h2 class="headline text-red"> 500</h2>
          <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
            <p>
              Looks like the server encountered an error,
              please report this problem to the administrator.
              Meanwhile, you may return to Home Page. 
            </p>
            <a class="btn btn-sm btn-danger" href="{{ route('auth.login') }}">Go Back!</a>
          </div>

        </div>

      </section>
    </div>
  </div>

</body>
</html>
