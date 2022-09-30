@extends('printables.print_layouts.print_layout_main')

@section('wrapper')
    <div id="form1" style="break-after: page">
        <div style="width: 100%; overflow: auto" >
            <div style="width: 49%; float: left; overflow: auto">
                <div>
                    <img src="{{asset('images/sra.png')}}" style="width: 50px; float: left; margin-right: 15px;">
                </div>
                <p class="no-margin text-left" style="font-size: 14px"> <b>SUGAR REGULATORY ADMINISTRATION</b></p>
                <p class="no-margin text-left" style="font-size: 12px; margin-bottom: 15px"> Sugar Monirtoring System</p>

                    <p class="no-margin text-left" style="font-size: 14px"> <b>SMS Form No. 1</b></p>
                    <p class="no-margin text-left" style="font-size: 12px"> August 2022</p>

            </div>
            <div style="width: 49%; float: right;">
                <table style="float: right" class="details-top-right-table">
                    <tr>
                        <td>Crop Year:</td>
                        <td><b>{{$wr->crop_year}}</b></td>
                    </tr>
                    <tr>
                        <td>Mill Code:</td>
                        <td><b>{{$wr->mill_code}}</b></td>
                    </tr>
                    <tr>
                        <td>Week Ending:</td>
                        <td><b>{{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('F d, Y')}}</b></td>
                    </tr>
                    <tr>
                        <td>Report No.:</td>
                        <td><b>{{$wr->report_no}}</b></td>
                    </tr>
                </table>
            </div>

        </div>

        <h4 class="no-margin"><b>WEEKLY REPORT ON RAW SUGAR</b></h4>
        <p class="no-margin"><i>(Figures in Metric Tons)</i></p>

        <table class="table-bordered " style="width: 100%">
            <thead>
            <tr >
                <th rowspan="2"></th>
                <th colspan="3" class="text-center">CURRENT CROP</th>
                <th colspan="3" class="text-center">PREVIOUS CROP</th>
            </tr>
            <tr>
                <th class="text-center">This Week</th>
                <th class="text-center">Previous</th>
                <th class="text-center">To-date</th>
                <th class="text-center">This Week</th>
                <th class="text-center">Previous</th>
                <th class="text-center">To-date</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1. MANUFACTURED</td>
                <td class="text-right">{{(isset($details_arr['form1']['manufactured'])) ? $details_arr['form1']['manufactured']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{(isset($details_arr['form1']['manufactured'])) ? $details_arr['form1']['manufactured']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="7">2. ISSUANCES/CARRY-OVER</td>
            </tr>
            @php
                $a = 'issuances';
            @endphp
            @if(isset($details_arr['form1'][$a]) && count($details_arr['form1'][$a]) > 0)
                @php
                    ksort($details_arr['form1'][$a]);
                @endphp
                @foreach($details_arr['form1'][$a] as $k =>  $$a)
                    <tr>
                        <td><span class="indent"></span>{{(isset($input_fields_arr[$k])) ? $input_fields_arr[$k]['display_name'] : $k}}</td>
                        <td class="text-right">{{(isset($details_arr['form1'][$a][$k])) ? $details_arr['form1'][$a][$k]->current_value : null}}</td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{(isset($details_arr['form1'][$a][$k])) ? $details_arr['form1'][$a][$k]->prev_value : null}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <td class="text-right">TOTAL</td>
            </tr>


            <tr>
                <td colspan="7">3. WITHDRAWALS</td>
            </tr>

            @php
                $a = 'withdrawals';
            @endphp
            @if(isset($details_arr['form1'][$a]) && count($details_arr['form1'][$a]) > 0)
                @php
                    ksort($details_arr['form1'][$a]);
                @endphp
                @foreach($details_arr['form1'][$a] as $k =>  $$a)
                    <tr>
                        <td><span class="indent"></span>{{(isset($input_fields_arr[$k])) ? $input_fields_arr[$k]['display_name'] : $k}}</td>
                        <td class="text-right">{{(isset($details_arr['form1'][$a][$k])) ? $details_arr['form1'][$a][$k]->current_value : null}}</td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{(isset($details_arr['form1'][$a][$k])) ? $details_arr['form1'][$a][$k]->prev_value : null}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td class="text-right">TOTAL</td>
            </tr>

            <tr>
                <td colspan="7">4. BALANCE</td>
            </tr>
            @php
                $a = 'balances';
            @endphp
            @if(isset($details_arr['form1'][$a]) && count($details_arr['form1'][$a]) > 0)
                @php
                    ksort($details_arr['form1'][$a]);
                @endphp
                @foreach($details_arr['form1'][$a] as $k =>  $$a)
                    <tr>
                        <td><span class="indent"></span>{{(isset($input_fields_arr[$k])) ? $input_fields_arr[$k]['display_name'] : $k}}</td>
                        <td class="text-right">{{(isset($details_arr['form1'][$a][$k])) ? $details_arr['form1'][$a][$k]->current_value : null}}</td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{(isset($details_arr['form1'][$a][$k])) ? $details_arr['form1'][$a][$k]->prev_value : null}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <td class="text-right">TOTAL</td>
            </tr>


            @php
                $fn = \App\Models\SMS\InputFields::getFields('raw_sugar_5_to_11')
            @endphp

            @foreach($fn as $f)
                <tr>
                    <td>{{$f->prefix}} {{$f->display_name}}</td>
                    <td class="text-right">
                        {{(isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->current_value : null}}
                    </td>
                    <td></td>
                    <td></td>
                    <td class="text-right">
                        {{(isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->prev_value : null}}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach


            @php
                $fn = \App\Models\SMS\InputFields::getFields('raw_sugar_share')
            @endphp

            @foreach($fn as $f)
                <tr>
                    <td>12. {{$f->prefix}} {{$f->display_name}}</td>
                    <td class="text-right">
                        {{(isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->current_value : null}}
                    </td>
                    <td></td>
                    <td></td>
                    <td class="text-right">
                        {{(isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->prev_value : null}}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach


            </tbody>
        </table>
        <table class="table-bordered" style="width: 100%;">
            @php
                $a = 'prices';

            @endphp
            <tr>
                <td colspan="6">13. Mill District Price Monitoring</td>
                <td colspan="2">WHOLSESALE(PESO/LKG)</td>
                <td colspan="2">RETAIL(PESO/KILO)</td>
            </tr>
            <tr>
                <td><span class="indent"></span>A:</td>
                <td>
                    {{(isset($details_arr['form1'][$a]['price_a'])) ? $details_arr['form1'][$a]['price_a']->current_value : null}}
                </td>
                <td>C1:</td>
                <td>
                    {{(isset($details_arr['form1'][$a]['price_c1'])) ? $details_arr['form1'][$a]['price_c1']->current_value : null}}
                </td>
                <td>DE:</td>
                <td>
                    {{(isset($details_arr['form1'][$a]['price_de'])) ? $details_arr['form1'][$a]['price_de']->current_value : null}}
                </td>
                <td>RAW:</td>
                <td>
                    {{(isset($details_arr['form1']['wholesale_raw'])) ? $details_arr['form1']['wholesale_raw']->current_value : null}}
                </td>
                <td>RAW:</td>
                <td>
                    {{(isset($details_arr['form1']['retail_raw'])) ? $details_arr['form1']['retail_raw']->current_value : null}}
                </td>
            </tr>
            <tr>
                <td><span class="indent"></span>B:</td>
                <td>
                    {{(isset($details_arr['form1'][$a]['price_b'])) ? $details_arr['form1'][$a]['price_b']->current_value : null}}
                </td>
                <td>D:</td>
                <td>
                    {{(isset($details_arr['form1'][$a]['price_d'])) ? $details_arr['form1'][$a]['price_d']->current_value : null}}
                </td>
                <td>DR:</td>
                <td>
                    {{(isset($details_arr['form1'][$a]['price_dr'])) ? $details_arr['form1'][$a]['price_dr']->current_value : null}}
                </td>
                <td>REFINED:</td>
                <td>
                    {{(isset($details_arr['form1']['wholesale_refined'])) ? $details_arr['form1']['wholesale_refined']->current_value : null}}
                </td>
                <td>REFINED:</td>
                <td>
                    {{(isset($details_arr['form1']['retail_refined'])) ? $details_arr['form1']['retail_refined']->current_value : null}}
                </td>
            </tr>

            <tr>
                <td>14. Sugar Distribution Factor: </td>
                <td colspan="9">{{(isset($details_arr['form1']['dist_factor'])) ? $details_arr['form1']['dist_factor']->current_value : null}}</td>
            </tr>
            <tr>
                <td>15. Remarks: </td>
                <td colspan="9">{{(isset($details_arr['form1']['remarks'])) ? $details_arr['form1']['remarks']->text_value : null}}</td>
            </tr>

        </table>
    </div>
    <hr class="page-break no-print">
    <div id="form2" style="break-after: page">
        <div style="width: 100%; overflow: auto">
            <div style="width: 49%; float: left">
                <div>
                    <img src="{{asset('images/sra.png')}}" style="width: 50px; float: left; margin-right: 15px;">
                </div>
                <p class="no-margin text-left" style="font-size: 14px"> <b>SUGAR REGULATORY ADMINISTRATION</b></p>
                <p class="no-margin text-left" style="font-size: 12px; margin-bottom: 15px"> Sugar Monirtoring System</p>
                <p class="no-margin text-left" style="font-size: 14px"> <b>SMS Form No. 2</b></p>
                <p class="no-margin text-left" style="font-size: 12px"> August 2022</p>
            </div>
            <div style="width: 49%; float: right">
                <table style="float: right" class="details-top-right-table">
                    <tr>
                        <td>Crop Year:</td>
                        <td><b>{{$wr->crop_year}}</b></td>
                    </tr>
                    <tr>
                        <td>Mill Code:</td>
                        <td><b>{{$wr->mill_code}}</b></td>
                    </tr>
                    <tr>
                        <td>Week Ending:</td>
                        <td><b>{{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('F d, Y')}}</b></td>
                    </tr>
                    <tr>
                        <td>Report No.:</td>
                        <td><b>{{$wr->report_no}}</b></td>
                    </tr>
                </table>
            </div>
        </div>
        <h4 class="no-margin"><b>WEEKLY REPORT ON REFINED SUGAR</b></h4>

        <table class="table-bordered " style="width: 100%">
            <thead>
            <tr >
                <th rowspan="2"></th>
                <th colspan="3" class="text-center">CURRENT CROP</th>
                <th colspan="3" class="text-center">PREVIOUS CROP</th>
            </tr>
            <tr>
                <th class="text-center">This Week</th>
                <th class="text-center">Previous</th>
                <th class="text-center">To-date</th>
                <th class="text-center">This Week</th>
                <th class="text-center">Previous</th>
                <th class="text-center">To-date</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="7">RAW SUGAR</td>

            </tr>
            <tr>
                <td>1. CARRY-OVER</td>
                <td class="text-right">{{(isset($details_arr['form2']['carryOver'])) ? $details_arr['form2']['carryOver']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{(isset($details_arr['form2']['carryOver'])) ? $details_arr['form2']['carryOver']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="7">2. Receipts: (For Refining)</td>
            </tr>
            <tr>
                <td colspan="7"><span class="indent"></span> 2.1 From Raw Mill</td>
            </tr>
            <tr>
                <td colspan><span class="indent"></span><span class="indent"></span> 2.1.1 Covered by SRO</td>
                <td class="text-right">{{(isset($details_arr['form2']['rawMillCoveredBySro'])) ? $details_arr['form2']['rawMillCoveredBySro']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{(isset($details_arr['form2']['rawMillCoveredBySro'])) ? $details_arr['form2']['rawMillCoveredBySro']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan><span class="indent"></span><span class="indent"></span> 2.1.2 Not Covered by SRO</td>
                <td class="text-right">{{(isset($details_arr['form2']['rawMillNotCoveredBySro'])) ? $details_arr['form2']['rawMillNotCoveredBySro']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{(isset($details_arr['form2']['rawMillNotCoveredBySro'])) ? $details_arr['form2']['rawMillNotCoveredBySro']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan><span class="indent"></span> 2.2 Other Mills</td>
                <td class="text-right">{{(isset($details_arr['form2']['otherMills'])) ? $details_arr['form2']['otherMills']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{(isset($details_arr['form2']['otherMills'])) ? $details_arr['form2']['otherMills']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan><span class="indent"></span> 2.3. Imported</td>
                <td class="text-right">{{(isset($details_arr['form2']['imported'])) ? $details_arr['form2']['imported']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{(isset($details_arr['form2']['imported'])) ? $details_arr['form2']['imported']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan class="text-right"><span class="indent"></span> TOTAL RECEIPTS</td>
                <td class="text-right"></td>
                <td></td>
                <td></td>
                <td class="text-right"></td>
                <td></td>
                <td></td>
            </tr>



            @php
                $fn = \App\Models\SMS\InputFields::getFields('refined_sugar_345')
            @endphp
            @foreach($fn as $k => $f)
                @php
                @endphp
                <tr>
                    <td>{{$f->prefix}} {{$f->display_name}}</td>
                    <td class="text-right">{{(isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->current_value : null}}</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{(isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->prev_value : null}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach

            <tr>
                <td colspan="7">REFINED SUGAR</td>
            </tr>
{{--            @php--}}
{{--                $a = 'refinedSugarProduction';--}}
{{--            @endphp--}}
{{--            @if( isset($details_arr['form2'][$a]) && count($details_arr['form2'][$a]) > 0)--}}
{{--                @foreach($details_arr['form2'][$a] as $k => $$a)--}}
{{--                    <tr>--}}
{{--                        <td><span class="indent"></span> {{(isset( $input_fields_arr[$k]) ) ? $input_fields_arr[$k]['display_name'] : null}}</td>--}}
{{--                        <td class="text-right">{{isset($details_arr['form2'][$a][$k]) ? $details_arr['form2'][$a][$k]->current_value : null}}</td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td class="text-right">{{isset($details_arr['form2'][$a][$k]) ? $details_arr['form2'][$a][$k]->prev_value : null}}</td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--            @endif--}}
            <tr>
                <td colspan="7">6. PRODUCTION/CARRY-OVER</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 6.1 DOMESTIC</td>
                <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionDomestic']) ? $details_arr['form2']['refinedSugarProduction']['refinedProductionDomestic']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionDomestic']) ? $details_arr['form2']['refinedSugarProduction']['refinedProductionDomestic']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td><span class="indent"></span> 6.2 IMPORTED</td>
                <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionImported']) ? $details_arr['form2']['refinedSugarProduction']['refinedProductionImported']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionImported']) ? $details_arr['form2']['refinedSugarProduction']['refinedProductionImported']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="text-right">TOTAL REFINED</td>
                <td class="text-right"></td>
                <td></td>
                <td></td>
                <td class="text-right"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><span class="indent"></span> 6.3 RETURN TO PROCESS</td>
                <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionReturnToProcess']) ? $details_arr['form2']['refinedSugarProduction']['refinedProductionReturnToProcess']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionReturnToProcess']) ? $details_arr['form2']['refinedSugarProduction']['refinedProductionReturnToProcess']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="text-right">PORDUCTION (NET)</td>
                <td class="text-right"></td>
                <td></td>
                <td></td>
                <td class="text-right"></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>7. ISSUANCES</td>
                <td class="text-right">{{(isset($details_arr['form2']['issuances'])) ? $details_arr['form2']['issuances']->current_value : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{ (isset($details_arr['form2']['issuances'])) ? $details_arr['form2']['issuances']->prev_value : null}}</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>8. WITHDRAWALS</td>
                <td class="text-right"></td>
                <td></td>
                <td></td>
                <td class="text-right"></td>
                <td></td>
                <td></td>
            </tr>



            @php
                $a = 'refinedSugarWithdrawals';
                $n = 0;
            @endphp

            @if( isset($details_arr['form2'][$a]) && count($details_arr['form2'][$a]) > 0)
                @foreach($details_arr['form2'][$a] as $k => $$a)
                    @php
                        ksort($details_arr['form2'][$a]);
                        $n++;
                    @endphp
                    <tr>
                        <td><span class="indent"></span>8.{{$n}} {{(isset($input_fields_arr[$k])) ? $input_fields_arr[$k]['display_name'] : $k}}</td>
                        <td class="text-right">{{(isset($details_arr['form2'][$k])) ? $details_arr['form2'][$k]->current_value : null}}</td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{ (isset($details_arr['form2'][$k])) ? $details_arr['form2'][$k]->prev_value : null}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endif

            @php
                $fn = \App\Models\SMS\InputFields::getFields('refined_sugar_9_to_11')
            @endphp
            @foreach($fn as $f)
                <tr>
                    <td>{{$f->prefix}} {{strtoupper($f->display_name)}}</td>
                    <td class="text-right">{{(isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->current_value : null}}</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{ (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->prev_value : null}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach












            </tbody>
        </table>
    </div>
    <hr class="page-break no-print">
    <div id="form5" style="break-after: page">
        <div style="width: 100%; overflow: auto">
            <div style="width: 49%; float: left">
                <div>
                    <img src="{{asset('images/sra.png')}}" style="width: 50px; float: left; margin-right: 15px;">
                </div>
                <p class="no-margin text-left" style="font-size: 14px"> <b>SUGAR REGULATORY ADMINISTRATION</b></p>
                <p class="no-margin text-left" style="font-size: 12px; margin-bottom: 15px"> Sugar Monirtoring System</p>

                <p class="no-margin text-left" style="font-size: 14px"> <b>SMS Form No. 5</b></p>
                <p class="no-margin text-left" style="font-size: 12px"> August 2022</p>
            </div>
            <div style="width: 49%; float: right">
                <table style="float: right" class="details-top-right-table">
                    <tr>
                        <td>Crop Year:</td>
                        <td><b>{{$wr->crop_year}}</b></td>
                    </tr>
                    <tr>
                        <td>Mill Code:</td>
                        <td><b>{{$wr->mill_code}}</b></td>
                    </tr>
                    <tr>
                        <td>Week Ending:</td>
                        <td><b>{{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('F d, Y')}}</b></td>
                    </tr>
                    <tr>
                        <td>Report No.:</td>
                        <td><b>{{$wr->report_no}}</b></td>
                    </tr>
                </table>
            </div>
        </div>
        <h4 class="no-margin"><b>SUGAR RELEASE ORDER AND DELIVERY REPORT - RAW</b> </h4>
        <p class="no-margin"><i>(Figures in M.T.)</i></p>

        <p class="text-left">A. Issuances of SRO</p>
        <table class="table-bordered details-top-right-table" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center">SRO No.</th>
                    <th class="text-center">Trader/Owner</th>
                    <th class="text-center">Date of Issue</th>
                    <th class="text-center">Liens OR #.</th>
                    <th class="text-center">Sugar Class</th>
                    <th class="text-center">Qty. M.T.</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($wr->form5IssuancesOfSro))
                    @foreach($wr->form5IssuancesOfSro as $form5IssuancesOfSro)
                        <tr>
                            <td>{{$form5IssuancesOfSro->sro_no}}</td>
                            <td>{{$form5IssuancesOfSro->trader}}</td>
                            <td class="text-center">{{Carbon::parse($form5IssuancesOfSro->date_of_issue)->format('m/d/Y')}}</td>
                            <td class="text-center">{{$form5IssuancesOfSro->liens_or}}</td>
                            <td>{{$form5IssuancesOfSro->sugar_class}}</td>
                            <td class="text-right">{{$form5IssuancesOfSro->qty}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <br>
        <p class="text-left">B. Delivery</p>
        @php
            $sugarClasses = $wr->form5Deliveries()->groupBy('sugar_class')->get();
            $usedSugarClassesArray = ['A','B','C'];
            if(!empty($sugarClasses)){
                foreach ($sugarClasses as $sugarClass){
                    if(!in_array($sugarClass->sugar_class,$usedSugarClassesArray)){
                        array_push($usedSugarClassesArray,$sugarClass->sugar_class);
                    }
                }
            }
        @endphp
        <table class="table-bordered details-top-right-table" style="width: 100%">
            <thead>
            <tr>
                <th rowspan="2" class="text-center">SRO No.</th>
                <th rowspan="2" class="text-center">Trader/Owner</th>
                <th colspan="{{count($usedSugarClassesArray)}}" class="text-center">Sugar Class</th>
                <th rowspan="2" class="text-center">Remarks</th>
            </tr>
            <tr>
                @foreach($usedSugarClassesArray as $class)
                    <td class="text-center" style="width: 10%">
                        {{$class}}
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody>

            @if(!empty($wr->form5Deliveries))
                @foreach($wr->form5Deliveries as $form5Deliveries)
                    <tr>
                        <td>{{$form5Deliveries->sro_no}}</td>
                        <td>{{$form5Deliveries->trader}}</td>
                        @foreach($usedSugarClassesArray as $class)
                            @if($form5Deliveries->sugar_class == $class)
                                <td class="text-right">
                                    {{($form5Deliveries->qty != null) ? number_format($form5Deliveries->qty,3) : null}}
                                </td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                        <td>{{$form5Deliveries->remarks}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <br>
        <p class="text-left">C. Served SRO <small><i>(To be transmitted to SRA with Permit Portion, Ledger of Withdrawals & Listing*)</i></small></p>
        <table  class="table-bordered details-top-right-table" style="width: 100%">
            <thead>
                <tr>
                    <th>SRO No. </th>
                    <th>CEAs, COCs, Letter Authority, etc. </th>
                    <th>Permit Portion No. of Pcs.</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($wr->form5ServedSros))
                    @foreach($wr->form5ServedSros as $form5ServedSros)
                        <tr>
                            <td>{{$form5ServedSros->sro_no}}</td>
                            <td>{{$form5ServedSros->cea}}</td>
                            <td>{{$form5ServedSros->permit_portion}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    <hr class="page-break no-print">
    <div id="form5a" style="break-after: page">
        <div style="width: 100%; overflow: auto">
            <div style="width: 49%; float: left">
                <div>
                    <img src="{{asset('images/sra.png')}}" style="width: 50px; float: left; margin-right: 15px;">
                </div>
                <p class="no-margin text-left" style="font-size: 14px"> <b>SUGAR REGULATORY ADMINISTRATION</b></p>
                <p class="no-margin text-left" style="font-size: 12px; margin-bottom: 15px"> Sugar Monirtoring System</p>
                <p class="no-margin text-left" style="font-size: 14px"> <b>SMS Form No. 5A</b></p>
                <p class="no-margin text-left" style="font-size: 12px"> August 2022</p>
            </div>
            <div style="width: 49%; float: right">
                <table style="float: right" class="details-top-right-table">
                    <tr>
                        <td>Crop Year:</td>
                        <td><b>{{$wr->crop_year}}</b></td>
                    </tr>
                    <tr>
                        <td>Mill Code:</td>
                        <td><b>{{$wr->mill_code}}</b></td>
                    </tr>
                    <tr>
                        <td>Week Ending:</td>
                        <td><b>{{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('F d, Y')}}</b></td>
                    </tr>
                    <tr>
                        <td>Report No.:</td>
                        <td><b>{{$wr->report_no}}</b></td>
                    </tr>
                </table>
            </div>
        </div>

        <h4 class="no-margin"><b>SUGAR RELEASE ORDER AND DELIVERY REPORT - REFINED</b> </h4>
        <p class="no-margin"><i>(Figures in 50-Kg Bags)</i></p>

        <p class="text-left">A. Issuances of Refined Sugar Release Order</p>

        <table class="table-bordered details-top-right-table" style="width: 100%">
            <thead>
                <tr>
                    <th>Date of Issue</th>
                    <th>Ref. SRO S.N.</th>
                    <th>Trader/Tollee</th>
                    <th>Raw Qty.</th>
                    <th>Monitoring Fee OR #</th>
                    <th>RSQ No.</th>
                    <th>Refined Qty.</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($wr->form5aIssuancesOfSro))
                    @foreach($wr->form5aIssuancesOfSro as $form5aIssuancesOfSro)
                        <tr>
                            <td>{{\Illuminate\Support\Carbon::parse($form5aIssuancesOfSro->date_of_issue)->format('m/d/Y')}}</td>
                            <td>{{$form5aIssuancesOfSro->sro_no}}</td>
                            <td>{{$form5aIssuancesOfSro->trader}}</td>
                            <td>{{$form5aIssuancesOfSro->raw_qty}}</td>
                            <td>{{$form5aIssuancesOfSro->monitoring_fee_or_no}}</td>
                            <td>{{$form5aIssuancesOfSro->rsq_no}}</td>
                            <td>{{$form5aIssuancesOfSro->refined_qty}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <br>
        <p class="text-left">B. Delivery</p>

        <table class="table-bordered details-top-right-table" style="width: 100%">
            <thead>
            <tr>
                <th>Date of Withdrawal</th>
                <th>Ref. SRO S.N.</th>
                <th>Trader/Tollee</th>
                <th>Qty. Standard</th>
                <th>Qty. Premium</th>
                <th>Total</th>
                <th>Remarks</th>
            </tr>
            @if(!empty($wr->form5aDeliveries))
                @foreach($wr->form5aDeliveries as $form5aDeliveries)
                    <tr>
                        <td>{{\Illuminate\Support\Carbon::parse($form5aDeliveries->date_of_withdrawal)->format('m/d/Y')}}</td>
                        <td>{{$form5aDeliveries->sro_no}}</td>
                        <td>{{$form5aDeliveries->trader}}</td>
                        <td>{{$form5aDeliveries->qty_standard}}</td>
                        <td>{{$form5aDeliveries->qty_premium}}</td>
                        <td>{{$form5aDeliveries->qty_total}}</td>
                        <td>{{$form5aDeliveries->remarks}}</td>
                    </tr>
                @endforeach
            @endif
            </thead>
        </table>

        <br>
        <p class="text-left">C. Served Refined SRO <i>(To be transmitted to SRA with Permit Portion)</i></p>
        <table class="table-bordered details-top-right-table" style="width: 100%">
            <thead>
                <tr>
                    <th>Ref. SRO S.N.</th>
                    <th>Trader/Tollee</th>
                    <th>No. of Pcs of Quedan</th>
                </tr>
            </thead>
            @if(!empty($wr->form5aServedSros))
                @foreach($wr->form5aServedSros as $form5aServedSros)
                    <tr>
                        <td>{{$form5aServedSros->sro_no}}</td>
                        <td>{{$form5aServedSros->trader}}</td>
                        <td>{{$form5aServedSros->quedan_pcs}}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
@endsection