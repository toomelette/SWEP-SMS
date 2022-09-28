<script type="text/javascript">
    //Initialize DataTable
    active_form6a_quedanRegistry = '';
    $(document).ready(function () {
        setTimeout(function () {
            quedanRegistry_tbl = $("#form6a_quedanRegistry_table").DataTable({
                'dom' : 'lBfrtip',
                "processing": true,
                "serverSide": true,
                "ajax" : '{{route("dashboard.form6a_quedanRegistry.index")}}',
                "columns": [
                    { "data": "delivery_no" },
                    { "data": "trader" },
                    { "data": "refined_quedan_sn" },
                    { "data": "refined_sugar" },
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
                        $("#form6a_quedanRegistry_table").fadeIn();
                        if(find != ''){
                            quedanRegistry_tbl.search(find).draw();
                            setTimeout(function(){
                                active_form6a_quedanRegistry = '';
                            },3000);
                            window.history.pushState({}, document.title, "/dashboard/employee");
                        }
                    });
                    @if(\Illuminate\Support\Facades\Request::get('toPage') != null && \Illuminate\Support\Facades\Request::get('mark') != null)
                    setTimeout(function () {
                        quedanRegistry_tbl.page({{\Illuminate\Support\Facades\Request::get('toPage')}}).draw('page');
                        active_form6a_quedanRegistry = '{{\Illuminate\Support\Facades\Request::get("mark")}}';
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
                    $("#form6a_quedanRegistry_table a[for='linkToEdit']").each(function () {
                        let orig_uri = $(this).attr('href');
                        $(this).attr('href',orig_uri+'?page='+quedanRegistry_tbl.page.info().page);
                    });

                    $('[data-toggle="tooltip"]').tooltip();
                    $('[data-toggle="modal"]').tooltip();
                    if(active_form6a_quedanRegistry != ''){
                        $("#form6a_quedanRegistry_table #"+active_form6a_quedanRegistry).addClass('success');
                    }
                }
            })
            style_datatable("#form6a_quedanRegistry_table");
        },1000)
    })

    $("#form6a_add_quedanRegistry_form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        $.ajax({
            url : '{{route("dashboard.form6a_quedanRegistry.store")}}',
            data : form.serialize(),
            type: 'POST',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
                succeed(form,false,false);
                active_form6a_quedanRegistry = res.slug;
                quedanRegistry_tbl.draw(false);
                $("#form6a_add_quedanRegistry_form").reset();
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })

</script>