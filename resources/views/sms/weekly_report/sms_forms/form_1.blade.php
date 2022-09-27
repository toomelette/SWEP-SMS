<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                    1. Manufactured
                </p>
                <table class="table table-bordered table-condensed sms_form1_table">
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
                        <td>Manufactured</td>
                        <td>
                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current][manufactured]',[
                                'class' => 'autonumber_mt',
                                'autocomplete' => 'off',
                                'container_class' => 'data_form1_current_manufactured',
                            ],
                            (isset($details_arr['form1']['manufactured'])) ? $details_arr['form1']['manufactured']->current_value : null
                            ) !!}
                        </td>
                        <td>
                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][prev][manufactured]',[
                                'class' => 'autonumber_mt',
                                'autocomplete' => 'off',
                                'container_class' => 'data_form1_prev_manufactured',
                            ],
                            (isset($details_arr['form1']['manufactured'])) ? $details_arr['form1']['manufactured']->prev_value : null
                            ) !!}
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                @php
                    $a = 'issuances';
                @endphp
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                    2. Issuances/Carried-over
                    <button class="btn btn-xs pull-right btn-success add_btn" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                </p>
                <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form1_raw_sugar_{{$a}}">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Current Crop</th>
                        <th>Previous Crop</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($details_arr['form1'][$a]) && count($details_arr['form1'][$a]) > 0)
                            @foreach($details_arr['form1'][$a] as $$a)
                                @include('sms.dynamic_rows.form1_raw_sugar_'.$a,['item' => $$a])
                            @endforeach
                        @else
                            @include('sms.dynamic_rows.form1_raw_sugar_'.$a)
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                @php
                    $a = 'withdrawals';
                @endphp
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                    3. Withdrawals
                    <button class="btn btn-xs pull-right btn-success add_btn" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                </p>
                <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form1_raw_sugar_{{$a}}">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Current Crop</th>
                        <th>Previous Crop</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($details_arr['form1'][$a]) && count($details_arr['form1'][$a]) > 0)
                            @foreach($details_arr['form1'][$a] as $$a)
                                    @include('sms.dynamic_rows.form1_raw_sugar_'.$a,['item' => $$a])
                            @endforeach
                        @else
                                @include('sms.dynamic_rows.form1_raw_sugar_'.$a)
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                @php
                    $a = 'balances';
                @endphp
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                    4. Balance
                    <button class="btn btn-xs pull-right btn-success add_btn" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                </p>
                <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form1_raw_sugar_{{$a}}">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Current Crop</th>
                        <th>Previous Crop</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($details_arr['form1'][$a]) && count($details_arr['form1'][$a]) > 0)
                        @foreach($details_arr['form1'][$a] as $$a)
                            @include('sms.dynamic_rows.form1_raw_sugar_'.$a,['item' => $$a])
                        @endforeach
                    @else
                        @include('sms.dynamic_rows.form1_raw_sugar_'.$a)
                    @endif
                    </tbody>
                </table>
            </div>
            @php
            $fn = \App\Models\SMS\InputFields::getFields('raw_sugar_5_to_11')
            @endphp

            @foreach($fn as $f)
                <div class="col-md-12">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                        {{$f->prefix}} {{$f->display_name}}
                    </p>
                    <table class="table table-bordered table-condensed sms_form1_table">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current]['.$f->field.']',[
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_current_'.$f->field,
                                ],
                                (isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][prev]['.$f->field.']',[
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_prev_'.$f->field,
                                ],
                                (isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->prev_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach

            <div class="col-md-12">
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                    12. Planter & Miller's Share
                </p>
                @php
                    $fn = \App\Models\SMS\InputFields::getFields('raw_sugar_share')
                @endphp
                <table class="table table-bordered table-condensed sms_form1_table" id="">
                    <thead>

                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>
                    @foreach($fn as $f)
                        <tr>
                            <td>{{$f->display_name}}</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current]['.$f->field.']',[
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_current_'.$f->field,
                                ],
                                (isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][prev]['.$f->field.']',[
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_prev_'.$f->field,
                                ],
                                (isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->current_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                @php
                    $a = 'prices';
                @endphp
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                    13. Mill District Price Monitoring
                    <button class="btn btn-xs pull-right btn-success add_btn" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                </p>


                <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form1_raw_sugar_{{$a}}">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($details_arr['form1'][$a]) && count($details_arr['form1'][$a]) > 0)
                        @foreach($details_arr['form1'][$a] as $$a)
                            @include('sms.dynamic_rows.form1_raw_sugar_'.$a,['item' => $$a])
                        @endforeach
                    @else
                        @include('sms.dynamic_rows.form1_raw_sugar_'.$a)
                    @endif
                    </tbody>
                </table>

                <table class="table table-bordered table-condensed sms_form1_table" id="">
                    <thead>

                    <tr>
                        <th></th>
                        <th>Wholesale</th>
                        <th>Retail</th>
                    </tr>

                    </thead>
                    <tbody>

                        <tr>
                            <td>RAW</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current][wholesale_raw]',[
                                    'container_class' => 'data_form1_current_wholesale_raw',
                                ],
                                (isset($details_arr['form1']['wholesale_raw'])) ? $details_arr['form1']['wholesale_raw']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current][retail_raw]',[
                                    'container_class' => 'data_form1_current_retail_raw',
                                ],
                                (isset($details_arr['form1']['retail_raw'])) ? $details_arr['form1']['retail_raw']->current_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>REFINED</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current][wholesale_refined]',[
                                    'container_class' => 'data_form1_current_wholesale_refined',
                                ],
                                (isset($details_arr['form1']['wholesale_refined'])) ? $details_arr['form1']['wholesale_refined']->current_value : null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current][retail_refined]',[
                                    'container_class' => 'data_form1_current_retail_refined',
                                ],
                                (isset($details_arr['form1']['retail_refined'])) ? $details_arr['form1']['retail_refined']->current_value : null
                                ) !!}
                            </td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                    14. Sugar Distribution Factor
                </p>
                <div class="row">
                   <div class="col-md-6">

                       <div class="row">
                           {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][current][dist_factor]',[
                               'label' => 'Sugar Distribution Factor:',
                               'cols' => 12,
                               'container_class' => 'data_form1_current_dist_factor',
                           ],
                           (isset($details_arr['form1']['dist_factor'])) ? $details_arr['form1']['dist_factor']->current_value : null
                           ) !!}
                       </div>
                   </div>
                </div>
            </div>
            <div class="col-md-12">
                @php
                    $a = 'seriesNos';
                @endphp
                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                    15. Quedan Issuances Series & No. of PCS.
                    <button class="btn btn-xs pull-right btn-success add_btn" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                </p>
                <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form1_raw_sugar_{{$a}}">
                    <thead>
                    <tr>
                        <th>Sugar Class</th>
                        <th>Series From</th>
                        <th>Series To</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($details_arr['form1'][$a]) && count($details_arr['form1'][$a]) > 0)
                            @foreach($details_arr['form1'][$a] as $$a)
                                @include('sms.dynamic_rows.form1_raw_sugar_'.$a,['item' => $$a])
                            @endforeach
                        @else
                            @include('sms.dynamic_rows.form1_raw_sugar_'.$a)
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<hr>
