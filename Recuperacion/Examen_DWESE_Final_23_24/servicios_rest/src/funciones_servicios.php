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
        session_name("API_Examen_final");
        session_start();
        $_SESSION["usuario"]=$respuesta["usuario"]["usuario"]; //guardo el usuario en la sessión
        $_SESSION["id_usuario"]=$respuesta["usuario"]["id_usuario"];
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
function horariosProfesor($usuario)
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
        
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        return $respuesta;
    }
    try{

        $consulta="SELECT horario_lectivo.dia, horario_lectivo.hora, grupos.nombre as grupo,aulas.nombre as aula FROM horario_lectivo,grupos,aulas WHERE horario_lectivo.grupo = grupos.id_grupo and horario_lectivo.aula = aulas.id_aula and horario_lectivo.usuario=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario]);
     
    }
     catch(PDOException $e){

        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }

   
        $respuesta["horario"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);//me traigo los datos
       
   
    $sentencia=null;
    $conexion=null;
    return $respuesta;
   
} 


function horarioGrupo($id_grupo)
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
        
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        return $respuesta;
    }
    try{
        $consulta="SELECT horario_lectivo.dia, horario_lectivo.hora, usuarios.usuario, aulas.nombre as aula FROM horario_lectivo, grupos, aulas , usuarios WHERE horario_lectivo.aula = aulas.id_aula and horario_lectivo.grupo= grupos.id_grupo and horario_lectivo.usuario = usuarios.id_usuario and horario_lectivo.grupo=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$id_grupo]);
     
    }
     catch(PDOException $e){

        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }

   
        $respuesta["horario"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);//me traigo los datos
       
   
    $sentencia=null;
    $conexion=null;
    return $respuesta;
   
} 

function todosGrupos()
{
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
        
    }
    catch(PDOException $e){
        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        return $respuesta;
    }
    try{
        $consulta="SELECT * from grupos";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute();
     
    }
     catch(PDOException $e){

        $respuesta["error"]="Imposible conectar :".$e->getMessage();
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }

   
        $respuesta["grupos"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);//me traigo los datos
       
   
    $sentencia=null;
    $conexion=null;
    return $respuesta;
   
} 



?>