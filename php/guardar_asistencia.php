<?php
require 'conexion.php';

// Obtener datos del POST
$codigo = $_POST['codigo'];
$asistenciaData = json_decode($_POST['asistencia'], true);

// Recorrer los datos de asistencia
foreach ($asistenciaData as $rowData) {
    $nombre = $rowData['nombre'];

    // Verificar si el usuario ya tiene una entrada en la tabla de asistencia
    $checkQuery = "SELECT id FROM asistencia WHERE nombre = '$nombre' AND campaña = '$codigo'";
    $checkResult = $conn->query($checkQuery);
    $sql = "SELECT * FROM formacion WHERE codigo = '$codigo'";
    $result = $conn->query($sql);
    $fila = $result->fetch_assoc();

    if ($checkResult->num_rows > 0) {
        // El usuario ya tiene una entrada, actualizarla
        $updateQuery = "UPDATE asistencia SET ";

        if ($fila['estado'] == 'En Curso' || $fila['estado'] == 'Activo') {
            // Iterar sobre las columnas que representan los días
            for ($i = 1; $i <= 5; $i++) {
                $columna = "dia_" . $i;
                $value = $rowData[$columna];

                if ($value !== '') {
                    $updateQuery .= "$columna = '$value', ";
                }
            }
        } elseif ($fila['estado'] != 'En Curso' || $fila['estado'] != 'Activo') {
            // Iterar sobre las columnas que representan los días
            for ($i = 6; $i <= 15; $i++) {
                $columna = "dia_" . $i;
                $value = $rowData[$columna];

                if ($value !== '') {
                    $updateQuery .= "$columna = '$value', ";
                }
            }
        }

        $estado = $rowData['estado'];
        if (empty($estado)) {
            $updateQuery .= "estado = NULL, ";
        } else {
            $updateQuery .= "estado = '$estado', ";
        }
        
        $motivo = $rowData['motivo'];
        if (empty($motivo)) {
            $updateQuery .= "motivo = NULL ";
        } else {
            $updateQuery .= "motivo = '$motivo' ";
        }

        $updateQuery .= "WHERE nombre = '$nombre' AND campaña = '$codigo'";
        $conn->query($updateQuery);
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Enviar una respuesta JSON indicando el éxito
echo json_encode(['success' => true]);
