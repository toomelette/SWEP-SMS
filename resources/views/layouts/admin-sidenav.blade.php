
<aside class="main-sidebar">
    <style>
        .front_face{
            max-height: 50px;
        }
        .front_face .content{
            padding-top: 0;
        }
        #awselect_sidenav_selector .icon{
            top: 10px;
        }
        .awselect_bg{
            z-index: 5;
        }
    </style>

  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('images/avatar.jpeg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        
        @if(Auth::check())
              <p>
                {!! strtoupper(Helper::getUserName()['firstname']) !!}
            </p>
              <a href="#"> {{\Illuminate\Support\Facades\Auth::user()->mill_code}}</a>
        @endif
      </div>
    </div>
    <style>

    </style>
    <ul class="sidebar-menu" data-widget="tree" id="myMenu">
        <div class="sidebar-form">
            <div class="input-group">
                <input id="mySearch" type="text" onkeyup="searchSidenav()" class="form-control" placeholder="Search menu...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>


      @if(Auth::check())
            <li class="@if('dashboard.home' == Route::currentRouteName()) active @endif" id="home-nav" >
                <a href="{{route('dashboard.home')}}">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>


        @if(count($tree) > 0)
            @php($tree_copy = $tree)
            @php(ksort($tree_copy))
            @if(count($tree_copy) > 1)



            @endif

                <li class="header" id="sidenav_search_header" style="display: none; background-color: #024850; color: white"><i class="fa fa-search"></i> SEARCH:</li>
            @foreach($tree as $category=>$menus)
                @if(\Illuminate\Support\Facades\Auth::user()->sidenav == '')
                        @if(count($menus) > 0)
                            @if($category != 'U')
                                <li class="header header-group">{!! __html::sidenav_labeler($category) !!}</li>
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
                                        <a href="#" searchable="{{$menu_content['menu_obj']->name}} {{$menu_content['menu_obj']->tags}} {{$menu_content['menu_obj']->category}} {!! \App\Swep\ViewHelpers\__html::sidenav_labeler($menu_content['menu_obj']->category) !!}">
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
                                                            <a href="{{ route($submenu->route) }}"><i class="fa fa-caret-right"></i> {!!$submenu->nav_name!!}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>

                                    </li>
                                @endif
                            @endif
                        @endforeach

                @elseif($category == \Illuminate\Support\Facades\Auth::user()->sidenav)
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
                                            <a href="#" searchable="{{$menu_content['menu_obj']->name}} {{$menu_content['menu_obj']->tags}} {{$menu_content['menu_obj']->category}} {!! \App\Swep\ViewHelpers\__html::sidenav_labeler($menu_content['menu_obj']->category) !!}">
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
                @endif
            @endforeach
        @endif
      @endif
        @if(!empty(Auth::user()->millAssignments))
            <li class="treeview ">
                <a href="#" searchable="Users  SU SUPER USER">
                    <i class="fa fa-times"></i> <span>My Mills</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @foreach(Auth::user()->millAssignments as $millAssignment)
                    <li class="">
                        <a href="{{route('dashboard.my_mills.index',$millAssignment->mill_code)}}"><i class="fa fa-caret-right"></i> {{$millAssignment->mill_code}}</a>
                    </li>
                    @endforeach
                </ul>

            </li>
        @endif
    </ul>
  </section>
</aside>