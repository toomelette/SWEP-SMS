<script type="text/javascript">
    active_form3b_issuance = '';
    $(document).ready(function () {
        setTimeout(function () {



        },1200)
    })

    function __8Form3bIssuance(){
        window.form3b_issuance_tbl = $("#form3b_issuance_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form3b_issuanceOfSro.index")}}?weekly_report_slug={{$wr->slug}}',
            "columns": [
                { "data": "date_of_issue" },
                { "data": "mro_no" },
                { "data": "trader" },
                { "data": "liens_or" },
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
                    "class" : 'action2'
                },
                {
                    "targets" : 4,
                    "class" : 'text-right',
                }
            ],
            "order":[[0,'desc']],
            "responsive": true,
            "initComplete": function( settings, json ) {
                $("#waitBar .progress-bar").css('width','86%');
                $("#waitText span").html('Initializing form tables');
                __82Form3bDeliveries();
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                // console.log(servedSros_tbl.page.info().page);
                $("#form3b_issuance_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+form3b_issuance_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form3b_issuance != ''){
                    $("#form3b_issuance_table #"+active_form3b_issuance).addClass('success');
                }
            }
        });
        style_datatable("#form3b_issuance_table");
    }

    $("#form3b_add_issuance_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form3b_issuanceOfSro.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,true,false);
                active_form3b_issuance = res.slug;
                form3b_issuance_tbl.draw(false);
                updateTradersList();
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>