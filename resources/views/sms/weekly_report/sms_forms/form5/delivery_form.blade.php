@php($rand = \Illuminate\Support\Str::random())
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('sro_no',[
        'label' => 'SRO No.',
        'cols' => 4,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Owner:',
        'cols' => 8,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('start_of_withdrawal',[
        'label' => 'Start of Withdrawal',
        'cols' => 4,
        'type' => 'date',
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::select('sugar_class',[
        'label' => 'Sugar Class:',
        'cols' => 4,
        'options' => \App\Swep\Helpers\Arrays::sugarClasses(),
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::select('for_swapping',[
        'label' => 'For Swapping:',
        'cols' => 4,
        'options' => \App\Swep\Helpers\Arrays::sugarClassesForSwapping(),
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>
<div class="row">

    {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
        'label' => 'Qty. (MT)',
        'cols' => 5,
        'class' => 'autonumber_mt_'.$rand,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('remarks',[
        'label' => 'Remarks:',
        'cols' => 7,
    ],
    (!empty($delivery)) ? $delivery : null
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
     !empty($delivery->qty_prev) ? 'PREVIOUS' : 'CURRENT'
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::iCheckH('refining',[
        'cols' => 6,
        'label' => 'Refining:',
        'options' => [
            'forRefining' => 'For Refining',
        ]
    ],
     ($delivery->refining ?? 0 == 1) ? 'forRefining' : ''
    ) !!}
</div>


<script>
    const autonumericElement_{{$rand}} =  AutoNumeric.multiple('.autonumber_mt_{{$rand}}',autonum_settings_mt);
</script>
