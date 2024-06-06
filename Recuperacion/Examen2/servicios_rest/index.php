<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;


$app->post('/salir',function($request){
    session_destroy();
    $respuesta["log_out"]="Cerrada sesión en la API";
    echo json_encode($respuesta);
});


$app->get('/profesores',function($request){
   
    echo json_encode(profesores());

});

$app->get('/horarios/{usuario}',function($request){
   $usuario=$request->getAttribute("usuario");
    echo json_encode(horarios($usuario));

});

// Una vez creado servicios los pongo a disposición
$app->run();
?>
