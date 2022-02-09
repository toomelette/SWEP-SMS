@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Manage Employees</h1>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">List of Permanent Employees</h3>
        </div>
        <div class="box-body">
            <div id="employees_table_container" style="display: none">
                <table class="table table-bordered table-striped table-hover" id="employees_table" style="width: 100%">
                    <thead>
                    <tr class="">
                        <th >Full Name</th>
                        <th class="th-20">Employee No.</th>
                        <th >Position</th>
                        <th >Email</th>
                        <th >BM id</th>
                        <th class="action">Action</th>
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
{!! \App\Swep\ViewHelpers\__html::blank_modal('show_employee_modal','75') !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('service_records_modal','lg') !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('trainings_modal','lg') !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('matrix_modal','lg') !!}


{!! \App\Swep\ViewHelpers\__html::blank_modal('add_sr_modal','') !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('add_training_modal','') !!}


{!! \App\Swep\ViewHelpers\__html::blank_modal('edit_sr_modal','') !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('edit_training_modal','') !!}
{!! \App\Swep\ViewHelpers\__html::blank_modal('edit_matrix_modal','40') !!}
{{-- Print Modal --}}
<div class="modal fade" id="print_sr_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Please set signatories</h4>
            </div>
            <form id="print_sr_form" method="GET" target="_blank">
                <div class="modal-body">
                    {!! __form::textbox(
                       '6', 'pn', 'text', 'Prepared By:', 'Prepared By', old('pn'), $errors->has('pn'), $errors->first('pn'), 'data-transform="uppercase"'
                    ) !!}

                    {!! __form::textbox(
                       '6', 'pp', 'text', 'Prepared Position:', 'Prepared Position', old('pp'), $errors->has('pp'), $errors->first('pp'), 'data-transform="uppercase"'
                    ) !!}

                    {!! __form::textbox(
                       '6', 'cn', 'text', 'Certified By:', 'Certified By', old('cn'), $errors->has('cn'), $errors->first('cn'), 'data-transform="uppercase"'
                    ) !!}

                    {!! __form::textbox(
                       '6', 'cp', 'text', 'Certified Position:', 'Certified Position', old('cp'), $errors->has('cp'), $errors->first('cp'), 'data-transform="uppercase"'
                    ) !!}

                </div>
                <div class="modal-footer" style="overflow: hidden;">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Print</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="print_training_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="print_training_form" target="_blank" action="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Filter</h4>
                </div>
                <div class="modal-body">
                    <p class="text-info"><i class="fa fa-info-circle"></i> Leaving these fields blank will not filter trainings by date.</p>
                    <div class="row">

                        {!! __form::textbox(
                            '6 df', 'df', 'date', 'Date From', 'Date From','', '', '', ''
                         ) !!}

                        {!! __form::textbox(
                          '6 dt', 'dt', 'date', 'Date To', 'Date To', '', '', '', ''
                        ) !!}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

    //-----DATATABLES-----//
    modal_loader = $("#modal_loader").parent('div').html();
    //Initialize DataTable
    active = '';
    employees_tbl = $("#employees_table").DataTable({
      'dom' : 'lBfrtip',
      "processing": true,
      "serverSide": true,
      "ajax" : '',
      "columns": [
        { "data": "fullname" },
        { "data": "employee_no" },
        { "data": "position" },
        { "data": "email" },
        { "data": "biometric_user_id" },
        { "data": "action"}
      ],
      "buttons": [
        {!! __js::dt_buttons() !!}
      ],
      "columnDefs":[
        // {
        //   "targets" : [2,3],
        //   "orderable" : false,
        //   "class" : 'w-6p'
        // },
        {
          "targets" : 5,
          "orderable" : false,
          "searchable": false,
          "class" : 'action4'
        },
      ],
      "responsive": true,
      "initComplete": function( settings, json ) {
        $('#tbl_loader').fadeOut(function(){
          $("#employees_table_container").fadeIn();
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
          $("#employees_table #"+active).addClass('success');
        }
      }
    })

    style_datatable("#employees_table");

    //Need to press enter to search
    $('#employees_table_filter input').unbind();
    $('#employees_table_filter input').bind('keyup', function (e) {
      if (e.keyCode == 13) {
          employees_tbl.search(this.value).draw();
      }
    });
    
    $("body").on('click','.view_employee_btn', function () {
        btn = $(this);
        load_modal2(btn);
        uri = '{{route("dashboard.employee.show","slug")}}';
        uri = uri.replace("slug",btn.attr('data'));
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
               populate_modal2(btn,res);
            },
            error: function (res) {
                notify('Error','danger');
                console.log(res);
            }
        })
    })

    $("body").on("click",'.service_records_btn',function () {
        btn = $(this);
        uri = '{{route("dashboard.employee.service_record","slug")}}';
        uri = uri.replace('slug',btn.attr('data'));
        load_modal2(btn);
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                populate_modal2(btn,res);
            },
            error: function (res) {
                notify('Ajax error','danger');
                console.log(res);
            }
        })
    })

    $("body").on("click",".trainings_btn",function (e) {
        btn = $(this);
        uri = '{{route("dashboard.employee.training","slug")}}';
        uri = uri.replace('slug',btn.attr('data'));
        load_modal2(btn);
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                populate_modal2(btn,res);
            },
            error: function (res) {
                notify('Ajax error','danger');
                console.log(res);
            }
        })
    })

    $("body").on("click",".matrix_btn",function (e) {
        btn = $(this);
        uri = '{{route("dashboard.employee.matrix_show","slug")}}';
        uri = uri.replace('slug',btn.attr('data'));
        load_modal2(btn);
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                populate_modal2(btn,res);
            },
            error: function (res) {
                notify('Ajax error','danger');
                console.log(res);
            }
        })
    })

    $("body").on("click",".bm_uid_btn",function () {
        let bm_uid = $(this).attr('bm_uid');
        let employee = $(this).attr('data');
        Swal.fire({
            title: 'Enter Biometric User ID:',
            html: 'Employee: <b>'+$(this).attr('employee')+'</b>',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
            },
            inputValue: bm_uid,
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            preConfirm: (text) => {
                return $.ajax({
                        url : "{{route('dashboard.employee.update_bm_uid')}}",
                        data : {'biometric_user_id':text , 'employee' : employee},
                        type: 'POST',
                        headers: {
                            {!! __html::token_header() !!}
                        },
                        success: function (res) {
                           active = res.slug;
                           employees_tbl.draw(false);
                            notify('Biometric User ID was successfully changed','success');
                        },
                        error: function (res) {
                            if(res.status == 422){
                                var message = res.responseJSON.errors.biometric_user_id;
                            }else{
                                var message = res.responseJSON.message;
                            }
                            Swal.showValidationMessage(
                                'Request failed: ' + message
                            );
                        }
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {

                    })

            },
            allowOutsideClick: () => !Swal.isLoading()
        })
    })


</script>
@endsection