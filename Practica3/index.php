<?php


require "src/funciones.php";


$error_form = false;

if (isset($_POST["guardar"])) { // compruebo errores

    $error_nombre = $_POST["nombre"] == "";
    $error_apellidos = $_POST["apellidos"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
    $error_sexo = !isset($_POST["sexo"]); // si no existe 
    $error_comentarios = $_POST["comentarios"] == "";
    $error_archivo=  $_FILES["archivo"]["name"] == "" &&  $_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024; 
    $error_form = $error_nombre || $error_apellidos || $error_clave || $error_sexo || $error_comentarios || $error_dni || $error_archivo;
}

if (isset($_POST["guardar"]) && !$error_form) {


    require "vistas/vistas_respuestas.php";
} else {



    require "vistas/vistas_formulario.php";
}
