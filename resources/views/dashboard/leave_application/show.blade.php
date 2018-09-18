<?php

  $inclusive_dates = Carbon::parse($leave_application->working_days_from)->format('M d, Y') .' - '. Carbon::parse($leave_application->working_days_to)->format('M d, Y');

?>




@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Leave Application Details</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! HtmlHelper::back_button(['dashboard.leave_application.index', 'dashboard.leave_application.user_index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        
        <h3 class="box-title">Details</h3>

        <div class="box-tools">
          <a href="{{ route('dashboard.leave_application.print', [$leave_application->slug, 'front']) }}" target="_blank" class="btn btn-sm btn-default">
            <i class="fa fa-print"></i> Print
          </a>

          @if(Carbon::parse($leave_application->date_of_filing)->diffInDays(Carbon::now()->format('Y-m-d')) < 15)
            <a href="{{ route('dashboard.leave_application.edit', $leave_application->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
          @endif
        </div>

      </div>
      
      <div class="box-body">


        {{-- Personal Info --}}
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Application Info</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Agency:</dt>
                <dd>{{ $leave_application->agency }}</dd>
                <dt>Lastname:</dt>
                <dd>{{ $leave_application->lastname }}</dd>
                <dt>Firstname:</dt>
                <dd>{{ $leave_application->firstname }}</dd>
                <dt>Middlename:</dt>
                <dd>{{ $leave_application->middlename }}</dd>
                <dt>Date of Filing:</dt>
                <dd>{{ DataTypeHelper::date_parse($leave_application->date_of_filing) }}</dd>
                <dt>Salary:</dt>
                <dd>{{ number_format($leave_application->salary, 2) }}</dd>
                <dt>Type of Leave:</dt>
                <dd>
                  @foreach(StaticHelper::leave_types() as $name => $key)
                    @if($key ==  $leave_application->type)
                      {{ $name }}
                    @endif
                  @endforeach
                </dd>
                <dt>Number of Days:</dt>
                <dd>{{ $leave_application->working_days }}</dd>
                <dt>Inclusive Dates:</dt>
                <dd>{{ $inclusive_dates }}</dd>
              </dl>
            </div>
          </div>
        </div>


      </div>
    </div>

</section>

@endsection

