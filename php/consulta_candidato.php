<?php
require_once 'conexion.php';
$busqueda = $_GET['busqueda'];

$sql = "SELECT * FROM reclutas WHERE (nombre LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR documento LIKE '%$busqueda%') AND tipificacion = 'CITADO' LIMIT 10";
$result = $conn->query($sql);

?>

<?php if ($result->num_rows > 0) : ?>
    <table class='table'>
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
                    <td><?= $row["asistio"] ?></td>
                    <td><?= $row["no_asistio"] ?></td>
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