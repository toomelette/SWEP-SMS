@extends('layouts.modal-content')

@section('modal-header')
{{$jo->lastname}}, {{$jo->firstname}}
@endsection

@section('modal-body')
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
        Personal Information
    </p>
    <div class="well well-sm">
        <dl class="dl-horizontal">
            <dt>Last Name:</dt>
            <dd>{{$jo->lastname}}</dd>

            <dt>First Name:</dt>
            <dd>{{$jo->firstname}}</dd>

            <dt>Middle Name:</dt>
            <dd>{{$jo->middlename}}</dd>

            <dt>Suffix:</dt>
            <dd>{{$jo->name_ext}}</dd>

            <dt>Birthday:</dt>
            <dd>{{\Carbon\Carbon::parse($jo->birthday)->format('F d, Y')}}</dd>

            <dt>Age:</dt>
            <dd>{{\Carbon\Carbon::parse($jo->birthday)->age}} years old</dd>

            <dt>Sex:</dt>
            <dd>{{$jo->sex}}</dd>

            <dt>Civil Status:</dt>
            <dd>{{$jo->civil_status}}</dd>

            <dt>Email Address:</dt>
            <dd>{{$jo->email}}</dd>

            <dt>Contact No.:</dt>
            <dd>{{$jo->phone}}</dd>

        </dl>
    </div>

    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
        Employment Details
    </p>
    <div class="well well-sm">
        <dl class="dl-horizontal">
            <dt>Employee No:</dt>
            <dd>{{$jo->employee_no}}</dd>

            <dt>Department Unit:</dt>
            <dd>{{$jo->department_unit}}</dd>

            <dt>Position:</dt>
            <dd>{{$jo->position}}</dd>

            <dt>Biometric User Id:</dt>
            <dd>{{$jo->biometric_user_id}}</dd>
        </dl>
    </div>

    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
        Address
    </p>
    <div class="well well-sm">
        <dl class="dl-horizontal">
            <dt>Province:</dt>
            <dd>{{$jo->province}}</dd>

            <dt>City/Municipality:</dt>
            <dd>{{$jo->city}}</dd>

            <dt>Barangay:</dt>
            <dd>{{$jo->brgy}}</dd>

            <dt>Detailed Address:</dt>
            <dd>{{$jo->address_detailed}}</dd>
        </dl>
    </div>
@endsection

@section('modal-footer')
    <div class="row">
        {!! \App\Swep\ViewHelpers\__html::timestamp($jo,'5') !!}
        <div class="col-md-2">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
@endsection

@section('scripts')

@endsection

