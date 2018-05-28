@php

  $table_sessions = [ Session::get('ACCOUNT_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'order' => Request::get('order'),
                      ];

@endphp


@extends('layouts.admin-master')


@section('content')
    
  <section class="content-header">
      <h1>Account List</h1>
  </section>

  <section class="content">

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.account.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.account.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-bordered">
          <tr>
            <th>@sortablelink('account_code', 'Account Code')</th>
            <th>@sortablelink('department_name', 'Department')</th>
            <th>@sortablelink('description', 'Description')</th>
            <th>@sortablelink('project_in_charge', 'Project in Charge')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($accounts as $data) 
            <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>{{ $data->account_code }}</td>
              <td>{{ $data->department_name }}</td>
              <td>{{ $data->description }}</td>
              <td>{{ $data->project_in_charge }}</td>
              <td> 
                <select id="action" class="form-control input-sm">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.account.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.account.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($accounts->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! HtmlHelper::table_counter($accounts) !!}
        {!! $accounts->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

</section>

@endsection


@section('modals')

  {!! HtmlHelper::modal_delete('account_delete') !!}

@endsection 


@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('account_delete') !!}

    {{-- FORM VARIABLES RULE --}}
    {!! JSHelper::table_action_rule() !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('ACCOUNT_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('ACCOUNT_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('ACCOUNT_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('ACCOUNT_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection