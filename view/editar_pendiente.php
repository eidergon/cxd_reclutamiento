<?php
require_once '../php/conexion.php';
$id = $_GET['id'];
$sql = "SELECT * FROM reclutas WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<form class="form" id="editar_pendiente">
    <h1>Informacion candidato</h1>
    <input type="hidden" name="id_recluta" id="id_recluta" value="<?php echo $row["id"]; ?>">
    <input type="hidden" name="reclutador" value="<?php echo $_SESSION["nombre"]; ?>">

    <label for="nombre">
        Nombre
        <input name="nombre" id="nombre" class="select" type="text" value="<?php echo $row["nombre"]; ?>" readonly>
    </label>

    <label for="telefono">
        Telefono
        <input name="telefono" id="telefono" class="select" type="number" value="<?php echo $row["telefono"]; ?>" readonly>
    </label>

    <label for="documento">
        Documento
        <input name="documento" id="documento" class="select" type="number" value="<?php echo $row["documento"]; ?>" readonly>
    </label>

    <select class="select" id="tipificacion" name="tipificacion" required>
        <option value="">Tipificacion</option>
        <option value="CITADO">CITADO</option>
        <option value="NO CONTESTA">NO CONTESTA</option>
        <option value="VIVE EN OTRA CIUDAD">VIVE EN OTRA CIUDAD</option>
        <option value="NO INTERESA - HORARIOS">NO INTERESA - HORARIOS</option>
        <option value="NO INTERESA - CONDICIONES">NO INTERESA - CONDICIONES</option>
        <option value="NO CUMPLE CON EL PERFIL">NO CUMPLE CON EL PERFIL</option>
        <option value="YA TRABAJA EN CALL CENTER">YA TRABAJA EN CALL CENTER</option>
        <option value="YA TRABAJA EN OTRO SECTOR">YA TRABAJA EN OTRO SECTOR</option>
    </select>

    <input type="date" class="select hidden" id="fechaCampo" name="fechaCampo">

    <select class="select hidden" id="ampm" name="franja">
        <option value="">Franja Horaria</option>
        <option value="AM">AM</option>
        <option value="PM">PM</option>
    </select>

    <select class="select" name="medio" id="medio" required>
        <option value="">Medio</option>
        <option value="WHATSAPP">WHATSAPP </option>
        <option value="TIKTOK">TIKTOK</option>
        <option value="FACEBOOK">FACEBOOK</option>
        <option value="COMFAMA">COMFAMA</option>
        <option value="CONFENALCO">CONFENALCO</option>
        <option value="COMPENSAR">COMPENSAR</option>
        <option value="CAFAM">CAFAM</option>
        <option value="COLSUBSIDIO">COLSUBSIDIO</option>
        <option value="UNIMINUTO">UNIMINUTO</option>
        <option value="CESDE">CESDE</option>
        <option value="DISTRITAL">DISTRITAL</option>
        <option value="INDEEP">INDEEP</option>
        <option value="LINKEDIN">LINKEDIN</option>
        <option value="EMPLEO PUBLICO">EMPLEO PUBLICO</option>
        <option value="SENA">SENA</option>
        <option value="ELEMPLEO.COM">ELEMPLEO.COM</option>
        <option value="VOLANTE EN CALLE">VOLANTE EN CALLE</option>
        <option value="REFERIDOS">REFERIDOS</option>
        <option value="LLAMADA">LLAMADA</option>
        <option value="REINTEGRO">REINTEGRO</option>
    </select>
    <button type="submit" class="submit">Crear</button>
</form>
<script src="../js/script.js"></script>