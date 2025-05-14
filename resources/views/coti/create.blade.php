<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        Inicio
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('css/ck-styles.css') }}" rel="stylesheet" type="text/css" />
        @vite(['resources/scss/light/assets/components/accordions.scss'])
        @vite(['resources/scss/dark/assets/components/accordions.scss'])
        <link rel="stylesheet" href="{{ asset('plugins/flatpickr/flatpickr.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/noUiSlider/nouislider.min.css') }}">
        @vite(['resources/scss/light/plugins/flatpickr/custom-flatpickr.scss'])
        @vite(['resources/scss/dark/plugins/flatpickr/custom-flatpickr.scss'])

        @vite(['resources/scss/light/assets/components/tabs.scss'])
        @vite(['resources/scss/dark/assets/components/tabs.scss'])


        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="row layout-top-spacing">
        <!-- CONTENT HERE -->

        <div class="row" id="divCoti1">
            <div class="col-2"></div>
            <div class="card col-6">
                <div class="card-header">
                    Crear Cotizacion
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="type_document">Documento que se Cotiza</label><br>
                        <select name="type_document" id="type_document"
                            class=" form-select form-control form-control-sm select2-simple">
                            <option value="1">Póliza</option>
                            <option value="2">Endoso de Aumento</option>
                            <option value="3">Endoso de Corte</option>
                            <option value="4">Endoso de Disminución</option>
                            <option value="5">Endoso de Modificación</option>
                        </select>
                    </div>
                    <div class="form-group text-end">
                        <input class="form-check-input" type="checkbox" id="check_renov">
                        <label for="check_renov">Renovación</label>
                    </div>
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6"></div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-sm btn-primary btn-next">Aceptar</button>
                    <button type="button" class="btn btn-sm btn-secondary">Cancelar</button>
                </div>
            </div>
        </div>

        <div id="divCoti2">
            <h2>Crear Cotización</h2>
            <div class="row mb-3">
                <div class="col-4">
                    <div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-danger"> <i class="fa-solid fa-door-open"></i>
                                Volver</button>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-primary"> <i class="fa-solid fa-print"></i>
                                Imprimir</button>
                            <button type="button" class="btn btn-sm btn-success"> <i
                                    class="fa-regular fa-floppy-disk"></i>
                                Grabar</button>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-end">
                        <div class="btn-group" role="group">
                            <button id="btn-first" type="button" class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-backward-fast"></i>
                                Inicio </button>
                            <button id="btn-previus" type="button" class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-backward"></i>
                                Anterior</button>
                            <button id="btn-next" type="button" class="btn btn-sm btn-primary">Siguiente <i
                                    class="fa-solid fa-forward"></i></button>
                            <button id="btn-last" type="button" class="btn btn-sm btn-primary">Fin <i
                                    class="fa-solid fa-forward-fast"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">

                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-0" data-bs-toggle="tab"
                                href="#animated-underline-general" role="tab"
                                aria-controls="animated-underline-general" aria-selected="true"><i
                                    class="fa-solid fa-house"></i> Información General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-1" data-bs-toggle="tab"
                                href="#animated-underline-participant" role="tab"
                                aria-controls="animated-underline-participant" aria-selected="false"
                                tabindex="-1"><i class="fa-solid fa-users"></i> Participantes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-2" data-bs-toggle="tab"
                                href="#animated-underline-intermediary" role="tab"
                                aria-controls="animated-underline-intermediary" aria-selected="false"
                                tabindex="-1"><i class="fa-solid fa-user-tie"></i> Intermediarios</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-3" data-bs-toggle="tab"
                                href="#animated-underline-item" role="tab"
                                aria-controls="animated-underline-item" aria-selected="false" tabindex="-1"><i
                                    class="fa-solid fa-dumpster-fire"></i>
                                Items</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-4" data-bs-toggle="tab"
                                href="#animated-underline-coverage" role="tab"
                                aria-controls="animated-underline-coverage" aria-selected="false" tabindex="-1"><i
                                    class="fa-solid fa-list-check"></i> Resumen Coberturas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-5" data-bs-toggle="tab"
                                href="#animated-underline-deductible" role="tab"
                                aria-controls="animated-underline-deductible" aria-selected="false" tabindex="-1"><i
                                    class="fa-solid fa-list-ul"></i> Resumen Deducibles</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-6" data-bs-toggle="tab"
                                href="#animated-underline-payment" role="tab"
                                aria-controls="animated-underline-payment" aria-selected="false" tabindex="-1"><i
                                    class="fa-solid fa-dollar-sign"></i> Pagos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-7" data-bs-toggle="tab"
                                href="#animated-underline-observation" role="tab"
                                aria-controls="animated-underline-observation" aria-selected="false"
                                tabindex="-1"><i class="fa-regular fa-file-lines"></i> Observaciones</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-8" data-bs-toggle="tab"
                                href="#animated-underline-document" role="tab"
                                aria-controls="animated-underline-document" aria-selected="false" tabindex="-1"><i
                                    class="fa-solid fa-file-import"></i> Documentos</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="animated-underline-general" role="tabpanel"
                    aria-labelledby="tab-0">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">
                                            @include('coti.general')
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="animated-underline-participant" role="tabpanel"
                    aria-labelledby="tab-1">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section participant-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">
                                            @include('coti.participants')
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="animated-underline-intermediary" role="tabpanel"
                    aria-labelledby="tab-2">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section intermediary-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">
                                            @include('coti.intermediaries')
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="animated-underline-item" role="tabpanel"
                    aria-labelledby="tab-3">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section item-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">
                                            @include('coti.items')
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="animated-underline-coverage" role="tabpanel"
                    aria-labelledby="tab-4">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section coverage-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="animated-underline-deductible" role="tabpanel"
                    aria-labelledby="tab-5">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section deductible-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="animated-underline-payment" role="tabpanel"
                    aria-labelledby="tab-6">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section payment-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="animated-underline-observation" role="tabpanel"
                    aria-labelledby="tab-7">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section observation-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">
                                            @include('coti.observation')
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="animated-underline-document" role="tabpanel"
                    aria-labelledby="tab-8">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section document-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="card">
                                            @include('coti.document')
                                        </div>
                                    </div>
                                </div>
                            </form>
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

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="optionTypePerson" id="optionTypePerson" value="">
                        <button type="button"
                            class="btn btn-sm btn-primary btn-save-person">@lang('translation.save')</button>
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
        <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
        <script>
            let tab = 0;

            $(document).ready(function() {
                changeTab();
            })

            $(document).on("click", "#btn-first", function(event) {
                tab = 0;
                changeTab();
            });
            $(document).on("click", "#btn-last", function(event) {
                tab = 8;
                changeTab();
            });
            $(document).on("click", "#btn-next", function(event) {
                tab == 8 ? tab = tab : tab++;
                changeTab();
            });
            $(document).on("click", "#btn-previus", function(event) {
                tab == 0 ? tab = tab : tab--;
                changeTab();
            });

            function changeTab() {
                $('#tab-' + tab).click()
                $("#btn-previus, #btn-first").prop("disabled", tab == 0);
                $("#btn-last, #btn-next").prop("disabled", tab == 8);
            }

            let table = $('#items').DataTable({
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
            });
            const start = flatpickr("#start", config_flatpickr);
            const end = flatpickr("#end", config_flatpickr);
            const order_date = flatpickr("#order_date", config_flatpickr);
            const document_date = flatpickr("#document_date", config_flatpickr);
            $(".percent").inputmask({
                mask: "*{1,3}.*{1,2}%"
            });
            $("#divCoti2").hide();

            $(document).on("click", ".btn-next", function(event) {
                $("#lbl_document_type").val($("#type_document :selected").select2(this.data).text());
                $("#divCoti2").show();
                $("#divCoti1").hide();
            });

            $(document).on("click", ".btn-back", function(event) {
                $("#divCoti2").hide();
                $("#divCoti1").show();
            });

            $(document).on("click", ".btn-save", function(event) {
                ////validaciones y grabacion
            });


            DecoupledEditor
                .create(document.querySelector('.document-editor__editable'))
                .then(editor => {
                    const toolbarContainer = document.querySelector('.document-editor__toolbar');

                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                    window.editor = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
        @include('modals.person-scripts', ['option' => 2])
        @include('item.item-scripts')
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
