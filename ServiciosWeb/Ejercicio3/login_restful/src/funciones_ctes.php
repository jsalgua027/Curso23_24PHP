<?php
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
/* define("NOMBRE_BD", "bd_tienda"); esta base es para el app login*/
define("NOMBRE_BD", "bd_foro2");



function login($usuario, $clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $conexion = null;
        /*   return array("mensaje_error" => "No he podido conectarse a la base de batos: " . $e->getMessage());  APP LOGIN*/
        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }

    try {
        $consulta = "select * from usuarios where usuario=? and clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        // session_destroy();
        /* return array("mensaje_error" => "No he podido conectarse a la base de batos: " . $e->getMessage()); APP LOGIN*/
        return array("mensaje" => "No he podido conectarse a la base de batos: " . $e->getMessage());
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
/*Opcion A actividad 3*/
function obtner_usuarios()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $conexion = null;

        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }

    try {
        $consulta = "select * from usuarios ";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;

        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }
    $respuesta["usuarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);


    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
/*Opcion B actividad 3*/
function insertar_usuario($datos)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $conexion = null;

        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }

    try {
        $consulta = "insert into usuarios (nombre,usuario,clave,email) values(?,?,?,?) ";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;

        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }
    $respuesta["ult_id"] = $conexion->lastInsertId(); // dame la utlima id metida


    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

/*Opcion d actividad 3*/
function actualizar_usuario($datos)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $conexion = null;

        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }

    try {
        $consulta = "update usuarios set nombre=? , usuario=?, clave=?, email=? where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;

        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }
    if($sentencia->rowCount()>0){
        $respuesta["mensaje"] = "EL usuario con id: ".$datos[4]." se ha actualizado con éxito";

    }
    else
    {
        $respuesta["mensaje_error"] = "EL usuario con id: ".$datos[4]." no se encuntra en la BD";
    }


    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

/*Opcion d actividad 3*/
function borrar_usuario($id_usuario)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $conexion = null;

        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }

    try {
        $consulta = "delete usuarios where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_usuario]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;

        return array("error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }
    
        $respuesta["mensaje"] = "EL usuario con id: ".$id_usuario." se ha actualizado con éxito";

    
     


    $sentencia = null;
    $conexion = null;
    return $respuesta;
}


