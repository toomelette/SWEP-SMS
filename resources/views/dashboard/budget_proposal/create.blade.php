@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Prepare Budget Proposal</h1>
</section>

<section class="content">
    {{-- Table Grid --}}


            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Programs/Acitivities/Projects (PAP)</h3>
                        </div>
                        <div class="box-body">
                            <div class="panel panel-success">
                                <div class="panel-heading group_name_label">
                                    Unnamed Group
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered pap_tbl">
                                                <tr>
                                                    <td colspan="2">
                                                        <input class="form-control group_name" type="text" placeholder="Group name">
                                                    </td>
                                                    <td style="width: 30rem">
                                                        <div class="btn-group inline" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-default add_pap_btn">Add PAP</button>
                                                            <button type="button" class="btn btn-default add_pap_group_btn">New group within this group</button>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="pap_tbl_child">
                                                    <td></td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text" placeholder="Program/Activity/Project">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input class="form-control" type="text" placeholder="CO">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input class="form-control" type="text" placeholder="MOOE">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger remove_tr_btn"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                                <tr class="pap_tbl_child">
                                                    <td></td>
                                                    <td>
                                                        <div class="panel panel-info" >
                                                            <div class="panel-heading group_name_label_sub">
                                                                Unnamed Group
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table table-bordered pap_tbl_sub">
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <input class="form-control input group_name_sub" type="text" placeholder="Group name">
                                                                        </td>
                                                                        <td style="width: 10rem">
                                                                            <button type="button" class="btn btn-default">Add PAP</button>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="pap_tbl_sub_child">
                                                                        <td>
                                                                        </td>
                                                                        <td>
                                                                            <div class="col-md-8">
                                                                                <input class="form-control input" type="text" placeholder="Program/Activity/Project">
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <input class="form-control input" type="text" placeholder="CO">
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <input class="form-control input" type="text" placeholder="MOOE">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger btn remove_tr_btn"><i class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger remove_tr_btn"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                            </div>



                        </div>
                    </div>

                </div>
                <div class="col-md-6">

                </div>
            </div>
</section>
<div style="display: none">
    <div >
        <table>
            <tr id="new_pap_tr">
                <td></td>
                <td>
                    <div class="row">
                        <div class="col-md-8">
                            <input class="form-control" type="text" placeholder="Program/Activity/Project">
                        </div>
                        <div class="col-md-2">
                            <input class="form-control" type="text" placeholder="CO">
                        </div>
                        <div class="col-md-2">
                            <input class="form-control" type="text" placeholder="MOOE">
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove_tr_btn"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            <tr id="new_pap_group_tr">
                <td></td>
                <td>
                    <div class="panel panel-info" >
                        <div class="panel-heading group_name_label_sub">
                            Unnamed Group
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered pap_tbl_sub">
                                <tr>
                                    <td colspan="2">
                                        <input class="form-control input group_name_sub" type="text" placeholder="Group name">
                                    </td>
                                    <td style="width: 10rem">
                                        <button type="button" class="btn btn-default">Add PAP</button>
                                    </td>
                                </tr>
                                <tr class="pap_tbl_sub_child">
                                    <td>
                                    </td>
                                    <td>
                                        <div class="col-md-8">
                                            <input class="form-control input" type="text" placeholder="Program/Activity/Project">
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control input" type="text" placeholder="CO">
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control input" type="text" placeholder="MOOE">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn remove_tr_btn"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove_tr_btn"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        </table>
    </div>
</div>


@endsection


@section('modals')

@endsection

@section('scripts')
<script type="text/javascript">
    function dt_draw() {
        users_table.draw(false);
    }

    function filter_dt() {
        is_online = $(".filter_status").val();
        is_active = $(".filter_account").val();
        users_table.ajax.url("{{ route('dashboard.user.index') }}" + "?is_online=" + is_online + "&is_active=" + is_active).load();

        $(".filters").each(function (index, el) {
            if ($(this).val() != '') {
                $(this).parent("div").addClass('has-success');
                $(this).siblings('label').addClass('text-green');
            } else {
                $(this).parent("div").removeClass('has-success');
                $(this).siblings('label').removeClass('text-green');
            }
        });
    }

    function renumber(){
        $(".pap_tbl").each(function () {
            num = 0;
            $(this).find('.pap_tbl_child').each(function () {
                num++;
                $(this).children('td').eq(0).html(num);
            })
        })

        $(".pap_tbl_sub").each(function () {
            number = 0;
            $(this).find('.pap_tbl_sub_child').each(function () {
                number++;
                $(this).children('td').eq(0).html(number);
            })
        })
    }
</script>
<script type="text/javascript">
    $("body").on('keyup','.group_name', function () {
        if($(this).val() == ''){
            text = 'Unnamed Group';
        }else{
            text = $(this).val();
        }
        $(this).parents().eq(7).find('.group_name_label').html(text);
    })

    $("body").on('keyup','.group_name_sub', function () {
        if($(this).val() == ''){
            text = 'Unnamed Group';
        }else{
            text = $(this).val();
        }
        $(this).parents().eq(7).find('.group_name_label_sub').html(text);
    })

    $("body").on('click','.add_pap_btn',function () {
        new_pap_tr = $("#new_pap_tr").html();
        $(this).parents().eq(4).children('tbody').append('<tr class="pap_tbl_child">'+new_pap_tr+'</tr>');
        renumber();
    })
    
    $("body").on("click",'.add_pap_group_btn', function () {
        new_pap_group_tr = $("#new_pap_group_tr").html();
        $(this).parents().eq(4).children('tbody').append('<tr class="pap_tbl_child">'+new_pap_group_tr+'</tr>');
        renumber();
    })
    
    $("body").on("click",".remove_tr_btn",function () {
        $(this).parent('td').parent('tr').remove();
        renumber();
    })

    $(document).ready(function () {
        renumber();
    })
</script>

    @endsection