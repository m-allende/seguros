{{--

/**
*
* Created a new component <x-menu.vertical-menu/>.
*
*/

--}}


<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="{{ getRouterValue() }}/index">
                        <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="navbar-logo logo-dark"
                            alt="logo">
                        <img src="{{ Vite::asset('resources/images/logo2.svg') }}" class="navbar-logo logo-light"
                            alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="{{ getRouterValue() }}/index" class="nav-link"> Seguros </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        @if (!Request::is('collapsible-menu/*'))
            <div class="profile-info">
                <div class="user-info">
                    <div class="profile-img">
                        @php
                            $photo = URL::asset('/img/avatar.jpg');
                            if (Auth::user()->lastPhoto != null) {
                                $photo = URL::asset('img/upl/' . Auth::user()->lastPhoto->path);
                            }
                        @endphp
                        <img src="{{ $photo }}" alt="avatar">
                    </div>
                    <div class="profile-content">
                        <h6 class="">{{ Auth::user()->name }} </h6>
                        <p class="">{{ Auth::user()->roles[0]->name }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="shadow-bottom"></div>
        @inject('menus', 'App\Models\Menu')
        <ul class="list-unstyled menu-categories" id="accordionExample">
            @foreach ($menus->menus() as $key => $item)
                @if ($item['parent_id'] != 0)
                @break
            @endif
            @if ($item['submenu'] == [])
                @can($item['permission'] . '-view')
                    <li>
                        <a href="{{ url($item['url']) }}">@lang('translation.' . $item['name']) </a>
                    </li>
                @endcan
            @else
                @php
                    $hasMenu = false;
                    foreach ($item['submenu'] as $submenu) {
                        if ($submenu['submenu'] == []) {
                            if (
                                auth()
                                    ->user()
                                    ->can($submenu['permission'] . '-view')
                            ) {
                                $hasMenu = true;
                                break;
                            }
                        } else {
                            if ($submenu == []) {
                                if (
                                    auth()
                                        ->user()
                                        ->can($submenu['permission'] . '-view')
                                ) {
                                    $hasMenu = true;
                                    break;
                                }
                            } else {
                                foreach ($submenu['submenu'] as $submenu2) {
                                    if ($submenu2['submenu'] == []) {
                                        if (
                                            auth()
                                                ->user()
                                                ->can($submenu2['permission'] . '-view')
                                        ) {
                                            $hasMenu = true;
                                            break;
                                        }
                                    } else {
                                        if ($submenu2 == []) {
                                            if (
                                                auth()
                                                    ->user()
                                                    ->can($submenu2['permission'] . '-view')
                                            ) {
                                                $hasMenu = true;
                                                break;
                                            }
                                        } else {
                                            $hasMenu = true;
                                            break;
                                        }
                                    }
                                }
                                if ($hasMenu) {
                                    break;
                                }
                            }
                        }
                    }
                @endphp
                @if ($hasMenu)
                    <li class="menu menu-heading">
                        <div class="heading"><i class="{{ $item['icon'] }}"></i><span>@lang('translation.' . $item['name'])</span>
                        </div>
                    </li>
                    @foreach ($item['submenu'] as $submenu)
                        @if ($submenu['submenu'] == [])
                            @can($submenu['permission'] . '-view')
                                <li class="menu"><a href="{{ $submenu['url'] }}" aria-expanded="false"
                                        class="dropdown-toggle">
                                        <div class="">
                                            <i
                                                class="{{ $submenu['icon'] != '' ? $submenu['icon'] : 'fa-solid fa-caret-right' }}"></i>
                                            <span>@lang('translation.' . $submenu['name'])</span>
                                        </div>
                                    </a></li>
                            @endcan
                        @else
                            @if ($submenu == [] || $submenu['permission'] == 'setting')
                                @can($submenu['permission'] . '-view')
                                    @php
                                        $activeSettings = false;
                                        if (
                                            '/' . Request::decodedPath() == $submenu['url'] &&
                                            $submenu['permission'] == 'setting'
                                        ) {
                                            $activeSettings = true;
                                        }
                                    @endphp
                                    <li class="menu {{ $activeSettings ? 'active' : '' }}"><a
                                            href="{{ $submenu['url'] }}" aria-expanded="false" class="dropdown-toggle">
                                            <div class="">
                                                <i class="{{ $submenu['icon'] }}"></i>
                                                <span>@lang('translation.' . $submenu['name'])</span>
                                            </div>
                                        </a></li>
                                @endcan
                            @else
                                @php
                                    $hasMenu = false;
                                    $collect = collect($submenu['submenu']);
                                    $listMenu = $collect->pluck('url')->toArray();
                                    $listMenu = str_replace('\/', '/', $listMenu);
                                    foreach ($submenu['submenu'] as $submenu2) {
                                        if ($submenu2['submenu'] == []) {
                                            if (
                                                auth()
                                                    ->user()
                                                    ->can($submenu2['permission'] . '-view')
                                            ) {
                                                $hasMenu = true;
                                                break;
                                            }
                                        } else {
                                            $hasMenu = true;
                                            break;
                                        }
                                    }
                                    $urlActive = false;
                                    foreach ($listMenu as $url) {
                                        if ('/' . Request::decodedPath() == $url) {
                                            $urlActive = true;
                                            break;
                                        }
                                    }
                                @endphp
                                @if ($hasMenu)
                                    <li class="menu {{ $urlActive ? 'active' : '' }}">
                                        <a href="#{{ str_replace(' ', '_', $submenu['name']) }}"
                                            data-bs-toggle="collapse"
                                            aria-expanded="{{ $urlActive ? 'true' : 'false' }}"
                                            class="dropdown-toggle">
                                            <div class="">
                                                <i style="width: 20px"
                                                    class="{{ $submenu['icon'] != '' ? $submenu['icon'] : 'fa-solid fa-caret-right' }}"></i>
                                                <span>@lang('translation.' . $submenu['name'])</span>
                                            </div>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg>
                                            </div>
                                        </a>
                                        <ul class="collapse submenu list-unstyled {{ $urlActive ? 'show' : '' }}"
                                            id="{{ str_replace(' ', '_', $submenu['name']) }}"
                                            data-bs-parent="#accordionExample">
                                            @foreach ($submenu['submenu'] as $submenu2)
                                                @if ($submenu2['submenu'] == [])
                                                    @can($submenu2['permission'] . '-view')
                                                        <li><a href="{{ $submenu2['url'] }}"> @lang('translation.' . $submenu2['name'])
                                                            </a></li>
                                                    @endcan
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endif
            @endif
        @endforeach
    </ul>

</nav>

</div>
