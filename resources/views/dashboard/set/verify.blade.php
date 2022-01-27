@include('layouts.css-plugins')
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"></a>
    </div>
{{--    {{print_r(request()->session()->all())}}--}}
    <!-- /.login-logo -->
    <div class="login-box-body">
        <form id="verify_form">
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat ">Proceed</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


    </div>
</div>
</body>

@include('layouts.js-plugins')

<script type="text/javascript">
    $("#verify_form").submit(function (e) {
        e.preventDefault();
        form = $(this);
        $.ajax({
            url : '{{route("dashboard.set")}}?verify=1',
            data : form.serialize(),
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
               if(res == 1){
                   window.location.reload();
               }
            },
            error: function (res) {
                console.log(res);
            }
        })
    })
</script>