<script type="text/javascript">
    active_form5_deliveries = '';
    $(document).ready(function () {
        deliveries_tbl = $("#form5_deliveries_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{route("dashboard.form5_deliveries.index")}}',
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
                $('#tbl_loader').fadeOut(function(){
                    $("#form5_deliveries_table_container").fadeIn();
                    if(find != ''){
                        deliveries_tbl.search(find).draw();
                        setTimeout(function(){
                            active_form5_issuancesOfSro = '';
                        },3000);
                        window.history.pushState({}, document.title, "/dashboard/employee");
                    }
                });
                @if(\Illuminate\Support\Facades\Request::get('toPage') != null && \Illuminate\Support\Facades\Request::get('mark') != null)
                setTimeout(function () {
                    deliveries_tbl.page({{\Illuminate\Support\Facades\Request::get('toPage')}}).draw('page');
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
                // console.log(deliveries_tbl.page.info().page);
                $("#form5_deliveries_table a[for='linkToEdit']").each(function () {
                    let orig_uri = $(this).attr('href');
                    $(this).attr('href',orig_uri+'?page='+deliveries_tbl.page.info().page);
                });

                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active_form5_deliveries != ''){
                    $("#form5_deliveries_table #"+active_form5_deliveries).addClass('success');
                }
            }
        })

        style_datatable("#form5_deliveries_table");
    })


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
                succeed(form,false,false);
                active_form5_deliveries = res.slug;
                deliveries_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>