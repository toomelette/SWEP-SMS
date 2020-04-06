<?php

  $table_sessions = [ Session::get('COURSE_UPDATE_SUCCESS_SLUG') ];

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
      <h1>Course List</h1>
  </section>

  <section class="content">

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.course.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.course.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('acronym', 'Acronym')</th>
            <th>@sortablelink('name', 'Name')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($courses as $data) 
            <tr {!! __html::table_highlighter( $data->slug, $table_sessions) !!} >
              <td id="mid-vert">{{ $data->acronym }}</td>
              <td id="mid-vert">{{ $data->name }}</td>
              <td id="mid-vert"> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.course.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.course.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($courses->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($courses) !!}
        {!! $courses->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection




@section('modals')

  {!! __html::modal_delete('course_delete') !!}

@endsection 




@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('course_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('COURSE_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('COURSE_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('COURSE_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('COURSE_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection