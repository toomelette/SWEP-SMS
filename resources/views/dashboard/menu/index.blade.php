@php

  $table_sessions = [ Session::get('MENU_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'order' => Request::get('order'),
                      ];

@endphp

@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Menu List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.menu.index') }}">

    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.menu.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-bordered">
          <tr>
            <th>@sortablelink('name', 'Name')</th>
            <th>@sortablelink('route', 'Route')</th>
            <th>@sortablelink('icon', 'Icon')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($menus as $data) 
            <tr {!! HtmlHelper::table_highlighter($table_sessions) !!} >
              <td>{{ $data->name }}</td>
              <td>{{ $data->route }}</td>
              <td><i class="fa {{ $data->icon }}"></i></td>
              <td> 
                <select id="action" class="form-control input-sm">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.menu.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.menu.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($menus->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! HtmlHelper::table_counter($menus) !!}
        {!! $menus->appends($appended_requests)!!}
      </div>

    </div>

  </section>

@endsection


@section('modals')

  {!! HtmlHelper::modal_delete('menu_delete') !!}

@endsection 


@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('menu_delete') !!}


    {{-- FORM VARIABLES RULE --}}
    {!! JSHelper::table_action_rule() !!}


    {{-- UPDATE TOAST --}}
    @if(Session::has('MENU_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('MENU_UPDATE_SUCCESS')) !!}
    @endif


    {{-- DELETE TOAST --}}
    @if(Session::has('MENU_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('MENU_DELETE_SUCCESS')) !!}
    @endif


  </script>
    
@endsection