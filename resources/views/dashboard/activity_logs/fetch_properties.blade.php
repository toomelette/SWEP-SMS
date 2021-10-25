
@php
    $ignored_columns = [
    'updated_at',
    'user_updated',
    'ip_updated',
    'id',
    'slug',
    'user_id',
    'explanation',
    'created_at',
    'user_created',
    'user_updated',
    'ip_created'
    ];
@endphp
<p class="text-strong text-aqua">{{Carbon::parse($activity->created_at)->format('F d, Y | h:i A')}}</p>

@if($activity->description == 'updated')
    <div class="col-md-6 text-red">
        <label>OLD DATA</label>
        @if(isset($activity->properties['old']))
            @foreach($activity->properties['old'] as $key=>$old)
                @if(!in_array($key,$ignored_columns))
                    <div style="margin-bottom: 10px">
                        <p class="text-left no-margin text-strong">{{strtoupper($key)}}:</p>
                        <p class="text-left no-margin">• {{$old}}</p>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <div class="col-md-6">
        <label>NEW DATA</label>
        @if(isset($activity->properties['attributes']))
            @foreach($activity->properties['attributes'] as $key=>$new)
                @if(!in_array($key,$ignored_columns))
                    <div style="margin-bottom: 10px">
                        <p class="text-left no-margin text-strong">{{strtoupper($key)}}:</p>
                        <p class="text-left no-margin">• {{$new}}</p>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endif


@if($activity->description == 'created')
    <div class="col-md-12">
        @if(isset($activity->properties['attributes']))
            @php($num = 0)
             @foreach($activity->properties['attributes'] as $key=>$new)
                @if(!in_array($key,$ignored_columns))
                    @if($num % 2 == 0)
                        <div class="row">
                    @endif
                    <div style="margin-bottom: 10px" class="col-md-6">
                        <p class="text-left no-margin text-strong">{{strtoupper($key)}}:</p>
                        <p class="text-left no-margin">• {{$new == '' ? 'null' : $new}}</p>
                    </div>
                    @if($num %2 != 0)
                        </div>
                    @endif
                    @php($num++)
                @endif
            @endforeach
        @endif

    </div>

@endif


@if($activity->description == 'deleted')

    <div class="col-md-12">
        @if(isset($activity->properties['attributes']))
            @php($num = 0)
            @foreach($activity->properties['attributes'] as $key=>$new)
                @if(!in_array($key,$ignored_columns))
                    @if($num % 2 == 0)
                        <div class="row">
                            @endif
                            <div style="margin-bottom: 10px" class="col-md-6">
                                <p class="text-left no-margin text-strong">{{strtoupper($key)}}:</p>
                                <p class="text-left no-margin">• {{$new == '' ? 'null' : $new}}</p>
                            </div>
                            @if($num %2 != 0)
                        </div>
                    @endif
                    @php($num++)
                @endif
            @endforeach
        @endif

    </div>
    <p><span class="label bg-red">DELETED</span></p>
@endif


@if($activity->description == 'generated')

    <div class="col-md-12">
        @if(isset($activity->properties['attributes']))
            <p>{{$activity->properties['attributes']}}</p>
        @else
            <p class="text-red">No log indicated</p>
        @endif

    </div>
@endif

@if($activity->description == 'auth')

    <div class="col-md-12">
        @if(isset($activity->properties['attributes']))
            <p>{{$activity->properties['attributes']}}</p>
        @else
            <p class="text-red">No log indicated</p>
        @endif

    </div>
@endif


