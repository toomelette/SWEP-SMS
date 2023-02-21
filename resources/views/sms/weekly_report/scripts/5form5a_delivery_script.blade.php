<script type="text/javascript">
    active_form5a_deliveries = '';
    $(document).ready(function () {
        setTimeout(function () {



        },1000)
    })

    function __5Form5aDeliveries(){
        window.form5a_deliveries_tbl = $("#form5a_deliveries_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form5a_deliveries.index")}}?weekly_report_slug={{$wr->slug}}',
            "columns": [
                { "data": "date_of_withdrawal" },
                { "data": "sro_no" },
                { "data": "trader" },
                { "data": "qty_standard" },
                { "data": "qty_premium" },
                { "data": "qty_total" },
                { "data": "remarks" },
                { "data": "action"}
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 6,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'action2'
                },
                {
                    'targets' : [3,4,5],
                    'class' : 'text-right',
                }
            ],
            "order":[[0,'desc']],
            "responsive": true,
            "initComplete": function( settings, json ) {
                $("#waitBar .progress-bar").css('width','50%');
                $("#waitText span").html('Creating tables');
                __6Form5aIssuance();
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                $("dt[for='form5aTotalStandard']").html(settings.json.totals.totalDeliveries.qty_standard);
                $("dt[for='form5aTotalPremium']").html(settings.json.totals.totalDeliveries.qty_premium);
                $("dt[for='form5aTotalDelivery']").html(settings.json.totals.totalDeliveries.total);
                $("#form5a_deliveries_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+form5a_deliveries_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form5a_deliveries != ''){
                    $("#form5a_deliveries_table #"+active_form5a_deliveries).addClass('success');
                }
            }
        });
        style_datatable("#form5a_deliveries_table");
    }


    $("#form5a_add_delivery_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form5a_deliveries.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,true,false);
                active_form5a_deliveries = res.slug;
                form5a_deliveries_tbl.draw(false);
                updateTradersList();
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })

    

</script>