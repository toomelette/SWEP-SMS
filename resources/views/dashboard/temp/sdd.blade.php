
@include('layouts.css-plugins')

@foreach($employees as $sex => $ages)
    @php
        $totals = [];
        $grand_total = 0;
        foreach($columns as $column){
            $totals[$column] = 0;
        }
    @endphp
    <p class="text-strong">{{$sex}}</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>AGE</th>
                @foreach($columns as $column)
                    <th>{{$column}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($ages as $age_range=>$grouping)
                <tr>
                    <td>{{$age_range}}</td>
                    @foreach($columns as $column)
                        @if(isset($grouping[$column]))
                            @php
                                $totals[$column] = $totals[$column] + count($grouping[$column]);
                            @endphp
                            <td>{{count($grouping[$column])}}</td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            <tr class="text-strong">
                <td>TOTAL</td>
                @foreach($columns as $column)
                    @php($grand_total = $grand_total + $totals[$column])
                    <td>{{$totals[$column]}}</td>
                @endforeach
            </tr>
            <tr>
                <td>%</td>
                @foreach($columns as $column)
                    <td>{{round($totals[$column]/$grand_total * 100,1)}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
@endforeach