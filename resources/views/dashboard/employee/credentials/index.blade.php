@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content')

@section('modal-header')
    <i class="fa fa-fw swep-certificate"></i> {{$employee->lastname}}, {{$employee->firstname}} - Credentials
@endsection

@section('modal-body')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1_{{$rand}}" data-toggle="tab">Educational Background</a></li>
            <li><a href="#tab_2_{{$rand}}" data-toggle="tab">Eligibilities</a></li>
            <li><a href="#tab_3_{{$rand}}" data-toggle="tab">Work Experiences</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_{{$rand}}">
                <div class="row">
                    <input id="educ_active_{{$rand}}" value="" hidden>
                    <div class="col-md-12" style="margin-bottom: 15px">
                        <button class="btn btn-sm btn-success pull-right add_educ_bg_btn" data-toggle="modal" data-target="#add_educ_bg_modal" type="button"><i class="fa fa-plus"></i> Add Educational Background</button>
                    </div>
                </div>
                <div id="educ_bg_table_{{$rand}}_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="educ_bg_table_{{$rand}}" style="width: 100%">
                        <thead>
                        <tr class="">
                            <th >Level</th>
                            <th >School Name</th>
                            <th >Course</th>
                            <th >From</th>
                            <th >To</th>
                            <th >Units</th>
                            <th >Graduated</th>
                            <th >Scholarship.</th>
                            <th >Honor</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="tbl_loader_{{$rand}}">
                    <center>
                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                    </center>
                </div>
            </div>

            <div class="tab-pane" id="tab_2_{{$rand}}">
                <div class="row">
                    <input id="elig_active_{{$rand}}" value="" hidden>
                    <div class="col-md-12" style="margin-bottom: 15px">
                        <button class="btn btn-sm btn-success pull-right add_elig_btn" data-toggle="modal" data-target="#add_elig_modal" type="button"><i class="fa fa-plus"></i> Add Eligibility</button>
                    </div>
                </div>
                <div id="elig_table_{{$rand}}_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="elig_table_{{$rand}}" style="width: 100%">
                        <thead>
                        <tr class="">
                            <th >Eligibility</th>
                            <th >Level</th>
                            <th >Rating</th>
                            <th >Exam Place</th>
                            <th >Exam Date</th>
                            <th >License No.</th>
                            <th >Validity</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="elig_tbl_loader_{{$rand}}">
                    <center>
                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                    </center>
                </div>

            </div>

            <div class="tab-pane" id="tab_3_{{$rand}}">
                <div class="row">
                    <input id="work_active_{{$rand}}" value="" hidden>
                    <div class="col-md-12" style="margin-bottom: 15px">
                        <button class="btn btn-sm btn-success pull-right add_work_btn" data-toggle="modal" data-target="#add_work_modal" type="button"><i class="fa fa-plus"></i> Add Work Experience</button>
                    </div>
                </div>
                <div id="work_table_{{$rand}}_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="work_table_{{$rand}}" style="width: 100%">
                        <thead>
                        <tr class="">
                            <th >Company</th>
                            <th >Position</th>
                            <th >From</th>
                            <th >To</th>
                            <th >Salary</th>
                            <th >SG</th>
                            <th >Step</th>
                            <th >Appt. Status</th>
                            <th >Gov't Service</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="work_tbl_loader_{{$rand}}">
                    <center>
                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                    </center>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('modal-footer')

@endsection

@section('scripts')
    <script type="text/javascript">
        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        active_educ_{{$rand}} = '';
        educ_tbl_{{$rand}} = $("#educ_bg_table_{{$rand}}").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route('dashboard.employee.credentials',$employee->slug)}}?for=educ_bg',
            "columns": [
                { "data": "level" },
                { "data": "school_name" },
                { "data": "course" },
                { "data": "date_from" },
                { "data": "date_to" },
                { "data": "units" },
                { "data": "graduate_year" },
                { "data": "scholarship" },
                { "data": "honor" },
                { "data": "action"}
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 9,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'action-6p'
                },
            ],
            "responsive": true,
            "initComplete": function( settings, json ) {
                $('#tbl_loader_{{$rand}}').fadeOut(function(){
                    $("#educ_bg_table_{{$rand}}_container").fadeIn();
                });

            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                // console.log(employees_tbl.page.info().page);
                let active_educ = $("#educ_active_{{$rand}}").val();
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_educ !== ''){
                    $("#educ_bg_table_{{$rand}} #"+active_educ).addClass('success');
                }
            }
        })

        style_datatable("#educ_bg_table_{{$rand}}");

        //Need to press enter to search
        $('#educ_bg_table_{{$rand}}_filter input').unbind();
        $('#educ_bg_table_{{$rand}}_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                educ_tbl_{{$rand}}.search(this.value).draw();
            }
        });

        elig_tbl_{{$rand}} = $("#elig_table_{{$rand}}").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route('dashboard.employee.credentials',$employee->slug)}}?for=elig',
            "columns": [
                { "data": "eligibility" },
                { "data": "level" },
                { "data": "rating" },
                { "data": "exam_place" },
                { "data": "exam_date" },
                { "data": "license_no" },
                { "data": "license_validity" },
                { "data": "action"}
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 7,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'action-6p'
                },
            ],
            "responsive": true,
            "initComplete": function( settings, json ) {
                $('#elig_tbl_loader_{{$rand}}').fadeOut(function(){
                    $("#elig_table_{{$rand}}_container").fadeIn();
                });

            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                // console.log(employees_tbl.page.info().page);
                let active_elig = $("#elig_active_{{$rand}}").val();
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_elig !== ''){
                    $("#elig_table_{{$rand}} #"+active_elig).addClass('success');
                }
            }
        })

        style_datatable("#elig_table_{{$rand}}");

        //Need to press enter to search
        $('#elig_table_{{$rand}}_filter input').unbind();
        $('#elig_table_{{$rand}}_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                elig_tbl_{{$rand}}.search(this.value).draw();
            }
        });

        work_tbl_{{$rand}} = $("#work_table_{{$rand}}").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route('dashboard.employee.credentials',$employee->slug)}}?for=work',
            "columns": [
                { "data": "company" },
                { "data": "position" },
                { "data": "date_from" },
                { "data": "date_to" },
                { "data": "salary" },
                { "data": "salary_grade" },
                { "data": "step" },
                { "data": "appointment_status" },
                { "data": "is_gov_service" },
                { "data": "action"}
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "order": [[0,'asc']],
            "columnDefs":[
                {
                    "targets" : [6,5],
                    "class" : 'action-6p'
                },
                {
                    "targets" : 7,
                    "class" : 'action-10p'
                },
                {
                    "targets" : 9,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'action-6p'
                },
            ],
            "responsive": true,
            "initComplete": function( settings, json ) {
                $('#work_tbl_loader_{{$rand}}').fadeOut(function(){
                    $("#work_table_{{$rand}}_container").fadeIn();
                });

            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                // console.log(employees_tbl.page.info().page);
                let active_work = $("#work_active_{{$rand}}").val();
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_work !== ''){
                    $("#work_table_{{$rand}} #"+active_work).addClass('success');
                }
            }
        })

        style_datatable("#work_table_{{$rand}}");

        //Need to press enter to search
        $('#work_table_{{$rand}}_filter input').unbind();
        $('#work_table_{{$rand}}_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                work_tbl_{{$rand}}.search(this.value).draw();
            }
        });
        
        $(".add_educ_bg_btn").click(function () {
            let btn = $(this);
            load_modal2(btn);
            $.ajax({
                url : '{{route("dashboard.employee.educ_bg.create",$employee->slug)}}?for=create&rand={{$rand}}',
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
        $("#educ_bg_table_{{$rand}}").on("click",".edit_educ_bg_btn",function () {
            let btn = $(this);
            load_modal2(btn);
            let uri  = '{{route("dashboard.employee.educ_bg.edit","slug")}}?for=edit&rand={{$rand}}';
            uri = uri.replace('slug',btn.attr('data'));
            console.log(uri);
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

        $(".add_elig_btn").click(function () {
            let btn = $(this);
            load_modal2(btn);
            $.ajax({
                url : '{{route("dashboard.employee.elig.create",$employee->slug)}}?for=create&rand={{$rand}}',
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
        
        $("#elig_table_{{$rand}}").on("click",".edit_elig_btn", function () {
            let btn = $(this);
            load_modal2(btn);
            let uri = '{{route("dashboard.employee.elig.edit","slug")}}?rand={{$rand}}';
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
        })

        $(".add_work_btn").click(function () {
            let btn = $(this);
            load_modal2(btn);
            $.ajax({
                url : '{{route("dashboard.employee.work.create",$employee->slug)}}?for=create&rand={{$rand}}',
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


        $("#work_table_{{$rand}}").on("click",".edit_work_btn", function () {
            let btn = $(this);
            load_modal2(btn);
            let uri = '{{route("dashboard.employee.work.edit","slug")}}?rand={{$rand}}';
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
        })
    </script>
@endsection

