<div id="form1" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 1'])

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
            <td class="text-right">
                {{(isset($details_arr['form1']['manufactured']->current_value)) ? number_format($details_arr['form1']['manufactured']->current_value,3) : null}}</td>
            <td></td>
            <td></td>
            <td class="text-right">
                {{(isset($details_arr['form1']['manufactured']->prev_value)) ? number_format($details_arr['form1']['manufactured']->prev_value ,3): null}}
            </td>
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
                    <td class="text-right">{{(isset($details_arr['form1'][$a][$k]->current_value)) ? number_format($details_arr['form1'][$a][$k]->current_value,3) : null}}</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{(isset($details_arr['form1'][$a][$k]->prev_value)) ? number_format($details_arr['form1'][$a][$k]->prev_value,3) : null}}</td>
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
                    <td class="text-right">
                        {{(isset($details_arr['form1'][$a][$k]->current_value)) ? number_format($details_arr['form1'][$a][$k]->current_value,3) : null}}</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">
                        {{(isset($details_arr['form1'][$a][$k]->prev_value)) ? number_format($details_arr['form1'][$a][$k]->prev_value,3) : null}}</td>
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
                    <td class="text-right">{{(isset($details_arr['form1'][$a][$k]->current_value)) ? number_format($details_arr['form1'][$a][$k]->current_value,3) : null}}</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{(isset($details_arr['form1'][$a][$k]->prev_value)) ? number_format($details_arr['form1'][$a][$k]->prev_value,3) : null}}</td>
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
                    {{(isset($details_arr['form1'][$f->field]->current_value)) ? number_format($details_arr['form1'][$f->field]->current_value,3) : null}}
                </td>
                <td></td>
                <td></td>
                <td class="text-right">
                    {{(isset($details_arr['form1'][$f->field]->prev_value)) ? number_format($details_arr['form1'][$f->field]->prev_value,3) : null}}
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
                    {{(isset($details_arr['form1'][$f->field]->current_value)) ? number_format($details_arr['form1'][$f->field]->current_value,3) : null}}
                </td>
                <td></td>
                <td></td>
                <td class="text-right">
                    {{(isset($details_arr['form1'][$f->field]->prev_value)) ? number_format($details_arr['form1'][$f->field]->prev_value,3) : null}}
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
                {{(isset($details_arr['form1'][$a]['price_a']->current_value)) ?  number_format($details_arr['form1'][$a]['price_a']->current_value,2) : null}}
            </td>
            <td>C1:</td>
            <td>
                {{(isset($details_arr['form1'][$a]['price_c1']->current_value)) ?  number_format($details_arr['form1'][$a]['price_c1']->current_value,2) : null}}
            </td>
            <td>DE:</td>
            <td>
                {{(isset($details_arr['form1'][$a]['price_de']->current_value)) ?  number_format($details_arr['form1'][$a]['price_de']->current_value ,2): null}}
            </td>
            <td>RAW:</td>
            <td>
                {{(isset($details_arr['form1']['wholesale_raw']->current_value)) ?  number_format($details_arr['form1']['wholesale_raw']->current_value,2) : null}}
            </td>
            <td>RAW:</td>
            <td>
                {{(isset($details_arr['form1']['retail_raw']->current_value)) ? number_format( $details_arr['form1']['retail_raw']->current_value,2) : null}}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span>B:</td>
            <td>
                {{(isset($details_arr['form1'][$a]['price_b']->current_value)) ? number_format($details_arr['form1'][$a]['price_b']->current_value,2) : null}}
            </td>
            <td>D:</td>
            <td>
                {{(isset($details_arr['form1'][$a]['price_d']->current_value)) ? number_format($details_arr['form1'][$a]['price_d']->current_value,2) : null}}
            </td>
            <td>DR:</td>
            <td>
                {{(isset($details_arr['form1'][$a]['price_dr']->current_value)) ? number_format($details_arr['form1'][$a]['price_dr']->current_value,2) : null}}
            </td>
            <td>REFINED:</td>
            <td>
                {{(isset($details_arr['form1']['wholesale_refined']->current_value)) ? number_format($details_arr['form1']['wholesale_refined']->current_value,2) : null}}
            </td>
            <td>REFINED:</td>
            <td>
                {{(isset($details_arr['form1']['retail_refined']->current_value)) ? number_format($details_arr['form1']['retail_refined']->current_value,2) : null}}
            </td>
        </tr>

        <tr>
            <td>14. Sugar Distribution Factor: </td>
            <td colspan="9">{{(isset($details_arr['form1']['dist_factor']->current_value)) ? number_format($details_arr['form1']['dist_factor']->current_value,2) : null}}</td>
        </tr>
        <tr>
            <td>15. Remarks: </td>
            <td colspan="9">{{(isset($details_arr['form1']['remarks'])) ? $details_arr['form1']['remarks']->text_value : null}}</td>
        </tr>

    </table>
    <table class="sign-table cols-3">
        <tr>
            <td>Certified:</td>
            <td>Verified:</td>
            <td>Verfiied:</td>
        </tr>
        <tr >
            <td>
                <u>{{$signatories['form1']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form1']['sign2']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form1']['sign3']['name'] ?? null}}</u>
            </td>
        </tr>
        <tr >
            <td>
                {{$signatories['form1']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form1']['sign2']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form1']['sign3']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>