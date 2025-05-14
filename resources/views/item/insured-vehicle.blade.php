<div class="card-body">
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="number" class="form-label">Número de Item</label>
                <input name="number" type="text" class="form-control form-control-sm w-50" id="number">
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="patent">Patente</label><br>
                <input type="text" id="patent" name="patent" class="form-control form-control-sm p-1 m-0 w-50"
                    value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="motor">Número de Motor</label><br>
                <input type="text" id="motor" name="motor" class="form-control form-control-sm p-1 m-0 w-100"
                    value="">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="chassis">Número de Chassis</label><br>
                <input type="text" id="chassis" name="chassis" class="form-control form-control-sm p-1 m-0 w-100"
                    value="">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="serie">Número de Serie</label><br>
                <input type="text" id="serie" name="serie" class="form-control form-control-sm p-1 m-0 w-100"
                    value="">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="year">Año</label><br>
                <input type="text" id="year" name="year" class="form-control form-control-sm p-1 m-0 w-50"
                    value="">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="type_id">@lang('translation.type')</label><br>
        <select name="type_id" id="type_id"
            class=" form-select form-control form-control-sm select2-type-vehicle-modal w-100">
        </select>
    </div>
    <div class="form-group">
        <label for="use_id">Uso</label><br>
        <select name="use_id" id="use_id"
            class=" form-select form-control form-control-sm select2-use-vehicle-modal w-100">
        </select>
    </div>
    <div class="form-group">
        <label for="branch_id">Marca</label><br>
        <select name="branch_id" id="branch_id"
            class=" form-select form-control form-control-sm select2-branch-modal w-100">
        </select>
    </div>
    <div class="form-group">
        <label for="model_id">Modelo</label><br>
        <select name="model_id" id="model_id"
            class=" form-select form-control form-control-sm select2-model-modal w-100">
        </select>
    </div>
    <div class="form-group">
        <label for="color_id">Color</label><br>
        <select name="color_id" id="color_id"
            class=" form-select form-control form-control-sm select2-color-modal w-100">
        </select>
    </div>
    <div class="row border m-3 p-3">
        <div class="col-1"></div>
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
    </div>
</div>
<script>
    $(".select2-type-vehicle-modal").select2({
        placeholder: "@lang('translation.select-option')",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/typevehicle";
            },
            data: function(params) {
                var queryParameters = {
                    search: params.term,
                };
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === "") {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true, // add additional parameters
            };
        },
    });
    $(".select2-branch-modal").select2({
        placeholder: "@lang('translation.select-option')",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/branchvehicle";
            },
            data: function(params) {
                var queryParameters = {
                    search: params.term,
                };
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === "") {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true, // add additional parameters
            };
        },
    });
    $(".select2-model-modal").select2({
        placeholder: "@lang('translation.select-option')",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/modelvehicle";
            },
            data: function(params) {
                var queryParameters = {
                    search: params.term,
                    branch_id: $("#branch_id").val(),
                };
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === "") {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true, // add additional parameters
            };
        },
    });
    $(".select2-color-modal").select2({
        placeholder: "@lang('translation.select-option')",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/color";
            },
            data: function(params) {
                var queryParameters = {
                    search: params.term
                };
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === "") {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true, // add additional parameters
            };
        },
    });
    $(".select2-use-vehicle-modal").select2({
        placeholder: "@lang('translation.select-option')",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/usevehicle";
            },
            data: function(params) {
                var queryParameters = {
                    search: params.term
                };
                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function(params) {
            var term = $.trim(params.term);
            if (term === "") {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true, // add additional parameters
            };
        },
    });
    $("#patent").inputmask({
        mask: ["aa-999", "aaa-99", "aaa-999", "a-9999", "aa-99-99", "aa-aa-99", ],
        casing: "upper"
    });
    $("#year").inputmask({
        mask: ["9999"]
    });
</script>
