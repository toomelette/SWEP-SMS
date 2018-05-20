@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Voucher Details</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! HtmlHelper::back_button(['dashboard.disbursement_voucher.index', 'dashboard.disbursement_voucher.user_index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        
        <h3 class="box-title">Details</h3>

        <div class="box-tools">
          <a href="{{ route('dashboard.disbursement_voucher.print', [$disbursement_voucher->slug, 'front']) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Front</a>&nbsp;
          <a href="{{ route('dashboard.disbursement_voucher.print', [$disbursement_voucher->slug, 'back']) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Back</a>
          @if(Carbon::parse($disbursement_voucher->date)->diffInDays(Carbon::now()->format('Y-m-d')) < 15)
            <a href="{{ route('dashboard.disbursement_voucher.edit', $disbursement_voucher->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
          @endif
        </div>

      </div>
      
      <div class="box-body">

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">DV No.: <strong>{{ $disbursement_voucher->dv_no }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Station: <strong>{{ count($disbursement_voucher->project) != 0 ? $disbursement_voucher->project->project_address : '' }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Fund Source: <strong>{{ count($disbursement_voucher->fundSource) != 0 ? $disbursement_voucher->fundSource->description : '' }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Mode of Payment: <strong>{{ count($disbursement_voucher->modeOfPayment) != 0 ? $disbursement_voucher->modeOfPayment->description : ''  }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Payee: <strong>{{ $disbursement_voucher->payee }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">TIN: <strong>{{ $disbursement_voucher->tin }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">BUR No.: <strong>{{ $disbursement_voucher->tin }}</strong></span>
        </div>

        <div class="col-md-6" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Address: <strong>{{ $disbursement_voucher->address }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Department: <strong>{{ $disbursement_voucher->department_name }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Unit: <strong>{{ $disbursement_voucher->department_unit_name }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Account Code: <strong>{{ $disbursement_voucher->account_code }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Explanation:</span><br>
          <div style="border:solid 1px; padding:10px;">
            {!! $disbursement_voucher->explanation !!}
          </div>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Amount: <strong>{{ $disbursement_voucher->amount }}</strong></p>
        </div>

      </div>

    </div>


    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Progress</h3>
      </div>
      
      <div class="box-body">

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Filed: <strong>{{ $disbursement_voucher->created_at != null ? Carbon::parse($disbursement_voucher->created_at)->format('M d, Y h:i A') : '' }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Processed: <strong>{{ $disbursement_voucher->processed_at != null ? Carbon::parse($disbursement_voucher->processed_at)->format('M d, Y h:i A') : '' }}</strong></span>
        </div>

        <div class="col-md-12" style="padding-bottom:10px;">
          <span style="font-size: 15px; ">Completed: <strong>{{ $disbursement_voucher->processed_at != null ? Carbon::parse($disbursement_voucher->checked_at)->format('M d, Y h:i A') : '' }}</strong></span>
        </div>

      </div>

    </div>

</section>

@endsection

