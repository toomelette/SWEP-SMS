<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('date',[
        'label' => 'Date',
        'cols' => 6,
        'type' => 'date',
    ],
    (!empty($withdrawal)) ? $withdrawal : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('mro_no',[
        'label' => 'MRO #',
        'cols' => 6,
    ],
    (!empty($withdrawal)) ? $withdrawal : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Tollee',
        'cols' => 8,
    ],
    (!empty($withdrawal)) ? $withdrawal : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
        'label' => 'Raw Qty',
        'cols' => 4,
    ],
    (!empty($withdrawal)) ? $withdrawal : null
    ) !!}
</div>

<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::iRadioH('withdrawal_type',[
        'cols' => 12,
        'label' => 'Domestic/Imported:',
        'options' => [
            'EXPORT' => 'Export',
            'DOMESTIC' => 'Domestic',
            'DISTILLERY' => 'Distillery',
            'OTHERS' => 'Others',
        ]
    ],
    $withdrawal->withdrawal_type ?? ''
    ) !!}
</div>

<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::iRadioH('type',[
        'cols' => 6,
        'label' => 'Type:',
        'options' => [
            'RAW' => 'Raw',
            'REFINED' => 'Refined',
        ]
    ],
     $withdrawal->sugar_type ?? 'RAW'
    ) !!}


    {!! \App\Swep\ViewHelpers\__form2::iRadioH('cropCharge',[
        'cols' => 6,
        'label' => 'Crop:',
        'options' => [
            'CURRENT' => 'Current Crop',
            'PREVIOUS' => 'Previous Crop',
        ]
    ],
     !empty($withdrawal->qty_current) ? 'CURRENT' : 'PREVIOUS'
    ) !!}

</div>