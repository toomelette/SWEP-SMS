@extends('printables.print_layouts.print_layout_main')


@section('wrapper')

    <table class="table">
        <tr>
            <td>COMPARATIVE GTCM, LKG/TC & RAW SUGAR PRODUCTION</td>
            <td>
                <table class="table">
                    <tr>
                        <td>Week Ending:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Report No:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Crop year:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">Mills</th>
                <th rowspan="2">Start of Milling</th>
                <th rowspan="2">End of Milling</th>
                <th colspan="2">GTCM</th>
                <th colspan="2">LKG/TC</th>
                <th colspan="3">Raw Sugar Production</th>
                <th rowspan="2">Percentage</th>
            </tr>
            <tr>
                <th>CY 1</th>
                <th>CY 2</th>

                <th>CY 1</th>
                <th>CY 2</th>

                <th>CY 1</th>
                <th>CY 2</th>
                <th>% INC</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($current))
                @foreach($current as $group => $mills)
                    @if(!empty($mills))
                        @foreach($mills as $mill_code => $mill)
                            <tr>
                                <td>{{$mill_code}}</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($mill['gtcm'] ?? null,3,'-')}}</td>
                                <td></td>
                                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($mill['lkgtcGross'] ?? null,3,'-')}}</td>
                                <td></td>
                                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($mill['rawSugarProduction'] ?? null,3,'-')}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
@endsection