<div class="form-title" style="background-color: #4e984a;">
    <h4>  WEEKLY REPORT ON REFINED SUGAR
    </h4>
</div>

<div class="subform-container">
    <h4>Raw Sugar</h4>
    <div class="subform-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #987e4a;color: white;">
                            <p class="no-margin">1. Carry Over <small id="filter-notifier" class="label bg-blue blink"></small></p>
                        </div>
                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form2_table">
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
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][carryOver]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_current_carryOver',
                                        ],
                                        (isset($details_arr['form2']['carryOver'])) ? $details_arr['form2']['carryOver']->current_value : null
                                        ) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][carryOver]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_prev_carryOver',
                                        ],
                                        (isset($details_arr['form2']['carryOver'])) ? $details_arr['form2']['carryOver']->prev_value : null
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

            <div class="col-md-12">
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">

                </p>


                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #987e4a;color: white;">
                            <p class="no-margin">2. Receipts: (For Refining)<small id="filter-notifier" class="label bg-blue blink"></small></p>
                        </div>
                        <div class="box-body" style="">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold; margin-left: 20px">
                                2.1 From Raw Mill
                            </p>
                            <table class="table table-bordered table-condensed sms_form2_table" style="margin-left: 20px">
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
                                    <td>Covered by SRO</td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][rawMillCoveredBySro]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_current_rawMillCoveredBySro',
                                        ],
                                        (isset($details_arr['form2']['rawMillCoveredBySro'])) ? $details_arr['form2']['rawMillCoveredBySro']->current_value : null
                                        ) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][rawMillCoveredBySro]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_prev_rawMillNotCoveredBySro',
                                        ],
                                        (isset($details_arr['form2']['rawMillCoveredBySro'])) ? $details_arr['form2']['rawMillCoveredBySro']->prev_value : null
                                        ) !!}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Not Covered by SRO</td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][rawMillNotCoveredBySro]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_current_manufactured',
                                        ],
                                        (isset($details_arr['form2']['rawMillNotCoveredBySro'])) ? $details_arr['form2']['rawMillNotCoveredBySro']->current_value : null
                                        ) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][rawMillNotCoveredBySro]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_prev_manufactured',
                                        ],
                                        (isset($details_arr['form2']['rawMillNotCoveredBySro'])) ? $details_arr['form2']['rawMillNotCoveredBySro']->prev_value : null
                                        ) !!}
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-condensed sms_form2_table">
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
                                    <td>Other Mills</td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][otherMills]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_current_otherMills',
                                        ],
                                        (isset($details_arr['form2']['otherMills'])) ? $details_arr['form2']['otherMills']->current_value : null
                                        ) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][otherMills]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_prev_otherMills',
                                        ],
                                        (isset($details_arr['form2']['otherMills'])) ? $details_arr['form2']['otherMills']->prev_value : null
                                        ) !!}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Imported</td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][imported]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_current_imported',
                                        ],
                                        (isset($details_arr['form2']['imported'])) ? $details_arr['form2']['imported']->current_value : null
                                        ) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][imported]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_prev_imported',
                                        ],
                                        (isset($details_arr['form2']['imported'])) ? $details_arr['form2']['imported']->prev_value : null
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

            @php
                $fn = \App\Models\SMS\InputFields::getFields('refined_sugar_345')
            @endphp
            @foreach($fn as $f)
                <div class="col-md-12">
                    <div class="panel">
                        <div class="box box-sm box-default box-solid">
                            <div class="box-header with-border"  style="background-color: #987e4a;color: white;">
                                <p class="no-margin">{{$f->prefix}} {{$f->display_name}}<small id="filter-notifier" class="label bg-blue blink"></small></p>
                            </div>
                            <div class="box-body" style="">
                                <table class="table table-bordered table-condensed sms_form2_table">
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
                                        <td>{{$f->display_name}}</td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current]['.$f->field.']',[
                                                'class' => 'text-right autonumber_mt',
                                                'container_class' => 'data_form2_current_'.$f->field,
                                            ],
                                            (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->current_value : null
                                            ) !!}
                                        </td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev]['.$f->field.']',[
                                                'class' => 'text-right autonumber_mt',
                                                'container_class' => 'data_form2_prev_'.$f->field,
                                            ],
                                            (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->prev_value : null
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
            @endforeach
        </div>
    </div>
</div>


<div class="subform-container">
    <h4>Refined Sugar</h4>
    <div class="subform-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4e984a;color: white;">
                            <p class="no-margin">Summary
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                            </p>
                        </div>
                        <div class="box-body" style="">
                            @include('sms.weekly_report.previews.form2')
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                @php
                    $a = 'refinedSugarProduction';
                @endphp
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4e984a;color: white;">
                            <p class="no-margin">6. Production/Carry-over
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-success add_btn"  style="background-color: #e3e3e3" data="form2_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>
                        </div>
                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form2_table table_dynamic" id="form2_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset($details_arr['form2'][$a]) && count($details_arr['form2'][$a]) > 0)
                                    @foreach($details_arr['form2'][$a] as $$a)
                                        @include('sms.dynamic_rows.form2_'.$a,['item'=>$$a])
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4e984a;color: white;">
                            <p class="no-margin">7. Issuances
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                            </p>
                        </div>
                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form2_table">
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
                                    <td>Issuances</td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][issuances]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_current_issuances',
                                        ],
                                        (isset($details_arr['form2']['issuances'])) ? $details_arr['form2']['issuances']->current_value : null
                                        ) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][issuances]',[
                                            'class' => 'autonumber_mt',
                                            'autocomplete' => 'off',
                                            'container_class' => 'data_form2_prev_issuances',
                                        ],
                                        (isset($details_arr['form2']['issuances'])) ? $details_arr['form2']['issuances']->prev_value : null
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

            <div class="col-md-12">
                @php
                    $a = 'refinedSugarWithdrawals';
                @endphp
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4e984a;color: white;">
                            <p class="no-margin">8. Withdrawals
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-success add_btn" style="background-color: #e3e3e3" data="form2_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>
                        </div>
                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form2_table table_dynamic" id="form2_{{$a}}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Current Crop</th>
                                    <th>Previous Crop</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( isset($details_arr['form2'][$a]) && count($details_arr['form2'][$a]) > 0)
                                    @foreach($details_arr['form2'][$a] as $$a)
                                        @include('sms.dynamic_rows.form2_'.$a,['item'=>$$a])
                                    @endforeach
                                @else
                                    @include('sms.dynamic_rows.form2_'.$a)
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            @php
                $fn = \App\Models\SMS\InputFields::getFields('refined_sugar_9_to_11')
            @endphp
            @foreach($fn as $f)

                    <div class="col-md-12">
                        <div class="panel">
                            <div class="box box-sm box-default box-solid">
                                <div class="box-header with-border"  style="background-color: #4e984a;color: white;">
                                    <p class="no-margin">{{$f->prefix}} {{$f->display_name}}
                                        <small id="filter-notifier" class="label bg-blue blink"></small>
                                    </p>
                                </div>
                                <div class="box-body" style="">
                                    <table class="table table-bordered table-condensed sms_form2_table">
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
                                            <td>{{$f->display_name}}</td>
                                            <td>
                                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current]['.$f->field.']',[
                                                    'class' => 'text-right autonumber_mt',
                                                    'container_class' => 'data_form2_current_'.$f->field,
                                                ],
                                            (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->current_value : null
                                            ) !!}
                                            </td>
                                            <td>
                                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev]['.$f->field.']',[
                                                    'class' => 'text-right autonumber_mt',
                                                    'container_class' => 'data_form2_prev_'.$f->field,
                                                ],
                                            (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->prev_value : null
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
            @endforeach
        </div>
    </div>
</div>