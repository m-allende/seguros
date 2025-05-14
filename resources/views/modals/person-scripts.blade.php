@php
    ////option 1 Mantenedor
    ////option 2 Cotizacion
@endphp
<script>
    let birthdate = "";
    var formClone = $(".modal-dialog-person").clone();

    $(document).on('click', '.btn-add-person', function() {
        $('#modal-person').modal("show")
        $(".modal-dialog-person").replaceWith(formClone.clone());
        $('#modal-person').find('.modal-title-person').text('Agregar nuevo Participante')
        $('.btn-save-person').show();

        birthdate = flatpickr("#birthdate", config_flatpickr);

        $("#type_id").select2({
            placeholder: "@lang('translation.select-option')",
            dropdownParent: $('#modal-person'),
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
            placeholder: "@lang('translation.select-option')",
            dropdownParent: $('#modal-person'),
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
            placeholder: "@lang('translation.select-option')",
            dropdownParent: $('#modal-person'),
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
        $('.btn-update-person').hide()
    })

    $(document).on('click', '.btn-save-person', function(e) {
        e.preventDefault();
        var data = $('#form-person').serialize() + '&cont_address=' + $(".btn-add-address")
            .data(
                "cont") + '&cont_email=' + $(".btn-add-email").data(
                "cont") + '&cont_phone=' + $(".btn-add-phone").data(
                "cont");
        $.ajax({
            type: "POST",
            url: "{{ route('person.store') }}",
            data: data,
            success: function(data) {
                if (data.status == 200) {
                    @if ($option == 1)
                        table.draw();
                        $('#form-person').trigger("reset");
                    @else
                        returnPersonCotizacion(data.person);
                    @endif
                    $('#modal-person').modal('hide');
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

    $(document).on('click', '.btn-edit-person', function() {
        $(".modal-dialog-person").replaceWith(formClone.clone());

        $('.btn-save-person').hide();
        $('.btn-update-person').show();

        $('#modal-person').find('.modal-title-person').text('Modificar Participante')
        $('#modal-person').find('.modal-footer button[type="submit"]').text('Modificar')

        var rowData = table.row($(this).parents('tr')).data()

        $('#form-person').find('input[name="id"]').val(rowData.id)
        $('#form-person').find('input[name="name"]').val(rowData.name)
        $('#form-person').find('input[name="last_name"]').val(rowData.last_name)
        $('#form-person').find('input[name="mother_last_name"]').val(rowData.mother_last_name)
        $('#form-person').find('input[name="abbreviation"]').val(rowData.abbreviation)
        $('#form-person').find('input[name="identification"]').val(rowData.identification)

        birthdate = flatpickr("#birthdate", config_flatpickr);
        if (rowData.birthdate != null) {
            date = (rowData.birthdate).split("-");
            birthdate.setDate(date[2] + "-" + date[1] + "-" + date[0]);
        }

        $("#type_id").select2({
            placeholder: "@lang('translation.select-option')",
            dropdownParent: $('#modal-person'),
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
            placeholder: "@lang('translation.select-option')",
            dropdownParent: $('#modal-person'),
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
            placeholder: "@lang('translation.select-option')",
            dropdownParent: $('#modal-person'),
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

        $('#modal-person').modal("show")
    })

    $(document).on('click', '.btn-update-person', function(e) {
        e.preventDefault();
        var formData = $('#form-person').serialize() + '&_method=PUT&cont_address=' + $(".btn-add-address")
            .data(
                "cont") + '&cont_email=' + $(".btn-add-email").data(
                "cont") + '&cont_phone=' + $(".btn-add-phone").data(
                "cont");
        var updateId = $('#form-person').find('input[name="id"]').val();
        $.ajax({
            type: "POST",
            url: "/config/person/" + updateId,
            data: formData,
            success: function(data) {
                if (data.status == 200) {
                    table.draw();
                    $('#modal-person').modal('hide');
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

    $(document).on('click', '.btn-delete-person', function() {
        var rowid = $(this).data('rowid')
        var el = $(this)
        var token = $("_token").val()
        if (!rowid) return;

        Swal.fire({
            title: "@lang('translation.question-delete')",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "@lang('translation.yes')",
            cancelButtonText: "No",
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: "/config/person/" + rowid,
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

    $(document).on("click", '.export-excel-person', function(e) {
        Swal.fire({
            title: "@lang('translation.please-wait')",
            timer: 1000000,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: function() {
                Swal.showLoading();
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ route('person.export') }}",
            success: function(datos) {
                Swal.fire({
                    icon: 'success',
                    title: title: "@lang('translation.warning-report-second-plane')",
                    ,
                    confirmButtonClass: 'btn btn-primary w-xs',
                    buttonsStyling: false
                });
            },
            error: function(datos) {
                sweetError(datos);
            }
        });
    });

    $(document).on("click", '.btn-activate-person', function(e) {
        var id = $(this).data("param1");

        Swal.fire({
            title: "¿Desea dejar Vigente este Participante?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "@lang('translation.yes')",
            cancelButtonText: "No",
            showCloseButton: true
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/config/person/activate",
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
