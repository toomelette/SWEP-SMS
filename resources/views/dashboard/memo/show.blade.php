@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Memo Details</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! HtmlHelper::back_button(['dashboard.memo.index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        
        <h3 class="box-title">Details</h3>

        <div class="box-tools">
          <a href="{{ route('dashboard.memo.edit', $memo->slug) }}" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
        </div>

      </div>
      
      <div class="box-body">


        {{-- DV Info --}}
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Memo Information</h3>
            </div>
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Reference No:</dt>
                <dd>{{ $memo->reference_no }}</dd>
                <dt>Memo Dated:</dt>
                <dd>{{ DataTypeHelper::date_parse($memo->date, 'M d, Y') }}</dd>
                <dt>Subject:</dt>
                <dd>{{ $memo->subject }}</dd>
                <dt>To:</dt>
                <dd>{{ $memo->person_to }}</dd>
                <dt>From:</dt>
                <dd>{{ $memo->person_from }}</dd>
                <dt>Type:</dt>
                <dd>{{ $memo->type }}</dd>
                <dt>Remarks:</dt>
                <dd>{{ $memo->remarks }}</dd>
              </dl>
            </div>
          </div>
        </div>




    </div>
  </div>

</section>

@endsection

