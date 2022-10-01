<div id="form2" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 2'])
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
            <td class="text-right">
                {{(isset($details_arr['form2']['carryOver']->current_value)) ? number_format($details_arr['form2']['carryOver']->current_value,3) : null}}
            </td>
            <td></td>
            <td></td>
            <td class="text-right">
                {{(isset($details_arr['form2']['carryOver']->prev_value)) ? number_format($details_arr['form2']['carryOver']->prev_value,3) : null}}
            </td>
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
            <td class="text-right">{{(isset($details_arr['form2']['rawMillCoveredBySro']->current_value)) ? number_format($details_arr['form2']['rawMillCoveredBySro']->current_value,3) : null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">{{(isset($details_arr['form2']['rawMillCoveredBySro']->prev_value)) ? number_format($details_arr['form2']['rawMillCoveredBySro']->prev_value,3) : null}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span><span class="indent"></span> 2.1.2 Not Covered by SRO</td>
            <td class="text-right">{{(isset($details_arr['form2']['rawMillNotCoveredBySro']->current_value)) ? number_format($details_arr['form2']['rawMillNotCoveredBySro']->current_value,3) : null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">{{(isset($details_arr['form2']['rawMillNotCoveredBySro']->prev_value)) ? number_format($details_arr['form2']['rawMillNotCoveredBySro']->prev_value,3) : null}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span> 2.2 Other Mills</td>
            <td class="text-right">{{(isset($details_arr['form2']['otherMills']->current_value)) ? number_format($details_arr['form2']['otherMills']->current_value,3) : null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">{{(isset($details_arr['form2']['otherMills']->prev_value)) ? number_format($details_arr['form2']['otherMills']->prev_value,3) : null}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span> 2.3. Imported</td>
            <td class="text-right">{{(isset($details_arr['form2']['imported']->current_value)) ? number_format($details_arr['form2']['imported']->current_value,3) : null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">{{(isset($details_arr['form2']['imported']->prev_value)) ? number_format($details_arr['form2']['imported']->prev_value,3) : null}}</td>
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
                <td class="text-right">{{(isset($details_arr['form2'][$f->field]->current_value)) ? number_format($details_arr['form2'][$f->field]->current_value,2) : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{(isset($details_arr['form2'][$f->field]->prev_value)) ? number_format($details_arr['form2'][$f->field]->prev_value,2) : null}}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach

        <tr>
            <td colspan="7">REFINED SUGAR</td>
        </tr>

        <tr>
            <td colspan="7">6. PRODUCTION/CARRY-OVER</td>
        </tr>
        <tr>
            <td><span class="indent"></span> 6.1 DOMESTIC</td>
            <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionDomestic']->current_value) ? number_format( $details_arr['form2']['refinedSugarProduction']['refinedProductionDomestic']->current_value,2) : null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionDomestic']->prev_value) ?  number_format($details_arr['form2']['refinedSugarProduction']['refinedProductionDomestic']->prev_value,2) : null}}</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td><span class="indent"></span> 6.2 IMPORTED</td>
            <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionImported']->current_value) ?  number_format($details_arr['form2']['refinedSugarProduction']['refinedProductionImported']->current_value,2) : null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionImported']->prev_value) ?  number_format($details_arr['form2']['refinedSugarProduction']['refinedProductionImported']->prev_value,2) : null}}</td>
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
            <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionReturnToProcess']->current_value) ? number_format($details_arr['form2']['refinedSugarProduction']['refinedProductionReturnToProcess']->current_value ,2): null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">{{isset($details_arr['form2']['refinedSugarProduction']['refinedProductionReturnToProcess']->prev_value) ? number_format($details_arr['form2']['refinedSugarProduction']['refinedProductionReturnToProcess']->prev_value ,2): null}}</td>
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
            <td class="text-right">
                {{(isset($details_arr['form2']['issuances']->current_value )) ? number_format($details_arr['form2']['issuances']->current_value,2) : null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">
                {{ (isset($details_arr['form2']['issuances']->prev_value)) ? number_format($details_arr['form2']['issuances']->prev_value,2) : null}}</td>
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
                    <td class="text-right">{{(isset($details_arr['form2'][$a][$k]->current_value)) ? number_format($details_arr['form2'][$a][$k]->current_value,2) : null}}</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{ (isset($details_arr['form2'][$a][$k]->prev_value)) ? number_format($details_arr['form2'][$a][$k]->prev_value,2) : null}}</td>
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
                <td class="text-right">{{(isset($details_arr['form2'][$f->field]->current_value)) ? number_format($details_arr['form2'][$f->field]->current_value,2) : null}}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{ (isset($details_arr['form2'][$f->field]->prev_value)) ? number_format($details_arr['form2'][$f->field]->prev_value,2) : null}}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <table class="sign-table cols-3">
        <tr>
            <td>Certified:</td>
            <td>Verified:</td>
            <td>Verfiied:</td>
        </tr>
        <tr >
            <td>
                <u>{{$signatories['form2']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form2']['sign2']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form2']['sign3']['name'] ?? null}}</u>
            </td>
        </tr>
        <tr >
            <td>
                {{$signatories['form2']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form2']['sign2']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form2']['sign3']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>