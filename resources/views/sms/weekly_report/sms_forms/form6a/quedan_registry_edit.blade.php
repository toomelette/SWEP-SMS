@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id' => 'form6a_quedanRegistry_form_'.$rand,'slug'=>$registry->slug])

@section('modal-header')
    Edit Issuance
@endsection

@section('modal-body')
    @include('sms.weekly_report.sms_forms.form6a.quedan_registry_form')
@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#form6a_quedanRegistry_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.form6a_quedanRegistry.update",$registry->slug)}}',
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    active_form6a_quedanRegistry = res.slug;
                    quedanRegistry_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
    </script>
@endsection

