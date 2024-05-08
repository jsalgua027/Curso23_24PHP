<?php

require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

require "src/funciones_ctes.php";


// servicio para loguearse

$app->post("/login", function ($request) {

    $datos[] = $request->getParam("usuario");
    $datos[] = $request->getParam("clave");

    echo json_encode(login($datos));
});

// seguridad logueado para distingur
$app->post("/logueado", function ($request) {

    session_id($request->getParam("api_key")); // le pasamos el numero y abrimos la sesion con ese umeo
    session_start();

    if (isset($_SESSION["usuario"])) {
        $datos[] = $_SESSION["usuario"];
        $datos[] = $_SESSION["clave"];

        echo json_encode(login($datos));
    } else // usuario logueado que no tiene permiso para usar todos los servicios (usuario normal)
    {
        session_destroy();
        $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
        echo json_encode($respuesta);
    }
});

// cerrar servicio

$app->post("/salir", function ($request) {

    session_id($request->getParam("api_key")); // le pasamos el numero y abrimos la sesion con ese umeo
    session_start();
    session_destroy();
    $respuesta["logout"] = "Sesión cerrada";
    echo json_encode($respuesta);
});



$app->post("/insertar_usuario", function ($request) {

    $nombre = $request->getParam("nombre");
    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");
    $dni = $request->getParam("dni");
    $sexo = $request->getParam("sexo");
    $subscripcion = $request->getParam("subscripcion");

    echo json_encode(insertar_usuario($nombre, $usuario, $clave, $dni, $sexo, $subscripcion));
});


$app->put("/actualizar_foto/{id_usuario}", function ($request) {

    $id_usuario = $request->getAttribute("id_usuario"); //por arriba
    $nombre_foto_nuevo = $request->getParam("nombre_foto"); //por abajo
    echo json_encode(actulizar_foto($id_usuario, $nombre_foto_nuevo));
});

// repetido

$app->get("/repetido_insert/{tabla}/{columna}/{valor}", function ($request) {

    $tabla = $request->getAttribute("tabla");
    $columna = $request->getAttribute("columna");
    $valor = $request->getAttribute("valor");
    echo json_encode(repetido_insertando($tabla, $columna, $valor));
});
// repetido editando
$app->get("/repetido_insert/{tabla}/{columna}/{valor}/{columna_clave}/{valor_clave}", function ($request) {

    $tabla = $request->getAttribute("tabla");
    $columna = $request->getAttribute("columna");
    $valor = $request->getAttribute("valor");
    $columna_clave = $request->getAttribute("columna_clave");
    $valor_clave = $request->getAttribute("valor_clave");
    echo json_encode(repetido_editando($tabla, $columna, $valor, $columna_clave, $valor_clave));
});

//obtener todos los usuario
$app->get("/obtener_usuarios", function ($request) {
    session_id($request->getParam("api_key")); // le pasamos el numero y abrimos la sesion con ese umeo
    session_start();

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_todos_usuarios());
    } else {
        session_destroy();
        $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
        echo json_encode($respuesta);
    }
});

//obtener usuarios con paginacion
$app->get("/obtener_usuarios_pag/{pag}/{n_registros}", function ($request) {

    session_id($request->getParam("api_key")); // le pasamos el numero y abrimos la sesion con ese umeo
    session_start();

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_usuarios_pag($request->getAttribute("pag"), $request->getAttribute("n_registros")));
    } else {
        session_destroy();
        $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
        echo json_encode($respuesta);
    }
});

//obtener usuarios con filtro
$app->get("/obtener_usuarios_filtros", function ($request) {

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_todos_usuarios_pag($request->getParam("buscar"))); // aqui le paso los datos por abajo
    } else {
        session_destroy();
        $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
        echo json_encode($respuesta);
    }
});

//obtener usuarios con paginacion con filtro
$app->get("/obtener_usuarios_filtro_pag/{pag}/{n_registros}", function ($request) {

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_usuarios_flitro_pag($request->getAttribute("pag"), $request->getAttribute("n_registros"), $request->getParam("buscar")));
    } else {
        session_destroy();
        $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
        echo json_encode($respuesta);
    }
});

// obtener detalle usuario
$app->get("/obtener_detalles/{id_usuario}", function ($request) {

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(obtener_detalles_usuario($request->getAttribute("id_usuario")));
    } else {
        session_destroy();
        $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
        echo json_encode($respuesta);
    }
});

$app->delete("/borrar_usuario/{id_usuario}", function ($request) {

    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {
        echo json_encode(borrar_usuario($request->getAttribute("id_usuario")));
    } else {
        session_destroy();
        $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
        echo json_encode($respuesta);
    }
});

// actualizar ususario

$app->put("/actualizar_usuario_clave/{id_usuario}", function ($request) {
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") {

        $nombre = $request->getParam("nombre");
        $usuario = $request->getParam("usuario");
        $clave = $request->getParam("clave");
        $dni = $request->getParam("dni");
        $sexo = $request->getParam("sexo");
        $subscripcion = $request->getParam("subscripcion");


        echo json_encode(actulizar_usuario_clave($nombre, $usuario, $clave, $dni, $sexo, $subscripcion, $request->getAttribute("id_usuario")));
    } else {
        session_destroy();
        $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
        echo json_encode($respuesta);
    }
});



$app->run();
