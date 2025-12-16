<?php
session_start();
include "db/conexion.php";

if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Clientes | Punto de Venta E.M</title>

<style>
*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f1f1f1;
}

/* Encabezado */
.header{
    background:#2d6a4f;
    color:white;
    padding:10px;
    text-align:center;
    font-size:16px;
}

/* Contenedor */
.contenedor{
    max-width:800px;
    margin:20px auto;
    background:white;
    padding:15px;
    border-radius:6px;
    box-shadow:0 2px 6px rgba(0,0,0,0.2);
}

/* Tabla */
table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    border:1px solid #ccc;
    padding:8px;
    font-size:13px;
    text-align:left;
}

th{
    background:#40916c;
    color:white;
}

/* Botones */
.btn{
    display:inline-block;
    padding:6px 10px;
    font-size:12px;
    border-radius:4px;
    text-decoration:none;
    color:white;
}

.btn-nuevo{
    background:#2d6a4f;
    margin-bottom:10px;
    display:inline-block;
}

.volver{
    display:block;
    width:140px;
    margin:20px auto;
    text-align:center;
    background:#40916c;
    color:white;
    padding:8px;
    text-decoration:none;
    border-radius:4px;
}
</style>
</head>

<body>

<div class="header">
    Clientes – Punto de Venta E.M
</div>

<div class="contenedor">

<a href="nuevo_cliente.php" class="btn btn-nuevo">➕ Nuevo Cliente</a>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>DNI</th>
    <th>Teléfono</th>
</tr>

<?php
$sql = "SELECT id, nombre, dni, telefono FROM clientes";
$res = mysqli_query($conexion, $sql);

while($fila = mysqli_fetch_assoc($res)){
?>
<tr>
    <td><?php echo $fila["id"]; ?></td>
    <td><?php echo $fila["nombre"]; ?></td>
    <td><?php echo $fila["dni"]; ?></td>
    <td><?php echo $fila["telefono"]; ?></td>
</tr>
<?php } ?>

</table>

</div>

<a href="dashboard.php" class="volver">⬅ Volver</a>

</body>
</html>
