<?php
require '../php/conexion.php';

session_start();
$nombre = $_SESSION["nombre"];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}

$sql = "SELECT * FROM reclutas WHERE tipificacion = 'CITADO' AND reclutador = '$nombre' AND asistio IS NULL AND fecha_cita < CURRENT_DATE";
$result = $conn->query($sql);

$conn->close();
?>

<?php if ($result->num_rows > 0) : ?>
    <h1>Vencidos</h1>
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Documento</th>
                <th>Tipificacion</th>
                <th>Fecha Cita</th>
                <th>Medio</th>
                <th>Ciudad</th>
                <th>Reclutador</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr scope='row'>
                    <td data-form='editar_asistencia' data-id="<?= $row["id"] ?>" class="id" ><?= $row["id"] ?></td>
                    <td><?= $row["nombre"] ?></td>
                    <td><?= $row["telefono"] ?></td>
                    <td><?= $row["documento"] ?></td>
                    <td><?= $row["tipificacion"] ?></td>
                    <td><?= $row["fecha_cita"] ?></td>
                    <td><?= $row["medio"] ?></td>
                    <td><?= $row["ciudad"] ?></td>
                    <td><?= $row["reclutador"] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else : ?>
    <table class='table' id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Documento</th>
                <th>Tipificacion</th>
                <th>Fecha_cita</th>
                <th>Medio</th>
                <th>Ciudad</th>
                <th>Asistencia</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            <tr scope='row'>
                <td colspan='10' class='no-data'>Sin Datos</td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>
<script src="../js/script.js"></script>