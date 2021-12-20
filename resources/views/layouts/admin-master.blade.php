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

          @if(!empty(Auth::user()->employeeUnion))
            @if(Hash::check(Carbon::parse(Auth::user()->employeeUnion->birthday)->format('mdy'), \Illuminate\Support\Facades\Auth::user()->password))
              <div class="row">
                <div class="col-md-12">
                  <a href="#" id="change_pass_href">
                    <div class="alert alert-warning" style="margin: 1rem">
                      <p><b>Your account is at risk. </b> It seems like you haven't changed your password yet. Please change your SWEP Account Password by clicking here.</p>
                    </div>
                  </a>
                </div>
              </div>
            @endif
          @endif


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

    <div class="modal fade" id="change_pass_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="change_pass_form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
              </div>
              <div class="modal-body">
                <div class="password_container">
                  <div class="row">
                    {!! __form::textbox_password_btn(
                      '12 password', 'password', 'Password *', 'New Password', '', 'password', '', ''
                    ) !!}
                  </div>
                  <div class="row">
                    {!! __form::textbox_password_btn(
                      '12 password_confirmation', 'password_confirmation', 'Confirm New Password *', 'Confirm Password', '', 'password_confirmation', '', ''
                    ) !!}
                  </div>
                </div>
                <hr>
                <div class="row">
                  {!! __form::textbox_password_btn(
                    '12 user_password', 'user_password', 'Enter your old password to continue:', 'Enter your password', '', 'user_password', '', ''
                  ) !!}
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Confirm</button>
              </div>
            </form>
        </div>
      </div>

    <script type="text/javascript">
      {!! __js::show_hide_password() !!}

      $("#change_pass_href").click(function (e) {
        e.preventDefault();
        $("#change_pass_modal").modal('show');
      })

      $("#change_pass_form").submit(function (e) {
        e.preventDefault();
        form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route('dashboard.all.changePass')}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
               console.log(res);
               succeed(form,true,true);
            },
            error: function (res) {
                console.log(res);
                errored(form,res);
            }
        })
      })
    </script>

    @yield('scripts')

  </body>

</html>