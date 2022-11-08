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
    $issuance->refined_qty ?? $issuance->prev_refined_qty ?? null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('liens_or',[
        'label' => 'Liens OR#:',
        'cols' => 4,
    ],
    $issuance->liens_or ?? null
    ) !!}
</div>

<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::iRadioH('consumption',[
        'cols' => 6,
        'label' => 'Domestic/Imported:',
        'options' => [
            'DOMESTIC' => 'Domestic',
            'IMPORTED' => 'Imported',
        ]
    ],
    $issuance->consumption ?? 'DOMESTIC'
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::iRadioH('cropCharge',[
        'cols' => 6,
        'label' => 'Crop:',
        'options' => [
            'CURRENT' => 'Current Crop',
            'PREVIOUS' => 'Previous Crop',
        ]
    ],
     !empty($issuance->refined_qty) ? 'CURRENT' : 'CURRENT'
    ) !!}
</div>
