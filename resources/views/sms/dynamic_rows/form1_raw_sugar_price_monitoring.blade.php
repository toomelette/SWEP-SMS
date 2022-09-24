@php($rand = \Illuminate\Support\Str::random(5))
<tr id="tr_{{$rand}}">
    <td>
        {!! \App\Swep\ViewHelpers\__form2::selectOnly('children[options][prices]['.$rand.']',[
            'label' => 'A',
            'options' => \App\Http\Controllers\SMS\InputFields::getFieldsAsArray('raw_sugar_price_monitoring'),
            'container_class' => 'children_options_prices_'.$rand,
        ]) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('children[current][prices]['.$rand.']',[
            'class' => 'text-right autonumber_mt autonumber_mt_'.$rand,
            'container_class' => 'children_current_prices_'.$rand,
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