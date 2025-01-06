<div class="card-body">
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="lbl_document_type">Cotización de Tipo: </label>
                <input type="text" id="lbl_document_type" name="lbl_document_type" class="form-control form-control-sm"
                    @readonly(true) value="">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="order_date">Fecha de Pedido</label><br>
                <input type="text" id="order_date" name="order_date" class="form-control form-control-sm"
                    value="{{ date('d/m/Y') }}">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="document_date">Fecha de Documento</label><br>
                <input type="text" id="document_date" name="document_date" class="form-control form-control-sm"
                    value="{{ date('d/m/Y') }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="company_id">Compañia</label><br>
        <select name="company_id" id="company_id"
            class=" form-select form-control form-control-sm select2-company w-100">
        </select>
    </div>
    <div class="form-group">
        <label for="ramo_id">Ramo</label><br>
        <select name="ramo_id" id="ramo_id" class=" form-select form-control form-control-sm select2-ramo w-100">
        </select>
    </div>
    <div class="form-group">
        <label for="coin_id">Moneda</label><br>
        <select name="coin_id" id="coin_id" class=" form-select form-control form-control-sm select2-coin w-100">
        </select>
    </div>
    <div class="form-group">
        <label for="reason">Motivo del Documento</label><br>
        <input type="text" id="reason" name="reason" class="form-control form-control-sm" value="">
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="start">Inicio de Vigencia</label><br>
                <input type="text" id="start" name="start" class="form-control form-control-sm"
                    value="{{ date('d/m/Y') }}">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="end">Término de Vigencia</label><br>
                <input type="text" id="end" name="end" class="form-control form-control-sm"
                    value="{{ date('d/m/Y', strtotime('+1 year')) }}">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="days">Dias</label><br>
                @php
                    $date1 = Carbon::parse(date('Y-m-d 00:00:00'));
                    $date2 = date('Y-m-d 23:59:59', strtotime('+1 year'));
                    $diff = $date1->diffInDays(Carbon::parse($date2));
                @endphp
                <input type="text" id="days" name="days" @readonly(true)
                    class="form-control form-control-sm" value="{{ $diff }}">
            </div>
        </div>
        <div class="col-4 text-center">
            <svg viewBox="0 0 24 24" width="60" height="60" stroke="currentColor" stroke-width="2" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <label for="">Subir Documento</label>
        </div>
    </div>
</div>
