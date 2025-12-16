<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel Principal - Punto de Venta E.M</title>

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

/* Contenedor principal */
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

/* Menú lateral */
.menu{
    width:230px;
    background:#2d6a4f;
    color:white;
    padding-top:20px;
}

.menu h2{
    text-align:center;
    margin-bottom:30px;
    letter-spacing:2px;
}

.menu a{
    display:block;
    color:white;
    padding:15px;
    text-decoration:none;
    font-size:15px;
}

.menu a:hover{
    background:#1b4332;
}

/* Contenido */
.contenido{
    flex:1;
    padding:25px;
}

/* Cabecera */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.usuario{
    font-weight:bold;
    color:#2d6a4f;
}

/* Tarjetas */
.cards{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:20px;
}

.card{
    background: linear-gradient(#e9f5ef, #d8f3dc);
    padding:20px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}

.card h3{
    margin:10px 0;
    color:#1b4332;
}

.icon{
    font-size:35px;
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

        <div class="header">
            <h2>Panel Principal</h2>
            <div class="usuario">
                👤 <?php echo $_SESSION["usuario"]; ?>
            </div>
        </div>

        <div class="cards">
            <div class="card">
                <div class="icon">📦</div>
                <h3>Productos</h3>
                <p>Gestión de productos</p>
            </div>

            <div class="card">
                <div class="icon">👥</div>
                <h3>Clientes</h3>
                <p>Registro de clientes</p>
            </div>

            <div class="card">
                <div class="icon">📊</div>
                <h3>Inventario</h3>
                <p>Control de stock</p>
            </div>

            <div class="card">
                <div class="icon">🧾</div>
                <h3>Ventas</h3>
                <p>Registro de ventas</p>
            </div>
        </div>

    </div>

</div>

</body>
</html>
