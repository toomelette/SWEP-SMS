@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage Job Order Employees</h1>
    </section>

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List of Job Order Employees</h3>
                <button type="button" class="btn btn-success btn-sm pull-right" onclick="html_region.change()" data-target="#add_jo_employee_modal" data-toggle="modal"><i class="fa fa-plus"></i> Add JO Employee</button>
            </div>
            <div class="box-body">
                <div id="jo_employees_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="jo_employees_table" style="width: 100% !important">
                        <thead>
                        <tr class="">
                            <th class="th-20">Employee No.</th>
                            <th >Full Name</th>
                            <th >Sex</th>
                            <th >Birthday | Age</th>
                            <th >Civil Status</th>
                            <th >BM User Id</th>
                            <th class="action">Action</th>
                            <th >Lastname</th>
                            <th >Firstname</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="tbl_loader">
                    <center>
                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                    </center>
                </div>
            </div>
        </div>
    </section>


@endsection


@section('modals')

    <div class="modal fade" id="add_jo_employee_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form id="add_jo_employee_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add JO Employee</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            {!! __form::textbox(
                               '4 firstname', 'firstname', 'text', 'First name *', 'First name', '', 'firstname', '', '','basis'
                             ) !!}

                            {!! __form::textbox(
                               '4 middlename', 'middlename', 'text', 'Middle name *', 'Middle name', '', 'middlename', '', '','basis'
                             ) !!}

                            {!! __form::textbox(
                               '4 lastname', 'lastname', 'text', 'Last name *', 'Last name', '', 'lastname', '', '', 'basis'
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
                            Employment and Accounts
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
                               '4 username', 'username', 'text', 'SWEP Username:*', 'Username', '', 'username', '', ''
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
                    <div class="modal-footer">
                        <div class="icheck-primary pull-left">
                            <input type="checkbox" id="create_account_check" name="create_account_check" checked/>
                            <label for="create_account_check">Create SWEP Account</label>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {!! \App\Swep\ViewHelpers\__html::blank_modal('edit_jo_employee_modal','') !!}
    {!! \App\Swep\ViewHelpers\__html::blank_modal('view_jo_employee_modal','') !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        function dt_draw() {
            users_table.draw(false);
        }

        function filter_dt() {
            is_online = $(".filter_status").val();
            is_active = $(".filter_account").val();
            users_table.ajax.url("{{ route('dashboard.user.index') }}" + "?is_online=" + is_online + "&is_active=" + is_active).load();

            $(".filters").each(function (index, el) {
                if ($(this).val() != '') {
                    $(this).parent("div").addClass('has-success');
                    $(this).siblings('label').addClass('text-green');
                } else {
                    $(this).parent("div").removeClass('has-success');
                    $(this).siblings('label').removeClass('text-green');
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var regions;

            default_region = 6;

            $.getJSON('{{asset("json/regions.json")}}', function(data){
                regions = data;
                $.each(data, function(i, item){
                    selected = '';
                    if(i == default_region){
                        selected = 'selected';
                    }
                    $("#add_jo_employee_form select[name='region']").append('<option value="'+i+'" '+selected+'>'+item.region_name+'</option>');
                })
            })

            html_region = $("#add_jo_employee_form select[name='region']");
            html_province = $("#add_jo_employee_form select[name='province']");
            html_municipality = $("#add_jo_employee_form select[name='city']");
            html_barangay = $("#add_jo_employee_form select[name='brgy']");



            html_region.change(function(){
                selected = $(this).val();
                html_province.html('<option value="">Select</option>');
                html_municipality.html('<option value="">Select</option>');
                html_barangay.html('<option value="">Select</option>');

                $.each(regions[selected]['province_list'], function(i,item){
                    html_province.append('<option value="'+i+'">'+i+'</option>');
                })
            });



            html_province.change(function(){
                selected = $(this).val();
                html_municipality.html('<option value="">Select</option>');
                html_barangay.html('<option value="">Select</option>');

                $.each(regions[html_region.val()]['province_list'][selected]['municipality_list'], function(i,item){
                    html_municipality.append('<option value="'+i+'">'+i+'</option>');
                });

            });

            html_municipality.change(function(){
                selected = $(this).val();
                html_barangay.html('<option value="">Select</option>');
                $.each(regions[html_region.val()]['province_list'][html_province.val()]['municipality_list'][selected]['barangay_list'], function(i,item){
                    html_barangay.append('<option value="'+item+'">'+item+'</option>');
                })
            })



        })
        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        active = '';
        //DT
        jo_employees_tbl = $("#jo_employees_table").DataTable({
          'dom' : 'lBfrtip',
          "processing": true,
          "serverSide": true,
          "ajax" : '{{route("dashboard.jo_employees.index")}}',
          "columns": [
            { "data": "employee_no" },
            { "data": "fullname" },
              { "data": "sex" },
              { "data": "birthday_age" },
              { "data": "civil_status" },
              { "data": "biometric_user_id" },
              { "data": "firstname" },
              { "data": "lastname" },
            { "data": "action" }
          ],
          "buttons": [
            {!! __js::dt_buttons() !!}
          ],
          "columnDefs":[
            {
              "targets" : 0,
              "orderable" : false,
              "class" : 'w-10p'
            },
            {
              "targets" : 2,
              "orderable" : true,
              "class" : 'w-6p'
            },
            {
              "targets" : 8,
              "orderable" : false,
              "class" : 'action-10p'
            },
            {
              "targets" : [6,7],
              "visible" : false,
              "class" : 'action-10p'
            }
          ],
          "responsive": false,
          "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
              $("#jo_employees_table_container").fadeIn();
            });
          },
          "language":
                  {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                  },
          "drawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="modal"]').tooltip();
            if(active != ''){
              $("#jo_employees_table #"+active).addClass('success');
            }
          }
        })

        style_datatable("#jo_employees_table");

        //Need to press enter to search
        $('#jo_employees_table_filter input').unbind();
        $('#jo_employees_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            jo_employees_tbl.search(this.value).draw();
          }
        });


        //store
        $("#add_jo_employee_form").submit(function (e) {
            e.preventDefault();

            form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.jo_employees.store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   notify('Data successfully saved','success');
                   succeed(form, true,false);
                   active = res.slug;
                   jo_employees_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        });
        //EDIT
        $("body").on('click','.edit_jo_employee_btn', function () {
            btn = $(this);
            slug = btn.attr('data');
            load_modal2(btn);
            url = '{{route("dashboard.jo_employees.edit","slug")}}';
            url = url.replace('slug',slug)
            $.ajax({
                url : url,
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   populate_modal2(btn, res)
                },
                error: function (res) {
                    notify('An error occurred!','danger');
                    console.log(res);
                }
            })
        })

        $("body").on('click','.view_jo_employee_btn',function () {
            btn = $(this);
            load_modal2(btn);
            slug = btn.attr('data');
            url = '{{route("dashboard.jo_employees.show","slug")}}';
            url = url.replace("slug",slug);
            $.ajax({
                url : url,
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   populate_modal2(btn,res);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        })

        $("#add_jo_employee_modal .basis").change(function () {
            fname = $("#add_jo_employee_modal input[name='firstname']").val();
            mname = $("#add_jo_employee_modal input[name='middlename']").val();
            lname = $("#add_jo_employee_modal input[name='lastname']").val();
            new_fname = fname.toUpperCase().slice(0,1);
            new_mname = mname.toUpperCase().slice(0,1);
            new_lname = lname.toUpperCase().slice(0,1);
            concat = new_fname+new_mname+new_lname+'221';
            if(fname != '' && lname != ''){
                $("#add_jo_employee_modal input[name='employee_no']").val(concat);
                console.log(concat);
            }
        })

        $("#create_account_check").change(function () {
            if($(this).prop('checked') == true){
                $("#add_jo_employee_form #username").removeAttr('disabled');
            }else{
                $("#add_jo_employee_form #username").attr('disabled','disabled');
            }
        })
    </script>


@endsection