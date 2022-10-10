<div class="form-title" style="background-color: #4e984a;">
    <h4>  WEEKLY REPORT ON MOLASSESS
    </h4>
</div>
<div class="row">
    <div class="col-md-12">
        @php
            $a = 'production';
        @endphp

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        1. Production
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form3_molasses_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>

                </div>

                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form3_molasses_{{$a}}">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($details_arr['form3'][$a]) && count($details_arr['form3'][$a]) > 0)
                                @foreach($details_arr['form3'][$a] as $$a)
                                    @include('sms.dynamic_rows.form3_molasses_'.$a,['item' => $$a])
                                @endforeach
                            @else
                                @include('sms.dynamic_rows.form3_molasses_'.$a)
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
            $a = 'issuances';
        @endphp

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        2. Issuances
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form3_molasses_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>

                </div>

                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form3_molasses_{{$a}}">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($details_arr['form3'][$a]) && count($details_arr['form3'][$a]) > 0)
                            @foreach($details_arr['form3'][$a] as $$a)
                                @include('sms.dynamic_rows.form3_molasses_'.$a,['item' => $$a])
                            @endforeach
                        @else
                            @include('sms.dynamic_rows.form3_molasses_'.$a)
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="subform-container">
    <h4>3. WITHDRAWALS</h4>
    <div class="subform-body">

        @php
            $a = 'rawWithdrawals';
        @endphp

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        RAW
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form3_molasses_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>

                </div>

                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form3_molasses_{{$a}}">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($details_arr['form3'][$a]) && count($details_arr['form3'][$a]) > 0)
                            @foreach($details_arr['form3'][$a] as $$a)
                                @include('sms.dynamic_rows.form3_molasses_'.$a,['item' => $$a])
                            @endforeach
                        @else
                            @include('sms.dynamic_rows.form3_molasses_'.$a)
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        @php
            $a = 'refinedWithdrawals';
        @endphp

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        REFINED
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form3_molasses_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>

                </div>

                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form3_molasses_{{$a}}">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($details_arr['form3'][$a]) && count($details_arr['form3'][$a]) > 0)
                            @foreach($details_arr['form3'][$a] as $$a)
                                @include('sms.dynamic_rows.form3_molasses_'.$a,['item' => $$a])
                            @endforeach
                        @else
                            @include('sms.dynamic_rows.form3_molasses_'.$a)
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
        <div class="box-header with-border"  style="background-color: #987e4a;color: white;">
            <p class="no-margin">4. Balance <small id="filter-notifier" class="label bg-blue blink"></small></p>
        </div>
        <div class="box-body" style="">
            <table class="table table-bordered table-condensed sms_form3_table">
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
                    <td>Raw</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][current][rawBalance]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_current_rawBalance',
                        ],
                        (isset($details_arr['form3']['rawBalance'])) ? $details_arr['form3']['rawBalance']->current_value : null
                        ) !!}
                    </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][prev][rawBalance]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_prev_rawBalance',
                        ],
                        (isset($details_arr['form3']['rawBalance'])) ? $details_arr['form3']['rawBalance']->prev_value : null
                        ) !!}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Refined</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][current][refinedBalance]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_current_refinedBalance',
                        ],
                        (isset($details_arr['form3']['refinedBalance'])) ? $details_arr['form3']['refinedBalance']->current_value : null
                        ) !!}
                    </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][prev][refinedBalance]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_prev_refinedBalance',
                        ],
                        (isset($details_arr['form3']['refinedBalance'])) ? $details_arr['form3']['refinedBalance']->prev_value : null
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
        <div class="box-header with-border"  style="background-color: #987e4a;color: white;">
            <p class="no-margin">5. Molasses Price (Php/MT) <small id="filter-notifier" class="label bg-blue blink"></small></p>
        </div>
        <div class="box-body" style="">
            <table class="table table-bordered table-condensed sms_form3_table">
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
                    <td>Raw</td>
                    <td>

                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][current][rawPrice]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_current_rawPrice',
                        ],
                        (isset($details_arr['form3']['rawPrice'])) ? $details_arr['form3']['rawPrice']->current_value : null
                        ) !!}
                    </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][prev][rawPrice]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_prev_rawPrice',
                        ],
                        (isset($details_arr['form3']['rawPrice'])) ? $details_arr['form3']['rawPrice']->prev_value : null
                        ) !!}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Refined</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][current][refinedPrice]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_current_refinedPrice',
                        ],
                        (isset($details_arr['form3']['refinedPrice'])) ? $details_arr['form3']['refinedPrice']->current_value : null
                        ) !!}
                    </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][prev][refinedPrice]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_prev_refinedPrice',
                        ],
                        (isset($details_arr['form3']['refinedPrice'])) ? $details_arr['form3']['refinedPrice']->prev_value : null
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
        <div class="box-header with-border"  style="background-color: #987e4a;color: white;">
            <p class="no-margin">6. Molasses Storage Certificates (Series & No. of Pcs.):<small id="filter-notifier" class="label bg-blue blink"></small></p>
        </div>
        <div class="box-body" style="">
            <table class="table table-bordered table-condensed sms_form3_table">
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
                    <td>Raw</td>
                    <td>

                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][current][rawPrice]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_current_rawPrice',
                        ],
                        (isset($details_arr['form3']['rawPrice'])) ? $details_arr['form3']['rawPrice']->current_value : null
                        ) !!}
                    </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][prev][rawPrice]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_prev_rawPrice',
                        ],
                        (isset($details_arr['form3']['rawPrice'])) ? $details_arr['form3']['rawPrice']->prev_value : null
                        ) !!}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Refined</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][current][refinedPrice]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_current_refinedPrice',
                        ],
                        (isset($details_arr['form3']['refinedPrice'])) ? $details_arr['form3']['refinedPrice']->current_value : null
                        ) !!}
                    </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][prev][refinedPrice]',[
                            'class' => 'autonumber_mt',
                            'autocomplete' => 'off',
                            'container_class' => 'data_form3_prev_refinedPrice',
                        ],
                        (isset($details_arr['form3']['refinedPrice'])) ? $details_arr['form3']['refinedPrice']->prev_value : null
                        ) !!}
                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--@php
    $a = 'seriesNos';
@endphp
<div class="box box-sm box-default box-solid">
    <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
        <p class="no-margin">
            6. Molasses Storage Certificates (Series & No. of Pcs.):
            <small id="filter-notifier" class="label bg-blue blink"></small>
            <button class="btn btn-xs pull-right btn-success add_btn" style="background-color: #e3e3e3" data="form3_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
        </p>
    </div>
    <div class="box-body" style="">
        <table class="table table-bordered table-condensed sms_form3_table table_dynamic" id="form3_{{$a}}">
            <thead>
            <tr>
                <th>Sugar Class</th>
                <th>Series From</th>
                <th>Series To</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($details_arr['form3'][$a]) && count($details_arr['form3'][$a]) > 0)
                @foreach($details_arr['form3'][$a] as $$a)
                    @include('sms.dynamic_rows.form3_'.$a,['item' => $$a])
                @endforeach
            @else
                @include('sms.dynamic_rows.form3_'.$a)
            @endif
            </tbody>
        </table>
    </div>
</div>
-->

<div class="box box-sm box-default box-solid">
    <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
        <p class="no-margin">
            7. Molasses Distribution Factor:
            <small id="filter-notifier" class="label bg-blue blink"></small>
        </p>
    </div>
    <div class="box-body" style="">
        <div class="row">
            <div class="col-md-6">

                <div class="row">
                    {!! \App\Swep\ViewHelpers\__form2::textbox('data[form3][current][dist_factor]',[
                        'label' => 'Sugar Distribution Factor:',
                        'cols' => 12,
                        'container_class' => 'data_form3_current_dist_factor',
                    ],
                    (isset($details_arr['form3']['dist_factor'])) ? $details_arr['form3']['dist_factor']->current_value : null
                    ) !!}
                </div>
            </div>
        </div>
    </div>
</div>