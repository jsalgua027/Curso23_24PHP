<?php
session_name("practica2_recu");
session_start();

require "src/ctes_func.php";
if (isset($_POST["btnEntrar"])) {
    //errores del formulario
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_clave || $error_usuario;

    if (!$error_form) {

        try {
            $consulta = "select * from usuarios where usuario=? and clave=?";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([$_POST["usuario"], md5($_POST["clave"])]);
        } catch (PDOException $e) { // si falla la conexion
            $sentencia = null;
            $conexion = null;
            die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
        }

        if ($sentencia->rowCount() > 0) {
            $_SESSION["usuario"] = $_POST["usuario"]; //genero la variable de sesion
            $_SESSION["clave"] = $_POST["clave"];

            $datos_usuario_logeado = $sentencia->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "<p>No hay usuario con esas credenciales en la base de datos</p>";
        }
    }
}
//aqui hago la consulta a la base de datos para mostralos si al usuario es admin
if (isset($_POST["btnEntrar"])&& $datos_usuario_logeado["tipo"]=="admin")
 {
    try {
        $consulta = "select * from usuarios";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(); 
    } catch (PDOException $e) { // si falla la conexion
        $sentencia = null;
        $conexion = null;
        die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
    }
    if($sentencia->rowCount()>0)
    {
        $todos_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        echo "<p>no hay Usuarios en la tabla solitada</p>"; 
    }

 }

//control de errores del registro de ususario normal
if (isset($_POST["btnGuardarRegistro"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_nombre = $_POST["nombre"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
    $error_sexo = !isset($_POST["sexo"]);
    $error_boletin = !isset($_POST["boletin"]);
    $error_archivo = $_FILES["foto"]["name"] == "" || $_FILES["foto"]["error"] || explode(".", $_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500 * 1024;/* foto obligatoria */
    $error_form = $error_usuario || $error_nombre || $error_clave || $error_dni || $error_sexo || $error_boletin || $error_archivo;

    if (isset($_POST["btnGuardarRegistro"])&& !$error_form) {
        // aqui tengo que hacer la conexion y subir la foto
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_POST["btnEntrar"])) {
        if (isset($_SESSION["usuario"]))
            if ($datos_usuario_logeado["tipo"] == "normal") // si el usuario es normal
            {
                require "vistas/vista_normal.php";
            } else { // si el usuario es admin
                require "vistas/vista_admin.php";
            }
    } elseif (isset($_POST["btnRegistro"])) {
        require "vistas/vista_registro.php";
    } else {
        require "vistas/vista_login.php";
    }

    // ciero la sesión
    session_destroy();

    ?>
</body>

</html>