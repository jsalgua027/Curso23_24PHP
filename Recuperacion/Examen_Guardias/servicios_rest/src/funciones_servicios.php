<?php
require "config_bd.php";

function login($usuario,$clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        return $respuesta;
    }

    try {
       $consulta= "select * from usuarios where usuario=? and clave=? ";
       $sentencia=$conexion->prepare($consulta);
       $sentencia->execute([$usuario,$clave]);


    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }

    if($sentencia->rowCount()>0)
    {
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
        session_name("API_examen_guardias");
        session_start();
        $respuesta["api_session"]=session_id();
        $_SESSION["usuario"]=$_SESSION["usuario"]["usuario"];
        $_SESSION["clave"]=$_SESSION["usuario"]["clave"];

    }
    else
    {
        $respuesta["mensaje"]="El usuario no se encuentra en la base de datos";
    }
    
    $sentencia=null;
    $conexion=null;
    return $respuesta;

 
}

function logueado($usuario,$clave)
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
       
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select * from usuarios where usuario=? and clave=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario,$clave]);
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible realizar la consulta:".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }

    if($sentencia->rowCount()>0)
    {
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
        
    }
    else
        $respuesta["mensaje"]="El usuario no se encuentra en la BD";

    $sentencia=null;
    $conexion=null;
    return $respuesta;
    
}


?>