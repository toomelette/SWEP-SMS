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
        'label' => 'Sugar Class',
        'cols' => 8,
        'options' => \App\Models\SMS\InputFields::getFieldsAsArray('raw_sugar_withdrawals'),
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>
<div class="row">

    {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
        'label' => 'Qty. (MT)',
        'cols' => 8,
    ],
    (!empty($delivery)) ? $delivery : null
    ) !!}
</div>