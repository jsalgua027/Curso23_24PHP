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

/** Opcion A actividad 3*/
$app->get('/usuarios',function(){

  echo json_encode(obtner_usuarios());


});

/** Opcion b actividad 3*/
$app->post('/crearUsuario',function($request){
   
  $datos[]=$request->getParam('nombre');
  $datos[]=$request->getParam('usuario');
  $datos[]=$request->getParam('clave');
  $datos[]=$request->getParam('email');
  



  echo json_encode(insertar_usuario($datos)); 
});

/** Opcion D actividad 3*/
$app->put('/actualizarUsuario/{id_usuario}',function($request){
   
  $datos[]=$request->getParam('nombre');
  $datos[]=$request->getParam('usuario');
  $datos[]=$request->getParam('clave');
  $datos[]=$request->getParam('email');
 // el dato del id que le damos
  $datos[]=$request->getAttribute('id_usuario');
  
  



  echo json_encode(actualizar_usuario($datos)); 
});

/** Opcion D actividad 3*/
$app->put('/borrarUsuario/{id_usuario}',function($request){
   
    

  echo json_encode(actualizar_usuario($request->getAttribute('id_usuario'))); 
});






/*de la APP login*/
$app->post('/login',function($request){
   
  $usuario=$request->getParam('usuario');
  $clave=$request->getParam('clave');


  echo json_encode(login($usuario,$clave)); 
});

$app->run();
