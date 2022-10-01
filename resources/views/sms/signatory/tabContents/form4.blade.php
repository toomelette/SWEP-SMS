@php
    $form = 'form4';
@endphp
<div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border">
                    <p class="no-margin">Mill Representative:<small id="filter-notifier" class="label bg-blue blink"></small></p>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('signatories['.$form.'][sign1][name]',[
                            'label' => 'Name:',
                            'cols' => 12,
                            'container_class' =>'signatories_'.$form.'_sign1_name',
                        ],
                        $signatories[$form]['sign1']['name'] ?? null
                        ) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('signatories['.$form.'][sign1][position]',[
                            'label' => 'Position:',
                            'cols' => 12,
                            'container_class' =>'signatories_'.$form.'_sign1_position',
                        ],
                        $signatories[$form]['sign1']['position'] ?? null
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border">
                    <p class="no-margin">VERIFIED/CERTIFIED BY: (Planters' Representative)<small id="filter-notifier" class="label bg-blue blink"></small></p>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('signatories['.$form.'][sign2][name]',[
                            'label' => 'Name:',
                            'cols' => 12,
                            'container_class' =>'signatories_'.$form.'_sign2_name',
                        ],
                        $signatories[$form]['sign2']['name'] ?? null
                        ) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('signatories['.$form.'][sign2][position]',[
                            'label' => 'Position:',
                            'cols' => 12,
                            'container_class' =>'signatories_'.$form.'_sign2_position',
                        ],
                        $signatories[$form]['sign2']['position'] ?? null
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border">
                    <p class="no-margin">VERIFIED/CERTIFIED BY: (SRA Representative)<small id="filter-notifier" class="label bg-blue blink"></small></p>
                    <div class="box-tools pull-right">
                    </div>

                </div>
                <div class="box-body" style="">
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('signatories['.$form.'][sign3][name]',[
                            'label' => 'Name:',
                            'cols' => 12,
                            'container_class' =>'signatories_'.$form.'_sign3_name',
                        ],
                        $signatories[$form]['sign3']['name'] ?? null
                        ) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('signatories['.$form.'][sign3][position]',[
                            'label' => 'Position:',
                            'cols' => 12,
                            'container_class' =>'signatories_'.$form.'_sign3_position',
                        ],
                        $signatories[$form]['sign3']['position'] ?? null
                        ) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>