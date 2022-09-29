<script type="text/javascript">
    //Initialize DataTable
    active_form6a_rawSugarReceipts = '';
    $(document).ready(function () {
        setTimeout(function () {
            form6_rawSugarReceipts_tbl = $("#form6a_rawSugarReceipts_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : '{{route("dashboard.form6a_rawSugarReceipts.index")}}?weekly_report_slug={{$wr->slug}}',
                "columns": [
                    { "data": "delivery_no" },
                    { "data": "trader" },
                    { "data": "mill_source" },
                    { "data": "raw_sro_sn" },
                    { "data": "liens_or" },
                    { "data": "qty" },
                    { "data": "refined_sugar_equivalent" },
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
                        $("#form6a_rawSugarReceipts_table_container").fadeIn();
                        if(find != ''){
                            form6_rawSugarReceipts_tbl.search(find).draw();
                            setTimeout(function(){
                                active_form6a_rawSugarReceipts = '';
                            },3000);
                            window.history.pushState({}, document.title, "/dashboard/employee");
                        }
                    });
                    @if(\Illuminate\Support\Facades\Request::get('toPage') != null && \Illuminate\Support\Facades\Request::get('mark') != null)
                    setTimeout(function () {
                        form6_rawSugarReceipts_tbl.page({{\Illuminate\Support\Facades\Request::get('toPage')}}).draw('page');
                        active_form6a_rawSugarReceipts = '{{\Illuminate\Support\Facades\Request::get("mark")}}';
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
                    // console.log(issuancesOfSro_tbl.page.info().page);
                    $("#form6a_rawSugarReceipts_table a[for='linkToEdit']").each(function () {
                        let orig_uri = $(this).attr('href');
                        $(this).attr('href',orig_uri+'?page='+form6_rawSugarReceipts_tbl.page.info().page);
                    });

                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="modal"]').tooltip();
                    if(active_form6a_rawSugarReceipts != ''){
                        $("#form6a_rawSugarReceipts_table #"+active_form6a_rawSugarReceipts).addClass('success');
                    }
                }
            })
            style_datatable("#form6a_rawSugarReceipts_table");
        },1500)
    })

    $("#form6a_add_rawSugarReceipts_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form6a_rawSugarReceipts.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,false,false);
                active_form6a_rawSugarReceipts = res.slug;
                form6_rawSugarReceipts_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })

</script>