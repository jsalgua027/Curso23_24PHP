<?php


require "src/funciones.php";

if (isset($_POST["btnGuardar"])) {
   
    $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 50;
    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 30;
    // si no hay error en el usuario compruebo que no este repetido
    if (!$error_usuario) {
        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
        $error_usuario_repetido = repetido_variable($conexion, "usuarios", "usuario", $_POST["usuario"]);

        if (is_string($error_usuario_repetido))
            die($error_usuario_repetido);
    }
    $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 50;
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
    // compruebo que el dni no este repetido 
    if (!$error_dni) {

        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
        $error_dni_repetido= repetido_variable($conexion, "usuarios", "usuario", $_POST["dni"]);

        if (is_string($error_dni_repetido))
            die($error_dni_repetido);
    }
    $error_sexo = !isset($_POST["sexo"]); // si no existe 
    $error_archivo =  $_FILES["archivo"]["name"] != "" &&  ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);

    $error_form = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_sexo || $error_archivo;

    // si no hay ningun error realizo la inserción de datos

    if (!$error_form) {

        try {
          
           $consulta = "insert into usuarios (nombre,usuario,clave,dni,sexo) values ('" . $_POST["nombre"] . "','" . $_POST["usuario"] . "','" . $_POST["clave"] . "','" . $_POST["dni"] . "','" . $_POST["sexo"] . "')";
           mysqli_query($conexion,$consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
        mysqli_close($conexion);

        header("Location:index.php");
        exit;
        // tengo que hacer el primer insert sin foto
        // una vez que hago eso compruebo si existe el archivo foto, si existe muevo el archivo a la carpeta y si tengo exito hago un pudate con la foto (img_id)
    }
}

if (isset($_POST["btnBorrar"])) {
   //conecto
   try {
     $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
     mysqli_set_charset($conexion, "utf8");
   } catch (Exception $e) {
     die("<p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
   }
   // realizo la consulta borrado
   try {
     $consulta = "delete from usuarios where id_usuario='" . $_POST["btnBorrar"] . "'";
     mysqli_query($conexion, $consulta);
   } catch (Exception $e) {
     mysqli_close($conexion);
     die(error_page("Práctica 8", "<h1>Listado de los usuarios</h1><p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
   }
   
   if($_POST["nombre_foto"]!="no_imagen.jpg")
      unlink("Img/".$_POST["nombre_foto"]);
   
   
 
   mysqli_close($conexion);
   header("Location:index.php");
   exit();
 }
 
//realizo la conexion

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td,th{border:1px solid black}
        table{border-collapse:collapse;text-align:center}
        th{background-color:#CCC}
        table img{width:50px;}
        .enlace{border:none;background:none;cursor:pointer;color:blue;text-decoration:underline}
        .error{color:red}  
    </style>
</head>
<body>
<h1>Práctica 8</h1>
<?php
// so le damos al boton detalle
 if(isset($_POST["btnDetalle"])){
    require("vistas/vista_detalle.php");

 }
 if(isset($_POST["btnNuevoUsu"])||isset($_POST["btnGuardar"])){
    require("vistas/vista_nuevo.php");
    
 }
 
// muestro la consulta generaal de la tabla INICIO
require ("vistas/vista_tabla.php");


?>
</body>
</html>
