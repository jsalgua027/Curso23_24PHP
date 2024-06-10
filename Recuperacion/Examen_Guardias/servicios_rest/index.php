<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;


$app->post('/salir',function($request){
    session_destroy();
    $respuesta["log_out"]="Cerrada sesión en la API";
    echo json_encode($respuesta);
});

$app->post('/login',function($request){
    $usuario=$request->getParam("usuario");
    $clave=$request->getParam("clave");

    echo json_encode(login($usuario,$clave));


});
$app->post('/logueado',function($request){

    session_id($request->getParam("api_session"));
    session_start();
    if(isset($_SESSION["usuario"]))
    {
        $user=$_SESSION["usuario"];
        $pass=$_SESSION["clave"];
        echo json_encode(logueado($user,$pass));
    }
});

$app->get('/prueba',function($request){

   
        echo json_encode(prueba());
    
});

$app->run();

?>
