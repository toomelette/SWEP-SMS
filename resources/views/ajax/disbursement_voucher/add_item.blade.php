@php

@endphp
<div class="row">
    {!! \App\Swep\ViewHelpers\__form2::select('resp_center['.$rand.']',
        [
            'label' => 'Resp Center',
            'cols' => 3,
            'options' => \App\Swep\Helpers\Helper::populateOptionsFromObjectAsArray($rcs,'name','name'),
            'container_class' => 'resp_center_'.$rand,
        ]
        ,(!empty($detail->resp_center)) ? $detail->resp_center : ''
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('mfo_pap['.$rand.']',
        [
            'label' => 'MFO/PAP',
            'cols' => 4,
            'container_class' => 'mfo_pap_'.$rand,
        ]
        ,(!empty($detail->mfo_pap)) ? $detail->mfo_pap : ''
    ) !!}
    {!! \App\Swep\ViewHelpers\__form2::textbox('amount['.$rand.']',
        [
            'label' => 'Amount',
            'cols' => 4,
            'class' => 'autonum amount_'.$rand,
            'container_class' => 'amount_'.$rand,
        ]
        ,(!empty($detail->amount)) ? $detail->amount : ''
    ) !!}
    <div class="col-md-1">
        <button type="button" class="btn btn-sm btn-danger remove_item_btn" style="margin-top: 25px"><i class="fa fa-times"></i></button>
    </div>
</div>