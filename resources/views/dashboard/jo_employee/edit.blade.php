@extends('layouts.modal-content',['form_id' => 'edit_jo_employee_form','slug'=>$jo->slug])

@section('modal-header')
    {{$jo->lastname}}, {{$jo->firstname}} - Edit
@endsection

@section('modal-body')

    <input value="{{$jo->slug}}" name="slug" hidden>

    <div class="row">
        {!! __form::textbox(
           '4 firstname', 'firstname', 'text', 'First name *', 'First name', $jo, 'firstname', '', ''
         ) !!}

        {!! __form::textbox(
           '4 middlename', 'middlename', 'text', 'Middle name *', 'Middle name', $jo, 'middlename', '', ''
         ) !!}

        {!! __form::textbox(
           '4 lastname', 'lastname', 'text', 'Last name *', 'Last name', $jo, 'lastname', '', ''
         ) !!}
    </div>
    <div class="row">
        {!! __form::select_static(
            '4 name_ext', 'name_ext', 'Suffix', $jo, Helper::name_extensions(), '', '', '', ''
        ) !!}

        {!! __form::select_static(
            '4 sex', 'sex', 'Sex*', $jo, Helper::sexArray(), '', '', '', ''
        ) !!}

        {!! __form::textbox(
           '4 birthday', 'birthday', 'date', 'Birthday *', 'Birthday', $jo, 'birthday', '', ''
         ) !!}
    </div>
    <div class="row">
        {!! __form::select_static(
            '4 civil_status', 'civil_status', 'Civil Status', $jo, Helper::civil_status(), '', '', '', ''
        ) !!}

        {!! __form::textbox(
           '4 email', 'email', 'text', 'Email Address *', 'Email address', $jo, 'email', '', ''
         ) !!}

        {!! __form::textbox(
           '4 phone', 'phone', 'text', 'Contact no. *', 'Contact no', $jo, 'phone', '', ''
         ) !!}
    </div>
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
        Employment Details
    </p>
    <div class="row">
        {!! __form::textbox(
           '4 employee_no', 'employee_no', 'text', 'Employee No *', 'Employee No.', $jo, 'employee_no', '', ''
         ) !!}

        {!! __form::select_static2(
            '4 department_unit', 'department_unit', 'Department Unit', $jo, \App\Swep\Helpers\Helper::departmentUnitArrayForSelect(), '', '', '', ''
        ) !!}

        {!! __form::textbox(
           '4 position', 'position', 'text', 'Position *', 'Position', $jo, 'position', '', ''
         ) !!}
    </div>
    <div class="row">
        {!! __form::textbox(
           '4 biometric_user_id', 'biometric_user_id', 'text', 'Biometric User Id:*', 'Biometric User Id', $jo, 'biometric_user_id', '', ''
         ) !!}
    </div>
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
        Address
    </p>
    <div class="row">
        {!! __form::a_select('4 region', 'Region:*', 'region', [], '' , '') !!}
        {!! __form::a_select('4 province', 'Province:*', 'province', [
            $jo->province => $jo->province
        ], $jo->province , '') !!}

        {!! __form::a_select('4 city', 'Municipality/City:*', 'city', [
            $jo->city => $jo->city
        ], $jo->city , '') !!}
    </div>
    <div class="row">
        {!! __form::a_select('4 brgy', 'Barangay:*', 'brgy', [
            $jo->brgy => $jo->brgy
        ], $jo->brgy , '') !!}
        {!! __form::textbox(
           '8 address_detailed', 'address_detailed', 'text', 'Detailed Address *', 'Detailed Address', $jo, 'address_detailed', '', ''
         ) !!}
    </div>
@endsection

@section('modal-footer')
    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>
@endsection

@section('scripts')
<script type="text/javascript">
    var regions;

    default_region = 6;

    $.getJSON('{{asset("json/regions.json")}}', function(data){
        regions = data;
        $.each(data, function(i, item){
            e_selected = '';
            if(i == default_region){
                e_selected = 'e_selected';
            }
            $("#edit_jo_employee_form select[name='region']").append('<option value="'+i+'" '+e_selected+'>'+item.region_name+'</option>');
        })
    })

    e_html_region = $("#edit_jo_employee_form select[name='region']");
    e_html_province = $("#edit_jo_employee_form select[name='province']");
    e_html_municipality = $("#edit_jo_employee_form select[name='city']");
    e_html_barangay = $("#edit_jo_employee_form select[name='brgy']");



    e_html_region.change(function(){
        e_selected = $(this).val();
        e_html_province.html('<option value="">Select</option>');
        e_html_municipality.html('<option value="">Select</option>');
        e_html_barangay.html('<option value="">Select</option>');

        $.each(regions[e_selected]['province_list'], function(i,item){
            e_html_province.append('<option value="'+i+'">'+i+'</option>');
        })
    });



    e_html_province.change(function(){
        e_selected = $(this).val();
        e_html_municipality.html('<option value="">Select</option>');
        e_html_barangay.html('<option value="">Select</option>');

        $.each(regions[e_html_region.val()]['province_list'][e_selected]['municipality_list'], function(i,item){
            e_html_municipality.append('<option value="'+i+'">'+i+'</option>');
        });

    });

    e_html_municipality.change(function(){
        e_selected = $(this).val();
        e_html_barangay.html('<option value="">Select</option>');
        $.each(regions[e_html_region.val()]['province_list'][e_html_province.val()]['municipality_list'][e_selected]['barangay_list'], function(i,item){
            e_html_barangay.append('<option value="'+item+'">'+item+'</option>');
        })
    })


    $("#edit_jo_employee_form").submit(function (e) {
        e.preventDefault();
        form = $(this);
        url = '{{route("dashboard.jo_employees.update","slug")}}';
        url = url.replace('slug',form.attr('data'));
        loading_btn(form);
        $.ajax({
            url : url,
            data : form.serialize(),
            type: 'PATCH',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                notify('Changes successfully saved','success');
               succeed(form,true,true);
               active = res.slug;
               jo_employees_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })


</script>
@endsection

