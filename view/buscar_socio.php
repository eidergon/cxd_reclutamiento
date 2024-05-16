<?php
require_once '../php/conexion.php';

session_start();
$nombre = $_SESSION["nombre"];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}

$sql = "SELECT * FROM sociodemografico ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

?>

<form class="visualizar" id="visualizar_forma">
    <div class="container-input">
        <input type="text" name="busqueda_socio" autocomplete="off" placeholder="Buscar" class="input">
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
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Documento</th>
                    <th>Formacion</th>
                    <th>vista</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr scope='row'>
                        <td><?php echo $row['nombre']; ?></a></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td><?php echo $row['documento']; ?></td>
                        <td><?php echo $row['campaña']; ?></td>
                        <td data-form='ver_socio' data-id="<?= $row["id"] ?>" class="id">ver</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <table class='table' id="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Documento</th>
                    <th>Formacion</th>
                    <th>vista</th>
                </tr>
            </thead>
            <tbody>
                <tr scope='row'>
                    <td colspan='5' class='no-data'>Sin Datos</td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
    $('input[name="busqueda_socio"]').on("keyup", function() {
        var busqueda = $(this).val();

        $.ajax({
            url: "../php/consulta_socio.php",
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
<script src="../js/script.js"></script>