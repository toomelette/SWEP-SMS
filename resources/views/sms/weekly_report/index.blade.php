@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>SMS Weekly Reports</h1>
    </section>
@endsection
@section('content2')

    <section class="content">
        <div class="box box-solid">
            <div class="box-body">
                <div class="panel">
                    <div class="box box-sm box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                            <p class="no-margin"><i class="fa fa-filter"></i> Advanced Filters <small id="filter-notifier" class="label bg-blue blink"></small></p>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool advanced_filters_toggler" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="box-body" style="display: none">
                            <form id="filter_form">
                                <div class="row">
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Status:</label>
                                        <select name="is_active"  class="form-control dt_filter filters">
                                            <option value="">Don't filter</option>
                                            {!! \App\Swep\Helpers\Helper::populateOptionsFromObject(\App\Models\SuOptions::employeeStatus(),'option','value') !!}
                                        </select>
                                    </div>
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Sex:</label>
                                        <select name="sex"  class="form-control dt_filter filter_sex filters select22">
                                            <option value="">Don't filter</option>
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Location:</label>
                                        <select name="locations"  class="form-control dt_filter filter_locations filters select22">
                                            <option value="">Don't filter</option>
                                            {!! \App\Swep\Helpers\Helper::populateOptionsFromObject(\App\Models\SuOptions::employeeGroupings(),'option','value') !!}
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <br>
                <div id="sms_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="sms_table" style="width: 100%">
                        <thead>
                        <tr class="">
                            <th >Week Ending</th>
                            <th class="th-20">Crop Year</th>
                            <th >Report No.</th>
                            <th >Dist. No.</th>
                            <th >Status</th>
                            <th >Details</th>
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
<div class="modal fade" id="previewReportModal" tabindex="-1" role="dialog" aria-labelledby="previewReportModal_label">
  <div class="modal-dialog" style="width: 75%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        active = '';
        sms_tbl = $("#sms_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{\Illuminate\Support\Facades\Request::url()}}',
            "columns": [
                { "data": "week_ending" },
                { "data": "crop_year" },
                { "data": "report_no" },
                { "data": "dist_no" },
                { "data": "status" },
                { "data": "details"},
                { "data": "action"},
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 6,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'action4'
                },
                {
                    "targets" : 4,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'w-8p'
                },
                {
                    "targets" : [2,3],
                    "class" : 'w-8p'
                },
                {
                    "targets" : 5,
                    "class" : 'w-25p'
                },
            ],
            "order":[[0,'desc']],
            "responsive": true,
            "initComplete": function( settings, json ) {




                $('#tbl_loader').fadeOut(function(){
                    $("#sms_table_container").fadeIn();
                    if(find != ''){
                        sms_tbl.search(find).draw();
                        setTimeout(function(){
                            active = '';
                        },3000);
                        window.history.pushState({}, document.title, "/dashboard/employee");
                    }
                });
                @if(\Illuminate\Support\Facades\Request::get('toPage') != null && \Illuminate\Support\Facades\Request::get('mark') != null)
                setTimeout(function () {
                    sms_tbl.page({{\Illuminate\Support\Facades\Request::get('toPage')}}).draw('page');
                    active = '{{\Illuminate\Support\Facades\Request::get("mark")}}';
                    notify('Employee successfully updated.');
                    window.history.pushState({}, document.title, "/dashboard/employee");
                },700);
                @endif
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                // console.log(sms_tbl.page.info().page);
                $("#sms_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+sms_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#sms_table #"+active).addClass('success');
                }
            }
        })

        style_datatable("#sms_table");

        //Need to press enter to search
        $('#sms_table_filter input').unbind();
        $('#sms_table_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                sms_tbl.search(this.value).draw();
            }
        });

        $("body").on("click",".preview_report_btn",function () {
            let btn = $(this);
            load_modal3(btn);
            let uri  = '{{route("dashboard.weekly_report.show","slug")}}';
            uri = uri.replace('slug',btn.attr('data'));
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
                    populate_modal2_error(res);
                }
            })
        });

        $("body").on("click",'.saveAsNewBtn',function () {
            let btn = $(this);
            let reportNo = btn.attr('reportNo');
            let cropYear = btn.attr('cropYear');
            Swal.fire({
                title: 'Save as new',
                html: '<div class="text-left">The following actions will be executed: <br> ' +
                    '1. Report No. '+reportNo+' | '+cropYear+' will be canceled.<br> ' +
                    '2. A draft that is a clone of Report No. '+reportNo+' | '+ cropYear +' will be created.' +
                    '<br><br>' +
                    'Please resubmit Report No. '+reportNo+' | '+ cropYear +' after reviewing the changes you have made. ' +
                    '</div>',
                inputAttributes: {
                    autocapitalize: 'off',
                },
                inputValue: 'bm_uid',
                showCancelButton: true,
                confirmButtonText: 'Continue',
                showLoaderOnConfirm: true,
                preConfirm: (text) => {
                    return $.ajax({
                        url : btn.attr('uri'),
                        data : {'biometric_user_id':'text' , 'employee' : 'employee'},
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (res) {
                            active = res.slug;
                            sms_tbl.draw(false);
                            // notify('Weekly ','success');
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
        });

        $("body").on("click",'.submitBtn',function () {
            let btn = $(this);
            let reportNo = btn.attr('reportNo');
            let cropYear = btn.attr('cropYear');
            let weekEnding = btn.attr('weekEnding');
            Swal.fire({
                title: 'Submit Weekly Report',
                html: '<div class="text-left"><b>Details</b>: <br> ' +
                    'Report No. : '+reportNo+'<br> ' +
                    'Week Ending : '+ weekEnding +'<br> '+
                    'Crop Year : '+ cropYear +'<br> '+
                    '</div>',
                inputAttributes: {
                    autocapitalize: 'off',
                },
                inputValue: 'bm_uid',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (text) => {
                    return $.ajax({
                        url : btn.attr('uri'),
                        data : {'biometric_user_id':'text' , 'employee' : 'employee'},
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (res) {
                            active = res.slug;
                            sms_tbl.draw(false);
                            notify('Weekly report was submitted successfully.','success');
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
                    }).catch(error => {

                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        })
    </script>
@endsection