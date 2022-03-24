@if(count($bday_celebrants['today']) > 0)
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-top: 5px">
        Today:
    </p>
    <ul class="todo-list ui-sortable">
        @foreach($bday_celebrants['today'] as $celebrants)
            @foreach($celebrants as $celebrant)
                <li>
                    {{strtoupper($celebrant->lastname)}}, {{strtoupper($celebrant->firstname)}} - {{Carbon::parse($celebrant->birthday)->age}} years old
                    <small class="label label-danger pull-right"><i class="fa fa-birthday-cake"></i> TODAY</small>
                </li>
            @endforeach

        @endforeach
    </ul>
@endif

@if(count($bday_celebrants['upcoming']) > 0)
    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-top: 5px">
        Upcoming:
    </p>
    <ul class="todo-list ui-sortable">
        @foreach($bday_celebrants['upcoming'] as $celebrants)
            @foreach($celebrants as $celebrant)
                <li>
                    {{strtoupper($celebrant->lastname)}}, {{strtoupper($celebrant->firstname)}} - turning {{Carbon::parse($celebrant->birthday)->age+1}}
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
    <ul class="todo-list ui-sortable">
        @foreach($bday_celebrants['prev'] as $celebrants)
            @foreach($celebrants as $celebrant)
                <li>
                    {{strtoupper($celebrant->lastname)}}, {{strtoupper($celebrant->firstname)}} - {{Carbon::parse($celebrant->birthday)->age}} years old
                    <small class="label label-default pull-right"><i class="fa fa-calendar"></i>  {{Carbon::parse($celebrant->birthday)->format('F d')}}</small>
                </li>
            @endforeach

        @endforeach
    </ul>
@endif