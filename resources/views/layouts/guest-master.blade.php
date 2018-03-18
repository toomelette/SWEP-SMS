<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SWEP | Sugar Web Portal</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body class="hold-transition skin-green layout-top-nav">
    <div class="wrapper">
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="#" class="navbar-brand"><b>SUGAR</b> WEB PORTAL</a>
            </div>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="notifications-menu"><a href="#">Login</a></li>
                <li class="notifications-menu"><a href="#">Info </a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="content-wrapper">
        <div class="container">
          @yield('content')
        </div>
      </div>
      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
          </div>
          <strong>Copyright &copy; 2018-2019 <a href="#">MIS-Visayas</a>.</strong> All rights
          reserved.
        </div>
      </footer>
      
    </div>
    <script src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
    
    @yield('scripts')
  </body>
</html>