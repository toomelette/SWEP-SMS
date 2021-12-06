@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Daily Time Record</h1>
    </section>

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Daily Time Record</h3>
            </div>
            <div class="box-body">
                <div class="box-group" id="accordion">

                    @if(count($dtr_by_year) > 0)
                        @php($num=0)
                        @foreach($dtr_by_year as $key => $months)
                            @php($num++)
                            @if($num == 1)
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                                                {{$key}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="" >
                                        <div class="box-body">
                                            @if(count($months) > 0)
                                                @php(ksort($months))
                                                <div class="row">
                                                @foreach($months as $month => $null)
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn btn-default col-md-12 month_btn" data-toggle="modal" data-target="#dtr_modal" month="{{$month}}">
                                                            {{\Carbon\Carbon::parse($month)->format('F')}}
                                                        </button>
                                                    </div>
                                                @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" class="collapsed" aria-expanded="false">
                                                {{$key}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{$key}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            @if(count($months) > 0)
                                                @php(ksort($months))
                                                <div class="row">
                                                    @foreach($months as $month => $null)
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-default col-md-12 month_btn" data-toggle="modal" data-target="#dtr_modal" month="{{$month}}">
                                                                {{\Carbon\Carbon::parse($month)->format('F')}}
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>


@endsection


@section('modals')
    {!! __html::blank_modal('dtr_modal','lg') !!}
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
    </script>
    <script type="text/javascript">
        modal_loader = $("#modal_loader").parent('div').html();

        $('body').on('click','.month_btn',function () {
            btn = $(this);
            var month = $(this).attr('month');
            var bm_u_id = "{{$employee->biometric_user_id}}";
            load_modal2(btn);
            $.ajax({
                url : '{{route("dashboard.dtr.fetch_by_user_and_month")}}',
                data : {bm_u_id : bm_u_id, month: month},
                type: 'GET',
                success: function (res) {
                   populate_modal2(btn,res);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        })
    </script>


@endsection