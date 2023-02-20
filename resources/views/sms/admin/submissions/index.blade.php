@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <div class="row">
        <div class="col-md-6">
            <h3 class="no-margin">Weekly Submitted SMS</h3>
        </div>
        <div class="col-md-6">
            <div class="form-group pull-right no-margin" >
                <select class="form-control select-type">
                    <option disabled selected>SELECT TYPE</option>
                    <option value="year">YEARLY</option>
                    <option value="month">MONTHLY</option>
                </select>
            </div>
        </div>
    </div>


</section>
@endsection

@section('content2')

    {!! $content2 !!}

@endsection



@section('modals')
    {!! \App\Swep\ViewHelpers\__html::blank_modal('show_report_modal','80') !!}
@endsection

@section('scripts')
<script type="text/javascript">
    $("body").on("click",".show_report_btn",function () {
        let btn = $(this);
        load_modal3(btn);
        let uri = '{{route("dashboard.submissions.show","slug")}}';
        uri = uri.replace('slug',btn.attr('data'));
        $.ajax({
            url : uri,
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                populate_modal2(btn,res);
            },
            error: function (res) {
                populate_modal2_error(res);
            }
        })
    })
    $('body').on('click','.navigate-btn',function () {
        let btn = $(this);
        $.ajax({
            url : '{{route("dashboard.submissions.index")}}',
            data : {month: btn.attr('data')},
            type: 'GET',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                $("div.content-wrapper .content").remove();
                $("div.content-wrapper").append(res.content2);
            },
            error: function (res) {
         
            }
        })
    })
    $("body").on("change",'.select-type',function () {
        let t = $(this).val();
        window.location = '{{route("dashboard.submissions.index")}}?type='+t;
    })
</script>
@endsection