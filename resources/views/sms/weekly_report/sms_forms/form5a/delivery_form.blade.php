<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_withdrawal',[
        'label' => 'Date of Withdrawal',
        'cols' => 6,
        'type' => 'date',
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('sro_no',[
        'label' => 'Ref. SRO S.N.:',
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
    {!! \App\Swep\ViewHelpers\__form2::textbox('qty_standard',[
        'label' => 'Qty Standard:',
        'cols' => 6,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('qty_premium',[
        'label' => 'Qty Premium:',
        'cols' => 6,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>

<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('remarks',[
        'label' => 'Remarks:',
        'cols' => 12,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>