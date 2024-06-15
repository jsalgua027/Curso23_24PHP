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

$app->run();
