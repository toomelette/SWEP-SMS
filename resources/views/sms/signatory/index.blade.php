@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Signatories</h1>
    </section>
@endsection
@section('content2')

    <section class="content">
        <form id="signatories_form">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Form 1</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Form 2</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Form 3</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Form 4</a></li>
                    <li><a href="#tab_4a" data-toggle="tab">Form 4A</a></li>
                    <li><a href="#tab_5" data-toggle="tab">Form 5</a></li>
                    <li><a href="#tab_5a" data-toggle="tab">Form 5A</a></li>
                    <li><a href="#tab_6a" data-toggle="tab">Form 6A</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="form-title" style="background-color: #4477a3;">
                            <h4> WEEKLY REPORT ON RAW SUGAR </h4>
                        </div>
                        @include('sms.signatory.tabContents.form1')
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="form-title" style="background-color: #4e984a;">
                            <h4>  WEEKLY REPORT ON REFINED SUGAR
                            </h4>
                        </div>
                        @include('sms.signatory.tabContents.form2')
                    </div>
                    <div class="tab-pane" id="tab_3">
                        <div class="form-title" style="background-color: #4e984a;">
                            <h4>  WEEKLY REPORT ON MOLASSESS
                            </h4>
                        </div>
                        @include('sms.signatory.tabContents.form3')
                    </div>

                    <div class="tab-pane" id="tab_4">
                        <div class="form-title" style="background-color: #6c565a;">
                            <h4>  MILLSITE &amp; SUBSIDIARY WAREHOUSE INVENTORY REPORT - RAW
                            </h4>
                        </div>
                        @include('sms.signatory.tabContents.form4')
                    </div>
                    <div class="tab-pane" id="tab_4a">
                        <div class="form-title" style="background-color: #b3885a;">
                            <h4>  MILLSITE &amp; SUBSIDIARY WAREHOUSE INVENTORY REPORT - REFINED
                            </h4>
                        </div>
                        @include('sms.signatory.tabContents.form4a')
                    </div>

                    <div class="tab-pane" id="tab_5">
                        <div class="form-title" style="background-color: #4477a3;">
                            <h4> SUGAR RELEASE ORDER AND DELIVERY REPORT - RAW
                            </h4>
                        </div>
                        @include('sms.signatory.tabContents.form5')
                    </div>
                    <div class="tab-pane" id="tab_5a">
                        <div class="form-title" style="background-color: #4477a3;">
                            <h4> SUGAR RELEASE ORDER AND DELIVERY REPORT - REFINED
                            </h4>
                        </div>
                        @include('sms.signatory.tabContents.form5a')
                    </div>

                    <div class="tab-pane" id="tab_6a">
                        <div class="form-title" style="background-color: #4477a3;">
                            <h4> QUEDAN REGISTRY
                            </h4>
                        </div>
                        @include('sms.signatory.tabContents.form6a')
                    </div>

                    <hr style="margin: 5px 0px">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-check"></i> Save</button>
                        </div>

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
        $("#signatories_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.signatories.store")}}',
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