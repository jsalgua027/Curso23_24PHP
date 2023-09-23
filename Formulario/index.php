<?php
$error_form=false;

if (isset($_POST['guardar'])) {
    # genero variables de error por cada campo del formulario

    //RECUERDA!! = es asignación , == es si tiene el valor


    $error_nombre = $_POST['nombre']== "";
    $error_sexo = !isset($_POST['sexo']);
   
    $error_form= $error_nombre || $error_sexo;
} 
if(isset($_POST['guardar'])&& !$error_form){

    require "vistas_respuestas.php";

}else{

    require "vistas_formulario";

}




?>