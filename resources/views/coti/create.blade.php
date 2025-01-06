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
                    <button type="button" class="btn btn-primary btn-next">Aceptar</button>
                    <button type="button" class="btn btn-secondary">Cancelar</button>
                </div>
            </div>
        </div>

        <div id="divCoti2">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Crear Cotización</h2>
                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-general-tab" data-bs-toggle="tab"
                                href="#animated-underline-general" role="tab"
                                aria-controls="animated-underline-general" aria-selected="true"><svg viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg> Información General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-participant-tab" data-bs-toggle="tab"
                                href="#animated-underline-participant" role="tab"
                                aria-controls="animated-underline-participant" aria-selected="false" tabindex="-1"><svg
                                    viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="css-i6dzq1">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg> Participantes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-intermediary-tab" data-bs-toggle="tab"
                                href="#animated-underline-intermediary" role="tab"
                                aria-controls="animated-underline-intermediary" aria-selected="false"
                                tabindex="-1"><svg viewBox="0 0 24 24" width="24" height="24"
                                    stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <polyline points="17 11 19 13 23 9"></polyline>
                                </svg> Intermediarios</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-item-tab" data-bs-toggle="tab"
                                href="#animated-underline-item" role="tab"
                                aria-controls="animated-underline-item" aria-selected="false" tabindex="-1"><svg
                                    viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="css-i6dzq1">
                                    <path
                                        d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z">
                                    </path>
                                    <line x1="12" y1="11" x2="12" y2="17">
                                    </line>
                                    <line x1="9" y1="14" x2="15" y2="14">
                                    </line>
                                </svg> Items</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-coverage-tab" data-bs-toggle="tab"
                                href="#animated-underline-coverage" role="tab"
                                aria-controls="animated-underline-coverage" aria-selected="false" tabindex="-1"><svg
                                    viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="css-i6dzq1">
                                    <line x1="21" y1="10" x2="3" y2="10">
                                    </line>
                                    <line x1="21" y1="6" x2="3" y2="6">
                                    </line>
                                    <line x1="21" y1="14" x2="3" y2="14">
                                    </line>
                                    <line x1="21" y1="18" x2="3" y2="18">
                                    </line>
                                </svg> Resumen Coberturas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-deductible-tab" data-bs-toggle="tab"
                                href="#animated-underline-deductible" role="tab"
                                aria-controls="animated-underline-deductible" aria-selected="false"
                                tabindex="-1"><svg viewBox="0 0 24 24" width="24" height="24"
                                    stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" class="css-i6dzq1">
                                    <line x1="8" y1="6" x2="21" y2="6">
                                    </line>
                                    <line x1="8" y1="12" x2="21" y2="12">
                                    </line>
                                    <line x1="8" y1="18" x2="21" y2="18">
                                    </line>
                                    <line x1="3" y1="6" x2="3.01" y2="6">
                                    </line>
                                    <line x1="3" y1="12" x2="3.01" y2="12">
                                    </line>
                                    <line x1="3" y1="18" x2="3.01" y2="18">
                                    </line>
                                </svg> Resumen Deducibles</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-payment-tab" data-bs-toggle="tab"
                                href="#animated-underline-payment" role="tab"
                                aria-controls="animated-underline-payment" aria-selected="false" tabindex="-1"><svg
                                    viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="css-i6dzq1">
                                    <line x1="12" y1="1" x2="12" y2="23">
                                    </line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg> Pagos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-observation-tab" data-bs-toggle="tab"
                                href="#animated-underline-observation" role="tab"
                                aria-controls="animated-underline-observation" aria-selected="false"
                                tabindex="-1"><svg viewBox="0 0 24 24" width="24" height="24"
                                    stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13">
                                    </line>
                                    <line x1="16" y1="17" x2="8" y2="17">
                                    </line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg> Observaciones</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="animated-underline-general" role="tabpanel"
                    aria-labelledby="animated-underline-general-tab">
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
                    aria-labelledby="animated-underline-participant-tab">
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
                    aria-labelledby="animated-underline-intermediary-tab">
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
                    aria-labelledby="animated-underline-item-tab">
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
                    aria-labelledby="animated-underline-coverage-tab">
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
                    aria-labelledby="animated-underline-deductible-tab">
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
                    aria-labelledby="animated-underline-payment-tab">
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
                    aria-labelledby="animated-underline-observation-tab">
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
                            <button type="button" class="btn btn-sm btn-primary btn-save-person">Guardar</button>
                            <button type="button"
                                class="btn btn-sm btn-primary btn-update-person">Actualizar</button>
                            <button type="button" class="btn btn-sm btn-secondary close-modal-person">Cerrar</button>
                        </div>
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
            var table = $('#items').DataTable({
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
