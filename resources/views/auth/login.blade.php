<x-base-layout :scrollspy="false" :isBoxed="true">

    <x-slot:pageTitle>
        {{-- {{$title}}  --}}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/authentication/auth-boxed.scss'])
        @vite(['resources/scss/dark/assets/authentication/auth-boxed.scss'])

        <style>
            #load_screen {
                display: none;
            }
        </style>
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">
                <form id="frmLogin" autocomplete="off" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div
                        class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                        <div class="card mt-3 mb-3">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <h2>Iniciar Sesión</h2>
                                        <p>Ingrese su nombre de usuario y contraseña</p>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Usuario</label>
                                            <input name="email" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Contraseña</label>
                                            <input name="password" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox"
                                                    id="form-check-default">
                                                <label class="form-check-label" for="form-check-default">
                                                    Recuerdame
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button class="btn btn-secondary w-100" id="btnSubmit"
                                                type="button">Aceptar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

        <script>
            $(document).on("click", '#btnSubmit',
                function(event) {
                    //var form = $(this).closest("form");
                    var formData = new FormData(document.getElementById("frmLogin"));
                    event.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "/login",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(datos) {
                            if (datos.status == 200) {
                                $("#frmLogin").submit();
                            } else if (datos.status == 402) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "Error",
                                    html: datos.errors,
                                    confirmButtonClass: 'btn btn-primary w-xs',
                                    buttonsStyling: false
                                })
                            } else if (datos.status == 401) {
                                Swal.fire({
                                    title: "Usuario ya se encuentra con sesión iniciada, <br> ¿Desea Cerrar la Sesion?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                                    confirmButtonText: "@lang('translation.yes')",
                                    cancelButtonText: "@lang('translation.no')",
                                    buttonsStyling: false,
                                    showCloseButton: true
                                }).then(function(result) {
                                    if (result.value) {
                                        var formData = new FormData(document.getElementById(
                                            "frmLogin"));
                                        formData.append("close", true);
                                        formData.submit
                                        $.ajax({
                                            type: "POST",
                                            url: "/login",
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            success: function(datos) {
                                                if (datos.status == 200) {
                                                    location.reload();
                                                } else {

                                                }
                                            },
                                            error: function(datos) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: "Error",
                                                    html: datos,
                                                    confirmButtonClass: 'btn btn-primary w-xs',
                                                    buttonsStyling: false
                                                })
                                            }
                                        });
                                    }
                                });
                            } else {
                                var error = '';
                                $.each(datos.errors, function(key, err_values) {
                                    error += err_values
                                    error += '<br>';
                                    $("#formLogin #" + key).next()
                                        .addClass(
                                            "border border-danger");
                                    $("#formLogin #" + key).addClass(
                                        "border border-danger");
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: "Error",
                                    html: error,
                                    confirmButtonClass: 'btn btn-primary w-xs',
                                    buttonsStyling: false

                                })
                            }
                        },
                        error: function(datos) {
                            Swal.fire({
                                icon: 'error',
                                title: "Error",
                                html: datos,
                                confirmButtonClass: 'btn btn-primary w-xs',
                                buttonsStyling: false
                            })
                        }
                    });

                });
        </script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
