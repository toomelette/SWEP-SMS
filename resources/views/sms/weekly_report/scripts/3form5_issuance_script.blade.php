<script type="text/javascript">
    //Initialize DataTable
    active_form5_issuancesOfSro = '';
    $(document).ready(function () {
        setTimeout(function () {


        },600)
    })

    function __3Form5Issuance(){
        window.issuancesOfSro_tbl = $("#form5_issuancesOfSro_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form5_issuanceOfSro.index")}}?weekly_report_slug={{$wr->slug}}',
            "columns": [
                { "data": "sro_no" },
                { "data": "trader" },
                { "data": "cea" },
                { "data": "date_of_issue" },
                { "data": "liens_or" },
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
                $("#waitBar .progress-bar").css('width','35%');
                $("#waitText span").html('Preparing Form 5');
                __form5ServedSro();
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form5_issuancesOfSro != ''){
                    $("#form5_issuancesOfSro_table #"+active_form5_issuancesOfSro).addClass('success');
                }
            }
        });
        style_datatable("#form5_issuancesOfSro_table");
    }

    $("#form5_add_issuance_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form5_issuanceOfSro.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,true,false);
                $('dt[for="form5TotalIssuances"]').html(res.totalForm5Issuance);
                active_form5_issuancesOfSro = res.slug;
                issuancesOfSro_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })

</script>