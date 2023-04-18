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
                <li><a href="#tab_2" data-toggle="tab">Requests for Cancellation</a></li>
                <li><a href="#tab_3" data-toggle="tab">SRO Monitoring</a></li>
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

                <div class="tab-pane" id="tab_2 ">
                    The European languages are members of the same family. Their separate existence is a myth.
                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                    new common language would be desirable: one could refuse to pay expensive translators. To
                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                    words. If several languages coalesce, the grammar of the resulting language is more simple
                    and regular than that of the individual languages.
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
    </script>
@endsection