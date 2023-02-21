@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id' => 'edit_issuance_form_'.$rand,'slug'=>$issuance->slug])

@section('modal-header')
    Edit Issuance
@endsection

@section('modal-body')
    @include('sms.weekly_report.sms_forms.form5.issuance_form')
@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#edit_issuance_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.form5_issuanceOfSro.update",$issuance->slug)}}',
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    $('dt[for="form5TotalIssuances"]').html(res.totalForm5Issuance);
                    active_form5_issuancesOfSro = res.slug;
                    issuancesOfSro_tbl.draw(false);
                    updateTradersList();
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })

    </script>
@endsection

