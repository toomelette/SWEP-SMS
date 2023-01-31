

<div class="form-title" style="background-color: #6c565a;">
    <h4>  MILLSITE & SUBSIDIARY WAREHOUSE INVENTORY REPORT - RAW
    </h4>
</div>
<form id="form4">
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
            <td colspan="3" class="text-strong info">MILL WAREHOUSE</td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.1 Production/Carry-over</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('carryOver',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->carryOver ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_carryOver',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->prev_carryOver ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.2 Receipts</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('receipts',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->receipts ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_receipts',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->prev_receipts ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.3 Withdrawals</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('withdrawals',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->withdrawals ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_withdrawals',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->prev_withdrawals ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.4 Transfers to refinery</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('transferToRefinery',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->transferToRefinery ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transferToRefinery',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->prev_transferToRefinery ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.5 Etc</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('etc',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->etc ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_etc',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt'
                ],
                $wr->form4->prev_etc ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.6 Stock Balance</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong success">
                SUBSIDIARY WAREHOUSES
                <button class="btn btn-xs btn-success pull-right form4_listOfWarehousesBtn" for="RAW" data-toggle="modal" data-target="#form4_listOfWarehousesModal"><i class="fa fa-list"></i> List of Subsidiary Warehouses</button>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.1 Carry Over
                <button class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="carryOver" sugarType="RAW" before="form4CarryOverTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['RAW']['carryOver']))
            @foreach($subsidiaries['RAW']['carryOver'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'carryOver',
                    'data' => $raw,
                    'sugarType' => 'RAW',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif

        <tr for="carryOver" class="computation form4CarryOverTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>


        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.2 Receipts
                <button class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="receipts"  sugarType="RAW" before="form4ReceiptsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['RAW']['receipts']))
            @foreach($subsidiaries['RAW']['receipts'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'receipts',
                    'data' => $raw,
                    'sugarType' => 'RAW',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="receipts" class="computation form4ReceiptsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.3 Withdrawals
                <button class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="withdrawals" sugarType="RAW"  before="form4WithdrawalsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['RAW']['withdrawals']))
            @foreach($subsidiaries['RAW']['withdrawals'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'withdrawals',
                    'data' => $raw,
                    'sugarType' => 'RAW',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="withdrawals" class="computation form4WithdrawalsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>
        </tbody>
    </table>
</form>
