<?php

  $table_sessions = [ 
                      Session::get('DV_SET_NO_SUCCESS_SLUG'),
                      Session::get('DV_CONFIRM_CHECK_SUCCESS_SLUG'),
                    ];

  $appended_requests = [
                        'q'=> Request::get('q'), 
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),

                        'fs' => Request::get('fs'), 
                        'pi' => Request::get('pi'),
                        'dn' => Request::get('dn'),
                        'dun' => Request::get('dun'),
                        'pc' => Request::get('pc'),
                        'df' => Request::get('df'),
                        'dt' => Request::get('dt'),
                      ];

  $span_user_not_exist = '<span class="text-red"><b>User does not exist!</b></span>';
  
?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Disbursement Voucher List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.disbursement_voucher.index') }}">

    {{-- Advance Filters --}}
    {!! __html::filter_open() !!}

      {!! __form::select_dynamic_for_filter(
        '3', 'dn', 'Department', old('dn'), $global_departments_all, 'name', 'name', 'submit_dv_filter', 'select2', 'style="width:100%;"'
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '3', 'dun', 'Unit', old('dun'), $global_department_units_all, 'name', 'description', 'submit_dv_filter', 'select2', 'style="width:100%;"'
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '2', 'pc', 'Project Code', old('pc'), $global_project_codes_all, 'project_code', 'project_code', 'submit_dv_filter', 'select2', 'style="width:100%;"'
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '2', 'fs', 'Fund Source', old('fs'), $global_fund_source_all, 'fund_source_id', 'description', 'submit_dv_filter', '', ''
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '2', 'pi', 'Station', old('pi'), $global_projects_all, 'project_id', 'project_address', 'submit_dv_filter', '', ''
      ) !!}

      <div class="col-md-12 no-padding">
        
        <h5>Date Filter : </h5>

        {!! __form::datepicker('3', 'df',  'From', old('df'), '', '') !!}

        {!! __form::datepicker('3', 'dt',  'To', old('dt'), '', '') !!}

        <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

      </div>

    {!! __html::filter_close('submit_dv_filter') !!}


    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.disbursement_voucher.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th style="width:250px;">@sortablelink('payee', 'Payee')</th>
            <th>@sortablelink('dv_no', 'DV No.')</th>
            <th style="width:600px;">Explanation</th>
            <th>@sortablelink('date', 'Date')</th>
            <th>@sortablelink('amount', 'Amount')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($disbursement_vouchers as $data) 
            <tr {!! __html::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>{{ Str::limit($data->payee, 30)  }}</td>
              <td>
                @if($data->dv_no == null)
                  <a href="#" id="dv_set_no_link" data-value="{{ $data->dv_no }}" data-url="{{ route('dashboard.disbursement_voucher.set_no_post', $data->slug) }}" class="text-red" style="text-decoration:underline;">
                    <b>Not Set!</b>
                  </a> 
                @else
                  <a href="#" id="dv_set_no_link" data-value="{{ $data->dv_no }}" data-url="{{ route('dashboard.disbursement_voucher.set_no_post', $data->slug) }}" style="text-decoration:underline;">
                    <b>{{ $data->dv_no }}</b>
                  </a>
                @endif
              </td>
              <td style="font-size:15px;">{!! Str::limit(strip_tags($data->explanation), 75)  !!}</td>
              <td>{{ __dataType::date_parse($data->date, 'M d, Y') }}</td>
              <td>{{ number_format($data->amount, 2) }}</td>

              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.disbursement_voucher.show', $data->slug) }}">Print</option>
                  <option data-type="1" data-url="{{ route('dashboard.disbursement_voucher.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.disbursement_voucher.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>

            </tr>
            @endforeach
        </table>
      </div>

      @if($disbursement_vouchers->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($disbursement_vouchers) !!}
        {!! $disbursement_vouchers->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

  <form id="dv_confirm_check_form" method="POST" style="display: none;">
    @csrf
  </form>

@endsection






@section('modals')

  {!! __html::modal_delete('dv_delete') !!}

  {!! __html::modal(
    'dv_confirm_check_failed', '<i class="fa fa-fw fa-ban"></i> Failed!', Session::get('SESSION_DV_CONFIRM_CHECK_FAILED')
  ) !!}

  {{-- SET DV NO Modal --}}
  <div class="modal fade" id="dv_set_no" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form id="dv_set_no_form" class="form-horizontal" method="POST" autocomplete="off">
            @csrf
            <p style="font-size: 17px;">Set DV No.</p><br>

            <input name="_method" value="PATCH" type="hidden">

            {!! __form::textbox_inline(
                'dv_no', 'text', 'DV No.', 'DV No.', old('dv_no'), $errors->has('dv_no'), $errors->first('dv_no'), ''
            ) !!}
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('dv_delete') !!}

    {{-- DV DELETE TOAST --}}
    @if(Session::has('DV_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('DV_DELETE_SUCCESS')) !!}
    @endif

    {{-- DV SET NO TOAST --}}
    @if(Session::has('DV_SET_NO_SUCCESS'))
      {!! __js::toast(Session::get('DV_SET_NO_SUCCESS')) !!}
    @endif

    {{-- DV CONFIRM CHECK SUCCESS TOAST --}}
    @if(Session::has('DV_CONFIRM_CHECK_SUCCESS'))
      {!! __js::toast(Session::get('DV_CONFIRM_CHECK_SUCCESS')) !!}
    @endif

    {{-- CALL CONFIRM CHECK --}}
    {!! __js::form_submitter_via_action('confirm_check', 'from_confirm_check') !!}

    {{-- CALL CONFIRM CHECK FAILED MODAL --}}
    @if(Session::has('DV_CONFIRM_CHECK_FAILED'))
      $('#dv_confirm_check_failed').modal('show');
    @endif

    {{-- CALL DV SET NO MODAL --}}
    $(document).on("click", "#dv_set_no_link", function () {
        $("#dv_set_no").modal("show");
        $("#dv_set_no_form").attr("action", $(this).data("url"));
        $("#dv_set_no_form #dv_no").val($(this).data("value"));
    });

    {{-- SUBMIT DV CONFIRM CHECK FORM --}}
    $(document).on("click", "#dv_confirm_check_link", function () {
        $("#dv_confirm_check_form").attr("action", $(this).data("url"));
        $("#dv_confirm_check_form").submit();
    });

  </script>
    
@endsection