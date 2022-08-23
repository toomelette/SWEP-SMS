@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id' => 'edit_educ_bg_form_'.$rand, 'slug' => $ebg->id])

@section('modal-header')
    {{$ebg->level}} - <small>{{$ebg->school_name}}</small>
@endsection

@section('modal-body')
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::select('level',[
            'label' => 'Level:',
            'cols' => 4,
            'options' => \App\Swep\Helpers\Helper::educationalLevels(),
        ],$ebg) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('school_name',[
            'label' => 'School:',
            'cols' => 8,
        ],$ebg) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('course',[
            'label' => 'Course:',
            'cols' => 6,
        ],$ebg) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('date_from',[
            'label' => 'Date From:',
            'cols' => 3,
        ],$ebg) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('date_to',[
            'label' => 'Date To:',
            'cols' => 3,
        ],$ebg) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('units',[
            'label' => 'Units:',
            'cols' => 2,
        ],$ebg) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('graduate_year',[
            'label' => 'Year Graduated:',
            'cols' => 3,
        ],$ebg) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('scholarship',[
            'label' => 'Scholarship:',
            'cols' => 7,
        ],$ebg) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('honor',[
            'label' => 'Honor:',
            'cols' => 6,
        ],$ebg) !!}
    </div>

@endsection

@section('modal-footer')
    <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#edit_educ_bg_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            let uri = '{{route("dashboard.employee.educ_bg.update","slug")}}';
            uri = uri.replace("slug",form.attr("data"));
            $.ajax({
                url : uri,
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    $("#educ_active_{{$passed_rand}}").val(res.id);
                    educ_tbl_{{$passed_rand}}.draw(false);
                    notify('Data successfully saved.');
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
    </script>
@endsection

