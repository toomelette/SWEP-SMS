<div id="form2" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 3'])
    <h4 class="no-margin"><b>WEEKLY REPORT ON MOLASSES</b></h4>
    <i>Figures in Metric Tons </i>

    <table class="table-bordered " style="width: 100%">
        <thead>
        <tr >
            <th rowspan="2"></th>
            <th colspan="3" class="text-center" style="width: 35%;">CURRENT CROP</th>
            <th colspan="3" class="text-center" style="width: 35%;">PREVIOUS CROP</th>
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
                <td colspan="7" class="text-strong">1. PRODUCTION</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 1.1 Manufactured, Raw</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['production']['manufacturedRaw']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['production']['manufacturedRaw']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['production']['manufacturedRaw']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['production']['manufacturedRaw']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['production']['manufacturedRaw']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['production']['manufacturedRaw']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 1.2 Retention, Adjustment, Overages, etc.</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['production']['rao']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['production']['rao']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['production']['rao']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['production']['rao']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['production']['rao']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['production']['rao']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 1.3 Manufactured, Refined</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['production']['manufacturedRefined']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['production']['manufacturedRefined']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['production']['manufacturedRefined']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['production']['manufacturedRefined']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['production']['manufacturedRefined']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['production']['manufacturedRefined']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 1.4  Retention, Adjustment, Overages, etc., Refined</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['production']['raoRefined']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['production']['raoRefined']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['production']['raoRefined']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['production']['raoRefined']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['production']['raoRefined']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['production']['raoRefined']['prev'] ?? null, 3)}}</td>
            </tr>

            <tr class="tr-strong">
                <td class="text-right"> TOTAL</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['totalProduction']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['totalProduction']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['totalProduction']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['totalProduction']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['totalProduction']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['totalProduction']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr>
                <td colspan="7" class="text-strong">2. ISSUANCES/CARRY-OVER</td>
            </tr>

            <tr>
                <td><span class="indent"></span> 2.1 Planters Share</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['issuances']['sharePlanter']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['issuances']['sharePlanter']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['issuances']['sharePlanter']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['issuances']['sharePlanter']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['issuances']['sharePlanter']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['issuances']['sharePlanter']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 2.2 Mill Share</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['issuances']['shareMiller']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['issuances']['shareMiller']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['issuances']['shareMiller']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['issuances']['shareMiller']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['issuances']['shareMiller']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['issuances']['shareMiller']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 2.3 Refinery Molasses</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['issuances']['refineryMolasses']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['issuances']['refineryMolasses']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['issuances']['refineryMolasses']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['issuances']['refineryMolasses']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['issuances']['refineryMolasses']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['issuances']['refineryMolasses']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr class="tr-strong">
                <td class="text-right"> TOTAL</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['totalIssuances']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['totalIssuances']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['totalIssuances']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['totalIssuances']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['totalIssuances']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['totalIssuances']['prev'] ?? null, 3)}}</td>
            </tr>


            <tr>
                <td colspan="7" class="text-strong">3. WITHDRAWALS</td>
            </tr>
            <tr>
                <td colspan="7"><span class="indent"></span> RAW:</td>
            </tr>
            @if(!empty($form3['withdrawalsRaw']) || !empty($prevToDateForm3['withdrawalsRaw']) || !empty($toDateForm3['withdrawalsRaw']))
                @php
                    $common = array_merge($form3['withdrawalsRaw'] ?? [], $prevToDateForm3['withdrawalsRaw'] ?? [], $toDateForm3['withdrawalsRaw'] ?? []);
                    ksort($common);
                @endphp
                @foreach($common as $k => $val)
                    <tr>
                        <td><span class="indent"></span> <span class="indent"></span> {{$k}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['withdrawalsRaw'][$k]['current'] ?? null ,3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['withdrawalsRaw'][$k]['current'] ?? null ,3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['withdrawalsRaw'][$k]['current'] ?? null, 3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['withdrawalsRaw'][$k]['prev'] ?? null ,3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['withdrawalsRaw'][$k]['prev'] ?? null ,3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['withdrawalsRaw'][$k]['prev'] ?? null, 3)}}</td>
                    </tr>
                @endforeach
            @endif

            <tr>
                <td colspan="7"><span class="indent"></span> REFINED:</td>
            </tr>
            @if(!empty($form3['withdrawalsRefined']) || !empty($prevToDateForm3['withdrawalsRefined']) || !empty($toDateForm3['withdrawalsRefined']))
                @php
                    $common = array_merge($form3['withdrawalsRefined'] ?? [], $prevToDateForm3['withdrawalsRefined'] ?? [], $toDateForm3['withdrawalsRefined'] ?? []);
                    ksort($common);
                @endphp
                @foreach($common as $k => $val)
                    <tr>
                        <td><span class="indent"></span> <span class="indent"></span> {{$k}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['withdrawalsRefined'][$k]['current'] ?? null ,3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['withdrawalsRefined'][$k]['current'] ?? null ,3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['withdrawalsRefined'][$k]['current'] ?? null, 3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['withdrawalsRefined'][$k]['prev'] ?? null ,3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['withdrawalsRefined'][$k]['prev'] ?? null ,3)}}</td>
                        <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['withdrawalsRefined'][$k]['prev'] ?? null, 3)}}</td>
                    </tr>
                @endforeach
            @endif

            <tr class="tr-strong">
                <td class="text-right"> TOTAL WITHDRAWALS</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['totalWithdrawals']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['totalWithdrawals']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['totalWithdrawals']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['totalWithdrawals']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['totalWithdrawals']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['totalWithdrawals']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr>
                <td colspan="7" class="text-strong">4. BALANCE</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 4.1 Raw</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['balanceRaw']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['balanceRaw']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['balanceRaw']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['balanceRaw']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['balanceRaw']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['balanceRaw']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr>
                <td><span class="indent"></span> 4.1 Refined</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['balanceRefined']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['balanceRefined']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['balanceRefined']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['balanceRefined']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['balanceRefined']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['balanceRefined']['prev'] ?? null, 3)}}</td>
            </tr>
            <tr class="tr-strong">
                <td class="text-right"> TOTAL BALANCES</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['totalBalance']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['totalBalance']['current'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['totalBalance']['current'] ?? null, 3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3['totalBalance']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3['totalBalance']['prev'] ?? null ,3)}}</td>
                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3['totalBalance']['prev'] ?? null, 3)}}</td>
            </tr>
        </tbody>
    </table>
    <table class="table-bordered " style="width: 100%">
        <tr>
            <td colspan="4" class="text-strong">5. Molasses Price (Php/MT)</td>
        </tr>
        <tr>
            <td>5.1 Raw</td>
            <td class="text-right">{{ !empty($wr->form3) ?  number_format($wr->form3->priceRaw,2) : null}}</td>
            <td>5.2 Refined</td>
            <td class="text-right">{{ !empty($wr->form3) ? number_format($wr->form3->priceRefined,2) : null}}</td>
        </tr>

        <tr>
            <td>5.1 Raw</td>
            <td>{{ $wr->form3->storageCertRaw ?? null}}</td>
            <td>5.2 Refined</td>
            <td>{{$wr->form3->storageCertRefined ?? null}}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-strong">6. Molasses Storage Certificates:</td>
        </tr>


        @if(!empty($details_arr['MOLASSES']['seriesNos']['RAW']))
            <td colspan="2">
                <span class="text-strong">RAW :</span>
                @foreach($details_arr['MOLASSES']['seriesNos']['RAW'] as $sn)
                {{$sn->seriesFrom}} - {{$sn->seriesTo}} ({{$sn->noOfPcs}}) pcs,
                @endforeach
            </td>
        @else
            <td colspan="2">
                <span class="text-strong">RAW :</span>
            </td>
        @endif

        @if(!empty($details_arr['MOLASSES']['seriesNos']['REFINED']))
            <td colspan="2">
                <span class="text-strong">REFINED :</span>
                @foreach($details_arr['MOLASSES']['seriesNos']['REFINED'] as $sn)
                    {{$sn->seriesFrom}} - {{$sn->seriesTo}} ({{$sn->noOfPcs}}) pcs,
                @endforeach
            </td>
        @else
            <td colspan="2">
                <span class="text-strong">REFINED :</span>
            </td>
        @endif

        <tr>
            <td colspan="2">
                7. Molasses Distribution Factor:
            </td>
            <td colspan="2">
                {{$wr->form3->distFactor ?? null}}
            </td>
        </tr>
        <tr>
            <td>Remarks:</td>
            <td colspan="3">{{$wr->form3->remarks ?? null}}</td>
        </tr>
    </table>
    <br>
    <p class="text-strong">DETAILS OF MOLASSES WITHDRAWALS</p>
    @php
        $withdrawalsArr = [];
        if(!empty($wr->form3Withdrawals)){
            foreach ( $wr->form3Withdrawals as $withdrawal ){
                $withdrawalsArr[$withdrawal->sugar_type][$withdrawal->slug] = $withdrawal;
            }
        }
    @endphp
    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>MRO#</th>
                <th>TRADER/OWNER</th>
                <th>QUANTITY</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($withdrawalsArr))
                @foreach($withdrawalsArr as $sugarType => $withdrawals)
                    @php
                        $totals[$sugarType] = 0;
                    @endphp
                    <tr>
                        <td colspan="4" class="text-strong">{{$sugarType}}:</td>
                    </tr>
                    @if(!empty($withdrawals))
                        @foreach($withdrawals as $withdrawal)
                            @php
                                $totals[$sugarType] = $totals[$sugarType] + $withdrawal->qty;
                            @endphp
                            <tr>
                                <td>{{Carbon::parse($withdrawal->date)->format('m/d/Y')}}</td>
                                <td>{{$withdrawal->mro_no}}</td>
                                <td>{{$withdrawal->trader}}</td>
                                <td class="text-right">{{$withdrawal->qty}}</td>
                            </tr>
                        @endforeach
                    @endif
                    <tr>
                        <td class="text-right" colspan="3"> TOTAL {{$sugarType}}:</td>
                        <td class="text-strong text-right"><i>{{number_format($totals[$sugarType],3)}}</i> </td>
                    </tr>
                @endforeach
                    <tr>
                        <td class="text-right text-strong" colspan="3"> TOTAL:</td>
                        <td class="text-strong text-right">{{number_format(array_sum($totals),3)}} </td>
                    </tr>
            @endif
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
                <u>{{$signatories['form3']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form3']['sign2']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form3']['sign3']['name'] ?? null}}</u>
            </td>
        </tr>
        <tr >
            <td>
                {{$signatories['form3']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form3']['sign2']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form3']['sign3']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>