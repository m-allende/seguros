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
                                            <th>@lang('translation.name')</th>
                                            <th>Usado en</th>
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


        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
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
                                <input type="text" name="name" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="used_in[]">Usado en</label>
                                <select name="used_in[]" id="used_in" multiple class="form-select mb-3 select2-used">
                                    <option value="Emails">@lang('es.Emails')</option>
                                    <option value="Phones">@lang('es.Phones')</option>
                                    <option value="Address">@lang('es.Address')</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary btn-save">@lang('translation.save')</button>
                            <button type="button" class="btn btn-sm btn-primary btn-update">@lang('translation.update')</button>
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">@lang('translation.close')</button>
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
                $('.modal').find('.modal-title').text('Agregar nuevo Tipo')
                $('.btn-save').show();
                $('.btn-update').hide()
            })

            $(document).ready(function() {
                let modal = $('.modal');
                let form = $('.form');
                let btnSave = $('.btn-save'),
                    btnUpdate = $('.btn-update');

                let table = $('#crud').DataTable({
                    ajax: '/config/type',
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
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'used_in',
                            name: 'used_in',
                            render: function(data, type, row) {
                                let html = "";
                                if (data != "") {
                                    let arr = data.split(";");
                                    arr.forEach(element => {
                                        switch (element) {
                                            case "Phones":
                                                html += "@lang('es.Phones') <br>";
                                                break;
                                            case "Emails":
                                                html += "@lang('es.Emails') <br>";
                                                break;
                                            case "Address":
                                                html += "@lang('es.Address') <br>";
                                                break;
                                        }
                                    });
                                }
                                return html;
                            }
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
                                        '<a class="btn-edit" data-toggle="tooltip" data-placement="top" title="Editar" href="#"><span class="shadow-none badge badge-primary">@lang('translation.edit')</span></a>&nbsp;';

                                    html +=
                                        '<a href="javascript:void(0);" class="bs-tooltip btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"  data-rowid="' +
                                        row.id +
                                        '"><span class="shadow-none badge badge-danger">@lang('translation.delete')</span></a>';
                                } else {
                                    html +=
                                        '<a href="javascript:void(0);" class="bs-tooltip btn-activate" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"  data-param1="' +
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

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                btnSave.click(function(e) {
                    e.preventDefault();
                    let data = form.serialize()
                    console.log(data)
                    $.ajax({
                        type: "POST",
                        url: "{{ route('type.store') }}",
                        data: data,
                        success: function(data) {
                            if (data.status == 200) {
                                table.draw();
                                form.trigger("reset");
                                modal.modal('hide');
                            } else {
                                let error = '';
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

                    modal.find('.modal-title').text('Modificar Tipo')
                    modal.find('.modal-footer button[type="submit"]').text('Modificar')

                    let rowData = table.row($(this).parents('tr')).data()

                    form.find('input[name="id"]').val(rowData.id)
                    form.find('input[name="name"]').val(rowData.name)

                    let arr = rowData.used_in.split(";");
                    $('#used_in').val(arr);
                    $('#used_in').trigger('change');

                    modal.modal("show")
                })

                btnUpdate.click(function() {
                    let formData = form.serialize() + '&_method=PUT'
                    let updateId = form.find('input[name="id"]').val();
                    $.ajax({
                        type: "POST",
                        url: "/config/type/" + updateId,
                        data: formData,
                        success: function(data) {
                            if (data.status == 200) {
                                table.draw();
                                modal.modal('hide');
                            } else {
                                let error = '';
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


                $(document).on('click', '.btn-delete', function() {
                    let rowid = $(this).data('rowid')
                    let el = $(this)
                    let token = $('meta[name="csrf-token"]').attr('content')
                    if (!rowid) return;

                    Swal.fire({
                        title: "@lang('translation.question-delete')",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "@lang('translation.yes')",
                        cancelButtonText: "No",
                        showCloseButton: true
                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                type: "POST",
                                dataType: 'JSON',
                                url: "/config/type/" + rowid,
                                data: {
                                    _method: 'delete',
                                    _token: token
                                },
                                success: function(data) {
                                    if (data.status == 200) {
                                        table.row(el.parents('tr'))
                                            .remove()
                                            .draw();
                                    }
                                }
                            }); //end ajax
                        }
                    });
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
                            url: "{{ route('type.export') }}",
                            success: function(datos) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "@lang('translation.warning-report-second-plane')",
                                    confirmButtonClass: 'btn btn-sm btn-primary w-xs',
                                    buttonsStyling: false
                                });
                            },
                            error: function(datos) {
                                sweetError(datos);
                            }
                        });
                    });
                $(document).on("click", '.btn-activate',
                    function(event) {
                        let id = $(this).data("param1");

                        Swal.fire({
                            title: "¿Desea dejar Vigente este Tipo?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "@lang('translation.yes')",
                            cancelButtonText: "No",
                            showCloseButton: true
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    type: "POST",
                                    url: "/config/type/activate",
                                    data: "id=" + id,
                                    success: function(datos) {
                                        table.draw();
                                    },
                                    error: function(datos) {
                                        sweetError(datos);
                                    }
                                });
                            }

                        });
                    });
            })
        </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
