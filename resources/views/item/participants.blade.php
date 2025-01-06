<div class="card-body">
    @php
        $values = explode(',', str_replace(['[', ']', '"'], '', setting('persons_used_items')));
    @endphp
    @foreach ($values as $value)
        <div class="row border p-3 mb-2">
            <div class="col-12">
                <b><label class="ms-2">{{ App\Models\Code::find($value)->name }}</label></b>
            </div>
            <div class="col-8">
                <select name="person_id_{{ $value }}" id="person_id_{{ $value }}"
                    class="form-select form-control form-control-sm select2-person-item w-100">
                </select>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <button type="button" class="btn btn-primary create-person"
                        data-param1="{{ $value }}">Crear</button>
                    <button type="button" class="btn btn-primary view-person" data-param1="{{ $value }}">Ver
                        Información</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
<script>
    $(".select2-person-item").select2({
        placeholder: "Seleccione...",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/person";
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
        templateResult: formatDataPerson,
        templateSelection: formatDataSelectionPerson,
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
</script>
