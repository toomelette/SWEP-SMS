@extends('layouts.modal-content',['form_id' => 'edit_jo_employee_form','slug'=>$jo->slug])

@section('modal-header')
    {{$jo->lastname}}, {{$jo->firstname}} - Edit
@endsection

@section('modal-body')

    <input value="{{$jo->slug}}" name="slug" hidden>

    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('firstname',[
            'label' => 'First Name:',
            'class' => 'basis',
            'cols' => 4,
            'id' => 'firstname',
        ],$jo) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('middlename',[
            'label' => 'Middle Name:',
            'class' => 'basis',
            'cols' => 4,
            'id' => 'middlename',
        ],$jo) !!}

        {!! \App\Swep\ViewHelpers\__form2::textbox('lastname',[
            'label' => 'Last Name:',
            'class' => 'basis',
            'cols' => 4,
            'id' => 'lastname',
        ],$jo) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::select('name_ext',[
            'cols' => 4,
            'label' => 'Suffix:',
            'options' => Helper::name_extensions(),
        ],$jo) !!}

        {!! \App\Swep\ViewHelpers\__form2::select('sex',[
            'cols' => 4,
            'label' => 'Sex:',
            'options' => Helper::sexArray(),
        ],$jo) !!}

        {!! \App\Swep\ViewHelpers\__form2::textbox('birthday',[
            'label' => 'Birthday:',
            'cols' => 4,
            'type' => 'date',
        ],$jo) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::select('civil_status',[
            'cols' => 4,
            'label' => 'Civil Status:',
            'options' => Helper::civil_status(),
        ],$jo) !!}

        {!! \App\Swep\ViewHelpers\__form2::textbox('email',[
            'label' => 'Email Address:',
            'cols' => 4,
            'id' => 'email',
        ],$jo) !!}

        {!! \App\Swep\ViewHelpers\__form2::textbox('phone',[
            'label' => 'Contact no.:',
            'cols' => 4,
            'id' => 'phone',
        ],$jo) !!}
    </div>
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
        Employment Details
    </p>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('employee_no',[
            'label' => 'Employee No.:',
            'cols' => 4,
            'id' => 'employee_no',
        ],$jo) !!}
        {!! \App\Swep\ViewHelpers\__form2::select('department_unit',[
            'cols' => 4,
            'label' => 'Department Unit:',
            'options' => Helper::departmentUnitArrayForSelect(),
        ],$jo) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('position',[
            'label' => 'Position:',
            'cols' => 4,
            'id' => 'position',
        ],$jo) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('biometric_user_id',[
            'label' => 'Biometric User Id:',
            'cols' => 4,
            'id' => 'biometric_user_id',
        ],$jo) !!}

    </div>
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
        Address
    </p>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::a_select('region',[
            'cols' => 4,
            'label' => 'Region:',
            'options' => [],
        ]) !!}

        {!! \App\Swep\ViewHelpers\__form2::a_select('province',[
            'cols' => 4,
            'label' => 'Province:',
            'options' => [
                $jo->province => $jo->province,
            ],
        ],$jo->province) !!}

        {!! \App\Swep\ViewHelpers\__form2::a_select('city',[
            'cols' => 4,
            'label' => 'Municipality/City:',
            'options' => [
                $jo->city => $jo->city,
            ],
        ],$jo->city) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::a_select('brgy',[
            'cols' => 4,
            'label' => 'Barangay:',
            'options' => [
                $jo->brgy => $jo->brgy,
            ],
        ],$jo->brgy) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('address_detailed',[
            'label' => 'Detailed Address:*',
            'cols' => 8,
            'id' => 'address_detailed',
        ],$jo) !!}
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
                e_selected = 'selected="selected"';
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

