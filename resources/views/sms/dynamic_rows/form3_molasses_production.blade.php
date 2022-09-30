@php($rand = \Illuminate\Support\Str::random(5))
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('data[form3][options][production]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Models\SMS\InputFields::getFieldsAsArray('molasses_production'),
            'container_class' => 'data_form3_options_production_'.$rand,
        ],
        (!empty($item->input_field) ? $item->input_field : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][current][production]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form3_current_production_'.$rand,
        ],
        (!empty($item->current_value) ? $item->current_value : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][prev][production]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form3_prev_production_'.$rand,
        ],
        (!empty($item->prev_value) ? $item->prev_value : null)
        ) !!}
    </td>
    <td>
        <button data="{{$rand}}" type="button" class="btn btn-danger btn-sm remove_row_btn"><i class="fa fa-times"></i></button>
    </td>
</tr>
<script>
    $(".autonumber_mt_{{$rand}}").each(function(){
        new AutoNumeric(this, autonum_settings_mt);
    });
</script>
