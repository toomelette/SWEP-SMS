@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Create Voucher</h1>
</section>

<section class="content">
            
    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.disbursement_voucher.store') }}">

        <div class="box-body">
     
          @csrf    

          {!! FormHelper::dynamic_select(
            '3', 'project_id', 'Station', old('project_id'), $global_projects_all, 'project_id', 'project_address', $errors->has('project_id'), $errors->first('project_id')
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save</button>
        </div>

      </form>

    </div>

</section>

@endsection


@section('modals')



@endsection 


@section('scripts')


    
@endsection