<div class="card-body mb-3">
    <div class="row">
        <div class="col-4">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Cantidad de Items</span>
                <input type="text" class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="overflow-auto mt-3">
        <table id="items" class="table table-sm dt-table-hover dataTable no-footer">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Materia Asegurada</th>
                    <th>Inicio Vigencia</th>
                    <th>Término Vigencia</th>
                    <th>Prima Neta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Marca: <br>Modelo: <br>Tipo: <br>Año: <br></td>
                    <td>01-01-2024 00:00:00</td>
                    <td>01-01-2025 23:59:59</td>
                    <td>Prima Neta</td>
                    <td class="text-center">
                        <div class="action-btns">
                            <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2"
                                data-toggle="tooltip" data-placement="top" title="Ver">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </a>
                            <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                data-toggle="tooltip" data-placement="top" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg>
                            </a>
                            <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip"
                                data-placement="top" title="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer text-end">
    <button type="button" class="btn btn-primary btn-save _effect--ripple waves-effect waves-light add-item">Agregar
        Item</button>
</div>
<div id="modal-item" class="modal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog modal-xxl modal-dialog-scrollable modal-dialog-item" role="document">
        <div class="modal-content modal-content-light">
            <div class="modal-header">
                <h5 class="modal-title modal-title-item"></h5>
                <button type="button" class="btn-close close-modal-item" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body modal-body-fix modal-body-item">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary btn-save-item">Guardar</button>
                <button type="button" class="btn btn-sm btn-primary btn-update-item">Actualizar</button>
                <button type="button" class="btn btn-sm btn-secondary close-modal-item">Cerrar</button>
            </div>
        </div>
    </div>
</div>
