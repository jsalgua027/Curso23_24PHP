<?php
//la sesión se llama
session_start();
//Si se han borrado los datos de la sesión
if (isset($_POST["btnBorrarSession"])) {
    //session_destroy() tambien borra pero todavia existen en la sesion actual
    session_unset();
}

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
    <h2>Se ha recibido los siguientes datos</h2>
    <p>
        <?php
        //si existe el nombre  me lo escribes
        if (isset($_SESSION["nombre"])) {
            echo "<strong> Nombre:</strong>" . $_SESSION["nombre"] . "</br>";
            echo "<strong> Clave:</strong>" . $_SESSION["clave"];
        }
        else{
            // si se han borrado los valores de la sesion
            echo"<p>Se ha borrado los valores de la sesión</p>";
        }
        ?>
    </p>
    <p><a href="index.php">Volver</a></p>
</body>

</html>