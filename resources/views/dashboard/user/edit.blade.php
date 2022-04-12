@extends('layouts.modal-content',['form_id'=>'edit_user_form', 'slug'=> $user->slug,])


@section('modal-header')
Edit
@endsection

@section('modal-body')
<div class="row">
    <div class="col-md-3">
        <div class="row">
            {!! __form::textbox(
              '12 firstname', 'firstname', 'text', 'Firstname *', 'Firstname', $user->firstname, '', '', ''
            ) !!}

            {!! __form::textbox(
                  '12 middlename', 'middlename', 'text', 'Middlename *', 'Middlename', $user->middlename, '', '', ''
                ) !!}

            {!! __form::textbox(
              '12 lastname', 'lastname', 'text', 'Lastname *', 'Lastname', $user->lastname, '', '', ''
            ) !!}



            {!! __form::textbox(
                  '12 email', 'email', 'email', 'Email *', 'Email', $user->email, '', '', ''
                ) !!}

            {!! __form::textbox(
              '12 position', 'position', 'text', 'Position *', 'Position', $user->position, '', '', ''
            ) !!}
        </div>
    </div>
    <div class="col-md-9">
        @php($count = 0)


        @foreach($all_menus as $menu)
            @if($count%4 == 0)
                <div class="row">
            @endif
            @php($count++)
            <div class="col-md-3">
                @if($menu->route == 'dashboard.home')
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa {{$menu->icon}}"></i>
                            {{$menu->name}}
                        </div>
                        <div class="panel-body" style="min-height: 210px">
                            <div class="row">
                                {!!
                                    __form::select_static2('12', 'dash_type', 'Dashboard type',$user->dash,
                                    [
                                        'HRU Dashboard' => 'hru',
                                        'RECORDS Dashboard' => 'records',
                                    ]
                                    , '', '', '', '')
                                   !!}

                            </div>
                        </div>
                    </div>
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa {{$menu->icon}}"></i>
                            {{$menu->name}}
                            <div class="pull-right">
                                <button class="btn btn-xs btn-default clear_btn" type="button">Clear</button>
                            </div>
                        </div>
                        <div class="panel-body" style="min-height: 180px">
                            <div class="row">
                                <div class="col-sm-12">
                                    <select multiple="" name="submenus[{{$menu->menu_id}}][]" class="form-control select_multiple" size="6">
                                        @if($menu->submenu->count() > 0)
                                            @foreach($menu->submenu as $submenu)
                                                <option value="{{$submenu->submenu_id}}" @if(isset($user_submenus_arr[$submenu->submenu_id])) selected @endif>
                                                    {{$submenu->name}}
                                                </option>
                                            @endforeach

                                        @endif
                                    </select>
                                    <span class="help-block" style="font-size: 12px; font-family: 'Product Sans Light'">No module selected</span>
                                </div>
                            </div>
                            <div class="progress xs">
                                <div class="progress-bar bg-green" style="width: 0%;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            @if($count%4 == 0)
                </div>
            @endif
        @endforeach

    </div>
</div>
@endsection


@section('modal-footer')
    <button type="submit" class="btn btn-primary">Update</button>
@endsection

@section('scripts')
    <script>
        $("#edit_user_form").submit(function (e) {
            e.preventDefault();
            uri = "{{route('dashboard.user.update', 'slug')}}";
            uri = uri.replace('slug',"{{$user->slug}}");
            form = $(this);
            $.ajax({
                url : uri,
                data : form.serialize(),
                type : 'PATCH',
                success : function (response) {
                    console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            })
        })
    </script>
@endsection
