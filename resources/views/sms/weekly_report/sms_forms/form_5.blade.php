<div class="form-title" style="background-color: #4477a3;">
    <h4> SUGAR RELEASE ORDER AND DELIVERY REPORT - RAW
    </h4>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">Issuances of SRO <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>

                <div class="box-body" style="">
                    <div class="row">
                        <div class="col-md-10">
                            <dl>
                                <dd>TOTAL:</dd>
                                <dt  for="form5TotalIssuances">{{number_format($wr->form5IssuancesOfSro()->sum('qty'),3)}}</dt>
                            </dl>
                        </div>
                        <div class="col-md-2">
                            <button type="button" data-target="#add_issuances_modal" data-toggle="modal" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Issuances</button>
                        </div>
                    </div>
                    <table style="width: 100%;" class="table table-condensed table-bordered" id="form5_issuancesOfSro_table">
                        <thead>
                        <tr>
                            <th>SRO No.</th>
                            <th>Trader/Owner</th>
                            <th>CEAs, COCs, Etc.</th>
                            <th>Date of Issue</th>
                            <th>Liens OR</th>
                            <th>Sugar Class</th>
                            <th>QTY (MT)</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border" style="background-color: #4e984a;color: white;">
                    <p class="no-margin">Delivery<small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>

                <div class="box-body" style="">
                    <button type="button" data-target="#add_delivery_modal" data-toggle="modal" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Delivery</button>
                    <br>
                    <br>
                    <table style="width: 100%;" class="table table-condensed table-bordered" id="form5_deliveries_table">
                        <thead>
                        <tr>
                            <th>SRO No.</th>
                            <th>Trader/Owner</th>
                            <th>Start of W/drawal</th>
                            <th>Sugar Class</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border" style="background-color: #ac7123;color: white;">
                    <p class="no-margin">Served SRO<small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>

                <div class="box-body" style="">
                    <button type="button" data-target="#add_servedSro_modal" data-toggle="modal" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Served SRO</button>
                    <br>
                    <br>
                    <table style="width: 100%;" class="table table-condensed table-bordered" id="form5_servedSros_table">
                        <thead>
                        <tr>
                            <th>SRO No.</th>
                            <th>CEAs, COCs, Letter Authority, etc.</th>
                            <th>Permit Portion No. of Pcs</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>