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
                                            <th>Descripción</th>
                                            <th>Email</th>
                                            <th>Rol</th>
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
                <form class="form" action="" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">@lang('translation.name')</label>
                                        <input type="text" name="name" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input type="text" name="description" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="role_id">Rol</label>
                                <select name="role_id" id="role_id"
                                    class=" form-select form-control form-control-sm select2-role-modal w-100">
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-save">@lang('translation.save')</button>
                            <button type="button" class="btn btn-primary btn-update">@lang('translation.update')</button>
                            <button type="button" class="btn btn-secondary"
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
                $('.modal').find('.modal-title').text('Agregar nuevo Usuario')
                $('.btn-save').show();
                $('.btn-update').hide()
            })

            $(document).ready(function() {
                var modal = $('.modal');
                var form = $('.form');
                var btnSave = $('.btn-save'),
                    btnUpdate = $('.btn-update');

                var table = $('#crud').DataTable({
                    ajax: '/access/user',
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
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'roles[0].name',
                            name: 'roles[0].name'
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
                                    if (row.roles[0].id != 1) {
                                        html +=
                                            '<a class="btn-edit" data-toggle="tooltip" data-placement="top" title="Editar" href="#"><span class="shadow-none badge badge-primary">@lang('translation.edit')</span></a>&nbsp;';
                                    }

                                    html +=
                                        '<a class="btn-profile" data-toggle="tooltip" data-placement="top" title="Profile" href="/access/user/' +
                                        data +
                                        '"><span class="shadow-none badge badge-primary">Perfil</span></a>&nbsp;';
                                    if (row.roles[0].id != 1) {
                                        html +=
                                            '<a href="javascript:void(0);" class="bs-tooltip btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"  data-rowid="' +
                                            row.id +
                                            '"><span class="shadow-none badge badge-danger">@lang('translation.delete')</span></a>';
                                    }

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
                    var data = form.serialize()
                    console.log(data)
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user.store') }}",
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

                    modal.find('.modal-title').text('Modificar Usuario')
                    modal.find('.modal-footer button[type="submit"]').text('Modificar')

                    var rowData = table.row($(this).parents('tr')).data()

                    form.find('input[name="id"]').val(rowData.id)
                    form.find('input[name="name"]').val(rowData.name)
                    form.find('input[name="email"]').val(rowData.email)
                    form.find('input[name="description"]').val(rowData.description)

                    var newOption = new Option(rowData.roles[0].name, rowData.roles[0].id, true, true);
                    $('#role_id').append(newOption).trigger('change');

                    modal.modal("show")
                })

                btnUpdate.click(function() {
                    var formData = form.serialize() + '&_method=PUT'
                    var updateId = form.find('input[name="id"]').val();
                    $.ajax({
                        type: "POST",
                        url: "/access/user/" + updateId,
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
                                url: "/access/user/" + rowid,
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
                            url: "{{ route('user.export') }}",
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
                $(document).on("click", '.btn-activate',
                    function(event) {
                        var id = $(this).data("param1");

                        Swal.fire({
                            title: "¿Desea dejar Vigente este Usuario?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "@lang('translation.yes')",
                            cancelButtonText: "No",
                            showCloseButton: true
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    type: "POST",
                                    url: "/access/user/activate",
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
