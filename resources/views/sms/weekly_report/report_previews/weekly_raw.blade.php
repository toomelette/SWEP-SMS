@extends('layouts.modal-content')

@section('modal-header')

@endsection

@section('modal-body')
    <div class="row">
        <div class="col-md-3">
            <dl class="no-margin">
                <dt>Crop Year:</dt>
                <dd>{{$request->crop_year}}</dd>
            </dl>
        </div>
        <div class="col-md-3">
            <dl class="no-margin">
                <dt>Week ending:</dt>
                <dd>{{Carbon::parse($request->week_ending)->format('F d, Y')}}</dd>
            </dl>
        </div>

        <div class="col-md-3">
            <dl class="no-margin">
                <dt>Report No.:</dt>
                <dd>{{$request->report_no}}</dd>
            </dl>
        </div>
        <div class="col-md-3">
            <dl class="no-margin">
                <dt>Distribution No.:</dt>
                <dd>{{$request->distribution_no}}</dd>
            </dl>
        </div>
    </div>
    <table class="table table-bordered table-condensed">
        <thead>
        <tr>
            <th rowspan="2"></th>
            <th colspan="3">Current Crop</th>
            <th colspan="3">Previous Crop</th>
        </tr>
        <tr>
            <th>This Week</th>
            <th>Previous</th>
            <th>To Date</th>
            <th>This Week</th>
            <th>Previous</th>
            <th>To Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1 .MANUFACTURED</td>
            <td for="manufactured">{{$request->manufactured}}</td>
            <td></td>
            <td></td>
            <td for=""></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="7">2. ISSUANCES/CARRY-OVER</td>
        </tr>
        @php($raw_sugar_issuances = 0)
        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_issuances') as $field)
            @php($fld = $field->field)
            @if($request->$fld != '')
                @php($raw_sugar_issuances = $raw_sugar_issuances + \App\Swep\Helpers\Helper::sanitizeAutonum($request->$fld))
            @endif
            <tr>
                <td class="indent">{{$field->display_name}}</td>
                <td for="issuance_a" class="text-right"> {{($request->$fld != '') ?  number_format(\App\Swep\Helpers\Helper::sanitizeAutonum($request->$fld),3) : ''}}</td>
                <td></td>
                <td></td>
                <td for=""></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td class="indent">TOTAL</td>
            <td class="text-right">{{number_format($raw_sugar_issuances,3)}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td colspan="7">3. WITHDRAWALS</td>
        </tr>

        @php($raw_sugar_withdrawals = 0)
        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_withdrawals') as $field)
            @php($fld = $field->field)
            @if($request->$fld != '')
                @php($raw_sugar_withdrawals = $raw_sugar_withdrawals + \App\Swep\Helpers\Helper::sanitizeAutonum($request->$fld))
            @endif
            <tr>
                <td class="indent">{{$field->display_name}}</td>
                <td for="issuance_a" class="text-right"> {{($request->$fld != '') ?  number_format(\App\Swep\Helpers\Helper::sanitizeAutonum($request->$fld),3) : ''}}</td>
                <td></td>
                <td></td>
                <td for=""></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td class="indent">TOTAL</td>
            <td class="text-right">{{number_format($raw_sugar_withdrawals,3)}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>


        <tr>
            <td colspan="7">4. BALANCE</td>
        </tr>

        @php($raw_sugar_balance = 0)
        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_balance') as $field)
            @php($fld = $field->field)
            @if($request->$fld != '')
                @php($raw_sugar_balance = $raw_sugar_balance + \App\Swep\Helpers\Helper::sanitizeAutonum($request->$fld))
            @endif
            <tr>
                <td class="indent">{{$field->display_name}}</td>
                <td for="issuance_a" class="text-right"> {{($request->$fld != '') ?  number_format(\App\Swep\Helpers\Helper::sanitizeAutonum($request->$fld),3) : ''}}</td>
                <td></td>
                <td></td>
                <td for=""></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td class="indent">TOTAL BALANCES</td>
            <td class="text-right">{{number_format($raw_sugar_balance,3)}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        @php($raw_sugar_5_to_11 = 0)
        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_5_to_11') as $field)
            @php($fld = $field->field)
            @if($request->$fld != '')
                @php($raw_sugar_5_to_11 = $raw_sugar_5_to_11 + \App\Swep\Helpers\Helper::sanitizeAutonum($request->$fld))
            @endif
            <tr>
                <td>{{$field->prefix}} {{$field->display_name}}</td>

                <td for="issuance_a" class="text-right"> {{($request->$fld != '') ?  number_format(\App\Swep\Helpers\Helper::sanitizeAutonum($request->$fld),3) : ''}}</td>
                <td></td>
                <td></td>
                <td for=""></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach


        </tbody>
    </table>
@endsection

@section('modal-footer')

@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection

