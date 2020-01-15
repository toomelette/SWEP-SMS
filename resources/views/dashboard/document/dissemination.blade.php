<?php
  
$span_sent = '<span class="badge bg-green">Sent</span>'; 
$span_failed = '<span class="badge bg-red">Failed</span>'; 

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Document Dissemination</h1>
  </section>

  <section class="content">

    <div class="box">

      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.document.dissemination_post', $document->slug) }}">

        @csrf

        <div class="box-body">

          {{-- Navigation --}}
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#email_dissemination" data-toggle="tab">Email Dissemination</a></li>
              <li><a href="#sent" data-toggle="tab">Sent</a></li>
            </ul>

            <div class="tab-content">


              {{-- Personal Info --}}
              <div class="tab-pane active" id="email_dissemination">
                <div class="row">   
                  <div class="col-md-12">

                      {!! __form::select_static(
                        '3', 'type', 'Type', old('type'), ['By Unit' => 'U', 'By Employee' => 'E',], $errors->has('type'), $errors->first('type'), '', ''
                      ) !!} 
                      <div class="col-md-9"></div>


                      <div class="form-group col-md-12 {{ $errors->has('employee') ? 'has-error' : '' }}" id="employee_div">
                        <label for="employee">Recipients *</label> <br>
                        <select name="employee[]" id="employee" class="form-control select2" multiple="multiple" data-placeholder="Recipients">
                            @foreach($global_employees_all as $data)
                                @if(old('employee'))
                                    <option value="{{ $data->employee_no }}" {!! in_array($data->employee_no, old('employee')) ? 'selected' : '' !!}>{{$data->fullname}}</option>
                                @else
                                    <option value="{{ $data->employee_no }}">{{$data->fullname}}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('employee'))
                          <p class="help-block"> {{ $errors->first('subject') }} </p>
                        @endif
                      </div>


                      <div class="form-group col-md-12 {{ $errors->has('department_unit') ? 'has-error' : '' }}" id="department_unit_div">
                        <label for="department_unit">Recipients *</label> <br>
                        <select name="department_unit[]" id="department_unit" class="form-control select2" multiple="multiple" data-placeholder="Recipients">
                            @foreach($global_department_units_all as $data)
                                @if(old('department_unit'))
                                    <option value="{{ $data->department_unit_id }}" {!! in_array($data->department_unit_id, old('department_unit')) ? 'selected' : '' !!}>{{$data->description}}</option>
                                @else
                                    <option value="{{ $data->department_unit_id }}">{{$data->description}}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('department_unit'))
                          <p class="help-block"> {{ $errors->first('department_unit') }} </p>
                        @endif
                      </div>


                      {!! __form::textbox(
                         '12', 'subject', 'text', 'Subject *', 'Subject', old('subject'), $errors->has('subject'), $errors->first('subject'), ''
                      ) !!}


                      {!! __form::textarea(
                         '12', 'content', 'Content', old('content'), $errors->has('content'), $errors->first('content'), ''
                      ) !!}


                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-default">Send <i class="fa fa-fw fa-envelope-o"></i></button>
                      </div>
                  </div>
                </div>
              </div>






              {{-- Family Info --}}
              <div class="tab-pane" id="sent">
                <div class="row">
                  <div class="col-md-12">

                      <table class="table table-hover">

                        <tr>
                          <th>Fullname</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Content</th>
                          <th>Status</th>
                        </tr>

                        <tbody>

                          @foreach ($document->documentDisseminationLog as $data)
                          
                            <tr>
                              <td>{{ $data->employee->fullname }}</td>
                              <td>{{ $data->employee->email }}</td>
                              <td>{{ Str::limit($data->subject, 30) }}</td>
                              <td>{{ Str::limit($data->content, 30) }}</td>
                              <td>{!! $data->status == 'SENT' ? $span_sent : $span_failed !!}</td>
                            </tr>
                            
                          @endforeach

                        </tbody>

                      </table>

                  </div>
                </div>
              </div>





            </div>
          </div>
        </div>

      </form>

    </div>

  </section>

@endsection





@section('modals')

  @if(Session::has('DISSEMINATION_SUCCESS'))
    {!! __html::modal('doc_dissemination', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DISSEMINATION_SUCCESS')) !!}
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">


    $('select[multiple]').select2({
        closeOnSelect: true,
    });


    @if(Session::has('DISSEMINATION_SUCCESS'))
      $('#doc_dissemination').modal('show');
    @endif


    @if($errors->has('employee') || old('type') == "E")
      $('#employee_div').show();
      $('#department_unit_div').hide();
    @elseif($errors->has('department_unit') || old('type') == "U")
      $('#department_unit_div').show();
      $('#employee_div').hide();
    @else
      $('#employee_div').hide();
      $('#department_unit_div').hide();
    @endif


    $(document).on("change", "#type", function () {
      $('#employee').val('').change();
      $('#department_unit').val('').change();
      var val = $(this).val();
        if(val == "E"){ 
          $('#employee_div').show();
          $('#department_unit_div').hide();
        }else if(val == "U"){
          $('#department_unit_div').show();
          $('#employee_div').hide();
        }else{
          $('#employee_div').hide();
          $('#department_unit_div').hide();
        }
   });


  </script> 
    
@endsection