@php

  $table_sessions = [
                      Session::get('EMPLOYEE_UPDATE_SUCCESS_SLUG')
                    ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'order' => Request::get('order'),
                      ];

  $span_user_not_exist = '<span class="text-red"><b>User does not exist!</b></span>';

@endphp


@extends('layouts.admin-master')


@section('content')
    
  <section class="content-header">
      <h1>Employee List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.employee.index') }}">

    {{-- Advance Filters --}}
    {!! HtmlHelper::filter_open() !!}

      

    {!! HtmlHelper::filter_close('submit_emp_filter') !!}


    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.employee.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-bordered">
          <tr>
            <th>@sortablelink('empno', 'Employee No.')</th>
            <th>@sortablelink('empname', 'Fullname')</th>
            <th>@sortablelink('position', 'Position')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($employees as $data) 

            <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
              
              <td>{{ $data->empno }}</td>
              <td>{{ $data->empname }}</td>
              <td>{{ $data->position }}</td>
              <td> 
                <select id="action" class="form-control input-sm">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.employee.show', $data->slug) }}">Details</option>
                  <option data-type="1" data-url="{{ route('dashboard.employee.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.employee.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>

            </tr>

            @endforeach
        </table>
      </div>

      @if($employees->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! HtmlHelper::table_counter($employees) !!}
        {!! $employees->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

  <form id="dv_confirm_check_form" method="POST" style="display: none;">
    @csrf
  </form>

@endsection




@section('modals')

  {!! HtmlHelper::modal_delete('emp_delete') !!}

@endsection 




@section('scripts')

  <script type="text/javascript">

    {!! JSHelper::modal_confirm_delete_caller('emp_delete') !!}

    {!! JSHelper::table_action_rule() !!}

    @if(Session::has('EMPLOYEE_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('EMPLOYEE_UPDATE_SUCCESS')) !!}
    @endif

    @if(Session::has('EMPLOYEE_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('EMPLOYEE_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection