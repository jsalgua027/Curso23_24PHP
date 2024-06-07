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



function obtenerGrupos($usuario,$hora,$dia)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }
    try {
        //SELECT grupos.nombre from grupos, horario_lectivo WHERE horario_lectivo.grupo= grupos.id_grupo and usuario=44 and horario_lectivo.hora=2 and horario_lectivo.dia=4;
        $consulta="SELECT grupos.nombre, grupos.id_grupo, horario_lectivo.usuario, horario_lectivo.dia,  horario_lectivo.hora  from grupos, horario_lectivo WHERE horario_lectivo.grupo= grupos.id_grupo and usuario=? and horario_lectivo.hora=? and horario_lectivo.dia=?";      
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario,$hora,$dia]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error al realizar la consulta Profesores:" . $e->getMessage();
        $conexion = null;
        $sentencia = null;
        return $respuesta;
    }
    $respuesta["grupos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}

function quitarGrupo($usuario,$grupo)
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
        $sentencia->execute([$usuario,$grupo]);
    } catch (PDOException $e) {
        $respuesta["error"] = "Error al realizar la consulta Profesores:" . $e->getMessage();
        $conexion = null;
        $sentencia = null;
        return $respuesta;
    }
    $respuesta["mensaje"] ="Grupo quitado con exito";
    $conexion = null;
    $sentencia = null;
    return $respuesta;
}
