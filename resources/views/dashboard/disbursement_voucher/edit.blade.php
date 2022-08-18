@php($rand = \Illuminate\Support\Str::random(15))
@extends('layouts.modal-content',['form_id'=>'edit_dv_form_'.$rand,'slug'=>$dv->slug])

@section('modal-header')
    {!! \Illuminate\Support\Str::limit(strip_tags($dv->explanation),50,'...')!!} - {{$type}}
@endsection

@section('modal-body')

    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::select('project_id',[
            'label' => 'Station:',
            'cols' => 2,
            'options' => \App\Swep\Helpers\Helper::stations(),
        ],$dv) !!}

        {!! \App\Swep\ViewHelpers\__form2::select('fund_source',[
            'label' => 'Fund source:',
            'cols' => 2,
            'options' => \App\Swep\Helpers\Helper::budgetTypes(),
        ],$dv) !!}

        {!! \App\Swep\ViewHelpers\__form2::select('mode_of_payment',[
           'label' => 'Fund source:',
           'cols' => 3,
           'options' => __static::dv_mode_of_payment(),
       ],$dv) !!}


        {!! \App\Swep\ViewHelpers\__form2::textbox('mode_of_payment_specify',[
            'label' => 'If OTHERS, Specify:',
            'cols' => 5,
        ],$dv) !!}

    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('payee',[
            'label' => 'Payee *:',
            'cols' => 4,
        ],$dv) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('tin',[
            'label' => 'TIN:',
            'cols' => 2,
        ],$dv) !!}

        {!! \App\Swep\ViewHelpers\__form2::textbox('bur_no',[
            'label' => 'BUR No:',
            'cols' => 2,
        ],$dv) !!}

        {!! \App\Swep\ViewHelpers\__form2::textbox('address',[
            'label' => 'Address:',
            'cols' => 4,
        ],$dv) !!}

    </div>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textarea('explanation',[
            'label' => 'Particular: *:',
            'cols' => 12,
            'id' => 'editor_'.$rand,
        ],$dv) !!}
    </div>

    @php($rcs = \App\Models\RC::query()->get())

    <div class="row">
        <div class="col-md-6">
            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;padding-bottom:8px">
                Charging
                <button type="button" class="pull-right btn btn-xs btn-success add_charging_btn"><i class="fa fa-plus"></i> Add</button>
            </p>
            <div class="wrapping" id="wrapping_{{$rand}}">
                @if(!empty($dv->details))
                    @foreach($dv->details as $detail)
                        @include('ajax.disbursement_voucher.add_item',['rand' => \Illuminate\Support\Str::random(5), 'detail'=>$detail])
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                        Certified by (Supervisor)
                    </p>
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('certified_supervisor',[
                            'label' => 'Certified by: (Supervisor):',
                            'cols' => 6,
                        ],$dv) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('certified_supervisor_position',[
                            'label' => 'Position:',
                            'cols' => 6,
                        ],$dv) !!}
                    </div>
                </div>

                <div class="col-md-12">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                        Certified by
                    </p>
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('certified_by',[
                            'label' => 'Certified by:*',
                            'cols' => 6,
                            'extra_attr' => 'data-transform="uppercase" list="certified_list"',
                        ],$dv) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('certified_by_position',[
                            'label' => 'Position*:',
                            'cols' => 6,
                            'extra_attr' => 'data-transform="uppercase" list="certified_list_position"',
                        ],$dv) !!}

                    </div>
                </div>
                <div class="col-md-12">
                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                        Approved by
                    </p>
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('approved_by',[
                            'label' => 'Approved for payment by:*',
                            'cols' => 6,
                            'extra_attr' => 'data-transform="uppercase" list="approved_list"',
                        ],$dv) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('approved_by_position',[
                            'label' => 'Position:*',
                            'cols' => 6,
                            'extra_attr' => 'data-transform="uppercase" list="approved_list_position"',
                        ],$dv) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        const autonumericElement_{{$rand}} =  AutoNumeric.multiple('#wrapping_{{$rand}} .autonum');
        $(document).ready(function () {
            $(function () {
                CKEDITOR.replace('editor_{{$rand}}');
            });
        })


        {!! __js::ajax_select_to_select(
              'department_name', 'department_unit_name', '/api/department_unit/select_departmentUnit_byDeptName/', 'name', 'description'
            ) !!}

        {!! __js::ajax_select_to_select(
          'department_name', 'project_code', '/api/project_code/select_projectCode_byDeptName/', 'project_code', 'project_code'
        ) !!}

        $(".select2_{{$rand}}").select2({
            dropdownParent: $('#edit_dv_modal')
        });

        {!! \App\Swep\ViewHelpers\__js::autonum('autonum_'.$rand) !!}

        $("#edit_dv_form_{{$rand}}").submit(function (e) {
            for ( instance in CKEDITOR.instances )
                CKEDITOR.instances[instance].updateElement();

            e.preventDefault()
            var form = $(this);
                    @if($type == 'Edit')
            var uri = '{{route("dashboard.disbursement_voucher.update","slug")}}';
            uri = uri.replace("slug",form.attr('data'));
                    @php($request_type = 'PUT')
                    @elseif($type == 'Save as')
            var uri = '{{route("dashboard.disbursement_voucher.store")}}';
            @php($request_type = 'POST')
            @endif
            loading_btn(form);
            $.ajax({
                url : uri,
                data : form.serialize(),
                type: '{{$request_type}}',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    notify('Data successfully saved.','success');
                    active = res.slug;
                    dvs_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                    console.log(res);
                }
            })
        })
    </script>
@endsection

