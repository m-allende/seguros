<div class="row">
    <div id="itemAccordion" class="accordion-icons accordion col-12">
        <!--Materia Asegurada-->
        <div class="card">
            <div class="card-header" id="...">
                <section class="mb-0 mt-0">
                    <div role="menu" class="fs-5" data-bs-toggle="collapse" data-bs-target="#accordionInsured"
                        aria-expanded="true" aria-controls="accordionInsured">
                        <div class="accordion-icon"><svg viewBox="0 0 24 24" width="24" height="24"
                                stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" class="css-i6dzq1">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg></div>
                        Materia Asegurada
                        <div class="icons"><svg> ... </svg></div>
                    </div>
                </section>
            </div>
            <div id="accordionInsured" class="collapse show" aria-labelledby="..." data-bs-parent="#itemAccordion">
                @switch($type)
                    @case(1)
                        @include('item.insured-vehicle')
                    @break

                    @case(2)
                        @include('item.insured-no-vehicle')
                    @break

                    @default
                @endswitch
            </div>
        </div>
        <!--PARTICIPANTS ITEM-->
        <div class="card">
            <div class="card-header" id="...">
                <section class="mb-0 mt-0">
                    <div role="menu" class="fs-5 collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionParticipantItem" aria-expanded="false"
                        aria-controls="accordionParticipantItem">
                        <div class="accordion-icon"><svg viewBox="0 0 24 24" width="24" height="24"
                                stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" class="css-i6dzq1">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg></div>
                        Participantes del Item<div class="icons"><svg> ... </svg></div>
                    </div>
                </section>
            </div>
            <div id="accordionParticipantItem" class="collapse" aria-labelledby="..." data-bs-parent="#itemAccordion">
                @include('item.participants')
            </div>
        </div>
        <!--COVERAGE-->
        <div class="card">
            <div class="card-header" id="...">
                <section class="mb-0 mt-0">
                    <div role="menu" class="fs-5 collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionCoverageItem" aria-expanded="false"
                        aria-controls="accordionCoverageItem">
                        <div class="accordion-icon"><svg viewBox="0 0 24 24" width="24" height="24"
                                stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" class="css-i6dzq1">
                                <line x1="21" y1="10" x2="3" y2="10">
                                </line>
                                <line x1="21" y1="6" x2="3" y2="6">
                                </line>
                                <line x1="21" y1="14" x2="3" y2="14">
                                </line>
                                <line x1="21" y1="18" x2="3" y2="18">
                                </line>
                            </svg></div>
                        Coberturas<div class="icons"><svg> ... </svg></div>
                    </div>
                </section>
            </div>
            <div id="accordionCoverageItem" class="collapse" aria-labelledby="..." data-bs-parent="#itemAccordion">
                @include('item.coverage')
            </div>
        </div>
        <!--DEDUCIBLE-->
        <div class="card">
            <div class="card-header" id="...">
                <section class="mb-0 mt-0">
                    <div role="menu" class="fs-5 collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionDeductibleItem" aria-expanded="false"
                        aria-controls="accordionDeductibleItem">
                        <div class="accordion-icon"><svg viewBox="0 0 24 24" width="24" height="24"
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
                            </svg></div>
                        Deducibles<div class="icons"><svg> ... </svg></div>
                    </div>
                </section>
            </div>
            <div id="accordionDeductibleItem" class="collapse" aria-labelledby="..."
                data-bs-parent="#itemAccordion">

            </div>
        </div>
        <!--OBSERVATION-->
        <div class="card">
            <div class="card-header" id="...">
                <section class="mb-0 mt-0">
                    <div role="menu" class="fs-5 collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionObservationItem" aria-expanded="false"
                        aria-controls="accordionObservationItem">
                        <div class="accordion-icon"><svg viewBox="0 0 24 24" width="24" height="24"
                                stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" class="css-i6dzq1">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13">
                                </line>
                                <line x1="16" y1="17" x2="8" y2="17">
                                </line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg></div>
                        Observacion<div class="icons"><svg> ... </svg></div>
                    </div>
                </section>
            </div>
            <div id="accordionObservationItem" class="collapse" aria-labelledby="..."
                data-bs-parent="#itemAccordion">
                @include('item.observation')
            </div>
        </div>
    </div>
</div>
