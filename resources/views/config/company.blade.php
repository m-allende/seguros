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
            <div class="col-header text-end mr-3">
                <div class="btn-group  mt-3 me-3" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary btn-add">Agregar</button>
                    <div class="btn-group" role="group">
                        <button id="btnExport" type="button" class="btn btn-primary dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Exportar
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
                                            <th>RUT</th>
                                            <th>Nombre</th>
                                            <th>Abr.</th>
                                            <th style="width: 10%">Estado</th>
                                            <th class="text-center dt-no-sorting w-25">Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="modal" class="modal" tabindex="-1" role="dialog" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <form class="form" action="" method="POST" autocomplete="off">
                    <div class="modal-content modal-content-light">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <svg> ... </svg>
                            </button>
                        </div>
                        <div class="modal-body modal-body-fix">
                            <input type="hidden" name="id">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group w-50">
                                        <label for="identification">RUT</label>
                                        <input type="text" name="identification"
                                            class="form-control form-control-sm text-end identification"
                                            placeholder="99999999-9">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type_id">Tipo</label>
                                        <select name="type_id" id="type_id"
                                            class="form-select form-control form-control-sm w-100">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control form-control-sm">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="short_name">Nombre corto</label>
                                        <input type="text" name="short_name" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="abbreviation">Abreviación</label>
                                        <input type="text" name="abbreviation"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website">Página Web</label>
                                <input type="text" name="website" class="form-control form-control-sm">
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-9">
                                    <h6>Direcciones</h6>
                                </div>
                                <div class="col-3">
                                    <button type="button" data-cont="0"
                                        class="btn btn-sm btn-primary btn-add-address">Agregar
                                        Dirección</button>
                                </div>
                            </div>
                            <div class="p-3" id="container-address">

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-9">
                                    <h6>Emails</h6>
                                </div>
                                <div class="col-3">
                                    <button type="button" data-cont="0"
                                        class="btn btn-sm btn-primary btn-add-email">Agregar
                                        Email</button>
                                </div>
                            </div>
                            <div class="p-3" id="container-email">

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-9">
                                    <h6>Telefonos</h6>
                                </div>
                                <div class="col-3">
                                    <button type="button" data-cont="0"
                                        class="btn btn-sm btn-primary btn-add-phone">Agregar
                                        Teléfono</button>
                                </div>
                            </div>
                            <div class="p-3" id="container-phone">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary btn-save">Guardar</button>
                            <button type="button" class="btn btn-sm btn-primary btn-update">Actualizar</button>
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script>
            var formClone = $(".modal-dialog").clone();
            $(document).on('click', '.btn-add', function() {
                $('.modal').modal("show")
                $(".modal-dialog").replaceWith(formClone.clone());
                $('.modal').find('.modal-title').text('Agregar nueva Compañía')
                $('.btn-save').show();

                $("#type_id").select2({
                    placeholder: "Seleccione...",
                    dropdownParent: $(".modal"),
                    escapeMarkup: function(markup) {
                        return markup;
                    }, // let our custom formatter work
                    ajax: {
                        type: "GET",
                        url: function(params) {
                            return "/code";
                        },
                        data: function(params) {
                            var queryParameters = {
                                search: params.term,
                                type: "company",
                            };
                            return queryParameters;
                        },
                        processResults: function(data) {
                            return {
                                results: data.data,
                            };
                        },
                    },
                    templateResult: formatData,
                    templateSelection: formatDataSelection,
                    createTag: function(params) {
                        var term = $.trim(params.term);
                        if (term === "") {
                            return null;
                        }
                        return {
                            id: term,
                            text: term,
                            newTag: true, // add additional parameters
                        };
                    },
                });
                $('.btn-update').hide()
            })

            $(document).ready(function() {
                var modal = $('.modal');

                var table = $('#crud').DataTable({
                    ajax: '/config/company',
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
                            data: 'name',
                            name: 'name'
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
                                        '<a class="btn-edit" data-toggle="tooltip" data-placement="top" title="Editar" href="#"><span class="shadow-none badge badge-primary">Editar</span></a>&nbsp;';

                                    html +=
                                        '<a href="javascript:void(0);" class="bs-tooltip btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"  data-rowid="' +
                                        row.id +
                                        '"><span class="shadow-none badge badge-danger">Eliminar</span></a>';
                                } else {
                                    html +=
                                        '<a href="javascript:void(0);" class="bs-tooltip btn-activate" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"  data-param1="' +
                                        row.id +
                                        '"><span class="shadow-none badge badge-success">Activar</span></a>';
                                }

                                html += '</div>';
                                return html;
                            }
                        },
                    ]
                }).on('processing.dt', function(e, settings, processing) {
                    if (processing) {
                        Swal.fire({
                            title: "Favor Esperar",
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

                $(document).on('click', '.btn-save', function(e) {
                    e.preventDefault();
                    var data = $('.form').serialize() + '&cont_address=' + $(".btn-add-address")
                        .data(
                            "cont") + '&cont_email=' + $(".btn-add-email").data(
                            "cont") + '&cont_phone=' + $(".btn-add-phone").data(
                            "cont");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('company.store') }}",
                        data: data,
                        success: function(data) {
                            if (data.status == 200) {
                                table.draw();
                                $('.form').trigger("reset");
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
                    $(".modal-dialog").replaceWith(formClone.clone());

                    $('.btn-save').hide();
                    $('.btn-update').show();

                    modal.find('.modal-title').text('Modificar compañia')
                    modal.find('.modal-footer button[type="submit"]').text('Modificar')

                    var rowData = table.row($(this).parents('tr')).data()

                    $('.form').find('input[name="id"]').val(rowData.id)
                    $('.form').find('input[name="name"]').val(rowData.name)
                    $('.form').find('input[name="short_name"]').val(rowData.short_name)
                    $('.form').find('input[name="abbreviation"]').val(rowData.abbreviation)
                    $('.form').find('input[name="identification"]').val(rowData.identification)
                    $('.form').find('input[name="website"]').val(rowData.website)

                    $("#type_id").select2({
                        placeholder: "Seleccione...",
                        dropdownParent: $(".modal"),
                        escapeMarkup: function(markup) {
                            return markup;
                        }, // let our custom formatter work
                        ajax: {
                            type: "GET",
                            url: function(params) {
                                return "/code";
                            },
                            data: function(params) {
                                var queryParameters = {
                                    search: params.term,
                                    type: "company",
                                };
                                return queryParameters;
                            },
                            processResults: function(data) {
                                return {
                                    results: data.data,
                                };
                            },
                        },
                        templateResult: formatData,
                        templateSelection: formatDataSelection,
                        createTag: function(params) {
                            var term = $.trim(params.term);
                            if (term === "") {
                                return null;
                            }
                            return {
                                id: term,
                                text: term,
                                newTag: true, // add additional parameters
                            };
                        },
                    });

                    var newOption = new Option(
                        rowData.type.name,
                        rowData.type.id,
                        true,
                        true
                    );
                    $("#type_id")
                        .append(newOption)
                        .trigger("change");

                    chargeAddressDiv(rowData.addresses);
                    chargeEmailsDiv(rowData.emails);
                    chargePhonesDiv(rowData.phones);

                    modal.modal("show")
                })

                $(document).on('click', '.btn-update', function(e) {
                    e.preventDefault();
                    var formData = $('.form').serialize() + '&_method=PUT&cont_address=' + $(".btn-add-address")
                        .data(
                            "cont") + '&cont_email=' + $(".btn-add-email").data(
                            "cont") + '&cont_phone=' + $(".btn-add-phone").data(
                            "cont");
                    var updateId = $('.form').find('input[name="id"]').val();
                    $.ajax({
                        type: "POST",
                        url: "/config/company/" + updateId,
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


                $(document).on('click', '.btn-delete', function() {
                    var rowid = $(this).data('rowid')
                    var el = $(this)
                    var token = $("_token").val()
                    if (!rowid) return;

                    Swal.fire({
                        title: "Esta seguro de eliminar el registro?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Si",
                        cancelButtonText: "No",
                        showCloseButton: true
                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                type: "POST",
                                dataType: 'JSON',
                                url: "/config/company/" + rowid,
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
                            title: "Favor Esperar",
                            timer: 1000000,
                            timerProgressBar: true,
                            showCloseButton: true,
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        });
                        $.ajax({
                            type: "GET",
                            url: "{{ route('company.export') }}",
                            success: function(datos) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "El informe se desacargara en segundo plano, se avisara en la seccion de notificaciones",
                                    confirmButtonClass: 'btn btn-primary w-xs',
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
                        var id = $(this).data("param1");

                        Swal.fire({
                            title: "¿Desea dejar Vigente esta compañia?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Si",
                            cancelButtonText: "No",
                            showCloseButton: true
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    type: "POST",
                                    url: "/config/company/activate",
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

            function prueba(is) {
                var cont = is.attr("id").substring(is.attr("id").indexOf("["));
                var prueba = is.attr("id").indexOf("[") > -1 ?
                    $(
                        "#region_id" +
                        is
                        .attr("id")
                        .substring(
                            is.attr("id").indexOf("[")
                        )
                    ).val() :
                    $("#region_id").val()
                alert(prueba);
            }
        </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
