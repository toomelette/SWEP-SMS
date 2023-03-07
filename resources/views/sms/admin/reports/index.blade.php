@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Reports</h1>
    </section>
@endsection
@section('content2')

    <section class="content">
        <div class="box box-solid">
            <div class="box-body">
                <div class="panel" hidden>
                    <div class="box box-sm box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                            <p class="no-margin"><i class="fa fa-filter"></i> Advanced Filters <small id="filter-notifier" class="label bg-blue blink"></small></p>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool advanced_filters_toggler" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="box-body" style="display: none">
                            <form id="filter_form">
                                <div class="row">
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Status:</label>
                                        <select name="is_active" class="form-control dt_filter filters">
                                            <option value="">Don't filter</option>
                                            <option value="ACTIVE">ACTIVE</option><option value="INACTIVE">INACTIVE</option><option value="SUSPENDED">SUSPENDED</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Sex:</label>
                                        <select name="sex" class="form-control dt_filter filter_sex filters select22">
                                            <option value="">Don't filter</option>
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Location:</label>
                                        <select name="locations" class="form-control dt_filter filter_locations filters select22">
                                            <option value="">Don't filter</option>
                                            <option value="VISAYAS">VISAYAS</option><option value="LUZON/MINDANAO">LUZON/MINDANAO</option><option value="COS-VISAYAS">COS (VISAYAS)</option><option value="COS-LUZMIN">COS (LUZ/MIN)</option><option value="RETIREE">RETIREE</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>


                <div id="report_container">
                    @include('sms.admin.reports.content',[])
                </div>

            </div>

        </div>

    </section>


@endsection


@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript">
        $("body").on("click",".navigate-btn",function () {
            let btn = $(this);
            let report_no = btn.attr('report_no');
            let crop_year = btn.attr('crop_year');
            $(".navigate-btn").each(function () {
               $(this).attr('disabled','disabled');
            })
            btn.parents('#report_container').find('.nav-tabs-custom').html('<div class="text-center" style="font-size: 72px; margin: 100px"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
            btn.parents('#report_container').find('.nav-tabs-custom').removeClass('nav-tabs-custom');
            $.ajax({
                url : '{{route("dashboard.reports.index")}}?type=getContent',
                data : {'report_no' :  report_no, 'crop_year' : crop_year},
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("#report_container").html(res);
                },
                error: function (res) {
             
                }
            })
        })

        $("body").on("click",".print-btn",function () {
            let t = $(this);
            t.parents('.tab-pane').find('iframe').get(0).contentWindow.print();
        })
    </script>
@endsection