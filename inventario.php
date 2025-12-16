<?php
session_start();
include "db/conexion.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

$productos = mysqli_query($conexion, "SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Inventario - Punto de Venta E.M</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    height:100vh;
    display:flex;
}

/* Fondos */
.fondo-verde{
    width:50%;
    background: linear-gradient(#b7e4c7, #52b788);
}
.fondo-rosa{
    width:50%;
    background: linear-gradient(#ffd6e0, #ff8fab);
}

/* Panel */
.panel{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    width:90%;
    height:85%;
    background:white;
    border-radius:20px;
    box-shadow:0 0 25px rgba(0,0,0,0.3);
    display:flex;
    overflow:hidden;
}

/* Menú */
.menu{
    width:230px;
    background:#2d6a4f;
    color:white;
    padding-top:20px;
}
.menu h2{
    text-align:center;
    margin-bottom:30px;
}
.menu a{
    display:block;
    color:white;
    padding:15px;
    text-decoration:none;
}
.menu a:hover{
    background:#1b4332;
}

/* Contenido */
.contenido{
    flex:1;
    padding:25px;
}

h2{
    color:#2d6a4f;
}

/* Tabla */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
th, td{
    padding:10px;
    border-bottom:1px solid #ccc;
    text-align:center;
}
th{
    background:#40916c;
    color:white;
}

/* Estados */
.bajo{
    background:#ffccd5;
}
.medio{
    background:#fff3cd;
}
.alto{
    background:#d8f3dc;
}
</style>

</head>
<body>

<div class="fondo-verde"></div>
<div class="fondo-rosa"></div>

<div class="panel">

    <!-- MENÚ -->
    <div class="menu">
        <h2>E.M 🐝</h2>
        <a href="dashboard.php">🏠 Inicio</a>
        <a href="productos.php">📦 Productos</a>
        <a href="clientes.php">👥 Clientes</a>
        <a href="inventario.php">📊 Inventario</a>
        <a href="ventas.php">🧾 Ventas</a>
        <a href="logout.php">❌ Salir</a>
    </div>

    <!-- CONTENIDO -->
    <div class="contenido">
        <h2>📊 Control de Inventario</h2>

        <table>
            <tr>
                <th>Producto</th>
                <th>Stock</th>
                <th>Estado</th>
            </tr>

            <?php while($p = mysqli_fetch_assoc($productos)) {

                if ($p["stock"] <= 10) {
                    $estado = "BAJO";
                    $clase = "bajo";
                } elseif ($p["stock"] <= 30) {
                    $estado = "MEDIO";
                    $clase = "medio";
                } else {
                    $estado = "ALTO";
                    $clase = "alto";
                }
            ?>
            <tr class="<?php echo $clase; ?>">
                <td><?php echo $p["nombre"]; ?></td>
                <td><?php echo $p["stock"]; ?></td>
                <td><?php echo $estado; ?></td>
            </tr>
            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>
