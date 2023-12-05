<?php
session_name("ejer_01_23_24");
session_start();

if(isset($_SESSION["nombre"]))
{   
    if($_POST["nombre"]=="")
    {
        unset($_SESSION["nombre"]);
    }else
    $_SESSION["nombre"]=$_POST["nombre"];
}

if(isset($_POST["btnBorrar"])){
session_destroy();
header("Location:sesiones01_1.php");
exit;

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Nombre 1(FORMULARIO)</title>
    <style>
        .text-centrado{text-align: center;}
    </style>
</head>
<body>
    <h1 class="text-centrado">Formulario Nombre 1(FORMULARIO)</h1> 
    <?php
    if(isset($_POST["nombre"]))
    {
        echo "<p>Su nombre es: ". $_POST["nombre"]."</p>";
        // ala sesison nombre le asigo la variable del formularios
        $_SESSION["nombre"]=$_POST["nombre"];
    }else{
        echo "<p>En primera página no has tecleado nada</p>";
    }
    
    ?>
    <p><a href="sesiones01_1.php">Volver a primera página</a></p>

</body>
</html>