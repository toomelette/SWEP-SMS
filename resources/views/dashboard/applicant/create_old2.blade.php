@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Create Applicant</h1>
    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Form</h3>
                <buton class="pull-right btn btn-sm btn-primary" data-toggle="modal" data-target="#import_from_employee_modal">
                    Import from employee
                </buton>
            </div>

            <form role="form" id="add_applicant_form" method="POST" autocomplete="off" action="{{ route('dashboard.applicant.store') }}">
                @csrf
                <div class="box-body">
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('received_at',[
                            'cols' => 3,
                            'label' => 'Date received:*',
                            'type' => 'date',
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('lastname',[
                            'cols' => 3,
                            'label' => 'Last Name:*',
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('firstname',[
                            'cols' => 3,
                            'label' => 'First Name:*',
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('middlename',[
                            'cols' => 3,
                            'label' => 'Middle Name:*',
                        ]) !!}
                    </div>
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_birth',[
                            'cols' => 2,
                            'label' => 'Birthday:*',
                            'type' => 'date',
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('gender',[
                            'cols' => 2,
                            'label' => 'Sex:*',
                            'options' => \App\Swep\Helpers\Arrays::sex()
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('civil_status',[
                            'cols' => 2,
                            'label' => 'Civil Status:*',
                            'options' => \App\Swep\Helpers\Arrays::civil_status()
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('address',[
                            'cols' => 6,
                            'label' => 'Address:*',
                        ]) !!}
                    </div>

                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('course',[
                            'cols' => 6,
                            'label' => 'Course: *',
                            'class' => 'select2_course',
                            'options' => [],
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('school',[
                            'cols' => 6,
                            'label' => 'School:*',
                        ]) !!}
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 position_applied">
                            <label for="school">Position(s) Applied for:</label>
                            <br>
                            <input value="{{old('position_applied')}}" type="text" name="position_applied" id="position_applied" class="form-control" value="" data-role="tagsinput" style="width:100%;">
                            <p class="text-info"><i class="fa fa-info"></i> You can add more "Position applied for" by pressing <b>ENTER</b>. </p>
                        </div>
                    </div>



                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-sm btn-primary pull-right"> <i class="fa fa-fw fa-check"></i> Save </button>
                </div>

            </form>

        </div>

    </section>

@endsection




@section('modals')

    @if(Session::has('APPLICANT_CREATE_SUCCESS'))

        {!! __html::modal(
          'applicant_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('APPLICANT_CREATE_SUCCESS')
        ) !!}

    @endif

    <div class="modal fade" id="import_from_employee_modal" tabindex="-1" role="dialog" aria-labelledby="import_from_employee_modal_label">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Search employee</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name of employee:</label>
                        <input class="form-control" id="search_employee"  autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




@section('scripts')

    <script type="text/javascript">

        $("#add_applicant_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.applicant.store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,false);
                    $(".course .select2-selection__rendered").html('Select');
                    $("#position_applied").tagsinput('removeAll');
                    notify('Applicant successfully added.');
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
        $("#search_employee").typeahead({
            ajax : "{{ route('dashboard.ajax.get','search_active_employees') }}",
            onSelect:function (result) {
                $("#add_user_employee_modal input[name='employee_slug']").val(result.value);
                console.log();
                $.ajax({
                    url : "{{ route('dashboard.ajax.get','search_active_employees') }}?afterTypeahead=true",
                    data : {id:result.value},
                    type: 'GET',
                    headers: {
                        {!! __html::token_header() !!}
                    },
                    success: function (res) {
                        $("#add_applicant_form input[name='lastname']").val(res.lastname);
                        $("#add_applicant_form input[name='firstname']").val(res.firstname);
                        $("#add_applicant_form input[name='middlename']").val(res.middlename);
                        $("#add_applicant_form select[name='gender']").val(res.sex);
                        $("#add_applicant_form input[name='date_of_birth']").val(res.date_of_birth);
                        $("#add_applicant_form select[name='civil_status']").val(res.civil_status);
                        $("#import_from_employee_modal").modal('hide');
                        setTimeout(function () {
                            $("#search_employee").val('');
                        },1000)
                    },
                    error: function (res) {
                        console.log(res);
                    }
                })
            },
            lookup: function (i) {
                console.log(i);
            }
        });


        @if(Session::has('APPLICANT_CREATE_SUCCESS'))
        $('#applicant_create').modal('show');
        @endif






        {{-- EDC Background ADD ROW --}}
        $(document).ready(function() {



            $('.bootstrap-tagsinput input').on('keypress', function(e){
                if (e.keyCode == 13){
                    e.keyCode = 188;
                    e.preventDefault();
                };
            });

            $("#edc_background_add_row").on("click", function() {
                var i = $("#edc_background_table_body").children().length;
                var content ='<tr>' +
                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_edc_background[' + i + '][course]" class="form-control" placeholder="Course">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_edc_background[' + i + '][school]" class="form-control" placeholder="School">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_edc_background[' + i + '][units]" class="form-control" placeholder="Units">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_edc_background[' + i + '][graduate_year]" class="form-control" placeholder="Graduate Year">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                    '</td>' +

                    '</tr>';

                $("#edc_background_table_body").append($(content));

            });

        });




        {{-- Trainings ADD ROW --}}
        $(document).ready(function() {

            $("#trainings_add_row").on("click", function() {
                var i = $("#trainings_table_body").children().length;
                var content ='<tr>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_training[' + i + '][title]" class="form-control" placeholder="Title">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<div class="input-group-addon">' +
                    '<i class="fa fa-calendar"></i>' +
                    '</div>' +
                    '<input name="row_training[' + i + '][date_from]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<div class="input-group-addon">' +
                    '<i class="fa fa-calendar"></i>' +
                    '</div>' +
                    '<input name="row_training[' + i + '][date_to]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_training[' + i + '][venue]" class="form-control" placeholder="Venue">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_training[' + i + '][conducted_by]" class="form-control" placeholder="Conducted By">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_training[' + i + '][remarks]" class="form-control" placeholder="Remarks">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                    '</td>' +

                    '</tr>';

                $("#trainings_table_body").append($(content));

                $('.datepicker').each(function(){
                    $(this).datepicker({
                        autoclose: true,
                        dateFormat: "mm/dd/yy",
                        orientation: "bottom"
                    });
                });

                $(this).removeClass('datepicker');

            });

        });




        {{-- Experience ADD ROW --}}
        $(document).ready(function() {

            $("#exp_add_row").on("click", function() {
                var i = $("#exp_table_body").children().length;
                var content ='<tr>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<div class="input-group-addon">' +
                    '<i class="fa fa-calendar"></i>' +
                    '</div>' +
                    '<input name="row_exp[' + i + '][date_from]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<div class="input-group-addon">' +
                    '<i class="fa fa-calendar"></i>' +
                    '</div>' +
                    '<input name="row_exp[' + i + '][date_to]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_exp[' + i + '][position]" class="form-control" placeholder="Position">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_exp[' + i + '][company]" class="form-control" placeholder="Company">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<select name="row_exp[' + i + '][is_gov_service]" class="form-control">' +
                    '<option value="">Select</option>' +
                    '<option value="true">YES</option>' +
                    '<option value="false">NO</option>' +
                    '</select>' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                    '</td>' +

                    '</tr>';

                $("#exp_table_body").append($(content));

                $('.datepicker').each(function(){
                    $(this).datepicker({
                        autoclose: true,
                        dateFormat: "mm/dd/yy",
                        orientation: "bottom"
                    });
                });

                $(this).removeClass('datepicker');

            });

        });




        {{-- Eligibility ADD ROW --}}
        $(document).ready(function() {

            $("#elig_add_row").on("click", function() {
                var i = $("#elig_table_body").children().length;
                var content ='<tr>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_elig[' + i + '][eligibility]" class="form-control" placeholder="Eligibility">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_elig[' + i + '][level]" class="form-control" placeholder="Level">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_elig[' + i + '][rating]" class="form-control" placeholder="Rating">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<div class="input-group-addon">' +
                    '<i class="fa fa-calendar"></i>' +
                    '</div>' +
                    '<input name="row_elig[' + i + '][exam_date]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                    '</div>' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<div class="form-group">' +
                    '<input type="text" name="row_elig[' + i + '][exam_place]" class="form-control" placeholder="Exam Place">' +
                    '</div>' +
                    '</td>' +

                    '<td>' +
                    '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                    '</td>' +

                    '</tr>';

                $("#elig_table_body").append($(content));

                $('.datepicker').each(function(){
                    $(this).datepicker({
                        autoclose: true,
                        dateFormat: "mm/dd/yy",
                        orientation: "bottom"
                    });
                });

                $(this).removeClass('datepicker');

            });

        });


        $(".select2_course").select2({
            ajax: {
                url: '{{route("dashboard.ajax.get","applicant_courses")}}',
                dataType: 'json',
                delay : 250,
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            },
        });



    </script>
    <script type="text/javascript" src="{{ asset('template/plugins/bloodhound/typeahead.js') }}"></script>
    <script type="text/javascript">
        var citynames = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '{{route("dashboard.ajax.get","position_applied")}}?rand={{\Illuminate\Support\Str::random()}}',
                filter: function(list) {
                    return $.map(list, function(cityname) {
                        return { name: cityname }; });
                }
            }
        });
        citynames.initialize();

        $("#position_applied").tagsinput({
            typeaheadjs: {
                name: 'citynames',
                displayKey: 'name',
                valueKey: 'name',
                source: citynames.ttAdapter(),
            }
        });


        $('#add_applicant_form').keydown(function(event) {
            if (event.ctrlKey && event.keyCode === 13) {
                alert();
            }
        })
    </script>
@endsection