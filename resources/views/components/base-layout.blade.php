{{--

/**
*
* Created a new component <x-base-layout/>.
*
*/

--}}

@php
    $isBoxed = layoutConfig()['boxed'];
    $isAltMenu = layoutConfig()['alt-menu'];
    //dd(request()->getRequestUri());
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Sistema de Seguros | {{ $pageTitle }}</title>
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/favicon.ico') }}" />
    @vite(['resources/scss/layouts/modern-light-menu/light/loader.scss'])
    <link rel="stylesheet" href="{{ asset('plugins/sweetalerts2/sweetalerts2.css') }}">
    @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])
    @vite(['resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss'])
    @vite(['resources/scss/light/assets/components/font-icons.scss'])

    @if (Request::is('modern-light-menu/*'))
        @vite(['resources/layouts/modern-light-menu/loader.js'])
    @elseif (Request::is('modern-dark-menu/*'))
        @vite(['resources/layouts/modern-dark-menu/loader.js'])
    @elseif (Request::is('collapsible-menu/*'))
        @vite(['resources/layouts/collapsible-menu/loader.js'])
    @elseif (Request::is('horizontal-light-menu/*'))
        @vite(['resources/layouts/horizontal-light-menu/loader.js'])
    @elseif (Request::is('horizontal-dark-menu/*'))
        @vite(['resources/layouts/horizontal-dark-menu/loader.js'])
    @else
        @vite(['resources/layouts/modern-light-menu/loader.js'])
    @endif

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    @vite(['resources/scss/light/assets/main.scss', 'resources/scss/dark/assets/main.scss'])
    <link rel="stylesheet" href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}">
    @vite(['resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss'])
    <link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    @if (
        !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&
            // Real Logins
            !Request::routeIs('login') &&
            !(request()->getRequestUri() == '/'))
        @if ($scrollspy == 1)
            @vite(['resources/scss/light/assets/scrollspyNav.scss', 'resources/scss/dark/assets/scrollspyNav.scss'])
        @endif
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/waves/waves.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/highlight/styles/monokai-sublime.css') }}">
        @vite(['resources/scss/light/plugins/perfect-scrollbar/perfect-scrollbar.scss'])

        <script src="https://kit.fontawesome.com/86e98c9938.js" crossorigin="anonymous"></script>

        @if (Request::is('modern-light-menu/*'))
            @vite(['resources/scss/layouts/modern-light-menu/light/structure.scss', 'resources/scss/layouts/modern-light-menu/dark/structure.scss'])
        @elseif (Request::is('modern-dark-menu/*'))
            @vite(['resources/scss/layouts/modern-dark-menu/light/structure.scss', 'resources/scss/layouts/modern-dark-menu/dark/structure.scss'])
        @elseif (Request::is('collapsible-menu/*'))
            @vite(['resources/scss/layouts/collapsible-menu/light/structure.scss', 'resources/scss/layouts/collapsible-menu/dark/structure.scss'])
        @elseif (Request::is('horizontal-light-menu/*'))
            @vite(['resources/scss/layouts/horizontal-light-menu/light/structure.scss', 'resources/scss/layouts/horizontal-light-menu/dark/structure.scss'])
        @elseif (Request::is('horizontal-dark-menu/*'))
            @vite(['resources/scss/layouts/horizontal-dark-menu/light/structure.scss', 'resources/scss/layouts/horizontal-dark-menu/dark/structure.scss'])
        @else
            @vite(['resources/scss/layouts/modern-light-menu/light/structure.scss', 'resources/scss/layouts/modern-light-menu/dark/structure.scss'])
        @endif

    @endif

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{ $headerFiles }}
    <!-- END GLOBAL MANDATORY STYLES -->
</head>

<body @class([
    // 'layout-dark' => $isDark,
    'layout-boxed' => $isBoxed,
    'alt-menu' =>
        $isAltMenu || Request::routeIs('collapsibleMenu') ? true : false,
    'error' => Request::routeIs('404') ? true : false,
    'maintanence' => Request::routeIs('maintenance') ? true : false,
])
    @if ($scrollspy == 1) {{ $scrollspyConfig }} @else {{ '' }} @endif
    @if (Request::routeIs('fullWidth')) layout="full-width" @endif>

    <!-- BEGIN LOADER -->
    <x-layout-loader />
    <!--  END LOADER -->

    {{--

    /*
    *
    *   Check if the routes are not single pages ( which does not contains sidebar or topbar  ) such as :-
    *   - 404
    *   - maintenance
    *   - authentication
    *
    */

    --}}

    @if (
        !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&
            // Real Logins
            !Request::routeIs('login') &&
            !(request()->getRequestUri() == '/'))

        @if (!Request::routeIs('blank'))

            @if (Request::is('modern-light-menu/*'))
                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{ $isBoxed ? 'container-xxl' : '' }}" />
                <!--  END NAVBAR  -->
            @elseif (Request::is('modern-dark-menu/*'))
                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{ $isBoxed ? 'container-xxl' : '' }}" />
                <!--  END NAVBAR  -->
            @elseif (Request::is('collapsible-menu/*'))
                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{ $isBoxed ? 'container-xxl' : '' }}" />
                <!--  END NAVBAR  -->
            @elseif (Request::is('horizontal-light-menu/*'))
                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-horizontal-menu />
                <!--  END NAVBAR  -->
            @elseif (Request::is('horizontal-dark-menu/*'))
                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-horizontal-menu />
                <!--  END NAVBAR  -->
            @else
                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{ $isBoxed ? 'container-xxl' : '' }}" />
                <!--  END NAVBAR  -->
            @endif

        @endif

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container " id="container">

            <!--  BEGIN LOADER  -->
            <x-layout-overlay />
            <!--  END LOADER  -->

            @if (!Request::routeIs('blank'))

                @if (Request::is('modern-light-menu/*'))
                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu />
                    <!--  END SIDEBAR  -->
                @elseif (Request::is('modern-dark-menu/*'))
                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu />
                    <!--  END SIDEBAR  -->
                @elseif (Request::is('collapsible-menu/*'))
                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu />
                    <!--  END SIDEBAR  -->
                @elseif (Request::is('horizontal-light-menu/*'))
                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.horizontal-menu />
                    <!--  END SIDEBAR  -->
                @elseif (Request::is('horizontal-dark-menu/*'))
                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.horizontal-menu />
                    <!--  END SIDEBAR  -->
                @else
                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu />
                    <!--  END SIDEBAR  -->
                @endif

            @endif



            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content {{ Request::routeIs('blank') ? 'ms-0 mt-0' : '' }}">

                <div style="position: absolute; top: 0; right: 0;z-index: 9999; margin-left: 20px; margin-right: 20px;">
                    <div class="toast toast-primary fade hide" role="alert" data-bs-delay="6000" aria-live="assertive"
                        aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">Bootstrap</strong>
                            <small class="meta-time">just now</small>
                            <button type="button" class="ms-2 mb-1 btn-close" data-bs-dismiss="toast"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Hello, world! This is a toast message.
                        </div>
                    </div>
                </div>

                @if ($scrollspy == 1)
                    <div class="container">
                        <div class="container">
                            {{ $slot }}
                        </div>
                    </div>
                @else
                    <div class="layout-px-spacing">
                        <div class="middle-content {{ $isBoxed ? 'container-xxl' : '' }} p-0">
                            {{ $slot }}
                        </div>
                    </div>
                @endif

                <!--  BEGIN FOOTER  -->
                <x-layout-footer />
                <!--  END FOOTER  -->

            </div>
            <!--  END CONTENT AREA  -->

        </div>
        <!--  END MAIN CONTAINER  -->
    @else
        {{ $slot }}
    @endif

    @if (
        !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&
            // Real Logins
            !Request::routeIs('login') &&
            !(request()->getRequestUri() == '/'))
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('plugins/mousetrap/mousetrap.min.js') }}"></script>
        <script src="{{ asset('plugins/waves/waves.min.js') }}"></script>
        <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
        @if ($scrollspy == 1)
            @vite(['resources/assets/js/scrollspyNav.js'])
        @endif

        @if (Request::is('modern-light-menu/*'))
            @vite(['resources/layouts/modern-light-menu/app.js'])
        @elseif (Request::is('modern-dark-menu/*'))
            @vite(['resources/layouts/modern-dark-menu/app.js'])
        @elseif (Request::is('collapsible-menu/*'))
            @vite(['resources/layouts/collapsible-menu/app.js'])
        @elseif (Request::is('horizontal-light-menu/*'))
            @vite(['resources/layouts/horizontal-light-menu/app.js'])
        @elseif (Request::is('horizontal-dark-menu/*'))
            @vite(['resources/layouts/horizontal-dark-menu/app.js'])
        @else
            @vite(['resources/layouts/modern-light-menu/app.js'])
        @endif
        <!-- END GLOBAL MANDATORY STYLES -->

    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script src="//js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('plugins/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!--siempre el custom al final-->
    <script src="{{ asset('js/custom.js') }}"></script>
    @vite(['resources/assets/js/custom.js'])
    {{ $footerFiles }}
</body>

</html>
