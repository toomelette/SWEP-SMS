<?php

  $table_sessions = [ Session::get('PLANTILLA_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'du' => Request::get('du'),
                      ];
  
  $span_check = '<span class="badge bg-green"><i class="fa fa-check "></i></span>';
  $span_times = '<span class="badge bg-red"><i class="fa fa-times "></i></span>';

?>




@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Plantilla List</h1>
  </section>

  <section class="content">

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.plantilla.index') }}">

      {{-- Advance Filters --}}
      {!! __html::filter_open() !!}

        {!! __form::select_dynamic_for_filter(
          '3', 'du', 'Unit', old('du'), $global_department_units_all, 'department_unit_id', 'description', 'submit_plantilla_filter', '', ''
        ) !!}

      {!! __html::filter_close('submit_plantilla_filter') !!}

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.plantilla.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('departmentUnit.description', 'Unit')</th>
            <th>@sortablelink('name', 'Name')</th>
            <th>@sortablelink('is_vacant', 'Vacant')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($plantillas as $data) 
            <tr {!! __html::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>{{ empty($data->departmentUnit) ? '' : $data->departmentUnit->description }}</td>
              <td>{{ $data->name }}</td>
              <td>{!! $data->is_vacant == 1 ? $span_check : $span_times !!}</td>
              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.plantilla.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.plantilla.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($plantillas->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($plantillas) !!}
        {!! $plantillas->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection




@section('modals')

  {!! __html::modal_delete('plantilla_delete') !!}

@endsection 




@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('plantilla_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('PLANTILLA_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('PLANTILLA_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('PLANTILLA_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('PLANTILLA_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection