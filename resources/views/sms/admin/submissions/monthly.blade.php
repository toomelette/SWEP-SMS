<section class="content">
    <div class="box box-solid">
        <div class="box-body">
            <div class="btn-group pull-right">
                <button type="button" data="{{\Illuminate\Support\Carbon::parse($currentMonth)->subMonth(1)->format('Y-m-d')}}" class="navigate-btn btn btn-default"><i class="fa fa-arrow-left"></i></button>
                <button type="button" data="{{\Illuminate\Support\Carbon::now()->format('Y-m-01')}}" class="navigate-btn btn btn-default">Current</button>
                <button type="button" data="{{\Illuminate\Support\Carbon::parse($currentMonth)->addMonth(1)->format('Y-m-d')}}" class="navigate-btn btn btn-default"><i class="fa fa-arrow-right"></i></button>
            </div>
            <br><br>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 400px" class="text-center">Mill Code</th>
                    @if(!empty($weeksArray))
                        @foreach($weeksArray as $key => $week)
                            <th class="text-center">{{Carbon::parse($key)->format('M. d')}}</th>
                        @endforeach
                    @endif
                </tr>
                </thead>
                <tbody>
                @if(!empty($mills))
                    @foreach($mills as $mill_code => $mill)
                        <tr>
                            <td>{{$mill_code}}</td>
                            @foreach($mill['weeklyReports'] as $week => $data)
                                <td>
                                    @if(isset($data['obj']))
                                        <button class="btn  btn-sm btn-success show_report_btn" style="width: 100%;" data-toggle="modal" data-target="#show_report_modal" data="{{$data['obj']->slug}}">
                                            <i class="fa fa-check"></i> Submitted
{{--                                            {{Carbon::parse($week)->format('M d')}}--}}
                                        </button>
                                    @else
                                        <button disabled class="btn btn-default btn-sm" style="width: 100%;">
{{--                                            {{Carbon::parse($week)->format('M d')}}--}} -
                                        </button>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endif
                </tbody>

            </table>

        </div>
    </div>
</section>