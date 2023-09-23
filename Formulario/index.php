<?php
$error_form=false;

if (isset($_POST['enviar'])) {
    # genero variables de error por cada campo del formulario

    //RECUERDA!! = es asignación , == es si tiene el valor


    $error_nombre = $_POST['nombre']== "";
    $error_sexo = !isset($_POST['sexo']);
    $error_comentarios = $_POST["coment"] == "";
    $error_form= $error_nombre || $error_sexo ;
} 
if(isset($_POST['enviar'])&& !$error_form){

    require "vistas/vistas_respuestas.php";

}else{

    require "vistas/vistas_formulario.php";

}




?>