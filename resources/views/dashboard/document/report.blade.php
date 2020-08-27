@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Document Reports</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Reports</h3>
      </div>
      
      <div class="box-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#dissemination" data-toggle="tab">Dissemination Report</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="dissemination">
                <div class="row">
                  <div class="col-md-3">
                    <div class="well well-sm">
                      Select:
                      <form id="report_generate_form">
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label for="df">Date From *</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input id="df" name="df" value="" type="text" class="form-control datepicker" placeholder="mm/dd/yy" autocomplete="off" required="">
                            </div>
                          </div>

                          <div class="col-md-6 form-group">
                            <label for="df">Date To *</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input id="dt" name="dt" value="" type="text" class="form-control datepicker" placeholder="mm/dd/yy" autocomplete="off" required="">
                            </div>
                          </div>


                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="pull-right">
                              <button class="btn btn-success">
                                Generate
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>


                  <div class="col-md-9">
                    <div class="panel panel-default">
                      <div class="panel-heading clearfix">
                        <span style="font-weight: bold; font-size: 16px">
                          Print Preview
                        </span>
                        <button id="print_btn" class="btn btn-success btn-sm pull-right"><i class="fa fa-print"></i> Print</button>
                      </div>

                      <div id="spinner_container" style="display: none">
                          <div style="text-align:center; margin-top: 150px">
                            <i class="fa fa-spin fa-spinner" style="font-size:150px;color:#00A65A"></i>
                  
                            <p style="margin-top: 50px">Generating report...</p>
                          </div>
                        </div>


                      <div class="panel-body" style="height: 700px">
                        <div id="print_container" style="text-align: center; margin-top: 100px">
                          <i class="fa fa-print" style="font-size: 300px; color: grey; "></i>
                          <br>
                          <span class="text-info">Click <b>"Generate"</b> button to see print preview here</span>
                        </div>
                      

                        <div id="report_container" style="display: none">
                          <iframe id="report_frame" style="width: 100%; height: 650px; border: none" class="embed-responsive" src="">
                            
                          </iframe>
                        </div>

                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
      </div>
      

    </div>

  </section>

@endsection





@section('modals')


@endsection 





@section('scripts')

  <script type="text/javascript">
    $("#report_generate_form").submit(function(e){
      $("#report_container").hide();
      $("#print_container").slideUp();
      $("#spinner_container").fadeIn();
      e.preventDefault();
      data = $(this).serialize();

      url  = "{{route('dashboard.document.report_generate')}}";
      $("#report_frame").attr('src', url+"?"+data );
    })

    $("#report_frame").on("load",function(){
      $("#spinner_container").slideUp(function(){
        $("#report_container").fadeIn();
      })
    
    })

    $("#print_btn").click(function(){
      $("#report_frame").get(0).contentWindow.print();
    })
  </script> 
    
@endsection