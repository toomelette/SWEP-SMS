@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>PRICE MONITORING</h1>
</section>
@endsection
@section('content2')

<section class="content">
    <form id="add_price_form">
        <div class="box box-solid">

            <div class="box-body">
                <div id="notif-banner">

                </div>

                <div class="row">
                    {!! \App\Swep\ViewHelpers\__form2::textbox('store',[
                        'label' => 'Store:',
                        'cols' => '2',

                    ]) !!}

                    {!! \App\Swep\ViewHelpers\__form2::select('geog_loc',[
                        'label' => 'Geographic Location:',
                        'cols' => '2',
                        'options' => \App\Swep\Helpers\Arrays::geogLocs(),
                    ]) !!}

                    {!! \App\Swep\ViewHelpers\__form2::textbox('retail_raw',[
                        'label' => 'Retail Raw:',
                        'cols' => '2 col-xs-6 col-sm-6',
                        'class' => 'autonumber'
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('retail_refined',[
                        'label' => 'Retail Refined:',
                        'cols' => '2 col-xs-6 col-sm-6',
                        'class' => 'autonumber'
                    ]) !!}

                    {!! \App\Swep\ViewHelpers\__form2::textbox('wholesale_raw',[
                        'label' => 'Wholesale Raw:',
                        'cols' => '2 col-xs-6 col-sm-6',
                        'class' => 'autonumber'
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox('wholesale_refined',[
                        'label' => 'Wholesale Refined:',
                        'cols' => '2 col-xs-6 col-sm-6',
                        'class' => 'autonumber'
                    ]) !!}
                </div>
            </div>
            <hr class="no-margin">
            <div class="row">
                <div class="form-group col-md-12">

                    <button style="margin: 10px" class="btn btn-sm btn-primary pull-right" type="submit"><i class="fa fa-check"></i> Save</button>
                </div>
            </div>

        </div>
    </form>
</section>


@endsection


@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
    $("#add_price_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.market_price.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                $("#notif-banner").html(res);
                form.get(0).reset();
                unwait_button('#add_price_form','save');
            },
            error: function (res) {
                errored(form,res);
                console.log(res);
            }
        })

    })
</script>
@endsection