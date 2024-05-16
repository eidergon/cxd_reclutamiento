<?php
require_once 'conexion.php';
$busqueda = $_GET['busqueda'];

$sql = "SELECT * FROM formacion WHERE (codigo LIKE '%$busqueda%' OR formador LIKE '%$busqueda%') LIMIT 10";
$result = $conn->query($sql);

?>

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
<script src="../js/script.js"></script>