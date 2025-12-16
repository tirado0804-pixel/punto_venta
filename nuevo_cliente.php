<?php
session_start();
include "db/conexion.php";

if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
    exit;
}

$mensaje = "";

if($_POST){
    $nombre   = trim($_POST["nombre"]);
    $dni      = trim($_POST["dni"]);
    $telefono = trim($_POST["telefono"]);

    $sql = "INSERT INTO clientes (nombre, dni, telefono)
            VALUES ('$nombre','$dni','$telefono')";

    if(mysqli_query($conexion, $sql)){
        header("Location: clientes.php");
        exit;
    }else{
        $mensaje = "❌ Error al guardar cliente";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Cliente | Punto de Venta E.M</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f1f1f1;
}

.formulario{
    width:350px;
    margin:60px auto;
    background:white;
    padding:20px;
    border-radius:6px;
    box-shadow:0 2px 6px rgba(0,0,0,0.2);
}

h3{
    margin-top:0;
    text-align:center;
    color:#2d6a4f;
}

input{
    width:100%;
    padding:8px;
    margin-bottom:10px;
    border:1px solid #ccc;
    border-radius:4px;
}

button{
    width:100%;
    padding:8px;
    background:#2d6a4f;
    color:white;
    border:none;
    border-radius:4px;
    cursor:pointer;
}

button:hover{
    background:#1b4332;
}

.mensaje{
    text-align:center;
    color:red;
    margin-bottom:10px;
}

.volver{
    display:block;
    text-align:center;
    margin-top:10px;
    text-decoration:none;
    color:#40916c;
}
</style>
</head>

<body>

<div class="formulario">

<h3>Nuevo Cliente</h3>

<?php if($mensaje!=""){ ?>
<p class="mensaje"><?php echo $mensaje; ?></p>
<?php } ?>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="text" name="dni" placeholder="DNI">
    <input type="text" name="telefono" placeholder="Teléfono">
    <button>Guardar Cliente</button>
</form>

<a href="clientes.php" class="volver">⬅ Volver</a>

</div>

</body>
</html>
