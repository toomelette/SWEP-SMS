<?php

  $table_sessions = [ 
                      Session::get('DOCUMENT_UPDATE_SUCCESS_SLUG'),
                    ];

  $appended_requests = [
                        'q'=> Request::get('q'), 
                        'd' => Request::get('d'),
                        'dt' => Request::get('dt'),
                        'fc' => Request::get('fc'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                      ];
                      
?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Document List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.document.index') }}">

    {{-- Advance Filters --}}
    {!! HtmlHelper::filter_open() !!}

      {!! FormHelper::select_dynamic_for_filter(
        '3', 'fc', 'Folder Code', old('fc'), $global_document_folders_all, 'folder_code', 'folder_code', 'submit_memo_filter', 'class="col-md-12"', 'style="width:100%;"'
      ) !!}

      {!! FormHelper::select_static_for_filter(
        '3', 'dt', 'Document Types', old('dt'), StaticHelper::document_types(), 'submit_memo_filter', '', ''
      ) !!}

      <div class="col-md-12 no-padding">

        <h5>Date Filter : </h5>

        {!! FormHelper::datepicker('3', 'd',  'Memo Dated', old('d'), '', '') !!}

        <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

      </div>

    {!! HtmlHelper::filter_close('submit_memo_filter') !!}


    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.document.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>View</th>
            <th>@sortablelink('reference_no', 'Ref No')</th>
            <th>@sortablelink('date', 'Document Date')</th>
            <th>@sortablelink('person_to', 'To')</th>
            <th>@sortablelink('person_from', 'From')</th>
            <th>@sortablelink('subject', 'Subject')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($documents as $data) 
            <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>
                <a href="{{ route('dashboard.document.view_file', $data->slug) }}" class="btn btn-sm btn-success" target="_blank">
                  <i class="fa fa-file-pdf-o"></i>
                </a>
              </td>
              <td>{{ $data->reference_no }}</td>
              <td>{{ DataTypeHelper::date_parse($data->date) }}</td>
              <td>{{ Str::limit($data->person_to, 30) }}</td>
              <td>{{ Str::limit($data->person_from, 30) }}</td>
              <td>{{ Str::limit($data->subject, 30) }}</td>

              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.document.show', $data->slug) }}">Details</option>
                  <option data-type="1" data-url="{{ route('dashboard.document.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.document.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>

            </tr>
            @endforeach
        </table>
      </div>

      @if($documents->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! HtmlHelper::table_counter($documents) !!}
        {!! $documents->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>


@endsection






@section('modals')

  {!! HtmlHelper::modal_delete('doc_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('doc_delete') !!}

    {{-- DOCUMENT DELETE TOAST --}}
    @if(Session::has('DOCUMENT_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('DOCUMENT_DELETE_SUCCESS')) !!}
    @endif

    {{-- DOCUMENT UPDATE TOAST --}}
    @if(Session::has('DOCUMENT_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('DOCUMENT_UPDATE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection