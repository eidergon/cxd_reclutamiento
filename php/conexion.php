<?php

$servername = "10.206.173.188:3306";
$username = "mysqldb";
$password = "0n3C0nt4ct1nt3rn4c10n4l.06++";
$database = "cx_reclutamiento";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "cx_reclutamiento";

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    echo "No se realizo la conexion a la basa de datos, el error fue:" . mysqli_connect_error();
}
