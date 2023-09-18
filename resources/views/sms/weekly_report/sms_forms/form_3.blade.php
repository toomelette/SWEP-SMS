<div class="form-title" style="background-color: #4e984a;">
    <h4>  WEEKLY REPORT ON MOLASSES
    </h4>
</div>
<form id="form3">
    <button type="submit" hidden>Submit</button>
    <table class="table table-bordered preview-table" id="form3PreviewTable">
        <thead>
        <tr>
            <th></th>
            <th>Current Crop</th>
            <th>Previous Crop</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="3" class="text-strong">1. PRODUCTION</td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 1.1 Manufactued, Raw</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufacturedRaw',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->manufacturedRaw ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufacturedRaw',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_manufacturedRaw ?? null) !!}
            </td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 1.2 Retention, Adj., Overages, etc.</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('rao',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->rao ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_rao',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_rao ?? null) !!}
            </td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 1.3 Manufactued, Refined</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufacturedRefined',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->manufacturedRefined ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufacturedRefined',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_manufacturedRefined ?? null) !!}
            </td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 1.4 Retention, Adj., Overages, etc. - Refined</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('raoRefined',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->rao ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_raoRefined',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_rao ?? null) !!}
            </td>
        </tr>
        <tr class="computation" for="totalProduction">
            <td class="text-right text-strong">
                TOTAL
            </td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong">2. ISSUANCES/CARRY-OVER</td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 2.1 Planter's Share</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('sharePlanter',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->sharePlanter ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_sharePlanter',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_sharePlanter ?? null) !!}
            </td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 2.2 Mill Share</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('shareMiller',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->shareMiller ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_shareMiller',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_shareMiller ?? null) !!}
            </td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 2.3 Refinery Molasses</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('refineryMolasses',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->refineryMolasses ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_refineryMolasses',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_refineryMolasses ?? null) !!}
            </td>
        </tr>
        <tr class="computation" for="totalIssuances">
            <td class="text-right text-strong">
                TOTAL
            </td>
            <td class="text-strong text-right"></td>
            <td class="text-strong text-right"></td>
        </tr>




        <tr>
            <td colspan="3" class="text-strong">3. WITHDRAWALS</td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong"><span class="indent"></span> RAW</td>
        </tr>

        <tr class="computation" for="totalWithdrawalsRaw">
            <td class="text-right">
                <i>TOTAL RAW</i>
            </td>
            <td class="text-right"></td>
            <td class="text-right"></td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong"><span class="indent"></span> REFINED</td>
        </tr>

        <tr class="computation" for="totalWithdrawalsRefined">
            <td class="text-right">
                <i>TOTAL REFINED</i>
            </td>
            <td class="text-right"></td>
            <td class="text-right"></td>
        </tr>
        <tr class="computation" for="totalWithdrawals">
            <td class="text-right text-strong">
                TOTAL WITHDRAWALS
            </td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr class="computation" for="notCoveredByMsc">
{{--        <tr>--}}
            <td class="text-strong">
                4. NOT COVERED BY MSC
            </td>
            <td class="text-strong text-right"></td>
            <td class="text-right except">
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_notCoveredByMsc',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_notCoveredByMsc ?? null) !!}
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong">5. BALANCE</td>
        </tr>

        <tr class="computation" for="balanceRaw">
            <td> <span class="indent"></span>
                5.1 Raw
            </td>
            <td class="text-right"></td>
            <td class="text-right"></td>
        </tr>

        <tr class="computation" for="balanceRefined">
            <td> <span class="indent"></span>
                5.2 Refined
            </td>
            <td class="text-right"></td>
            <td class="text-right"></td>
        </tr>

        <tr class="computation" for="totalBalance">
            <td class="text-right text-strong">
                TOTAL BALANCE
            </td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        </tbody>
    </table>



    <div class="callout callout-default">
        <h4>NOTICE!</h4>
        <p>Withdrawals of Molasses were transferred to <b>FORM 3B DELIVERIES</b></p>
    </div>


    <div class="box box-sm box-default box-solid">
        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
            <p class="no-margin">
                7. Molasses Price:
                <small id="filter-notifier" class="label bg-blue blink"></small>
            </p>
        </div>
        <div class="box-body" style="">
            <div class="row">
                <div class="col-md-4">

                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('price',[
                            'label' => 'Price:',
                            'cols' => 12,
                            'class' => 'form3-input autonum',
                        ],
                        $wr->form3->price ?? null
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-md-12">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        6. Molasses Storage Certificates
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-success add_seriesNos_btn" for="MOLASSES" style="background-color: #e3e3e3" data="form3SeriesNos" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed table_dynamic" id="form3SeriesNos">
                        <thead>
                        <tr>
                            <th>RAW/REF</th>
                            <th>Series From</th>
                            <th>Series To</th>
                            <th>Sugar Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($seriesNos['MOLASSES']))
                            @foreach($seriesNos['MOLASSES'] as $seriesNo)
                                @include('sms.dynamic_rows.insertSeriesNos',[
                                    'for' => 'MOLASSES',
                                    'seriesNo' => $seriesNo,
                                ])
                            @endforeach
                        @else
                            @include('sms.dynamic_rows.insertSeriesNos',[
                                    'for' => 'MOLASSES',
                                ])
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


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
                        {!! \App\Swep\ViewHelpers\__form2::textbox('distFactor',[
                            'label' => 'Molasses Distribution Factor:',
                            'cols' => 12,
                            'class' => 'form3-input',
                        ],
                        $wr->form3->distFactor ?? null
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    'label' => 'Remarks:',
                    'cols' => 12,
                    'class' => 'form3-input',
                ],
                $wr->form3->remarks ?? null
                ) !!}
            </div>
        </div>
    </div>

</form>