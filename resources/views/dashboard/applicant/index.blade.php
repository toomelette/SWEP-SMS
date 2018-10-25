<?php

  $table_sessions = [ Session::get('APPLICANT_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        
                        'c' => Request::get('c'),
                        'p' => Request::get('p'),
                        'g' => Request::get('g'),
                      ];
                      
?>




@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Applicant List</h1>
  </section>

  <section class="content">

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.applicant.index') }}">

    {{-- Advance Filters --}}
    {!! __html::filter_open() !!}

      {!! __form::select_dynamic_for_filter(
        '3', 'c', 'Course', old('c'), $global_courses_all, 'course_id', 'name', 'submit_applicant_filter', 'select2', 'style="width:100%;"'
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '3', 'p', 'Position Applied For', old('p'), $global_plantilla_all, 'plantilla_id', 'name', 'submit_applicant_filter', 'select2', 'style="width:100%;"'
      ) !!}

      {!!
        __form::select_static_for_filter('3', 'g', 'Gender', old('leave_t'), ['Male' => 'MALE', 'Female' => 'FEMALE'], 'submit_applicant_filter', '', '') 
      !!}

    {!! __html::filter_close('submit_applicant_filter') !!}


    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.applicant.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('fullname', 'Name')</th>
            <th>@sortablelink('applicantPositionApplied.position', 'Position Applied For')</th>
            <th>@sortablelink('course.description', 'Course')</th>
            <th>@sortablelink('date_of_birth', 'Age')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($applicants as $data) 
            <tr {!! __html::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>{{ $data->fullname }}</td>
              <td>{{ empty($data->plantilla) ? '' : $data->plantilla->name }}</td>
              <td>{{ empty($data->course) ? '' : $data->course->name }}</td>
              <td>{{ Carbon::parse($data->date_of_birth)->age }}</td>
              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.applicant.show', $data->slug) }}">Details</option>
                  <option data-type="1" data-url="{{ route('dashboard.applicant.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.applicant.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($applicants->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($applicants) !!}
        {!! $applicants->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection




@section('modals')

  {!! __html::modal_delete('applicant_delete') !!}

@endsection 




@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('applicant_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('APPLICANT_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('APPLICANT_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('APPLICANT_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('APPLICANT_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection