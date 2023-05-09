<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm view_user_btn" data="{{$data->slug}}" data-toggle="modal" data-target ="#view_user_modal" title="View more" data-placement="left">
        <i class="fa fa-file-text"></i>
    </button>

    <button type="button" data="{{$data->slug}}" class="btn btn-default btn-sm edit_user_btn" data-toggle="modal" data-target="#edit_user_modal" title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </button>
    <button type="button" data="{{$data->slug}}" class="btn btn-sm btn-danger delete_user_btn" onclick="delete_data('{{$data->slug}}','{{route("dashboard.user.destroy","slug")}}')" data="{{$data->slug}}" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">

            <li><a href="#" class="reset_password_btn" data="{{$data->slug}}" fullname="{{strtoupper($data->firstname).' '.strtoupper($data->lastname)}}">Reset Password</a></li>
        </ul>
    </div>
</div>