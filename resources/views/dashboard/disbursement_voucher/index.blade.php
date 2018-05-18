@extends('layouts.admin-master')

@section('content')
    
      <section class="content-header">
          <h1>Disbursement Voucher List</h1>
      </section>

      <section class="content">
        
        {{-- Form Start --}}
        <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.disbursement_voucher.index') }}">

        {{-- Advance Filters --}}
        {!! HtmlHelper::filter_open() !!}

          {!! FormHelper::select_dynamic_for_filter(
            '3', 'fs', 'Fund Source', old('fs'), $global_fund_source_all, 'fund_source_id', 'description', 'submit_dv_filter', ''
          ) !!}

          {!! FormHelper::select_dynamic_for_filter(
            '3', 'pi', 'Station', old('pi'), $global_projects_all, 'project_id', 'project_address', 'submit_dv_filter', ''
          ) !!}

          {!! FormHelper::select_dynamic_for_filter(
            '2', 'dn', 'Department', old('dn'), $global_departments_all, 'name', 'name', 'submit_dv_filter', ''
          ) !!}

          {!! FormHelper::select_dynamic_for_filter(
            '2', 'dun', 'Unit', old('dun'), $global_department_units_all, 'name', 'name', 'submit_dv_filter', ''
          ) !!}

          {!! FormHelper::select_dynamic_for_filter(
            '2', 'ac', 'Account Code', old('ac'), $global_accounts_all, 'account_code', 'account_code', 'submit_dv_filter', ''
          ) !!}

          <section>
            
            <h5>Date Filter : </h5>

            {!! FormHelper::datepicker('3', 'df',  'From', old('df'), '', '') !!}

            {!! FormHelper::datepicker('3', 'dt',  'To', old('dt'), '', '') !!}

            <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

          </section>

        {!! HtmlHelper::filter_close('submit_dv_filter') !!}


        <div class="box" id="pjax-container">

          {{-- Table Search --}}        
          <div class="box-header with-border">
            {!! HtmlHelper::table_search(route('dashboard.disbursement_voucher.index')) !!}
          </div>

        {{-- Form End --}}  
        </form>

          {{-- Table Grid --}}        
          <div class="box-body no-padding">
            <table class="table table-bordered">
              <tr>
                <th>@sortablelink('user.firstname', 'User')</th>
                <th>@sortablelink('doc_no', 'Doc No.')</th>
                <th>@sortablelink('dv_no', 'DV No.')</th>
                <th>@sortablelink('payee', 'Payee')</th>
                <th>@sortablelink('account_code', 'Account Code')</th>
                <th>@sortablelink('date', 'Date')</th>
                <th>Status</th>
                <th style="width: 150px">Action</th>
              </tr>
              @foreach($disbursement_vouchers as $data) 
                <tr
                  {!! HtmlHelper::table_highlighter( $data->slug, [ 
                      Session::get('DV_SET_NO_SUCCESS_SLUG'),
                      Session::get('DV_CONFIRM_CHECK_SUCCESS_SLUG'),
                    ])
                  !!}
                >
                  <td>{!! count($data->user) != 0 ? SanitizeHelper::html_encode(Str::limit($data->user->fullnameShort, 25)) : '<span class="text-red"><b>User does not exist!</b></span>' !!}</td>
                  <td>{{ $data->doc_no }}</td>
                  <td>
                    @if($data->dv_no == null)
                      <a href="#" id="dv_set_no_link" data-value="{{ $data->dv_no }}" data-url="{{ route('dashboard.disbursement_voucher.set_no_post', $data->slug) }}" class="text-red" style="text-decoration:underline;"><b>Not Set!</b></a> 
                    @else
                      <a href="#" id="dv_set_no_link" data-value="{{ $data->dv_no }}" data-url="{{ route('dashboard.disbursement_voucher.set_no_post', $data->slug) }}" style="text-decoration:underline;"><b>{{ $data->dv_no }}</b></a>
                    @endif
                  </td>
                  <td>{{ $data->payee  }}</td>
                  <td>{{ $data->account_code }}</td>
                  <td>{{ Carbon::parse($data->date)->format('M d, Y') }}</td>
                  <td>
                    @if($data->processed_at == null && $data->checked_at == null)
                      <span class="label label-warning">Filed..</span>
                    @elseif($data->processed_at != null && $data->checked_at == null)
                      <span class="label label-primary">Processing..</span> | <a href="#" id="dv_confirm_check_link" data-url="{{ route('dashboard.disbursement_voucher.confirm_check', $data->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-check"></i></a>
                    @elseif($data->processed_at != null && $data->checked_at != null)
                      <span class="label label-success">Completed!</span>
                    @endif
                  </td>
                  <td> 
                    <select id="action" class="form-control input-sm">

                      <option value="">Select</option>

                      <option data-type="1" data-url="{{ route('dashboard.disbursement_voucher.show', $data->slug) }}">Details</option>

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
            <strong>Displaying {{ $disbursement_vouchers->firstItem() > 0 ? $disbursement_vouchers->firstItem() : 0 }} - {{ $disbursement_vouchers->lastItem() > 0 ? $disbursement_vouchers->lastItem() : 0 }} out of {{ $disbursement_vouchers->total()}} Records</strong>
            {!! $disbursement_vouchers->appends([
                'q'=> Request::get('q'), 
                'fs' => Request::get('fs'), 
                'pi' => Request::get('pi'),
                'dn' => Request::get('dn'),
                'dun' => Request::get('dun'),
                'ac' => Request::get('ac'),
                'df' => Request::get('df'),
                'dt' => Request::get('dt'),
                'sort' => Request::get('sort'),
                'order' => Request::get('order'),
              ])->render('vendor.pagination.bootstrap-4')
            !!}
          </div>

        </div>

    </section>

    <form id="dv_confirm_check_form" method="POST" style="display: none;">
      @csrf
    </form>

@endsection






@section('modals')

  {!! HtmlHelper::modal_delete('dv_delete') !!}

  {!! HtmlHelper::modal('dv_confirm_check_failed', '<i class="fa fa-fw fa-ban"></i> Failed!', Session::get('SESSION_DV_CONFIRM_CHECK_FAILED')) !!}

  {{-- SET DV NO Modal --}}
  <div class="modal fade" id="dv_set_no" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form id="dv_set_no_form" class="form-horizontal" method="POST" autocomplete="off">
            @csrf
            <p style="font-size: 17px;">Set DV No.</p><br>

            {!! FormHelper::textbox_inline(
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
    {!! JSHelper::modal_confirm_delete_caller('dv_delete') !!}


    {{-- FORM VARIABLES RULE --}}
    {!! JSHelper::table_action_rule() !!}


    {{-- DV DELETE TOAST --}}
    @if(Session::has('DV_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('DV_DELETE_SUCCESS')) !!}
    @endif


    {{-- DV SET NO TOAST --}}
    @if(Session::has('DV_SET_NO_SUCCESS'))
      {!! JSHelper::toast(Session::get('DV_SET_NO_SUCCESS')) !!}
    @endif
    

    {{-- DV CONFIRM CHECK SUCCESS TOAST --}}
    @if(Session::has('DV_CONFIRM_CHECK_SUCCESS'))
      {!! JSHelper::toast(Session::get('DV_CONFIRM_CHECK_SUCCESS')) !!}
    @endif

    
    {{-- CALL CONFIRM CHECK --}}
    {!! JSHelper::form_submitter_via_action('confirm_check', 'from_confirm_check') !!}


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
        $("#dv_set_no_form").attr("action", $(this).data("url"));
        $("#dv_set_no_form").submit();
    });


    {{-- Date Picker --}}
    {!! JSHelper::datepicker_caller('df', 'mm/dd/yy', 'bottom') !!}
    {!! JSHelper::datepicker_caller('dt', 'mm/dd/yy', 'bottom') !!}

  </script>
    
@endsection