<?php
require_once '../php/conexion.php';

session_start();
$nombre = $_SESSION["nombre"];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}

$sql = "SELECT * FROM formacion WHERE formador = '$nombre' ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

?>

<form class="visualizar" id="visualizar_forma">
    <div class="container-input">
        <input type="text" name="busqueda_forma" autocomplete="off" placeholder="Buscar" class="input">
        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
            <path d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z" fill-rule="evenodd"></path>
        </svg>
    </div>
</form>

<div id="resultadoBusqueda">
    <?php if ($result->num_rows > 0) : ?>
        <table class='table'>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Campaña</th>
                    <th>Ciudad</th>
                    <th>Fecha Inicio</th>
                    <th>Formador</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr scope='row'>
                        <td data-form='formacion' data-id="<?= $row["codigo"] ?>" class="id"><?= $row["codigo"] ?></td>
                        <td><?php echo $row['campaña']; ?></td>
                        <td><?php echo $row['ciudad']; ?></td>
                        <td><?php echo $row['fecha_inicio']; ?></td>
                        <td><?php echo $row['formador']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <table class='table' id="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Campaña</th>
                    <th>Ciudad</th>
                    <th>Fecha Inicio</th>
                    <th>Formador</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr scope='row'>
                    <td colspan='6' class='no-data'>Sin Datos</td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    $('input[name="busqueda_forma"]').on("keyup", function() {
        var busqueda = $(this).val();

        $.ajax({
            url: "../php/consulta_formacion.php",
            type: "GET",
            data: {
                busqueda: busqueda
            },
            success: function(response) {
                $("#resultadoBusqueda").html(response);
            },
        });
    });
</script>   