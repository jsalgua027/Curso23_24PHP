<?php
/*Estas tres sententencias son necesarias siempre*/
/*
require __DIR__ . '/Slim/autoload.php';
$app= new \Slim\App;
$app->run();
*/


require __DIR__ . '/Slim/autoload.php';
/*localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/teoriaServiciosWeb/saludo------------direccion y en el primer argumento se pasa el ulitmo*/

$app= new \Slim\App;
/*el metodo get simpre recibe dos argumentos url y funcion*/
   $app->get('/saludo',function(){

 //siempre terminamos con un echo que es el que manda el JSON; siempre terminamos con un json de un array
 $respuesta["mensaje"]="hola";
  echo json_encode(array("mensaje"=>"hola"));//--->OTRA FORMA DE HACER EL ARRAY
   });
// $app->post();
// $app->delete();
// $app->put();



$app->run();
?>