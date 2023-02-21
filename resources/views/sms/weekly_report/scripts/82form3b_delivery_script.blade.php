<script type="text/javascript">
    active_form3b_deliveries = '';
    $(document).ready(function () {
        setTimeout(function () {



        },1000)
    })

    function __82Form3bDeliveries(){
        window.form3b_deliveries_tbl = $("#form3b_deliveries_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form3b_deliveries.index")}}?weekly_report_slug={{$wr->slug}}',
            "columns": [
                { "data": "date_of_withdrawal" },
                { "data": "mro_no" },
                { "data": "date_of_withdrawal" },
                { "data": "qty" },
                { "data": "remarks" },
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
                $("#waitBar .progress-bar").css('width','93%');
                $("#waitText span").html('Initializing form tables');
                __82Form3bServedSro();
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                // console.log(form3b_deliveries_tbl.page.info().page);
                $("#form3b_deliveries_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+form3b_deliveries_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form3b_deliveries != ''){
                    $("#form3b_deliveries_table #"+active_form3b_deliveries).addClass('success');
                }
            }
        });
        style_datatable("#form3b_deliveries_table");
    }


    $("#form3b_add_delivery_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form3b_deliveries.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,true,false);
                active_form3b_deliveries = res.slug;
                form3b_deliveries_tbl.draw(false);
                updateTradersList();
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })



</script>