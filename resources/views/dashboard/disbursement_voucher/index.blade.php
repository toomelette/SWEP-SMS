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

          {!! FormHelper::select_static_for_filter(
            '2', 'online', 'Login Status', old('online'), ['Online' => 'true', 'Offline' => 'false'], 'submit_user_filter', ''
          ) !!}

          {!! FormHelper::select_static_for_filter(
            '2', 'active', 'User Status', old('active'), ['Active' => 'true', 'Inactive' => 'false'], 'submit_user_filter', ''
          ) !!}

        {!! HtmlHelper::filter_close() !!}


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
                <th>User</th>
                <th>Doc No.</th>
                <th>DV No.</th>
                <th>Payee</th>
                <th>Account Code</th>
                <th>Date</th>
                <th>Status</th>
                <th style="width: 150px">Action</th>
              </tr>
              @foreach($disbursement_vouchers as $data) 
                <tr>
                  <td>{!! count($data->user) != 0 ? Str::limit($data->user->fullname, 25) : '<span class="text-red"><b>User does not exist!</b></span>' !!}</td>
                  <td>{{ $data->doc_no }}</td>
                  <td>{!! $data->dv_no == null ? '<span class="text-red"><b>Not Set!</b></span>' : $data->dv_no !!}</td>
                  <td>{{ $data->payee  }}</td>
                  <td>{{ $data->account_code }}</td>
                  <td>{{ Carbon::parse($data->date)->format('M d, Y') }}</td>
                  <td>{!! $data->dv_no == null ? '<span class="label label-warning">Filed..</span>' : '<span class="label label-primary">Processing..</span>' !!}</td>
                  <td> 
                    <select id="action" class="form-control input-sm">
                      <option value="">Select</option>
                      <option data-type="1" data-url="{{ route('dashboard.disbursement_voucher.show', $data->slug) }}">Details</option>
                      <option data-type="1" data-url="{{ route('dashboard.disbursement_voucher.edit', $data->slug) }}">Edit</option>
                      <option data-type="0" data-action="delete" data-url="{{ route('dashboard.disbursement_voucher.destroy', $data->slug) }}">Delete</option>
                      <option data-type="0" data-action="set_dv_no" data-value="{{ $data->dv_no }}" data-url="{{ route('dashboard.disbursement_voucher.set_no_post', $data->slug) }}">Set DV No.</option>
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
                  'q'=>Input::get('q'), 
                  'online' => Input::get('online'), 
                  'active' => Input::get('active'),
                ])->render('vendor.pagination.bootstrap-4')
            !!}
          </div>

        </div>

    </section>


@endsection






@section('modals')

  {!! HtmlHelper::modal_delete('dv_delete') !!}

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
    @if(Session::has('SESSION_DV_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('SESSION_DV_DELETE_SUCCESS')) !!}
    @endif


    {{-- DV SET NO TOAST --}}
    @if(Session::has('SESSION_DV_SET_NO_SUCCESS'))
      {!! JSHelper::toast(Session::get('SESSION_DV_SET_NO_SUCCESS')) !!}
    @endif
    

    $(document).on("change", "#action", function () {
      var element = $(this).children("option:selected");
      if(element.data("action") == "set_dv_no"){
        $("#dv_set_no").modal("show");
        $("#dv_set_no_form").attr("action", element.data("url"));
          $("#dv_set_no_form #dv_no").val(element.data("value"));
        $(this).val("");
      }
    });

  </script>
    
@endsection