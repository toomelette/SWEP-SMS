@php
  $table_sessions = [ 
                      Session::get('EMPLOYEE_TRNG_UPDATE_SUCCESS_SLUG'),
                      Session::get('EMPLOYEE_TRNG_CREATE_SUCCESS_SLUG'),
                    ];
@endphp

@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Edit Employee Seminars / Trainings</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! HtmlHelper::back_button(['dashboard.employee.index']) !!}
      </div>
  </section>

  <section class="content" id="pjax-container">


    {{-- Form --}}
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Form</h3>
          <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
          </div> 
        </div>

        <form data-pjax role="form" method="POST" autocomplete="off" action="{{ route('dashboard.employee.training_store', $employee->slug) }}">

          @csrf

          <div class="box-body">

            {!! FormHelper::textbox(
               '6', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! FormHelper::textbox(
               '6', 'type', 'text', 'Type of Seminar', 'Type of Seminar', old('type'), $errors->has('type'), $errors->first('type'), ''
            ) !!}

            <div class="col-md-12"></div>

            {!! FormHelper::datepicker(
              '6', 'date_from',  'Date From', old('date_from'), $errors->has('date_from'), $errors->first('date_from')
            ) !!}

            {!! FormHelper::datepicker(
              '6', 'date_to',  'Date To', old('date_to'), $errors->has('date_to'), $errors->first('date_to')
            ) !!}

            <div class="col-md-12"></div>

            {!! FormHelper::textbox(
               '6', 'hours', 'text', 'Hours *', 'Hours', old('hours'), $errors->has('hours'), $errors->first('hours'), ''
            ) !!}

            {!! FormHelper::textbox(
               '6', 'conducted_by', 'text', 'Conducted By', 'Conducted By', old('conducted_by'), $errors->has('conducted_by'), $errors->first('conducted_by'), ''
            ) !!}

            <div class="col-md-12"></div>

            {!! FormHelper::textbox(
               '6', 'venue', 'text', 'Venue', 'Venue', old('venue'), $errors->has('venue'), $errors->first('venue'), ''
            ) !!}

            {!! FormHelper::textbox(
               '6', 'remarks', 'text', 'Remarks', 'Remarks', old('remarks'), $errors->has('remarks'), $errors->first('remarks'), ''
            ) !!}

          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-default">Save</button>
          </div>

        </form>
      </div>
    </div>






    {{-- Table --}}
    <div class="col-md-6">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Seminars and Training</h3> 
          <div class="box-tools">
            <a href="{{ route('dashboard.employee.training_print', $employee->slug) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print</a>
          </div>
        </div>

        <div class="box-body">
          @if($errors->all())
            <ul style="line-height: 10px;">
              @foreach ($errors->all() as $data)
                <li><p class="text-danger">{{ $data }}</p></li>
              @endforeach
            </ul>
          @endif
          <table class="table table-hover">
            <tr>
              <th>Title</th>
              <th>Date From</th>
              <th>Date To</th>
              <th>Action</th>
            </tr>
            @foreach($employee_trainings as $data) 
              <tr 
                {!! HtmlHelper::table_highlighter( $data->slug, $table_sessions) !!} 
                {!! old('e_slug') == $data->slug ? 'style="background-color: #F5B7B1;"' : '' !!}
              >
                <td>{{ str_limit($data->title, 50, '...') }}</td>
                <td>{{ DataTypeHelper::date_out($data->date_from, 'm/d/Y') }}</td>
                <td>{{ DataTypeHelper::date_out($data->date_to, 'm/d/Y') }}</td>
                <td>
                  <div class="btn-group">
                    <a href="#" id="tr_update_btn" es="{{ $data->slug }}" data-url="{{ route('dashboard.employee.training_update', [$employee->slug, $data->slug]) }}" class="btn btn-sm btn-default">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a href="#" id="tr_delete_btn" data-url="{{ route('dashboard.employee.training_destroy', $data->slug) }}" class="btn btn-sm btn-default">
                      <i class="fa  fa-trash-o"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </table>

          @if($employee->employeeTraining->isEmpty())
            <div style="padding :5px;">
              <center><h4>No Records found!</h4></center>
            </div>
          @endif

        </div>

      </div>
    </div>

    

  </section>

@endsection





@section('modals')
  

  {{-- Delete --}}
  {!! HtmlHelper::modal_delete('tr_delete') !!}


  {{-- Update --}}
  <div class="modal fade bs-example-modal-lg" id="tr_update" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" id="tr_update_body">
          <form data-pjax id="tr_update_form" method="POST" autocomplete="off">

            <div class="row">
                
              @csrf
              <input name="_method" value="PUT" type="hidden">

              <input name="e_slug" id="e_slug"  type="hidden">

              {!! FormHelper::textbox(
                 '6', 'e_title', 'text', 'Title *', 'Title', old('e_title'), $errors->has('e_title'), $errors->first('e_title'), ''
              ) !!}

              {!! FormHelper::textbox(
                 '6', 'e_type', 'text', 'Type of Seminar', 'Type of Seminar', old('e_type'), $errors->has('e_type'), $errors->first('e_type'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! FormHelper::datepicker(
                '6', 'e_date_from',  'Date From', old('e_date_from'), $errors->has('e_date_from'), $errors->first('e_date_from')
              ) !!}

              {!! FormHelper::datepicker(
                '6', 'e_date_to',  'Date To', old('e_date_to'), $errors->has('e_date_to'), $errors->first('e_date_to')
              ) !!}

              <div class="col-md-12"></div>

              {!! FormHelper::textbox(
                 '6', 'e_hours', 'text', 'Hours *', 'Hours', old('e_hours'), $errors->has('e_hours'), $errors->first('e_hours'), ''
              ) !!}

              {!! FormHelper::textbox(
                 '6', 'e_conducted_by', 'text', 'Conducted By', 'Conducted By', old('e_conducted_by'), $errors->has('e_conducted_by'), $errors->first('e_conducted_by'), ''
              ) !!}

              <div class="col-md-12"></div>

              {!! FormHelper::textbox(
                 '6', 'e_venue', 'text', 'Venue', 'Venue', old('e_venue'), $errors->has('e_venue'), $errors->first('e_venue'), ''
              ) !!}

              {!! FormHelper::textbox(
                 '6', 'e_remarks', 'text', 'Remarks', 'Remarks', old('e_remarks'), $errors->has('e_remarks'), $errors->first('e_remarks'), ''
              ) !!}

            </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>


@endsection 





@section('scripts')

  <script type="text/javascript">

    // Delete Button Action
    $(document).on("click", "#tr_delete_btn", function () {
      $("#tr_delete").modal("show");
      $("#delete_body #form").attr("action", $(this).data("url"));
      $("#delete_body #form").attr("data-pjax", '');
      $(this).val("");
    });


    // Delete Form Action
    $(document).on("submit", "#delete_body #form", function () {
        $('#tr_delete').delay(100).fadeOut(100);
       setTimeout(function(){
          $('#tr_delete').modal("hide");
       }, 200);
    });


    // Update Button Action
    $(document).on("click", "#tr_update_btn", function () {

      var slug = $(this).attr("es");

      $("#tr_update").modal("show");
      $("#tr_update_body #tr_update_form").attr("action", $(this).data("url"));

      // Datepicker
      $('.datepicker').each(function(){
          $(this).datepicker({
              autoclose: true,
              dateFormat: "mm/dd/yy",
              orientation: "bottom"
          })
      });

      $.ajax({
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
        url: "/api/employee/training/"+slug+"/edit",
        type: "GET",
        dataType: "json",
        success:function(data) {       
            
          $.each(data, function(key, value) {
            $("#tr_update_form #e_slug").val(value.slug);
            $("#tr_update_form #e_title").val(value.title);
            $("#tr_update_form #e_type").val(value.type);
            $("#tr_update_form #e_date_from").datepicker("setDate", new Date(value.date_from));
            $("#tr_update_form #e_date_to").datepicker("setDate", new Date(value.date_to));
            $("#tr_update_form #e_hours").val(value.hours);
            $("#tr_update_form #e_conducted_by").val(value.conducted_by);
            $("#tr_update_form #e_venue").val(value.venue);
            $("#tr_update_form #e_remarks").val(value.remarks);
          });

        }
      });

    });


    // Update Form Action
    $(document).on("submit", "#tr_update_body #tr_update_form", function () {
      $('#tr_update').delay(50).fadeOut(50);
      setTimeout(function(){
        $('#tr_update').modal("hide");  
      }, 100);
    });


  </script> 
    
@endsection