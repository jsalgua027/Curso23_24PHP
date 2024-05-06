<?php
/*Estas tres sententencias son necesarias siempre*/
/*
require __DIR__ . '/Slim/autoload.php';
$app= new \Slim\App;
$app->run();
*/


require __DIR__ . '/Slim/autoload.php';
$app= new \Slim\App;
/*http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/Recuperacion/teo_SW/primera_api/(saludo)
primer argumento es camino (la llamada)

*/
$app->get("/saludo",function(){

    $respuesta["mensaje"]="hola";
    

    echo json_encode($respuesta);
});

$app->get("/saludo/{nombre}",function($request){
    $name=$request->getAttribute("nombre");
    $respuesta["mensaje"]="hola ".$name;
    

    echo json_encode($respuesta);
});

// metodo post
$app->post("/saludo/{nombre}",function($request){
    $name=$request->getParam("nombre"); // le mando los datos por abajo  OJO aqui ponemos el nombre del indice el array
    $respuesta["mensaje"]="hola ".$name;
    

    echo json_encode($respuesta);
});
// METODO DELETE

$app->delete("/borrar_saludo/{id}",function($request){
    $id_saludo=$request->getAttribute("id"); 
    $respuesta["mensaje"]="Se ha borrado el mensaje con id:  ".$id_saludo;
    

    echo json_encode($respuesta);
});


// metodo PUT

$app->put("/actualizar_saludo/{id}",function($request){
    $id_saludo=$request->getAttribute("id"); // por arriba
    $valor_nuevo=$request->getParam("nombre");// por abajo
    $respuesta["mensaje"]="Se ha Actualizado el mensaje con id:  ".$id_saludo. "al nuevo valor  " .$valor_nuevo;
    

    echo json_encode($respuesta);
});

$app->run();
?>