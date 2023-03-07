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
        <li><a href="#tab_2" data-toggle="tab">MOL PROD., W/D & STOCK BALANCES</a></li>
        <li style="display: none"><a href="#tab_3" data-toggle="tab" >Tab 3</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="bs-example" id="printFrameContainer_DhGgDnhT5ZzBP7C8" hidden="" style="display: block;">
                <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
                    <iframe id="printFrame_DhGgDnhT5ZzBP7C8" class="embed-responsive-item" src="{{route('dashboard.recap.raw1')}}?report_no={{\Illuminate\Support\Facades\Request::get('report_no')}}&crop_year={{\Illuminate\Support\Facades\Request::get('crop_year')}}">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_2">
            <div class="bs-example" id="printFrameContainer_DhGgDnhT5ZzBP7C8" hidden="" style="display: block;">
                <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
                    <iframe id="printFrame_DhGgDnhT5ZzddBP7C8" class="embed-responsive-item" src="{{route('dashboard.recap.molPWS')}}?report_no={{\Illuminate\Support\Facades\Request::get('report_no')}}&crop_year={{\Illuminate\Support\Facades\Request::get('crop_year')}}">
                    </iframe>
                </div>
            </div>
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