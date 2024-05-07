<?php
require "src/config_bd.php";

function obtener_libros()
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select * from libros";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute();
        $respuesta["libros"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible realizar la consulta:".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    
    
  
}

?>