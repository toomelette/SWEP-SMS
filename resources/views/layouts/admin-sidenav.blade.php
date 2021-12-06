<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('images/avatar.jpeg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        
        @if(Auth::check())
          <p>{{ Auth::user()->firstname }}</p>
        @endif

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">


      @if(Auth::check())
            <li class="@if('dashboard.home' == Route::currentRouteName()) active @endif">
                <a href="{{route('dashboard.home')}}">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
        @if(count($tree) > 0)

            @foreach($tree as $category=>$menus)
                @if(count($menus) > 0)
                    @if($category != 'U')
                        <li class="header">{!! __html::sidenav_labeler($category) !!}</li>
                    @endif
                @endif
                @foreach($menus as $menu_id => $menu_content)
                    @if($menu_content['menu_obj']->is_menu == true)
                        @if($menu_content['menu_obj']->is_dropdown == false)
{{--                                <li class="{!! Route::currentRouteNamed($user_menu->route) ? 'active' : '' !!}">--}}
{{--                                    <a href="{{ route($user_menu->route) }}">--}}
{{--                                        <i class="fa {{ $user_menu->icon }}"></i> <span>{{ $user_menu->name }}</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                        @else
                                <li class="treeview ">
                                    <a href="#">
                                        <i class="fa {{$menu_content['menu_obj']->icon}}"></i> <span>{{$menu_content['menu_obj']->name}}</span>
                                        <span class="pull-right-container">
                                          <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        @if(count($menu_content['submenus']) > 0)
                                            @foreach($menu_content['submenus'] as $submenu)
                                                @if($submenu->is_nav == true)
                                                    <li class="{!! Route::currentRouteNamed($submenu->route) ? 'active tree_active' : '' !!}">
                                                        <a href="{{ route($submenu->route) }}"><i class="fa fa-caret-right"></i> {{ $submenu->nav_name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif


                                    </ul>

                                </li>
                        @endif
                    @endif
                @endforeach
            @endforeach
        @endif
      @endif

    </ul>
  </section>
</aside>