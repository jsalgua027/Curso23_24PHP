<?php
// control de baneo
try{
    $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); 
}
catch(PDOException $e){
    session_destroy();
    die(error_page("Práctica Rec 2","<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:".$e->getMessage()."</p>"));
}

try {
    $datos[0]=$_SESSION["usuario"];
    $datos[1]=$_SESSION["clave"];
    $consulta = "select * from usuarios where usuario=? and clave=?";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute($datos);
} catch (PDOException $e) { // si falla la conexion
    $sentencia = null;
    $conexion = null;
    session_destroy();
    die(error_page("Practica rec 2", "<h1>Imposible de cinectar con la base de datos error: " . $e->getMessage() . " </h1>"));;
}

if ($sentencia->rowCount() <= 0) {
    $sentencia = null;
    $conexion = null;
    session_unset();
    $_SESSION["seguridad"]="usted no se enucnetra registrado en la bd";
    header("Location:index.php");
    exit;


} 
else{
    // acabo de pasar el control de baneo
    $datos_usuario_logeado=$sentencia->fetch(PDO::FETCH_ASSOC);
    $_SESSION["tipo_usuario"]=$datos_usuario_logeado["tipo"];
    $sentencia=null;
}



// ahora paso el control de tiempo

if(time()-$_SESSION["ultima_accion"]>MINUTOS*60)
{
    $sentencia = null;
    $conexion = null;
    session_unset();
    $_SESSION["seguridad"]="Su tiempo de sesion ha espirado";
    header("Location:index.php");
    exit;
}
 



//paso el contro de tiempo 
// renuevo el tiempo para facilitar el usuario
$_SESSION["ultima_accion"]=time();

?>