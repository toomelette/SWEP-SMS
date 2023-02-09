<script type="text/javascript">
    active_form3b_serverSros = '';

    $(document).ready(function () {
        setTimeout(function () {



        },1400)
    })

    function __82Form3bServedSro(){
        window.form3b_servedSros_tbl = $("#form3b_servedSros_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form3b_servedSros.index")}}?weekly_report_slug={{$wr->slug}}',
            "columns": [
                { "data": "mro_no" },
                { "data": "trader" },
                { "data": "pcs" },
                { "data": "action"}
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 3,
                    "orderable" : false,
                    "searchable": false,
                    "class" : 'action4'
                },
            ],
            "order":[[0,'desc']],
            "responsive": true,
            "initComplete": function( settings, json ) {
                $("#waitBar .progress-bar").css('width','98%');
                $("#waitText span").html('Getting ready.');
                lastInit();
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                // console.log(form3b_servedSros_tbl.page.info().page);
                $("#form3b_servedSros_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+form3b_servedSros_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form3b_serverSros != ''){
                    $("#form3b_servedSros_table #"+active_form3b_serverSros).addClass('success');
                }
            }
        });
        style_datatable("#form3b_servedSros_table");
    }

    $("#form3b_add_servedSro_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form3b_servedSros.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,true,false);
                active_form3b_serverSros = res.slug;
                form3b_servedSros_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>