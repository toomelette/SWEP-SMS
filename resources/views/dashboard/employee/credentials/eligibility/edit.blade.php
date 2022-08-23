@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id' => 'edit_elig_form_'.$rand, 'slug' => $elig->id])

@section('modal-header')
    {{$elig->eligibility}} - <small>Edit</small>
@endsection

@section('modal-body')
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('eligibility',[
            'label' => 'Eligibility:*',
            'cols' => 8,
        ],$elig) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('level',[
            'label' => 'Level:',
            'cols' => 4,
        ],$elig) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('rating',[
            'label' => 'Rating:',
            'cols' => 3,
            'type' => 'number',
            'step' => '0.01',
        ],$elig) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('exam_place',[
            'label' => 'Place of exam:',
            'cols' => 5,
        ],$elig) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('exam_date',[
            'label' => 'Date of exam:',
            'cols' => 4,
            'type' => 'date',
        ],$elig) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('license_no',[
            'label' => 'License No.:',
            'cols' => 4,
        ],$elig) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('license_validity',[
            'label' => 'License Validity:',
            'cols' => 4,
            'type' => 'date',
        ],$elig) !!}
    </div>


@endsection

@section('modal-footer')
<button class="btn  btn-success btn-sm" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
<script type="text/javascript">
    $("#edit_elig_form_{{$rand}}").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        let uri  = '{{route("dashboard.employee.elig.update","slug")}}';
        uri = uri.replace('slug','{{$elig->id}}');
        $.ajax({
            url : uri,
            data : form.serialize(),
            type: 'PATCH',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form, true, true);
                $("#elig_active_{{$passed_rand}}").val(res.id);
                elig_tbl_{{$passed_rand}}.draw(false);
                notify('Data successfully saved.','success');
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>
@endsection

