<?php
require_once 'conexion.php';
$busqueda = $_GET['busqueda'];

$sql = "SELECT * FROM sociodemografico WHERE (nombre LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR documento LIKE '%$busqueda%') LIMIT 10";
$result = $conn->query($sql);

?>

<?php if ($result->num_rows > 0) : ?>
    <table class='table'>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Cocumento</th>
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
<script src="../js/script.js"></script>