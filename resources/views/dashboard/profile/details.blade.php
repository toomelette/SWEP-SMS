@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Profile</h1>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-3">

      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{asset('images/avatar.jpeg')}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{ Auth::check() ? Auth::user()->fullname : '' }}</h3>

          <p class="text-muted text-center">{{ Auth::check() ? Auth::user()->position : '' }}</p>

        </div>
      </div>

    </div>
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="{{ $errors->any() ? '' : 'active' }}"><a href="#activity" data-toggle="tab">Activity</a></li>
          <li><a href="#personal_info" data-toggle="tab">Personal Info</a></li>
          <li class="{{ $errors->any() ? 'active' : '' }}"><a href="#account_settings" data-toggle="tab">Account Settings</a></li>
        </ul>
        <div class="tab-content">


          {{-- Activity --}}

          <div class="{{ $errors->any() ? '' : 'active' }} tab-pane" id="activity">
            
            <div class="box-body">

              <strong><i class="fa fa-clock-o margin-r-5"></i> Last Login Time</strong>
              <p class="text-muted">{{ Carbon::parse(Auth::user()->last_login_time)->format('M d, Y h:i A') }}</p>
              <hr>

              <strong><i class="fa  fa-desktop margin-r-5"></i> Last Login Machine</strong>
              <p class="text-muted">{{ Auth::user()->last_login_machine }}</p>
              <hr>

              <strong><i class="fa  fa-asterisk margin-r-5"></i> Last Login Local IP</strong>
              <p class="text-muted">{{ Auth::user()->last_login_ip }}</p>
              <hr>

            </div>

          </div>


          {{-- Personal Info --}}

          <div class="tab-pane" id="personal_info">
            
            <div class="box-body">

              <strong><i class="fa fa-user margin-r-5"></i> Firstname</strong>
              <p class="text-muted">{{ Auth::user()->firstname }}</p>
              <hr>

              <strong><i class="fa fa-user margin-r-5"></i> Middlename</strong>
              <p class="text-muted">{{ Auth::user()->middlename }}</p>
              <hr>

              <strong><i class="fa fa-user margin-r-5"></i> Lastname</strong>
              <p class="text-muted">{{ Auth::user()->lastname }}</p>
              <hr>

              <strong><i class="fa fa-male margin-r-5"></i> Position</strong>
              <p class="text-muted">{{ Auth::user()->position }}</p>
              <hr>

              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
              <p class="text-muted">{{ Auth::user()->email }}</p>

            </div>

          </div>


          {{-- Account Settings --}}

          <div class="{{ $errors->any() ? 'active' : '' }} tab-pane" id="account_settings">

            @if(Session::has('PROFILE_OLD_PASSWORD_FAIL'))
              {!! HtmlHelper::alert('danger', '<i class="icon fa fa-ban"></i> Alert!', Session::get('PROFILE_OLD_PASSWORD_FAIL')) !!}
            @endif

            @if(Session::has('PROFILE_USERNAME_EXIST'))
              {!! HtmlHelper::alert('danger', '<i class="icon fa fa-ban"></i> Alert!', Session::get('PROFILE_USERNAME_EXIST')) !!}
            @endif

            <form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('dashboard.profile.update_account', Auth::user()->slug) }}">

              @csrf

              {!! FormHelper::textbox_inline(
                  'username', 'text', 'Username', 'Username', old('username'), $errors->has('username') || Session::has('PROFILE_USERNAME_EXIST'), $errors->first('username'), ''
              ) !!}

              {!! FormHelper::password_inline(
                  'old_password', 'Old Password', 'Old Password', $errors->has('old_password') || Session::has('PROFILE_OLD_PASSWORD_FAIL'), $errors->first('old_password'), ''
              ) !!}

              {!! FormHelper::password_inline(
                  'password', 'New Password', 'New Password', $errors->has('password'), $errors->first('password'), ''
              ) !!}

              {!! FormHelper::password_inline(
                  'password_confirmation', 'Confirm New Password', 'Confirm New Password', '', '', ''
              ) !!}

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Save Changes</button>
                </div>
              </div>

            </form>
          </div>


        </div>

      </div>

    </div>

  </div>

</section>

@endsection