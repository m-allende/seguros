@php
    $identification = '';
    $name = '';
    $abbreviation = '';
    $last_name = '';
    $mother_last_name = '';
    $birthdate = '';

    $type_id = 0;
    $marital_status_id = 0;
    $gender_id = 0;

    $cont_addresses = 0;
    $cont_emails = 0;
    $cont_phones = 0;

    if (!$add) {
        $identification = $person->identification;
        $name = $person->name;
        $abbreviation = $person->abbreviation;
        $last_name = $person->last_name;
        $mother_last_name = $person->mother_last_name;

        $fecha = date('d/m/Y', strtotime($person->birthdate));
        $birthdate = $fecha;

        $type_id = $person->type_id;
        $type_name = $person->type->name;
        $marital_status_id = $person->marital_status_id;
        if ($person->marital_status != null) {
            $marital_status_name = $person->marital_status->name;
        }

        $gender_id = $person->gender_id;
        if ($person->gender != null) {
            $gender_name = $person->gender->name;
        }

        $cont_addresses = 0;
        $cont_emails = 0;
        $cont_phones = 0;
    }
@endphp
<form id="form-person" class="form" action="" method="POST" autocomplete="off">
    <input type="hidden" name="id">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group w-50">
                <label for="identification">RUT</label>
                <input type="text" name="identification" value="{{ $identification }}"
                    class="form-control form-control-sm text-end identification" placeholder="99999999-9">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="type_id">Tipo</label>
                <select name="type_id" id="type_id"
                    class="form-select form-control form-control-sm select2-type-person w-100">
                    @if ($type_id != 0)
                        <option value="{{ $type_id }}" @selected(true)>{{ $type_name }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label id="lblName" for="name">Nombre</label>
                <input type="text" name="name" value="{{ $name }}" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="abbreviation">Abreviación</label>
                <input type="text" name="abbreviation" value="{{ $abbreviation }}"
                    class="form-control form-control-sm">
            </div>
        </div>
    </div>
    <div class="row" id="divLastName">
        <div class="col-8">
            <div class="form-group">
                <label for="last_name">Apellido Paterno</label>
                <input type="text" name="last_name" value="{{ $last_name }}" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <label for="mother_last_name">Apellido Materno</label>
                <input type="text" name="mother_last_name" value="{{ $mother_last_name }}"
                    class="form-control form-control-sm">
            </div>
        </div>
    </div>
    <div id="divPersonalInformation">
        <hr>
        <div class="row">
            <div class="col-12">
                <h6>Datos Personales</h6>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-4">
                <div class="form-group">
                    <label for="birthdate">Fecha de Nacimiento</label>
                    <input type="text" name="birthdate" id="birthdate" value="{{ $birthdate }}"
                        class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="mother_last_name">Estado Civil</label>
                    <select name="marital_status_id" id="marital_status_id"
                        class="form-select form-control form-control-sm w-100">
                        @if ($marital_status_id != 0)
                            <option value="{{ $marital_status_id }}" @selected(true)>
                                {{ $marital_status_name }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="mother_last_name">Género</label>
                    <select name="gender_id" id="gender_id" class="form-select form-control form-control-sm w-100">
                        @if ($gender_id != 0)
                            <option value="{{ $gender_id }}" @selected(true)>
                                {{ $gender_name }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-9">
            <h6>Direcciones</h6>
        </div>
        <div class="col-3">
            <button type="button" data-cont="0" class="btn btn-sm btn-primary btn-add-address">Agregar
                Dirección</button>
        </div>
    </div>
    <div class="p-3" id="container-address">

    </div>
    <hr>
    <div class="row">
        <div class="col-9">
            <h6>Emails</h6>
        </div>
        <div class="col-3">
            <button type="button" data-cont="0" class="btn btn-sm btn-primary btn-add-email">Agregar
                Email</button>
        </div>
    </div>
    <div class="p-3" id="container-email">

    </div>
    <hr>
    <div class="row">
        <div class="col-9">
            <h6>Telefonos</h6>
        </div>
        <div class="col-3">
            <button type="button" data-cont="0" class="btn btn-sm btn-primary btn-add-phone">Agregar
                Teléfono</button>
        </div>
    </div>
    <div class="p-3" id="container-phone">

    </div>
</form>
