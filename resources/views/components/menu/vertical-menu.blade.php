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
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg><span>COTIZACIONES</span></div>
            </li>
            <li class="menu {{ Request::is('coti/*') ? 'active' : '' }}">
                <a href="#coti" data-bs-toggle="collapse"
                    aria-expanded="{{ Request::is('coti/*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>
                        <span>Ingresos</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ Request::is('coti/*') ? 'show' : '' }}" id="coti"
                    data-bs-parent="#accordionExample">
                    <li class="{{ Request::is('coti/create') ? 'active' : '' }}">
                        <a href="{{ route('coti.create') }} ">Crear Cotizacion</a>
                    </li>
                    <li class="{{ Request::is('coti/edit') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/coti/edit">Modificar Cotizacion</a>
                    </li>
                </ul>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg><span>CONFIGURACION</span></div>
            </li>
            <li class="menu {{ Request::is('config/*') ? 'active' : '' }}">
                <a href="#config" data-bs-toggle="collapse"
                    aria-expanded="{{ Request::is('config/*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                            stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            class="css-i6dzq1">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                        <span>Ajustes</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ Request::is('config/*') ? 'show' : '' }}" id="config"
                    data-bs-parent="#accordionExample">
                    <li class="{{ Request::is('config/settings') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/config/settings">Generales</a>
                    </li>
                    <li class="{{ Request::is('config/person') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/config/person">Participantes</a>
                    </li>
                    <li class="{{ Request::is('config/type') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/config/type">Opciones de Dir/Tel/Email</a>
                    </li>
                    <li>
                        <a href="#companies" data-bs-toggle="collapse" aria-expanded="false"
                            title="Organizacion de Seguros" class="dropdown-toggle collapsed">Organizacion de
                            Seguros<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu {{ Request::is('*/company') ? 'show' : '' }}"
                            id="companies" data-bs-parent="#pages">
                            <li class="{{ Request::is('config/company') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/company">Compañias</a>
                            </li>
                            <li class="{{ Request::is('config/companyramo') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/companyramo">Ramos</a>
                            </li>
                            <li class="{{ Request::is('config/companyproduct') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/companyproduct">Productos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('config/ramo') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/config/ramo">Ramos CMF</a>
                    </li>
                    <li class="{{ Request::is('config/cobertura') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/config/cobertura">Coberturas</a>
                    </li>
                    <li>
                        <a href="#intermediaries" data-bs-toggle="collapse" aria-expanded="false"
                            title="Organizacion Territorial" class="dropdown-toggle collapsed">Intermediarios<svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu {{ Request::is('*/intermediary/*') ? 'show' : '' }}"
                            id="intermediaries" data-bs-parent="#pages">
                            @if (setting('intermediaries_used') != '')
                                @php
                                    $values = explode(
                                        ',',
                                        str_replace(
                                            ['[', ']', '"'],
                                            '',
                                            setting(str_replace('[]', '', 'intermediaries_used')),
                                        ),
                                    );

                                @endphp
                                @foreach ($values as $value)
                                    <li class="{{ Request::is('config/intermediary/".$value."') ? 'active' : '' }}">
                                        <a
                                            href="{{ getRouterValue() }}/config/intermediary/{{ $value }}">{{ App\Models\Code::find($value)->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="{{ Request::is('config/coin') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/config/coin">Monedas</a>
                    </li>
                    <li>
                        <a href="#territory" data-bs-toggle="collapse" aria-expanded="false"
                            title="Organizacion Territorial" class="dropdown-toggle collapsed">O. Territorial<svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu {{ Request::is('*/region') || Request::is('*/city') || Request::is('*/commune') ? 'show' : '' }}"
                            id="territory" data-bs-parent="#pages">
                            <li class="{{ Request::is('config/region') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/region">Regiones</a>
                            </li>
                            <li class="{{ Request::is('config/city') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/city">Ciudades</a>
                            </li>
                            <li class="{{ Request::is('config/commune') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/commune">Comunas</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#vehicles" data-bs-toggle="collapse" aria-expanded="false" title="Vehiculos"
                            class="dropdown-toggle collapsed">Vehiculos<svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu {{ Request::is('*/color') || Request::is('*/typevehicle') || Request::is('*/usevehicle') || Request::is('*/branchvehicle') || Request::is('*/modelvehicle') ? 'show' : '' }}"
                            id="vehicles" data-bs-parent="#pages">
                            <li class="{{ Request::is('config/color') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/color">Colores</a>
                            </li>
                            <li class="{{ Request::is('config/typevehicle') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/typevehicle">Tipos</a>
                            </li>
                            <li class="{{ Request::is('config/usevehicle') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/usevehicle">Usos</a>
                            </li>
                            <li class="{{ Request::is('config/branchvehicle') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/branchvehicle">Marcas</a>
                            </li>
                            <li class="{{ Request::is('config/modelvehicle') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/modelvehicle">Modelos</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#novehicles" data-bs-toggle="collapse" aria-expanded="false"
                            title="Organizacion Territorial" class="dropdown-toggle collapsed">No Vehiculos<svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg> </a>
                        <ul class="collapse list-unstyled sub-submenu {{ Request::is('*/typenovehicle') ? 'show' : '' }}"
                            id="novehicles" data-bs-parent="#pages">
                            <li class="{{ Request::is('config/typenovehicle') ? 'active' : '' }}">
                                <a href="{{ getRouterValue() }}/config/typenovehicle">Tipos</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="menu {{ Request::is('access/*') ? 'active' : '' }}">
                <a href="#access" data-bs-toggle="collapse"
                    aria-expanded="{{ Request::is('access/*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Accesos</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ Request::is('access/*') ? 'show' : '' }}" id="access"
                    data-bs-parent="#accordionExample">
                    <li class="{{ Request::is('access/role') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/access/role">Roles</a>
                    </li>
                    <li class="{{ Request::is('access/user') ? 'active' : '' }}">
                        <a href="{{ getRouterValue() }}/access/user">Usuarios</a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>

</div>
