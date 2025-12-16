<?php
$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "punto_venta"
);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
