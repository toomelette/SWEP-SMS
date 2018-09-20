<?php

  $appended_requests = [
                        'q'=> Request::get('q'), 
                        't'=> Request::get('t'), 
                        'df' => Request::get('df'),
                        'dt' => Request::get('dt'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                      ];

  $span_user_not_exist = '<span class="text-red"><b>User does not exist!</b></span>';

?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Leave Application List</h1>
  </section>

  <section class="content">
    

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.leave_application.index') }}">


    {{-- Advance Filters --}}
    {!! __html::filter_open() !!}

      <div class="col-md-12">
          
        {!! __form::select_static_for_filter('3', 't', 'Type of Leave', old('t'), __static::leave_types(), 'submit_la_filter', '', '') !!}

      </div>


      <div class="col-md-12 no-padding">
        
        <h5>Date of Filing Filter : </h5>

        {!! __form::datepicker('3', 'df',  'From', old('df'), '', '') !!}

        {!! __form::datepicker('3', 'dt',  'To', old('dt'), '', '') !!}

        <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

      </div>
        
    {!! __html::filter_close('submit_la_filter') !!}



    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.leave_application.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('user.firstname', 'User')</th>
            <th>@sortablelink('firstname', 'Name')</th>
            <th>@sortablelink('type', 'Type of Leave')</th>
            <th>@sortablelink('date_of_filing', 'Date of Filing')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($leave_applications as $data) 
            <tr>
              <td>{!! empty($data->user) ? $span_user_not_exist : Str::limit($data->user->fullnameShort, 25) !!}</td>
              <td>{{ $data->firstname .' '. substr($data->middlename , 0, 1) .'. '.  $data->lastname}}</td>
              <td>
                @foreach(__static::leave_types() as $name => $key)
                  @if($key == $data->type)
                    {{ $name }}
                  @endif
                @endforeach
              </td>
              <td>{{ __dataType::date_parse($data->date_of_filing, 'M d, Y') }}</td>
              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.leave_application.show', $data->slug) }}">Details</option>
                  <option data-type="1" data-url="{{ route('dashboard.leave_application.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.leave_application.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>
            </tr>
            @endforeach
        </table>
      </div>

      @if($leave_applications->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($leave_applications) !!}
        {!! $leave_applications->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('la_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::modal_confirm_delete_caller('la_delete') !!}

    {{-- DV DELETE TOAST --}}
    @if(Session::has('LA_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('LA_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection