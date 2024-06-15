<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;


$app->post('/salir', function ($request) {
   session_destroy();
   $respuesta["log_out"] = "Cerrada sesión en la API";
   echo json_encode($respuesta);
});

$app->get('/login', function ($request) {

   $usuario = $request->getParam("usuario");
   $clave = $request->getParam("clave");


   echo json_encode(login($usuario, $clave));
});

$app->get('/logueado', function ($request) {
session_id($request->getParam("api_session"));
session_start();
if(isset($_SESSION["usuario"]))
{
   $usuario=$_SESSION["usuario"];
   $clave=$_SESSION["clave"];
   echo json_encode(logueado($usuario, $clave));
}
else
{
   session_destroy();
   $respuesta["no_auth"]="Este usuario no tiene autorización";
   echo json_encode($respuesta);
}
  

   
});

$app->run();
