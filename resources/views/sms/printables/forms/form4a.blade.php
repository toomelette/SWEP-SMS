<div id="form4a" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 4A'])

    <h4 class="no-margin"><b>MILLSITE AND SUBSIDIARY WAREHOUSE INVENTORY REPORT - REFINED</b></h4>
    <p class="no-margin"><i>(Figures in 50kg bags)</i></p>

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
            <td>1. Carry-Over</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['carryOver']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['carryOver']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['carryOver']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['carryOver']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['carryOver']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['carryOver']['prev'] ?? null,2)}}</td>
        </tr>
        <tr>
            <td>2. Receipts</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['receipts']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['receipts']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['receipts']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['receipts']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['receipts']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['receipts']['prev'] ?? null,2)}}</td>
        </tr>
        <tr>
            <td>3. Withdrawals</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['withdrawals']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['withdrawals']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['withdrawals']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['withdrawals']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['withdrawals']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['withdrawals']['prev'] ?? null,2)}}</td>
        </tr>
        <tr>
            <td>4. Transfers to ...</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['transferToRefinery']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['transferToRefinery']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['transferToRefinery']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['transferToRefinery']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['transferToRefinery']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['transferToRefinery']['prev'] ?? null,2)}}</td>
        </tr>
        <tr>
            <td colspan="7"><br></td>
        </tr>
        @if(count($form4a['subsidiaries']) > 0)
            @foreach($form4a['subsidiaries'] as $key => $subs)
                <tr>
                    <td colspan="7" class="text-strong">2.{{$loop->iteration}} {{\App\Swep\Helpers\Arrays::subsidiaryItems()[$key]}}</td>
                </tr>
                @php($total['current'] = 0)
                @php($total['prev'] = 0)
                @if(count($subs) > 0)
                    @foreach($subs as $alias => $sub)
                        @if($sub['obj']->for == 'REFINED' )
                            @php($total['current'] = $total['current'] + ($sub['current'] ?? 0))
                            @php($total['prev'] = $total['prev'] + ($sub['prev'] ?? 0))
                            <tr>
                                <td><span class="indent"></span> {{$sub['obj']->name ?? null}} ({{$alias}})</td>
                                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($sub['current'] ?? null,2)}}</td>
                                <td></td>
                                <td></td>
                                <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($sub['prev'] ?? null,2)}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td class="text-right text-strong">TOTAL</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total['current'],2)}}</td>
                        <td></td>
                        <td></td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total['prev'],2)}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            @endforeach
        @endif
        </tbody>
    </table>
    <table class="sign-table cols-3">
        <tr>
            <td>Certified:</td>
            <td>Verified:</td>
        </tr>

        <tr >
            <td>
                <u>{{$signatories['form4a']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form4a']['sign2']['name'] ?? null}}</u>
            </td>

        </tr>
        <tr >
            <td>
                {{$signatories['form4a']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form4a']['sign2']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>