@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Print Voucher</h1>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
      </div>
      
      <div class="box-body">

        <div class="row">
          <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#front" data-toggle="tab">Front</a></li>
                <li><a href="#back" data-toggle="tab">Back</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="front">
                  <p>Front</p>
                </div>
                <div class="tab-pane" id="back">
                  <p>Back</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

</section>

@endsection


@section('scripts')

{{--   @include('scripts.disbursement_voucher.show') --}}
    
@endsection