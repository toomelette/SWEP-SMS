<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('delivery_no',[
        'label' => 'Delivery No.',
        'cols' => 4,
    ],
    (!empty($receipts)) ? $receipts : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Owner:',
        'cols' => 8,
    ],
    (!empty($receipts)) ? $receipts : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('mill_source',[
        'label' => 'Mill Source',
        'cols' => 12,
    ],
    (!empty($receipts)) ? $receipts : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('raw_sro_sn',[
        'label' => 'Raw SRO S.N.',
        'cols' => 4,
    ],
    (!empty($receipts)) ? $receipts : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('liens_or',[
        'label' => 'SRA Liens OR#:',
        'cols' => 8,
    ],
    (!empty($receipts)) ? $receipts : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
        'label' => 'Qty. (Lkg)',
        'cols' => 6,
    ],
    (!empty($receipts)) ? $receipts : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('refined_sugar_equivalent',[
        'label' => 'Refined Sugar Equivalent (Lkg)',
        'cols' => 6,
    ],
    (!empty($receipts)) ? $receipts : null
    ) !!}
</div>