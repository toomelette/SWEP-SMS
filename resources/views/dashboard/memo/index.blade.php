@php
  $table_sessions = [ 
                      Session::get('MEMO_UPDATE_SUCCESS_SLUG'),
                    ];

  $appended_requests = [
                        'q'=> Request::get('q'), 
                        'd' => Request::get('d'),
                      ];
@endphp





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Memo List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.memo.index') }}">

    {{-- Advance Filters --}}
    {!! HtmlHelper::filter_open() !!}

        {!! FormHelper::datepicker('3', 'd',  'Memo Dated', old('d'), '', '') !!}

        <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

    {!! HtmlHelper::filter_close('submit_memo_filter') !!}


    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! HtmlHelper::table_search(route('dashboard.memo.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('reference_no', 'Ref No')</th>
            <th>@sortablelink('date', 'Memo Dated')</th>
            <th>@sortablelink('person_to', 'To')</th>
            <th>@sortablelink('person_from', 'From')</th>
            <th>@sortablelink('subject', 'Subject')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($memos as $data) 
            <tr {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} >
              <td>{{ $data->reference_no }}</td>
              <td>{{ DataTypeHelper::date_parse($data->date) }}</td>
              <td>{{ Str::limit($data->person_to, 30) }}</td>
              <td>{{ Str::limit($data->person_from, 30) }}</td>
              <td>{{ Str::limit($data->subject, 30) }}</td>

              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.memo.show', $data->slug) }}">Details</option>
                  <option data-type="1" data-url="{{ route('dashboard.memo.edit', $data->slug) }}">Edit</option>
                  <option data-type="0" data-action="delete" data-url="{{ route('dashboard.memo.destroy', $data->slug) }}">Delete</option>
                </select>
              </td>

            </tr>
            @endforeach
        </table>
      </div>

      @if($memos->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! HtmlHelper::table_counter($memos) !!}
        {!! $memos->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>


@endsection






@section('modals')

  {!! HtmlHelper::modal_delete('memo_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! JSHelper::modal_confirm_delete_caller('memo_delete') !!}

    {{-- MEMO DELETE TOAST --}}
    @if(Session::has('MEMO_DELETE_SUCCESS'))
      {!! JSHelper::toast(Session::get('MEMO_DELETE_SUCCESS')) !!}
    @endif

    {{-- MEMO UPDATE TOAST --}}
    @if(Session::has('MEMO_UPDATE_SUCCESS'))
      {!! JSHelper::toast(Session::get('MEMO_UPDATE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection