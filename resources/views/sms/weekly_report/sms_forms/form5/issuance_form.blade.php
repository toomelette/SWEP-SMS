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
        'options' => \App\Models\SMS\InputFields::getFieldsAsArray('sugarClass'),
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
        'label' => 'Qty. (MT)',
        'cols' => 6,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>