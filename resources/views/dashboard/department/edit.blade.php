@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id'=> 'edit_dept_form_'.$rand , 'slug' => $dept->slug])

@section('modal-header')
    {{$dept->department_id}} - Edit
@endsection

@section('modal-body')
    <input name="slug" value="{{$dept->slug}}" hidden>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::textbox('department_id',[
            'label' => 'Department ID:*',
            'cols' => 12,
        ],$dept) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('name',[
            'label' => 'Department Name:*',
            'cols' => 12,
        ],$dept) !!}
    </div>
@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
<script type="text/javascript">
    $("#edit_dept_form_{{$rand}}").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        loading_btn(form);
        let uri = '{{route("dashboard.department.update","slug")}}';
        uri = uri.replace('slug',form.attr('data'));
        $.ajax({
            url : uri,
            data : form.serialize(),
            type: 'PUT',
            headers: {
                {!! __html::token_header() !!}
            },
            success: function (res) {
               succeed(form,true,true);
               notify('Department successfully saved.','success');
               active = res.slug;
               departments_tbl.draw(false);
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })
</script>
@endsection

