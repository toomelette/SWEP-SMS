@php($rand = \Illuminate\Support\Str::random())
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_issue',[
        'label' => 'Date of Issue',
        'cols' => 6,
        'type' => 'date',
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('mro_no',[
        'label' => 'MRO No.',
        'cols' => 6,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Owner',
        'cols' => 8,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('liens_or',[
        'label' => 'Liens O.R. #',
        'cols' => 4,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('liens_or',[
        'label' => 'Liens O.R. #',
        'cols' => 4,
        'class' => 'autonumber_mt_'.$rand,
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
        'class' => 'autonumber_mt_'.$rand,
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

<script>
    const autonumericElement_{{$rand}} =  AutoNumeric.multiple('.autonumber_mt_{{$rand}}',autonum_settings_mt);
</script>
