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
                {{ \App\Swep\Helpers\Helper::toNumber($form2['carryOver']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['carryOver']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['carryOver']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['carryOver']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['carryOver']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['carryOver']['prev'] ?? null,3) }}
            </td>
        </tr>
        <tr>
            <td colspan="7">2. Receipts: (For Refining)</td>
        </tr>
        <tr>
            <td colspan="7"><span class="indent"></span> 2.1 From Raw Mill</td>
        </tr>
        <tr>

            <td colspan><span class="indent"></span><span class="indent"></span> 2.1.1 Covered by SRO</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['coveredBySro']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['coveredBySro']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['coveredBySro']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['coveredBySro']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['coveredBySro']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['coveredBySro']['prev'] ?? null,3) }}
            </td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span><span class="indent"></span> 2.1.2 Not Covered by SRO</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['notCoveredBySro']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['notCoveredBySro']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['notCoveredBySro']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['notCoveredBySro']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['notCoveredBySro']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['notCoveredBySro']['prev'] ?? null,3) }}
            </td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span> 2.2 Other Mills</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['otherMills']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['otherMills']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['otherMills']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['otherMills']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['otherMills']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['otherMills']['prev'] ?? null,3) }}
            </td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span> 2.3. Imported</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['imported']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['imported']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['imported']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['imported']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['imported']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['imported']['prev'] ?? null,3) }}
            </td>
        </tr>

        <tr>
            <td colspan class="text-right"><span class="indent"></span> TOTAL RECEIPTS</td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['totalReceipts']['current'] ?? null,3) }}
            </td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['totalReceipts']['current'] ?? null,3) }}
            </td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['totalReceipts']['current'] ?? null,3) }}
            </td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['totalReceipts']['prev'] ?? null,3) }}
            </td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['totalReceipts']['prev'] ?? null,3) }}
            </td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['totalReceipts']['prev'] ?? null,3) }}
            </td>
        </tr>

        <tr>
            <td> 3. MELTED</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['melted']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['melted']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['melted']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['melted']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['melted']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['melted']['prev'] ?? null,3) }}
            </td>
        </tr>
        <tr>
            <td> 4. WITHDRAWALS</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['rawWithdrawals']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['rawWithdrawals']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['rawWithdrawals']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['rawWithdrawals']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['rawWithdrawals']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['rawWithdrawals']['prev'] ?? null,3) }}
            </td>
        </tr>
        <tr>
            <td> 5. BALANCE RAW </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['rawBalance']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['rawBalance']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['rawBalance']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['rawBalance']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['rawBalance']['prev'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['rawBalance']['prev'] ?? null,3) }}
            </td>
        </tr>


        <tr>
            <td colspan="7">REFINED SUGAR</td>
        </tr>
        <tr>
            <td colspan="7">6. PRODUCTION/CARRY-OVER</td>
        </tr>

        <tr>
            <td><span class="indent"></span> 6.1 DOMESTIC</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['production']['domestic']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['production']['domestic']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['production']['domestic']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['production']['domestic']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['production']['domestic']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['production']['domestic']['prev'] ?? null,3)  }}
            </td>
        </tr>

        <tr>
            <td><span class="indent"></span> 6.2 IMPORTED</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['production']['imported']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['production']['imported']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['production']['imported']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['production']['imported']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['production']['imported']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['production']['imported']['prev'] ?? null,3)  }}
            </td>
        </tr>
        <tr>
            <td class="text-right">TOTAL REFINED</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['totalRefined']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['totalRefined']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['totalRefined']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['totalRefined']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['totalRefined']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['totalRefined']['prev'] ?? null,3)  }}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 6.3 RETURN TO PROCESS</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['production']['returnToProcess']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['production']['returnToProcess']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['production']['returnToProcess']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['production']['returnToProcess']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['production']['returnToProcess']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['production']['returnToProcess']['prev'] ?? null,3)  }}
            </td>
        </tr>
        <tr>
            <td class="text-right">PORDUCTION (NET)</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['totalProduction']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['totalProduction']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['totalProduction']['current'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['totalProduction']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['totalProduction']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['totalProduction']['prev'] ?? null,3)  }}
            </td>
        </tr>

        <tr>
            <td>7. ISSUANCES</td>
            <td class="text-right">
            <td></td>
            <td></td>
            <td class="text-right">
            <td></td>
            <td></td>
        </tr>

        @if(!empty($form2['issuances']) || !empty($prevToDateForm2['issuances']))
            @php
                $common = array_merge($form2['issuances'], $prevToDateForm2['issuances'] ?? []);
            @endphp
            @foreach($common as $k => $val)
                <tr>
                    <td><span class="indent"></span> 7.{{$loop->iteration}} {{strtoupper($k)}}</td>
                    <td class="text-right">
                        {{\App\Swep\Helpers\Helper::toNumber($form2['issuances'][$k]['current'] ?? null, 3)}}
                    </td>
                    <td class="text-right">
                        {{\App\Swep\Helpers\Helper::toNumber($prevToDateForm2['issuances'][$k]['current'] ?? null, 3)}}
                    </td>
                    <td></td>
                    <td class="text-right">
                        {{\App\Swep\Helpers\Helper::toNumber($form2['issuances'][$k]['prev'] ?? null, 3)}}
                    </td>
                    <td class="text-right">
                        {{\App\Swep\Helpers\Helper::toNumber($prevToDateForm2['issuances'][$k]['prev'] ?? null, 3)}}
                    </td>
                    <td></td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td>8. WITHDRAWALS</td>
            <td class="text-right"></td>
            <td></td>
            <td></td>
            <td class="text-right"></td>
            <td></td>
            <td></td>
        </tr>
        @if(!empty($form2['withdrawals']))
            @foreach($form2['withdrawals'] as $k => $withdrawal)
                <tr>
                    <td><span class="indent"></span> 8.{{$loop->iteration}} {{strtoupper($k)}}</td>
                    <td class="text-right">
                        {{\App\Swep\Helpers\Helper::toNumber($withdrawal['current'] ?? null, 3)}}
                    </td>
                    <td></td>
                    <td></td>
                    <td class="text-right">
                        {{\App\Swep\Helpers\Helper::toNumber($withdrawal['prev'] ?? null, 3)}}
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td>9. STOCK BALANCE</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['stockBalance']['current'] ?? null,3)  }}
            </td>
            <td></td>
            <td></td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['stockBalance']['prev'] ?? null,3)  }}
            </td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>10. UNQUEDANNED</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['unquedanned']['current'] ?? null,3)  }}
            </td>
            <td></td>
            <td></td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['unquedanned']['prev'] ?? null,3)  }}
            </td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>11. STOCK ON HAND</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['stockOnHand']['current'] ?? null,3)  }}
            </td>
            <td></td>
            <td></td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['stockOnHand']['prev'] ?? null,3)  }}
            </td>
            <td></td>
            <td></td>
        </tr>


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