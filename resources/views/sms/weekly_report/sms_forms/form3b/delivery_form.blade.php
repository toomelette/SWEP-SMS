@php($rand = \Illuminate\Support\Str::random())
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('date',[
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
        'list' => 'traders',
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
    $delivery->withdrawal_type ?? ''
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
     $delivery->sugar_type ?? 'RAW'
    ) !!}


    {!! \App\Swep\ViewHelpers\__form2::iRadioH('cropCharge',[
        'cols' => 6,
        'label' => 'Crop:',
        'options' => [
            'CURRENT' => 'Current Crop',
            'PREVIOUS' => 'Previous Crop',
        ]
    ],
     !empty($delivery->qty_current) ? 'CURRENT' : 'PREVIOUS'
    ) !!}

</div>

<script>
    const autonumericElement_{{$rand}} =  AutoNumeric.multiple('.autonumber_mt_{{$rand}}',autonum_settings_mt);
</script>