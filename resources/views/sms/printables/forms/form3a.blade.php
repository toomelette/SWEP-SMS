<div id="form3a" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 3A'])

    <h4 class="no-margin"><b>MILLSITE AND SUBSIDIARY WAREHOUSE INVENTORY REPORT - MOLASSES</b></h4>
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
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['carryOver']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['carryOver']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['carryOver']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['carryOver']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['carryOver']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['carryOver']['prev'] ?? null,2)}}</td>
        </tr>
        <tr>
            <td>2. Receipts</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['receipts']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['receipts']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['receipts']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['receipts']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['receipts']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['receipts']['prev'] ?? null,2)}}</td>
        </tr>
        <tr>
            <td>3. Withdrawals</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['withdrawals']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['withdrawals']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['withdrawals']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['withdrawals']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['withdrawals']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['withdrawals']['prev'] ?? null,2)}}</td>
        </tr>
        <tr>
            <td>4. Transfers to ...</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['transferToRefinery']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['transferToRefinery']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['transferToRefinery']['current'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['transferToRefinery']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['transferToRefinery']['prev'] ?? null,2)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['transferToRefinery']['prev'] ?? null,2)}}</td>
        </tr>
        <tr>
            <td colspan="7"><br></td>
        </tr>
        @if(count($form3a['subsidiaries']) > 0)
            @foreach($form3a['subsidiaries'] as $key => $subs)
                <tr>
                    <td colspan="7" class="text-strong">2.{{$loop->iteration}} {{\App\Swep\Helpers\Arrays::subsidiaryItems()[$key]}}</td>
                </tr>
                @php($total['current'] = 0)
                @php($total['prev'] = 0)
                @if(count($subs) > 0)
                    @foreach($subs as $alias => $sub)
                        @if(!empty($sub['obj']))
                            @if($sub['obj']->for == 'MOLASSES' )
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
                <u>{{$signatories['form3a']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form3a']['sign2']['name'] ?? null}}</u>
            </td>

        </tr>
        <tr >
            <td>
                {{$signatories['form3a']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form3a']['sign2']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>