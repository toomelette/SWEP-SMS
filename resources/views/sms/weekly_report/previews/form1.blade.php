<table class="table table-bordered preview-table" id="form1PreviewTable" style="transition: background-color 0.2s linear;">
    <thead>
    <tr>
        <th></th>
        <th>Current Crop</th>
        <th>Previous Crop</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-strong">1. MANUFACTURED</td>
        <td class="text-right text-strong">{{$formArray['manufactured']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['manufactured']['prev']}}</td>
    </tr>
    <tr>
        <td class="text-strong" colspan="4">2. ISSUANCES/CARRY-OVER</td>
    </tr>
    @foreach($formArray['issuances']['values'] as  $key => $value)
        @if(!empty($value['current']) || !empty($value['prev']))
            <tr>
                <td><span class="indent"></span><span class="indent"></span> {{$key}}</td>
                <td class="text-right">{{$value['current']}}</td>
                <td class="text-right">{{$value['prev']}}</td>
            </tr>
        @endif
    @endforeach
    <tr>
        <td class="text-right text-strong">TOTAL ISSUANCES</td>
        <td class="text-right text-strong">{{$formArray['issuances']['total']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['issuances']['total']['prev']}}</td>
    </tr>


    <tr>
        <td class="text-strong" colspan="4">3. WITHDRAWALS</td>
    </tr>
    <tr>
        <td class="text-strong" colspan="4"><span class="indent"></span> <i>3.1 Export/Domestic/World</i></td>
    </tr>
    @foreach($formArray['withdrawals']['values'] as  $key => $value)
        @if(!empty($value['current']) || !empty($value['prev']))
            <tr>
                <td><span class="indent"></span><span class="indent"></span> {{$key}}</td>
                <td class="text-right">{{$value['current']}}</td>
                <td class="text-right">{{$value['prev']}}</td>
            </tr>
        @endif
    @endforeach

    <tr>
        <td class="text-right text-strong">SUBTOTAL</td>
        <td class="text-right text-strong">{{$formArray['withdrawals']['total']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['withdrawals']['total']['prev']}}</td>
    </tr>



    <tr>
        <td class="text-strong" colspan="4"><span class="indent"></span> <i>3.2 For Refining</i></td>
    </tr>

    @foreach($formArray['forRefining']['values'] as  $key => $value)
        @if(!empty($value['current']) || !empty($value['prev']))
            <tr>
                <td><span class="indent"></span><span class="indent"></span> {{$key}}</td>
                <td class="text-right">{{$value['current']}}</td>
                <td class="text-right">{{$value['prev']}}</td>
            </tr>
        @endif
    @endforeach
    <tr>
        <td class="text-right text-strong">SUBTOTAL</td>
        <td class="text-right text-strong">{{$formArray['forRefining']['total']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['forRefining']['total']['prev']}}</td>
    </tr>
    <tr>
        <td class="text-right text-strong">TOTAL WITHDRAWALS</td>
        <td class="text-right text-strong">{{$formArray['withdrawals']['total']['current'] + $formArray['forRefining']['total']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['withdrawals']['total']['prev'] + $formArray['forRefining']['total']['prev']}}</td>
    </tr>


    <tr>
        <td class="text-strong">4. BALANCE</td>
    </tr>
    @foreach($formArray['balances']['values'] as  $key => $value)
        @if(!empty($value['current']) || !empty($value['prev']))
            <tr>
                <td><span class="indent"></span> {{$key}}</td>
                <td class="text-right">{{$value['current']}}</td>
                <td class="text-right">{{$value['prev']}}</td>
            </tr>
        @endif
    @endforeach
    <tr>
        <td class="text-right text-strong">TOTAL BALANCE</td>
        <td class="text-right text-strong">{{$formArray['balances']['total']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['balances']['total']['prev']}}</td>
    </tr>

    <tr>
        <td class="text-strong">5. UNQUEDANNED</td>
        <td class="text-right text-strong">{{$formArray['unquedanned']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['unquedanned']['prev']}}</td>
    </tr>
    <tr>
        <td class="text-strong">6. STOCK BALANCE</td>
        <td class="text-right text-strong">{{$formArray['stockBalance']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['stockBalance']['prev']}}</td>
    </tr>

    <tr>
        <td class="text-strong">7. TRANSFERS TO REFINERY</td>
        <td class="text-right text-strong">{{$formArray['transfersToRefinery']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['transfersToRefinery']['prev']}}</td>
    </tr>

    <tr>
        <td class="text-strong">8. PHYSICAL STOCK</td>
        <td class="text-right text-strong">{{$formArray['physicalStock']['current']}}</td>
        <td class="text-right text-strong">{{$formArray['physicalStock']['prev']}}</td>
    </tr>

    </tbody>
</table>