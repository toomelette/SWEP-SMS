<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('mro_no',[
        'label' => 'MRO No.:',
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

    {!! \App\Swep\ViewHelpers\__form2::textbox('pcs',[
        'label' => 'No. of pcs of Quedan:',
        'cols' => 12,
    ],
    (!empty($servedSro)) ? $servedSro : null
    ) !!}
</div>