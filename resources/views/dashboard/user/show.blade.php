@extends('layouts.modal-content')

@section('modal-header')
{{(!empty($user->employee) ? $user->employee->lastname : $user->lastname)}}, {{(!empty($user->employee) ? $user->employee->firstname : $user->firstname)}}
@endsection

@section('modal-body')
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">User Information</a></li>
      <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">User Access</a></li>
      <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Activity Logs</a></li>

    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
        <div class="row">
          <div class="col-md-3">
            <b>First Name:</b>
            <p>{{$user->firstname}}</p>
          </div>
          <div class="col-md-3">
            <b>Middle Name:</b>
            <p>{{$user->middlename}}</p>
          </div>
          <div class="col-md-3">
            <b>Last Name:</b>
            <p>{{$user->lastname}}</p>
          </div>
          <div class="col-md-3">
            <b>Email Address:</b>
            <p>{{$user->email}}</p>
          </div>

          <div class="col-md-3">
            <b>Position:</b>
            <p>{{$user->position}}</p>
          </div>


          <div class="col-md-3">
            <b>Account:</b>
            <p>

              @if($user->is_activated == false)
                <span class="label bg-red">DEACTIVATED</span>
              @else
                <span class="label bg-green">ACTIVE</span>
              @endif
            </p>
          </div>

        </div>

      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_2">
        @if(count($tree) > 0)
          @foreach($tree as $key=>$menu)
            <div>
              <div class="row">
                <div class="col-md-8">
                  <i class="fa {{$menu['menu_obj']->icon}}"></i>
                  <label>{{$menu['menu_obj']->name}}</label>
                </div>
                <div class="col-md-4">
                  <div class="progress xs">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{count($menu['submenus'])/$menus_with_count_submenus[$key]*100}}%">
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">
                @if(count($menu['submenus']) > 0)
                  @foreach($menu['submenus'] as $submenu)
                    <div class="col-md-4">
                      <li>{{$submenu->name}}</li>
                    </div>
                  @endforeach
                @endif
              </div>
              <hr>
            </div>
          @endforeach
        @endif
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_3">
        <table class="table table-condensed" id="table_logs">
          <thead>
            <tr>
              <th>Action made</th>
              <th>Task</th>
              <th>Timestamp</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @if($user->actions->count() > 0)
              @foreach($user->actions as $action)
                <tr>
                  <td>
                    {{ucfirst($action->description)}} :
                    {{substr($action->subject_type, strrpos($action->subject_type, "\\") + 1)}}
                  </td>
                  <td>
                    @if(!empty($action->subject))
                      {{$action->subject->slug}}
                    @else
                      @if(isset($action->properties['attributes']['slug']))
                        {{$action->properties['attributes']['slug']}}
                      @else
                        N/A
                      @endif
                    @endif
                  </td>
                  <td>
                    {{Carbon::parse($action->created_at)->format('Y-m-d | H:i:s')}}
                  </td>

                  <td>
                    <button class="btn btn-success btn-xs activity_properties_btn" data="{{$action->id}}"><i class="fa fa-comment"></i></button>
                  </td>

                </tr>
              @endforeach
            @endif

          </tbody>
        </table>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
@endsection

@section('modal-footer')

@endsection

@section('scripts')
  <script>
    $("#table_logs").DataTable({
      "order": [[ 2, "desc" ]]
    });


  </script>
@endsection

