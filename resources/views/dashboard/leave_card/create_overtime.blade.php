@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Overtime</h1>
  </section>

  <section class="content">




    <div class="col-md-6">

      <div class="box">
      
        <div class="box-header with-border">
          <h3 class="box-title">Form</h3>
          <div class="pull-right">
              <code>Fields with asterisks(*) are required</code>
          </div> 
        </div>

        <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.leave_card.store') }}">

          <div class="box-body">

            @csrf    

            <input type="hidden" name="doc_type" value="OT">

            {!! __form::select_dynamic(
              '6', 'employee_no', 'Employee *', old('employee_no'), $global_employees_all, 'employee_no', 'fullname', $errors->has('employee_no'), $errors->first('employee_no'), 'select2', ''
            ) !!}

            {!! __form::datepicker(
              '6', 'date',  'Date *', old('date') , $errors->has('date'), $errors->first('date')
            ) !!}

            <div class="col-md-12"></div>

            {!! __form::textbox(
               '6', 'hrs', 'text', 'Hours *', 'Hours', old('hrs'), $errors->has('hrs'), $errors->first('hrs'), ''
            ) !!}

          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
          </div>

        </form>

      </div>

    </div>







    <div class="col-md-6">

      <div class="box" style="height:265px;">
      
        <div class="box-header with-border">
          <h3 class="box-title">Credit Balances</h3>
        </div>

        <div class="box-body">
            
          <form role="form" id="balances_form">

          <div class="box-body">

            {!! __form::textbox(
               '6', 'overtime_balance', 'text', 'Overtime Credit:', '', '', '', '', ''
            ) !!}

          </div>

          </form>

        </div>

      </div>

    </div>





  </section>

@endsection





@section('modals')

  @if(Session::has('LC_CREATE_SUCCESS'))

    {!! __html::modal(
      'lc_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('LC_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('LC_CREATE_SUCCESS'))
      $('#lc_create').modal('show');
    @endif

    {{-- AJAX Get Leave Card --}}
    $(document).ready(function() {
      $(document).on("change", "#employee_no", function() {
          var key = $(this).val();
          if(key) {
              $.ajax({
                  headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                  url: "/api/leave_card/select_leaveCard_byEmployeeNo/" + key,
                  type: "GET",
                  dataType: "json",
                  success:function(data) {   

                    $("#balances_form #overtime_balance").val('').attr("readonly", false);

                    $.each(data, function(key, value) {

                        $("#balances_form #overtime_balance").val(value.bigbal_overtime).attr("readonly", true);

                    }); 
          
                  }
              });
          }else{

            $("#balances_form #overtime_balance").val('').attr("readonly", false);

          }
      });
    });


  </script> 
    
@endsection