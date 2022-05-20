@php
    $diff = 0;
    if(Carbon::now() < \Illuminate\Support\Carbon::parse($requested_month)){
        $diff = \Illuminate\Support\Carbon::now()->firstOfYear()->diffInYears($requested_month);
    }
@endphp
@if(count($bday_celebrants['today']) > 0)
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-top: 5px">
        Today:
    </p>
    <ul class="todo-list ">
        @foreach($bday_celebrants['today'] as $celebrants)
            @foreach($celebrants as $celebrant)
                @if(\Illuminate\Support\Carbon::parse($requested_month)->firstOfMonth()->format('Y-m-d') == \Illuminate\Support\Carbon::now()->firstOfMonth()->format('Y-m-d'))
                    <li>
                        <a href="{{route('dashboard.employee.index')}}?find={{$celebrant->employee_no}}" target="_blank">{{strtoupper($celebrant->lastname)}}, {{strtoupper($celebrant->firstname)}} - {{\Illuminate\Support\Carbon::parse($celebrant->birthday)->age}} years old</a>
                        <small class="label label-danger pull-right"><i class="fa fa-birthday-cake"></i> TODAY</small>
                    </li>
                @else
                    <li>
                        <a href="{{route('dashboard.employee.index')}}?find={{$celebrant->employee_no}}" target="_blank">
                            {{strtoupper($celebrant->lastname)}}, {{strtoupper($celebrant->firstname)}} - turning {{\Illuminate\Support\Carbon::parse($celebrant->birthday)->diffInYears($requested_month)+1}}
                        </a>
                        <small class="label label-info pull-right"><i class="fa fa-birthday-cake"></i> TODAY</small>
                    </li>
                @endif

            @endforeach

        @endforeach
    </ul>
@endif

@if(count($bday_celebrants['upcoming']) > 0)
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-top: 5px">
        Upcoming:
    </p>
    <ul class="todo-list">
        @foreach($bday_celebrants['upcoming'] as $celebrants)
            @foreach($celebrants as $celebrant)
                <li>
                    <a href="{{route('dashboard.employee.index')}}?find={{$celebrant->employee_no}}" target="_blank">
                        {{strtoupper($celebrant->lastname)}}, {{strtoupper($celebrant->firstname)}} - turning {{\Illuminate\Support\Carbon::parse($celebrant->birthday)->diffInYears($requested_month)+1}}
                    </a>
                    <small class="label label-info pull-right"><i class="fa fa-calendar"></i> {{Carbon::parse($celebrant->birthday)->format('F d')}}</small>
                </li>
            @endforeach

        @endforeach
    </ul>
@endif

@if(count($bday_celebrants['prev']) > 0)
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-top: 5px">
        More this month:
    </p>
    <ul class="todo-list">
        @foreach($bday_celebrants['prev'] as $celebrants)
            @foreach($celebrants as $celebrant)
                <li>
                    <a href="{{route('dashboard.employee.index')}}?find={{$celebrant->employee_no}}" target="_blank">
                        {{strtoupper($celebrant->lastname)}}, {{strtoupper($celebrant->firstname)}} - {{\Illuminate\Support\Carbon::parse($celebrant->birthday)->diffInYears($requested_month)+1}} years old
                    </a>
                    <small class="label label-default pull-right"><i class="fa fa-calendar"></i>  {{Carbon::parse($celebrant->birthday)->format('F d')}}</small>
                </li>
            @endforeach

        @endforeach
    </ul>
@endif