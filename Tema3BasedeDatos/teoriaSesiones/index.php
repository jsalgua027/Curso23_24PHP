<?php
// quiero usar sesiones pido permiso
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Teoría de Sesiones</h1>
    <?php
    if (!isset($_SESSION["nombre"]))
        $_SESSION["nombre"] = "Nacho Salcedo";
    $_SESSION["clave"] = md5("123456");


    ?>
    <p><a href="recibido.php">Ir a Recibido</a></p>
    
    <form action="recibido.php" method="post">
        <button type="submit" name="btnBorrarSession">Borrar datos Sesión</button>

    </form>
</body>

</html>