<div class="form-title" style="background-color: #4477a3;">
    <h4> WEEKLY REPORT ON RAW SUGAR </h4>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">1. Manufactured <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>
                @php
                    $subtotalManufactured = [
                        'current' => $wr->form1->manufactured ?? 0,
                        'prev' => $wr->form1->prev_manufactured ?? 0,
                    ]
                @endphp
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
                            <td>Manufactured</td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][manufactured][current]',[
                                    'class' => 'formChanger  manufactured autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form1_manufactured_current',
                                    'id' => 'manufactured_current'
                                ],
                                $wr->form1->manufactured ?? null
                                ) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][manufactured][prev]',[
                                    'class' => 'formChanger manufactured autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'data_form1_manufactured_prev',
                                    'id' => 'manufactured_prev'
                                ],
                                $wr->form1->prev_manufactured ?? null
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


        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        2. Issuances
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-default add_btn" style="background-color: #e3e3e3" data="form1_raw_sugar_issuances" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>

                </div>

                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed table_dynamic" id="form1_raw_sugar_issuances">
                        <thead>
                            <tr>
                                <th>Sugar Class</th>
                                <th>Current Crop</th>
                                <th>Previous Crop</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <div class="col-md-12">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        SUMMARY
                    </p>
                </div>
                <div class="box-body" style="">
                    @include('sms.weekly_report.previews.form1')
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                            <p class="no-margin">
                                Other Factory Statement Data
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                            </p>
                        </div>
                        <div class="box-body" style="">
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][tdc]',[
                                    'label' => "9. Tons Due Cane",
                                    'cols' => 4,
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_tdc',
                                ],
                                $wr->form1->tdc ?? null
                                ) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][gtcm]',[
                                    'label' => "10. Gross Tons Cane Milled",
                                    'cols' => 4,
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_gtcm',
                                ],
                                $wr->form1->gtcm ?? null
                                ) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][lkgtc_gross]',[
                                    'label' => "11. LKG/TC Gross",
                                    'cols' => 4,
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_lkgtc_gross',
                                ],
                                $wr->form1->lkgtc_gross ?? null
                                ) !!}


                                {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][sharePlanter]',[
                                    'label' => "12A. Planter's Share",
                                    'cols' => 4,
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_sharePlanter',
                                ],
                                $wr->form1->share_planter ?? null
                                ) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][shareMiller]',[
                                    'label' => "12B. Miller's Share:",
                                    'cols' => 4,
                                    'class' => 'text-right autonumber_mt',
                                    'container_class' => 'data_form1_shareMiller',
                                ],
                                $wr->form1->share_miller ?? null
                                ) !!}

                            </div>
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
                            </p>
                        </div>
                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed" id="form1_raw_sugar_{{$a}}">
                                <thead>
                                    <tr>
                                        @foreach(\App\Swep\Helpers\Arrays::sugarClasses() as $sugarClass)
                                            <th class="text-center">{{$sugarClass}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        @foreach(\App\Swep\Helpers\Arrays::sugarClasses() as $sugarClass)
                                            <td>
                                               <div class="row">
                                                   @php
                                                    $col = 'price_'.$sugarClass;
                                                   @endphp
                                                   {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][price'.$sugarClass.']',[
                                                       'label' => "Peso / LKG",
                                                       'cols' => 12,
                                                       'class' => 'text-right autonumber',
                                                       'container_class' => 'data_form1_price'.$sugarClass,
                                                   ],
                                                   $wr->form1->$col ?? null
                                                   ) !!}
                                               </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            <br>
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
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][wholesaleRaw]',[
                                               'label' => "Wholesale raw price",
                                               'cols' => 12,
                                               'class' => 'text-right autonumber',
                                               'container_class' => 'data_form1_wholesaleRaw',
                                           ],
                                           $wr->form1->wholesale_raw ?? null
                                           ) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][retailRaw]',[
                                               'label' => "Wholesale raw price",
                                               'cols' => 12,
                                               'class' => 'text-right autonumber',
                                               'container_class' => 'data_form1_retailRaw',
                                           ],
                                           $wr->form1->retail_raw ?? null
                                           ) !!}
                                    </td>

                                </tr>
                                <tr>
                                    <td>REFINED</td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][wholesaleRefined]',[
                                               'label' => "Wholesale raw price",
                                               'cols' => 12,
                                               'class' => 'text-right autonumber',
                                               'container_class' => 'data_form1_wholesaleRefined',
                                           ],
                                           $wr->form1->wholesale_refined ?? null
                                           ) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][retailRefined]',[
                                               'label' => "Wholesale raw price",
                                               'cols' => 12,
                                               'class' => 'text-right autonumber',
                                               'container_class' => 'data_form1_retailRefined',
                                           ],
                                           $wr->form1->retail_refined ?? null
                                           ) !!}
                                    </td>

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
                            {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][distFactor]',[
                            'label' => "14. Distribution Factor:",
                            'cols' => 4,
                            'class' => 'text-right autonumber_mt',
                            'container_class' => 'data_form1_distFactor',
                            ],
                            $wr->form1->dist_factor ?? null
                            ) !!}
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
                            {!! \App\Swep\ViewHelpers\__form2::textbox('data[form1][remarks]',[
                                'label' => "Remarks:",
                                'cols' => 12,
                                'class' => '',
                                'container_class' => 'data_form1_remarks',
                            ],
                            $wr->form1->remarks ?? null
                            ) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<hr>

