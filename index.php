<?php
session_start();
include "db/conexion.php";

$error = "";

if (isset($_POST["usuario"]) && isset($_POST["password"])) {

    $usuario = trim($_POST["usuario"]);
    $password = md5(trim($_POST["password"]));

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);

        if ($fila["password"] === $password) {
            $_SESSION["usuario"] = $usuario;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Contraseña incorrecta";
        }
    } else {
        $error = "❌ Usuario no existe";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Punto de Venta E.M</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    height:100vh;
    display:flex;
}

/* Fondo mitad verde mitad rosa */
.fondo-verde{
    width:50%;
    background: linear-gradient(#b7e4c7, #52b788);
}

.fondo-rosa{
    width:50%;
    background: linear-gradient(#ffd6e0, #ff8fab);
}

/* Caja login */
.login{
    width:320px;
    background:white;
    padding:25px;
    border-radius:18px;
    text-align:center;
    box-shadow:0 0 20px rgba(0,0,0,0.3);
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
}

/* Logo */
.logo{
    font-size:56px;
    font-weight:bold;
    color:#2d6a4f;
    letter-spacing:3px;
    margin-bottom:5px;
}

/* Subtítulo */
.sub{
    color:#40916c;
    font-size:14px;
    margin-bottom:15px;
}

/* Abejitas */
.bee{
    font-size:24px;
    position:absolute;
}
.bee1{ top:-15px; left:-15px; }
.bee2{ top:-15px; right:-15px; }
.bee3{ bottom:-15px; left:-15px; }
.bee4{ bottom:-15px; right:-15px; }

/* Inputs */
input{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ccc;
}

/* Botón */
button{
    width:100%;
    padding:10px;
    background:#2d6a4f;
    color:white;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}
button:hover{
    background:#1b4332;
}

/* Error */
.error{
    color:red;
    font-size:14px;
}
</style>

</head>
<body>

<div class="fondo-verde"></div>
<div class="fondo-rosa"></div>

<div class="login">

    <!-- Abejitas -->
    <div class="bee bee1">🐝</div>
    <div class="bee bee2">🐝</div>
    <div class="bee bee3">🐝</div>
    <div class="bee bee4">🐝</div>

    <!-- Logo -->
    <div class="logo">E.M</div>
    <div class="sub">Punto de Venta JIT-CMD</div>

    <?php if($error!=""){ ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
    </form>

</div>

</body>
</html>
