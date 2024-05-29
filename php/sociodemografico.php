<?php
require_once 'conexion.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estudio = $_POST['estudio'];
    $nivel_educativo = $_POST['nivel_educativo'];
    $horario = $_POST['horario'];
    $tipo_documento = $_POST['tipo_documento'];
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $nacimiento = $_POST['nacimiento'];
    $municipio_nac = $_POST['municipio_nac'];
    $departamento_nac = $_POST['departamento_nac'];
    $expedicion = $_POST['expedicion'];
    $municipio_exp = $_POST['municipio_exp'];
    $departamento_exp = $_POST['departamento_exp'];
    $direccion = $_POST['direccion'];
    $municipio = $_POST['municipio'];
    $barrio = $_POST['barrio'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $tel_emergencia = $_POST['tel_emergencia'];
    $nombre_emergencia = $_POST['nombre_emergencia'];
    $eps = $_POST['eps'];
    $pension = $_POST['pension'];
    $nacionalidad = $_POST['nacionalidad'];
    $medio = $_POST['medio'];
    $campaña = $_POST['campaña'];
    $hora = $_POST['hora'];
    $expVenta = $_POST['expVenta'];
    $expCall = $_POST['expCall'];
    $gastos = $_POST['gastos'];
    $banco = $_POST['banco'];
    $cuenta = $_POST['cuenta'];
    $id = $_POST['id'];

    $checkExistingQuery = "SELECT COUNT(*) FROM sociodemografico WHERE documento = ? AND campaña = ?";
    $checkStmt = mysqli_prepare($conn, $checkExistingQuery);
    mysqli_stmt_bind_param($checkStmt, "ss", $documento, $campaña);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_bind_result($checkStmt, $count);
    mysqli_stmt_fetch($checkStmt);
    mysqli_stmt_close($checkStmt);

    if ($count > 0) {
        $response['status'] = 'error';
        $response['message'] = "Ya Fuiste asisgnado a la campaña " . $campaña;
    } else {
        $insertQuery = "INSERT INTO sociodemografico (estudio, nivel_academico, horario, tipo_documento, documento, nombre, genero, nacimiento, municipio_nac, departamento_nac, expedicion, municipio_exp, departamento_exp, direccion, municipio, barrio, telefono, correo, tel_emergencia, nombre_emergencia, eps, pension, nacionalidad, medio, campaña, hora_interes, expVenta, expCall, gastos, banco, cuenta, id_candidato) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "ssssssssssssssssssssssssssssssss", $estudio, $nivel_educativo, $horario, $tipo_documento, $documento, $nombre, $genero, $nacimiento, $municipio_nac, $departamento_nac, $expedicion, $municipio_exp, $departamento_exp, $direccion, $municipio, $barrio, $telefono, $correo, $tel_emergencia, $nombre_emergencia, $eps, $pension, $nacionalidad, $medio, $campaña, $hora, $expVenta, $expCall, $gastos, $banco, $cuenta, $id);
        $result = mysqli_stmt_execute($insertStmt);
        mysqli_stmt_close($insertStmt);

        if ($result) {
            $segundaConsulta = "INSERT INTO asistencia (nombre, campaña,id_candidato) VALUES ('$nombre', '$campaña', '$id')";
            $resultSegundaConsulta = mysqli_query($conn, $segundaConsulta);
            if ($resultSegundaConsulta) {
                $response['status'] = 'success';
                $response['message'] = "Agregado exitosamente";
            } else {
                $response['status'] = 'error';
                $response['message'] = "Error en la segunda consulta SQL de creación";
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = "Error al agregar candidato: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
} else {
    $response['status'] = 'error';
    $response['message'] = "Método de solicitud no válido";
}

header('Content-Type: application/json');
echo json_encode($response);
