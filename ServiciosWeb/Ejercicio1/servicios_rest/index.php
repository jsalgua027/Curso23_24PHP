<?php
/*Estas tres sententencias son necesarias siempre*/
/*
require __DIR__ . '/Slim/autoload.php';
$app= new \Slim\App;
$app->run();
*/
/* 

require __DIR__ . '/Slim/autoload.php';
*/

require __DIR__ . '/Slim/autoload.php';
require "src/funciones_ctes.php";// donde tengo las funciones
$app = new \Slim\App;


$app->get('/productos',function(){
   
    echo json_encode(array(obtener_productos()));
});

$app->get('/productos/{cod}',function($request){
   
    echo json_encode(array(obtener_producto($request->getAttribute('cod'))));
});

$app->post('/producto/insertar',function($request){
   /*  $lista_datos["cod"]="1234Dc";
    $lista_datos["nombre"]="PATATAS";
    $lista_datos["cod"]="1234Dc";
     */
    $datos[]=$request->getParam("cod");
    $datos[]=$request->getParam("nombre");
    $datos[]=$request->getParam("nombre_corto");
    $datos[]=$request->getParam("descripcion");
    $datos[]=$request->getParam("PVP");
    $datos[]=$request->getParam("familia");
    echo json_encode(insertar_producto($datos));
    $respuesta["mensaje"]="El producto con el nombre ".$request." se ha insertado correctamente";

});

$app->run();
