@php
    $inputFields = new \App\Models\SMS\InputFields;
    $rand = \Illuminate\Support\Str::random(5);
@endphp

<tr id="tr_{{$rand}}">

    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('data[form2][options][refinedSugarWithdrawals]['.$rand.']',[
            'label' => 'A',
            'options' => $inputFields->getFieldsAsArray('refined_sugar_withdrawal'),
            'container_class' => 'data_form2_options_refinedSugarWithdrawals_'.$rand,
        ],
        (!empty($item->input_field) ? $item->input_field : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][refinedSugarWithdrawals]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form2_current_refinedSugarWithdrawals_'.$rand,
        ],
        (!empty($item->current_value) ? $item->current_value : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][refinedSugarWithdrawals]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form2_prev_refinedSugarWithdrawals_'.$rand,
        ],
        (!empty($item->prev_value) ? $item->prev_value : null)
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