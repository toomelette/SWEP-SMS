<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('images/avatar.jpeg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        
        @if(Auth::check())
          <p>{{ Auth::user()->firstname }}</p>
        @endif

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      
      @if(Auth::check())

        @foreach($user_menu as $user_menu)

          @if($user_menu->is_dropdown == false)

            <li class="{!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
              <a href="{{ route($user_menu->route) }}">
                <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
              </a>
            </li>

          @else

            <li class="treeview {!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">
              <a href="#">
                <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

                <ul class="treeview-menu">

                  @foreach($user_menu->getUserNav() as $userNav)

                    <li class="{!! Route::currentRouteNamed($userNav->route) ? 'active' : '' !!}">
                      <a href="{{ route($userNav->route) }}"><i class="fa fa-caret-right"></i> {{ $userNav->name }}</a>
                    </li>

                  @endforeach

                </ul>

            </li>

          @endif

        @endforeach

      @endif

    </ul>
  </section>
</aside>