@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Applicant Reports</h1>
  </section>

  <section class="content">




    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">List of Applicants by Course</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" action="{{ route('dashboard.applicant.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="r_type" value="ABC">

          {!! __form::select_static(
            '3', 'lt', 'List Type *', old('lt'), ['Full List' => 'FL', 'Short List' => 'SL'], $errors->has('lt'), $errors->first('lt'), '', ''
          ) !!}

          {!! __form::select_dynamic(
            '3', 'c', 'Course', old('c'), $global_courses_all, 'course_id', 'name', $errors->has('c'), $errors->first('c'), 'select2', ''
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::textbox(
            '3', 'pn', 'text', 'Prepared By:', 'Prepared By', old('pn'), $errors->has('pn'), $errors->first('pn'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'pd', 'text', 'Prepared Position:', 'Prepared Position', old('pd'), $errors->has('pd'), $errors->first('pd'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'nn', 'text', 'Noted By:', 'Noted By', old('nn'), $errors->has('nn'), $errors->first('nn'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'nd', 'text', 'Noted Position:', 'Noted Position', old('nd'), $errors->has('nd'), $errors->first('nd'), 'data-transform="uppercase"'
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>




    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">List of Applicants By Unit</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" action="{{ route('dashboard.applicant.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="r_type" value="ABU">

          {!! __form::select_static(
            '3', 'lt', 'List Type *', old('lt'), ['Full List' => 'FL', 'Short List' => 'SL'], $errors->has('lt'), $errors->first('lt'), '', ''
          ) !!}

          {!! __form::select_dynamic(
            '3', 'du', 'Unit Applied', old('du'), $global_department_units_all, 'department_unit_id', 'description', $errors->has('du'), $errors->first('du'), 'select2', ''
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::textbox(
            '3', 'pn', 'text', 'Prepared By:', 'Prepared By', old('pn'), $errors->has('pn'), $errors->first('pn'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'pd', 'text', 'Prepared Position:', 'Prepared Position', old('pd'), $errors->has('pd'), $errors->first('pd'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'nn', 'text', 'Noted By:', 'Noted By', old('nn'), $errors->has('nn'), $errors->first('nn'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'nd', 'text', 'Noted Position:', 'Noted Position', old('nd'), $errors->has('nd'), $errors->first('nd'), 'data-transform="uppercase"'
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>


    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">List of Applicants By Date</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" action="{{ route('dashboard.applicant.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="r_type" value="ABD">

          {!! __form::select_static(
            '3', 'lt', 'List Type *', old('lt'), ['Full List' => 'FL', 'Short List' => 'SL'], $errors->has('lt'), $errors->first('lt'), '', ''
          ) !!}

          {!! __form::datepicker(
            '3', 'from',  'Date From *', old('from'), $errors->has('from'), $errors->first('from')
          ) !!}

          {!! __form::datepicker(
            '3', 'to',  'Date To *', old('to'), $errors->has('to'), $errors->first('to')
          ) !!}

          <div class="col-md-12">
            
          </div>

          {!! __form::textbox(
            '3', 'pn', 'text', 'Prepared By:', 'Prepared By', old('pn'), $errors->has('pn'), $errors->first('pn'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'pd', 'text', 'Prepared Position:', 'Prepared Position', old('pd'), $errors->has('pd'), $errors->first('pd'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'nn', 'text', 'Noted By:', 'Noted By', old('nn'), $errors->has('nn'), $errors->first('nn'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'nd', 'text', 'Noted Position:', 'Noted Position', old('nd'), $errors->has('nd'), $errors->first('nd'), 'data-transform="uppercase"'
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>

    <div class="box">

      <div class="box-header with-border">
        <h3 class="box-title">List of Applicants By Position Applied</h3>
        <div class="pull-right">
          <code>Fields with asterisks(*) are required</code>
        </div>
      </div>

      <form role="form" method="GET" action="{{ route('dashboard.applicant.report_generate') }}" target="_blank">

        <div class="box-body">
          @php
          $db_positions = \App\Models\ApplicantPositionApplied::select('position_applied')->groupBy('position_applied')->pluck('position_applied')->toArray();
          $positions = ['All' => 'All'];
          if(count($db_positions) > 0){
            foreach($db_positions as $db_position){
              $positions[$db_position] = $db_position;
            }
          }
          @endphp
          <input type="hidden" name="r_type" value="ABP">

          {!! __form::select_static(
            '3', 'lt', 'Select Position *', old('lt'), $positions, $errors->has('lt'), $errors->first('lt'), '', ''
          ) !!}


          <div class="col-md-12">

          </div>

          {!! __form::textbox(
            '3', 'pn', 'text', 'Prepared By:', 'Prepared By', old('pn'), $errors->has('pn'), $errors->first('pn'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'pd', 'text', 'Prepared Position:', 'Prepared Position', old('pd'), $errors->has('pd'), $errors->first('pd'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'nn', 'text', 'Noted By:', 'Noted By', old('nn'), $errors->has('nn'), $errors->first('nn'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'nd', 'text', 'Noted Position:', 'Noted Position', old('nd'), $errors->has('nd'), $errors->first('nd'), 'data-transform="uppercase"'
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>






  </section>

@endsection