<?php

  $table_sessions = [ 
                      Session::get('PROJECT_CODE_UPDATE_SUCCESS_SLUG') 
                    ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                      ];

?>




@extends('layouts.admin-master')


@section('content')
    
  <section class="content-header">
      <h1>Project Code List</h1>
  </section>

  <section class="content">

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.project_code.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.project_code.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('project_code', 'Project Code')</th>
            <th>@sortablelink('department_name', 'Department')</th>
            <th>@sortablelink('description', 'Description')</th>
            <th>@sortablelink('project_in_charge', 'Project in Charge')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($project_codes as $data) 
            <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>{{ $data->project_code }}</td>
              <td>{{ $data->department_name }}</td>
              <td>{{ $data->description }}</td>
              <td>{{ $data->project_in_charge }}</td>
              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.project_code.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.project_code.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($project_codes->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! HtmlHelper::table_counter($project_codes) !!}
        {!! $project_codes->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

</section>

@endsection




@section('modals')

  {!! HtmlHelper::modal_delete('project_code_delete') !!}

@endsection 




@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('project_code_delete') !!}


    {{-- UPDATE TOAST --}}
    @if(Session::has('PROJECT_CODE_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('PROJECT_CODE_UPDATE_SUCCESS')) !!}
    @endif


    {{-- DELETE TOAST --}}
    @if(Session::has('PROJECT_CODE_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('PROJECT_CODE_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection