@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Voucher Details</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.disbursement_voucher.index', 'dashboard.disbursement_voucher.user_index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        
        <h3 class="box-title">Details</h3>

        <div class="box-tools">
          <a href="{{ route('dashboard.disbursement_voucher.print', [$disbursement_voucher->slug, 'front']) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Front</a>&nbsp;
          <a href="{{ route('dashboard.disbursement_voucher.print', [$disbursement_voucher->slug, 'back']) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print Back</a>
          @if(Carbon::parse($disbursement_voucher->date)->diffInDays(Carbon::now()->format('Y-m-d')) < 5)
            <a href="{{ route('dashboard.disbursement_voucher.edit', $disbursement_voucher->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
          @endif
        </div>

      </div>
      
      <div class="box-body">


        {{-- DV Info --}}
        <div class="col-md-8">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Voucher Info</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>DV No:</dt>
                <dd>{{ $disbursement_voucher->dv_no }}</dd>
                <dt>Station:</dt>
                <dd>{{ optional($disbursement_voucher->project)->project_address }}</dd>
                <dt>Fund Source:</dt>
                <dd>{{ optional($disbursement_voucher->fundSource)->description }}</dd>
                <dt>Mode of Payment:</dt>
                <dd>{{ $disbursement_voucher->mode_of_payment }}</dd>
                <dt>Payee:</dt>
                <dd>{{ $disbursement_voucher->payee }}</dd>
                <dt>TIN:</dt>
                <dd>{{ $disbursement_voucher->tin }}</dd>
                <dt>BUR No.:</dt>
                <dd>{{ $disbursement_voucher->bur_no }}</dd>
                <dt>Address:</dt>
                <dd>{{ $disbursement_voucher->address }}</dd>
                <dt>Department:</dt>
                <dd>{{ $disbursement_voucher->department_name }}</dd>
                <dt>Unit:</dt>
                <dd>{{ $disbursement_voucher->department_unit_name }}</dd>
                <dt>Account Code:</dt>
                <dd>{{ $disbursement_voucher->account_code }}</dd>
                <dt>Explanation:</dt>
                <dd>
                  <div style="border:solid 1px; padding:10px;">
                    {!! $disbursement_voucher->explanation !!}
                  </div>
                </dd>
                <dt>Amount:</dt>
                <dd>{{ number_format($disbursement_voucher->amount, 2) }}</dd>
              </dl>
            </div>
          </div>
        </div>





        {{-- Progress --}}
        <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Progress</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Filed:</dt>
                <dd>{{ $disbursement_voucher->created_at != null ? __dataType::date_parse($disbursement_voucher->created_at, 'M d, Y h:i A') : '' }}</dd>
                <dt>Processed:</dt>
                <dd>{{ $disbursement_voucher->processed_at != null ? __dataType::date_parse($disbursement_voucher->processed_at, 'M d, Y h:i A') : '' }}</dd>
                <dt>Completed:</dt>
                <dd>{{ $disbursement_voucher->checked_at != null ? __dataType::date_parse($disbursement_voucher->checked_at, 'M d, Y h:i A') : '' }}</dd>
              </dl>
            </div>
          </div>
        </div>




    </div>
  </div>

</section>

@endsection

