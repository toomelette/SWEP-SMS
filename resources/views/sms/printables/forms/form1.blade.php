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
                {{ \App\Swep\Helpers\Helper::toNumber($form1['manufactured']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['manufactured']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{\App\Swep\Helpers\Helper::toNumber($toDateForm1['manufactured']['current'] ?? null ,3)}}
            </td>

            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['manufactured']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['manufactured']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{\App\Swep\Helpers\Helper::toNumber($toDateForm1['manufactured']['prev'] ?? null ,3)}}
            </td>
        </tr>

        <tr>
            <td colspan="7">2. ISSUANCES/CARRY-OVER</td>
        </tr>

        @if(isset($form1['issuances']) || isset($prevToDateForm1['issuances']) || isset($toDateForm1['issuances']))

            @php

                $common = array_keys(array_merge($form1['issuances'],$prevToDateForm1['issuances'] ?? []  ,  $toDateForm1['issuances']) );
                sort($common);

            @endphp

            @foreach($common as $value)
                <tr>
                    <td><span class="indent"></span> {{$value}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form1['issuances'][$value]['current'] ?? null,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['issuances'][$value]['current'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['issuances'][$value]['current'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form1['issuances'][$value]['prev'] ?? null,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['issuances'][$value]['prev'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['issuances'][$value]['prev'] ?? null ,3)}}</td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td class="text-right">TOTAL</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($form1['issuancesTotal']['current'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['issuancesTotal']['current'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['issuancesTotal']['current'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($form1['issuancesTotal']['prev'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['issuancesTotal']['prev'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['issuancesTotal']['prev'] ?? null,3)}}</td>
        </tr>

        <tr>
            <td colspan="7">3. WITHDRAWALS</td>
        </tr>

        @if(isset($form1['withdrawals']) || isset($prevToDateForm1['withdrawals']) || isset($toDateForm1['withdrawals']))
            @php
                $common = array_keys(array_merge($form1['withdrawals'],$prevToDateForm1['withdrawals'] ?? [] ,$toDateForm1['withdrawals'] ));
                sort($common);
            @endphp
            @foreach($common as $value)
                <tr>
                    <td><span class="indent"></span> {{$value}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form1['withdrawals'][$value]['current'] ?? null,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['withdrawals'][$value]['current'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['withdrawals'][$value]['current'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form1['withdrawals'][$value]['prev'] ?? null,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['withdrawals'][$value]['prev'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['withdrawals'][$value]['prev'] ?? null ,3)}}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td class="text-right">TOTAL</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($form1['withdrawalsTotal']['current'] ?? null ,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['withdrawalsTotal']['current'] ?? null ,3,'0.00')}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['withdrawalsTotal']['current'] ?? null ,3,'0.00')}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($form1['withdrawalsTotal']['prev'] ?? null ,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['withdrawalsTotal']['prev'] ?? null ,3,'0.00')}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['withdrawalsTotal']['prev'] ?? null ,3,'0.00')}}</td>
        </tr>


        <tr>
            <td colspan="7">4. BALANCE</td>
        </tr>
        @if(isset($form1['balances']) || isset($prevToDateForm1['balances']) || isset($toDateForm1['balances']))
            @php
                $common = array_keys(array_merge($form1['balances'],$prevToDateForm1['balances'] ?? [] ,$toDateForm1['balances'] ));
                sort($common);
            @endphp
            @foreach($common as $value)
                <tr>
                    <td><span class="indent"></span> {{$value}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form1['balances'][$value]['current'] ?? null,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['balances'][$value]['current'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['balances'][$value]['current'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form1['balances'][$value]['prev'] ?? null,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['balances'][$value]['prev'] ?? null ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['balances'][$value]['prev'] ?? null ,3)}}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td class="text-right">TOTAL</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($form1['balancesTotal']['current'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['balancesTotal']['current'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['balancesTotal']['current'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($form1['balancesTotal']['prev'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm1['balancesTotal']['prev'] ?? null,3)}}</td>
            <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($toDateForm1['balancesTotal']['prev'] ?? null,3)}}</td>
        </tr>

        <tr>
            <td>5. UNQUEDANNED</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['unquedanned']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['unquedanned']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['unquedanned']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['unquedanned']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['unquedanned']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['unquedanned']['prev'] ?? null, 3) }}
            </td>
        </tr>
        <tr>
            <td>6. STOCK BALANCE</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['stockBalance']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['stockBalance']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['stockBalance']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['stockBalance']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['stockBalance']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['stockBalance']['prev'] ?? null, 3) }}
            </td>
        </tr>
        <tr>
            <td>7. TRANSFERS TO REFINERY</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['transfersToRefinery']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['transfersToRefinery']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['transfersToRefinery']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['transfersToRefinery']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['transfersToRefinery']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['transfersToRefinery']['prev'] ?? null, 3) }}
            </td>
        </tr>

        <tr>
            <td>8. PHYSICAL STOCK</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['physicalStock']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['physicalStock']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['physicalStock']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['physicalStock']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['physicalStock']['prev'] ?? null, 3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['physicalStock']['prev'] ?? null, 3) }}
            </td>
        </tr>


        <tr>
            <td>9. TONS DUE CANE</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['tdc']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['tdc']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->tdc ?? null,3) }}
            </td>
            <td class="text-right">
            </td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>10. GROSS TONS CANE MILLED</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['gtcm']['current']?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['gtcm']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->gtcm ?? null,3) }}
            </td>
            <td class="text-right">
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>11. LGK/TC, GROSS	</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber(
                ($form1['tdc']['current'] ?? null ) * 20 / ($form1['gtcm']['current']?? null)
                ,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber(
                ($prevToDateForm1['tdc']['current'] ?? null) * 20 / ($prevToDateForm1['gtcm']['current'] ?? null)
                ,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber(
                ($wr->toDateForm1()->tdc) * 20 / ($wr->toDateForm1()->gtcm ?? null)
                ,3) }}
            </td>
            <td class="text-right">
            </td>
            <td></td>
            <td></td>
        </tr>

{{--        <tr>--}}
{{--            <td>11. LGK/TC, GROSS	</td>--}}
{{--            <td class="text-right">--}}
{{--                {{ \App\Swep\Helpers\Helper::toNumber($form1['lkgtc_gross']['current'] ?? null,3) }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['lkgtc_gross']['current'] ?? null,3) }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{ \App\Swep\Helpers\Helper::toNumber($form1['lkgtc_gross']['current'] ?? null ,3) }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--            </td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--        </tr>--}}

        <tr>
            <td>12. A. PLANTER'S SHARE	</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->share_planter ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['share_planter']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->share_planter ?? null,3) }}
            </td>
            <td class="text-right">
            </td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>12. B. MILLER'S SHARE	</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->share_miller ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['share_miller']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->share_miller ?? null,3) }}
            </td>
            <td class="text-right">
            </td>
            <td></td>
            <td></td>
        </tr>

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
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_A ?? 0,2) }}
            </td>
            <td>C1:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_C1,2) }}
            </td>
            <td>DE:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_DE,2) }}
            </td>
            <td>RAW:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->wholesale_raw,2) }}
            </td>
            <td>RAW:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->retail_raw,2) }}
            </td>
        </tr>

        <tr>
            <td><span class="indent"></span>B:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_B,2) }}
            </td>
            <td>D:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_D,2) }}
            </td>
            <td>DR:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_DR,2) }}
            </td>
            <td>REFINED:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->wholesale_refined,2) }}
            </td>
            <td>REFINED:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->retail_refined,2) }}
            </td>
        </tr>

        <tr>
            <td>14. Sugar Distribution Factor: </td>
            <td colspan="9">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->dist_factor,10) }}
            </td>
        </tr>
        <tr>
            <td>15. Remarks: </td>
            <td colspan="9">
                {{ $wr->form1->remarks }}
            </td>
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