<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        @lang('translation.settings')
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" />
        <style>
            /* arreglo para mostrar autocomplete en modal! */
            .pac-container {
                z-index: 1061 !important;
            }

            .swal2-container {
                z-index: 3000;
            }
        </style>

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="row layout-top-spacing">
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">

                    @inject('menus', 'App\Models\Menu')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($menus->settings() as $menu)
                        @foreach ($menu['submenu'] as $submenu)
                            <div class="card">
                                <div class="card-header">
                                    <h4><i
                                            class="{{ $submenu['icon'] != '' ? $submenu['icon'] : 'fa-solid fa-gears' }}"></i>@lang('translation.' . $submenu['name'])
                                    </h4>
                                </div>
                                <div class="card-body">
                                    @foreach ($submenu['submenu'] as $field)
                                        <span class="badge badge-light-primary mb-2 me-4"><a href="{{ $field['url'] }}"
                                                class="list-group-item list-group-item-action"><i
                                                    class="{{ $field['icon'] != '' ? $field['icon'] : 'fa-solid fa-check' }}"></i>@lang('translation.' . $field['name'])</a></span>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
