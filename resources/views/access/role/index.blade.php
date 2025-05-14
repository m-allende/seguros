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

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="row layout-top-spacing">

        <div class="seperator-header">
            <h4 class="">{{ $title }}</h4>
        </div>

        <div class="card">
            <div class="col-header text-end mr-3">
                <div class="btn-group  mt-3 me-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary btn-add">@lang('translation.add')</button>
                    <div class="btn-group" role="group">
                        <button id="btnExport" type="button" class="btn btn-primary dropdown-toggle"
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
            <div class="card-body">
                <div class="row layout-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table id="crud" class="table dt-table-hover dataTable no-footer">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10%">#</th>
                                            <th>@lang('translation.name')</th>
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


        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <form class="form" action="" method="POST" autocomplete="off">
                    <div class="modal-content modal-content-light">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg> ... </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id">
                            @csrf
                            <div class="form-group">
                                <label for="name">@lang('translation.name')</label>
                                <input type="text" name="name" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-save">@lang('translation.save')</button>
                            <button type="button" class="btn btn-primary btn-update">@lang('translation.update')</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@lang('translation.close')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script>
            $(document).on('click', '.btn-add', function() {
                $('.modal').modal("show")
                $('.form').trigger('reset')
                $('.modal').find('.modal-title').text('Agregar nueva')
                $('.btn-save').show();
                $('.btn-update').hide()
            })

            $(document).ready(function() {
                var modal = $('.modal');
                var form = $('.form');
                var btnSave = $('.btn-save'),
                    btnUpdate = $('.btn-update');

                var table = $('#crud').DataTable({
                    ajax: '/access/role',
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
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'id',
                            orderable: false,
                            render: function(data, type, row) {
                                html = '<div class="form-group">';
                                html +=
                                    '<a class="btn-edit" data-toggle="tooltip" data-placement="top" title="Editar" href="#"><span class="shadow-none badge badge-primary">@lang('translation.edit')</span></a>&nbsp;';
                                html +=
                                    '<a class="" data-toggle="tooltip" data-placement="top" title="Permisos" href="/access/role/' +
                                    data +
                                    '"><span class="shadow-none badge badge-primary">Ver Permisos</span></a>&nbsp;';
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

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                btnSave.click(function(e) {
                    e.preventDefault();
                    var data = form.serialize()
                    console.log(data)
                    $.ajax({
                        type: "POST",
                        url: "{{ route('role.store') }}",
                        data: data,
                        success: function(data) {
                            if (data.status == 200) {
                                table.draw();
                                form.trigger("reset");
                                modal.modal('hide');
                            } else {
                                var error = '';
                                $.each(data.errors, function(key, err_values) {
                                    error += err_values
                                    error += '<br>';
                                });
                                sweetError(error);
                            }
                        },
                        error: function(data) {
                            sweetError("Error al Grabar");
                        }
                    });
                })


                $(document).on('click', '.btn-edit', function() {
                    btnSave.hide();
                    btnUpdate.show();

                    modal.find('.modal-title').text('Modificar compañia')
                    modal.find('.modal-footer button[type="submit"]').text('Modificar')

                    var rowData = table.row($(this).parents('tr')).data()

                    form.find('input[name="id"]').val(rowData.id)
                    form.find('input[name="name"]').val(rowData.name)
                    modal.modal("show")
                })

                btnUpdate.click(function() {
                    var formData = form.serialize() + '&_method=PUT'
                    var updateId = form.find('input[name="id"]').val();
                    $.ajax({
                        type: "POST",
                        url: "/access/role/" + updateId,
                        data: formData,
                        success: function(data) {
                            if (data.status == 200) {
                                table.draw();
                                modal.modal('hide');
                            } else {
                                var error = '';
                                $.each(data.errors, function(key, err_values) {
                                    error += err_values
                                    error += '<br>';
                                });
                                sweetError(error);
                            }
                        },
                        error: function(data) {
                            sweetError("Error al grabar");
                        }
                    }); //end ajax
                })

                $(document).on("click", '.export-excel',
                    function(event) {
                        Swal.fire({
                            title: "@lang('translation.please-wait')",
                            timer: 1000000,
                            timerProgressBar: true,
                            showCloseButton: true,
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        });
                        $.ajax({
                            type: "GET",
                            url: "{{ route('role.export') }}",
                            success: function(datos) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "@lang('translation.warning-report-second-plane')",
                                    confirmButtonClass: 'btn btn-primary w-xs',
                                    buttonsStyling: false
                                });
                            },
                            error: function(datos) {
                                sweetError(datos);
                            }
                        });
                    });
            })
        </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
