@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id'=>'edit_unit_form_'.$rand , 'slug' => $du->slug])

@section('modal-header')
    {{$du->name}} - Edit
@endsection

@section('modal-body')
    <input name="slug" value="{{$du->slug}}" hidden>
    <div class="row">
        {!! \App\Swep\ViewHelpers\__form2::select('department_id',[
            'label' => 'Department: *',
            'cols' => 12,
            'options' => Helper::departmentsArray(),
          ],$du) !!}
        {!! \App\Swep\ViewHelpers\__form2::textbox('name',[
          'label' => 'Name: *',
          'cols' => 12,
        ],$du) !!}

        {!! \App\Swep\ViewHelpers\__form2::textbox('description',[
          'label' => 'Description: *',
          'cols' => 12,
        ],$du) !!}
    </div>
@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#edit_unit_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let uri = '{{route("dashboard.department_unit.update","slug")}}';
            uri = uri.replace('slug',form.attr('data'));
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
                   du_tbl.draw(false);
                   notify('Department Unit successfully updated.');
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
    </script>
@endsection

