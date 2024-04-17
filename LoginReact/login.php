<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");


$_POST = json_decode(file_get_contents("php://input"),true);
 if ($_POST["telefono"]=="Myfpschool" && $_POST["password"]=="2023"){
    $respuesta["usuario"]="fulanico";
    $respuesta["mensaje"]="Acceso correcto";
 }else{
    $respuesta["mensaje"]="Acceso incorrecto";
 }
 echo json_encode($respuesta);
?>