<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm view_employee_btn" data="{{$data->slug}}" data-toggle="modal" data-target ="#show_employee_modal" title="View more" data-placement="left">
        <i class="fa fa-file-text"></i>
    </button>


    <a  href="{{$editHref}}" for="linkToEdit" type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_jo_employee_btn"  title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </a>
    <button type="button" data="{{$data->slug}}" onclick="delete_data('{{$data->slug}}',{{$destroyRoute}})" class="btn btn-sm btn-danger delete_jo_employee_btn" data-toggle="tooltip" title="Delete" data-placement="top">
        <i class="fa fa-trash"></i>
    </button>


</div>