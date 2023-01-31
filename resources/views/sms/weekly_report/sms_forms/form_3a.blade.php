<div class="form-title" style="background-color: #5aa7b3;">
    <h4> MILLSITE AND SUBSIDIARY TANKS INVENTORY REPORT - MOLASSES
    </h4>
</div>


<form id="form3a">
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
                    'class' => 'global-form-changer global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->carryOver ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_carryOver',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->prev_carryOver ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.2 Receipts</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('receipts',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->receipts ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_receipts',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->prev_receipts ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.3 Withdrawals</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('withdrawals',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->withdrawals ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_withdrawals',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->prev_withdrawals ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.4 Transfers to refinery</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('transferToRefinery',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->transferToRefinery ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transferToRefinery',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->prev_transferToRefinery ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.5 Etc</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('etc',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->etc ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_etc',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'
                ],
                $wr->form3a->prev_etc ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.6 Stock Balance</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong success">
                SUBSIDIARY TANKS
                <button type="button" class="btn btn-xs btn-success pull-right form4_listOfWarehousesBtn" for="MOLASSES" data-toggle="modal" data-target="#form4_listOfWarehousesModal"><i class="fa fa-list"></i> List of Subsidiary Tanks</button>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.1 Carry Over
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="carryOver" sugarType="MOLASSES" before="form3aCarryOverTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['MOLASSES']['carryOver']))
            @foreach($subsidiaries['MOLASSES']['carryOver'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'carryOver',
                    'data' => $raw,
                    'sugarType' => 'MOLASSES',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif

        <tr for="carryOver" class="computation form3aCarryOverTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>


        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.2 Receipts
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="receipts"  sugarType="MOLASSES" before="form3aReceiptsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['MOLASSES']['receipts']))
            @foreach($subsidiaries['MOLASSES']['receipts'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'receipts',
                    'data' => $raw,
                    'sugarType' => 'MOLASSES',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="receipts" class="computation form3aReceiptsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.3 Withdrawals
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="withdrawals" sugarType="MOLASSES"  before="form3aWithdrawalsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['MOLASSES']['withdrawals']))
            @foreach($subsidiaries['MOLASSES']['withdrawals'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'withdrawals',
                    'data' => $raw,
                    'sugarType' => 'MOLASSES',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="withdrawals" class="computation form3aWithdrawalsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>
        </tbody>
    </table>

    
</form>



