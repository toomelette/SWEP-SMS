<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_issue',[
        'label' => 'Date of Issue',
        'cols' => 6,
        'type' => 'date',
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('sro_no',[
        'label' => 'Ref. SRO S.N.',
        'cols' => 6,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Tollee',
        'cols' => 8,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('raw_qty',[
        'label' => 'Raw Qty',
        'cols' => 4,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('monitoring_fee_or_no',[
        'label' => 'Monitoring Fee OR No.',
        'cols' => 4,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('rsq_no',[
        'label' => 'RSQ No.',
        'cols' => 4,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('refined_qty',[
        'label' => 'Refined Qty',
        'cols' => 4,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
