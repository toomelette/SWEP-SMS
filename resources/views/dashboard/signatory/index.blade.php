<?php

  $table_sessions = [ Session::get('SIGNATORY_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                      ];

?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Signatories List</h1>
  </section>

  <section class="content">

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.signatory.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.signatory.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('employee_name', 'Employee Name')</th>
            <th>@sortablelink('employee_position', 'Employee Position')</th>
            <th>@sortablelink('type', 'Type')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($signatories as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{{ $data->employee_name }}</td>
              <td id="mid-vert">{{ $data->employee_position }}</td>
              <td id="mid-vert">{{ $data->type }}</td>
              <td id="mid-vert"> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.signatory.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.signatory.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($signatories->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($signatories) !!}
        {!! $signatories->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('sig_delete') !!}

@endsection 






@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('sig_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('SIGNATORY_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('SIGNATORY_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('SIGNATORY_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('SIGNATORY_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection