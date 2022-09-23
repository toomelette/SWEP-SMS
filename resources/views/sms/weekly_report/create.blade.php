@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Weekly Report Submission</h1>
</section>
@endsection
@section('content2')

<section class="content">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Report:</h3>
        </div>
        <div class="box-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">SMS Form 1</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Dropdown <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @include('sms.weekly_report.sms_forms.form_1')
                    </div>

                    <div class="tab-pane" id="tab_2">
                        The European languages are members of the same family. Their separate existence is a myth.
                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                        new common language would be desirable: one could refuse to pay expensive translators. To
                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                        words. If several languages coalesce, the grammar of the resulting language is more simple
                        and regular than that of the individual languages.
                    </div>

                    <div class="tab-pane" id="tab_3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>

                </div>

            </div>
        </div>

    </div>

</section>


@endsection


@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
    $(".add_btn").click(function () {
        let btn = $(this);
        let data = btn.attr('data');
        let uri = '{{route("dashboard.ajax.get","for")}}';
        uri = uri.replace('for',data);
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                console.log(res);
                $("#"+data+" tbody").append(res);
            },
            error: function (res) {
                notify(res.responseJSON.message,'danger');
            }
        });
    })
    $("body").on("click",'.remove_row_btn',function () {
        let btn = $(this);
        let data = btn.attr('data');
        $("#tr_"+data).remove();
    })

    $("#form_1").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let uri = '{{route("dashboard.sms_form1.store")}}';
        $.ajax({
            url : uri,
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,false,false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>

@endsection