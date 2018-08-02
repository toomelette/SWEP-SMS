@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Create Fund Source</h1>
  </section>

  <section class="content">

    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.fund_source.store') }}">

        <div class="box-body">
     
          @csrf    

          {!! FormHelper::textbox(
             '4', 'description', 'text', 'Description *', 'Description', old('description'), $errors->has('description'), $errors->first('description'), ''
          ) !!} 

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

  </section>

@endsection





@section('modals')

  @if(Session::has('FUND_SOURCE_CREATE_SUCCESS'))

    {!! HtmlHelper::modal(
      'fund_source_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('FUND_SOURCE_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">

    @if(Session::has('FUND_SOURCE_CREATE_SUCCESS'))
      $('#fund_source_create').modal('show');
    @endif

  </script> 
    
@endsection