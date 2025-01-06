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
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="type_id">Materia Asegurada</label><br>
                        <select name="type_id" id="type_id"
                            class=" form-select form-control form-control-sm select2-type-no-vehicle-modal w-100">
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="region_id">Región</label><br>
                        <select name="region_id" id="region_id"
                            class=" form-select form-control form-control-sm select2-region-modal w-100">
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="city_id">Ciudad</label><br>
                        <select name="city_id" id="city_id"
                            class=" form-select form-control form-control-sm select2-city-modal w-100">
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="commune_id">Comuna</label><br>
                        <select name="commune_id" id="commune_id"
                            class=" form-select form-control form-control-sm select2-commune-modal w-100">
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="address" class="form-label">Dirección</label>
                        <input name="address" type="text" class="form-control form-control-sm" id="address">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="resto" class="form-label">Resto</label>
                        <input name="resto" type="text" class="form-control form-control-sm" id="resto">
                    </div>
                </div>
                <div class="col-6 d-none">
                    <div class="form-group">
                        <label for="latitude" class="form-label">Latitud</label>
                        <input name="latitude" type="text" class="form-control form-control-sm" id="latitude">
                    </div>
                </div>
                <div class="col-6 d-none">
                    <div class="form-group">
                        <label for="longitude" class="form-label">Longitud</label>
                        <input name="longitude" type="text" class="form-control form-control-sm" id="longitude">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 m-2 p-2">
            <div id="map" class="" style="height: 300px;"></div>
        </div>
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
    $(".select2-type-no-vehicle-modal").select2({
        placeholder: "Seleccione...",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/typenovehicle";
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

    $(".select2-region-modal").select2({
        placeholder: "Seleccione...",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/region";
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

    $(".select2-city-modal").select2({
        placeholder: "Seleccione...",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/city";
            },
            data: function(params) {
                var queryParameters = {
                    search: params.term,
                    region_id: $("#region_id").val(),
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

    $(".select2-commune-modal").select2({
        placeholder: "Seleccione...",
        dropdownParent: $("#modal-item"),
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function(params) {
                return "/config/commune";
            },
            data: function(params) {
                var queryParameters = {
                    search: params.term,
                    city_id: $("#city_id").val(),
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
    var addressInput = document.getElementById("address");
    var addressLatitude = document.getElementById("latitude");
    var addressLongitude = document.getElementById("longitude");
    var latitude = parseFloat(addressLatitude.value) || -33.45;
    var longitude = parseFloat(addressLongitude.value) || -70.666;
    var map = L.map('map').setView([latitude, longitude], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    setTimeout(function() {
        map.invalidateSize();
    }, 500);

    function initialize() {
        var drawnItems;
        const autocomplete = new google.maps.places.Autocomplete(addressInput, ["place_id", "geometry", "name"]);
        var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([latitude, longitude]).addTo(map);

        drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);


        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            const place = autocomplete.getPlace();

            addressLatitude.value = place.geometry.location.lat();
            addressLongitude.value = place.geometry.location.lng();


            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                addressInput.value = "";
                return;
            }


            if (place.geometry.viewport) {
                map.fitBounds([
                    [place.geometry.viewport.getSouthWest().lat(),
                        place.geometry.viewport.getSouthWest().lng()
                    ],
                    [place.geometry.viewport.getNorthEast().lat(),
                        place.geometry.viewport.getNorthEast().lng()
                    ]
                ]);

            } else {
                map.setView([place.geometry.location.lat(), place.geometry.location.lng()], 17);

            }
            marker.setLatLng([place.geometry.location.lat(), place.geometry.location.lng()]);
        });
    }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
    async defer></script>
