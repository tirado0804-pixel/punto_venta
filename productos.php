<?php
session_start();
include "db/conexion.php";

/* Seguridad */
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
    exit;
}

/* Mostrar errores (solo desarrollo) */
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Productos | Punto de Venta E.M</title>

<style>
*{
    box-sizing:border-box;
}

body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#eee;
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
.contenedor-productos{
    max-width:900px;
    margin:20px auto;
    display:flex;
    flex-wrap:wrap;
    justify-content:flex-start;
}

/* Tarjeta */
.card{
    width:180px;
    background:white;
    border:1px solid #ccc;
    border-radius:6px;
    padding:10px;
    margin:10px;
    text-align:center;
}

/* Imagen pequeña */
.card img{
    width:60px;
    height:60px;
    object-fit:contain;
    display:block;
    margin:0 auto 5px auto;
}

/* Texto */
.card h3{
    font-size:13px;
    margin:5px 0;
    color:#2d6a4f;
}

.precio{
    font-size:13px;
    font-weight:bold;
    color:#e63946;
}

.stock{
    font-size:12px;
    color:#555;
    margin-bottom:6px;
}

/* Botón */
.card button{
    width:100%;
    padding:5px;
    font-size:12px;
    background:#2d6a4f;
    color:white;
    border:none;
    border-radius:4px;
    cursor:pointer;
}

/* Volver */
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
    Productos – Punto de Venta E.M
</div>

<div class="contenedor-productos">

<?php
$sql = "SELECT nombre, precio, stock, imagen FROM productos";
$res = mysqli_query($conexion, $sql);

while($fila = mysqli_fetch_assoc($res)){

    /* Manejo correcto de imagen (sin deprecated) */
    $img = "";

    if(!empty($fila["imagen"])){
        $img = strtolower(trim($fila["imagen"]));
    }

    if($img == "" || !file_exists("imagenes/".$img)){
        $img = "noimage.png";
    }
?>
    <div class="card">
        <img src="imagenes/<?php echo $img; ?>" alt="">
        <h3><?php echo $fila["nombre"]; ?></h3>
        <div class="precio">S/ <?php echo number_format($fila["precio"],2); ?></div>
        <div class="stock">Stock: <?php echo $fila["stock"]; ?></div>
        <button>Agregar</button>
    </div>
<?php } ?>

</div>

<a href="dashboard.php" class="volver">⬅ Volver</a>

</body>
</html>
