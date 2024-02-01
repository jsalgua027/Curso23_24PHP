<?php
require "src/funciones_ctes.php";
require __DIR__ . '/Slim/autoload.php';
$app = new \Slim\App;

$app->post('/salir', function ($request) {

    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    echo json_encode(array("no login" => "Close session"));
});




// primer login normal no necesita el api_key
$app->post('/login', function ($request) {

    $usuario = $request->getParam('usuario');
    $clave = $request->getParam('clave');

    echo json_encode(login($usuario, $clave));
});

//recibe la key de la session y comprueba que estas logeado
$app->post('/logueado', function ($request) {

    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"])) {

        echo json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});

$app->get('/usuarios', function ($request) {

    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") // compruebo que esta logueado y si es administardor compribando el tipo
    {
        echo json_encode(obtener_usuarios());
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});

$app->get('/usuario/{id_usuario}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") // compruebo que esta logueado y si es administardor compribando el tipo
    {
        echo json_encode(obtener_usuario($request->getAttribute("id_usuario")));
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});

$app->post('/crearUsuario', function ($request) {

    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") // compruebo que esta logueado y si es administardor compribando el tipo
    {
        $datos[] = $request->getParam('nombre');
        $datos[] = $request->getParam('usuario');
        $datos[] = $request->getParam('clave');
        $datos[] = $request->getParam('email');

        echo json_encode(insertar_usuario($datos));
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});


$app->post('/login', function ($request) {

    $usuario = $request->getParam('usuario');
    $clave = $request->getParam('clave');

    echo json_encode(login($usuario, $clave));
});


$app->put('/actualizarUsuario/{id_usuario}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") // compruebo que esta logueado y si es administardor compribando el tipo
    {
        $datos[] = $request->getParam('nombre');
        $datos[] = $request->getParam('usuario');
        $datos[] = $request->getParam('clave');
        $datos[] = $request->getParam('email');
        $datos[] = $request->getAttribute('id_usuario');

        echo json_encode(actualizar_usuario($datos));
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});

$app->put('/actualizarUsuarioSinClave/{id_usuario}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") // compruebo que esta logueado y si es administardor compribando el tipo
    {
        $datos[] = $request->getParam('nombre');
        $datos[] = $request->getParam('usuario');
        $datos[] = $request->getParam('email');
        $datos[] = $request->getAttribute('id_usuario');

        echo json_encode(actualizar_usuario_sin_clave($datos));
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});


$app->delete('/borrarUsuario/{id_usuario}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") // compruebo que esta logueado y si es administardor compribando el tipo
    {
        echo json_encode(borrar_usuario($request->getAttribute('id_usuario')));
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});

$app->get('/repetido/{tabla}/{columna}/{valor}', function ($request) {
    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") // compruebo que esta logueado y si es administardor compribando el tipo
    {
        echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor')));
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function ($request) {

    $api_key = $request->getParam("api_key");
    session_id($api_key);
    session_start();
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] == "admin") // compruebo que esta logueado y si es administardor compribando el tipo
    {
        echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor'), $request->getAttribute('columna_id'), $request->getAttribute('valor_id')));
    } else {
        session_destroy();
        echo json_encode(array("no login" => "No tienen permisos para usar este servicio"));
    }
});


$app->run();
