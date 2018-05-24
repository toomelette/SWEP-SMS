@php

  $table_sessions = [  Session::get('FUND_SOURCE_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'order' => Request::get('order'),
                      ];

@endphp

@extends('layouts.admin-master')

@section('content')
    
      <section class="content-header">
          <h1>Fund Source List</h1>
      </section>

      <section class="content">

        {{-- Form Start --}}
        <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.fund_source.index') }}">

        <div class="box" id="pjax-container">

          {{-- Table Search --}}        
          <div class="box-header with-border">
            {!! HtmlHelper::table_search(route('dashboard.department.index')) !!}
          </div>

        {{-- Form End --}}  
        </form>

          {{-- Table Grid --}}        
          <div class="box-body no-padding">
            <table class="table table-bordered">
              <tr>
                <th>@sortablelink('description', 'Description')</th>
                <th style="width: 150px">Action</th>
              </tr>
              @foreach($fund_sources as $data) 
                <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
                  <td>{{ $data->description }}</td>
                  <td> 
                    <select id="action" class="form-control input-sm">
                      <option value="">Select</option>
                      <option data-type="1" data-url="{{ route('dashboard.fund_source.edit', $data->slug) }}">Edit</option>
                      <option data-type="0" data-action="delete" data-url="{{ route('dashboard.fund_source.destroy', $data->slug) }}">Delete</option>
                    </select>
                  </td>
                </tr>
                @endforeach
              </table>
          </div>

          @if($fund_sources->isEmpty())
            <div style="padding :5px;">
              <center><h4>No Records found!</h4></center>
            </div>
          @endif

          <div class="box-footer">
            {!! HtmlHelper::table_counter($fund_sources) !!}
            {!! $fund_sources->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
          </div>

        </div>

    </section>

@endsection


@section('modals')

  {!! HtmlHelper::modal_delete('fund_source_delete') !!}

@endsection 


@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('fund_source_delete') !!}

    {{-- FORM VARIABLES RULE --}}
    {!! JSHelper::table_action_rule() !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('FUND_SOURCE_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('FUND_SOURCE_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('FUND_SOURCE_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('FUND_SOURCE_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection