<?php
// si le doy a borrar, borrame toda la pagina
    if(isset($_POST["borrar"])){
        unset($_POST);
            // otra forma de hacerlo el 
            /*
            header("Location:index.php");
            exit;
            */
    }


$error_form = false;

if (isset($_POST["guardar"])) { // compruebo errores

    $error_nombre = $_POST["nombre"] == "";
    $error_apellidos = $_POST["apellidos"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_sexo = !isset($_POST["sexo"]); // si no existe 
    $error_comentarios = $_POST["comentarios"] == "";

    $error_form = $error_nombre || $error_apellidos || $error_clave || $error_sexo || $error_comentarios;
}

if (isset($_POST["guardar"]) && !$error_form) {

    
require "vistas/vistas_respuestas.php";

} else {


    
require "vistas/vistas_formulario.php";


}
