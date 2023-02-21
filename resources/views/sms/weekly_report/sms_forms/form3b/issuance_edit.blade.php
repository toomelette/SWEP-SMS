@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id' => 'form3b_issuance_form_'.$rand,'slug'=>$issuance->slug])

@section('modal-header')
    Edit Issuance
@endsection

@section('modal-body')
    @include('sms.weekly_report.sms_forms.form3b.issuance_form')
@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#form3b_issuance_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.form3b_issuanceOfSro.update",$issuance->slug)}}',
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    active_form3b_issuance = res.slug;
                    form3b_issuance_tbl.draw(false);
                    updateTradersList();
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
        $("#form3b_issuance_form_{{$rand}} .iCheck").iCheck(iCheckRadioOptions);
    </script>
@endsection

