@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>{{$mill_code}}</h1>
    </section>
@endsection
@section('content2')

    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Reports Submitted</a></li>
                <li><a href="#tab_2" data-toggle="tab">Requests for Cancellation <span class="badge bg-red" id="totalNoAction"></span></a></li>
{{--                <li><a href="#tab_3" data-toggle="tab" hidden>SRO Monitoring</a></li>--}}
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @if(!empty($calendar))
                        @foreach($calendar as $crop_year => $months)
                            <div class="panel">
                                <div class="box box-sm box-default box-solid">
                                    <div class="box-header with-border">
                                        <p class="no-margin"> {{$crop_year}} <small id="filter-notifier" class="label bg-blue blink"></small></p>

                                    </div>
                                    <div class="box-body" style="">
                                        <table class="table table-bordered table-condensed">
                                            <thead>
                                                <tr>
                                                    @foreach($months as $month => $weeks)
                                                        <th class="text-center">{{strtoupper(\Illuminate\Support\Carbon::parse($month)->format('M'))}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                @foreach($months as $month => $weeks)
                                                    <td>
                                                    <div class="row">
                                                        @foreach($weeks as $week => $report_no)
                                                            <div class="col-md-12">
                                                                <button class="view_week_btn btn btn-sm {{ isset($submissions[$week]) ? 'btn-success' : 'btn-default'}}" style="width: 100%; margin-bottom: 10px;font-family: Consolas" {{isset($submissions[$week]) ? '' : 'disabled'}} data="{{$submissions[$week] ?? null}}" data-toggle="modal" data-target="#view_week_modal">
                                                                    {{$report_no}} : {{Carbon::parse($week)->format('M d')}}
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="tab-pane" id="tab_2">
                    <table id="request_for_cancellation_table" class="table table-bordered table-condensed" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Report Snapshot</th>
                            <th>Requested By</th>
                            <th>Date of request</th>
                            <th>Report No.</th>
                            <th>Week Ending</th>
                            <th>Reason for Cancellation</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tab_3">
                    <table id="sro_monitoring_table" class="table table-bordered table-condensed" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>SRO #</th>
                            <th>Issuance (Cur.)</th>
                            <th>Issuance (Prev.)</th>
                            <th>Deliveries (Cur.)</th>
                            <th>Deliveries (Prev.)</th>
                            <th>Balance (Cur.)</th>
                            <th>Balance (Prev.)</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


            </div>

        </div>

    </section>


@endsection


@section('modals')
    {!! \App\Swep\ViewHelpers\__html::blank_modal('view_week_modal','80') !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(".view_week_btn").click(function () {
            let btn = $(this);
            load_modal3(btn);
            let uri = '{{route("dashboard.my_mills.show","slug")}}';
            uri = uri.replace('slug',btn.attr('data'));
            $.ajax({
                url : uri,
                data : '',
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
        })

        active = '';
        sro_monitoring_tbl = $("#sro_monitoring_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{\Illuminate\Support\Facades\Request::url()}}?sro_monitoring=true',
            "columns": [
                { "data": "sro_no" },
                { "data": "qty" },
                { "data": "qty_prev" },
                { "data": "d_c" },
                { "data": "d_p" },
                { "data": "b_c"},
                { "data": "b_p"},
                { "data": "action"},
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : [1,2,3,4,5,6],
                    "class" : 'w-4p text-right',
                },
            ],
            "order":[[0,'desc']],
            "responsive": true,
            "initComplete": function( settings, json ) {




                $('#tbl_loader').fadeOut(function(){
                    $("#sro_monitoring_table_container").fadeIn();
                    if(find != ''){
                        sro_monitoring_tbl.search(find).draw();
                        setTimeout(function(){
                            active = '';
                        },3000);
                        window.history.pushState({}, document.title, "/dashboard/employee");
                    }
                });
                @if(\Illuminate\Support\Facades\Request::get('toPage') != null && \Illuminate\Support\Facades\Request::get('mark') != null)
                setTimeout(function () {
                    sro_monitoring_tbl.page({{\Illuminate\Support\Facades\Request::get('toPage')}}).draw('page');
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
                // console.log(sro_monitoring_tbl.page.info().page);
                $("#sro_monitoring_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+sro_monitoring_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#sro_monitoring_table #"+active).addClass('success');
                }
            }
        })

        style_datatable("#sro_monitoring_table");

        //Need to press enter to search
        $('#sro_monitoring_table_filter input').unbind();
        $('#sro_monitoring_table_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                sro_monitoring_tbl.search(this.value).draw();
            }
        });



        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        active_request = '';
        request_for_cancellation_tbl = $("#request_for_cancellation_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{\Illuminate\Support\Facades\Request::url()}}?request_for_cancellation=true',
            "columns": [
                { "data": "filename" },
                { "data": "cancelled_by" },
                { "data": "cancelled_at" },
                { "data": "report_no" },
                { "data": "week_ending" },
                { "data": "reason" },
                { "data": "action" },
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 6,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'action6'
                },
                {
                    "targets" : 0,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'w-10p'
                },

            ],
            "order":[[2,'desc']],
            "responsive": true,
            "initComplete": function( settings, json ) {
                $('#tbl_loader').fadeOut(function(){
                    $("#request_for_cancellation_table_container").fadeIn();
                    if(find != ''){
                        request_for_cancellation_tbl.search(find).draw();
                        setTimeout(function(){
                            active_request = '';
                        },3000);
                        window.history.pushState({}, document.title, "/dashboard/employee");
                    }
                });
                @if(\Illuminate\Support\Facades\Request::get('toPage') != null && \Illuminate\Support\Facades\Request::get('mark') != null)
                setTimeout(function () {
                    request_for_cancellation_tbl.page({{\Illuminate\Support\Facades\Request::get('toPage')}}).draw('page');
                    active_request = '{{\Illuminate\Support\Facades\Request::get("mark")}}';
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
                // console.log(request_for_cancellation_tbl.page.info().page);
                $("#request_for_cancellation_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+request_for_cancellation_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_request != ''){
                    $("#request_for_cancellation_table #"+active_request).addClass('success');
                }
                if(settings.json.totalRequestWithNoAction > 0){
                    $("#totalNoAction").html(settings.json.totalRequestWithNoAction);
                }else{
                    $("#totalNoAction").html('');
                }
            }
        })

        style_datatable("#request_for_cancellation_table");

        //Need to press enter to search
        $('#request_for_cancellation_table_filter input').unbind();
        $('#request_for_cancellation_table_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                request_for_cancellation_tbl.search(this.value).draw();
            }
        });

        $("body").on('click','.action_btn',function (e) {
            e.preventDefault();
            let btn = $(this);
            let uri = '{{route("dashboard.cancellation.action","slug")}}?action='+btn.attr('data-type');
            uri = uri.replace('slug',btn.attr('data'));
            let title = '';
            if(btn.attr('data-type') === 'APPROVED'){
                title = 'APPROVE?'
            }else{
                title = 'DISAPPROVE?';
            }
            Swal.fire({
                title: title,
                html: '',
                inputAttributes: {
                    autocapitalize: 'off',
                },
                inputValue: 'bm_uid',
                showCancelButton: true,
                confirmButtonText: 'Continue',
                cancelButtonText: 'Do not perform any changes',
                showLoaderOnConfirm: true,
                preConfirm: (text) => {
                    return $.ajax({
                        url : uri,
                        data : btn.serialize(),
                        type: 'PATCH',
                        headers: {
                            {!! __html::token_header() !!}
                        },
                        success: function (res) {
                            active_request = res.slug;
                            request_for_cancellation_tbl.draw(false);
                            toastBanner('success','Action performed successfully.','Success');
                        },
                        error: function (res) {
                            errored(btn,res);
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