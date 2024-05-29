$(document).ready(function () {
    // login ----------------------------------------------------------------
    $('#clave').click(function () {
        Swal.fire({
            title: "",
            text: "Comunicate con area de Desarrollo para recuperar la clave.",
            icon: "info"
        });
    })

    // registro
    $('#registro').click(function () {
        Swal.fire({
            title: "",
            text: "Funcionamiento no activo.",
            icon: "error"
        });
    })

    // inicio --------------------------------------------------------------------
    $(".pages").on("click", function (e) {
        e.preventDefault();

        var formName = $(this).data("form");

        $.ajax({
            url: formName + ".php",
            type: "GET",
            success: function (response) {
                $("#main").html(response);
                var today = new Date().toISOString().split('T')[0];
                $('#fechaInicio').attr('min', today);
            },
            error: function (error) {
                console.log("Error al cargar el formulario:", error);
            },
        });
    });

    // crear candidato --------------------------------------------------------------------
    $(document).on('submit', '#crear_candidato', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "../php/guardar_candidato.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                    });
                    $("#crear_candidato")[0].reset();
                } else if (response.status === "error") {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                    $("#crear_candidato")[0].reset();
                }
            },
        });
    });

    $(document).on('change', '#tipificacion', function () {
        var selectedValue = $(this).val();
        var dateField = $("#fechaCampo");
        var ampm = $("#ampm");

        if (selectedValue === "CITADO") {
            dateField.removeClass("hidden").prop("required", true);
            ampm.removeClass("hidden").prop("required", true);
        } else {
            dateField.addClass("hidden").prop("required", false);
            ampm.addClass("hidden").prop("required", false);
        }

        var today = new Date().toISOString().split('T')[0];
        $('#fechaCampo').attr('min', today);
    });

    // Buscar candidato --------------------------------------------------------------------------
    $(document).on('input', 'input[name="busqueda"]', function () {
        var busqueda = $(this).val();

        $.ajax({
            url: "../php/consulta_candidato.php",
            type: "GET",
            data: { busqueda: busqueda },
            success: function (response) {
                $("#resultadoBusqueda").html(response);
            },
        });
    });

    $(document).on('click', '.id', function (e) {
        e.preventDefault();

        var formName = $(this).data("form");
        var idValue = $(this).data("id");

        var formUrl = "../view/" + formName + ".php?id=" + encodeURIComponent(idValue);

        $.ajax({
            url: formUrl,
            type: "GET",
            success: function (response) {
                $("#main").html(response);
            },
            error: function (error) {
                console.log("Error al cargar el formulario:", error);
            },
        });
    });

    // editar asistencia ---------------------------------------------------------------------
    $(document).on('submit', '#editar_asistencia', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        console.log("sdhagdh");
        $.ajax({
            url: "../php/asistencia_cita.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                    });
                } else if (response.status === "error") {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                }
            },
        });
    });

    $(document).on('click', '#btn-editar', function () {
        $("#btn-editar").toggleClass("hidden");
        $("#btn-cancelar, #btn-guardar, #btn-reagendar").removeClass("hidden");
        $("#radio1, #radio2").prop("disabled", false);
    });

    $(document).on('click', '#btn-cancelar', function () {
        $("#btn-editar").removeClass("hidden");
        $("#btn-cancelar, #btn-guardar, #btn-reagendar").toggleClass("hidden");
        $("#radio1, #radio2").prop("disabled", true).prop("checked", false);
        $("#fechaCampo").prop("readonly", true);
        $("#label").addClass("hidden").prop("required", false);
        $("#motivos").val("");
    });

    $(document).on('click', '#btn-reagendar', function () {
        $("#fechaCampo").prop("readonly", false);
        $("#radio1, #radio2").prop("disabled", true).prop("checked", false);
        var today = new Date().toISOString().split('T')[0];
        $('#fechaCampo').attr('min', today);
    });

    $(document).on('change', '#radio2', function () {
        if (this.checked) {
            $("#label").removeClass("hidden").prop("required", true);
        } else {
            $("#label").addClass("hidden").prop("required", false);
        }
    });

    $(document).on('change', '#radio1', function () {
        if (this.checked) {
            $("#label").addClass("hidden").prop("required", false);
        } else {
            $("#label").removeClass("hidden").prop("required", true);
        }
    });

    // crear formacion ----------------------------------------------------------------------------
    $(document).on('change', '#ciudad', function () {
        var ciudadSeleccionada = $(this).val();
        var campañaSelect = $("#campaña");
        var formadorSelect = $("#formador");

        campañaSelect.empty().append("<option value=''>Campaña</option>");
        formadorSelect.empty().append("<option value=''>Formador</option>");

        if (ciudadSeleccionada === "Medellin") {
            agregarOpcion(campañaSelect, "Portabilidad");
            agregarOpcion(campañaSelect, "Migracion");
            agregarOpcion(campañaSelect, "Hogar");

            agregarOpcion(formadorSelect, "Alexander Rodríguez");
            agregarOpcion(formadorSelect, "Jhon Gómez");
            agregarOpcion(formadorSelect, "Ferney Graciano");
        }
    });

    function agregarOpcion(select, valor) {
        var opcion = $("<option></option>").attr("value", valor).text(valor);
        select.append(opcion);
    }

    $(document).on('submit', '#crear_formacion', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "../php/crear_formacion.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                    });
                    $("#crear_formacion")[0].reset();
                } else if (response.status === "error") {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                    $("#crear_formacion")[0].reset();
                }
            },
        });
    });

    // formulario -------------------------------------------------------------------------------
    $(document).on('change', '#radio17', function () {
        var inputText = $(this).next('.radio-button__label').find('.select');
        if ($(this).is(':checked')) {
            inputText.prop('disabled', false);
        } else {
            inputText.prop('disabled', true);
        }
    });

    // Actualiza el valor del radio button cuando el campo de texto cambia
    $(document).on('input', '.eps', function () {
        if ($('#radio17').is(':checked')) {
            $('#radio17').val($(this).val());
        }
    });

    $(document).on('change', '#radio26', function () {
        var inputText = $(this).next('.radio-button__label').find('.select');
        if ($(this).is(':checked')) {
            inputText.prop('disabled', false);
        } else {
            inputText.prop('disabled', true);
        }
    });

    // Actualiza el valor del radio button cuando el campo de texto cambia
    $(document).on('input', '.nacionalidad', function () {
        if ($('#radio26').is(':checked')) {
            $('#radio26').val($(this).val());
        }
    });

    // guardar formulario
    $(document).on('submit', '#sociodemografico', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "../php/sociodemografico.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                    });
                    $("#sociodemografico")[0].reset();
                } else if (response.status === "error") {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                    $("#sociodemografico")[0].reset();
                }
            },
        });
    });

    // editar pendiente --------------------------------------------------------------------------------
    $(document).on('submit', '#editar_pendiente', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "../php/subir_pendiente.php",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                    });
                } else if (response.status === "error") {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message,
                    });
                }
            },
        });
    });

    // Función para copiar la URL al portapapeles
    function copiarURL() {
        // Obtén la URL generada
        var id = $("#id_recluta").val();
        var url = "http://10.206.173.188/reclutamiento/view/formulario.php?id=" + id;

        // Crea un elemento de texto temporal para copiar la URL al portapapeles
        var tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(url).select();
        document.execCommand("copy");
        tempInput.remove();

        // Informa al usuario que la URL se ha copiado
        Swal.fire({
            icon: "success",
            title: "Copiado",
            text: "URL copiada al portapapeles: " + url,
        });
    }

    // Agrega un listener al botón de copiar para llamar a la función copiarURL cuando sea clickeado
    $(document).on("click", "#copiarButton", copiarURL);

    $(document).on('click', '#llenar', function (e) {
        e.preventDefault();
        var id = $("#id_recluta").val();
        var url = "formulario.php?id=" + id;

        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                $("#main").html(response);
            },
            error: function (error) {
                console.log("Error al cargar el formulario:", error);
            },
        });
    });

    $(document).on('click', '.wpp', function (e) {
        e.preventDefault();

        var telefonoValue = $(this).data('telefono');
        var horaValue = $(this).data('hora');
        var nombreValue = $(this).data('nombre');
        var ciudadValue = $(this).data('ciudad');
        var fechaValue = $(this).data('fecha');
        var modalidadValue = $(this).data('modalidad');

        if (ciudadValue == 'Medellín') {
            var ubi = 'Cra. 52 #14-30 local 121';
        } else if (ciudadValue == 'Bogotá') {
            var ubi = 'Cra. 7 #17-51';
        } else if (ciudadValue == 'Urabá') {
            var ubi = 'Cra. 7 #17-51';
        }

        if (modalidadValue == 'Presencial') {
            var mensaje = encodeURIComponent("¡Hola! " + nombreValue + " recuerda tu entrevista " + modalidadValue + " el día " + fechaValue + " a las " + horaValue + " en la ciudad de " + ciudadValue + " ubicación: " + ubi);
        } else {
            var mensaje = encodeURIComponent("¡Hola! " + nombreValue + " recuerda tu entrevista " + modalidadValue + " el día " + fechaValue + " a las " + horaValue);
        }

        var enlaceWhatsApp = "https://wa.me/57" + telefonoValue + "/?text=" + mensaje;
        window.open(enlaceWhatsApp, '_blank');
    });
});
