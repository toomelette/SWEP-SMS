<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('sro_no',[
        'label' => 'SRO No.:',
        'cols' => 12,
    ],
    (!empty($servedSro)) ? $servedSro : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader:',
        'cols' => 12,
    ],
    (!empty($servedSro)) ? $servedSro : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('quedan_pcs',[
        'label' => 'No. of pcs of Quedan:',
        'cols' => 12,
    ],
    (!empty($servedSro)) ? $servedSro : null
    ) !!}
</div>