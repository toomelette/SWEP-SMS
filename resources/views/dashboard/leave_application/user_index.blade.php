@php
  $appended_requests = [
                        'q'=> Request::get('q'), 
                        't'=> Request::get('t'), 
                        'df' => Request::get('df'),
                        'dt' => Request::get('dt'),
                        'sort' => Request::get('sort'),
                        'order' => Request::get('order'),
                      ];

@endphp





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>My Leave Applications</h1>
  </section>

  <section class="content">
    

    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.leave_application.user_index') }}">


    {{-- Advance Filters --}}
    {!! HtmlHelper::filter_open() !!}

      <div class="col-md-12">
          
        {!! FormHelper::select_static_for_filter('3', 't', 'Type of Leave', old('t'), StaticHelper::leave_types(), 'submit_la_filter', '') !!}

      </div>


      <div class="col-md-12">
        
        <h5>Date of Filing Filter : </h5>

        {!! FormHelper::datepicker('3', 'df',  'From', old('df'), '', '') !!}

        {!! FormHelper::datepicker('3', 'dt',  'To', old('dt'), '', '') !!}

        <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

      </div>
        
    {!! HtmlHelper::filter_close('submit_la_filter') !!}



    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.leave_application.user_index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('type', 'Type of Leave')</th>
            <th>@sortablelink('date_of_filing', 'Date of Filing')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($leave_applications as $data) 
            <tr>
              <td>
                @foreach(StaticHelper::leave_types() as $name => $key)
                  @if($key == $data->type)
                    {{ $name }}
                  @endif
                @endforeach
              </td>
              <td>{{ Carbon::parse($data->date_of_filing)->format('M d, Y') }}</td>
              <td> 
                <select id="action" class="form-control input-md">

                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.leave_application.show', $data->slug) }}">Details</option>

                  @if(Carbon::parse($data->date_of_filing)->diffInDays(Carbon::now()->format('Y-m-d')) < 15)
                    <option data-type="1" data-url="{{ route('dashboard.leave_application.edit', $data->slug) }}">Edit</option>
                  @endif

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
        {!! HtmlHelper::table_counter($leave_applications) !!}
        {!! $leave_applications->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection
