<?php
session_name('App_login_23_24');
session_start();
define("MINUTOS", 5);
// fundamental para usar los sevicios
define("DIR_SERV", "http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/Ejercicio3/login_restful");



function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}
function error_page($title, $body)
{
    $respuesta = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $title . '</title>
</head>
<body>' . $body . '
    
</body>
</html>';

    return $respuesta;
}
if(isset($_POST["btnSalir"])){
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_SESSION["usuario"])) // si estas logeado
{
    $datos["usuario"] = $$_SESSION["usuario"];
    $datos["clave"] = $$_SESSION["clave"];
    $url = DIR_SERV . "/login";
    $respuesta = consumir_servicios_REST($url, "POST", $datos);
    $obj = json_decode($respuesta);

    if (!$obj) {
        session_destroy();
        die(error_page('App Login SW', "<h1>App login</h1>" . $respuesta));
    }
    if (isset($obj->mensaje_error)) {
        session_destroy();
        die(error_page('App Login SW', "<h1>App login</h1><p>" . $obj->mensaje_error . "</p>"));
    }
    if (isset($obj->mensaje)) {
        session_unset();
        $_SESSION["seguridad"] = "Usted no se encuntra registrado en la base de datos";
        header("Location:index.php");
        exit;
    }

    $datos_usuario_log = $obj->usuario;
    if (time() - $_SESSION["ult-accion"] > MINUTOS * 60) {
        session_unset();
        $_SESSION["seguridad"] = "Su timepo de sesion ha caducado";
        header("Location:index.php");
        exit;
    }
    // renuevo el tiempo
    $_SESSION["ult_accion"] = time();

    //aqui si es normal una cosa si es admin otra cosas esto es despues del ocntrol de seguridad 

    if($datos_usuario_log->tipo=='normal')
    {
        require "vistas/vista_normal.php";
    }
    else{
        require "vistas/vista_admin.php";

    }





} else { // si no estas logeado

    // compruebo errores formulario
    if (isset($_POST["btnLogin"])) {
        $error_usuario = $_POST["usuario"] == "";
        $error_clave = $_POST["clave"] == "";
        $error_form = $error_usuario || $error_clave;
    }
    if (!$error_form) {
        $datos["usuario"] = $_POST["usuario"];
        $datos["clave"] = $_POST["clave"];
        $url = DIR_SERV . "/login";
        $respuesta = consumir_servicios_REST($url, "POST", $datos);
        $obj = json_decode($respuesta);

        if (!$obj) {
            session_destroy();
            die(error_page('App Login SW', "<h1>App login</h1>" . $respuesta));
        }
        if (isset($obj->mensaje_error)) {
            session_destroy();
            die(error_page('App Login SW', "<h1>App login</h1><p>" . $obj->mensaje_error . "</p>"));
        }
        if (isset($obj->mensaje)) {
            $error_usuario = true;
        } else {
            $_SESSION["usuario"] = $obj->usuario->usuario;
            $_SESSION["clave"] = $obj->usuario->clave;
            $_SESSION["ult_accion"] = time();
            header("Location:index.php");
            exit;
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App login </title>
    </head>

    <body>
        <h1>APP login servicios rest</h1>
        <form action="index.php" method="post">
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
                <?php
                if (isset($_POST["btnLogin"]) && $error_usuario) {
                    if ($_POST["usuario"] == "")
                        echo "<p class='error'>Campo Vacio</p>";
                    else
                        echo "<p class='error'>Usurio o campo no validos</p>";
                }

                ?>
            </p>
            <p>
                <label for="clave">Usuario:</label>
                <input type="password" name="clave">
                <?php
                if (isset($_POST["btnLogin"]) && $error_clave) {
                    echo "<p class='error'>Campo Vacio</p>";
                }

                ?>
            </p>
            <p>

                <button type="submit" name="btnLogin">Login</button>
            </p>


        </form>
        <?php
            if(isset($_SESSION["seguridad"]))
            {
                echo"<p class='seguridad'>".$_SESSION["seguridad"]."</p>";
                session_destroy();

            }
        ?>
    </body>

    </html>

<?php
}


?>