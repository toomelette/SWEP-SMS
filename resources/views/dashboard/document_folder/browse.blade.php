<?php

  $appended_requests = [];
  
?>



@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Browse Files</h1>
      <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button([
        'dashboard.document_folder.index',
      ]) !!}
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.document_folder.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table">
          <tr>
            <th>@sortablelink('subject', 'Subject')</th>
            <th style="width:200px;">@sortablelink('updated-at', 'Last Modified')</th>
          </tr>
          @foreach($documents as $data) 
            <tr>

              <td>
                <a href="{{ route('dashboard.document.view_file', $data->slug) }}" style="text-decoration: underline; font-size:15px;" target="_blank">
                  {{ $data->subject }}
                </a>
              </td>

              <td>{{ $data->updated_at->diffForHumans() }}</td>

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
        {!! __html::table_counter($documents) !!}
        {!! $documents->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>


@endsection