<script type="text/javascript">
    active_form5_serverSros = '';

    $(document).ready(function () {
        setTimeout(function () {
            servedSros_tbl = $("#form5_servedSros_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : '{{route("dashboard.form5_servedSros.index")}}?weekly_report_slug={{$wr->slug}}',
                "columns": [
                    { "data": "sro_no" },
                    { "data": "cea" },
                    { "data": "permit_portion" },
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
                    $("#waitBar .progress-bar").css('width','42%');
                    $("#waitText span").html('Preparing Form 5');
                },
                "language":
                    {
                        "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                    },
                "drawCallback": function(settings){
                    // console.log(servedSros_tbl.page.info().page);
                    $("#form5_servedSros_table a[for='linkToEdit']").each(function () {
                        let orig_uri = $(this).attr('href');
                        $(this).attr('href',orig_uri+'?page='+servedSros_tbl.page.info().page);
                    });

                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="modal"]').tooltip();
                    if(active_form5_serverSros != ''){
                        $("#form5_servedSros_table #"+active_form5_serverSros).addClass('success');
                    }
                }
            })

            style_datatable("#form5_servedSros_table");
        },800)
    })

    $("#form5_add_servedSro_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form5_servedSros.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,false,false);
                active_form5_serverSros = res.slug;
                servedSros_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>