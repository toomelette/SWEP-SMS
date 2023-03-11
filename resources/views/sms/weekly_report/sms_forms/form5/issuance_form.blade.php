@php($rand = \Illuminate\Support\Str::random())
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('sro_no',[
        'label' => 'SRO No.',
        'cols' => 4,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Owner:',
        'cols' => 8,
        'list' => 'traders',
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('cea',[
        'label' => 'CEA/COCs, Letter Authority, Etc.',
        'cols' => 12,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_issue',[
        'label' => 'Date of issue',
        'cols' => 4,
        'type' => 'date',
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('liens_or',[
        'label' => 'Liens OR#:',
        'cols' => 8,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::select('sugar_class',[
        'label' => 'Sugar Class',
        'cols' => 6,
        'options' => \App\Swep\Helpers\Arrays::sugarClasses(),
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
        'label' => 'Qty. (LKG Bag)',
        'cols' => 6,
        'class' => 'autonumber_mt_'.$rand,
    ],
    $issuance->qty ?? $issuance->qty_prev ?? null
    ) !!}
</div>
<div class="row">

    {!! \App\Swep\ViewHelpers\__form2::iRadioH('cropCharge',[
        'cols' => 6,
        'label' => 'Crop:',
        'options' => [
            'CURRENT' => 'Current Crop',
            'PREVIOUS' => 'Previous Crop',
        ]
    ],
     !empty($issuance->qty_prev) ? 'PREVIOUS' : 'CURRENT'
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::iCheckH('refining',[
        'cols' => 6,
        'label' => 'Refining:',
        'options' => [
            'forRefining' => 'For Refining',
        ]
    ],
     ($issuance->refining ?? 0 == 1) ? 'forRefining' : ''
    ) !!}
</div>

<script>
    const autonumericElement_{{$rand}} =  AutoNumeric.multiple('.autonumber_mt_{{$rand}}',autonum_settings_mt);
</script>