@php
    $rand = \Illuminate\Support\Str::random();
@endphp
@extends('layouts.modal-content',['form_id'=>'editWarehouseForm_'.$rand,'slug'=>$wh->slug])

@section('modal-header')
    {{$wh->alias}}
@endsection

@section('modal-body')
    <div class="row">
        <input value="{{$wh->slug}}" name="slug" hidden>
        {!! \App\Swep\ViewHelpers\__form2::textbox('alias',[
            'cols' => 12,
            'label' => 'Alias:',
        ],
        $wh ?? null) !!}

        {!! \App\Swep\ViewHelpers\__form2::textbox('name',[
            'cols' => 12,
            'label' => 'Name:',
        ],
        $wh ?? null) !!}
    </div>
@endsection

@section('modal-footer')
    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#editWarehouseForm_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            let uri = '{{route("dashboard.warehouses.update","slug")}}';
            uri = uri.replace('slug',form.attr('data'));
            $.ajax({
                url : uri,
                data : form.serialize()+'&for=RAW',
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    active_warehouseTable_{{$passedRand}} = res.slug;
                    warehousesTable_{{$passedRand}}.draw(false);
                    notify('Warehouse updated successfully.','success');
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })

    </script>
@endsection

