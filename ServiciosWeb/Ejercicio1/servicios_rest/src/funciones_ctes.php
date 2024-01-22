<?php
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");

function obtener_productos()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {

        return array("mensaje_error"=>"<p>No he podido conectarse a la base de batos: " . $e->getMessage() );
    }
    try{
        $consulta="select * from producto";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute();// execute solo admite arrays

         
    } catch (PDOException $e) {
        //cierro la conexion y la sentencia; como son objetos hay que cerrarlo 
       $sentencia=null;
       $conexion=null;
       return array("mensaje_error"=>"<p>No he podido conectarse a la base de batos: " . $e->getMessage() );
    }

    $respuesta["productos"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia=null;
    $conexion=null;
    return($respuesta);


}

function obtener_producto($codigo)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $conexion = null;
        return array("mensaje_error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }

    try {
        $consulta = "select * from producto where cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$codigo]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        // session_destroy();
        return array("mensaje_error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }
    if($sentencia->rowCount()>0){

         $respuesta["productos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    }else{
        $respuesta["mensaje"]="El producto con cod: ".$codigo." no se encuentra en la BD";
    }

      $sentencia = null;
    $conexion = null;
    return $respuesta;

}

function insertar_producto($datos)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $conexion = null;
        return array("mensaje_error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }

    try {
        $consulta = "insert into producto(cod,nombre,nombre_corto,descripcion,PVP,familia) values(?,?,?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        // session_destroy();
        return array("mensaje_error" => "No he podido conectarse a la base de batos: " . $e->getMessage());
    }
    
    
        $respuesta["mensaje"]="El producto se ha insertado correctamente";
    

      $sentencia = null;
    $conexion = null;
    return $respuesta;

}


    
?>