<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];
    $tamaño = $_POST['tamaño'];

    // Inserción en la base de datos
    $sql = "INSERT INTO producto (nombre, precio, existencias, tamaño) VALUES ('$nombre', '$precio', '$existencias', '$tamaño')";

    if ($conexion->query($sql) === TRUE) {
        echo "Producto agregado con éxito";
    } else {
        echo "Error al agregar el producto: " . $conexion->error;
    }
    
    // Redireccionar de vuelta a la página de productos
    header("Location: admin.php");
    exit();
}
?>
