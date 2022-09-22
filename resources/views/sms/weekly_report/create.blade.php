@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Weekly Report Submission</h1>
</section>
@endsection
@section('content2')

<section class="content">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Please select:</h3>
        </div>
            @php
                $report_types = \App\Models\SMS\ReportTypes::query()->get();
            @endphp
        <div class="box-body">
            @if(!empty($report_types))
                @foreach($report_types as $report_type)
                    <a href="{{route('dashboard.weekly_report.create')}}?report_type={{$report_type->slug}}">{{$report_type->description}}</a>
                @endforeach
            @endif
        </div>

    </div>

</section>


@endsection


@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection