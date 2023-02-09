<div id="form5" style="break-after: page">
    @php
        $sugarClasses = $wr->form5Deliveries()->groupBy('sugar_class')->get();
        $usedSugarClassesArray = ['A','B','C'];
        if(!empty($sugarClasses)){
            foreach ($sugarClasses as $sugarClass){
                if(!in_array($sugarClass->sugar_class,$usedSugarClassesArray)){
                    array_push($usedSugarClassesArray,$sugarClass->sugar_class);
                }
            }
        }

    @endphp
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 5'])
    <h4 class="no-margin"><b>SUGAR RELEASE ORDER AND DELIVERY REPORT - RAW</b> </h4>
    <p class="no-margin"><i>(Figures in 50-Kg Bags)</i></p>

    <p class="text-left">A. Issuances of SRO</p>
    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th class="text-center">SRO No.</th>
            <th class="text-center">Trader/Owner</th>
            <th class="text-center">Date of Issue</th>
            <th class="text-center">Liens OR #.</th>
            <th class="text-center">Sugar Class</th>
            <th class="text-center">Qty 50-Kg Bags</th>
        </tr>
        </thead>
        <tbody>
        @php($total = 0)
        @if(!empty($wr->form5IssuancesOfSro))
            @foreach($wr->form5IssuancesOfSro as $form5IssuancesOfSro)
                @php($total = $total + ($form5IssuancesOfSro->qty ?? 0))
                <tr>
                    <td>{{$form5IssuancesOfSro->sro_no}}</td>
                    <td>{{$form5IssuancesOfSro->trader}}</td>
                    <td class="text-center">{{Carbon::parse($form5IssuancesOfSro->date_of_issue)->format('m/d/Y')}}</td>
                    <td class="text-center">{{$form5IssuancesOfSro->liens_or}}</td>
                    <td>{{$form5IssuancesOfSro->sugar_class}}</td>
                    <td class="text-right">{{!empty($form5IssuancesOfSro->qty) ? number_format($form5IssuancesOfSro->qty,3) : null}}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="5" class="text-strong">
                TOTAL
            </td>
            <td class="text-strong text-right">
                {{number_format($total,3)}}
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <p class="text-left">B. Delivery</p>

    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th rowspan="2" class="text-center">SRO No.</th>
            <th rowspan="2" class="text-center">Trader/Owner</th>
            <th colspan="{{count($usedSugarClassesArray)}}" class="text-center">Sugar Class</th>
            <th rowspan="2" class="text-center">Remarks</th>
        </tr>
        <tr>
            @php($totals = [])
            @foreach($usedSugarClassesArray as $class)
                @php($totals[$class] = 0)
                <td class="text-center" style="width: 10%">
                    {{$class}}
                </td>
            @endforeach
        </tr>
        </thead>
        <tbody>

        @if(!empty($wr->form5Deliveries))
            @foreach($wr->form5Deliveries as $form5Deliveries)
                <tr>
                    <td>{{$form5Deliveries->sro_no}}</td>
                    <td>{{$form5Deliveries->trader}}</td>
                    @foreach($usedSugarClassesArray as $class)
                        @if($form5Deliveries->sugar_class == $class)
                            <td class="text-right">

                                @if($form5Deliveries->qty != null)
                                    @php($totals[$class] = $totals[$class] + $form5Deliveries->qty)
                                    {{number_format($form5Deliveries->qty,3)}}
                                @else
                                    @php($totals[$class] = $totals[$class] + $form5Deliveries->qty_prev)
                                    {{number_format($form5Deliveries->qty_prev,3)}}
                                @endif
                            </td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                    <td>{{($form5Deliveries->refining == 1) ? 'For Refining':''}} {{$form5Deliveries->remarks}} {{$form5Deliveries->qty_prev != null ?  'PREVIOUS' : null}}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="2"></td>
            @foreach($usedSugarClassesArray as $class)
                <td class="text-right">
                    {{number_format($totals[$class] , 3)}}
                </td>
            @endforeach
        </tr>
        </tbody>
    </table>
    <br>
    <p class="text-left">C. Served SRO <small><i>(To be transmitted to SRA with Permit Portion, Ledger of Withdrawals & Listing*)</i></small></p>
    <table  class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th>SRO No. </th>
            <th>CEAs, COCs, Letter Authority, etc. </th>
            <th>Permit Portion No. of Pcs.</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($wr->form5ServedSros))
            @foreach($wr->form5ServedSros as $form5ServedSros)
                <tr>
                    <td>{{$form5ServedSros->sro_no}}</td>
                    <td>{{$form5ServedSros->cea}}</td>
                    <td>{{$form5ServedSros->permit_portion}}</td>
                </tr>
            @endforeach
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
                <u>{{$signatories['form5']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form5']['sign2']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form5']['sign3']['name'] ?? null}}</u>
            </td>
        </tr>
        <tr >
            <td>
                {{$signatories['form5']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form5']['sign2']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form5']['sign3']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>