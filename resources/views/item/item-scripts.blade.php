<script>
    $(document).on("click", ".add-item", function(event) {
        $.ajax({
            type: "GET",
            url: "{{ route('item.index') }}",
            data: "type=1",
            success: function(data) {
                $(".modal-body-item").html(data);
                $(".modal-title-item").html("Agregar Item");
                $('#modal-item').modal("show")
            },
            error: function(data) {
                sweetError("Error al Crear");
            }
        });
    });
</script>
