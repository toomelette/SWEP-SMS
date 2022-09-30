@php($rand = \Illuminate\Support\Str::random(5))
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('data[form3][series][options]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Models\SMS\InputFields::getFieldsAsArray('form3_seriesNos'),
            'container_class' => 'data_form3_series_options_'.$rand,
        ],
        (!empty($item->input_field) ? $item->input_field : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][series][seriesFrom]['.$rand.']',[
            'class' => '',
            'container_class' => 'data_form3_series_seriesFrom_'.$rand,
        ],
        (!empty($item->series_from) ? $item->series_from : null)
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form3][series][seriesTo]['.$rand.']',[
            'class' => '',
            'container_class' => 'data_form3_series_seriesTo_'.$rand,
        ],
        (!empty($item->series_to) ? $item->series_to : null)
        ) !!}
    </td>
    <td>
        <button data="{{$rand}}" type="button" class="btn btn-danger btn-sm remove_row_btn"><i class="fa fa-times"></i></button>
    </td>
</tr>
