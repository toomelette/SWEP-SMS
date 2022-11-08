<script type="text/javascript">
    active_form3_withdrawals = '';

    $(document).ready(function () {
        setTimeout(function () {
            __1form3Withdrawals();


        },200)
    })

    $("#form3_addMolassesWithdrawalForm").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form3_withdrawals.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,false,false);
                active_form3_withdrawals = res.slug;
                form3_withdrawals.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })

    function __1form3Withdrawals() {
        window.form3_withdrawals = $("#form3_detailsOfMolassesWithdrawals").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form3_withdrawals.index")}}?weekly_report_slug={{$wr->slug}}',
            "columns": [
                { "data": "date" },
                { "data": "mro_no" },
                { "data": "trader" },
                { "data": "withdrawal_type" },
                { "data": "sugar_type" },
                { "data": "qty" },
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
                $("#waitBar .progress-bar").css('width','14%');
                $("#waitText span").html('Initializing Form 3');
                __2Form5Deliveries();
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form3_withdrawals !== ''){
                    $("#form3_detailsOfMolassesWithdrawals #"+active_form3_withdrawals).addClass('success');
                }
            }
        })
        style_datatable("#form3_detailsOfMolassesWithdrawals");
    }




</script>