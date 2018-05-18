@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Edit Signatory</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! HtmlHelper::back_button(['dashboard.signatory.index']) !!}
      </div>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.signatory.update', $signatory->slug) }}">

        <div class="box-body">
          
          <input name="_method" value="PUT" type="hidden">

          @csrf    

          {!! FormHelper::textbox(
             '4', 'employee_name', 'text', 'Employee Name *', 'Employee Name', old('employee_name') ? old('employee_name') : $signatory->employee_name, $errors->has('employee_name'), $errors->first('employee_name'), ''
          ) !!}

          {!! FormHelper::textbox(
            '4', 'employee_position', 'text', 'Position *', 'Position', old('employee_position') ? old('employee_position') : $signatory->employee_position, $errors->has('employee_position'), $errors->first('employee_position'), ''
          ) !!}

          {!! FormHelper::select_static('4', 'type', 'Type *', old('type') ? old('type') : $signatory->type, [
            '1 - ASSISTANT ADMINISTRATOR' => '1',
            '2 - ACCOUNTING VIS' => '2',
            '3 - HRU VIS' => '3',
            '4 - PROPERTY VIS' => '4',
            '5 - RECORDS VIS' => '5',
            '6 - TBM VIS' => '6',
            '7 - LMD VIS' => '7',
            '8 - SRED VIS' => '8',
            '9 - LEGAL VIS' => '9',
            '10 - RDE VIS' => '10',
            '11 - SOILS VIS' => '11',
            '12 - SUGAR VIS' => '12',
          ], $errors->has('type'), $errors->first('type'), '', '') !!} 

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

  </section>

@endsection

