<?php
// Parámetros de conexión
$servername = "localhost";
$username = "root";        // User
$password = "";            // Contraseña user
$database = "invetarios"; // Nombre de la BD

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}
?>