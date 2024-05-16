<?php
require 'conexion.php';

// Verificar si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nuevo estado desde la solicitud POST
    $nuevoEstado = $_POST['estado'];
    $codigo = $_POST['codigo'];
    
    $sql = "UPDATE formacion SET estado = ? WHERE codigo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nuevoEstado, $codigo);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Estado cambiado exitosamente', 'nuevoEstado' => $nuevoEstado]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado']);
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no es una solicitud POST, devolver un mensaje de error
    echo json_encode(['success' => false, 'message' => 'Error: Método no permitido']);
}
?>
