<div class="card-body mb-3">
    <div class="row">
        <div class="col-4">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="inputGroup-sizing-sm">Documentos Adjuntos</span>
                <input type="text" @readonly(true) class="form-control" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
    </div>
    <div class="overflow-auto mt-3">
        <table id="items" class="table table-sm dt-table-hover dataTable no-footer">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Documento</th>
                    <th>Expiración</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="card-footer text-end">
    <button type="button" class="btn btn-primary btn-save _effect--ripple waves-effect waves-light add-item">Agregar
        Documento</button>
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
                <button type="button" class="btn btn-sm btn-primary btn-save-item">@lang('translation.save')</button>
                <button type="button" class="btn btn-sm btn-primary btn-update-item">@lang('translation.update')</button>
                <button type="button" class="btn btn-sm btn-secondary close-modal-item">@lang('translation.close')</button>
            </div>
        </div>
    </div>
</div>
