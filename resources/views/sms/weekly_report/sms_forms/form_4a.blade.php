
<div class="form-title" style="background-color: #b3885a;">
    <h4>  MILLSITE & SUBSIDIARY WAREHOUSE INVENTORY REPORT - REFINED
    </h4>
</div>
<div class="subform-container">
    <h4>Refinery Warehouse</h4>
    <div class="subform-body">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #b3885a;color: white;">
                    <p class="no-margin">1.1 Carry Over <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][current][carryOver]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_current_carryOver',
                                ],
                                (isset($details_arr['form4a']['carryOver'])) ? $details_arr['form4a']['carryOver']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][prev][carryOver]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_prev_carryOver',
                                ],
                                (isset($details_arr['form4a']['carryOver'])) ? $details_arr['form4a']['carryOver']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #b3885a;color: white;">
                    <p class="no-margin">1.2 Net Production <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][current][netProduction]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_current_netProduction',
                                ],
                                (isset($details_arr['form4a']['netProduction'])) ? $details_arr['form4a']['netProduction']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][prev][netProduction]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_prev_netProduction',
                                ],
                                (isset($details_arr['form4a']['netProduction'])) ? $details_arr['form4a']['netProduction']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #b3885a;color: white;">
                    <p class="no-margin">1.3 Withdrawals <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][current][withdrawals]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_current_withdrawals',
                                ],
                                (isset($details_arr['form4a']['withdrawals'])) ? $details_arr['form4a']['withdrawals']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][prev][withdrawals]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_prev_withdrawals',
                                ],
                                (isset($details_arr['form4a']['withdrawals'])) ? $details_arr['form4a']['withdrawals']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #b3885a;color: white;">
                    <p class="no-margin">1.4 Transfers to Subsidiary <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][current][transfersToSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_current_transfersToSubsidiary',
                                ],
                                (isset($details_arr['form4a']['transfersToSubsidiary'])) ? $details_arr['form4a']['transfersToSubsidiary']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][prev][transfersToSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_prev_transfersToSubsidiary',
                                ],
                                (isset($details_arr['form4a']['transfersToSubsidiary'])) ? $details_arr['form4a']['transfersToSubsidiary']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #b3885a;color: white;">
                    <p class="no-margin">1.5 Stock Balance <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][current][stockBalance]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_current_stockBalance',
                                ],
                                (isset($details_arr['form4a']['stockBalance'])) ? $details_arr['form4a']['stockBalance']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][prev][stockBalance]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_prev_stockBalance',
                                ],
                                (isset($details_arr['form4a']['stockBalance'])) ? $details_arr['form4a']['stockBalance']->prev_value : null
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
                        <div class="box-header with-border"  style="background-color: #a34444;color: white;">
                            <p class="no-margin">
                                2.1 Carry Over
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form4a_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form4a_table table_dynamic" id="form4a_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form4a'][$a]) && count($details_arr['form4a'][$a]) > 0)
                                    @foreach($details_arr['form4a'][$a] as $$a)
                                        @include('sms.dynamic_rows.form4a_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form4a_'.$a)
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
                        <div class="box-header with-border"  style="background-color: #a34444;color: white;">
                            <p class="no-margin">
                                2.2 Receipts
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form4a_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form4a_table table_dynamic" id="form4a_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form4a'][$a]) && count($details_arr['form4a'][$a]) > 0)
                                    @foreach($details_arr['form4a'][$a] as $$a)
                                        @include('sms.dynamic_rows.form4a_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form4a_'.$a)
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
                        <div class="box-header with-border"  style="background-color: #a34444;color: white;">
                            <p class="no-margin">
                                2.3 Withdrawals
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form4a_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form4a_table table_dynamic" id="form4a_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form4a'][$a]) && count($details_arr['form4a'][$a]) > 0)
                                    @foreach($details_arr['form4a'][$a] as $$a)
                                        @include('sms.dynamic_rows.form4a_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form4a_'.$a)
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
                        <div class="box-header with-border"  style="background-color: #a34444;color: white;">
                            <p class="no-margin">
                                2.4 Stock Balance
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form4a_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form4a_table table_dynamic" id="form4a_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form4a'][$a]) && count($details_arr['form4a'][$a]) > 0)
                                    @foreach($details_arr['form4a'][$a] as $$a)
                                        @include('sms.dynamic_rows.form4a_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form4a_'.$a)
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
                <div class="box-header with-border"  style="background-color: #a34444;color: white;">
                    <p class="no-margin">3. Total Stocks - Millsite and Subsidiary Warehouses <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][current][totalStocksMillsiteSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_current_totalStocksMillsiteSubsidiary',
                                ],
                                (isset($details_arr['form4a']['totalStocksMillsiteSubsidiary'])) ? $details_arr['form4a']['totalStocksMillsiteSubsidiary']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][prev][totalStocksMillsiteSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_prev_totalStocksMillsiteSubsidiary',
                                ],
                                (isset($details_arr['form4a']['totalStocksMillsiteSubsidiary'])) ? $details_arr['form4a']['totalStocksMillsiteSubsidiary']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #a34444;color: white;">
                    <p class="no-margin">4. Total Stocks - Current and Previous Crops<small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form4a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][current][totalStocksCurrentPrev]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_current_totalStocksCurrentPrev',
                                ],
                                (isset($details_arr['form4a']['totalStocksCurrentPrev'])) ? $details_arr['form4a']['totalStocksCurrentPrev']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form4a][prev][totalStocksCurrentPrev]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form4a_prev_totalStocksCurrentPrev',
                                ],
                                (isset($details_arr['form4a']['totalStocksCurrentPrev'])) ? $details_arr['form4a']['totalStocksCurrentPrev']->prev_value : null
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



