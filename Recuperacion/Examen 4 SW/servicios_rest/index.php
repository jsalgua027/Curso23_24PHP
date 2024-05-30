<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;


//login
$app->post('/login',function($request){
    $usuario=$request->getParam("usuario");
    $clave=$request->getParam("clave");

    echo json_encode(login($usuario,$clave));

});
//logueado
//salir
//alumnos
//notasAlumno
//NotasNoEvalAlumno
//quitarNota
//ponerNota
//cambiarNota







// Una vez creado servicios los pongo a disposición
$app->run();
?>
