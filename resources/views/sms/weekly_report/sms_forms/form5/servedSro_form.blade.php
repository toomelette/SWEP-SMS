<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('sro_no',[
        'label' => 'SRO No.',
        'cols' => 12,
    ],
    (!empty($servedSro)) ? $servedSro : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('cea',[
        'label' => 'CEAs, COCs, Letter Authority, etc.',
        'cols' => 12,
    ],
    (!empty($servedSro)) ? $servedSro : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('permit_portion',[
        'label' => 'Permit Portion No. of Pcs',
        'cols' => 12,
    ],
    (!empty($servedSro)) ? $servedSro : null
    ) !!}
</div>