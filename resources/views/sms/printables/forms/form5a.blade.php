<div id="form5a" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 5A'])

    <h4 class="no-margin"><b>SUGAR RELEASE ORDER AND DELIVERY REPORT - REFINED</b> </h4>
    <p class="no-margin"><i>(Figures in 50-Kg Bags)</i></p>

    <p class="text-left">A. Issuances of Refined Sugar Release Order</p>

    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th>Date of Issue</th>
            <th>Ref. SRO S.N.</th>
            <th>Trader/Tollee</th>
            <th>Raw Qty.</th>
            <th>Monitoring Fee OR #</th>
            <th>RSQ No.</th>
            <th>Refined Qty.</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($wr->form5aIssuancesOfSro))
            @foreach($wr->form5aIssuancesOfSro as $form5aIssuancesOfSro)
                <tr>
                    <td>{{\Illuminate\Support\Carbon::parse($form5aIssuancesOfSro->date_of_issue)->format('m/d/Y')}}</td>
                    <td>{{$form5aIssuancesOfSro->sro_no}}</td>
                    <td>{{$form5aIssuancesOfSro->trader}}</td>
                    <td>{{$form5aIssuancesOfSro->raw_qty}}</td>
                    <td>{{$form5aIssuancesOfSro->monitoring_fee_or_no}}</td>
                    <td>{{$form5aIssuancesOfSro->rsq_no}}</td>
                    <td class="text-right">{{!empty($form5aIssuancesOfSro->refined_qty) ? number_format($form5aIssuancesOfSro->refined_qty,2) : null}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <br>
    <p class="text-left">B. Delivery</p>

    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th>Date of Withdrawal</th>
            <th>Ref. SRO S.N.</th>
            <th>Trader/Tollee</th>
            <th>Qty. Standard</th>
            <th>Qty. Premium</th>
            <th>Total</th>
            <th>Remarks</th>
        </tr>
        @if(!empty($wr->form5aDeliveries))
            @foreach($wr->form5aDeliveries as $form5aDeliveries)
                <tr>
                    <td>{{\Illuminate\Support\Carbon::parse($form5aDeliveries->date_of_withdrawal)->format('m/d/Y')}}</td>
                    <td>{{$form5aDeliveries->sro_no}}</td>
                    <td>{{$form5aDeliveries->trader}}</td>
                    <td class="text-right">{{!empty($form5aDeliveries->qty_standard) ? number_format($form5aDeliveries->qty_standard,2) : null}}</td>
                    <td class="text-right">{{!empty($form5aDeliveries->qty_premium) ? number_format($form5aDeliveries->qty_premium,2) : null}}</td>
                    <td class="text-right">{{!empty($form5aDeliveries->qty_total) ? number_format($form5aDeliveries->qty_total,2) : null}}</td>
                    <td>{{$form5aDeliveries->remarks}}</td>
                </tr>
            @endforeach
        @endif
        </thead>
    </table>

    <br>
    <p class="text-left">C. Served Refined SRO <i>(To be transmitted to SRA with Permit Portion)</i></p>
    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th>Ref. SRO S.N.</th>
            <th>Trader/Tollee</th>
            <th>No. of Pcs of Quedan</th>
        </tr>
        </thead>
        @if(!empty($wr->form5aServedSros))
            @foreach($wr->form5aServedSros as $form5aServedSros)
                <tr>
                    <td>{{$form5aServedSros->sro_no}}</td>
                    <td>{{$form5aServedSros->trader}}</td>
                    <td>{{$form5aServedSros->quedan_pcs}}</td>
                </tr>
            @endforeach
        @endif
    </table>
    <table class="sign-table cols-2">
        <tr>
            <td>Certified: (Refinery Representative):</td>
            <td>Verified: (SRA Representative)</td>
        </tr>
        <tr >
            <td>
                <u>{{$signatories['form5a']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form5a']['sign2']['name'] ?? null}}</u>
            </td>

        </tr>
        <tr >
            <td>
                {{$signatories['form5a']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form5a']['sign2']['position'] ?? null}}
            </td>

        </tr>
    </table>
</div>