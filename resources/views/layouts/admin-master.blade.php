<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRA Web Portal - AFD</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.css-plugins')

    @yield('extras')

  </head>

  <body class="hold-transition fixed {!! Auth::check() ? __sanitize::html_encode(Auth::user()->color) : '' !!}" >

    <div id="loader"></div>

    <div class="wrapper">

      @include('layouts.admin-topnav')

      @include('layouts.admin-sidenav')

      <div class="content-wrapper" >

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

    @include('layouts.js-plugins')

    @yield('modals')
      {!! __html::modal_loader() !!}
    @yield('scripts')

  </body>

</html>