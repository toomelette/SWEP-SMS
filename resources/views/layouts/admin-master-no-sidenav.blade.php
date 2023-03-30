<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRA | Sugar Monitoring System</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/images/sra_only_low.png">


    <meta property='og:title' content='SRA | Sugar Monitoring System'/>
    <meta property='og:image' content='{{asset('images/sra.png')}}'/>
    <meta property='og:url' content='http://sms.sra.gov.ph/'/>
    <meta property='og:image:width' content='1200' />
    <meta property='og:image:height' content='627' />
    <!-- TYPE BELOW IS PROBABLY: 'website' or 'article' or look on https://ogp.me/#types -->
    <meta property="og:type" content='website'/>
    @include('layouts.css-plugins')
    <script type="text/javascript" src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>
    @yield('extras')

</head>

<body class="hold-transition fixed {!! Auth::check() ? __sanitize::html_encode(Auth::user()->color) : '' !!}" theme="{!! Auth::check() ? __sanitize::html_encode(Auth::user()->color) : '' !!}">

<div id="loader"></div>

<div class="wrapper">

    <header class="main-header">
        <a href="#" class="logo">
            <span class="logo-mini">A</span>
            <span class="logo-lg"><b>PRICE MONITORING</b></span>
        </a>
    </header>


    <div class="content-wrapper" >

        @yield('content')
        @yield('content2')
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

<div class="modal fade" id="change_pass_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="change_pass_form">
                <div class="modal-header">
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
</div>
<script type="text/javascript">
    const autonumericElement =  AutoNumeric.multiple('.autonumber',autonum_settings);
    const autonumericElement_mt =  AutoNumeric.multiple('.autonumber_mt',autonum_settings_mt);
    var find = '';
    @if(request()->has('find'))
        find = '{{request('find')}}';
    @endif
    function wipe_autonum(){
        $.each(autonumericElement,function (i,item) {
            item.clear();
        })
    }
    {!! __js::show_hide_password() !!}
        modal_loader = $("#modal_loader").parent('div').html();
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
                Swal.fire(
                    'Good job!',
                    'You have just made your account more secure by changing your password',
                    'success'
                );
                $("#change_pass_container").slideUp();

            },
            error: function (res) {
                console.log(res);
                errored(form,res);
            }
        })
    })

    $(".calculator").on('input',function () {
        let thisTrueVal = parseFloat($(this).val().replaceAll(',',''));
        let inLkg;
        let inMt;
        if($(this).attr('name') == 'calc_mt'){
            inMt = thisTrueVal;
            inLkg = thisTrueVal * 20;
            $("#calculator input[name=calc_lkg]").val($.number(inLkg,2));
        }


    })

    $("#sidenav_selector").awselect({
        background: "#535c61",
        placeholder_color: "#ffffff",
        active_background:"#21526e",
        placeholder_active_color: "#fff",
        option_color:"#fff",
        immersive: true
    });
    $("#sidenav_selector").change(function () {
        th = $(this);
        th_selected = th.val();
        $.ajax({
            url : '{{route("dashboard.sidenav.change")}}',
            data : {selected : th_selected},
            type: 'POST',
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

    function searchSidenav() {
        var input, filter, ul, li, a, i;
        input = $("#mySearch");
        filter = input.val().toUpperCase();
        ul = $("#myMenu");
        li = $("#myMenu li.treeview");
        li.each(function () {
            a = $(this).children('a');
            searchText = a.attr('searchable');
            if (searchText.toUpperCase().indexOf(filter) > -1) {
                $(this).slideDown();
            } else {
                $(this).slideUp();
            }
        });
        if(filter == ''){
            $(".header-group").each(function () {
                $('#sidenav_search_header').slideUp();
                $(this).css('display','');
                $("#myMenu .header-navigation").slideDown();
                $("#myMenu .grouper").slideDown();
                $("#home-nav").slideDown();
            })
        }else{
            $(".header-group").each(function () {
                $('#sidenav_search_header').slideDown();
                $(this).css('display','none');
                $("#myMenu .header-navigation").slideUp();
                $("#myMenu .grouper").slideUp();
                $("#home-nav").slideUp();
            })
        }

    }
    function filterDT(datatable_object){

        let data = $("#filter_form").serialize();
        datatable_object.ajax.url("{{Request::url()}}"+"?"+data).load();

        $(".dt_filter").each(function (index,el) {
            if ($(this).val() != ''){
                $(this).parent("div").addClass('has-success');
                $(this).siblings('label').addClass('text-green');
            } else {
                $(this).parent("div").removeClass('has-success');
                $(this).siblings('label').removeClass('text-green');
            }
        });
        let withSuccess = $('.dt_filter-parent-div.has-success');
        if(withSuccess.length > 0){
            $("#filter-notifier").html(withSuccess.length+' filter(s) currently active');
        }else{
            $("#filter-notifier").html('');
        }
    }

    $("body").on("click",".close_bulletin_btn",function () {
        let btn = $(this);
        $.ajax({
            url : '{{route("dashboard.ajax.get","close_bulletin")}}',
            data: {last_slug: btn.attr('data')},
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                btn.parent('div').remove();
            },
            error: function (res) {
                console.log(res);
            }
        })
    })

    const iCheckRadioOptions = {
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
        increaseArea: '5%' // optional
    };
    $(".iCheck").iCheck(iCheckRadioOptions);


    $("form").on('reset',function (e) {
        let id = $(this).attr('id');
        setTimeout(function () {
            $('#'+id+' :radio').iCheck('update');
        })
    })

    @if(Auth::user()->has_changed_password == null)
    $("#change_pass_modal").modal('show');
    @endif
</script>

@yield('scripts')

</body>

</html>