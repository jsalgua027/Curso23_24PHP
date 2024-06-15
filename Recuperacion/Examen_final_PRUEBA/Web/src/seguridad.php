<?php
$datos_env["api_session"] = $_SESSION["api_session"];

$respuesta = consumir_servicios_REST(DIR_SERV . '/logueado', "GET", $datos_env);
$json = json_decode($respuesta, true);

if (!$json) {
    session_destroy();
    die(error_page("<h1>Examen Final Prueba</h1>", "<h2>Examen final</h2><p>Error al consumir los servicios de la Api Login</p>"));
}
if (isset($json["error"])) {
    session_destroy();
    consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
    die(error_page("<h1>Examen Final Prueba</h1>", "<h2>Examen final</h2><p>" . $json["error"] . "</p>"));
}


if (isset($json["no_auth"])) {
    session_unset();
    $_SESSION["seguridad"] = "Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
    header("Location:index.php");
    exit();
}
if (isset($json["mensaje"])) {
    session_unset();
    consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
    $_SESSION["seguridad"] = "Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit();
}

$datos_usuario_log = $json["usuario"];


if (time() - $_SESSION["ult_accion"] > MINUTOS * 60) {
    session_unset();
    consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
    $_SESSION["seguridad"] = "Su tiempo de sesión ha expirado. Por favor vuelva a loguearse";
    header("Location:index.php");
    exit();
}
// Paso el control de tiempo y lo renuevo
$_SESSION["ultima_accion"] = time();
