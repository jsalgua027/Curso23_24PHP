<?php
/*Estas tres sententencias son necesarias siempre*/
/*
require __DIR__ . '/Slim/autoload.php';
$app= new \Slim\App;
$app->run();
*/


require __DIR__ . '/Slim/autoload.php';
/*localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/teoriaServiciosWeb/saludo------------direccion y en el primer argumento se pasa el ulitmo*/

$app = new \Slim\App;
/*el metodo get simpre recibe dos argumentos url y funcion*/
$app->get('/saludo', function () {

    //siempre terminamos con un echo que es el que manda el JSON; siempre terminamos con un json de un array
    $respuesta["mensaje"] = "hola";
    echo json_encode(array("mensaje" => "hola")); //--->OTRA FORMA DE HACER EL ARRAY
});

// METODO GET QUE RECIBE UN PARAMETRO recoger datos
$app->get('/saludo/{nombre}', function ($request) {

    $valor_recibido = $request->getAttribute('nombre');
    $respuesta["mensaje"] = "hola " . $valor_recibido;
    echo json_encode($respuesta);
});

// $app->post(); parar insertar datos

$app->post('/saludo', function ($request) { // metodo post que manda datos

    $valor_recibido = $request->getParam('nombre'); // los datos van por abajo no por la url
    $respuesta["mensaje"] = "hola " . $valor_recibido;
    echo json_encode($respuesta);
});

// $app->delete(); para borrar datos
$app->delete('/borrar_saludo/{id}', function ($request) { // metodo post que manda datos

    $id_recibida = $request->getAttribute('id'); // los datos van por abajo no por la url
    $respuesta["mensaje"] = "Se ha borrado el saludo con id:  " . $id_recibida;
    echo json_encode($respuesta);
});
// $app->put(); para actualizar datos
$app->put('/actualiar_saludo/{id}', function ($request) { // metodo post que manda datos

    $id_recibida = $request->getAttribute('id'); // los datos van por abajo no por la url
    $nombre_nuevo = $request->getParam('nombre'); // el nombre nuevo que recivo
    $respuesta["mensaje"] = "Se ha actualizado el saludo con id:  " . $id_recibida . " al nombre : " . $nombre_nuevo;
    echo json_encode($respuesta);
});


$app->run();
