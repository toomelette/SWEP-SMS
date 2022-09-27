@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id' => 'form5a_issuance_form_'.$rand,'slug'=>$issuance->slug])

@section('modal-header')
    Edit Issuance
@endsection

@section('modal-body')
    @include('sms.weekly_report.sms_forms.form5a.issuance_form')
@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#form5a_issuance_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.form5a_issuanceOfSro.update",$issuance->slug)}}',
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    active_form5a_issuance = res.slug;
                    form5a_issuance_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
    </script>
@endsection

