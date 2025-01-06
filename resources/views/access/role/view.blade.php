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

        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Rol : {{ $role->name }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <tr>
                                <th>Nombre: </th>
                                <td>{{ $role->name }}</td>
                            </tr>
                            <tr>
                                <th>Fecha de Creación</th>
                                <td>{{ $role->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Usuarios con rol "{{ $role->name }}"</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">No hay registro</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Modulos Activos</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion">
                            @foreach ($permissions as $module => $permission)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#panelAccordion-{{ $module }}"
                                            aria-controls="panelAccordion-{{ $module }}">
                                            @lang('es.' . $module)
                                        </button>
                                    </h2>
                                    <div id="panelAccordion-{{ $module }}" class="accordion-collapse collapse"
                                        aria-labelledby="panelAccordion-{{ $module }}-headingOne">
                                        <div class="accordion-body">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Descripción</th>
                                                        <th>Accion</th>
                                                        @foreach ($permOrder as $item)
                                                            <th>@lang('es.' . $item)</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($permission as $name => $perm)
                                                        <tr>
                                                            <td>
                                                                @lang('es.' . $name)
                                                            </td>
                                                            <td>
                                                                @lang('es.' . $name)
                                                            </td>
                                                            @foreach ($permOrder as $item)
                                                                <td>
                                                                    @if (isset($perm[$item]))
                                                                        @php
                                                                            $flag = false;
                                                                            foreach (
                                                                                $role->permissions
                                                                                as $rolePermission
                                                                            ) {
                                                                                if (
                                                                                    $rolePermission->name ==
                                                                                    $module . '-' . $name . '-' . $item
                                                                                ) {
                                                                                    $flag = true;
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        <input type="checkbox"
                                                                            class="form-check-input @if ($item == 'admin') chk-admin @endif"
                                                                            @if ($flag) checked="checked" @endif
                                                                            name="{{ $module }}-{{ $name }}-{{ $item }}"
                                                                            id="{{ $module }}-{{ $name }}-{{ $item }}">
                                                                    @else
                                                                        &nbsp;
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!--end col-->
        </div>
        <!--end row-->

        <!--  BEGIN CUSTOM SCRIPTS FILE  -->
        <x-slot:footerFiles>
            <script>
                $(document).ready(function() {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                });

                $('.form-check-input').click(function(event) {
                    graba($(this).prop("checked"), $(this).attr("name"));
                });

                $('.chk-admin').click(function(event) {
                    var name = $(this).attr("name");
                    if (name == "ratings-admin-admin") {
                        $("#ratings-admin-create").prop("checked", $(this).prop("checked"));
                        $("#ratings-admin-view").prop("checked", $(this).prop("checked"));
                        $("#ratings-admin-edit").prop("checked", $(this).prop("checked"));
                        $("#ratings-admin-delete").prop("checked", $(this).prop("checked"));

                        graba($(this).prop("checked"), "ratings-admin-create");
                        graba($(this).prop("checked"), "ratings-admin-view");
                        graba($(this).prop("checked"), "ratings-admin-edit");
                        graba($(this).prop("checked"), "ratings-admin-delete");
                        return true;
                    } else {
                        $("#" + name.replace("admin", "create")).prop("checked", $(this).prop("checked"));
                        $("#" + name.replace("admin", "view")).prop("checked", $(this).prop("checked"));
                        $("#" + name.replace("admin", "edit")).prop("checked", $(this).prop("checked"));
                        $("#" + name.replace("admin", "delete")).prop("checked", $(this).prop("checked"));
                    }

                    graba($(this).prop("checked"), name.replace("admin", "create"));
                    graba($(this).prop("checked"), name.replace("admin", "view"));
                    graba($(this).prop("checked"), name.replace("admin", "edit"));
                    graba($(this).prop("checked"), name.replace("admin", "delete"));
                });

                function graba(check, name) {
                    var url = "";
                    var data = "";
                    if (check) {
                        url = "/access/role/givePermission";
                        data = "id={{ $role->id }}&add=" + name;
                    } else {
                        url = "/access/role/revokePermission";
                        data = "id={{ $role->id }}&revoke=" + name;
                    }
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        success: function(datos) {},
                        error: function(datos) {
                            Swal.fire({
                                icon: 'error',
                                title: "Error",
                                html: "Error al grabar",
                                confirmButtonClass: 'btn btn-primary w-xs',
                                buttonsStyling: false
                            })
                        }
                    });
                }
            </script>

        </x-slot>
        <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
