@extends('layouts.modal-content')

@section('modal-header')
    {!! \Illuminate\Support\Str::limit(strip_tags($dv->explanation),60,'...') !!}
@endsection

@section('modal-body')
<p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
    Disbursement Voucher Details
</p>
<div class="well well-sm">
    <dl class="dl-horizontal">
        <dt>DV No:</dt>
        <dd>{{ $dv->dv_no }}</dd>
        <dt>Station:</dt>
        <dd>{{ optional($dv->project)->project_address }}</dd>
        <dt>Fund Source:</dt>
        <dd>{{ optional($dv->fundSource)->description }}</dd>
        <dt>Mode of Payment:</dt>
        <dd>{{ $dv->mode_of_payment }}</dd>
        <dt>Payee:</dt>
        <dd>{{ $dv->payee }}</dd>
        <dt>TIN:</dt>
        <dd>{{ $dv->tin }}</dd>
        <dt>BUR No.:</dt>
        <dd>{{ $dv->bur_no }}</dd>
        <dt>Address:</dt>
        <dd>{{ $dv->address }}</dd>
        <dt>Department:</dt>
        <dd>{{ $dv->department_name }}</dd>
        <dt>Unit:</dt>
        <dd>{{ optional($dv->departmentUnit)->description }}</dd>
        <dt>Project Code:</dt>
        <dd>{{ $dv->project_code }}</dd>
        <dt>Explanation:</dt>
        <dd>
            <div style="border:solid 1px; padding:10px;" class="clearfix">
                {!! $dv->explanation !!}
            </div>
        </dd>
        <dt>Amount:</dt>
        <dd>{{ number_format($dv->amount, 2) }}</dd>
    </dl>
</div>

<p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
    Certification and Approval
</p>

<div class="well well-sm">
    <dl class="dl-horizontal">
        <dt>Certified by:</dt>
        <dd><b>{{ $dv->certified_by}}</b>, <i>{{ $dv->certified_by_position}}</i> </dd>
        <dt>Approved by:</dt>
        <dd><b>{{ $dv->approved_by}}</b> , <i>{{ $dv->approved_by_position}}</i> </dd>
    </dl>
</div>


<p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
    Progress
</p>

<div class="well well-sm">
    <dl class="dl-horizontal">
        <dt>Filed:</dt>
        <dd>{{ $dv->created_at != null ? __dataType::date_parse($dv->created_at, 'M d, Y h:i A') : '' }}</dd>
        <dt>Processed:</dt>
        <dd>{{ $dv->processed_at != null ? __dataType::date_parse($dv->processed_at, 'M d, Y h:i A') : '' }}</dd>
        <dt>Completed:</dt>
        <dd>{{ $dv->checked_at != null ? __dataType::date_parse($dv->checked_at, 'M d, Y h:i A') : '' }}</dd>
    </dl>
</div>
@endsection

@section('modal-footer')
    <div class="row">
        {!! \App\Swep\ViewHelpers\__html::timestamp($dv,'5') !!}
        <div class="col-md-2">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
@endsection

@section('scripts')

@endsection

