<?php
session_start();
include "db/conexion.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

$mensaje = "";

/* Registrar venta */
if (isset($_POST["producto_id"]) && isset($_POST["cantidad"])) {

    $producto_id = $_POST["producto_id"];
    $cantidad = $_POST["cantidad"];

    $prod = mysqli_query($conexion, "SELECT * FROM productos WHERE id=$producto_id");
    $p = mysqli_fetch_assoc($prod);

    if ($cantidad > $p["stock"]) {
        $mensaje = "❌ Stock insuficiente";
    } else {
        $total = $cantidad * $p["precio"];

        mysqli_query($conexion, "INSERT INTO ventas (producto_id, cantidad, total)
                                 VALUES ($producto_id, $cantidad, $total)");

        mysqli_query($conexion, "UPDATE productos 
                                 SET stock = stock - $cantidad 
                                 WHERE id = $producto_id");

        $mensaje = "✅ Venta registrada correctamente";
    }
}

$productos = mysqli_query($conexion, "SELECT * FROM productos");
$ventas = mysqli_query($conexion, "
    SELECT v.id, p.nombre, v.cantidad, v.total, v.fecha
    FROM ventas v
    JOIN productos p ON v.producto_id = p.id
    ORDER BY v.fecha DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ventas - Punto de Venta E.M</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    height:100vh;
    display:flex;
}

/* Fondos */
.fondo-verde{ width:50%; background: linear-gradient(#b7e4c7, #52b788); }
.fondo-rosa{ width:50%; background: linear-gradient(#ffd6e0, #ff8fab); }

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
.menu h2{ text-align:center; margin-bottom:30px; }
.menu a{
    display:block;
    color:white;
    padding:15px;
    text-decoration:none;
}
.menu a:hover{ background:#1b4332; }

/* Contenido */
.contenido{
    flex:1;
    padding:25px;
}

h2{ color:#2d6a4f; }

/* Formulario */
form{
    background:#f1fdf6;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}

select, input, button{
    padding:8px;
    margin:5px 0;
    width:100%;
}

button{
    background:#2d6a4f;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
}
button:hover{ background:#1b4332; }

/* Tabla */
table{
    width:100%;
    border-collapse:collapse;
}
th, td{
    padding:8px;
    border-bottom:1px solid #ccc;
    text-align:center;
}
th{
    background:#40916c;
    color:white;
}

.mensaje{
    font-weight:bold;
    margin-bottom:10px;
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

        <h2>🧾 Registrar Venta</h2>

        <?php if($mensaje!=""){ ?>
            <p class="mensaje"><?php echo $mensaje; ?></p>
        <?php } ?>

        <form method="POST">
            <label>Producto</label>
            <select name="producto_id" required>
                <?php while($p = mysqli_fetch_assoc($productos)) { ?>
                    <option value="<?php echo $p["id"]; ?>">
                        <?php echo $p["nombre"]; ?> (Stock: <?php echo $p["stock"]; ?>)
                    </option>
                <?php } ?>
            </select>

            <label>Cantidad</label>
            <input type="number" name="cantidad" min="1" required>

            <button type="submit">Registrar Venta</button>
        </form>

        <h2>📋 Historial de Ventas</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total (S/)</th>
                <th>Fecha</th>
            </tr>

            <?php while($v = mysqli_fetch_assoc($ventas)) { ?>
            <tr>
                <td><?php echo $v["id"]; ?></td>
                <td><?php echo $v["nombre"]; ?></td>
                <td><?php echo $v["cantidad"]; ?></td>
                <td><?php echo number_format($v["total"],2); ?></td>
                <td><?php echo $v["fecha"]; ?></td>
            </tr>
            <?php } ?>
        </table>

    </div>

</div>

</body>
</html>
