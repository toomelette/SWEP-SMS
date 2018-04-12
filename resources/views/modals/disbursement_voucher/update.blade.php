
{{-- DV CREATE SUCCESS --}}
@if(Session::has('SESSION_DV_UPDATE_SUCCESS'))

  {!! HtmlHelper::modal_print(
    'dv_update', '<i class="fa fa-fw fa-check"></i> Updated!', Session::get('SESSION_DV_UPDATE_SUCCESS'), route('dashboard.disbursement_voucher.show', Session::get('SESSION_DV_UPDATE_SUCCESS_SLUG'))
  ) !!}

@endif