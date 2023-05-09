@extends('layouts.admin-master')

@section('content')

<section class="content-header">

</section>
@endsection
@section('content2')

<section class="content">
    <div class="login-box">
        <div class="login-logo">
            SMS Weekly Report
        </div>

        <div class="login-box-body">
            <form id="add_report_week_form">
                @csrf

                    <div class="row">
                        <div class="form-group  col-md-12">
                            <label for="crop_year">Mill Code:*</label>
                            <h4 class="no-margin"><b>{{\Illuminate\Support\Facades\Auth::user()->mill_code}}</b></h4>
                        </div>

{{--                        {!! \App\Swep\ViewHelpers\__form2::select('crop_year',[--}}
{{--                            'label' => 'Crop Year:*',--}}
{{--                            'cols' => 12,--}}
{{--                            'options' => \App\Swep\Helpers\Arrays::cropYears(),--}}
{{--                        ]) !!}--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textbox('week_ending',[--}}
{{--                            'label' => 'Week Ending:*',--}}
{{--                            'cols' => 12,--}}
{{--                            'type' => 'date',--}}
{{--                        ]) !!}--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textbox('report_no',[--}}
{{--                            'label' => 'Report No.:*',--}}
{{--                            'cols' => 12,--}}
{{--                            'type' => 'number',--}}
{{--                            'step' => 1,--}}
{{--                        ]) !!}--}}
                        {!! \App\Swep\ViewHelpers\__form2::select('calendar_slug',[
                            'label' => 'Report No.',
                            'cols' => 12,
                            'options' => \App\Swep\Helpers\Arrays::calendar(),
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('dist_no',[
                            'label' => 'Distribution No:*',
                            'cols' => 12,
                            'type' => 'number',
                            'step' => 1,
                        ]) !!}
                    </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    <i class="fa fa-check"> </i> SAVE
                </button>
            </form>

        </div>

    </div>

</section>


@endsection


@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
    $("#add_report_week_modal").modal('show');

    $("#add_report_week_form").submit(function (e) {
        e.preventDefault();
        let uri = '{{route("dashboard.weekly_report.store")}}';
        let form = $(this);
        let rdr = '{{route('dashboard.weekly_report.edit','slug')}}';
        loading_btn(form);
        $.ajax({
            url : uri,
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                window.location = res.slug+'/edit';
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
    $(".add_btn").click(function () {
        let btn = $(this);
        let data = btn.attr('data');
        let uri = '{{route("dashboard.ajax.get","for")}}';
        uri = uri.replace('for',data);
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                console.log(res);
                $("#"+data+" tbody").append(res);
            },
            error: function (res) {
                notify(res.responseJSON.message,'danger');
            }
        });
    })
    $("body").on("click",'.remove_row_btn',function () {
        let btn = $(this);
        let data = btn.attr('data');
        $("#tr_"+data).remove();
    })

    $("#form_1").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let uri = '{{route("dashboard.sms_form1.store")}}';
        $.ajax({
            url : uri,
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,true,false);
                $(".sms_form1_table").each(function () {
                    $(this).find('tbody').html('');
                })
                $("#form_1 .add_btn").each(function () {
                    $(this).trigger('click');
                })
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>

@endsection