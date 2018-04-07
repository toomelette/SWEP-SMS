@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Voucher Details</h1>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        
        <h3 class="box-title">Details</h3>

        <div class="box-tools">
          <a href="{{ route('dashboard.disbursement_voucher.print', $disbursement_voucher->slug) }}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print</a>
        </div>

      </div>
      
      <div class="box-body">



      </div>

    </div>

</section>

@endsection

