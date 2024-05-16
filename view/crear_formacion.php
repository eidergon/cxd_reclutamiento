<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../');
    exit();
}

?>

<form id="crear_formacion" class="form">
    <h1>Crear Formacion</h1>
    <select class="select" name="ciudad" id="ciudad" required>
        <option value="">Ciudad</option>
        <option value="Medellin">Medellin</option>
    </select>

    <select class="select" name="campaña" id="campaña" required>
        <option value="">Campaña</option>
    </select>

    <input type="date" class="select" id="fechaInicio" name="fechaInicio" required>

    <select name="formador" id="formador" class="select" required>
        <option value="">Formador</option>
    </select>
    <button type="submit" class="submit">Crear</button>
</form>