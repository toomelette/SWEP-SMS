@php($rand = \Illuminate\Support\Str::random())
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_issue',[
        'label' => 'Date of Issue',
        'cols' => 6,
        'type' => 'date',
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('mro_no',[
        'label' => 'MRO No.',
        'cols' => 6,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[
        'label' => 'Trader/Owner',
        'cols' => 8,
        'list' => 'traders',
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::textbox('liens_or',[
        'label' => 'Liens O.R. #',
        'cols' => 4,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}
</div>
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
        'label' => 'Qty (MT) #',
        'cols' => 4,
        'class' => 'autonumber_mt_'.$rand,
    ],
    (!empty($issuance)) ? $issuance : null
    ) !!}

    {!! \App\Swep\ViewHelpers\__form2::iRadioH('type',[
        'cols' => 8,
        'label' => 'Type:',
        'options' => [
            'RAW' => 'Raw',
            'REFINED' => 'Refined',
        ]
    ],
     $issuance->type ?? 'RAW'
    ) !!}

</div>




<script>
    const autonumericElement_{{$rand}} =  AutoNumeric.multiple('.autonumber_mt_{{$rand}}',autonum_settings_mt);
</script>
