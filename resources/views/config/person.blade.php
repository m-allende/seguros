<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('plugins/flatpickr/flatpickr.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/noUiSlider/nouislider.min.css') }}">
        @vite(['resources/scss/light/plugins/flatpickr/custom-flatpickr.scss'])
        @vite(['resources/scss/dark/plugins/flatpickr/custom-flatpickr.scss'])
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

        <div class="seperator-header">
            <h4 class="">{{ $title }}</h4>
        </div>

        <div class="card">
            <div class="row">
                <!-- Botón Volver alineado a la izquierda -->
                <div class="col d-flex align-items-start">
                    <button type="button" class="btn btn-sm btn-secondary mt-3 ms-3" onclick="window.history.back();">
                        @lang('translation.return')
                    </button>
                </div>

                <!-- Botones Agregar y Exportar alineados a la derecha -->
                <div class="col d-flex justify-content-end align-items-start">
                    <div class="btn-group mt-3 me-3" role="group" aria-label="Botones de acción">
                        <button type="button" class="btn btn-sm btn-primary btn-add">@lang('translation.add')</button>
                        <div class="btn-group" role="group">
                            <button id="btnExport" type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                @lang('translation.export')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnExport">
                                <li><a class="dropdown-item export-excel" href="#">Excel</a></li>
                                <li><a class="dropdown-item" href="#">PDF</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row layout-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table id="crud" class="table dt-table-hover dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10%">#</th>
                                            <th>RUT</th>
                                            <th>@lang('translation.name')</th>
                                            <th>Abr.</th>
                                            <th style="width: 10%">@lang('translation.status')</th>
                                            <th class="text-center dt-no-sorting w-25">@lang('translation.actions')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-person" class="modal" tabindex="-1" role="dialog" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-person" role="document">
                <div class="modal-content modal-content-light">
                    <div class="modal-header">
                        <h5 class="modal-title modal-title-person"></h5>
                        <button type="button" class="btn-close close-modal-person" data-bs-dismiss="modal"
                            aria-label="Close">
                            <svg> ... </svg>
                        </button>
                    </div>
                    <div class="modal-body modal-body-fix modal-body-person">
                        @include('modals.person', ['add' => true])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary btn-save-person">@lang('translation.save')</button>
                        <button type="button"
                            class="btn btn-sm btn-primary btn-update-person">@lang('translation.update')</button>
                        <button type="button"
                            class="btn btn-sm btn-secondary close-modal-person">@lang('translation.close')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script>
            let table
            $(document).ready(function() {
                table = $('#crud').DataTable({
                    ajax: '/config/person',
                    serverSide: true,
                    processing: true,
                    aaSorting: [
                        [0, "asc"]
                    ],
                    language: {
                        url: "{{ asset('plugins/table/datatable/es-ES.json') }}",
                    },
                    scrollY: '400px',
                    lengthMenu: [10, 20, 50, 100, 500],
                    pageLength: 10,
                    dom: domDT,
                    search: {
                        return: true
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'identification',
                            name: 'identification'
                        },
                        {
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'abbreviation',
                            name: 'abbreviation'
                        },
                        {
                            data: 'deleted_at',
                            name: 'status',
                            render: function(data, type, row) {
                                if (data == null) {
                                    html =
                                        '<span class="shadow-none badge badge-success">Vigente</span>';
                                } else {
                                    html =
                                        '<span class="shadow-none badge badge-danger">No Vigente</span>';
                                }
                                return html;
                            }
                        },
                        {
                            data: 'id',
                            orderable: false,
                            render: function(data, type, row) {
                                html = '<div class="form-group">';
                                if (row.deleted_at == null) {
                                    html +=
                                        '<a class="btn-edit-person" data-toggle="tooltip" data-placement="top" title="Editar" href="#"><span class="shadow-none badge badge-primary">@lang('translation.edit')</span></a>&nbsp;';

                                    html +=
                                        '<a href="javascript:void(0);" class="bs-tooltip btn-delete-person" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"  data-rowid="' +
                                        row.id +
                                        '"><span class="shadow-none badge badge-danger">@lang('translation.delete')</span></a>';
                                } else {
                                    html +=
                                        '<a href="javascript:void(0);" class="bs-tooltip btn-activate-person" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"  data-param1="' +
                                        row.id +
                                        '"><span class="shadow-none badge badge-success">@lang('translation.activate')</span></a>';
                                }

                                html += '</div>';
                                return html;
                            }
                        },
                    ]
                }).on('processing.dt', function(e, settings, processing) {
                    if (processing) {
                        Swal.fire({
                            title: "@lang('translation.please-wait')",
                            timer: 1000000,
                            timerProgressBar: true,
                            showCloseButton: true,
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        });
                    } else {
                        Swal.close();
                    }
                });
            })
        </script>
        @include('modals.person-scripts', ['option' => 1])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
