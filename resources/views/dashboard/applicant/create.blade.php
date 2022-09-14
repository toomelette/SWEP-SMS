@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Add Applicants</h1>
    </section>

    <section class="content">
        <div class="callout callout-info">
            <h4>Add Applicant page has been moved!</h4>

            <a href="{{route('dashboard.applicant.index')}}?initiator=create">Click here and you will be guided.</a>
        </div>
    </section>


@endsection


@section('modals')

@endsection

@section('scripts')

@endsection