@php($rand = \Illuminate\Support\Str::random(5))
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('children[options][withdrawals]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Http\Controllers\SMS\InputFields::getFieldsAsArray('raw_sugar_withdrawals'),
            'container_class' => 'children_options_withdrawals_'.$rand,
        ]) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[current][withdrawals]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'children_current_withdrawals_'.$rand,
        ]) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[prev][withdrawals]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'children_prev_withdrawals_'.$rand,
        ]) !!}
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