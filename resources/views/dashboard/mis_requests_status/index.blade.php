@extends('layouts.modal-content')

@section('modal-header')
    {{$r->request_no}} - {{$r->nature_of_request}} - Status
@endsection

@section('modal-body')
    @php
        $timeline = [];
        if(!empty($r->status()->count() > 0)){
            $r->status()->orderBy('created_at','asc');
            foreach ($r->status as $status){
                $timeline[\Carbon\Carbon::parse($status->created_at)->format('Y-m-d')][$status->slug] = $status;
            }
        }
    @endphp
    <div class="well well-sm">
        <ul class="timeline">

            <!-- timeline time label -->


           @if(count($timeline) > 0)
                @foreach($timeline as $key => $date)
                    <li class="time-label">
                        <span class="bg-blue">
                            {{\Carbon\Carbon::parse($key)->format('M d, Y')}}
                        </span>
                    </li>
                    @if(count($date) > 0)
                        @foreach($date as $status)
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-check"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($status->created_at)->format('M d, Y | h:i A')}}</span>


                                    <div class="timeline-body">
                                        {{$status->status}}
                                    </div>

                                </div>
                            </li>
                        @endforeach
                    @endif
                @endforeach
            @endif



            <li class="time-label">
                <span class="bg-teal">
                    {{\Carbon\Carbon::parse($r->created_at)->format('M d. Y')}}
                </span>
            </li>

            <li>
                <i class="fa fa-check"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($r->created_at)->format('M d. Y | h:i A')}}</span>
                    <div class="timeline-body">
                        Request was made
                    </div>
                </div>
            </li>

        </ul>
    </div>
@endsection

@section('modal-footer')

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#update_status_form").attr('data','{{$r->slug}}');
    </script>
@endsection

