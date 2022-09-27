<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('delivery_no',[
        'label' => 'Delivery No.',
        'cols' => 4,
    ],
    (!empty($registry)) ? $registry : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Owner:',
        'cols' => 8,
    ],
    (!empty($registry)) ? $registry : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('refined_quedan_sn',[
        'label' => 'Refined Quedan S.N.',
        'cols' => 12,
    ],
    (!empty($registry)) ? $registry : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('refined_sugar',[
        'label' => 'Refined Sugar(Lkg)',
        'cols' => 6,
    ],
    (!empty($registry)) ? $registry : null
    ) !!}
</div>