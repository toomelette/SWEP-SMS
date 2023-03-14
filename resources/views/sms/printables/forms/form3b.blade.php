<div id="form3b" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 3B'])
    @php
        $totals = [
            'issuanceTotal' => 0,
            'withdrawalsTotal' => 0,
            'qtyStandard' => 0,
            'qtyPremium' => 0,
        ];
    @endphp
    <h4 class="no-margin"><b>MOLASSES RELEASE ORDER AND DELIVERY REPORT</b> </h4>
    <p class="no-margin"><i>(Figures in Metric Tons)</i></p>

    <p class="text-left">A. Issuances of MRO</p>

    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th>MRO No.</th>
            <th>Trader/Owner</th>
            <th>Date of Issue</th>
            <th>Liens OR #</th>
            <th>Qty (MT)</th>

        </tr>
        </thead>
        <tbody>
        @if(!empty($wr->form3bIssuancesOfMro))
            @foreach($wr->form3bIssuancesOfMro as $form3bIssuancesOfMro)
                @php
                    $totals['issuanceTotal'] = $totals['issuanceTotal'] + ($form3bIssuancesOfMro->qty ?? 0);
                @endphp
                <tr>
                    <td>{{$form3bIssuancesOfMro->mro_no}}</td>
                    <td>{{$form3bIssuancesOfMro->trader}}</td>
                    <td>{{\Illuminate\Support\Carbon::parse($form3bIssuancesOfMro->date_of_issue)->format('m/d/Y')}}</td>
                    <td>{{$form3bIssuancesOfMro->liens_or}}</td>
                    <td class="text-right">{{$form3bIssuancesOfMro->qty}}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="4" class="text-strong">TOTAL</td>
            <td class="text-right text-strong">{{number_format( $totals['issuanceTotal'] , 3)}}</td>
        </tr>
        </tbody>
    </table>

    <br>
    <p class="text-left">B. Delivery</p>

    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th>MRO No.</th>
            <th>Date of Withdrawal</th>
            <th>Trader/Tollee</th>
            <th>Qty</th>
            <th>Remarks</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($wr->form3bDeliveries))
            @foreach($wr->form3bDeliveries as $form3bDeliveries)
                @php
                    $totals['withdrawalsTotal'] = $totals['withdrawalsTotal'] + ($form3bDeliveries->qty ?? 0);
                @endphp
                <tr>
                    <td>{{$form3bDeliveries->mro_no}}</td>
                    <td>{{\Illuminate\Support\Carbon::parse($form3bDeliveries->date)->format('m/d/Y')}}</td>
                    <td>{{$form3bDeliveries->trader}}</td>
                    <td class="text-right">{{number_format($form3bDeliveries->qty,3) ?? null}}</td>
                    <td>{{$form3bDeliveries->remarks}}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="3" class="text-strong">TOTAL</td>
            <td class="text-right text-strong">{{ number_format( $totals['withdrawalsTotal'] ,3) }}</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <br>
    <p class="text-left">C. Served MRO <i>(To be transmitted to SRA with Permit Portion, Ledger of withdrawals & Listing*)</i></p>
    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th>MRO</th>
            <th>Trader/Tollee</th>
            <th>No. of Pcs of Quedan</th>
        </tr>
        </thead>
        @if(!empty($wr->form3bServedMros))
            @foreach($wr->form3bServedMros as $form3bServedMros)
                <tr>
                    <td>{{$form3bServedMros->mro_no}}</td>
                    <td>{{$form3bServedMros->trader}}</td>
                    <td>{{$form3bServedMros->pcs}}</td>
                </tr>
            @endforeach
        @endif
    </table>
    <table class="sign-table cols-3">
        <tr>
            <td>Certified (Mill Representative):</td>
            <td>Verified (Planter's Representative):</td>
            <td>Verified (SRA Representative):</td>
        </tr>
        <tr >
            <td>
                <u>{{$signatories['form3b']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form3b']['sign2']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form3b']['sign3']['name'] ?? null}}</u>
            </td>
        </tr>
        <tr >
            <td>
                {{$signatories['form3b']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form3b']['sign2']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form3b']['sign3']['position'] ?? null}}
            </td>

        </tr>
    </table>
</div>