<table class="table table-bordered" id="form1PreviewTable" style="transition: background-color 0.2s linear;">
    <thead>
    <tr>
        <th></th>
        <th>Current Crop</th>
        <th>Previous Crop</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-strong" colspan="3">6. PRODUCTION/CARRY-OVER</td>
        </tr>
        <tr>
            <td class="text-strong"><span class="indent"></span> 6.1. DOMESTIC </td>
            <td class="text-right">{{$form2Array['production']['domestic']['current']}}</td>
            <td class="text-right">{{$form2Array['production']['domestic']['prev']}}</td>
        </tr>
        <tr>
            <td class="text-strong"><span class="indent"></span> 6.2. IMPORTED </td>
            <td class="text-right">{{$form2Array['production']['imported']['current']}}</td>
            <td class="text-right">{{$form2Array['production']['imported']['prev']}}</td>
        </tr>
        <tr>
            <td class="text-strong text-right"> <i>TOTAL REFINED</i> </td>
            <td class="text-right">{{$form2Array['production']['totalProduction']['current']}}</td>
            <td class="text-right">{{$form2Array['production']['totalProduction']['prev']}}</td>
        </tr>
        <tr>
            <td class="text-strong"><span class="indent"></span> 6.3. RETURN TO PROCESS </td>
            <td class="text-right">{{$form2Array['production']['returnToProcess']['current']}}</td>
            <td class="text-right">{{$form2Array['production']['returnToProcess']['prev']}}</td>
        </tr>
        <tr>
            <td class="text-strong text-right"> PRODUCTION NET </td>
            <td class="text-right">{{$form2Array['production']['totalProduction']['current'] + $form2Array['production']['totalProduction']['current']}}</td>
            <td class="text-right">{{$form2Array['production']['totalProduction']['prev'] + $form2Array['production']['totalProduction']['prev']}}</td>
        </tr>

        <tr>
            <td class="text-strong" colspan="3">7. ISSUANCES</td>
        </tr>
        @php $num = 0; @endphp
        @foreach($form2Array['issuances'] as $issuanceName => $values)
            @php $num++; @endphp
            @if($issuanceName != 'total')
                <tr>
                    <td class="text-strong"><span class="indent"></span>7.{{$num}}. {{strtoupper($issuanceName)}} </td>
                    <td class="text-right">{{$values['current']}}</td>
                    <td class="text-right">{{$values['prev']}}</td>
                </tr>
            @endif
        @endforeach

        <tr>
            <td class="text-strong" colspan="3">8. WITHDRAWALS</td>
        </tr>
        @php $num = 0; @endphp
        @foreach($form2Array['withdrawals'] as $wName => $values)
            @php $num++; @endphp
            @if($wName != 'total')
                <tr>
                    <td class="text-strong"><span class="indent"></span>7.{{$num}}. {{strtoupper($wName)}} </td>
                    <td class="text-right">{{$values['current']}}</td>
                    <td class="text-right">{{$values['prev']}}</td>
                </tr>
            @endif
        @endforeach

        <tr>
            <td class="text-strong">9. STOCK BALANCE </td>
            <td class="text-right">{{$form2Array['stockBalance']['current']}}</td>
            <td class="text-right">{{$form2Array['stockBalance']['prev']}}</td>
        </tr>
        <tr>
            <td class="text-strong">10. UNQUEDANNED </td>
            <td class="text-right">{{$form2Array['unquedanned']['current']}}</td>
            <td class="text-right">{{$form2Array['unquedanned']['prev']}}</td>
        </tr>
        <tr>
            <td class="text-strong">11. STOCK ON HAND </td>
            <td class="text-right">{{$form2Array['stockOnHand']['current']}}</td>
            <td class="text-right">{{$form2Array['stockOnHand']['prev']}}</td>
        </tr>

    </tbody>
</table>