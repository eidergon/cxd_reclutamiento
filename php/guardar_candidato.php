<?php
require_once 'conexion.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $documento = isset($_POST["documento"]) && $_POST["documento"] !== "" ? mysqli_real_escape_string($conn, $_POST["documento"]) : NULL;
        $tipificacion = $_POST['tipificacion'];
        $fecha = isset($_POST["fechaCampo"]) && $_POST["fechaCampo"] !== "" ? mysqli_real_escape_string($conn, $_POST["fechaCampo"]) : NULL;
        $franja = isset($_POST["franja"]) && $_POST["franja"] !== "" ? mysqli_real_escape_string($conn, $_POST["franja"]) : NULL;
        $medio = $_POST['medio'];
        $ciudad = $_POST['ciudad'];
        $reclutador = $_POST['reclutador'];

        $checkExistingQuery = "SELECT COUNT(*) FROM reclutas WHERE fecha_cita = ? AND documento = ?";
        $checkStmt = mysqli_prepare($conn, $checkExistingQuery);
        mysqli_stmt_bind_param($checkStmt, "ss", $fecha, $documento);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $count);
        mysqli_stmt_fetch($checkStmt);
        mysqli_stmt_close($checkStmt);
    
        if ($count > 0) {
            $response['status'] = 'error';
            $response['message'] = "El candidato ya fue citado para el dia " . $fecha;
        } else {
            $insertQuery = "INSERT INTO reclutas (nombre, telefono, documento, tipificacion, fecha_cita, franja, medio, ciudad, reclutador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($insertStmt, "sssssssss", $nombre, $telefono, $documento, $tipificacion, $fecha, $franja, $medio, $ciudad, $reclutador);
            $result = mysqli_stmt_execute($insertStmt);
            mysqli_stmt_close($insertStmt);
    
            if ($result) {
                $response['status'] = 'success';
                $response['message'] = "Candidato Agregado";
            } else {
                $response['status'] = 'error';
                $response['message'] = "Error al agregar candidato: " . mysqli_error($conn);
            }
        }
    }
    

    mysqli_close($conn);
} else {
    $response['status'] = 'error';
    $response['message'] = "Método de solicitud no válido";
}

header('Content-Type: application/json');
echo json_encode($response);
