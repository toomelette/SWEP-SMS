@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>My Permission Slips</h1>
    </section>
@endsection
@section('content2')

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">BOX TITLE</h3>
            </div>
            <div class="panel">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="false" class="collapsed">
                            <i class="fa fa-filter"></i>  Advanced Filters <i class=" fa  fa-angle-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="advanced_filters" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-1 col-sm-2 col-lg-2">
                                <label>Sex:</label>
                                <select name="scholars_table_length" aria-controls="scholars_table" class="form-control input-sm filter_sex filters">
                                    <option value="">All</option>
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                BOX CONTENT

            </div>
            <div id="tbl_loader" style="display: none;">
                <center>
                    <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                </center>
            </div>
            <!-- /.box-body -->

        </div>

    </section>


@endsection


@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection