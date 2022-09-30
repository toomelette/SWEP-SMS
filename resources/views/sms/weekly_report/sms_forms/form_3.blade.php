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



    <div class="col-md-12">
        @php
            $a = 'withdrawals';

        @endphp

        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        3. Withdrawals
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-success add_btn" style="background-color: #e3e3e3" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>
                </div>
                <div class="box-body" style="">
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
            </div>
        </div>
    </div>

    <div>
        {{--    WITHDRAWALS--}}
        {{--    <div class="col-md-12">--}}
        {{--        <div class="panel">--}}
        {{--            <div class="box box-sm box-default box-solid">--}}
        {{--                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">--}}
        {{--                    <p class="no-margin">3. Withdrawals <small id="filter-notifier" class="label bg-blue blink"></small></p>--}}
        {{--                </div>--}}
        {{--                @php--}}
        {{--                    $withdrawals = App\Models\SMS\Form5\Deliveries::query()--}}
        {{--                        ->selectRaw('sugar_class, sum(qty) as sum_qty, sum(qty_prev) as sum_qty_prev')--}}
        {{--                        ->groupBy('sugar_class')--}}
        {{--                        ->orderBy('sugar_class','asc')--}}
        {{--                        ->where('weekly_report_slug',$wr->slug)--}}
        {{--                        ->get();--}}
        {{--                @endphp--}}

        {{--                <div class="box-body" style="">--}}
        {{--                    <table class="table table-bordered table-condensed sms_form1_table">--}}
        {{--                        <thead>--}}
        {{--                        <tr>--}}
        {{--                            <th>Sugar Class</th>--}}
        {{--                            <th>Current Crop</th>--}}
        {{--                            <th>Previous Crop</th>--}}
        {{--                            <th>Action</th>--}}
        {{--                        </tr>--}}
        {{--                        </thead>--}}
        {{--                        <tbody>--}}
        {{--                        @if(!empty($withdrawals))--}}
        {{--                            @foreach($withdrawals as $withdrawal)--}}
        {{--                                <tr>--}}
        {{--                                    <td>{{$withdrawal->sugar_class}}</td>--}}
        {{--                                    <td>--}}
        {{--                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current][issuances]',[--}}
        {{--                                            'class' => 'autonumber_mt',--}}
        {{--                                            'autocomplete' => 'off',--}}
        {{--                                            'container_class' => 'data_form1_current_issuances',--}}
        {{--                                            'readonly' => 'readonly'--}}
        {{--                                        ],--}}
        {{--                                        $withdrawal->sum_qty--}}
        {{--                                        ) !!}--}}
        {{--                                    </td>--}}
        {{--                                    <td>--}}
        {{--                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][prev][issuances]',[--}}
        {{--                                            'class' => 'autonumber_mt',--}}
        {{--                                            'autocomplete' => 'off',--}}
        {{--                                            'container_class' => 'data_form1_prev_issuances',--}}
        {{--                                            'readonly' => 'readonly'--}}
        {{--                                        ],--}}
        {{--                                        $withdrawal->sum_qty_prev--}}
        {{--                                        ) !!}--}}
        {{--                                    </td>--}}
        {{--                                    <td></td>--}}
        {{--                                </tr>--}}
        {{--                            @endforeach--}}
        {{--                        @endif--}}

        {{--                        </tbody>--}}
        {{--                    </table>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}
    </div>

   <div>
{{--       <div class="col-md-12">--}}
{{--           <div class="panel">--}}
{{--               <div class="box box-sm box-default box-solid">--}}
{{--                   <div class="box-header with-border"  style="background-color: #4477a3;color: white;">--}}
{{--                       <p class="no-margin">5. Unquedanned <small id="filter-notifier" class="label bg-blue blink"></small></p>--}}
{{--                   </div>--}}

{{--                   <div class="box-body" style="">--}}
{{--                       <table class="table table-bordered table-condensed sms_form1_table">--}}
{{--                           <thead>--}}
{{--                           <tr>--}}
{{--                               <th></th>--}}
{{--                               <th>Current Crop</th>--}}
{{--                               <th>Previous Crop</th>--}}
{{--                               <th>Action</th>--}}
{{--                           </tr>--}}
{{--                           </thead>--}}
{{--                           <tbody>--}}
{{--                           <tr>--}}
{{--                               <td>Manufactured</td>--}}
{{--                               <td>--}}
{{--                                   {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current][manufactured]',[--}}
{{--                                       'class' => 'manufactured autonumber_mt',--}}
{{--                                       'autocomplete' => 'off',--}}
{{--                                       'container_class' => 'data_form1_current_manufactured',--}}
{{--                                       'id' => 'manufactured_current'--}}
{{--                                   ],--}}
{{--                                   (isset($details_arr['form1']['manufactured'])) ? $details_arr['form1']['manufactured']->current_value : null--}}
{{--                                   ) !!}--}}
{{--                               </td>--}}
{{--                               <td>--}}
{{--                                   {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][prev][manufactured]',[--}}
{{--                                       'class' => 'manufactured autonumber_mt',--}}
{{--                                       'autocomplete' => 'off',--}}
{{--                                       'container_class' => 'data_form1_prev_manufactured',--}}
{{--                                       'id' => 'manufactured_prev'--}}
{{--                                   ],--}}
{{--                                   (isset($details_arr['form1']['manufactured'])) ? $details_arr['form1']['manufactured']->prev_value : null--}}
{{--                                   ) !!}--}}
{{--                               </td>--}}
{{--                               <td></td>--}}
{{--                           </tr>--}}
{{--                           </tbody>--}}
{{--                       </table>--}}
{{--                   </div>--}}
{{--               </div>--}}
{{--           </div>--}}
{{--       </div>--}}
   </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @php
                    $a = 'balances';
                @endphp
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                            <p class="no-margin">
                                4. Balances
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-success add_btn" style="background-color: #e3e3e3" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>
                        </div>
                        <div class="box-body" style="">
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
                    </div>
                </div>
            </div>
            @php
            $fn = \App\Models\SMS\InputFields::getFields('raw_sugar_5_to_11')
            @endphp

            @foreach($fn as $f)
                <div class="col-md-12">
                    <div class="panel">
                        <div class="box box-sm box-default box-solid">
                            <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                                <p class="no-margin">
                                    {{$f->prefix}} {{$f->display_name}}
                                    <small id="filter-notifier" class="label bg-blue blink"></small>
                                </p>
                            </div>
                            <div class="box-body" style="">
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
                        </div>
                    </div>


                </div>
            @endforeach

            <div class="col-md-12">
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                            <p class="no-margin">
                                12. Planter & Miller's Share
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                            </p>
                        </div>
                        <div class="box-body" style="">
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
                                            (isset($details_arr['form1'][$f->field])) ? $details_arr['form1'][$f->field]->prev_value : null
                                            ) !!}
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                @php
                    $a = 'prices';
                @endphp
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                            <p class="no-margin">
                                13. Mill District Price Monitoring
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-success add_btn" style="background-color: #e3e3e3" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>
                        </div>
                        <div class="box-body" style="">
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
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                        <p class="no-margin">
                            14. Sugar Distribution Factor
                            <small id="filter-notifier" class="label bg-blue blink"></small>
                        </p>
                    </div>
                    <div class="box-body" style="">
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
                </div>
            </div>
            <div class="col-md-12">
                @php
                    $a = 'seriesNos';
                @endphp
                <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                        <p class="no-margin">
                            15. Quedan Issuances Series & No. of PCS.
                            <small id="filter-notifier" class="label bg-blue blink"></small>
                            <button class="btn btn-xs pull-right btn-success add_btn" style="background-color: #e3e3e3" data="form1_raw_sugar_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>
                        </p>
                    </div>
                    <div class="box-body" style="">
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

            <div class="col-md-12">
                <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                        <p class="no-margin">
                            Remarks
                            <small id="filter-notifier" class="label bg-blue blink"></small>
                        </p>
                    </div>
                    <div class="box-body" style="">
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][text][remarks]',[
                                'label' => 'Remarks:',
                                'cols' => 12,
                                'container_class' => 'data_form1_text_remarks',
                            ],
                            (isset($details_arr['form1']['remarks'])) ? $details_arr['form1']['remarks']->text_value : null
                            ) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<hr>

