@php
    $rand = \Illuminate\Support\Str::random(5);
    if(empty($sugarClass)){
        $sugarClass = '';
    }
@endphp
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('data[form1][rawIssuances][options]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Swep\Helpers\Arrays::sugarClasses(),
            'container_class' => 'data_form1_options_issuances_'.$rand,
            'class' => 'formChanger',
        ],
        (!empty($sugarClass) ? $sugarClass : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][rawIssuances][current]['.$rand.']',[
            'class' => 'formChanger text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form1_current_issuances_'.$rand,
        ],
        (!empty($data->$sugarClass) ? $data->$sugarClass : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][rawIssuances][prev]['.$rand.']',[
            'class' => 'formChanger text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form1_prev_issuances_'.$rand,
        ],
        (!empty($data->{'prev_'.$sugarClass}) ? $data->{'prev_'.$sugarClass} : null)
        ) !!}
    </td>
    <td>
        <button data="{{$rand}}" type="button" class="btn btn-danger btn-sm remove_row_btn"><i class="fa fa-times"></i></button>
    </td>
</tr>
@if(\Illuminate\Support\Facades\Request::ajax())
    <script>
        $(".autonumber_mt_{{$rand}}").each(function(){
            new AutoNumeric(this, autonum_settings_mt);
        });
    </script>
@endif