<?php
require "config_bd.php";

function profesores()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }
    try {
        $consulta = "select * from usuarios";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $respuesta["error"] = "Error al realizar la consulta Profesores:" . $e->getMessage();
        $conexion = null;
        $sentencia = null;
        return $respuesta;
    }
    $respuesta["usuarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function horarios($usuario)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }
    try {
        
        $consulta="SELECT horario_lectivo.dia, horario_lectivo.hora, horario_lectivo.grupo,grupos.nombre from horario_lectivo, grupos WHERE horario_lectivo.grupo=grupos.id_grupo and usuario=?";      
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error al realizar la consulta Profesores:" . $e->getMessage();
        $conexion = null;
        $sentencia = null;
        return $respuesta;
    }
    $respuesta["horarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}


