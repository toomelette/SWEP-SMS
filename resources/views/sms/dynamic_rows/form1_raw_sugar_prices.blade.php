@php($rand = \Illuminate\Support\Str::random(5))
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('data[form1][options][prices]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Models\SMS\InputFields::getFieldsAsArray('raw_sugar_prices'),
            'container_class' => 'data_form1_options_prices_'.$rand,
        ],
        (!empty($item->input_field) ? $item->input_field : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form1][current][prices]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'data_form1_current_prices_'.$rand,
        ],
        (!empty($item->current_value) ? $item->current_value : null)
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