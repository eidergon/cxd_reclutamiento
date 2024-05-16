<?php
require '../php/conexion.php';

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}

$codigo = $_GET['id'];

$sql = "SELECT * FROM formacion WHERE codigo = '$codigo'";
$result = $conn->query($sql);
$fila = $result->fetch_assoc();

$sql2 = "SELECT * FROM asistencia WHERE campaña = '$codigo'";
$result2 = $conn->query($sql2);
?>

<nav class="navbar">
    <div class="container-fluid">
        <input type="hidden" id="codigo" value="<?php echo $fila['codigo']; ?>">
        <h3>Campaña: <?php echo $fila['campaña']; ?></h3>
        <h3>Código: <?php echo $fila['codigo']; ?></h3>
        <h3 class="estado">Estado: <?php echo $fila['estado']; ?></h3>
        <form class="d-flex" id="cambiar_estado">
            <select name="estado" id="estado" class="select">
                <option value="">Cambiar estado</option>
                <option value="En curso">En Curso</option>
                <option value="Práctica">Práctica</option>
                <option value="Finalizado">Finalizado</option>
                <option value="Cancelado">Cancelado</option>
            </select>
            <button type="submit" class="submit" style="padding: 0;">Cambiar Estado</button>
        </form>
    </div>
</nav>

<div class="txt-asistencia">
    <h2>Registro de Asistencia</h2>
    <button id="editButton" class="submit">Habilitar Edición</button>
    <button type="submit" class="submit hidden" id="asistencia">Guardar</button>
</div>

<?php if ($result->num_rows > 0) : ?>
    <table class='table' id="tablaAsistencia">
        <thead>
            <tr>
                <th>Nombre</th>
                <?php if ($fila['estado'] == 'En Curso' || $fila['estado'] == 'Activo') : ?>
                    <th>Día 1</th>
                    <th>Día 2</th>
                    <th>Día 3</th>
                    <th>Día 4</th>
                    <th>Día 5</th>
                <?php elseif ($fila['estado'] != 'En Curso' || $fila['estado'] != 'Activo') : ?>
                    <th>Día 6</th>
                    <th>Día 7</th>
                    <th>Día 8</th>
                    <th>Día 9</th>
                    <th>Día 10</th>
                    <th>Día 11</th>
                    <th>Día 12</th>
                    <th>Día 13</th>
                    <th>Día 14</th>
                    <th>Día 15</th>
                <?php endif; ?>
                <th>Estado</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result2->fetch_assoc()) : ?>
                <tr scope='row'>
                    <td><?php echo $row["nombre"]; ?></td>
                    <?php if ($fila['estado'] == 'En Curso' || $fila['estado'] == 'Activo') : ?>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php
                            $columna = "dia_" . $i;
                            $editable = ($row[$columna] == null) ? 'true' : 'false'; ?>
                            <!-- Mostrar el contenido de las celdas de asistencia -->
                            <td contenteditable="<?php echo $editable; ?>"><?php echo $row[$columna]; ?></td>
                        <?php endfor; ?>
                    <?php elseif ($fila['estado'] != 'En Curso' || $fila['estado'] != 'Activo') : ?>
                        <?php for ($i = 6; $i <= 15; $i++) : ?>
                            <?php
                            $columna = "dia_" . $i;
                            $editable = ($row[$columna] == null) ? 'true' : 'false'; ?>
                            <!-- Mostrar el contenido de las celdas de asistencia -->
                            <td contenteditable="<?php echo $editable; ?>"><?php echo $row[$columna]; ?></td>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <td contenteditable="true" style="padding: 0;">
                        <select class="select opciones" id="opciones" name="opciones" style="padding: 1px;">
                            <option value="">Estado</option>
                            <option value="asiste" <?php echo ($row['estado'] == "asiste") ? 'selected' : ''; ?>>Asiste</option>
                            <option value="no inicio" <?php echo ($row['estado'] == "no inicio") ? 'selected' : ''; ?>>No Inicio</option>
                            <option value="deserción" <?php echo ($row['estado'] == "deserción") ? 'selected' : ''; ?>>Deserción</option>
                        </select>
                    </td>
                    <td contenteditable="false" style="padding: 0;">
                        <select class="select opciones2" name="opciones2" id="opciones2" style="padding: 1px;">
                            <option value="">Motivo</option>
                            <option value="Económicos" <?php echo ($row['motivo'] == "Económicos") ? 'selected' : ''; ?>>Económicos</option>
                            <option value="Calamidad" <?php echo ($row['motivo'] == "Calamidad") ? 'selected' : ''; ?>>Calamidad</option>
                            <option value="Estudio" <?php echo ($row['motivo'] == "Estudio") ? 'selected' : ''; ?>>Estudio</option>
                            <option value="Mejor oferta laboral" <?php echo ($row['motivo'] == "Mejor oferta laboral") ? 'selected' : ''; ?>>Mejor oferta laboral</option>
                            <option value="Habilidades comerciales" <?php echo ($row['motivo'] == "Habilidades comerciales") ? 'selected' : ''; ?>>Habilidades comerciales</option>
                            <option value="Conducta inapropiada" <?php echo ($row['motivo'] == "Conducta inapropiada") ? 'selected' : ''; ?>>Conducta inapropiada</option>
                            <option value="Ausencia injustificada" <?php echo ($row['motivo'] == "Ausencia injustificada") ? 'selected' : ''; ?>>Ausencia injustificada</option>
                        </select>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else : ?>
    <table class='table' id="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Día 1</th>
                <th>Día 2</th>
                <th>Día 3</th>
                <th>Día 4</th>
                <th>Día 5</th>
                <th>Estado</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            <tr scope='row'>
                <td colspan='8' class='no-data'>Sin Datos</td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>

<script></script>
<script>
    function actualizarTabla() {
        var codigo = $('#codigo').val();
        var formUrl = "../view/formacion.php?id=" + encodeURIComponent(codigo);

        $.ajax({
            url: formUrl,
            type: "GET",
            success: function(response) {
                $("#main").html(response);
            },
            error: function(error) {
                console.log("Error al cargar el formulario:", error);
            },
        });
    }

    $(document).ready(function() {
        //chulos y x en la celdas de dias
        $('#tablaAsistencia').on('click', 'td[contenteditable="true"]:not(:nth-child(1)):not(:nth-last-child(2)):not(:last-child)', function() {
            // Cambia el contenido de la celda clicada a '✔' o '❌'
            $(this).text($(this).text() === '✔' ? '❌' : '✔');
        });

        $("table [contenteditable]").prop("contenteditable", "false");
        $('.opciones').prop('disabled', true);
        $('.opciones2').prop('disabled', true);

        $("#editButton").click(function() {
            // Encuentra todas las celdas que tienen valor null
            var cellsToEdit = $("table [contenteditable=false]").filter(function() {
                return $(this).text().trim() === "";
            });

            // Cambia el estado contenteditable de las celdas seleccionadas
            cellsToEdit.prop("contenteditable", "true");
            $("#editButton").addClass("hidden");
            $("#asistencia").removeClass("hidden");
            $('.opciones').prop('disabled', false).prop('required', true);
        });

        var valorInicialTipificacion = $("#opciones").val();

        $(".opciones").change(function() {
            var selectedValue = $(this).val();

            if (selectedValue === "deserción") {
                $('.opciones2').prop('disabled', false).prop('required', true);
            } else {
                $('.opciones2').prop('disabled', true).prop('required', false);
            }
        });

        $('.opciones').each(function() {
            // Obtener el valor actual del elemento select
            var valorInicialTipificacion = $(this).val();

            // Aplicar la lógica basada en el valor
            if (valorInicialTipificacion === "deserción") {
                // Deshabilita otras opciones en este select específico
                $(this).find("option:not(:selected)").prop("disabled", true);
                // Aplica cualquier otra lógica necesaria, como deshabilitar elementos relacionados
                $(this).closest('tr').find('.opciones2').prop('disabled', true);
            } else {
                // Habilita todas las opciones en este select específico
                $(this).find("option").prop("disabled", false);
                // Aplica cualquier otra lógica necesaria
                $(this).closest('tr').find('.opciones2').prop('disabled', false);
            }
        });

        $('#cambiar_estado').submit(function(e) {
            e.preventDefault(); // Evitar el envío normal del formulario

            // Obtener los datos del formulario y agregar el código
            var formData = $(this).serialize() + '&codigo=' + '<?php echo $codigo; ?>';

            // Realizar la solicitud AJAX
            $.ajax({
                type: 'POST',
                url: '../php/cambiar_estado.php',
                data: formData,
                success: function(response) {
                    // Parse the JSON response
                    var data = JSON.parse(response);

                    if (data.success) {
                        var nuevoEstado = data.nuevoEstado;
                        // Actualizar el contenido del nav con el nuevo estado
                        $('.container-fluid h5:nth-child(3)').text('Estado: ' + nuevoEstado);
                        actualizarTabla();
                    } else {
                        console.error('Error: ' + data.message);
                    }
                },
                error: function(error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });

        //envio ajax
        $("#asistencia").click(function() {
            var asistenciaData = [];
            $("#tablaAsistencia tbody tr").each(function() {
                var rowData = {
                    nombre: $(this).find("td:eq(0)").text(),
                };
                $(this).find("td:not(:first-child, :nth-last-child(2), :last-child)").each(function(index) {
                    <?php if ($fila['estado'] == 'En Curso' || $fila['estado'] == 'Activo') : ?>
                        var columnName = "dia_" + (index + 1);
                    <?php elseif ($fila['estado'] != 'En Curso' || $fila['estado'] != 'Activo') : ?>
                        var columnName = "dia_" + (index + 6);
                    <?php endif; ?>

                    rowData[columnName] = $(this).text();
                });

                // Agregar el valor de la penúltima celda (estado de asistencia)
                rowData['estado'] = $(this).find("td:nth-last-child(2) select").val();

                // Agregar el valor de la última celda (motivo)
                rowData['motivo'] = $(this).find("td:last select").val();

                asistenciaData.push(rowData);
            });

            $.ajax({
                type: 'POST',
                url: '../php/guardar_asistencia.php',
                data: {
                    codigo: '<?php echo $codigo; ?>',
                    asistencia: JSON.stringify(asistenciaData),
                },
                success: function(response) {
                    console.log('Guardado exitoso:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    console.log('Response Text:', xhr.responseText);
                }
            });

            $("#asistencia").addClass("hidden");
            $("#editButton").removeClass("hidden");
            $("table [contenteditable]").prop("contenteditable", "false")
            $('opciones').prop('disabled', true).prop('required', false);
        });
    });
</script>