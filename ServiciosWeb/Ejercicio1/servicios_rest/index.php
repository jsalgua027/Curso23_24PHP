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
   
    echo json_encode(obtener_productos());
});

$app->get('/productos/{cod}',function($request){
   
    echo json_encode(obtener_producto($request->getAttribute('cod')));
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
   
});
// update actualizar
  $app->put('/producto/actualizar/{cod}',function($request){

   
    $datos[]=$request->getParam("nombre");//datos por abajo
    $datos[]=$request->getParam("nombre_corto");
    $datos[]=$request->getParam("descripcion");
    $datos[]=$request->getParam("PVP");
    $datos[]=$request->getParam("familia");

    $datos[]=$request->getAttribute("cod");// datos por arriba

    echo json_encode(actualizar_producto($datos));
  });
  // borrar con codigo
  $app->delete('/producto/borrar/{cod}',function($request){

    echo json_encode(borrar_producto($request->getAttribute("cod")));
  });

// obtener todas las familias
  $app->get('/familias',function(){
   
    echo json_encode(obtener_familias());
});

//repetidos cuando vas a insertar
$app->get('/repetidos/{tabla}/{columna}/{valor}',function($request){
   
    echo json_encode(repetido_insertar($request->getAttribute('tabla'),$request->getAttribute('columna'),$request->getAttribute('valor')));
});

//repetidos cuando vas a editar
$app->get('/repetidos/{tabla}/{columna}/{valor}/{columna_id},{valor_id}',function($request){
   
    echo json_encode(repetido_editar($request->getAttribute('tabla'),$request->getAttribute('columna'),$request->getAttribute('valor'),$request->getAttribute('columna_id'),$request->getAttribute('valor_id')));
});

$app->run();
