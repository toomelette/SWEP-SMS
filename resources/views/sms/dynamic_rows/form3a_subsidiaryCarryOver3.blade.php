@php($rand = \Illuminate\Support\Str::random(5))
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('data[form3a][options][subsidiaryCarryOver3]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Models\SMS\InputFields::getFieldsAsArray('form3a_subsidiaryCarryOver3'),
            'container_class' => 'data_form3a_options_subsidiaryCarryOver3_'.$rand,
        ],
        (!empty($item->input_field) ? $item->input_field : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][current][subsidiaryCarryOver3]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form3a_current_subsidiaryCarryOver3_'.$rand,
        ],
        (!empty($item->current_value) ? $item->current_value : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3a][prev][subsidiaryCarryOver3]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form3a_prev_subsidiaryCarryOver3_'.$rand,
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