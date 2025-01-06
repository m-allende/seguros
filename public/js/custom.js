$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
});
let config_flatpickr = {
    altInput: true,
    dateFormat: "d/m/Y",
    altFormat: "d/m/Y",
    allowInput: true,
    static: true,
    onOpen: function (selectedDates, dateStr, instance) {
        instance.setDate(instance.input.value, false);
    },
    locale: {
        firstDayOfWeek: 1,
        weekdays: {
            shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            longhand: [
                "Domingo",
                "Lunes",
                "Martes",
                "Miércoles",
                "Jueves",
                "Viernes",
                "Sábado",
            ],
        },
        months: {
            shorthand: [
                "Ene",
                "Feb",
                "Mar",
                "Abr",
                "May",
                "Jun",
                "Jul",
                "Ago",
                "Sep",
                "Оct",
                "Nov",
                "Dic",
            ],
            longhand: [
                "Enero",
                "Febreo",
                "Мarzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ],
        },
    },
};

const domDT =
    "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
    "<'table-responsive'tr>" +
    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>";

let countNotifications = $("#countNewNotification").data("count");
// Enable pusher logging - don't include this in production
//Pusher.logToConsole = true;

var pusher = new Pusher("2423a0dc5f701474891c", {
    cluster: "sa1",
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe("export-done");

// Bind a function to a Event (the full Laravel class)
channel.bind("pusher:subscription_succeeded", function (members) {
    // alert('successfully subscribed!');
});

channel.bind("App\\Events\\ExportDone", function (data) {
    var download = $(
        '<div class="dropdown-item" id="notification_' +
            data.id +
            '"> <div class="media file-upload">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"' +
            'stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">' +
            '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>' +
            '<polyline points="14 2 14 8 20 8"></polyline>' +
            '<line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line>' +
            '<polyline points="10 9 9 9 8 9"></polyline>' +
            "</svg>" +
            '<div class="media-body">' +
            '<div class="data-info">' +
            '<a href="/notification/download?filename=' +
            data.filename +
            '">' +
            '<h6 class="">' +
            data.filename +
            "</h6>" +
            '<p class="">' +
            data.location +
            "</p>" +
            "</a>" +
            "</div>" +
            '<div class="icon-status drop-notification" data-param1="' +
            data.id +
            '">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"' +
            'viewBox="0 0 24 24" fill="none" stroke="currentColor"' +
            'stroke-width="2" stroke-linecap="round" stroke-linejoin="round"' +
            'class="feather feather-x">' +
            '<line x1="18" y1="6" x2="6" y2="18">' +
            "</line>" +
            '<line x1="6" y1="6" x2="18" y2="18">' +
            "</line>" +
            "</svg>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>"
    );
    $(".notification").append(download);
    countNotifications++;
    $("#countNewNotification").html(
        countNotifications + (countNotifications == 1 ? " Nueva" : " Nuevas")
    );
    Snackbar.show({
        text: "Tiene una nueva notificación.",
        pos: "top-right",
        actionText: "Cerrar",
    });
    $("#notificationDropdown").append(
        '<span class="badge badge-success new-notification"></span>'
    );
});

$(document).on("click", ".drop-notification", function (event) {
    var id = $(this).data("param1");
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "/notification/" + id,
        data: {
            _method: "delete",
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            $("#notification_" + id).remove();
            countNotifications--;
            $("#countNewNotification").html(
                countNotifications +
                    (countNotifications == 1 ? " Nueva" : " Nuevas")
            );
        },
    });
});

$(document).on("keyup", ".identification", function (event) {
    this.value = this.value.replace(/[^k0-9-]/i, "");
});

function sweetError(html) {
    Swal.fire({
        icon: "error",
        title: "Error",
        html: html,
    });
}

function deleteDiv(div) {
    $("#" + div).remove();
}

$(document).on("click", ".btn-add-address", function (event) {
    var cont = Number($(this).attr("data-cont"));
    var $divAddress = $(
        '<div class="border p-3 mb-2" id="div_address_' +
            cont +
            '">' +
            '<div class="row"><div class="col-10"><h6>Direccion ' +
            (cont + 1) +
            '</h6></div><div class="col-2 text-end"><button onclick="deleteDiv(\'div_address_' +
            cont +
            "'," +
            cont +
            ',1);" type="button" class="btn-close" aria-label="Close"><i class="fas fa-times"></i></button></div></div>' +
            '<div class="row">' +
            '<div class="col-8">' +
            '<div class="form-group">' +
            '<label for="type_address_id_' +
            cont +
            '">Tipo de Dirección</label>' +
            '<select name="type_address_id_' +
            cont +
            '" id="type_address_id_' +
            cont +
            '"' +
            'class=" form-select form-control form-control-sm w-100">' +
            "</select>" +
            "</div>" +
            "</div>" +
            "</div>" +
            '<div class="row">' +
            '<div class="col-4">' +
            '<label for="region_id_' +
            cont +
            ']">Región</label><br>' +
            '<select name="region_id_' +
            cont +
            '" id="region_id_' +
            cont +
            '"' +
            'class=" form-select form-control form-control-sm w-100">' +
            "</select>" +
            "</div>" +
            '<div class="col-4">' +
            '<label for="city_id_' +
            cont +
            '">Ciudad</label><br>' +
            '<select name="city_id_' +
            cont +
            '" id="city_id_' +
            cont +
            '" class=" form-select form-control form-control-sm w-100">' +
            "</select>" +
            "</div>" +
            '<div class="col-4">' +
            '<label for="commune_id_' +
            cont +
            '">Comuna</label><br>' +
            '<select name="commune_id_' +
            cont +
            '" id="commune_id_' +
            cont +
            '" class=" form-select form-control form-control-sm w-100">' +
            "</select>" +
            "</div>" +
            "</div>" +
            '<div class="form-group">' +
            '<label for="address_' +
            cont +
            '">Dirección</label>' +
            '<input type="text" id="address_' +
            cont +
            '" name="address_' +
            cont +
            '" class="form-control form-control-sm">' +
            '<input type="hidden" name="latitude_' +
            cont +
            '">' +
            '<input type="hidden" name="longitude_' +
            cont +
            '">' +
            "</div>" +
            "</div>"
    );
    $("#container-address").append($divAddress);
    setSelect2TypeAddress(cont);
    setSelect2Region(cont);
    setSelect2City(cont);
    setSelect2Commune(cont);
    cont = cont + 1;
    $(this).attr("data-cont", cont);
});

$(document).on("click", ".btn-add-email", function (event) {
    var cont = Number($(this).attr("data-cont"));
    var $divEmail = $(
        '<div class="border p-3 mb-2" id="div_email_' +
            cont +
            '">' +
            '<div class="row"><div class="col-10"><h6>Email ' +
            (cont + 1) +
            '</h6></div><div class="col-2 text-end"><button onclick="deleteDiv(\'div_email_' +
            cont +
            '\');" type="button" class="btn-close" aria-label="Close"><i class="fas fa-times"></i></button></div></div>' +
            '<div class="row">' +
            '<div class="col-4">' +
            '<div class="form-group">' +
            '<label for="type_email_id_' +
            cont +
            '">Tipo de Email</label>' +
            '<select name="type_email_id_' +
            cont +
            '" id="type_email_id_' +
            cont +
            '"' +
            'class=" form-select form-control form-control-sm w-100">' +
            "</select>" +
            "</div>" +
            "</div>" +
            '<div class="col-8">' +
            '<label for="email_' +
            cont +
            ']">Email</label><br>' +
            '<input type="text" name="email_' +
            cont +
            '" id="email_' +
            cont +
            '" class="form-control form-control-sm">' +
            "</div>" +
            "</div>"
    );
    $("#container-email").append($divEmail);
    setSelect2TypeEmail(cont);
    cont = cont + 1;
    $(this).attr("data-cont", cont);
});

$(document).on("click", ".btn-add-phone", function (event) {
    var cont = Number($(this).attr("data-cont"));
    var $divEmail = $(
        '<div class="border p-3 mb-2" id="div_phone_' +
            cont +
            '">' +
            '<div class="row"><div class="col-10"><h6>Telefono ' +
            (cont + 1) +
            '</h6></div><div class="col-2 text-end"><button onclick="deleteDiv(\'div_phone_' +
            cont +
            '\');" type="button" class="btn-close" aria-label="Close"><i class="fas fa-times"></i></button></div></div>' +
            '<div class="row">' +
            '<div class="col-4">' +
            '<div class="form-group">' +
            '<label for="type_phone_id_' +
            cont +
            '">Tipo de Telefono</label>' +
            '<select name="type_phone_id_' +
            cont +
            '" id="type_phone_id_' +
            cont +
            '"' +
            'class=" form-select form-control form-control-sm w-100">' +
            "</select>" +
            "</div>" +
            "</div>" +
            '<div class="col-8">' +
            '<label for="phone_' +
            cont +
            ']">Telefono</label><br>' +
            '<input type="text" name="phone_' +
            cont +
            '"  id="phone_' +
            cont +
            '" class="form-control form-control-sm">' +
            "</div>" +
            "</div>"
    );
    $("#container-phone").append($divEmail);
    setSelect2TypePhone(cont);
    cont = cont + 1;
    $(this).attr("data-cont", cont);
});

function setSelect2TypeAddress(num) {
    $("#type_address_id_" + num).select2({
        placeholder: "Seleccione...",
        dropdownParent: $(".modal"),
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function (params) {
                return "/config/type";
            },
            data: function (params) {
                var queryParameters = {
                    search: params.term,
                    used_in: "Address",
                };
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function (params) {
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
}

function setSelect2TypeEmail(num) {
    $("#type_email_id_" + num).select2({
        placeholder: "Seleccione...",
        dropdownParent: $(".modal"),
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function (params) {
                return "/config/type";
            },
            data: function (params) {
                var queryParameters = {
                    search: params.term,
                    used_in: "Emails",
                };
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function (params) {
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
}

function setSelect2TypePhone(num) {
    $("#type_phone_id_" + num).select2({
        placeholder: "Seleccione...",
        dropdownParent: $(".modal"),
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function (params) {
                return "/config/type";
            },
            data: function (params) {
                var queryParameters = {
                    search: params.term,
                    used_in: "Phones",
                };
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function (params) {
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
}

function setSelect2Region(num) {
    $("#region_id_" + num).select2({
        placeholder: "Seleccione...",
        dropdownParent: $("#modal"),
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function (params) {
                return "/config/region";
            },
            data: function (params) {
                var queryParameters = {
                    search: params.term,
                };
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function (params) {
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
    //onchange
    $(document).on("change", "#region_id_" + num, function (event) {
        $("#city_id_" + num)
            .val(null)
            .trigger("change");
        $("#commune_id_" + num)
            .val(null)
            .trigger("change");
    });
}

function setSelect2City(num) {
    $("#city_id_" + num).select2({
        placeholder: "Seleccione...",
        dropdownParent: $("#modal"),
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function (params) {
                return "/config/city";
            },
            data: function (params) {
                var queryParameters = {
                    search: params.term,
                    region_id: $("#region_id_" + num).val(),
                };
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function (params) {
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
    $(document).on("change", "#city_id_" + num, function (event) {
        $("#commune_id_" + num)
            .val(null)
            .trigger("change");
    });
}

function setSelect2Commune(num) {
    $("#commune_id_" + num).select2({
        placeholder: "Seleccione...",
        dropdownParent: $("#modal"),
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        ajax: {
            type: "GET",
            url: function (params) {
                return "/config/commune";
            },
            data: function (params) {
                var queryParameters = {
                    search: params.term,
                    city_id: $("#city_id_" + num).val(),
                };
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: data.data,
                };
            },
        },
        templateResult: formatData,
        templateSelection: formatDataSelection,
        createTag: function (params) {
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
}

function chargeAddressDiv(addresses) {
    //direcciones
    let cont = 0;
    addresses.forEach((element) => {
        $(".btn-add-address").click();
        var newOption = new Option(
            element.type.name,
            element.type.id,
            true,
            true
        );
        $("#type_address_id_" + cont)
            .append(newOption)
            .trigger("change");

        var newOption = new Option(
            element.commune.city.region.name,
            element.commune.city.region.id,
            true,
            true
        );
        $("#region_id_" + cont)
            .append(newOption)
            .trigger("change");

        var newOption = new Option(
            element.commune.city.name,
            element.commune.city.id,
            true,
            true
        );
        $("#city_id_" + cont)
            .append(newOption)
            .trigger("change");

        var newOption = new Option(
            element.commune.name,
            element.commune.id,
            true,
            true
        );
        $("#commune_id_" + cont)
            .append(newOption)
            .trigger("change");

        $("#address_" + cont).val(element.address);
        cont = cont + 1;
    });
}

function chargeEmailsDiv(emails) {
    let cont = 0;
    emails.forEach((element) => {
        $(".btn-add-email").click();
        var newOption = new Option(
            element.type.name,
            element.type.id,
            true,
            true
        );
        $("#type_email_id_" + cont)
            .append(newOption)
            .trigger("change");

        $("#email_" + cont).val(element.email);
        cont = cont + 1;
    });
}

function chargePhonesDiv(phones) {
    let cont = 0;
    phones.forEach((element) => {
        $(".btn-add-phone").click();
        var newOption = new Option(
            element.type.name,
            element.type.id,
            true,
            true
        );
        $("#type_phone_id_" + cont)
            .append(newOption)
            .trigger("change");

        $("#phone_" + cont).val(element.phone);
        cont = cont + 1;
    });
}

function tax_cobertura_string(data) {
    if (data == 0) {
        return "Exento";
    } else {
        return "Afecto";
    }
}

function changeTypePerson(type) {
    $("#divLastName").hide();
    $("#lblName").html("Razón Social");
    $("#divPersonalInformation").hide();
    $("#marital_status_id").val(null).trigger("change");
    $("#gender_id").val(null).trigger("change");
    birthdate.clear();
    if (type == 1) {
        $("#divLastName").show();
        $("#lblName").html("Nombre");
        $("#divPersonalInformation").show();
    }
}

function returnPersonCotizacion(person) {
    var option = $("#optionTypePerson").val();

    $("#person_id_" + option).val(person.id);
    $("#person_id_" + option).trigger("change");
}

//onchange
$(document).on("change", ".select2-region-modal", function (event) {
    $(".select2-city-modal").val(null).trigger("change");
    $(".select2-commune-modal").val(null).trigger("change");
});
$(document).on("change", ".select2-city-modal", function (event) {
    $(".select2-commune-modal").val(null).trigger("change");
});
$(document).on("select2:select", ".select2-type-person", function (e) {
    var data = e.params.data;
    changeTypePerson(data.usage);
});

$(document).on("select2:select", ".select2-type-intermediary", function (e) {
    var data = e.params.data;
    changeTypePerson(data.usage);
});

///select2

function formatData(data) {
    if (data.loading) {
        return data.text;
    }

    var $container = $(
        "<div class='row'>" +
            "<div class='col-12'>" +
            data.name +
            "</div>" +
            "</div>"
    );

    return $container;
}

function formatDataSelection(data) {
    return data.name || data.text;
}

function formatDataPerson(data) {
    if (data.loading) {
        return data.text;
    }

    var $container = $(
        "<div class='row'>" +
            "<div class='col-6'>Nombre: " +
            data.full_name +
            "</div>" +
            "<div class='col-6'> RUT: " +
            data.identification +
            "<br>Código: " +
            data.id +
            "</div>" +
            "</div>"
    );

    return $container;
}

function formatDataSelectionPerson(data) {
    var $container = "";
    if (data.full_name) {
        $container = $(
            "<div class='row'>" +
                "<div class='col-12'>" +
                data.identification +
                " .- " +
                data.full_name +
                "</div>" +
                "</div>"
        );
    }

    return $container || data.text;
}

function formatDataSelectionIntermediary(data) {
    var $container = "";
    if (data.full_name) {
        $container = $(
            "<div class='row'>" +
                "<div class='col-12'>" +
                data.id +
                " .- " +
                data.full_name +
                "</div>" +
                "</div>"
        );
    }

    return $container || data.text;
}

$(".select2-region-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/region";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-region").select2({
    placeholder: "Seleccione...",
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/region";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/city";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                region_id: $("#region_id").val(),
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-city").select2({
    placeholder: "Seleccione...",
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/city";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                region_id: $("#region_id").val(),
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/commune";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                city_id: $("#city_id").val(),
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-commune").select2({
    placeholder: "Seleccione...",
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/commune";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                city_id: $("#city_id").val(),
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/branchvehicle";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/modelvehicle";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                branch_id: $("#branch_id").val(),
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-type-company-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/code";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                type: "company",
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-type-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/type";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                used_in: "Address",
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-used").select2({
    multiple: true,
    tags: true,
    tokenSeparators: [";", " "],
    dropdownParent: $(".modal"),
});

$(".select2-role-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/access/role";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-company").select2({
    placeholder: "Seleccione...",
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/company";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-company-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/company";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-ramo").select2({
    placeholder: "Seleccione...",
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/ramo";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-ramo-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/ramo";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-coin").select2({
    placeholder: "Seleccione...",
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/coin";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-coin-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/coin";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-simple").select2({
    placeholder: "Seleccione...",
});

$(".select2-simple-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
});

$(".select2-code-ramo-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/code";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                type: "ramo",
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-code-type-cobertura-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/code";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                type: "cobertura",
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-code-expressed-in-modal").select2({
    placeholder: "Seleccione...",
    dropdownParent: $(".modal"),
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/code";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                type: "cobertura_expressed_in",
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-code-person-carat").select2({
    placeholder: "Seleccione...",
    multiple: true,
    tags: true,
    tokenSeparators: [",", " "],
    ajax: {
        type: "GET",
        url: function (params) {
            return "/code";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                type: "person_carat",
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-code-person-item").select2({
    placeholder: "Seleccione...",
    multiple: true,
    tags: true,
    tokenSeparators: [",", " "],
    ajax: {
        type: "GET",
        url: function (params) {
            return "/code";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                type: "person_item",
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-code-intermediary").select2({
    placeholder: "Seleccione...",
    multiple: true,
    tags: true,
    tokenSeparators: [",", " "],
    ajax: {
        type: "GET",
        url: function (params) {
            return "/code";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
                type: "intermediary",
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatData,
    templateSelection: formatDataSelection,
    createTag: function (params) {
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

$(".select2-person").select2({
    placeholder: "Seleccione...",
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            return "/config/person";
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatDataPerson,
    templateSelection: formatDataSelectionPerson,
    createTag: function (params) {
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

$(".select2-intermediary").select2({
    placeholder: "Seleccione...",
    escapeMarkup: function (markup) {
        return markup;
    }, // let our custom formatter work
    ajax: {
        type: "GET",
        url: function (params) {
            var dataParam = $(this).data("param1");
            return "/config/intermediary/" + dataParam;
        },
        data: function (params) {
            var queryParameters = {
                search: params.term,
            };
            return queryParameters;
        },
        processResults: function (data) {
            return {
                results: data.data,
            };
        },
    },
    templateResult: formatDataPerson,
    templateSelection: formatDataSelectionIntermediary,
    createTag: function (params) {
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

$(document).on("click", ".view-person", function (event) {
    var id_type = Number($(this).attr("data-param1"));
    var person_id = $("#person_id_" + id_type).val();
    $("#optionTypePerson").val(id_type);

    $.ajax({
        type: "GET",
        url: "/config/person/modal",
        data: "id=" + person_id,
        success: function (data) {
            $(".modal-body-person").html(data);

            $(".btn-save-person").hide();
            $(".btn-update-person").show();

            $("#modal-person")
                .find(".modal-title-person")
                .text("Modificar Participante");
            $("#modal-person")
                .find('.modal-footer button[type="submit"]')
                .text("Modificar");

            birthdate = flatpickr("#birthdate", config_flatpickr);

            $("#type_id").select2({
                placeholder: "Seleccione...",
                dropdownParent: $("#modal-person"),
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                ajax: {
                    type: "GET",
                    url: function (params) {
                        return "/code";
                    },
                    data: function (params) {
                        var queryParameters = {
                            search: params.term,
                            type: "person",
                        };
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: data.data,
                        };
                    },
                },
                templateResult: formatData,
                templateSelection: formatDataSelection,
                createTag: function (params) {
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

            changeTypePerson($("#type_id").val());

            $("#marital_status_id").select2({
                placeholder: "Seleccione...",
                dropdownParent: $("#modal-person"),
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                ajax: {
                    type: "GET",
                    url: function (params) {
                        return "/code";
                    },
                    data: function (params) {
                        var queryParameters = {
                            search: params.term,
                            type: "marital_status",
                        };
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: data.data,
                        };
                    },
                },
                templateResult: formatData,
                templateSelection: formatDataSelection,
                createTag: function (params) {
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

            $("#gender_id").select2({
                placeholder: "Seleccione...",
                dropdownParent: $("#modal-person"),
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                ajax: {
                    type: "GET",
                    url: function (params) {
                        return "/code";
                    },
                    data: function (params) {
                        var queryParameters = {
                            search: params.term,
                            type: "gender",
                        };
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: data.data,
                        };
                    },
                },
                templateResult: formatData,
                templateSelection: formatDataSelection,
                createTag: function (params) {
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

            $("#modal-person").modal("show");
        },
    });
});

$(document).on("click", ".create-person", function (event) {
    var id_type = Number($(this).attr("data-param1"));
    $("#optionTypePerson").val(id_type);
    $.ajax({
        type: "GET",
        url: "/config/person/modal",
        success: function (data) {
            $(".modal-body-person").html(data);

            $("#modal-person")
                .find(".modal-title-person")
                .text("Agregar nuevo Participante");

            $(".btn-save-person").show();
            $(".btn-update-person").hide();

            birthdate = flatpickr("#birthdate", config_flatpickr);

            $("#type_id").select2({
                placeholder: "Seleccione...",
                dropdownParent: $("#modal-person"),
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                ajax: {
                    type: "GET",
                    url: function (params) {
                        return "/code";
                    },
                    data: function (params) {
                        var queryParameters = {
                            search: params.term,
                            type: "person",
                        };
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: data.data,
                        };
                    },
                },
                templateResult: formatData,
                templateSelection: formatDataSelection,
                createTag: function (params) {
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

            $("#marital_status_id").select2({
                placeholder: "Seleccione...",
                dropdownParent: $("#modal-person"),
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                ajax: {
                    type: "GET",
                    url: function (params) {
                        return "/code";
                    },
                    data: function (params) {
                        var queryParameters = {
                            search: params.term,
                            type: "marital_status",
                        };
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: data.data,
                        };
                    },
                },
                templateResult: formatData,
                templateSelection: formatDataSelection,
                createTag: function (params) {
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

            $("#gender_id").select2({
                placeholder: "Seleccione...",
                dropdownParent: $("#modal-person"),
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                ajax: {
                    type: "GET",
                    url: function (params) {
                        return "/code";
                    },
                    data: function (params) {
                        var queryParameters = {
                            search: params.term,
                            type: "gender",
                        };
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: data.data,
                        };
                    },
                },
                templateResult: formatData,
                templateSelection: formatDataSelection,
                createTag: function (params) {
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

            $("#modal-person").modal("show");
        },
    });
});

$(document).on("click", ".close-modal-person", function (event) {
    $("#modal-person").modal("hide");
});

$(document).on("click", ".close-modal-item", function (event) {
    $("#modal-item").modal("hide");
});
