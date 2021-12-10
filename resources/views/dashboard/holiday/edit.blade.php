@extends('layouts.modal-content',['form_id'=>'edit_holiday_form','slug'=>$holiday->slug])

@section('modal-header')
{{$holiday->name}}
@endsection

@section('modal-body')
    <div class="row">
        {!! __form::textbox(
          '12 date', 'date', 'date', 'Date *', 'Date', $holiday->date, 'date', '', ''
        ) !!}

        {!! __form::textbox(
          '12 holiday_name', 'holiday_name', 'holiday_name', 'Name *', 'Name', $holiday->name, 'holiday_name', '', ''
        ) !!}

        {!! __form::select_static(
        '12 type', 'type', 'Type', $holiday->type, \App\Swep\Helpers\Helper::holiday_types(), '', '', '', ''
        ) !!}
    </div>
@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#edit_holiday_form").submit(function (e) {
            e.preventDefault();
            form = $(this);
            slug = form.attr("data");
            url = '{{route("dashboard.holidays.update","slug")}}';
            url = url.replace("slug",slug);
            loading_btn(form);
            $.ajax({
                url : url,
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    active = res.slug;
                    holidays_tbl.draw(false);
                    console.log(res);
                },
                error: function (res) {
                    errored(form,res);
                    console.log(res);
                }
            })
        })
    </script>
@endsection

