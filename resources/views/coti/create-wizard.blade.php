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
        <link rel="stylesheet" href="{{ asset('plugins/stepper/bsStepper.min.css') }}">
        @vite(['resources/scss/light/plugins/stepper/custom-bsStepper.scss'])
        @vite(['resources/scss/dark/plugins/stepper/custom-bsStepper.scss'])

        <link rel="stylesheet" href="{{ asset('plugins/flatpickr/flatpickr.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/noUiSlider/nouislider.min.css') }}">
        @vite(['resources/scss/light/plugins/flatpickr/custom-flatpickr.scss'])
        @vite(['resources/scss/dark/plugins/flatpickr/custom-flatpickr.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="row layout-top-spacing">
        <form action="">
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
                        <button type="button" class="btn btn-primary">Cancelar</button>
                    </div>
                </div>
            </div>

            <div id="wizard_Vertical_Icons" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Ingresar Cotizacion</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="bs-stepper stepper-vertical-icons vertical linear">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step" data-target="#step-one">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-home">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                            </svg></span>
                                        <span class="bs-stepper-label">Inf. General</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-two">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-send">
                                                <line x1="22" y1="2" x2="11" y2="13">
                                                </line>
                                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                            </svg></span>
                                        <span class="bs-stepper-label">Participantes</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-three">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-map-pin">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg></span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Intermediarios</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-four">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-map-pin">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg></span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">M. Asegurada</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-five">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-map-pin">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg></span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Coberturas</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-six">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-map-pin">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg></span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Deducibles</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-seven">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-map-pin">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg></span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Metodo Pago</span>
                                        </span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#step-eight">
                                    <button type="button" class="step-trigger" role="tab">
                                        <span class="bs-stepper-circle"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-map-pin">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg></span>
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title">Observaciones</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <div id="step-one" class="content" role="tabpanel">
                                    <div class="coti-div-panel">
                                        @include('coti.general')
                                    </div>
                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-primary btn-prev me-3"
                                            disabled>Anterior</button>
                                        <button type="button" class="btn btn-primary btn-nxt">Siguiente</button>
                                    </div>
                                </div>
                                <div id="step-two" class="content" role="tabpanel">
                                    <div class="coti-div-panel">
                                        @include('coti.participants')
                                    </div>
                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-primary btn-prev me-3">Anterior</button>
                                        <button type="button" class="btn btn-primary btn-nxt">Siguiente</button>
                                    </div>
                                </div>
                                <div id="step-three" class="content" role="tabpanel">
                                    <div class="coti-div-panel">
                                        @include('coti.intermediaries')
                                    </div>
                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-primary btn-prev me-3">Anterior</button>
                                        <button type="button" class="btn btn-primary btn-nxt">Siguiente</button>
                                    </div>
                                </div>
                                <div id="step-four" class="content" role="tabpanel">
                                    <div class="coti-div-panel">
                                    </div>
                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-primary btn-prev me-3">Anterior</button>
                                        <button type="button" class="btn btn-primary btn-nxt">Siguiente</button>
                                    </div>
                                </div>
                                <div id="step-five" class="content" role="tabpanel">
                                    <div class="coti-div-panel">
                                    </div>
                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-primary btn-prev me-3">Anterior</button>
                                        <button type="button" class="btn btn-primary btn-nxt">Siguiente</button>
                                    </div>
                                </div>
                                <div id="step-six" class="content" role="tabpanel">
                                    <div class="coti-div-panel">
                                    </div>
                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-primary btn-prev me-3">Anterior</button>
                                        <button type="button" class="btn btn-primary btn-nxt">Siguiente</button>
                                    </div>
                                </div>
                                <div id="step-seven" class="content" role="tabpanel">
                                    <div class="coti-div-panel">
                                    </div>
                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-primary btn-prev me-3">Anterior</button>
                                        <button type="button" class="btn btn-primary btn-nxt">Siguiente</button>
                                    </div>
                                </div>
                                <div id="step-eight" class="content" role="tabpanel">
                                    <div class="coti-div-panel">
                                        @include('coti.observation')
                                    </div>
                                    <div class="button-action mt-5 text-end">
                                        <button type="button" class="btn btn-primary btn-prev me-3">Anterior</button>
                                        <button type="button" class="btn btn-success me-3">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

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
                        <button type="button" class="btn btn-sm btn-primary btn-update-person">Actualizar</button>
                        <button type="button" class="btn btn-sm btn-primary close-modal-person">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{ asset('plugins/stepper/bsStepper.min.js') }}"></script>
        <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
        <script>
            const start = flatpickr("#start", config_flatpickr);
            const end = flatpickr("#end", config_flatpickr);
            const order_date = flatpickr("#order_date", config_flatpickr);
            const document_date = flatpickr("#document_date", config_flatpickr);
            $(".percent").inputmask({
                mask: "*{1,3}.*{1,2}%"
            });
            $("#cotiAccordion").hide();

            var v_stepperWizardIcon = document.querySelector('.stepper-vertical-icons');
            var v_stepperIcon = new Stepper(v_stepperWizardIcon, {
                animation: true
            })
            var v_stepperNextButtonIcon = v_stepperWizardIcon.querySelectorAll('.btn-nxt');
            var v_stepperPrevButtonIcon = v_stepperWizardIcon.querySelectorAll('.btn-prev');

            v_stepperNextButtonIcon.forEach(element => {
                element.addEventListener('click', function() {
                    v_stepperIcon.next();
                })
            });

            v_stepperPrevButtonIcon.forEach(element => {
                element.addEventListener('click', function() {
                    v_stepperIcon.previous();
                })
            });

            v_stepperWizardIcon.addEventListener('show.bs-stepper', function(event) {
                if (event.detail.from < event.detail.to) {
                    v_stepperWizardIcon.querySelectorAll('.step')[event.detail.from].classList.add('crossed');
                } else {
                    v_stepperWizardIcon.querySelectorAll('.step')[event.detail.to].classList.remove('crossed');
                }
            })

            $(document).on("click", ".btn-next", function(event) {
                $("#lbl_document_type").val($("#type_document :selected").select2(this.data).text());
                $("#cotiAccordion").show();
                $("#divCoti1").hide();
            });

            $(document).on("click", ".btn-back", function(event) {
                $("#cotiAccordion").hide();
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
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
