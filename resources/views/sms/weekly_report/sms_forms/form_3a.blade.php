<div class="form-title" style="background-color: #5aa7b3;">
    <h4> MILLSITE AND SUBSIDIARY TANKS INVENTORY REPORT - MOLASSES
    </h4>
</div>

<div class="subform-container">
    <h4>Molasses</h4>
    <div class="subform-body">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #5aa7b3;color: white;">
                    <p class="no-margin">1.1 Carry Over <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form3a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][current][carryOver]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_current_carryOver',
                                ],
                                (isset($details_arr['form3a']['carryOver'])) ? $details_arr['form3a']['carryOver']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][prev][carryOver]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_prev_carryOver',
                                ],
                                (isset($details_arr['form3a']['carryOver'])) ? $details_arr['form3a']['carryOver']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #5aa7b3;color: white;">
                    <p class="no-margin">1.2 Net Production <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form3a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][current][netProduction]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_current_netProduction',
                                ],
                                (isset($details_arr['form3a']['netProduction'])) ? $details_arr['form3a']['netProduction']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][prev][netProduction]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_prev_netProduction',
                                ],
                                (isset($details_arr['form3a']['netProduction'])) ? $details_arr['form3a']['netProduction']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #5aa7b3;color: white;">
                    <p class="no-margin">1.3 Withdrawals <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form3a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][current][withdrawals]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_current_withdrawals',
                                ],
                                (isset($details_arr['form3a']['withdrawals'])) ? $details_arr['form3a']['withdrawals']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][prev][withdrawals]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_prev_withdrawals',
                                ],
                                (isset($details_arr['form3a']['withdrawals'])) ? $details_arr['form3a']['withdrawals']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #5aa7b3;color: white;">
                    <p class="no-margin">1.4 Transfers to Subsidiary <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form3a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][current][transfersToSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_current_transfersToSubsidiary',
                                ],
                                (isset($details_arr['form3a']['transfersToSubsidiary'])) ? $details_arr['form3a']['transfersToSubsidiary']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][prev][transfersToSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_prev_transfersToSubsidiary',
                                ],
                                (isset($details_arr['form3a']['transfersToSubsidiary'])) ? $details_arr['form3a']['transfersToSubsidiary']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #5aa7b3;color: white;">
                    <p class="no-margin">1.5 Stock Balance <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form3a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][current][stockBalance]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_current_stockBalance',
                                ],
                                (isset($details_arr['form3a']['stockBalance'])) ? $details_arr['form3a']['stockBalance']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][prev][stockBalance]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_prev_stockBalance',
                                ],
                                (isset($details_arr['form3a']['stockBalance'])) ? $details_arr['form3a']['stockBalance']->prev_value : null
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
    <h4>Subsidiary Tanks</h4>
    <div class="subform-body">
        <div class="row">
            <div class="col-md-12">
                @php
                    $a = 'subsidiaryCarryOver1';
                @endphp

                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #8da344;color: white;">
                            <p class="no-margin">
                                2.1 Carry Over
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form3a_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form3a_table table_dynamic" id="form3a_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form3a'][$a]) && count($details_arr['form3a'][$a]) > 0)
                                    @foreach($details_arr['form3a'][$a] as $$a)
                                        @include('sms.dynamic_rows.form3a_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form3a_'.$a)
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
                    $a = 'subsidiaryCarryOver2';
                @endphp

                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #8da344;color: white;">
                            <p class="no-margin">
                                2.2 Carry Over
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form3a_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form3a_table table_dynamic" id="form3a_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form3a'][$a]) && count($details_arr['form3a'][$a]) > 0)
                                    @foreach($details_arr['form3a'][$a] as $$a)
                                        @include('sms.dynamic_rows.form3a_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form3a_'.$a)
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
                    $a = 'subsidiaryCarryOver3';
                @endphp

                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #8da344;color: white;">
                            <p class="no-margin">
                                2.3 Carry Over
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form3a_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form3a_table table_dynamic" id="form3a_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form3a'][$a]) && count($details_arr['form3a'][$a]) > 0)
                                    @foreach($details_arr['form3a'][$a] as $$a)
                                        @include('sms.dynamic_rows.form3a_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form3a_'.$a)
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
                    $a = 'subsidiaryCarryOver4';
                @endphp

                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #8da344;color: white;">
                            <p class="no-margin">
                                2.4 Carry Over
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form3a_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>

                        </div>

                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form3a_table table_dynamic" id="form3a_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($details_arr['form3a'][$a]) && count($details_arr['form3a'][$a]) > 0)
                                    @foreach($details_arr['form3a'][$a] as $$a)
                                        @include('sms.dynamic_rows.form3a_'.$a,['item' => $$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form3a_'.$a)
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
                <div class="box-header with-border"  style="background-color: #8da344;color: white;">
                    <p class="no-margin">3. Total Stocks - Millsite and Subsidiary Tanks <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form3a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][current][totalStocksMillsiteSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_current_totalStocksMillsiteSubsidiary',
                                ],
                                (isset($details_arr['form3a']['totalStocksMillsiteSubsidiary'])) ? $details_arr['form3a']['totalStocksMillsiteSubsidiary']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][prev][totalStocksMillsiteSubsidiary]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_prev_totalStocksMillsiteSubsidiary',
                                ],
                                (isset($details_arr['form3a']['totalStocksMillsiteSubsidiary'])) ? $details_arr['form3a']['totalStocksMillsiteSubsidiary']->prev_value : null
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
                <div class="box-header with-border"  style="background-color: #8da344;color: white;">
                    <p class="no-margin">4. Total Stocks - Current and Previous Crops<small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form3a_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][current][totalStocksCurrentPrev]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_current_totalStocksCurrentPrev',
                                ],
                                (isset($details_arr['form3a']['totalStocksCurrentPrev'])) ? $details_arr['form3a']['totalStocksCurrentPrev']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][prev][totalStocksCurrentPrev]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form3a_prev_totalStocksCurrentPrev',
                                ],
                                (isset($details_arr['form3a']['totalStocksCurrentPrev'])) ? $details_arr['form3a']['totalStocksCurrentPrev']->prev_value : null
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




