
<div class="form-title" style="background-color: #b3885a;">
    <h4>  MILLSITE & SUBSIDIARY WAREHOUSE INVENTORY REPORT - REFINED
    </h4>
</div>

<form id="form4a">
    <button type="submit" hidden>submit</button>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Current Crop</th>
            <th>Previous Crop</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="3" class="text-strong info">REFINERY WAREHOUSE</td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.1 Production/Carry-over</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('carryOver',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->carryOver ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_carryOver',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->prev_carryOver ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.2 Receipts</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('receipts',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->receipts ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_receipts',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->prev_receipts ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.3 Withdrawals</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('withdrawals',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->withdrawals ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_withdrawals',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->prev_withdrawals ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.4 Transfers to refinery</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('transferToRefinery',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->transferToRefinery ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transferToRefinery',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->prev_transferToRefinery ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.5 Etc</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('etc',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->etc ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_etc',[
                    'class' => 'global-form-changer form4a-input input-sm text-right autonumber_mt'
                ],
                $wr->form4a->prev_etc ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.6 Stock Balance</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong success">
                SUBSIDIARY WAREHOUSES
                <button type="button" class="btn btn-xs btn-success pull-right form4_listOfWarehousesBtn" for="REFINED" data-toggle="modal" data-target="#form4_listOfWarehousesModal"><i class="fa fa-list"></i> List of Subsidiary Warehouses</button>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.1 Carry Over
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="carryOver" sugarType="REFINED" before="form4aCarryOverTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['REFINED']['carryOver']))
            @foreach($subsidiaries['REFINED']['carryOver'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'carryOver',
                    'data' => $raw,
                    'sugarType' => 'REFINED',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif

        <tr for="carryOver" class="computation form4aCarryOverTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>


        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.2 Receipts
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="receipts"  sugarType="REFINED" before="form4aReceiptsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['REFINED']['receipts']))
            @foreach($subsidiaries['REFINED']['receipts'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'receipts',
                    'data' => $raw,
                    'sugarType' => 'REFINED',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="receipts" class="computation form4aReceiptsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.3 Withdrawals
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="withdrawals" sugarType="REFINED"  before="form4aWithdrawalsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['REFINED']['withdrawals']))
            @foreach($subsidiaries['REFINED']['withdrawals'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'withdrawals',
                    'data' => $raw,
                    'sugarType' => 'REFINED',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="withdrawals" class="computation form4aWithdrawalsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>
        </tbody>
    </table>
</form>


