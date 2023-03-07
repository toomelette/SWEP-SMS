<div class="row">
    <div class="col-md-6">
        <h4 class="no-margin">{{\Illuminate\Support\Facades\Request::get('crop_year')}} | Report No.: <b>{{\Illuminate\Support\Facades\Request::get('report_no')}}</b></h4>
    </div>
    <div class="col-md-6">
        <div class="btn-group pull-right">
            <button type="button" report_no="{{\Illuminate\Support\Facades\Request::get('report_no') - 1}}" crop_year="{{\Illuminate\Support\Facades\Request::get('crop_year')}}" class="navigate-btn btn btn-default btn-sm"><i class="fa fa-arrow-left"></i></button>
            <button type="button" report_no="{{\Illuminate\Support\Facades\Request::get('report_no') + 1}}" crop_year="{{\Illuminate\Support\Facades\Request::get('crop_year')}}" class="navigate-btn btn btn-default btn-sm"><i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">RAW PROD., W/D & STOCK BALANCES</a></li>
        <li><a href="#tab_3" data-toggle="tab" >REF PROD., W/D & STOCK BALANCES</a></li>
        <li><a href="#tab_2" data-toggle="tab">MOL PROD., W/D & STOCK BALANCES</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary pull-right print-btn" style="margin-bottom: 10px"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="bs-example" id="printFrameContainer_DhGgDnhT5ZzBP7C8" hidden="" style="display: block;">
                <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
                    <iframe  class="embed-responsive-item iframe" src="{{route('dashboard.recap.raw1')}}?report_no={{\Illuminate\Support\Facades\Request::get('report_no')}}&crop_year={{\Illuminate\Support\Facades\Request::get('crop_year')}}">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_2">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary pull-right print-btn" style="margin-bottom: 10px"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="bs-example" id="printFrameContainer_DhGgDnhT5ZzBP7C8" hidden="" style="display: block;">
                <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
                    <iframe id="printFrame_DhGgDnhT5ZzddBP7C8" class="embed-responsive-item" src="{{route('dashboard.recap.molPWS')}}?report_no={{\Illuminate\Support\Facades\Request::get('report_no')}}&crop_year={{\Illuminate\Support\Facades\Request::get('crop_year')}}">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_3">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary pull-right print-btn" style="margin-bottom: 10px"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            <div class="bs-example" id="printFrameContainer_DhGgDnhT5ZzBP7C8" hidden="" style="display: block;">
                <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
                    <iframe id="printFrame_DhGgDnhT5ZzddBP7C8" class="embed-responsive-item" src="{{route('dashboard.recap.refPWS')}}?report_no={{\Illuminate\Support\Facades\Request::get('report_no')}}&crop_year={{\Illuminate\Support\Facades\Request::get('crop_year')}}">
                    </iframe>
                </div>
            </div>
        </div>

    </div>

</div>