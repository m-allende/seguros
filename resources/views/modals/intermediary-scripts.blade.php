@php
    ////option 1 Mantenedor
    ////option 2 Cotizacion
@endphp
<script>
    let birthdate = "";
    var formClone = $(".modal-dialog-intermediary").clone();

    $(document).on('click', '.btn-add-intermediary', function() {
        $('#modal-intermediary').modal("show")
        $(".modal-dialog-intermediary").replaceWith(formClone.clone());
        $('#modal-intermediary').find('.modal-title-intermediary').text('Agregar nuevo Intermediario')
        $('.btn-save-intermediary').show();

        birthdate = flatpickr("#birthdate", config_flatpickr);

        $("#type_id").select2({
            placeholder: "Seleccione...",
            dropdownParent: $('#modal-intermediary'),
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            ajax: {
                type: "GET",
                url: function(params) {
                    return "/code";
                },
                data: function(params) {
                    var queryParameters = {
                        search: params.term,
                        type: "person",
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
        $("#marital_status_id").select2({
            placeholder: "Seleccione...",
            dropdownParent: $('#modal-intermediary'),
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            ajax: {
                type: "GET",
                url: function(params) {
                    return "/code";
                },
                data: function(params) {
                    var queryParameters = {
                        search: params.term,
                        type: "marital_status",
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
        $("#gender_id").select2({
            placeholder: "Seleccione...",
            dropdownParent: $('#modal-intermediary'),
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            ajax: {
                type: "GET",
                url: function(params) {
                    return "/code";
                },
                data: function(params) {
                    var queryParameters = {
                        search: params.term,
                        type: "gender",
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

        $('.btn-update-intermediary').hide()
    })

    $(document).on('click', '.btn-save-intermediary', function(e) {
        e.preventDefault();
        var data = $('#form-intermediary').serialize() + '&cont_address=' + $(".btn-add-address")
            .data(
                "cont") + '&cont_email=' + $(".btn-add-email").data(
                "cont") + '&cont_phone=' + $(".btn-add-phone").data(
                "cont");
        $.ajax({
            type: "POST",
            url: "{{ route('intermediary.store') }}",
            data: data,
            success: function(data) {
                if (data.status == 200) {
                    table.draw();
                    $('#form-intermediary').trigger("reset");
                    $('#modal-intermediary').modal('hide');
                } else {
                    var error = '';
                    $.each(data.errors, function(key, err_values) {
                        error += err_values
                        error += '<br>';
                    });
                    sweetError(error);
                }
            },
            error: function(data) {
                sweetError("Error al Grabar");
            }
        });
    })

    $(document).on('click', '.btn-edit-intermediary', function() {
        $(".modal-dialog-intermediary").replaceWith(formClone.clone());

        $('.btn-save-intermediary').hide();
        $('.btn-update-intermediary').show();

        $('#modal-intermediary').find('.modal-title-intermediary').text('Modificar Intermediario')
        $('#modal-intermediary').find('.modal-footer button[type="submit"]').text('Modificar')

        var rowData = table.row($(this).parents('tr')).data()

        $('#form-intermediary').find('input[name="id"]').val(rowData.id)
        $('#form-intermediary').find('input[name="name"]').val(rowData.name)
        $('#form-intermediary').find('input[name="last_name"]').val(rowData.last_name)
        $('#form-intermediary').find('input[name="mother_last_name"]').val(rowData.mother_last_name)
        $('#form-intermediary').find('input[name="abbreviation"]').val(rowData.abbreviation)
        $('#form-intermediary').find('input[name="identification"]').val(rowData.identification)


        birthdate = flatpickr("#birthdate", config_flatpickr);
        if (rowData.birthdate != null) {
            date = (rowData.birthdate).split("-");
            birthdate.setDate(date[2] + "-" + date[1] + "-" + date[0]);
        }

        $("#type_id").select2({
            placeholder: "Seleccione...",
            dropdownParent: $('#modal-intermediary'),
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            ajax: {
                type: "GET",
                url: function(params) {
                    return "/code";
                },
                data: function(params) {
                    var queryParameters = {
                        search: params.term,
                        type: "person",
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

        var newOption = new Option(
            rowData.type.name,
            rowData.type.id,
            true,
            true
        );

        $("#type_id")
            .append(newOption)
            .trigger("change");

        changeTypePerson(rowData.type.usage);

        $("#marital_status_id").select2({
            placeholder: "Seleccione...",
            dropdownParent: $('#modal-intermediary'),
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            ajax: {
                type: "GET",
                url: function(params) {
                    return "/code";
                },
                data: function(params) {
                    var queryParameters = {
                        search: params.term,
                        type: "marital_status",
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
        if (rowData.marital_status != null) {
            newOption = new Option(
                rowData.marital_status.name,
                rowData.marital_status.id,
                true,
                true
            );
            $("#marital_status_id")
                .append(newOption)
                .trigger("change");
        }

        $("#gender_id").select2({
            placeholder: "Seleccione...",
            dropdownParent: $('#modal-intermediary'),
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            ajax: {
                type: "GET",
                url: function(params) {
                    return "/code";
                },
                data: function(params) {
                    var queryParameters = {
                        search: params.term,
                        type: "gender",
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
        if (rowData.gender != null) {
            newOption = new Option(
                rowData.gender.name,
                rowData.gender.id,
                true,
                true
            );
            $("#gender_id")
                .append(newOption)
                .trigger("change");
        }

        chargeAddressDiv(rowData.addresses);
        chargeEmailsDiv(rowData.emails);
        chargePhonesDiv(rowData.phones);

        $('#modal-intermediary').modal("show")
    })

    $(document).on('click', '.btn-update-intermediary', function(e) {
        e.preventDefault();
        var formData = $('#form-intermediary').serialize() + '&_method=PUT&cont_address=' + $(
                ".btn-add-address")
            .data(
                "cont") + '&cont_email=' + $(".btn-add-email").data(
                "cont") + '&cont_phone=' + $(".btn-add-phone").data(
                "cont");
        var updateId = $('#form-intermediary').find('input[name="id"]').val();
        $.ajax({
            type: "POST",
            url: "/config/intermediary/" + updateId,
            data: formData,
            success: function(data) {
                if (data.status == 200) {
                    table.draw();
                    $('#modal-intermediary').modal('hide');
                } else {
                    var error = '';
                    $.each(data.errors, function(key, err_values) {
                        error += err_values
                        error += '<br>';
                    });
                    sweetError(error);
                }
            },
            error: function(data) {
                sweetError("Error al grabar");
            }
        }); //end ajax
    })

    $(document).on('click', '.btn-delete-intermediary', function() {
        var rowid = $(this).data('rowid')
        var el = $(this)
        var token = $("_token").val()
        if (!rowid) return;

        Swal.fire({
            title: "Esta seguro de eliminar el registro?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "/config/intermediary/" + rowid,
                    data: {
                        _method: 'delete',
                        _token: token
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            table.row(el.parents('tr'))
                                .remove()
                                .draw();
                        }
                    }
                }); //end ajax
            }
        });
    })

    $(document).on("click", '.export-excel-intermediary', function(e) {
        Swal.fire({
            title: "Favor Esperar",
            timer: 1000000,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: function() {
                Swal.showLoading();
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('intermediary.export') }}",
            success: function(datos) {
                Swal.fire({
                    icon: 'success',
                    title: "El informe se desacargara en segundo plano, se avisara en la seccion de notificaciones",
                    confirmButtonClass: 'btn btn-primary w-xs',
                    buttonsStyling: false
                });
            },
            error: function(datos) {
                sweetError(datos);
            }
        });
    });

    $(document).on("click", '.btn-activate-intermediary', function(e) {
        var id = $(this).data("param1");

        Swal.fire({
            title: "¿Desea dejar Vigente este Intermediario?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/config/intermediary/activate",
                    data: "id=" + id,
                    success: function(datos) {
                        table.draw();
                    },
                    error: function(datos) {
                        sweetError(datos);
                    }
                });
            }

        });
    });
</script>
