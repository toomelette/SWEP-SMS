@php($rand = \Illuminate\Support\Str::random(5))
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('children[options][issuances]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Http\Controllers\SMS\InputFields::getFieldsAsArray('raw_sugar_issuances'),
            'container_class' => 'children_option_issuances_'.$rand,
        ]) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[current][issuances]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'children_current_issuances_'.$rand,
        ]) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[prev][issuances]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'children_prev_issuances_'.$rand,
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
