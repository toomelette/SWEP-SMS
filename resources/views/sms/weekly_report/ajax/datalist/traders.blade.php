
@if(count($traders) > 0)
    @foreach($traders as $trader)
        <option value="{{$trader}}"></option>
    @endforeach
@endif