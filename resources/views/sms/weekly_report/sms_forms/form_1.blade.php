<form id="form1">
    <div class="form-title" style="background-color: #4477a3;">
        <h4>  WEEKLY REPORT ON RAW SUGAR
        </h4>
    </div>
    <hr class="no-margin">
    <div class="row">
        <div class="col-md-12"><button type="submit" class="btn btn-primary btn-sm pull-right">Save as Draft</button></div>
    </div><br>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered preview-table" id="form1PreviewTable" style="transition: background-color 0.2s linear;">
                <thead>
                <tr>
                    <th></th>
                    <th>Current Crop</th>
                    <th>Previous Crop</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-strong">1. MANUFACTURED</td>
                        <td>
                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufactured',[
                                'class' => 'form1-input input-sm text-right autonumber_mt'
                            ],
                            $wr->form1->manufactured ?? null
                            ) !!}
                        </td>
                        <td>
                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufactured',[
                                'class' => 'form1-input input-sm text-right autonumber_mt'
                            ],
                            $wr->form1->prev_manufactured ?? null) !!}
                        </td>
                    </tr>
                    <tr class="issuanceTr">
                        <td colspan="3" class="text-strong">
                            2. ISSUANCES/CARRY-OVER
                            <button class="btn btn-xs btn-success pull-right" id="addIssuanceButton" type="button"><i class="fa fa-plus"></i> ADD</button>
                        </td>
                    </tr>
                    @foreach(\App\Swep\Helpers\Arrays::sugarClasses() as $sugarClass)
                        @if(!empty($wr->form1->$sugarClass) || !empty($wr->form1->{'prev_'.$sugarClass}))
                            @include('sms.dynamic_rows.form1Issuances',[
                                'sugarClass' => $sugarClass,
                                'current' => $wr->form1->$sugarClass,
                                'prev' => $wr->form1->{'prev_'.$sugarClass},
                            ])
                         @endif
                    @endforeach
                    <tr for="issuancesTotal" class="totalIssuanceTr computation">
                        <td class="text-strong text-right">
                            TOTAL
                        </td>
                        <td class="text-strong text-right"></td>
                        <td class="text-strong text-right"></td>
                    </tr>

                    <tr class="withdrawals">
                        <td colspan="3" class="text-strong">
                           3. WITHDRAWALS
                        </td>
                    </tr>

                    <tr for="withdrawalsTotal" class="computation">
                        <td class="text-strong text-right">
                            TOTAL
                        </td>
                        <td class="text-right text-strong"></td>
                        <td class="text-right text-strong"></td>
                    </tr>

                    <tr class="">
                        <td colspan="3" class="text-strong">
                           4. BALANCES
                        </td>
                    </tr>

                    <tr for="balancesTotal" class="computation">
                        <td class="text-strong text-right">
                            TOTAL
                        </td>
                        <td class="text-right text-strong"></td>
                        <td class="text-right text-strong"></td>
                    </tr>


                    <tr for="unquedanned" class="computation">
                        <td class="text-strong">
                            5. UNQUEDANNED
                        </td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                    </tr>
                    <tr for="stockBalance" class="computation">
                        <td class="text-strong">
                            6. STOCK BALANCE
                        </td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                    </tr>

                    <tr for="transfersToRefinery" class="computation">
                        <td class="text-strong">
                            7. TRANSFERS TO REFINERY
                        </td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                    </tr>
                    <tr for="physicalStock" class="computation">
                        <td class="text-strong">
                           8. PHYSICAL STOCK
                        </td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                    </tr>
                </tbody>
            </table>
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
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('tdc',[
                                        'label' => "9. Tons Due Cane",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right autonumber_mt',
                                        'container_class' => 'tdc',
                                    ],
                                    $wr->form1->tdc ?? null
                                    ) !!}
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('gtcm',[
                                        'label' => "10. Gross Tons Cane Milled",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right autonumber_mt',
                                        'container_class' => 'gtcm',
                                    ],
                                    $wr->form1->gtcm ?? null
                                    ) !!}
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('lkgtcGross',[
                                        'label' => "11. LKG/TC Gross",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right',
                                        'container_class' => 'lkgtc_gross',
                                        'readonly' => 'readonly',
                                    ],
                                    $wr->form1->lkgtc_gross ?? null
                                    ) !!}


                                    {!! \App\Swep\ViewHelpers\__form2::textbox('sharePlanter',[
                                        'label' => "12A. Planter's Share",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right autonumber_mt',
                                        'container_class' => 'sharePlanter',
                                    ],
                                    $wr->form1->share_planter ?? null
                                    ) !!}
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('shareMiller',[
                                        'label' => "12B. Miller's Share:",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right autonumber_mt',
                                        'container_class' => 'shareMiller',
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
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('price'.$sugarClass,[
                                                        'label' => "Peso / LKG",
                                                        'cols' => 12,
                                                        'class' => 'text-right autonumber',
                                                        'container_class' => 'price'.$sugarClass,
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
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('wholesaleRaw',[
                                                   'label' => "Wholesale raw price",
                                                   'cols' => 12,
                                                   'class' => 'text-right autonumber',
                                                   'container_class' => 'wholesaleRaw',
                                               ],
                                               $wr->form1->wholesale_raw ?? null
                                               ) !!}
                                        </td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('retailRaw',[
                                                   'label' => "Wholesale raw price",
                                                   'cols' => 12,
                                                   'class' => 'text-right autonumber',
                                                   'container_class' => 'retailRaw',
                                               ],
                                               $wr->form1->retail_raw ?? null
                                               ) !!}
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>REFINED</td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('wholesaleRefined',[
                                                   'label' => "Wholesale raw price",
                                                   'cols' => 12,
                                                   'class' => 'text-right autonumber',
                                                   'container_class' => 'wholesaleRefined',
                                               ],
                                               $wr->form1->wholesale_refined ?? null
                                               ) !!}
                                        </td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('retailRefined',[
                                                   'label' => "Wholesale raw price",
                                                   'cols' => 12,
                                                   'class' => 'text-right autonumber',
                                                   'container_class' => 'retailRefined',
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
                                {!! \App\Swep\ViewHelpers\__form2::textbox('distFactor',[
                                'label' => "14. Distribution Factor:",
                                'cols' => 4,
                                'class' => 'text-right autonum_distFactor',
                                'container_class' => 'distFactor',
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
                                {!! \App\Swep\ViewHelpers\__form2::textbox('remarks',[
                                    'label' => "Remarks:",
                                    'cols' => 12,
                                    'class' => '',
                                    'container_class' => 'remarks',
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
</form>