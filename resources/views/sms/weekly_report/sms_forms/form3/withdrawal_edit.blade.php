@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id' => 'form3_edit_withdrawal_form_'.$rand,'slug'=>$withdrawal->slug])

@section('modal-header')
    Edit Withdrawal
@endsection

@section('modal-body')
    @include('sms.weekly_report.sms_forms.form3.withdrawals_form')

@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#form3_edit_withdrawal_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.form3_withdrawals.update",$withdrawal->slug)}}',
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    active_form3_withdrawals = res.slug;
                    form3_withdrawals.draw(false);
                    updateForm3(null);
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })

        $("#form3_edit_withdrawal_form_{{$rand}} .iCheck").iCheck(iCheckRadioOptions);
    </script>
@endsection

