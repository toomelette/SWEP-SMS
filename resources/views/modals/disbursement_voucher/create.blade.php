
// DV CREATE SUCCESS
@if(Session::has('SESSION_DV_CREATE_SUCCESS'))

  {!! HtmlHelper::modal_print(
    'dv_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('SESSION_DV_CREATE_SUCCESS'), route('dashboard.disbursement_voucher.show', Session::get('SESSION_DV_CREATE_SUCCESS_SLUG'))
  ) !!}

@endif