@php($rand = \Illuminate\Support\Str::random())
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_withdrawal',[
        'label' => 'Date of Withdrawal',
        'cols' => 6,
        'type' => 'date',
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('mro_no',[
        'label' => 'MRO:',
        'cols' => 6,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>

<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Tollee:',
        'cols' => 12,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>

<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
        'label' => 'Qty (M.T.):',
        'cols' => 6,
        'class' => 'autonumber_mt_'.$rand,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('remarks',[
        'label' => 'Remarks:',
        'cols' => 6,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>



<div class="row" style="display:none;">
    {!! \App\Swep\ViewHelpers\__form2::iRadioH('consumption',[
        'cols' => 6,
        'label' => 'Domestic/Imported:',
        'options' => [
            'DOMESTIC' => 'Domestic',
            'IMPORTED' => 'Imported',
        ]
    ],
    $delivery->consumption ?? 'DOMESTIC'
    ) !!}


    {!! \App\Swep\ViewHelpers\__form2::iRadioH('chargeTo',[
        'cols' => 6,
        'label' => 'Crop:',
        'options' => [
            'CURRENT' => 'Current',
            'PREVIOUS' => 'Previous',
        ]
    ],
     (!empty($delivery->qty_prev)) ? 'PREVIOUS' : 'CURRENT'
    ) !!}


</div>

<script>
    const autonumericElement_{{$rand}} =  AutoNumeric.multiple('.autonumber_mt_{{$rand}}',autonum_settings_mt);
</script>