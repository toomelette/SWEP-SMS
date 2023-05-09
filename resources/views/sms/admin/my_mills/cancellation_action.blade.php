@if($data->action == null)
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-success action_btn" data="{{$data->slug}}" data-type="APPROVED"  data-toggle="modal" data-target="#show_pr_modal" title="" data-placement="left" data-original-title="Approve">
            <i class="fa fa-thumbs-up"></i> Approve
        </button>
        <button class="btn  btn-sm btn-danger action_btn"  title="" data="{{$data->slug}}" data-type="DENIED" data-placement="left" data-original-title="Disapprove">
            <i class="fa fa-thumbs-down"></i> Disapprove
        </button>
    </div>
@else
    @if($data->action == 'APPROVED')
        <span class="label label-success">{{$data->action}}</span>
    @else
        <span class="label label-danger">{{$data->action}}</span>
    @endif
@endif