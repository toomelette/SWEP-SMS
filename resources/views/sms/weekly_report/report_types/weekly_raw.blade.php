@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>{{$report_type->description}}</h1>
    </section>
@endsection
@section('content2')

    <section class="content">
        <div class="box box-solid">
            <form id="weekly_report_form" data-target="#preview_entries_modal">
                @csrf
                <div class="box-header with-border">
                    <h3 class="box-title">{{$report_type->description}}</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('crop_year',[
                            'label' => 'Crop Year:*',
                            'cols' => 3,
                            'options' => \App\Swep\Helpers\Arrays::cropYears(),
                            'class' => 'select2',
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('week_ending',[
                            'label' => 'Week Ending:*',
                            'cols' => 3,
                            'type' => 'date',

                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('report_no',[
                            'label' => 'Report No.:*',
                            'cols' => 3,
                            'type' => 'number',
                            'step' => '1',
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('distribution_no',[
                            'label' => 'Distribution No.:*',
                            'cols' => 3,
                            'type' => 'number',
                            'step' => 1,
                        ]) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                1. Manufactured
                            </p>
                            <table class="table table-condensed table-bordered" id="">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>This Week (Current Crop Year)</th>
                                        <th>This Week (Previous Crop Year)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1. Manufactured</td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufactured',[
                                            'placeholder' => 'Manufactured:',
                                            'class' => 'input-sm autonumber_mt',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </td>
                                    <td>
                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufactured',[
                                            'placeholder' => 'Manufactured',
                                            'class' => 'input-sm autonumber_mt',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                2. Issuances/Carry-over
                            </p>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Sugar Class.</th>
                                            <th>This Week (Current Crop Year)</th>
                                            <th>This Week (Previous Crop Year)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_issuances') as $field)
                                            <tr>
                                                <td>{{$field->display_name}}</td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly($field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber_mt',
                                                        'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_'.$field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber_mt',
                                                         'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                3. Withdrawals
                            </p>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Sugar Class.</th>
                                            <th>This Week (Current Crop Year)</th>
                                            <th>This Week (Previous Crop Year)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_withdrawals') as $field)
                                            <tr>
                                                <td>{{$field->display_name}}</td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly($field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber_mt',
                                                        'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_'.$field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber_mt',
                                                        'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                4. Balance
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Sugar Class.</th>
                                            <th>This Week (Current Crop Year)</th>
                                            <th>This Week (Previous Crop Year)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_balance') as $field)
                                            <tr>
                                                <td>{{$field->display_name}}</td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly($field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber_mt',
                                                        'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_'.$field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber_mt',
                                                        'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                5-11: Quedanned, Stock Balance, Transfers to Refinery, etc.
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered">
                                        <tbody>
                                        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_5_to_11') as $field)
                                            <tr>
                                                <td>{{$field->prefix}} {{$field->display_name}}</td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly($field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber_mt',
                                                        'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_'.$field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber_mt',
                                                        'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                12. Planter's and Miller's Share
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered">
                                        <tbody>
                                        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_share') as $field)
                                            <tr>
                                                <td>{{$field->display_name}}</td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly($field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm',
                                                    ]) !!}
                                                </td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_'.$field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm',
                                                    ]) !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                13. Mill District Price Monitoring
                            </p>

                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-condensed table-bordered">
                                        <thead>

                                        </thead>
                                        <tbody>
                                        @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_price_monitoring') as $field)
                                            <tr>
                                                <td>{{$field->display_name}}</td>
                                                <td>
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly($field->field,[
                                                        'placeholder' => $field->display_name,
                                                        'class' => 'input-sm autonumber',
                                                        'autocomplete' => 'off',
                                                    ]) !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-box">
                                        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                            Wholesale
                                        </p>
                                        <table class="table table-condensed table-bordered">
                                            <tbody>
                                            @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_price_monitoring_wholesale') as $field)
                                                <tr>
                                                    <td>{{$field->display_name}}</td>
                                                    <td>
                                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly($field->field,[
                                                            'placeholder' => $field->display_name,
                                                            'class' => 'input-sm',
                                                        ]) !!}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                            Retail
                                        </p>
                                        <table class="table table-condensed table-bordered">
                                            <tbody>
                                            @foreach(\App\Http\Controllers\SMS\InputFields::getFields('raw_sugar_price_monitoring_retail') as $field)
                                                <tr>
                                                    <td>{{$field->display_name}}</td>
                                                    <td>
                                                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly($field->field,[
                                                            'placeholder' => $field->display_name,
                                                            'class' => 'input-sm',
                                                        ]) !!}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                        14. Sugar Distribution Factor
                                    </p>

                                    <div class="row">
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('sugar_distribution_factor',[
                                       'label' => "Sugar Distribution Factor:",
                                       'cols' => 12,
                                    ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold">
                                        15. Remarks
                                    </p>

                                    <div class="row">
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('sugar_distribution_factor',[
                                       'label' => "Remarks:",
                                       'cols' => 12,
                                    ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer with-border">
                    <button type="submit" class="btn btn-primary pull-right" ><i class="fa fa-check"></i> Preview Submission</button>
                </div>
            </form>
        </div>

    </section>


@endsection


@section('modals')
    <div class="modal fade" id="preview_entries_modal" tabindex="-1" role="dialog" aria-labelledby="oreview_entries_modal_label">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm before submission</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(".select2").select2({});
        $("#weekly_report_form").submit(function (e) {
            e.preventDefault();
            $("#preview_entries_modal").modal('show');
            let form = $(this);
            loading_btn(form);
            load_modal2(form);
            $.ajax({
                url : '{{route("dashboard.weekly_report_raw.store")}}?form=RAW_SUGAR',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(form,res);
                    remove_loading_btn(form);
                },
                error: function (res) {
                    populate_modal2_error(res);
                }
            })
        })
    </script>
@endsection