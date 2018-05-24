@php

  $table_sessions = [ Session::get('SUBMENU_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'order' => Request::get('order'),
                      ];

@endphp

@extends('layouts.admin-master')

@section('content')
    
      <section class="content-header">
          <h1>Submenu List</h1>
      </section>

      <section class="content">

        {{-- Form Start --}}
        <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.submenu.index') }}">

        <div class="box" id="pjax-container">

          {{-- Table Search --}}        
          <div class="box-header with-border">
            {!! HtmlHelper::table_search(route('dashboard.submenu.index')) !!}
          </div>

        {{-- Form End --}}  
        </form>

          {{-- Table Grid --}}        
          <div class="box-body no-padding">
            <table class="table table-bordered">
              <tr>
                <th>@sortablelink('name', 'Name')</th>
                <th>@sortablelink('route', 'Route')</th>
                <th>@sortablelink('is_nav', 'Is Nav')</th>
                <th style="width: 150px">Action</th>
              </tr>
              @foreach($submenus as $data) 
                <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->route }}</td>
                  <td>{{ $data->is_nav }}</td>
                  <td> 
                    <select id="action" class="form-control input-sm">
                      <option value="">Select</option>
                      <option data-type="1" data-url="{{ route('dashboard.submenu.edit', $data->slug) }}">Edit</option>
                      <option data-type="0" data-action="delete" data-url="{{ route('dashboard.submenu.destroy', $data->slug) }}">Delete</option>
                    </select>
                  </td>
                </tr>
                @endforeach
              </table>
          </div>

          @if($submenus->isEmpty())
            <div style="padding :5px;">
              <center><h4>No Records found!</h4></center>
            </div>
          @endif

          <div class="box-footer">
            {!! HtmlHelper::table_counter($submenus) !!}
            {!! $submenus->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
          </div>

        </div>

    </section>

@endsection


@section('modals')

  {!! HtmlHelper::modal_delete('submenu_delete') !!}

@endsection 


@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('submenu_delete') !!}

    {{-- FORM VARIABLES RULE --}}
    {!! JSHelper::table_action_rule() !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('SUBMENU_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('SUBMENU_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('SUBMENU_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('SUBMENU_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection