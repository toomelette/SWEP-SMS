<script type="text/javascript">
    active_form5_deliveries = '';
    $(document).ready(function () {
        setTimeout(function () {



        },400)
    })


    function __2Form5Deliveries(){
        window.deliveries_tbl = $("#form5_deliveries_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form5_deliveries.index")}}?weekly_report_slug={{$wr->slug}}',
            "columns": [
                { "data": "sro_no" },
                { "data": "trader" },
                { "data": "start_of_withdrawal" },
                { "data": "sugar_class" },
                { "data": "qty" },
                { "data": "action"}
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 5,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'action4'
                },
            ],
            "order":[[0,'desc']],
            "responsive": true,
            "initComplete": function( settings, json ) {
                $("#waitBar .progress-bar").css('width','20%');
                $("#waitText span").html('Preparing Form 5');
                __3Form5Issuance();
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form5_deliveries != ''){
                    $("#form5_deliveries_table #"+active_form5_deliveries).addClass('success');
                }
            }
        });
        style_datatable("#form5_deliveries_table");
    }


    $("#form5_add_delivery_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form5_deliveries.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,true,false);
                active_form5_deliveries = res.slug;
                deliveries_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })


</script>