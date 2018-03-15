<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SWEP | Sugar Web Portal</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
  </head>

  <body class="hold-transition skin-green sidebar-mini" id="pjax-container">
    
    <div class="wrapper">

      @include('layouts.admin-topnav')

      @include('layouts.admin-sidenav')

      <div class="content-wrapper">
        @yield('content')
      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2018-2019 <a href="#">MIS-Visayas</a>.</strong> All rights
        reserved.
      </footer>

    </div>

    <script src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('template/plugins/pjax/jquery.pjax.js') }}"></script>

    <script src="{{ asset('template/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('template/dist/js/demo.js') }}"></script>
    
    <script src="{{ asset('js/custom.js') }}"></script>
    
    @yield('scripts')

  </body>
  
</html>