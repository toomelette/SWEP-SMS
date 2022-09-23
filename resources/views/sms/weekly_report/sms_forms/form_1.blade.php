<form id="form_1">@csrf
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                {!! \App\Swep\ViewHelpers\__form2::select('crop_year',[
                    'label' => 'Crop Year:*',
                    'cols' => 12,
                    'options' => \App\Swep\Helpers\Arrays::cropYears(),
                ]) !!}
                {!! \App\Swep\ViewHelpers\__form2::textbox('week_ending',[
                    'label' => 'Week Ending:*',
                    'cols' => 12,
                    'type' => 'date',
                ]) !!}
                {!! \App\Swep\ViewHelpers\__form2::textbox('report_no',[
                    'label' => 'Report No.:*',
                    'cols' => 12,
                    'type' => 'number',
                    'step' => 1,
                ]) !!}
                {!! \App\Swep\ViewHelpers\__form2::textbox('dist_no',[
                    'label' => 'Week Ending:*',
                    'cols' => 12,
                    'type' => 'number',
                    'step' => 1,
                ]) !!}
            </div>
        </div>
        <div class="col-md-9">
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
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[current][manufactured]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'children_current_manufactured',
                                ]) !!}
                            </td>
                            <td>
                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[prev][manufactured]',[
                                    'class' => 'autonumber_mt',
                                    'autocomplete' => 'off',
                                    'container_class' => 'children_prev_manufactured',
                                ]) !!}
                            </td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                        2. Issuances/Carried-over
                        <button class="btn btn-xs pull-right btn-success add_btn" data="raw_sugar_issuances" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>
                    <table class="table table-bordered table-condensed sms_form1_table" id="raw_sugar_issuances">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('sms.dynamic_rows.raw_sugar_issuances')
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                        3. Withdrawals
                        <button class="btn btn-xs pull-right btn-success add_btn" data="raw_sugar_withdrawals" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>
                    <table class="table table-bordered table-condensed sms_form1_table" id="raw_sugar_withdrawals">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @include('sms.dynamic_rows.raw_sugar_withdrawals')
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                        4. Balance
                        <button class="btn btn-xs pull-right btn-success add_btn" data="raw_sugar_balance" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>
                    <table class="table table-bordered table-condensed sms_form1_table" id="raw_sugar_balance">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Current Crop</th>
                            <th>Previous Crop</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('sms.dynamic_rows.raw_sugar_balance')
                        </tbody>
                    </table>
                </div>
                @php
                $fn = \App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_5_to_11')
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
                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[current]['.$f->field.']',[
                                        'class' => 'text-right autonumber_mt',
                                        'container_class' => 'children_current_'.$f->field,
                                    ]) !!}
                                </td>
                                <td>
                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[prev]['.$f->field.']',[
                                        'class' => 'text-right autonumber_mt',
                                        'container_class' => 'children_prev_'.$f->field,
                                    ]) !!}
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
                        $fn = \App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_share')
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
                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[current]['.$f->field.']',[
                                        'class' => 'text-right autonumber_mt',
                                        'container_class' => 'children_current_'.$f->field,
                                    ]) !!}
                                </td>
                                <td>
                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[prev]['.$f->field.']',[
                                        'class' => 'text-right autonumber_mt',
                                        'container_class' => 'children_prev_'.$f->field,
                                    ]) !!}
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                        13. Mill District Price Monitoring
                    </p>
                    @php
                        $fn = \App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_price_monitoring')
                    @endphp
                    <div class="row">
                        @foreach($fn as $f)
                            {!! \App\Swep\ViewHelpers\__form2::textbox($f->field,[
                                'label' => $f->display_name.':',
                                'cols' => 2,
                                'class' => 'autonumber'
                            ]) !!}
                        @endforeach
                    </div>

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
                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('wholesale_raw',[]) !!}
                                </td>
                                <td>
                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('retail_raw',[]) !!}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>REFINED</td>
                                <td>
                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('wholesale_refined',[]) !!}
                                </td>
                                <td>
                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('retail_refined',[]) !!}
                                </td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="row">
                       <div class="col-md-6">
                           <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                               14. Sugar Distribution Factor
                           </p>
                           <div class="row">
                               {!! \App\Swep\ViewHelpers\__form2::textbox('dist_factor',[
                                   'label' => 'Sugar Distribution Factor:',
                                   'cols' => 12,
                               ]) !!}
                           </div>
                       </div>
                        <div class="col-md-6">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                15. Remarks
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('remarks',[
                                    'label' => 'Remarks:',
                                    'cols' => 12,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary pull-right" type="submit"><i class=" fa fa-check"></i> Submit Form 1</button>
        </div>
    </div>
</form>
