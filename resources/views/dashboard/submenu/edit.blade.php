@extends('layouts.modal-content',['form_id'=>'edit_submenu_form','slug'=>$submenu->slug])

@section('modal-header')
{{$submenu->name}}
@endsection

@section('modal-body')
<div class="row">
    {!! __form::textbox(
        '12 name', 'name', 'text', 'Name: *', 'Name',$submenu->name, '', '', ''
    ) !!}

    {!! __form::textbox(
        '12 route', 'route', 'text', 'Route: *', 'Route',$submenu->route, '', '', ''
    ) !!}

    {!! __form::textbox(
        '12 nav_name', 'nav_name', 'text', 'Nav name:', 'Nav name',$submenu->nav_name, '', '', ''
    ) !!}

    {!! __form::select_static(
        '12 is_nav', 'is_nav', 'Is nav: *', $submenu->is_nav, [
        'No' => '0',
        'Yes' => '1',
        ], '', '', '', ''
    ) !!}
</div>
@endsection

@section('modal-footer')
    <button type="button" data-dismiss="modal" class="btn btn-default btn-sm"> Close</button>
    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script>
        $("#edit_submenu_form").submit(function (e) {
            e.preventDefault();
            form = $(this);
            var slug = form.attr('data');
            loading_btn(form);
            var uri = "{{route('dashboard.submenu.update','slug')}}";
            var uri = uri.replace('slug',slug);
            $.ajax({
                url : uri,
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   succeed(form,true,true);
                   submenu_tbl_active = res.slug;
                   submenu_menu_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res)
                    console.log(res);
                }
            })
        })

    </script>
@endsection

