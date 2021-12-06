@extends('layouts.modal-content',['form_id' => 'edit_pap_parent_form','slug'=>$pap_parent->slug])

@section('modal-header')
    {{$pap_parent->name}}
@endsection

@section('modal-body')
    <div class="row">
        {!! __form::textbox(
          '12 name', 'name', 'text', 'Name *', 'Name', $pap_parent->name, 'name', '', ''
        ) !!}
    </div>
@endsection

@section('modal-footer')
    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#edit_pap_parent_form").submit(function (e) {
            e.preventDefault();
            form = $(this);
            uri = "{{route('dashboard.pap_parent.update','slug')}}";
            slug = form.attr('data');
            uri = uri.replace('slug',slug);
            loading_btn(form);
            $.ajax({
                url : uri,
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   succeed(form,true,true);
                   active = res.slug;
                   pap_parent_tbl.draw(false);
                },
                error: function (res) {
                    errored(form,res);
                    console.log(res);
                }
            })
        })
    </script>
@endsection

