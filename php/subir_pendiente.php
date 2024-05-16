<?php
require_once 'conexion.php';
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_recluta'];
    $tipificacion = empty($_POST['tipificacion']) ? null : $_POST['tipificacion'];
    $fechaCampo = empty($_POST['fechaCampo']) ? null : $_POST['fechaCampo'];
    $franja = empty($_POST['franja']) ? null : $_POST['franja'];

    // Construye la consulta SQL
    $sql = "UPDATE reclutas SET franja = " . ($franja !== null ? "'$franja'" : "NULL") . ", tipificacion = " . ($tipificacion !== null ? "'$tipificacion'" : "NULL") . ", fecha_cita = " . ($fechaCampo !== null ? "'$fechaCampo'" : "NULL") . " WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $response['status'] = 'success';
        $response['message'] = "Actualización exitosa";
    } else {
        $response['status'] = 'error';
        $response['message'] = "Error en la actualización: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    $response['status'] = 'error';
    $response['message'] = "Método de solicitud no válido";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
