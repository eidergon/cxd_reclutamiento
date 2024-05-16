<?php
require_once 'conexion.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_recluta'];
    $fecha = $_POST['fechaCampo'];
    $asistencia = isset($_POST["asistencia"]) && $_POST["asistencia"] !== "" ? mysqli_real_escape_string($conn, $_POST["asistencia"]) : NULL;
    $motivo = isset($_POST["motivos"]) && $_POST["motivos"] !== "" ? mysqli_real_escape_string($conn, $_POST["motivos"]) : NULL;

    $updateQuery = "UPDATE reclutas SET fecha_cita = ?, asistio = ?, no_asistio = ?, fecha_asistencia = CURRENT_TIMESTAMP  WHERE id = ?";
    $updateStmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($updateStmt, "sssi", $fecha, $asistencia, $motivo, $id);
    $result = mysqli_stmt_execute($updateStmt);
    mysqli_stmt_close($updateStmt);

    if ($result) {
        $response['status'] = 'success';
        $response['message'] = "Candidato Actualizado";
    } else {
        $response['status'] = 'error';
        $response['message'] = "Error al actualizar candidato: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    $response['status'] = 'error';
    $response['message'] = "Método de solicitud no válido";
}

header('Content-Type: application/json');
echo json_encode($response);