<?php
require_once '../php/conexion.php';
$id = $_GET['id'];
$sql = "SELECT * FROM reclutas WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fecha_cita = $row['fecha_cita'];
    $tipificacion = $row['tipificacion'];
}
?>
<script src="https://cdn.rawgit.com/jeromeetienne/jquery-qrcode/1.0/jquery.qrcode.min.js"></script>

<form class="form" id="editar_asistencia">
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

    <label for="tipificacion">
        Tipificacion
        <input type="text" id="tipificacion" class="select" value="<?php echo $row["tipificacion"]; ?>" readonly>
    </label>

    <label for="fechaCampo" id="fechaLabel" class="">
        Fecha Cita:
        <input type="date" class="select" id="fechaCampo" name="fechaCampo" value="<?php echo $fecha_cita; ?>" readonly>
    </label>

    <label for="">Asistió</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input disabled type="radio" class="radio-button__input" id="radio1" name="asistencia" value="SI">
            <label class="radio-button__label" for="radio1">
                <span class="radio-button__custom"></span>
                SI
            </label>
        </div>
        <div class="radio-button">
            <input disabled type="radio" class="radio-button__input" id="radio2" name="asistencia" value="NO">
            <label class="radio-button__label" for="radio2">
                <span class="radio-button__custom"></span>
                NO
            </label>
        </div>
    </div>

    <label class="hidden" id="label" for="motivos">
        Motivo
        <select name="motivos" id="motivos" class="select">
            <option value="">--- Selecionar ---</option>
            <option value="Reagendado">Reagendado</option>
            <option value="No le interesa la oferta">No le interesa la oferta</option>
            <option value="Ya tiene otro trabajo">Ya tiene otro trabajo</option>
            <option value="se traslado de ciudad">se traslado de ciudad</option>
            <option value="No contesta">No contesta</option>
            <option value="Registro duplicado">Registro duplicado</option>
        </select>
    </label>
    <div class="content-btn">
        <button type="button" id="btn-editar" class="submit">Editar</button>
        <button type="button" id="generarButton" class="submit">QR</button>
        <button type="button" id="btn-cancelar" class="submit hidden">Cancelar</button>
        <button type="button" id="btn-reagendar" class="submit hidden">Reagendar</button>
        <button type="submit" id="btn-guardar" class="submit hidden">Guardar</button>
    </div>
</form>
<div id="myModal" class="modal">
    <div class="modal-content">
        <!-- Div para mostrar el QR -->
        <button id="copiarButton">Copiar URL</button>
        <button id="llenar">Formulario</button>
        <div id="qrContainer"></div>
    </div>
</div>

<script src="../js/qr.js"></script>
<script src="../js/script.js"></script>
