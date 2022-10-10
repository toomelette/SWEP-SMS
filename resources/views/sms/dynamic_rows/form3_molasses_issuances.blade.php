@php($rand = \Illuminate\Support\Str::random(5))
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('data[form3][options][issuances]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Models\SMS\InputFields::getFieldsAsArray('molasses_issuances'),
            'container_class' => 'data_form3_options_issuances_'.$rand,
        ],
        (!empty($item->input_field) ? $item->input_field : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][current][issuances]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form3_current_issuances_'.$rand,
        ],
        (!empty($item->current_value) ? $item->current_value : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][prev][issuances]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form3_prev_issuances_'.$rand,
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
