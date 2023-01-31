@php
$rand = \Illuminate\Support\Str::random();
@endphp
<tr>
    <td>
        <div class="row" style="padding-left: 20px">
            <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-danger removeBtn"><i class="fa fa-times"></i></button>
            </div>
            <div class="small-select2">
                {!! \App\Swep\ViewHelpers\__form2::selectOnly('subsidiaries['.$transactionType.'][warehouses]['.$rand.']',[
                    'options' => [],
                    'class' => 'text-right input-sm selectWarehouse_'.$rand .' select2Warehouses',
                    'cols' => 10 ,
                    'container_class' => 'no-margin dynamic-select',
                    'for' => $sugarType,
                ],
                $data->warehouseAlias ?? null
                ) !!}
            </div>
        </div>
    </td>
    @if(request()->ajax())
        <td>
            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('subsidiaries['.$transactionType.'][current]['.$rand.']',[
                'class' => 'global-form-changer text-right input-sm autonumber_mt_'.$rand,
            ],
            $data->current ?? null) !!}
        </td>
        <td>
            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('subsidiaries['.$transactionType.'][prev]['.$rand.']',[
                'class' => 'global-form-changer text-right input-sm autonumber_mt_'.$rand,
            ],
            $data->prev ?? null) !!}
        </td>

        @else
        <td>
            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('subsidiaries['.$transactionType.'][current]['.$rand.']',[
                'class' => 'global-form-changer text-right input-sm autonumber_mt'
            ],
            $data->current ?? null) !!}
        </td>
        <td>
            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('subsidiaries['.$transactionType.'][prev]['.$rand.']',[
                'class' => 'global-form-changer text-right input-sm autonumber_mt'
            ],
            $data->prev ?? null) !!}
        </td>
    @endif
</tr>

@if(request()->ajax())
    <script>

        $(".selectWarehouse_{{$rand}}").select2({
            ajax: {
                url: '{{route('dashboard.ajax.get','myWarehouses')}}?for={{$sugarType}}&default=',
                dataType: 'json'
            }
        });

        $(".autonumber_mt_{{$rand}}").each(function(){
            new AutoNumeric(this, autonum_settings_mt);
        });
    </script>
@else
    <script>
        $(document).ready(function () {
            $(".selectWarehouse_{{$rand}}").append('<option value="{{$data->warehouseAlias}}" selected>{{$data->warehouseAlias}}</option>')
        })
    </script>
@endif