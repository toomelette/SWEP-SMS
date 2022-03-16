@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id'=>'edit_item_'.$rand, 'slug' => $ppmp->slug])

@section('modal-header')
    {{$ppmp->ppmp_code}} - {{$ppmp->gen_desc}}
@endsection

@section('modal-body')
    <div class="row">
        <div class="col-md-6">
            <b>Year:</b>
            <h3 style="margin-top: 0" class="text-green">{{$ppmp->fiscal_year}}</h3>
        </div>
        <div class="col-md-6">
            <b>Responsibility Center:</b>
            <h3 style="margin-top: 0" class="text-green">{{$ppmp->resp_center}}</h3>
        </div>
    </div>
    <hr style="border: 1px dashed #1b7e5a; margin-top: 3px;margin-bottom: 5px">
    <div class="row">
        <input name="slug" value="{{$ppmp->slug}}" hidden>
        {!! \App\Swep\ViewHelpers\__form2::select('pap_code',[
            'cols' => 12,
            'label' => 'PAP/PAP Code:',
            'options' => \App\Swep\Helpers\Helper::getPapCodesArray('2022','AFD',true),
            'id' => 'pap_code_'.$rand,
        ],
        $ppmp
        ) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('ppmp_code',[
           'cols' => 4,
           'label' => 'PPMP Code:',
        ],
        $ppmp
        ) !!}
        {!! \App\Swep\ViewHelpers\__form2::select('mode_of_proc',[
            'cols' => 4,
            'label' => 'Mode of Procurement',
            'options' => \App\Swep\Helpers\Helper::modesOfProcurement(),
        ],
        $ppmp
        ) !!}
        {!! \App\Swep\ViewHelpers\__form2::select('budget_type',[
            'cols' => 4,
            'label' => 'Source of Fund',
            'options' => \App\Swep\Helpers\Helper::budgetTypes(),
        ],
        $ppmp
        ) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('gen_desc',[
            'cols' => 12,
            'label' => 'General Description',
        ],
        $ppmp
        ) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('unit_cost',[
            'cols' => 4,
            'label' => 'Unit Cost:',
            'class' => 'autonumber_'.$rand.' unit_cost_'.$rand,
            'autocomplete' => 'off',
        ],
        $ppmp
        ) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('qty',[
            'cols' => 4,
            'label' => 'Quantity:',
            'type' => 'number',
            'class' => 'qty_'.$rand,
        ],
        $ppmp
        ) !!}
        {!! \App\Swep\ViewHelpers\__form2::select('uom',[
            'cols' => 4,
            'label' => 'Unit:',
            'options' => \App\Swep\Helpers\Helper::unitsOfMeasurementPPMP(),
        ],
        $ppmp
        ) !!}
    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('total_est_budget',[
            'id' => 'total_est_budget',
            'cols' => 4,
            'label' => 'Total estimated budget:',
            'class' => 'total_est_budget',
            'readonly' => 'readonly',
        ],
        number_format($ppmp->unit_cost*$ppmp->qty,2)
        ) !!}
    </div>

    <div class="row">
        <div class="col-md-12">
            <label>Schedule/Milestone of Activities: (Must be a number)</label>
            <table class="milestone" style="width: 100%;">
                <tr class="text-center">
                    @foreach(\App\Swep\Helpers\Helper::milestones() as $month)
                        <td>{{$month}}</td>
                    @endforeach
                </tr>
                <tr>
                    @foreach(\App\Swep\Helpers\Helper::milestones() as $month)
                        <td>
                            @php($column = 'qty_'.strtolower($month))
                            <input type="text" class="no-style-input qty_{{strtolower($month)}}"  value="{{$ppmp->$column}}" name="qty_{{strtolower($month)}}" autocomplete="off">
                        </td>
                    @endforeach
                </tr>
            </table>
            <br>
        </div>

    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('remark',[
            'cols' => 12,
            'label' => 'Remark (brief description of the Program/Project):',
        ],
        $ppmp
        ) !!}
    </div>
@endsection

@section('modal-footer')
    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#edit_item_modal #pap_code_{{$rand}}").select2({
            dropdownParent : $("#edit_item_modal"),
        });

        const autonumericElement_{{$rand}} =  AutoNumeric.multiple('.autonumber_{{$rand}}');
        var unit_cost_{{$rand}} = '{{$ppmp->unit_cost}}';
        var qty_{{$rand}} = '{{$ppmp->qty}}';
        $('body').on('change','.unit_cost_{{$rand}}',function () {
            if($(this).val() != ''){
                unit_cost_{{$rand}} = $(this).val().replaceAll(',','');

            }
            let t = $(this);
            let body_parent = t.parent('div').parent('div').parent('div');
            body_parent.find('input.total_est_budget').val(formatToCurrency(unit_cost_{{$rand}}*qty_{{$rand}}));
            body_parent.find('input.total_est_budgetapp').change();
        })
        $('body').on('change','.qty_{{$rand}}',function () {
            if($(this).val() != '') {
                qty_{{$rand}} = $(this).val();
            }
            let t = $(this);
            let body_parent = t.parent('div').parent('div').parent('div');
            body_parent.find('input.total_est_budget').val(formatToCurrency(unit_cost_{{$rand}}*qty_{{$rand}}));
            body_parent.find('input.total_est_budget').change();
        })
        $("#edit_item_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            uri = "{{route('dashboard.ppmp.update','slug')}}?{!! \Illuminate\Support\Facades\Request::getQueryString() !!}";
            uri = uri.replace('slug', form.attr('data'));
            loading_btn(form);
            $.ajax({
                url : uri,
                data : form.serialize(),
                type: 'PUT',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   succeed(form,true,true);
                   active = res.slug;
                   ppmp_tbl.draw(false);
                   notify('Item successfully updated.','success');
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })

    </script>
@endsection

