<div class="card-body">
    @php
        $values = explode(',', str_replace(['[', ']', '"'], '', setting(str_replace('[]', '', 'intermediaries_used'))));
    @endphp
    @foreach ($values as $value)
        <div class="border p-3 mb-2">
            <div class="row">
                <div class="col-10">
                    <div class="form-group">
                        <b><label class="ms-2">{{ App\Models\Code::find($value)->name }}</label></b><br>
                        <select name="intermediary_id_{{ $value }}" id="intermediary_id_{{ $value }}"
                            data-param1="{{ $value }}"
                            class="form-select form-control form-control-sm select2-intermediary w-100">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <b><label class="ps-0">Comisión</label></b><br>
                        <input type="text" id="comission_percent_{{ $value }}"
                            name="comission_percent_{{ $value }}"
                            class="form-control form-control-sm p-1 m-0 w-100 percent" value="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <b><label class="">Valor</label></b><br>
                        <input type="text" id="comission_value_{{ $value }}"
                            name="comission_value_{{ $value }}"
                            class="form-control form-control-sm p-1 m-0 w-100" value="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <b><label class="">Extraida desde</label></b><br>
                        <input type="text" id="comission_from_{{ $value }}"
                            name="comission_from_{{ $value }}" class="form-control form-control-sm p-1 m-0 w-100"
                            value="">
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>
