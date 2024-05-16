<?php
require '../php/conexion.php';

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM sociodemografico WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<form class="form">
    <h1>Sociodemografico</h1>
    <label>
        1.Estudia actualmente
        <input type="text" class="select txt" value="<?php echo $row['estudio']; ?>" readonly>
    </label>

    <label>
        2.Nivel educativo
        <input type="text" class="select txt" value="<?php echo $row['nivel_academico']; ?>" readonly>
    </label>

    <label>
        3.Horario de estudio
        <input type="text" class="select txt" value="<?php echo $row['horario']; ?>" readonly>
    </label>

    <label>
        4.Tipo de documento
        <input type="text" class="select txt" value="<?php echo $row['tipo_documento']; ?>" readonly>
    </label>

    <label>
        5.Documento de Identidad
        <input type="text" class="select txt" value="<?php echo $row['documento']; ?>" readonly>
    </label>

    <label>
        6.Nombre Completo
        <input type="text" class="select txt" value="<?php echo $row['nombre']; ?>" readonly>
    </label>
    <label>
        7.Género
        <input type="text" class="select txt" value="<?php echo $row['genero']; ?>" readonly>
    </label>

    <label>
        8.Fecha de nacimiento
        <input type="text" class="select txt" value="<?php echo $row['nacimiento']; ?>" readonly>
    </label>

    <label>
        9.Municipio de nacimiento
        <input type="text" class="select txt" value="<?php echo $row['municipio_nac']; ?>" readonly>
    </label>

    <label>
        10.Departamento de nacimiento
        <input type="text" class="select txt" value="<?php echo $row['departamento_nac']; ?>" readonly>
    </label>

    <label>
        11.Fecha de expedición
        <input type="text" class="select txt" value="<?php echo $row['expedicion']; ?>" readonly>
    </label>

    <label>
        12.Municipio de expedición
        <input type="text" class="select txt" value="<?php echo $row['municipio_exp']; ?>" readonly>
    </label>

    <label>
        13.Departamento de expedición
        <input type="text" class="select txt" value="<?php echo $row['departamento_exp']; ?>" readonly>
    </label>

    <label>
        14.Dirección de residencia
        <input type="text" class="select txt" value="<?php echo $row['direccion']; ?>" readonly>
    </label>

    <label>
        15.Municipio de residencia
        <input type="text" class="select txt" value="<?php echo $row['municipio']; ?>" readonly>
    </label>

    <label>
        16.Barrio de residencia
        <input type="text" class="select txt" value="<?php echo $row['barrio']; ?>" readonly>
    </label>

    <label>
        17.Número de contacto
        <input type="text" class="select txt" value="<?php echo $row['telefono']; ?>" readonly>
    </label>

    <label>
        18.correo electrónico
        <input type="text" class="select txt" value="<?php echo $row['correo']; ?>" readonly>
    </label>

    <label>
        19.contacto de emergencia
        <input type="text" class="select txt" value="<?php echo $row['tel_emergencia']; ?>" readonly>
    </label>

    <label>
        20.Nombre contacto de emergencia
        <input type="text" class="select txt" value="<?php echo $row['nombre_emergencia']; ?>" readonly>
    </label>

    <label>
        21.EPS
        <input type="text" class="select txt" value="<?php echo $row['eps']; ?>" readonly>
    </label>

    <label>
        22.Fondo de pensiones
        <input type="text" class="select txt" value="<?php echo $row['pension']; ?>" readonly>
    </label>

    <label>
        23.Nacionalidad
        <input type="text" class="select txt" value="<?php echo $row['nacionalidad']; ?>" readonly>
    </label>

    <label>
        24.Medio por el que enteró de la oferta
        <input type="text" class="select txt" value="<?php echo $row['medio']; ?>" readonly>
    </label>

    <label>
        25.Campaña
        <input type="text" class="select txt" value="<?php echo $row['campaña']; ?>" readonly>
    </label>

    <label>
        26.Horas de interés
        <input type="text" class="select txt" value="<?php echo $row['hora_interes']; ?>" readonly>
    </label>

    <label>
        27.Experiencia en ventas
        <input type="text" class="select txt" value="<?php echo $row['expVenta']; ?>" readonly>
    </label>

    <label>
        28.Experiencia en call center
        <input type="text" class="select txt" value="<?php echo $row['expCall']; ?>" readonly>
    </label>

    <label>
        29.Gastos mensuales
        <input type="text" class="select txt" value="<?php echo $row['gastos']; ?>" readonly>
    </label>
</form>