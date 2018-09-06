@php
  $table_sessions = [ 
                      Session::get('PS_UPDATE_SUCCESS_SLUG'),
                    ];

  $appended_requests = [
                        'q'=> Request::get('q'), 
                        'fs' => Request::get('fs'), 
                        'sort' => Request::get('sort'),
                        'order' => Request::get('order'),
                      ];
@endphp



@extends('layouts.admin-master')



@section('content')
    
  <section class="content-header">
      <h1>Permission Slip List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.permission_slip.index') }}">

    {{-- Advance Filters --}}
    {!! HtmlHelper::filter_open() !!}
        
      {!! FormHelper::select_dynamic_for_filter(
        '12', 'emp', 'Employee', old('emp'), $global_employees_all, 'employee_no', 'fullname', 'submit_ps_filter', 'select2'
      ) !!}

      <section>
        
        <h5>Date Filter : </h5>

        {!! FormHelper::datepicker('3', 'd',  'Date', old('d'), '', '') !!}

        <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

      </section>


    {!! HtmlHelper::filter_close('submit_ps_filter') !!}


    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.disbursement_voucher.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('ps_id', 'Control No.')</th>
            <th>@sortablelink('employee.fullname', 'Employee')</th>
            <th>@sortablelink('date', 'Date')</th>
            <th>@sortablelink('time_out', 'Time Out')</th>
            <th>@sortablelink('time_in', 'Time In')</th>
            <th>Status</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($permission_slips as $data) 
            <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>{{ $data->ps_id }}</td>
              <td>{{ $data->employee->fullname }}</td>
              <td>{{ $data->date }}</td>
              <td>{{ $data->time_out  }}</td>
              <td>{{ $data->time_out}}</td>

              <td> 
                <select id="action" class="form-control input-md">
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

      @if($permission_slips->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! HtmlHelper::table_counter($permission_slips) !!}
        {!! $permission_slips->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection






@section('modals')

  {!! HtmlHelper::modal_delete('ps_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('ps_delete') !!}

    {{-- PS DELETE TOAST --}}
    @if(Session::has('PS_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('PS_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection