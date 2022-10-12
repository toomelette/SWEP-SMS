@php
    $rand = \Illuminate\Support\Str::random(10)
@endphp
<tr>
    <td>
        <div class="row">
            <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-danger removeBtn"><i class="fa fa-times"></i></button>
            </div>
            {!! \App\Swep\ViewHelpers\__form2::selectOnly('issuances[sugarClasses]['.$rand.']',[
                'options' => \App\Swep\Helpers\Arrays::sugarClasses(),
                'class' => 'form1-input input-sm ',
                'cols' => 10 ,
                'container_class' => 'no-margin dynamic-select',
            ],
            $sugarClass ?? null
            ) !!}

        </div>

    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('issuances[currentValues]['.$rand.']',[
            'class' => 'form1-input input-sm text-right autonumber_mt autonumber_mt_'.$rand
        ],
        $current ?? null
        ) !!}
    </td>
    <td>
        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('issuances[prevValues]['.$rand.']',[
            'class' => 'form1-input input-sm text-right autonumber_mt autonumber_mt_'.$rand
        ],
        $prev ?? null
        ) !!}
    </td>
</tr>

@if(Request::ajax())
    <script>
        $(".autonumber_mt_{{$rand}}").each(function(){
            new AutoNumeric(this, autonum_settings_mt);
        });
    </script>
@endif