<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}
$nombre = $_SESSION["nombre"];
?>

<form class="form" id="crear_candidato">
    <h1>Crear Candidato</h1>
    <input type="hidden" name="reclutador" value="<?php echo $_SESSION["nombre"]; ?>">
    <input name="nombre" class="select" type="text" placeholder="Nombre Completo" required autocomplete="off">

    <input name="telefono" class="select" type="number" required autocomplete="off" pattern="3[0-9]+" placeholder="Numero De Telefono " title="Ingrese un número de teléfono que empiece con 3">

    <input name="documento" class="select" placeholder="Documento" type="number" autocomplete="off" title="Ingrese solo números">

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
    
    <label>Ciudad</label>
    <div class="radio-button-container">
        <div class="radio-button">
            <input type="radio" class="radio-button__input" id="radio2" name="ciudad" value="Medellin" required>
            <label class="radio-button__label" for="radio2">
                <span class="radio-button__custom"></span>
                Medellín
            </label>
        </div>
    </div>
    <button type="submit" class="submit">Crear</button>
</form>