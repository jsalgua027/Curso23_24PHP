<?php
header('Access-Control-Allow-Origin: *'); 

$_POST = json_decode(file_get_contents("php://input"),true);
 if ($_POST["telefono"]=="nacho" && $_POST["password"]=="81dc9bdb52d04dc20036dbd8313ed055"){
    $respuesta["usuario"]="fulanico";
    $respuesta["mensaje"]="Acceso correcto";
 }else{
    $respuesta["mensaje"]="Acceso incorrecto";
 }
 echo json_encode($respuesta);
?>