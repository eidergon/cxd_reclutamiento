<?php
require '../php/conexion.php';

session_start();
$nombre = $_SESSION["nombre"];

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}

$sql = "SELECT reclutas.nombre,reclutas.id, reclutas.telefono, reclutas.documento, asistencia.estado, asistencia.campaña FROM reclutas JOIN asistencia ON reclutas.id = asistencia.id_candidato WHERE asistencia.estado = 'no inicio';";
$result = $conn->query($sql);

$conn->close();
?>

<?php if ($result->num_rows > 0) : ?>
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Documento</th>
                <th>Estado</th>
                <th>Campaña</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr scope='row'>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $fila['documento']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['campaña']; ?></td>
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
                <th>Estado</th>
                <th>Campaña</th>
            </tr>
        </thead>
        <tbody>
            <tr scope='row'>
                <td colspan='6' class='no-data'>Sin Datos</td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>
<script src="../js/script.js"></script>