<div class="form-title" style="background-color: #4477a3;">
    <h4> QUEDAN REGISTRY
    </h4>
</div>
<div class="row">

</div>

<h4 class="text-strong">A. Raw Sugar Receipts</h4>
<table class="table table-bordered table-condensed">
    <thead>
        <tr class="bg-primary">
            <th>Delivery No.</th>
            <th>Trader/Tollee</th>
            <th>Source</th>
            <th>Raw SRO #</th>
            <th>SRA Liens OR #</th>
            <th>Qty LKG</th>
            <th>Refined Sugar Eq.</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($wr->form5aIssuancesOfSro))
            @php
                $rawTotal = 0;
                $refinedTotal = 0;
            @endphp
            @foreach($wr->form5aIssuancesOfSro as $data)
                @php
                    $rawTotal = $rawTotal + $data->raw_qty;
                    $refinedTotal = $refinedTotal + $data->refined_qty;
                @endphp
                <tr>
                    <td>{{$data->delivery_no}}</td>
                    <td>{{$data->trader}}</td>
                    <td>{{$data->source}}</td>
                    <td>{{$data->sro_no}}</td>
                    <td>{{$data->liens_or}}</td>
                    <td class="text-right">{{number_format($data->raw_qty,2)}}</td>
                    <td class="text-right">{{number_format($data->refined_qty,2)}}</td>
                </tr>
            @endforeach
            <tr class="bg-info">
                <td colspan="5" class="text-strong">TOTAL</td>
                <td class="text-right text-strong">{{number_format($rawTotal,2)}}</td>
                <td class="text-right text-strong">{{number_format($refinedTotal,2)}}</td>
            </tr>
        @endif
    </tbody>
</table>


<h4 class="text-strong">B. Quedan Registry</h4>
<table class="table table-bordered table-condensed">
    <thead>
    <tr class="bg-primary">
        <th>Delivery No.</th>
        <th>Trader/Tollee</th>
        <th>Refined Quedan SN.</th>
        <th>Refined Sugar (Lkg)</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($wr->form5aIssuancesOfSro))
        @php
            $refinedTotal = 0;
        @endphp
        @foreach($wr->form5aIssuancesOfSro as $data)
            @php
                $refinedTotal = $refinedTotal + $data->refined_qty;
            @endphp
            <tr>
                <td>{{$data->deliver_no}}</td>
                <td>{{$data->trader}}</td>
                <td>{{$data->rsq_no}}</td>
                <td class="text-right">{{number_format($data->refined_qty,2)}}</td>
            </tr>
        @endforeach
        <tr class="bg-info">
            <td colspan="3" class="text-strong">TOTAL</td>
            <td class="text-right text-strong">{{number_format($refinedTotal,2)}}</td>
        </tr>
    @endif
    </tbody>
</table>

