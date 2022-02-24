@extends('layouts.modal-content')

@section('modal-header')
    {{$r->request_no}} - {{$r->nature_of_request}} - Status
@endsection

@section('modal-body')
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-sm pull-right" data-target="#update_status_modal" data-toggle="modal"><i class="fa fa-plus"></i> Update Status</button>
        </div>
    </div>
@endsection

@section('modal-footer')

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#update_status_form").attr('data','{{$r->slug}}');
    </script>
@endsection

