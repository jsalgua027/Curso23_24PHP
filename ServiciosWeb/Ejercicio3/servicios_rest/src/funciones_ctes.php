<?php
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");



function login($usuario, $clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $conexion = null;
        return array("mensaje_error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }

    try {
        $consulta = "select * from usuarios where usuario=? and clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        // session_destroy();
        return array("mensaje_error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }
    if ($sentencia->rowCount() > 0) {
  // si se encuentra en la base de datos
        $respuesta["usuario"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // si no se encuentra en la base de datos
        $respuesta["mensaje"] = "El usuario no se encuentra en la BD";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
