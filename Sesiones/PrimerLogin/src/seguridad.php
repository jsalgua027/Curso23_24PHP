<?php
//por auqi estoy logeado
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Error", "<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }
    try {
        $consulta = "select usuario from usuarios where usuario='" . $_SESSION["usuario"] . "' and clave='" . $_SESSION["clave"] . "'";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Error", "<p>No se ha podido realizar la consulta " . $e->getMessage() . "</p>"));
    }

    if (mysqli_num_rows($resultado) <= 0) {
        mysqli_free_result($resultado);
        session_unset();
        $_SESSION["seguridad"] = "Usted no esta registrado en la base de datos";
        header("Location:index.php");
        exit;
    }
    $datos_usuario_resultado = mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);

    //ahora hago el control de inactividad

    if(time()-$_SESSION["ultima_accion"]>MINUTOS*1){
       mysqli_close($conexion);
        session_unset();
        $_SESSION["seguridad"] = "Su tiempo de sesion se ha acabado";
        header("Location:index.php");
        exit;

    }
    //renuevo el tiempo
    $_SESSION["ultima_accion"]=time();
    ?>