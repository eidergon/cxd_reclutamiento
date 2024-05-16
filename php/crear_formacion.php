<?php
require_once 'conexion.php';
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ciudad = $_POST['ciudad'];
    $campaña = $_POST['campaña'];
    $fechaInicio = $_POST['fechaInicio'];
    $formador = $_POST['formador'];
    $estado = "Activo";
    $codigo = substr($campaña, 0, 5) . '_' . substr($ciudad, 0, 3) . '_' . date('dmy', strtotime(str_replace('-', '/', $fechaInicio)));

    $checkExistingQuery = "SELECT COUNT(*) FROM formacion WHERE fecha_inicio = ? AND campaña = ? AND ciudad = ?";
    $checkStmt = mysqli_prepare($conn, $checkExistingQuery);
    mysqli_stmt_bind_param($checkStmt, "sss", $fechaInicio, $campaña, $ciudad);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_bind_result($checkStmt, $count);
    mysqli_stmt_fetch($checkStmt);
    mysqli_stmt_close($checkStmt);

    if ($count > 0) {
        $response['status'] = 'error';
        $response['message'] = "ya existe una formacion " . $campaña . " el dia " . $fechaInicio . " en " . $ciudad;
    } else {
        $insertQuery = "INSERT INTO formacion (ciudad, campaña, fecha_inicio, formador, estado, codigo) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "ssssss", $ciudad, $campaña, $fechaInicio, $formador, $estado, $codigo);
        $result = mysqli_stmt_execute($insertStmt);
        mysqli_stmt_close($insertStmt);

        if ($result) {
            $response['status'] = 'success';
            $response['message'] = "Formacion Creada";
        } else {
            $response['status'] = 'error';
            $response['message'] = "Error al crear formacion: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
} else {
    $response['status'] = 'error';
    $response['message'] = "Método de solicitud no válido";
}

header('Content-Type: application/json');
echo json_encode($response);
