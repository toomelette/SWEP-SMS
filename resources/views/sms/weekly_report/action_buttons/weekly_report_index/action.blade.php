<div class="btn-group">
    <button type="button" class="btn btn-default btn-sm preview_report_btn" data="{{$data->slug}}" data-toggle="modal" data-target ="#previewReportModal" title="Preview" data-placement="left">
        <i class="fa fa-file-text"></i>
    </button>


    <a  href="{{$editHref}}" for="linkToEdit" type="button" data="{{$data->slug}}" data-toggle="tooltip" class="btn btn-default btn-sm edit_jo_employee_btn"  title="Edit" data-placement="top">
        <i class="fa fa-edit"></i>
    </a>

    <div class="btn-group btn-group-sm" role="group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right">
            @if($data->status != 1 && $data->status != -1)
                <li>
                    <a href="#" uri="{{route('dashboard.weekly_report.submit',$data->slug)}}" data="{{$data->slug}}"  class="submitBtn"  reportNo="{{$data->report_no}}" cropYear="{{$data->crop_year}}" weekEnding="{{\Illuminate\Support\Carbon::parse($data->week_ending)->format('F d, Y')}}" data-toggle="tooltip" title="Submit weekly report" data-placement="top">
                        <i class="fa fa-sign-out"></i> SUBMIT
                    </a>
                </li>
                <li>
                    <a href="#" style="color: #dd4b39" data="{{$data->slug}}" onclick="delete_data('{{$data->slug}}',{{$destroyRoute}})" data-toggle="tooltip" title="Delete" data-placement="top">
                        <i class="fa fa-trash"></i> DELETE
                    </a>
                </li>
            @endif
            @if($data->status == 1)
                <li>
                    <a href="#" style="color: #dd4b39" uri="{{route('dashboard.weekly_report.cancel',$data->slug)}}" data="{{$data->slug}}" class="saveAsNewBtn" reportNo="{{$data->report_no}}" cropYear="{{$data->crop_year}}" data-toggle="tooltip" title="Delete" data-placement="top">
                        <i class="fa fa-times"></i> CANCEL
                    </a>
                </li>
            @endif
        </ul>
    </div>


</div>