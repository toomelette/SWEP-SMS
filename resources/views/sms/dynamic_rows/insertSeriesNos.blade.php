
@php
    $rand = \Illuminate\Support\Str::random(5);
        switch ($for){
            case  'RAW':
                $options = \App\Swep\Helpers\Arrays::sugarClasses();
                break;
            case 'REFINED':
                $options = \App\Swep\Helpers\Arrays::form2SugarClasses();
                break;
            case 'MOLASSES':
                $options = \App\Swep\Helpers\Arrays::form3SugarClasses();
                break;
            default:
                $options = [];
                break;
        }
@endphp
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('seriesNos[sugarClass]['.$rand.']',[
            'label' => 'A',
            'options' => $options,
            'class' => 'input-sm global-form-changer',
            'container_class' => 'data_form1_series_options_'.$rand,
        ],
        $seriesNo->sugarClass ?? null
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('seriesNos[seriesFrom]['.$rand.']',[
            'class' => 'input-sm global-form-changer',
            'container_class' => 'data_form1_series_seriesFrom_'.$rand,
        ],
        $seriesNo->seriesFrom ?? null
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('seriesNos[seriesTo]['.$rand.']',[
            'class' => 'input-sm global-form-changer',
            'container_class' => 'data_form1_series_seriesTo_'.$rand,
        ],
        $seriesNo->seriesTo ?? null
        ) !!}
    </td>
    @if($for == 'MOLASSES')
        <td>
            {!! \App\Swep\ViewHelpers\__form2::selectOnly('seriesNos[sugarType]['.$rand.']',[
                'label' => 'A',
                'options' => \App\Swep\Helpers\Arrays::sugarTypes(),
                'class' => 'input-sm global-form-changer',
                'container_class' => 'data_form1_series_options_'.$rand,
            ],
            $seriesNo->sugarType ?? null
            ) !!}
        </td>
    @endif
    <td>
        <button data="{{$rand}}" type="button" class="btn btn-danger btn-sm remove_row_btn"><i class="fa fa-times"></i></button>
    </td>
</tr>
