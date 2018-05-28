@php

  $table_sessions = [ Session::get('DEPARTMENT_UNIT_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'order' => Request::get('order'),
                      ];

@endphp

@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Department Unit List</h1>
  </section>

  <section class="content">

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.department_unit.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.department_unit.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-bordered">
          <tr>
            <th>@sortablelink('name', 'Name')</th>
            <th>@sortablelink('department_name', 'Department')</th>
            <th>@sortablelink('description', 'Description')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($department_units as $data) 
            <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>{{ $data->name }}</td>
              <td>{{ $data->department_name }}</td>
              <td>{{ $data->description }}</td>
              <td> 
                <select id="action" class="form-control input-sm">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.department_unit.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.department_unit.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($department_units->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! HtmlHelper::table_counter($department_units) !!}
        {!! $department_units->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection


@section('modals')

  {!! HtmlHelper::modal_delete('department_unit_delete') !!}

@endsection 


@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('department_unit_delete') !!}

    {{-- FORM VARIABLES RULE --}}
    {!! JSHelper::table_action_rule() !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('DEPARTMENT_UNIT_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('DEPARTMENT_UNIT_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('DEPARTMENT_UNIT_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('DEPARTMENT_UNIT_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection