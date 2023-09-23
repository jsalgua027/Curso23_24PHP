<?php
$error_form=false;

if (isset($_POST['guardar'])) {
    # genero variables de error por cada campo del formulario

    //RECUERDA!! = es asignación , == es si tiene el valor


    $error_nombre = $_POST['nombre']== "";
    $error_sexo = !isset($_POST['sexo']);
    if(!isset($_POST['deportes']) && !isset($_POST['lectura']) !isset($_POST['otro'])){

        $error_aficiones = echo 
    }

}




?>