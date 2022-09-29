<script type="text/javascript">
    active_form5a_issuance = '';
    $(document).ready(function () {
        form5a_issuance_tbl = $("#form5a_issuance_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form5a_issuanceOfSro.index")}}?weekly_report_slug={{$wr->slug}}',
            "columns": [
                { "data": "date_of_issue" },
                { "data": "sro_no" },
                { "data": "trader" },
                { "data": "raw_qty" },
                { "data": "monitoring_fee_or_no" },
                { "data": "rsq_no" },
                { "data": "refined_qty" },
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
                $('#tbl_loader').fadeOut(function(){
                    $("#form5a_issuance_table_container").fadeIn();
                    if(find != ''){
                        form5a_issuance_tbl.search(find).draw();
                        setTimeout(function(){
                            active_form5_issuancesOfSro = '';
                        },3000);
                        window.history.pushState({}, document.title, "/dashboard/employee");
                    }
                });
                @if(\Illuminate\Support\Facades\Request::get('toPage') != null && \Illuminate\Support\Facades\Request::get('mark') != null)
                setTimeout(function () {
                    form5a_issuance_tbl.page({{\Illuminate\Support\Facades\Request::get('toPage')}}).draw('page');
                    active_form5_issuancesOfSro = '{{\Illuminate\Support\Facades\Request::get("mark")}}';
                    notify('Employee successfully updated.');
                    window.history.pushState({}, document.title, "/dashboard/employee");
                },700);
                @endif
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                // console.log(servedSros_tbl.page.info().page);
                $("#form5a_issuance_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+form5a_issuance_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form5a_issuance != ''){
                    $("#form5a_issuance_table #"+active_form5a_issuance).addClass('success');
                }
            }
        })

        style_datatable("#form5a_issuance_table");
    })

    $("#form5a_add_issuance_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form5a_issuanceOfSro.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,false,false);
                active_form5a_issuance = res.slug;
                form5a_issuance_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>