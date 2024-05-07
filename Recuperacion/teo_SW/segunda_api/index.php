<?php

require __DIR__ . '/Slim/autoload.php';
$app= new \Slim\App;

// metodos de logueado

require "src/funciones_ctes.php";


// metodo para obtener los libros
$app->get("/obtener_libros",function(){

    echo json_encode(obtener_libros());

});

// obtener detalles libro

$app->get("/detalles_libros/{referencia}",function($request){

    $referencia=$request->getAttribute("referencia");
    $respuestas["libros"]="Json con todos los  detalles libro";

    echo json_encode($respuestas);

});

// borrar libro

$app->get("/borrar_libros/{referencia}",function($request){
    $referencia=$request->getAttribute("referencia");
    $respuestas["mensaje"]="Libro borrado con exito";

    echo json_encode($respuestas);

});


// editarlibro

$app->put("/editar_libro/{referencia}",function($request){

    $referencia=$request->getAttribute("referencia");
    $titulo=$request->getParam("titulo");
    $titulo=$request->getParam("autor");
    //todos los demas que faltan para actuallizar
    $respuestas["mensaje"]="Json con todos los  detalles libro";

    echo json_encode($respuestas);

});


//  insertar libro

$app->post("/insertar_libro/{referencia}",function($request){

    $referencia=$request->getAttribute("referencia");
    $titulo=$request->getParam("titulo");
    $titulo=$request->getParam("autor");
    //todos los demas que faltan 
    
    $respuestas["mensaje"]="Agregado el libro ";

    echo json_encode($respuestas);

});



// repetidos

$app->get("/repetido_insert/{tabla}/{columna}/{valor}",function($request){

    $tabla=$request->getAttribute("tabla");
    $columna=$request->getAttribute("columna");
    $valor=$request->getAttribute("valor");
    $respuestas["repetido"]="Valor repetido o no";

    echo json_encode($respuestas);

});


$app->get("/repetido_edit/{tabla}/{columna}/{valor}/{columna_clave}/{valor_clave}",function($request){

    $tabla=$request->getAttribute("tabla");
    $columna=$request->getAttribute("columna");
    $valor=$request->getAttribute("valor");
    $columna_clave=$request->getAttribute("columna_clave");
    $valor_clave=$request->getAttribute("valor_clave");
    $respuestas["repetido"]="Valor repetido o no";

    echo json_encode($respuestas);

});

// servicio actualizar para la foto

$app->put("/actualizar_foto/{referencia}",function($request){

    $referencia=$request->getAttribute("referencia");
    $nombre_foto=$request->getParam("nombre_foto");
    
    //todos los demas que faltan para actualizar
    $respuestas["mensaje"]="foto Actualizada";

    echo json_encode($respuestas);

});

$app->run();
?>