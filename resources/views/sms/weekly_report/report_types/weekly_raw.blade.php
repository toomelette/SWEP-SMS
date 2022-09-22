@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>{{$report_type->description}}</h1>
</section>
@endsection
@section('content2')

<section class="content">
    <div class="box box-solid">
        <form id="weekly_report_form">
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
                    <div class="col-md-3">
                        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                            1. Manufactured
                        </p>
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('manufactured',[
                            'label' => 'Manufactured:*',
                            'cols' => 12,
                        ]) !!}
                        </div>
                    </div>
                    <div class="col-md-9">
                        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                            2. Issuances/Carry-over
                        </p>
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('issuance_a',[
                                'label' => 'A Export:',
                                'cols' => 3,
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('issuance_b',[
                                'label' => 'B Domestic:',
                                'cols' => 3,
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('issuance_d',[
                                'label' => 'D World Market Sugar:',
                                'cols' => 3,
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="input-box">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                        3. Withdrawals
                    </p>
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('withdrawal_a',[
                            'label' => '"A":',
                            'cols' => 1,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('withdrawal_a_as_b',[
                            'label' => '"A" as "B":',
                            'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('withdrawal_a_as_d',[
                            'label' => '"A" as "D":',
                            'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('withdrawal_b',[
                            'label' => '"B":',
                            'cols' => 1,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('withdrawal_b_as_m',[
                            'label' => '"B" as "M":',
                            'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('withdrawal_d_to_b',[
                            'label' => '"D" to "B":',
                            'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('withdrawal_d',[
                            'label' => '"D" to "B":',
                            'cols' => 2,
                        ]) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                4. Balance
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('balance_a',[
                                    'label' => '"A":',
                                    'cols' => 4,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('balance_b',[
                                    'label' => '"B":',
                                    'cols' => 4,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('balance_d',[
                                    'label' => '"D":',
                                    'cols' => 4,
                                ]) !!}
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                5. Unqueddaned
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('unqeuddaned',[
                                    'label' => 'Unquedanned:',
                                    'cols' => 12,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                6. Stock Balance
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('stock_balance',[
                                    'label' => 'Stock Balance:',
                                    'cols' => 12,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                7. Transfers to Refinery
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('transfers_to_refinery',[
                                    'label' => 'Transfers to Refinery:',
                                    'cols' => 12,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                8. Physical Stock
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('physical_stock',[
                                    'label' => 'Physical Stock:',
                                    'cols' => 12,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                Due Cane
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('tons_due_cane',[
                                    'label' => '9. Tons Due Cane:',
                                    'cols' => 4,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('gross_tons_cane_milled',[
                                    'label' => '10. Gross Tons Cane Milled:',
                                    'cols' => 4,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('lkg_tc_gross_cane',[
                                    'label' => '11. LKG/TC (Gross):',
                                    'cols' => 4,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                Due Syrup
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('tons_due_syrup',[
                                    'label' => '12. Tons Due Syrup:',
                                    'cols' => 4,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('equivalent_gtc_milled',[
                                    'label' => '13. Equi. GTC Milled:',
                                    'cols' => 4,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('lkg_tc_gross_syrup',[
                                    'label' => '14. LKG/TC (Gross):',
                                    'cols' => 4,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                12. Planter/Miller's Share
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('share_planter',[
                                    'label' => "Planter's Share",
                                    'cols' => 6,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('share_miller',[
                                    'label' => "Miller's Share",
                                    'cols' => 6,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                13. Mill District Price Monitoring (PESO/LKg)
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_bidding',[
                                    'label' => "Date of Bidding:",
                                    'cols' => 2,
                                    'type' => 'date',
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('partial_price_a',[
                                    'label' => "A:",
                                    'cols' => 2,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('partial_price_b',[
                                    'label' => "B:",
                                    'cols' => 2,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('partial_price_c1',[
                                    'label' => "C-1:",
                                    'cols' => 2,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('partial_price_d',[
                                   'label' => "D:",
                                   'cols' => 2,
                               ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('partial_price_advance',[
                                   'label' => "Advance:",
                                   'cols' => 2,
                               ]) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 ">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                14. Sugar Disribution Factor:
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('sugar_distribution_factor',[
                               'label' => "Sugar Distribution Factor:",
                               'cols' => 12,
                            ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                15. Quedan Issuances Series & No. of Pieces):
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('issuance_series_a',[
                                   'label' => "A:",
                                   'cols' => 3,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('issuance_series_b',[
                                   'label' => "B:",
                                   'cols' => 3,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('issuance_series_d',[
                                   'label' => "D:",
                                   'cols' => 3,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('issuance_no_of_pcs',[
                                   'label' => "Total (pcs):",
                                   'cols' => 3,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                16. Cancelled Quedan Issuances Series & No. of Pieces):
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('cancelled_quedan_a',[
                                   'label' => "A:",
                                   'cols' => 3,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('cancelled_quedan_b',[
                                   'label' => "B:",
                                   'cols' => 3,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('cancelled_quedan_d',[
                                   'label' => "D:",
                                   'cols' => 3,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('cancelled_no_of_pcs',[
                                   'label' => "Total (pcs):",
                                   'cols' => 3,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                WHOLESALE (PESO/LKG)
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('wholesale_raw',[
                                    'label' => "Raw:",
                                    'cols' => 6,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('wholesale_refined',[
                                    'label' => "Refined:",
                                    'cols' => 6,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                RETAIL (PESO/KILO)
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('retail_raw',[
                                    'label' => "Raw:",
                                    'cols' => 6,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('retail_refined',[
                                    'label' => "Refined:",
                                    'cols' => 6,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-box">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                Remarks
                            </p>
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('remarks',[
                                    'label' => "Remarks:",
                                    'cols' => 12,
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer with-border">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Preview Submission</button>
            </div>
        </form>
    </div>

</section>


@endsection


@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
    $(".select2").select2({});
    $("#weekly_report_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.weekly_report.store")}}?form=RAW_SUGAR',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,false,false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>
@endsection