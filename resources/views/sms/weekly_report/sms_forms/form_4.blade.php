

<div class="form-title" style="background-color: #6c565a;">
    <h4>  MILLSITE & SUBSIDIARY WAREHOUSE INVENTORY REPORT - RAW
    </h4>
</div>
<div class="subform-container">
    <h4>Mill Warehouse</h4>
    <div class="subform-body">

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #6c565a;color: white;">
                    <p class="no-margin">1.1 Carry Over <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Carry-over</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][current][carryOver]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_current_carryOver',
                                ],
                                (isset($details_arr['form4']['carryOver'])) ? $details_arr['form4']['carryOver']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][prev][carryOver]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_prev_carryOver',
                                ],
                                (isset($details_arr['form4']['carryOver'])) ? $details_arr['form4']['carryOver']->prev_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #6c565a;color: white;">
                    <p class="no-margin">1.2 Net Production <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Net Production</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][current][netProduction]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_current_netProduction',
                                ],
                                (isset($details_arr['form4']['netProduction'])) ? $details_arr['form4']['netProduction']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][prev][netProduction]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_prev_netProduction',
                                ],
                                (isset($details_arr['form4']['netProduction'])) ? $details_arr['form4']['netProduction']->prev_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #6c565a;color: white;">
                    <p class="no-margin">1.3 Withdrawals <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Withdrawals</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][current][withdrawals]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_current_withdrawals',
                                ],
                                (isset($details_arr['form4']['withdrawals'])) ? $details_arr['form4']['withdrawals']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][prev][withdrawals]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_prev_withdrawals',
                                ],
                                (isset($details_arr['form4']['withdrawals'])) ? $details_arr['form4']['withdrawals']->prev_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #6c565a;color: white;">
                    <p class="no-margin">1.4 Transfers to Subsidiary <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Transfers to Subsidiary</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][current][transfersToSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_current_transfersToSubsidiary',
                                ],
                                (isset($details_arr['form4']['transfersToSubsidiary'])) ? $details_arr['form4']['transfersToSubsidiary']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][prev][transfersToSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_prev_transfersToSubsidiary',
                                ],
                                (isset($details_arr['form4']['transfersToSubsidiary'])) ? $details_arr['form4']['transfersToSubsidiary']->prev_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #6c565a;color: white;">
                    <p class="no-margin">1.5 Stock Balance <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Stock Balance</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][current][stockBalance]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_current_stockBalance',
                                ],
                                (isset($details_arr['form4']['stockBalance'])) ? $details_arr['form4']['stockBalance']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][prev][stockBalance]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_prev_stockBalance',
                                ],
                                (isset($details_arr['form4']['stockBalance'])) ? $details_arr['form4']['stockBalance']->prev_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
</div>


<div class="subform-container">
    <h4>Subsidiary Warehouse(s)</h4>
    <div class="subform-body">
        <div class="row">
            <div class="col-md-12">
                @php
                    $a = 'subsidiaryCarryOver';
                @endphp

                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #565c6c;color: white;">
                            <p class="no-margin">
                                2.1 Carry Over
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form4_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form4_table table_dynamic" id="form4_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form4'][$a]) && count($details_arr['form4'][$a]) > 0)
                                    @foreach($details_arr['form4'][$a] as $$a)
                                        @include('sms.dynamic_rows.form4_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form4_'.$a)
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @php
                    $a = 'subsidiaryReceipts';
                @endphp

                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #565c6c;color: white;">
                            <p class="no-margin">
                                2.2 Receipts
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form4_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form4_table table_dynamic" id="form4_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form4'][$a]) && count($details_arr['form4'][$a]) > 0)
                                    @foreach($details_arr['form4'][$a] as $$a)
                                        @include('sms.dynamic_rows.form4_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form4_'.$a)
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @php
                    $a = 'subsidiaryWithdrawals';
                @endphp

                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #565c6c;color: white;">
                            <p class="no-margin">
                                2.3 Withdrawals
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form4_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form4_table table_dynamic" id="form4_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form4'][$a]) && count($details_arr['form4'][$a]) > 0)
                                    @foreach($details_arr['form4'][$a] as $$a)
                                        @include('sms.dynamic_rows.form4_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form4_'.$a)
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @php
                    $a = 'subsidiaryStockBalance';
                @endphp

                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #565c6c;color: white;">
                            <p class="no-margin">
                                2.4 Stock Balance
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form4_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form4_table table_dynamic" id="form4_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form4'][$a]) && count($details_arr['form4'][$a]) > 0)
                                    @foreach($details_arr['form4'][$a] as $$a)
                                        @include('sms.dynamic_rows.form4_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form4_'.$a)
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #565c6c;color: white;">
                    <p class="no-margin">3. Total Stocks - Millsite and Subsidiary Warehouses <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Millsite and Subsidiary Warehouses</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][current][totalStocksMillsiteSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_current_totalStocksMillsiteSubsidiary',
                                ],
                                (isset($details_arr['form4']['totalStocksMillsiteSubsidiary'])) ? $details_arr['form4']['totalStocksMillsiteSubsidiary']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][prev][totalStocksMillsiteSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_prev_totalStocksMillsiteSubsidiary',
                                ],
                                (isset($details_arr['form4']['totalStocksMillsiteSubsidiary'])) ? $details_arr['form4']['totalStocksMillsiteSubsidiary']->prev_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #565c6c;color: white;">
                    <p class="no-margin">4. Total Stocks - Current and Previous Crops<small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Current and Previous Crops</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][current][totalStocksCurrentPrev]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_current_totalStocksCurrentPrev',
                                ],
                                (isset($details_arr['form4']['totalStocksCurrentPrev'])) ? $details_arr['form4']['totalStocksCurrentPrev']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4][prev][totalStocksCurrentPrev]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4_prev_totalStocksCurrentPrev',
                                ],
                                (isset($details_arr['form4']['totalStocksCurrentPrev'])) ? $details_arr['form4']['totalStocksCurrentPrev']->prev_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




