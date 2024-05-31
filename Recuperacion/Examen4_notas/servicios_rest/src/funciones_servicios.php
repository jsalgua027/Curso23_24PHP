<?php
require "config_bd.php";


function login($usuario,$clave)
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
        
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        return $respuesta;
    }
    try{
        $consulta="select * from usuarios where usuario=? and clave=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario,$clave]);
    }
     catch(PDOException $e){

        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }

    if($sentencia->rowCount()>0)
    {
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);//me traigo los datos
        session_name("API_Examen_4");
        session_start();
        $_SESSION["usuario"]=$respuesta["usuario"]["usuario"]; //guardo el usuario en la sessión
        $_SESSION["clave"]=$respuesta["usuario"]["clave"];// guardo la clave en la sessión
        $_SESSION["tipo"]=$respuesta["usuario"]["tipo"];// guardo la clave en la sessión
        $respuesta["api_session"]=session_id(); // genero la clave para la api
    }
    else
    {
        $respuesta["mensaje"]="Usuario no se encuentra registrado en la base de datos";
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
    catch(PDOException $e)
    {
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }
    try {
       $consulta="select * from usuarios where usuario? and clave=?";
       $sentencia=$conexion->prepare($consulta);
       $sentencia->execute([$usuario,$clave]);
       if($sentencia->rowCount()>0)
       {
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
       }
       else
       {
        $respuesta["mensaje"]="El usuario no se encuentra registrado en la BD";
       }
      
       $sentencia=null;
       $conexion=null;
       return $respuesta;

    }
    catch(PDOException $e)
    {
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
}




?>
