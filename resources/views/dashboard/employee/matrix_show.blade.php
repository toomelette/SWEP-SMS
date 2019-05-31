<?php
  
  $total_score = optional($employee->employeeMatrix)->educ_bachelors_degree + 
                 optional($employee->employeeMatrix)->educ_undergrad_bachelor + 
                 optional($employee->employeeMatrix)->educ_masters_degree + 
                 optional($employee->employeeMatrix)->educ_doctoral_degree + 
                 optional($employee->employeeMatrix)->educ_undergrad_masteral + 
                 optional($employee->employeeMatrix)->educ_grad_certificate_course + 

                 optional($employee->employeeMatrix)->educ_distinctions_summa_cum_laude + 
                 optional($employee->employeeMatrix)->educ_distinctions_magna_cum_laude + 
                 optional($employee->employeeMatrix)->educ_distinctions_cum_laude + 
                 optional($employee->employeeMatrix)->educ_distinctions_pres_awardee + 
                 optional($employee->employeeMatrix)->educ_distinctions_csc_sra_da_awardee + 
                 optional($employee->employeeMatrix)->educ_distinctions_top_gov_exam + 

                 optional($employee->employeeMatrix)->experience + 
                 optional($employee->employeeMatrix)->training +
                 optional($employee->employeeMatrix)->eligibility + 
                 optional($employee->employeeMatrix)->performance + 
                 optional($employee->employeeMatrix)->behavior + 
                 optional($employee->employeeMatrix)->psycho_test;

?>

@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Employee Matrix</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.employee.index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        
        <h3 class="box-title">Matrix Details</h3>

        <div class="box-tools">
          <a href="{{ route('dashboard.employee.matrix', $employee->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
          &nbsp;
          <a href="{{ route('dashboard.employee.matrix_print', [$employee->slug, 'front']) }}" target="_blank" class="btn btn-sm btn-default">
            <i class="fa fa-print"></i> Print 
          </a>
        </div>

      </div>
      
      <div class="box-body">


        {{-- DOC Info --}}
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">

              <h4>Education- Relevant to the Position</h4>

              <ul>
                  
                <li>Bachelor's Degree Graduate = {{ number_format(optional($employee->employeeMatrix)->educ_bachelors_degree, 2) }}</li>
                <li>College Undergraduate = {{ number_format(optional($employee->employeeMatrix)->educ_undergrad_bachelor, 2) }}</li>
                <li>Master's Degree = {{ number_format(optional($employee->employeeMatrix)->educ_masters_degree, 2) }}</li>
                <li>Doctoral Degree Graduate = {{ number_format(optional($employee->employeeMatrix)->educ_doctoral_degree, 2) }}</li>
                <li>Undergraduate Masteral / Doctoral = {{ number_format(optional($employee->employeeMatrix)->educ_undergrad_masteral, 2) }}</li>
                <li>Graduate Certificate Course = {{ number_format(optional($employee->employeeMatrix)->educ_grad_certificate_course, 2) }}</li>

                <li>Bachelor's Degree Graduate
                  <ul>  
                      <li>Summa Cum Laude = {{ number_format(optional($employee->employeeMatrix)->educ_distinctions_summa_cum_laude, 2) }}</li>
                      <li>Magna Cum Laude = {{ number_format(optional($employee->employeeMatrix)->educ_distinctions_magna_cum_laude, 2) }}</li>
                      <li>Cum Laude / With Honors = {{ number_format(optional($employee->employeeMatrix)->educ_distinctions_cum_laude, 2) }}</li>
                      <li>Presidential Awardee = {{ number_format(optional($employee->employeeMatrix)->educ_distinctions_pres_awardee, 2) }}</li>
                      <li>CSC / SRA / DA Awardee = {{ number_format(optional($employee->employeeMatrix)->educ_distinctions_csc_sra_da_awardee, 2) }}</li>
                      <li>Top 10 on government licensure administered exams = {{ number_format(optional($employee->employeeMatrix)->educ_distinctions_top_gov_exam, 2) }}</li>
                  </ul>
                </li>

              </ul>


              <h4>Experience = {{ number_format(optional($employee->employeeMatrix)->experience, 2) }}</h4>

              <h4>Training = {{ number_format(optional($employee->employeeMatrix)->training, 2) }}</h4>

              <h4>Eligibility = {{ number_format(optional($employee->employeeMatrix)->eligibility, 2) }}</h4>

              <h4>Performance = {{ number_format(optional($employee->employeeMatrix)->performance, 2) }}</h4>

              <h4>Behavioral Events, Interview, Assesment (BEIA), Work Attitude = {{ number_format(optional($employee->employeeMatrix)->behavior, 2) }}</h4>

              <h4>Psychological and Mental Aptitude Tests = {{ number_format(optional($employee->employeeMatrix)->psycho_test, 2) }}</h4>

              <h3>Total Score = {{ $total_score }}</h3>


            </div>
          </div>
        </div>
      
      </div>
    </div>

</section>

@endsection

