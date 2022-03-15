@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>PPMP</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">PPMP</h3>
                <div class="pull-right">

                </div>
            </div>

            <div class="panel">
                <div class="box-header with-border">
                    <h4 class="box-title">

                    </h4>
                </div>

                <div class="box-body">
                    <div class="col-lg-4">
                        <label>PAP CODE:</label>
                        <select name="papp_code" aria-controls="scholars_table" class="form-control input-sm">
                            <option value="001">001</option>
                            <option value="002">002</option>
                            <option value="003">003</option>
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label>MODE OF PROCUREMENT:</label>
                        <select name="papp_code" aria-controls="scholars_table" class="form-control input-sm">
                            <option value="smallValueProcurement">SMALL VALUE PROCUREMENT</option>
                            <option value="bidding">BIDDING</option>
                            <option value="repeatOrder">REPEAT ORDER</option>
                            <option value="shopping">SHOPPING</option>
                            <option value="directContracting">DIRECT CONTRACTING</option>
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label>SOURCE OF FUND:</label>
                        <select name="sourceOfFund" aria-controls="scholars_table" class="form-control input-sm">
                            <option value="cob">COB</option>
                        </select>
                    </div>

                    <div class="mt-10">
                        {!! __form::textbox(
                           '6', 'description', 'text', 'Description', 'Description', old('description'), $errors->has('description'), $errors->first('description'), 'data-transform="uppercase"'
                        ) !!}
                        <div class="col-lg-3">
                            <label>UNIT</label>
                            <select name="unit" aria-controls="scholars_table" class="form-control input-sm">
                                <option value="pc">PC</option>
                            </select>
                        </div>
                        {!! __form::textbox(
                           '3', 'qty', 'text', 'Quantity', 'Quantity', old('qty'), $errors->has('qty'), $errors->first('qty'), 'data-transform="uppercase"'
                        ) !!}
                        {!! __form::textbox(
                           '3', 'unitCost', 'text', 'Unit Cost', 'Unit Cost', old('unitCost'), $errors->has('unitCost'), $errors->first('unitCost'), 'data-transform="uppercase"'
                        ) !!}
                        {!! __form::textbox(
                           '3', 'totalEstimatedBudget', 'text', 'Total Estimated Budget', 'Total Estimated Budget', old('totalEstimatedBudget'), $errors->has('totalEstimatedBudget'), $errors->first('totalEstimatedBudget'), 'data-transform="uppercase"'
                        ) !!}
                        <div class="col-lg-3" style="margin-top: 28px">
                            <button id="add_row" type="button" class="btn btn-sm bg-green ">Add <i class="fa fw fa-plus"></i></button>
                        </div>

                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Save <i class="fa fa-fw fa-save"></i></button>
                </div>

            </div>
        </div>
    </section>

@endsection


@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript">

    </script>

@endsection