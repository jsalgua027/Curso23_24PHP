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
        $consulta="SELECT * from usuarios WHERE usuario=? and clave=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario,$clave]);
        
        
    }
    catch(PDOException $e){
      
        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        $conexion=null;
        $sentencia=null;
        return $respuesta;
    }

    if($sentencia->rowCount()>0)
    {
       $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
        session_name("API_Examen_prueba_FINAL");
        session_start();
       $_SESSION["usuario"]=$respuesta["usuario"]["usuario"];
       $_SESSION["clave"]=$respuesta["usuario"]["clave"];
       $_SESSION["tipo"]=$respuesta["usuario"]["tipo"];
       $respuesta["api_session"]=session_id();

        
    }
    else
    {
        $respuesta["mensaje"]="Usuario no se encuentra registrado en la BD";
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
       
    }
    else
    {
        $respuesta["mensaje"]="Usuario no se encuentra registrado en la base de datos";
    }
    $sentencia=null;
    $conexion=null;
    return $respuesta;
   
} 
   

?>